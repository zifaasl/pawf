from django.contrib.auth import get_user_model
from django.test import TestCase
from django.urls import reverse

from .models import Comment, Post, PostView


class BlogTests(TestCase):
    @classmethod
    def setUpTestData(cls):
        cls.user = get_user_model().objects.create_user(
            username="testuser", email="test@email.com", password="secret"
        )
        cls.post = Post.objects.create(
            title="A good title",
            body="Nice body content",
            author=cls.user,
        )

    def test_post_model(self):
        self.assertEqual(self.post.title, "A good title")
        self.assertEqual(self.post.body, "Nice body content")
        self.assertEqual(self.post.author.username, "testuser")
        self.assertEqual(str(self.post), "A good title")
        # Slug dibuat otomatis dari title.
        self.assertEqual(self.post.get_absolute_url(), f"/post/{self.post.pk}/")

    def test_url_exists_at_correct_location_listview(self):
        response = self.client.get("/")
        self.assertEqual(response.status_code, 200)

    def test_url_exists_at_correct_location_detailview(self):
        response = self.client.get(self.post.get_absolute_url())
        self.assertEqual(response.status_code, 200)

    def test_post_listview(self):
        response = self.client.get(reverse("home"))
        self.assertEqual(response.status_code, 200)
        self.assertContains(response, "Nice body content")
        self.assertTemplateUsed(response, "home.html")

    def test_post_detailview(self):
        response = self.client.get(reverse("post_detail", kwargs={"pk": self.post.pk}))
        no_response = self.client.get("/post/100000/")
        self.assertEqual(response.status_code, 200)
        self.assertEqual(no_response.status_code, 404)
        self.assertContains(response, "A good title")
        self.assertTemplateUsed(response, "post_detail.html")


    def test_post_view_increments_view_count(self):
        self.assertEqual(self.post.view_count, 0)
        self.client.get(self.post.get_absolute_url())
        self.post.refresh_from_db()
        self.assertEqual(self.post.view_count, 1)
        self.assertEqual(PostView.objects.filter(post=self.post).count(), 1)


class SearchTests(TestCase):
    @classmethod
    def setUpTestData(cls):
        cls.user = get_user_model().objects.create_user("author", password="secret")
        cls.post_django = Post.objects.create(
            title="Belajar Django", body="Tutorial framework web", author=cls.user
        )
        cls.post_flask = Post.objects.create(
            title="Belajar Flask", body="Framework mikro python", author=cls.user
        )

    def test_search_filters_by_title(self):
        response = self.client.get(reverse("home"), {"q": "Flask"})
        self.assertContains(response, "Belajar Flask")
        self.assertNotContains(response, "Belajar Django")

    def test_ajax_search_returns_json(self):
        response = self.client.get(
            reverse("home"), {"q": "Flask"}, HTTP_X_REQUESTED_WITH="XMLHttpRequest"
        )
        self.assertEqual(response.status_code, 200)
        self.assertEqual(response["Content-Type"], "application/json")
        data = response.json()
        self.assertEqual(data["count"], 1)
        self.assertIn("Belajar Flask", data["html"])

    def test_normal_request_does_not_return_json(self):
        response = self.client.get(reverse("home"))
        self.assertEqual(response["Content-Type"], "text/html; charset=utf-8")




class NestedCommentTests(TestCase):
    @classmethod
    def setUpTestData(cls):
        cls.author = get_user_model().objects.create_user("postauthor", password="secret")
        cls.commenter = get_user_model().objects.create_user("commenter", password="secret")
        cls.other_user = get_user_model().objects.create_user("other", password="secret")
        cls.post = Post.objects.create(
            title="Artikel Komentar", body="isi", author=cls.author
        )

    def test_anonymous_cannot_comment(self):
        response = self.client.post(
            self.post.get_absolute_url(), {"body": "halo"}
        )
        self.assertEqual(response.status_code, 302)
        self.assertIn("/accounts/login/", response.url)
        self.assertEqual(Comment.objects.count(), 0)

    def test_authenticated_user_can_comment(self):
        self.client.login(username="commenter", password="secret")
        response = self.client.post(
            self.post.get_absolute_url(), {"body": "Komentar pertama", "parent_id": ""}
        )
        self.assertEqual(response.status_code, 302)
        self.assertEqual(Comment.objects.count(), 1)
        comment = Comment.objects.first()
        self.assertEqual(comment.body, "Komentar pertama")
        self.assertIsNone(comment.parent)

    def test_nested_reply_three_levels(self):
        self.client.login(username="commenter", password="secret")
        self.client.post(
            self.post.get_absolute_url(), {"body": "Level 1", "parent_id": ""}
        )
        level1 = Comment.objects.get(body="Level 1")

        self.client.post(
            self.post.get_absolute_url(),
            {"body": "Level 2", "parent_id": level1.id},
        )
        level2 = Comment.objects.get(body="Level 2")
        self.assertEqual(level2.parent_id, level1.id)

        self.client.post(
            self.post.get_absolute_url(),
            {"body": "Level 3", "parent_id": level2.id},
        )
        level3 = Comment.objects.get(body="Level 3")
        self.assertEqual(level3.parent_id, level2.id)
        self.assertTrue(level3.is_reply)

        # Pastikan ketiganya tampil di halaman detail (rendering bersarang).
        response = self.client.get(self.post.get_absolute_url())
        self.assertContains(response, "Level 1")
        self.assertContains(response, "Level 2")
        self.assertContains(response, "Level 3")

    def test_only_owner_or_staff_can_delete_comment(self):
        comment = Comment.objects.create(
            post=self.post, author=self.commenter, body="Punya commenter"
        )

        # User lain mencoba hapus -> gagal (tetap ada).
        self.client.login(username="other", password="secret")
        self.client.post(reverse("delete_comment", kwargs={"pk": comment.pk}))
        self.assertTrue(Comment.objects.filter(pk=comment.pk).exists())

        # Pemilik komentar -> berhasil hapus.
        self.client.logout()
        self.client.login(username="commenter", password="secret")
        self.client.post(reverse("delete_comment", kwargs={"pk": comment.pk}))
        self.assertFalse(Comment.objects.filter(pk=comment.pk).exists())



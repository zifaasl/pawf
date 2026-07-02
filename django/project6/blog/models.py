from django.db import models
from django.urls import reverse
from django.conf import settings


class Post(models.Model):
    title = models.CharField(max_length=200)
    author = models.ForeignKey("auth.User", on_delete=models.CASCADE)
    body = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)
    view_count = models.PositiveIntegerField(default=0)

    class Meta:
        ordering = ["-created_at"]

    def __str__(self):
        return self.title

    def get_absolute_url(self):
        return reverse("post_detail", kwargs={"pk": self.pk})

    @property
    def comment_count(self):
        return self.comments.filter(is_approved=True).count()


class Comment(models.Model):
    """Komentar pada artikel. Mendukung balasan bersarang lewat field
    `parent`: komentar tanpa parent = komentar level-atas, komentar dengan
    parent = balasan terhadap komentar lain (bisa berlapis berapa pun
    dalamnya).
    """
    post = models.ForeignKey(Post, on_delete=models.CASCADE, related_name="comments")
    parent = models.ForeignKey(
        "self",
        on_delete=models.CASCADE,
        null=True,
        blank=True,
        related_name="replies",
    )
    author = models.ForeignKey(
        settings.AUTH_USER_MODEL,
        on_delete=models.CASCADE,
        related_name="comments",
    )
    body = models.TextField(max_length=2000)
    created_at = models.DateTimeField(auto_now_add=True)
    is_approved = models.BooleanField(default=True)

    class Meta:
        ordering = ["created_at"]

    def __str__(self):
        return f"Comment by {self.author} on {self.post}"

    @property
    def is_reply(self):
        return self.parent_id is not None


class PostView(models.Model):
    """Mencatat setiap kunjungan ke halaman detail artikel, dipakai untuk
    statistik di dashboard admin kustom (artikel terpopuler, tren harian,
    dsb).
    """
    post = models.ForeignKey(Post, on_delete=models.CASCADE, related_name="views")
    viewed_at = models.DateTimeField(auto_now_add=True)
    ip_address = models.GenericIPAddressField(null=True, blank=True)

    class Meta:
        ordering = ["-viewed_at"]

    def __str__(self):
        return f"View of {self.post} at {self.viewed_at:%Y-%m-%d %H:%M}"

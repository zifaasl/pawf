from django.contrib.auth.decorators import login_required
from django.db.models import Q
from django.core.paginator import Paginator
from django.http import JsonResponse
from django.shortcuts import get_object_or_404, redirect, render
from django.template.loader import render_to_string
from django.utils import timezone
from django.utils.html import escape

from .forms import CommentForm
from .models import Comment, Post, PostView


def post_list(request):
    """Daftar artikel + pencarian.
    Permintaan biasa -> render halaman penuh (home.html).
    Permintaan AJAX (header X-Requested-With) -> hanya mengembalikan HTML
    daftar artikel dan jumlah hasil, dipakai oleh JavaScript live-search.
    """
    query = request.GET.get("q", "").strip()
    posts = Post.objects.select_related("author")

    if query:
        posts = posts.filter(
            Q(title__icontains=query) | Q(body__icontains=query)
        )

    paginator = Paginator(posts, 6)
    page_number = request.GET.get("page", 1)
    page_obj = paginator.get_page(page_number)

    context = {
        "posts": page_obj,
        "query": query,
    }

    if request.headers.get("x-requested-with") == "XMLHttpRequest":
        html = render_to_string("home.html", {**context, "ajax": True}, request=request)
        return JsonResponse({"html": html, "count": paginator.count})

    return render(request, "home.html", context)


def _build_comment_tree(comments):
    """Susun queryset komentar flat menjadi struktur pohon
    (dict {comment: [list anak]}) untuk dirender bersarang di template.
    """
    by_id = {c.id: c for c in comments}
    tree = []
    children_map = {}
    for c in comments:
        if c.parent_id and c.parent_id in by_id:
            children_map.setdefault(c.parent_id, []).append(c)
        else:
            tree.append(c)

    def attach(node):
        node.child_list = children_map.get(node.id, [])
        for child in node.child_list:
            attach(child)

    for node in tree:
        attach(node)
    return tree


def render_comment_tree(comment_list, user):
    def render_list(items):
        if not items:
            return ""
        html = ["<ul class='comment-list'>"]
        for comment in items:
            html.append(f"<li class='comment' id='comment-{comment.id}'>")
            html.append("<div class='comment-body-box'>")
            html.append(
                f"<p class='comment-meta'><strong>{escape(comment.author)}</strong> "
                f"<span class='muted'>{escape(comment.created_at.strftime('%d %b %Y, %H:%M'))}</span></p>"
            )
            html.append(f"<p class='comment-text'>{escape(comment.body)}</p>")
            html.append("<div class='comment-actions'>")
            if user.is_authenticated:
                html.append(
                    f"<button type='button' class='reply-btn' data-comment-id='{comment.id}' "
                    f"data-author='{escape(comment.author)}'>Balas</button>"
                )
            html.append("</div>")
            html.append("</div>")
            if comment.child_list:
                html.append(render_list(comment.child_list))
            html.append("</li>")
        html.append("</ul>")
        return "".join(html)

    return render_list(comment_list)

def post_detail(request, pk):
    post = get_object_or_404(Post.objects.select_related("author"), pk=pk)

    # Catat kunjungan untuk statistik dashboard (hindari double-count
    # berlebihan dari refresh berturut-turut bukan tujuan utama di sini,
    # cukup sederhana untuk keperluan statistik dasar).
    Post.objects.filter(pk=post.pk).update(view_count=post.view_count + 1)
    PostView.objects.create(post=post, ip_address=request.META.get("REMOTE_ADDR"))

    if request.method == "POST":
        if not request.user.is_authenticated:
            return redirect("login")
        form = CommentForm(request.POST)
        if form.is_valid():
            comment = form.save(commit=False)
            comment.post = post
            comment.author = request.user
            parent_id = form.cleaned_data.get("parent_id")
            if parent_id:
                comment.parent = get_object_or_404(Comment, pk=parent_id, post=post)
            comment.save()
            return redirect(post.get_absolute_url())
    else:
        form = CommentForm()

    comments_qs = post.comments.filter(is_approved=True).select_related("author", "parent")
    comment_tree = _build_comment_tree(list(comments_qs))
    comments_html = render_comment_tree(comment_tree, request.user)

    return render(
        request,
        "post_detail.html",
        {
            "post": post,
            "form": form,
            "comments": comment_tree,
            "comment_count": comments_qs.count(),
            "comments_html": comments_html,
        },
    )


@login_required
def delete_comment(request, pk):
    comment = get_object_or_404(Comment, pk=pk)
    if request.user == comment.author or request.user.is_staff:
        post = comment.post
        comment.delete()
        return redirect(post.get_absolute_url())
    return redirect(comment.post.get_absolute_url())

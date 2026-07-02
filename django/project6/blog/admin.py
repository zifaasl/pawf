from django.contrib import admin

from .models import Comment, Post, PostView


class CommentInline(admin.TabularInline):
    model = Comment
    extra = 0
    fields = ("author", "body", "parent", "is_approved", "created_at")
    readonly_fields = ("created_at",)


@admin.register(Post)
class PostAdmin(admin.ModelAdmin):
    list_display = ("title", "author", "view_count", "comment_count", "created_at")
    search_fields = ("title", "body")
    readonly_fields = ("view_count", "created_at", "updated_at")
    inlines = [CommentInline]


@admin.register(Comment)
class CommentAdmin(admin.ModelAdmin):
    list_display = ("post", "author", "parent", "is_approved", "created_at")
    list_filter = ("is_approved", "created_at")
    search_fields = ("body", "author__username", "post__title")
    actions = ["approve_comments", "unapprove_comments"]

    @admin.action(description="Setujui komentar terpilih")
    def approve_comments(self, request, queryset):
        queryset.update(is_approved=True)

    @admin.action(description="Batalkan persetujuan komentar terpilih")
    def unapprove_comments(self, request, queryset):
        queryset.update(is_approved=False)


@admin.register(PostView)
class PostViewAdmin(admin.ModelAdmin):
    list_display = ("post", "viewed_at", "ip_address")
    list_filter = ("viewed_at",)
    search_fields = ("post__title",)

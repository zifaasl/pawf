from django.urls import path

from .views import (
    delete_comment,
    post_detail,
    post_list,
)

urlpatterns = [
    path("comment/<int:pk>/delete/", delete_comment, name="delete_comment"),
    path("post/<int:pk>/", post_detail, name="post_detail"),
    path("", post_list, name="home"),
]

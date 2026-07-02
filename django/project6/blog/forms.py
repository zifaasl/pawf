from django import forms

from .models import Comment


class CommentForm(forms.ModelForm):
    """Form untuk membuat komentar baru maupun balasan (reply).
    Field `parent_id` disisipkan sebagai hidden input lewat JS ketika
    pengguna menekan tombol "Balas" pada komentar tertentu.
    """
    parent_id = forms.IntegerField(required=False, widget=forms.HiddenInput())

    class Meta:
        model = Comment
        fields = ["body"]
        widgets = {
            "body": forms.Textarea(
                attrs={
                    "rows": 3,
                    "placeholder": "Tulis komentar...",
                    "class": "comment-input",
                }
            ),
        }

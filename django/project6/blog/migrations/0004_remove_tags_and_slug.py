from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ("blog", "0003_tag_alter_post_options_post_created_at_post_slug_and_more"),
    ]

    operations = [
        migrations.RemoveField(
            model_name="post",
            name="slug",
        ),
        migrations.RemoveField(
            model_name="post",
            name="categories",
        ),
        migrations.RemoveField(
            model_name="post",
            name="tags",
        ),
        migrations.DeleteModel(
            name="Category",
        ),
        migrations.DeleteModel(
            name="Tag",
        ),
    ]

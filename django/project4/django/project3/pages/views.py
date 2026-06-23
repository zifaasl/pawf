from django.http import HttpResponse
from django.shortcuts import render


def home_page_view(request):
	return HttpResponse("Homepage")


def about_page_view(request):
	context = {
		"name": "zifa",
		"age": 21,
	}
	return render(request, "pages/about.html", context)

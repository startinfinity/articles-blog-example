# Simple Blog website using Infinity As a CMS (database)

In this example we will build simple website using:
- Laravel Framework
- Boostrap 4 ( css framework )
- Infinity API as database

We are using Infinity as CMS for *Articles* on the website.

All the logic is located inside `app/Http/Controllers/ArticlesController.php`

Views:
- `views/articles.blade.php` - all articles view
- `views/article.blade.php`  - single article view

Run command `php artisan serve` and go to `http://127.0.0.1:8000/`

Infinity App as Database
![Board Structure](/imgs/single-article.png)

Frontend (all articles)
![Board Structure](/imgs/articles-frontend.png)

Frontend (single article)
![Board Structure](/imgs/article-frontend.png)

Blog post with more details is coming soon

References:
- [Infinity website](https://startinfinity.com)
- [Infinity API Documentation](https://devdocs.startinfinity.com/)
- [Infinity API](https://startinfinity.com/api)

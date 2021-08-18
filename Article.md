# Build Blog website using Infinity as Database

Building your own Content Managment System (CMS) for website can take a lot of time and money.

You need to build :
- Authentication
- Authorization
- Permissions
- CRUD

Using Infinity as database can help you speed up the process. You have all this features built in.
You just need to code your frontend and to pull data from Infinity insted of local database.

What are the Benefits?
- You do not have to waist time coding.
- Validation already built in.

Let's get started.

In this article i will show you how to make Blog website using infinity as database.

We will build blog index page ( page with all blog posts) and single blog post page.

In this example we will use:
- Laravel Framework ( php )
- Bootstrap 4 ( css framework )

## Step 1: Create Structure in Infinity
1. go to app.startinfinity.com
2. create new Board "Website CMS"
3. create new Folder "Articles"
4. create new View "All Articles"
5. create folder Attributes as following:
   - title - Text attribute
   - slug - Text attribute
   - description - Text attribute
   - body - Long Text attribute
   - created_at - Create At attribute

After finishing all steps you will have structure as on image below
![Board Structure](/imgs/board-structure.png)

Let's add 3 articles (items)

![Board Structure](/imgs/article-in-infinity.png)

For now we have created structure in Infinity and insert 3 Articles.
Next step is to setup the project and to connect throug Infinity API.

## Step 2: Get API

## Step 3: Install Laravel Framework

We will install new Laravel project via composer
```
composer create-project laravel/laravel infinity-blog-example
```

go inside project directory
```
cd infinity-blog-example
```

First let's create `ArticlesController` who will handle all requests.
```
php artisan make:controller ArticlesController
```

this command will make new controller in `app/Http/Controllers/ArticlesController.php`





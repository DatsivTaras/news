<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

use \App\Models\Category;
use \App\Models\News;
use \App\Models\Author;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Головна сторінка', route('/'));
});

// Home > Blog
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, Category $category) {
    $trail->parent('home');
    $trail->push($category->name, route('/'));
});

Breadcrumbs::for('news', function (BreadcrumbTrail $trail, News $news) {
    $trail->parent('home');
    $trail->push($news->title, route('/'));
});

Breadcrumbs::for('author', function (BreadcrumbTrail $trail, Author $author) {
    $trail->parent('home');
    $trail->push('Сторінка автора', route('/'));
});




<?php

declare(strict_types=1);

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('homeAdmin', function (BreadcrumbTrail $trail): void {
    $trail->push('Home Admin', route('admin.index'));
});

Breadcrumbs::for('usersAdmin', function (BreadcrumbTrail $trail): void {
    $trail->push('Users');
});

Breadcrumbs::for('homeAdmin.users', function (BreadcrumbTrail $trail): void {
    $trail->parent('homeAdmin');
    $trail->push('Users', route('admin.user.index'));
});

// intento fallido de breads
// Breadcrumbs::for('homeAdmin.users.edit', function (BreadcrumbTrail $trail) {
//     $trail->parent('homeAdmin.users');
//     $trail->push('Edit user', route('admin.user.edit'));
// });

Breadcrumbs::for('homeAdmin.users.edit', function (BreadcrumbTrail $trail, User $user): void {
    $trail->parent('homeAdmin.users');
    $trail->push($user->getName(), route('admin.user.edit', $user));
});

// // Home > Blog
// Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });

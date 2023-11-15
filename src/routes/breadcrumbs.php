<?php

declare(strict_types=1);

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//----------------products----------------
Breadcrumbs::for('products', function (BreadcrumbTrail $trail): void {
    $trail->push(__('breadcrumbs.products'), route('product.index'));
});

Breadcrumbs::for('products.show', function (BreadcrumbTrail $trail, Product $product): void {
    $trail->parent('products');
    $trail->push($product->getName(), route('product.show', $product));
});

Breadcrumbs::for('products.show.cart', function (BreadcrumbTrail $trail): void {
    $trail->parent('products');
    $trail->push(__('breadcrumbs.cart'), route('cart.index'));
});

Breadcrumbs::for('order.adress', function (BreadcrumbTrail $trail): void {
    $trail->parent('products.show.cart');
    $trail->push(__('breadcrumbs.adress'), route('user.orders.locate'));
});
//----------------------------------------

Breadcrumbs::for('wishlist', function (BreadcrumbTrail $trail): void {
    $trail->push(__('breadcrumbs.wishlist'), route('wishlist.index'));
});

//----------------admin----------------
Breadcrumbs::for('homeAdmin', function (BreadcrumbTrail $trail): void {
    $trail->push(__('breadcrumbs.homeadmin'), route('admin.index'));
});

Breadcrumbs::for('homeAdmin.users', function (BreadcrumbTrail $trail): void {
    $trail->parent('homeAdmin');
    $trail->push(__('breadcrumbs.users'), route('admin.user.index'));
});

Breadcrumbs::for('homeAdmin.users.edit', function (BreadcrumbTrail $trail, User $user): void {
    $trail->parent('homeAdmin.users');
    $trail->push($user->getName(), route('admin.user.edit', $user));
});

Breadcrumbs::for('homeAdmin.orders', function (BreadcrumbTrail $trail): void {
    $trail->parent('homeAdmin');
    $trail->push(__('breadcrumbs.orders'), route('admin.orders'));
});

Breadcrumbs::for('homeAdmin.orders.show', function (BreadcrumbTrail $trail, Order $order): void {
    $trail->parent('homeAdmin.orders');
    $trail->push((string) $order->getId(), route('admin.orders.show', $order), ['model' => $order]);
});

Breadcrumbs::for('homeAdmin.products', function (BreadcrumbTrail $trail): void {
    $trail->parent('homeAdmin');
    $trail->push(__('breadcrumbs.products'), route('admin.products'));
});

Breadcrumbs::for('homeAdmin.products.edit', function (BreadcrumbTrail $trail, Product $product): void {
    $trail->parent('homeAdmin.products');
    $trail->push($product->getName(), route('admin.product.edit', $product), ['model' => $product]);
});

Breadcrumbs::for('homeAdmin.reviews', function (BreadcrumbTrail $trail): void {
    $trail->parent('homeAdmin');
    $trail->push(__('breadcrumbs.reviews'), route('admin.reviews'));
});

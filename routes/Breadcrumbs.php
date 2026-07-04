<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

// Home > Users
Breadcrumbs::for('showUsers', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('showUsers'));
});

// Home > Users > Create
Breadcrumbs::for('createUser', function (BreadcrumbTrail $trail) {
    $trail->parent('showUsers');
    $trail->push('Create', route('createUser'));
});

// Home > User > View
Breadcrumbs::for('viewUser', function (BreadcrumbTrail $trail) {
    $userid = request()->route('id');
    // $user = UserTable::find($userid);
    $trail->parent('showUsers');
    $trail->push('View', route('viewUser', ['id' => $userid]));
});

// Home > User > Edit
Breadcrumbs::for('editUser', function (BreadcrumbTrail $trail) {
    $userID = request()->route('id');
    // $user = User::find($userID);
    $trail->parent('showUsers');
    $trail->push('Edit', route('editUser', ['id' => $userID]));
});

// // Home > Staff
// Breadcrumbs::for('manager.staff-list', function (BreadcrumbTrail $trail) {
//     $trail->parent('manager.dashboard');
//     $trail->push('Staff', route('manager.staff-list'));
// });
<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class AdminUserController extends AdminController
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users', compact('users'))->with('i');
    }
}

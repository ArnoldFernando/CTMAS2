<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function userlist()
    {
        $data = new User();
        $users = $data->all();

        return view('superadmin.user-list', compact('users'));

    }
}

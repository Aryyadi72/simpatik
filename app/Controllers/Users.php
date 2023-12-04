<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $title['title'] = "Users - Admin";
        return view ('admin/users/index', $title);
    }
}

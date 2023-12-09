<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        $title['title'] = "Login - SIMPATIK";
        return view ('login_page', ['title' => $title]);
    }
}

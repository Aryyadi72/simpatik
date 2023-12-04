<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $title['title'] = "Dashboard - Admin";
        return view('admin/admin_dash', $title);
    }
}

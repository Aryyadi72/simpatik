<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Permintaan extends BaseController
{
    public function index()
    {
        $title['title'] = "Permintaan Masuk - Admin";
        return view ('admin/permintaan/index', $title);
    }
}

<?php

namespace App\Controllers;


class Admin extends BaseController
{
    public function index()
    {

        return view('auth/login');
    }

    public function admin()
    {

        return view('admin/index');
    }
}

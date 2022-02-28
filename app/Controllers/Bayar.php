<?php

namespace App\Controllers;


class Bayar extends BaseController
{


    public function index()
    {
        return view('pages/bayar');
    }

    public function qr()
    {
        return view('pages/qr');
    }
}

<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        return view('Awal');
    }


    public function tentang()
    {
        echo "nama saya $this->pembuat.";
    }
}

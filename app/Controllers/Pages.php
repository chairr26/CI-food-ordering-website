<?php

namespace App\Controllers;

use App\Models\Menu_model;

class Pages extends BaseController
{



    public function index($nomeja = 0)
    {

        $menu_model = new Menu_model();
        $makanan = $menu_model->getMakanan();
        $minuman = $menu_model->getMinuman();
        $snack = $menu_model->getSnack();
        $data = [
            'title' => 'homenya',
            'nomeja' => $nomeja,
            'makanan' => $makanan,
            'minuman' => $minuman,
            'snack' => $snack
        ];
        return view('pages/home', $data);
    }
}

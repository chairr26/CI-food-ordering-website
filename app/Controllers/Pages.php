<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index($nomeja)
    {

        $builder = $this->db->table('menu');
        $query   = $builder->get()->getResult();
        $data = [
            'title' => 'homenya',
            'nomeja' => $nomeja,
            'menu' => $query
        ];
        return view('pages/home', $data);
    }

    public function index2()
    {

        $data = [
            'title' => 'homenya',
            'nomeja' => 0
        ];
        return view('pages/home', $data);
    }
}

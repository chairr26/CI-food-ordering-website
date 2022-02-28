<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{
    protected $table = 'menu';
    public function getMakanan()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='makanan' order by id desc");
        return $query->getResult();
    }

    public function getMinuman()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='minuman' order by id desc");
        return $query->getResult();
    }

    public function getSnack()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='snack' order by id desc");
        return $query->getResult();
    }
}

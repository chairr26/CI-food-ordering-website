<?php

namespace App\Models;

use CodeIgniter\Model;

class Menu_model extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    public function getMakanan()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='makanan' and menu_stock > '0' order by menu_id desc");
        return $query->getResult();
    }

    public function getMinuman()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='minuman' and menu_stock > '0' order by menu_id desc");
        return $query->getResult();
    }

    public function getSnack()
    {
        $query   = $this->db->query("SELECT * from menu where menu_category='snack' and menu_stock > '0' order by menu_id desc");
        return $query->getResult();
    }
}

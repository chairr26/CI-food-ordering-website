<?php

namespace App\Models;

use CodeIgniter\Model;

class Order_model extends Model
{
    protected $table = 'order';
    // protected $primaryKey = 'order_id';
    protected $useTimestamp = true;
    protected $allowedFields = ['order_id', 'table',  'price', 'status', 'qris'];

    public function getId()
    {
        $query   = $this->db->table('order');
        $query->where('order_id', '165340989851934');
        return $query;
    }
}

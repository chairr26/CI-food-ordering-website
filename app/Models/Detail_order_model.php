<?php

namespace App\Models;

use CodeIgniter\Model;

class Detail_order_model extends Model
{
    protected $table = 'detail_order';
    // protected $useTimestamps = true;
    protected $allowedFields = ['order_id', 'menu_id',  'menu_name', 'base_price', 'jumlah', 'total_price'];
}

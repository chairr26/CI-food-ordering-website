<?php

namespace App\Models;

use CodeIgniter\Model;

class Order_model extends Model
{
    protected $table = 'order';
    // protected $primaryKey = 'order_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['order_id', 'table',  'price', 'status', 'qris', 'tanggal_api'];
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailOrder extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'       => 'INT',
                'constraint' => '10',
                'auto_increment' => true,
                'auto_increment' => true
            ],
            'order_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'menu_id'          => [
                'type'           => 'int',
                'constraint'     => 30
            ],
            'menu_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => TRUE
            ],
            'base_price'       => [
                'type'       => 'FLOAT',
                'null' => TRUE
            ],
            'jumlah'       => [
                'type'       => 'int',
                'constraint' => '20'
            ],
            'total_price'      => [
                'type' => 'FLOAT'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('detail_order');
    }

    public function down()
    {
        $this->forge->dropTable('detail_order');
    }
}

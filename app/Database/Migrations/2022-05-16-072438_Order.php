<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 30
            ],
            'table'       => [
                'type'       => 'INT',
                'constraint' => '10'
            ],
            'updated_by'       => [
                'type'       => 'INT',
                'constraint' => '10',
                'null' => TRUE
            ],
            'price'       => [
                'type'       => 'FLOAT',
                'null' => TRUE
            ],
            'created_at'       => [
                'type'       => 'DATETIME'
            ],
            'updated_at'       => [
                'type'       => 'DATETIME'
            ],
            'status'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('order_id', true);
        $this->forge->createTable('order');
    }

    public function down()
    {
        $this->forge->dropTable('order');
    }
}

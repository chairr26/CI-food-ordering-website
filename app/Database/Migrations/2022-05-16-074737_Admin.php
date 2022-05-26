<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'admin_id'          => [
                'type'           => 'INT',
                'constraint'     => 30,
                'unsigned'       => true
            ],
            'username'       => [
                'type'       => 'varchar',
                'constraint' => '30'
            ],
            'password'       => [
                'type'       => 'varchar',
                'constraint' => '30'
            ],
            'created_at'       => [
                'type'       => 'DATETIME',
                'null' => TRUE
            ],

        ]);
        $this->forge->addKey('order_id', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}

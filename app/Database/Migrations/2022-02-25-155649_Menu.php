<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'menu_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_category'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'menu_price'          => [
                'type'           => 'INT',
                'constraint'     => 7,
                'unsigned'       => true,
            ],
            'menu_stock'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'menu_description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'menu_image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('menu_id', true);
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}

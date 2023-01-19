<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Airports extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'city' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'country' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('airports');
    }

    public function down()
    {
        //
        $this->forge->dropTable('airports');
    }
}
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Vuelos extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'origen' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'destino' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('vuelos');
    }

    public function down()
    {
        //
        $this->forge->dropTable('vuelos');
    }
}
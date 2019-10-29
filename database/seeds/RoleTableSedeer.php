<?php

use Illuminate\Database\Seeder;

class RoleTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
        ]);
    }
}

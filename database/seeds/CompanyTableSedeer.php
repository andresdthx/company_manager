<?php

use Illuminate\Database\Seeder;

class CompanyTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Company1',
            'address' => 'Calle 69 # 47 - 91',
            'website' => 'company.com',
            'email' => 'admin@company.com',
            'logo' => 'company.png',
        ]);
    }
}

<?php

use App\{Employee, Role};
use Illuminate\Database\Seeder;

class EmployeeTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = new Employee();
        $employee->first_name = 'Admin';
        $employee->last_name = 'manager';
        $employee->email = 'admin@admin.com';
        $employee->phone = '0957717223';
        $employee->password = bcrypt('password');
        $employee->company_id = 1;
        $employee->save();

        $role = Role::where('name', 'Administrador')->first();
        $employee->roles()->attach($role);
    }
}

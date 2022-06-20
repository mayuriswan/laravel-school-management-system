<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $user = User::create([
            'name'          => 'Admin',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('admin123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user->assignRole('Admin');

        $user2 = User::create([
            'name'          => 'Teacher',
            'email'         => 'teacher@gmail.com',
            'password'      => bcrypt('teacher123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
       

        $user3 = User::create([
            'name'          => 'Parent',
            'email'         => 'parent@gmail.com',
            'password'      => bcrypt('parent123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user3->assignRole('Parent');

        $user4 = User::create([
            'name'          => 'Student',
            'email'         => 'student@gmail.com',
            'password'      => bcrypt('student123'),
            'created_at'    => date("Y-m-d H:i:s")
        ]);
        $user4->assignRole('Student');


        

        DB::table('parents')->insert([
            [
                'user_id'           => $user3->id,
                'gender'            => 'male',
                'phone'             => '09341323339',
                'current_address'   => 'Tan-awan City',
                'permanent_address' => 'Brgy.Pasil, Himamaylan City',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

       

        DB::table('students')->insert([
            [
                'user_id'           => $user4->id,
                'parent_id'         => 1,
                'class_id'          => 1,
                'roll_number'       => 1,
                'gender'            => 'female',
                'phone'             => '09452345678',
                'dateofbirth'       => '2000-04-11',
                'current_address'   => 'Aguisan City',
                'permanent_address' => 'Himamaylan City',
                'created_at'        => date("Y-m-d H:i:s")
            ]
        ]);

    }
}

<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
 
        $superadmin = User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'phone'=> '1234567890',
            'user_id'=>'SA12345',
            'referral_id'=>'ertyfg12345',
            'referred_by'=>'abcde123245',
            'password' => bcrypt('Superadmin@1234'),
            'category'=>'Superadmin'
        ]);
        $superadmin->assignRole('Superadmin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone'=> '1234567890',
            'user_id'=>'AD12345',
            'referral_id'=>'ghijk12345',
            'referred_by'=>'ertyfg12345',
            'password' => bcrypt('Admin@1234'),
            'category'=>'Admin'
        ]);

        $admin->assignRole('Admin');

        $distributor = User::create([
            'name' => 'Distributor',
            'email' => 'distributor@gmail.com',
            'phone'=> '1234567890',
            'user_id'=>'DT12345',
            'referral_id'=>'pqrst12345',
            'referred_by'=>'ertyfg12345',
            'password' => bcrypt('Distributor@1234'),
            'category'=>'Distributor',
        ]);

        $distributor->assignRole('Distributor');

        $retailor = User::create([
            'name' => 'Retailer',
            'email' => 'retailer@gmail.com',
            'phone'=> '1234567890',
            'user_id'=>'RT12345',
            'referral_id'=>'mnopq12345',
            'referred_by'=>'pqrst12345',
            'password' => bcrypt('Retailor@1234'),
            'category'=>'Retailer'
        ]);

        $retailor->assignRole('Retailer');

        $client = User::create([
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'phone'=> '1234567890',
            'user_id'=>'CT12345',
            'referral_id'=>'rtgde12345',
            'referred_by'=>'mnopq12345',
            'password' => bcrypt('Client@1234'),
            'category'=>'Client'
        ]);

        $client->assignRole('Client');
    }
}


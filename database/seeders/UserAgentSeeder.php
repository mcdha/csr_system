<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users with bcrypt-encrypted passwords
        User::create([
            'first_name' => 'Jordan',
            'last_name' => 'Sample',
            'email' => 'agent101@gmail.com',
            'role' => 'Agent',
            'agent_code' => '101',
            // 'password' => Hash::make('agent101'), // Bcrypt encrypted password
            'password' => hash('sha256', 'agent101')
        ]);

        User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'agent102@gmail.com',
            'role' => 'Agent',
            'agent_code' => '102',
            // 'password' => Hash::make('agent102'), // Bcrypt encrypted password
            'password' => hash('sha256', 'agent102')
        ]);

        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Doe',
            'email' => 'agent103@gmail.com',
            'role' => 'Agent',
            'agent_code' => '103',
            // 'password' => Hash::make('agent103'), // Bcrypt encrypted password
            'password' => hash('sha256', 'agent103')
        ]);
    }
}

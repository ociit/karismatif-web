<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create or update the administrator configured in the environment.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (blank($email) || blank($password)) {
            $this->command?->warn('Admin user skipped: set ADMIN_EMAIL and ADMIN_PASSWORD in .env.');

            return;
        }

        $adminRole = Role::firstOrCreate(['nama_role' => 'admin']);

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Administrator'),
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'role_id' => $adminRole->id,
            ],
        );
    }
}

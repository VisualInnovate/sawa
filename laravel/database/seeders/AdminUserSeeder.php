<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // all permissions
        $allPermissions = Permission::where('guard_name', 'api')->get();
        // admin user
        DB::transaction(function () use ($allPermissions) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'title' => 'admin doctor',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
            $adminRole = Role::create(['name' => 'admin']);
            $adminRole->syncPermissions($allPermissions);
            $admin->assignRole([$adminRole->id]);
            $admin->syncPermissions($allPermissions);

            // test user
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@test.com',
                'title' => 'test doctor',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            $userRole = Role::create(['name' => 'user']);
            // get only users permissions
            $userPermissions = collect($allPermissions)->whereIn('module', [
                'register',
                'login',
                'logout',
                'password',
                'verification',
            ])->all();
            $userRole->syncPermissions($userPermissions);
            $user->assignRole([$userRole->id]);
            $user->syncPermissions($userPermissions);


            // test user
            $doctor = User::create([
                'name' => 'Doctor',
                'email' => 'doctor@doctor.com',
                'title' => 'Ear & Eye Problems',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            $doctorRole = Role::create(['name' => 'doctor']);
            // get only users permissions
            $doctorPermissions = collect($allPermissions)->whereIn('module', [
                'register',
                'login',
                'logout',
                'password',
                'verification',
                "calender",
            ])->all();
            $doctorRole->syncPermissions($doctorPermissions);
            $doctor->assignRole([$doctorRole->id]);
            $doctor->syncPermissions($doctorPermissions);
        });
    }
}

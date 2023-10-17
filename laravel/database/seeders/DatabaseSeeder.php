<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(PermissionSeeder::class);
        // $this->call(AdminUserSeeder::class);
        // $this->call(PagesSeeder::class);


        $allPermissions = Permission::where('guard_name', 'api')->get();
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
    }
}

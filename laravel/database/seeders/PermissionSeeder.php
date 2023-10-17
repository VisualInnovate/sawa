<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'api') {
                $permission = Permission::where('name', $route->getName())->first();

                if (is_null($permission)) {
                    Permission::create([
                        'name' => $route->getName(),
                        'module' => Str::before($route->getName(), '.'),
                    ]);
                }
            }
        }

        $child_permissions = Permission::select('name')->where('name', 'like', "%child%")->pluck('name');

        if ($child_permissions != null) {
            foreach ($child_permissions as $child_permission) {
                Permission::create([
                    'name' => $child_permission,
                    'module' => 'parent',
                    'guard_name' => 'parent',
                ]);
            }
        }
    }
}

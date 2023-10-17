<?php

namespace Database\Seeders;

use App\Models\SitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                "title" => "Main Page",
                "description" => "This is the main page content",
                "image" => null,
            ],
            [
                "title" => "About us Page",
                "description" => "This is the about us page content",
                "image" => null,
            ],
            [
                "title" => "Contact us Page",
                "description" => "This is the contact us page content",
                "image" => null,
            ],
            [
                "title" => "Special Education Page",
                "description" => "This is the special education page content",
                "image" => null,
            ],
        ];

        DB::table('pages')->insert($pages);
    }
}

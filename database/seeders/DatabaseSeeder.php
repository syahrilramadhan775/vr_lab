<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // $user = \App\Models\User\User::create([
        //     'username' => 'admin',
        //     'email' => 'admin@example.com',
        //     'password' => 'administrator123',
        // ]);

        // $user->detail([
        //     'no_telp' => '081280981788',
        //     'name' => "administrator"
        // ]);

        // $user->assignRole('admin');

        \App\Models\Category\Category::factory(10)->afterCreating(function (Category $category) {
            \App\Models\Content\Content::factory(10)->create(['category_id' =>  $category->id]);
        })->create();
    }
}

<?php

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
        // $this->call(UserSeeder::class);

        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('admin')
        ]);

        // App\Category::create([
        //     'name' => 'Otros'
        // ]);

        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}

<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@email.com'
        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

        // Listing::create(
        //     [
        //         'title'=> 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit',
        //         'tags' => '',
        //         'company' => '',
        //         'location' => '',
        //         'email' => '',
        //         'website' => '',
        //         'description'=> 'quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto'
        //     ]);

        // Listing::create(
        //         [
        //         'title'=> 'qui est esse',
        //         'tags' => '',
        //         'company' => '',
        //         'location' => '',
        //         'email' => '',
        //         'website' => '',
        //         'description'=> 'est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla'
        //         ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

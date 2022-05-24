<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
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

        User::factory()->silvestri()->create();
        User::factory(4)->create();
        foreach (User::all() as $user) {
            $announcements = Announcement::factory(10)->make();
            foreach ($announcements as $announcement) {
                $announcement->user_id = $user->id;
                $announcement->save();
            }
        }


        /*
        Announcement::create(
            [
                'title' => 'Big Bash!',
                'tags' => 'party',
                'school' => 'Engineering',
                'email' => 'tonysilvestri@bytecodeman.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
            ]
        );
        \App\Models\Announcement::create(
            [
                'title' => 'Another Big Bash!',
                'tags' => 'party',
                'school' => 'Liberal Arts',
                'email' => 'tonysilvestri@bytecodeman.com',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
            ]
        );
        */
    }
}

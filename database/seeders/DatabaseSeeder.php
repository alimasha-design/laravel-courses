<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Create admin user
        User::create([
                'name' => 'Admin',
                'email' => 'alimashadesign@gmail.com',
                'password' => bcrypt('123'),
                'type' => 1,
            ]);

        $series = ['PHP', 'JavaScript', 'Laravel', 'Python', 'React', 'WordPress', 'Swift'];
        $series = [
            [
                'name'=>'PHP',
                'image'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png'
            ],
            [
                'name'=>'JavaScript',
                'image'=>'https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png'
            ],
            [
                'name'=>'Laravel',
                'image'=>'https://upload.wikimedia.org/wikipedia/commons/3/36/Logo.min.svg'
            ],
            [
                'name'=>'Python',
                'image'=>'https://www.python.org/static/community_logos/python-logo-master-v3-TM-flattened.png'
            ],
            [
                'name'=>'React',
                'image'=>'https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg'
            ],
            [
                'name'=>'WordPress',
                'image'=>'https://upload.wikimedia.org/wikipedia/commons/2/20/WordPress_logo.svg'
            ]
        ];

        foreach ($series as $item){
            $slug = strtolower(str_replace(' ', '-', $item['name']));
            Series::create([
                'name' => $item['name'],
                'image' => $item['image'],
                'slug' => $slug
            ]);
        }

        $topics = ['Eloquent', 'Validation', 'Refactoring', 'Testing', 'Authentication'];

        foreach ($topics as $item){
            $slug = strtolower(str_replace(' ', '-', $item));
            Topic::create([
                'name' => $item,
                'slug' => $slug
            ]);
        }
        $platforms = ['Youtube', 'Laracasts', 'Laravel.io', 'Laracasts News', 'Larajobs'];

        foreach ($platforms as $item){
            Platform::create([
                'name' => $item
            ]);
        }
//        $authors = ['Ali Ahammed', 'Jack', '', 'Rose'];
//
//        foreach ($authors as $item){
//            Author::create([
//                'name' => $item
//            ]);
//        }


        // Create 10 authors
        Author::factory(10)->create();




        // Create 50 users
        User::factory(50)->create();


        // Create 100 courses
        Course::factory(100)->create();

        $courses = Course::all();
        foreach ($courses as $course){

            $topic = Topic::all()->random(rand(1, 5))->pluck('id')->toArray();
            $course->topic()->attach($topic);

            $series = Series::all()->random(rand(1, 5))->pluck('id')->toArray();
            $course->series()->attach($series);

            $authors = Author::all()->random(rand(1, 3))->pluck('id')->toArray();
            $course->author()->attach($authors);


        }


        // Create 100 review
        Review::factory(100)->create();
    }
}

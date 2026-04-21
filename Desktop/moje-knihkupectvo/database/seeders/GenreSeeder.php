<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Beletria', 'slug' => 'beletria', 'display_order' => 1],
            ['name' => 'Detektívky', 'slug' => 'detektivky', 'display_order' => 2],
            ['name' => 'Fantasy', 'slug' => 'fantasy', 'display_order' => 3],
            ['name' => 'Sci-fi', 'slug' => 'sci-fi', 'display_order' => 4],
            ['name' => 'Pre deti', 'slug' => 'pre-deti', 'display_order' => 5],
            ['name' => 'Životopisy', 'slug' => 'zivotopisy', 'display_order' => 6],
            ['name' => 'Odborná literatúra', 'slug' => 'odborna-literatura', 'display_order' => 7],
            ['name' => 'Romantika', 'slug' => 'romantika', 'display_order' => 8],
            ['name' => 'Horror', 'slug' => 'horror', 'display_order' => 9],
            ['name' => 'Klasika', 'slug' => 'klasika', 'display_order' => 10],
        ];

        foreach ($genres as $genre) {
            Genre::updateOrCreate(
                ['slug' => $genre['slug']],
                $genre
            );
        }
    }
}
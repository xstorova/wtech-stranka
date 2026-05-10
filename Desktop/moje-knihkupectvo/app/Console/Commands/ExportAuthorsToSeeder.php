<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Author;
use Illuminate\Support\Facades\File;

class ExportAuthorsToSeeder extends Command
{
    protected $signature = 'db:export-authors';
    protected $description = 'Exportuje aktuálnych autorov z databázy do AuthorSeeder.php';

    public function handle()
    {
        $authors = Author::all()->map(function ($author) {
            return [
                'name' => $author->name,
                'slug' => $author->slug,
                'bio' => $author->bio,
                'photo' => $author->photo,
                'website' => $author->website,
                'is_active' => (bool) $author->is_active,
                'rating' => (float) $author->rating,
            ];
        })->toArray();

        $dataString = var_export($authors, true);
        $dataString = str_replace("array (", "[", $dataString);
        $dataString = str_replace("),", "],", $dataString);
        $dataString = preg_replace("/\s+=>\s+/", " => ", $dataString);
        $dataString = rtrim($dataString, ")");
        $dataString .= "]";

        $template = "<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        \$authors = " . $dataString . ";

        foreach (\$authors as \$authorData) {
            Author::updateOrCreate(
                ['slug' => \$authorData['slug']],
                \$authorData
            );
        }

        // Prepojenie existujúcich kníh s autormi podľa mena
        \$books = Book::all();
        foreach (\$books as \$book) {
            \$author = Author::where('name', \$book->author)->first();
            if (\$author) {
                \$book->update(['author_id' => \$author->id]);
            }
        }

        // Aktualizácia počtu kníh pre každého autora
        \$allAuthors = Author::all();
        foreach (\$allAuthors as \$author) {
            \$count = Book::where('author_id', \$author->id)->count();
            \$author->update(['book_count' => \$count]);
        }
    }
}";

        File::put(database_path('seeders/AuthorSeeder.php'), $template);

        $this->info('AuthorSeeder.php bol úspešne aktualizovaný podľa databázy! (' . count($authors) . ' autorov)');
    }
}
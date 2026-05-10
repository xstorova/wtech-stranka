<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class ExportBooksToSeeder extends Command
{
    protected $signature = 'db:export-books';
    protected $description = 'Exportuje aktuálne knihy z databázy do BookSeeder.php';

    public function handle()
    {
        $books = Book::with('genres')->get()->map(function ($book) {
            return [
                'title' => $book->title,
                'author' => $book->author,
                'price' => (float) $book->price,
                'discount' => (int) $book->discount,
                'description' => $book->description,
                'image' => $book->image,
                'category' => $book->category,
                'status' => $book->status,
                'is_new' => (bool) $book->is_new,
                'is_preorder' => (bool) $book->is_preorder,
                'is_bestseller' => (bool) $book->is_bestseller,
                'published_at' => $book->published_at ? $book->published_at->toDateString() : null,
                'preorder_date' => $book->preorder_date ? $book->preorder_date->toDateString() : null,
                'genres' => $book->genres->pluck('slug')->toArray(),
            ];
        })->toArray();

        $dataString = var_export($books, true);
        $dataString = str_replace("array (", "[", $dataString);
        $dataString = str_replace("),", "],", $dataString);
        $dataString = preg_replace("/\s+=>\s+/", " => ", $dataString);
        $dataString = rtrim($dataString, ")");
        $dataString .= "]";

        $template = "<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class BookSeeder extends Seeder {
    public function run() {
        Book::truncate();

        \$books = " . $dataString . ";

        foreach (\$books as \$bookData) {
            \$genreSlugs = \$bookData['genres'] ?? [];
            unset(\$bookData['genres']);

            \$book = Book::create(\$bookData);

            \$genreIds = Genre::whereIn('slug', \$genreSlugs)->pluck('id');
            \$book->genres()->sync(\$genreIds);
        }
    }
}";

        File::put(database_path('seeders/BookSeeder.php'), $template);

        $this->info('BookSeeder.php bol úspešne aktualizovaný podľa databázy!');
    }
}
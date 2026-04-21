<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Facades\File;

class ExportBooksToSeeder extends Command
{
    // Príkaz, ktorý budeš spúšťať v termináli
    protected $signature = 'db:export-books';
    protected $description = 'Exportuje aktuálne knihy z databázy do BookSeeder.php';

    public function handle()
    {
        $books = Book::all()->map(function ($book) {
            return [
                'title' => $book->title,
                'author' => $book->author,
                'price' => (float)$book->price,
                'discount' => (int)$book->discount,
                'description' => $book->description,
                'image' => $book->image,
                'category' => $book->category,
                'status' => $book->status,
                'is_new' => (bool)$book->is_new,
                'is_preorder' => (bool)$book->is_preorder,
            ];
        })->toArray();

        // Vygenerovanie PHP kódu z poľa
        $dataString = var_export($books, true);

        // Formátovanie: array() -> [], lepšie odsadenie
        $dataString = str_replace("array (", "[", $dataString);
        $dataString = str_replace("),", "],", $dataString);
        $dataString = preg_replace("/\s+=>\s+/", " => ", $dataString);
        $dataString = rtrim($dataString, ")");
        $dataString .= "]";

        $template = "<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder {
    public function run() {
        // Vymazanie starých záznamov, aby sme nemali duplikáty pri opätovnom seedovaní
        Book::truncate();

        \$books = " . $dataString . ";

        foreach (\$books as \$book) {
            Book::create(\$book);
        }
    }
}";

        // Cesta k seederu
        File::put(database_path('seeders/BookSeeder.php'), $template);

        $this->info('BookSeeder.php bol úspešne aktualizovaný podľa databázy!');
    }
}
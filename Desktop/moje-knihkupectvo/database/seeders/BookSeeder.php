<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder {
    public function run() {
        Book::truncate();
        $books = [
            [
                'title' => 'The Cruel Prince',
                'author' => 'Holly Black',
                'price' => 16.90,
                'discount' => 12,
                'description' => 'Fantasy román o vílach a intrikách v magickom svete Elfhame.',
                'image' => 'https://mrtns.sk/tovar/_l/437/l437793.jpg',
                'category' => 'Fantasy',
                'status' => 'active'
            ],
            [
                'title' => 'Throne of Glass',
                'author' => 'Sarah J. Maas',
                'price' => 18.50,
                'discount' => 19,
                'description' => 'Dobrodružná fantasy séria o nájomnej vrahyňi Celaene.',
                'image' => 'https://mrtns.sk/tovar/_l/179/l179883.jpg?v=17766609162',
                'category' => 'Fantasy',
                'status' => 'active'
            ],
            [
                'title' => 'Harry Potter a Kameň mudrcov',
                'author' => 'J.K. Rowling',
                'price' => 12.99,
                'discount' => 0,
                'description' => 'Prvá časť slávnej série o mladom čarodejníkovi.',
                'image' => 'https://mrtns.sk/tovar/_l/2613/l2613775.jpg?v=17766604052',
                'category' => 'Fantasy',
                'status' => 'active'
            ],
            [
                'title' => 'Pán prsteňov - Spoločenstvo prsteňa',
                'author' => 'J.R.R. Tolkien',
                'price' => 14.50,
                'discount' => 15,
                'description' => 'Epická fantasy o putovaní za zničením Jedného prsteňa.',
                'image' => 'https://mrtns.sk/tovar/_l/134/l134260.jpg?v=17766609162',
                'category' => 'Fantasy',
                'status' => 'active'
            ],
            [
                'title' => 'Hry o život',
                'author' => 'Suzanne Collins',
                'price' => 11.90,
                'discount' => 20,
                'description' => 'Dystopický príbeh o boji o prežitie v televíznej aréne.',
                'image' => 'https://mrtns.sk/tovar/_l/2837/l2837335.jpg?v=17766604052',
                'category' => 'Sci-fi',
                'status' => 'active'
            ],
            [
                'title' => 'Divergencia',
                'author' => 'Veronica Roth',
                'price' => 10.90,
                'discount' => 10,
                'description' => 'Príbeh o spoločnosti rozdelenej na frakcie podľa povahy.',
                'image' => 'https://mrtns.sk/tovar/_l/114/l114860.jpg?v=17766609162',
                'category' => 'Sci-fi',
                'status' => 'active'
            ],
            [
                'title' => 'Mr Wrong Number',
                'author' => 'Lynn Painter',
                'price' => 13.90,
                'discount' => 0,
                'description' => 'Bad luck has always followed Olivia. But when a steamy text from a random number..',
                'image' => 'https://mrtns.sk/tovar/_xl/1617/xl1617829.jpg?v=17766604162',
                'category' => 'Beletria',
                'status' => 'active'
            ],
            [
                'title' => 'Malý princ',
                'author' => 'Antoine de Saint-Exupéry',
                'price' => 7.50,
                'discount' => 5,
                'description' => 'Filozofický príbeh o priateľstve a láske.',
                'image' => 'https://mrtns.sk/tovar/_l/3395/l3395581.jpg?v=17766715842',
                'category' => 'Beletria',
                'status' => 'active'
            ],
            [
                'title' => 'Da Vinciho kód',
                'author' => 'Dan Brown',
                'price' => 13.90,
                'discount' => 25,
                'description' => 'Triler plný tajomstiev, symbolov a nečakaných zvratov.',
                'image' => 'https://mrtns.sk/tovar/_l/148/l148928.jpg?v=17766609162',
                'category' => 'Detektívky',
                'status' => 'active'
            ],
            [
                'title' => 'Štvrté krídlo',
                'author' => 'Rebecca Yarros',
                'price' => 19.90,
                'discount' => 0,
                'description' => 'Romantická fantasy o akadémii drakov.',
                'image' => 'https://mrtns.sk/tovar/_l/2210/l2210647.jpg?v=17766604092',
                'category' => 'Fantasy',
                'status' => 'active'
            ],
            [
                'title' => 'Pýcha a predsudok',
                'author' => 'Jane Austen',
                'price' => 8.90,
                'discount' => 0,
                'description' => 'Klasický román o láske a spoločenských konvenciách.',
                'image' => 'https://mrtns.sk/tovar/_l/2778/l2778317.jpg?v=17763321622',
                'category' => 'Beletria',
                'status' => 'active'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
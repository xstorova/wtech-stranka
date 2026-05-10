<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Vyhľadávanie podľa textu
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ['%' . mb_strtolower($search) . '%'])
                ->orWhereRaw('LOWER(author) LIKE ?', ['%' . mb_strtolower($search) . '%'])
                ->orWhereRaw('LOWER(series) LIKE ?', ['%' . mb_strtolower($search) . '%']);
            });
        }

        // AND LOGIKA: Kniha musí mať VŠETKY vybrané žánre
        if ($request->has('zaner') && !empty($request->zaner)) {
            $genreSlugs = is_array($request->zaner) ? $request->zaner : [$request->zaner];
            
            // Pre každý vybraný žáner pridáme whereHas – kniha musí mať všetky
            foreach ($genreSlugs as $slug) {
                $query->whereHas('genres', function($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            }
        }

        // ZĽAVA
        if ($request->has('zlava') && $request->zlava == 'ano') {
            $query->where('discount', '>', 0);
        }

        // CENA
        if ($request->has('cena_od') && is_numeric($request->cena_od)) {
            $query->where('price', '>=', $request->cena_od);
        }
        if ($request->has('cena_do') && is_numeric($request->cena_do)) {
            $query->where('price', '<=', $request->cena_do);
        }

        // ZORADENIE
        if ($request->has('zoradit')) {
            switch($request->zoradit) {
                case 'cena-vzostupne': $query->orderBy('price', 'asc'); break;
                case 'cena-zostupne': $query->orderBy('price', 'desc'); break;
                case 'nazov-az': $query->orderBy('title', 'asc'); break;
                case 'nazov-za': $query->orderBy('title', 'desc'); break;
                default: $query->latest();
            }
        } else {
            $query->latest();
        }

        $books = $query->with('authorModel')->paginate(6);
        
        // Žánre pre filtre
        $genres = Genre::orderBy('display_order')->get();

        $carouselBooks = Book::where('status', 'active')->inRandomOrder()->limit(12)->get();

        return view('hlavna_stranka', compact('books', 'genres', 'carouselBooks'));
    }

        public function show($id)
{
    $book = Book::with('authorModel')->findOrFail($id);
    
    $seriesBooks = collect();
    if (!empty($book->series)) {
        $seriesBooks = Book::where('series', $book->series)
            ->where('id', '!=', $book->id)
            ->where('status', 'active')
            ->orderBy('published_at', 'asc')
            ->get();
    }
    
    $relatedBooks = collect();
    if ($seriesBooks->isEmpty()) {
        $relatedBooks = Book::where('id', '!=', $book->id)
            ->where(function($query) use ($book) {
                if ($book->author_id) {
                    $query->where('author_id', $book->author_id);
                } else {
                    $query->where('author', $book->author);
                }
            })
            ->where('status', 'active')
            ->limit(8)
            ->get();
    }
    
    $carouselBooks = Book::where('status', 'active')->inRandomOrder()->limit(12)->get();
    
    return view('detajl_knihy', compact('book', 'seriesBooks', 'relatedBooks', 'carouselBooks'));
}

    public function adminIndex()
    {
        $books = Book::all();
        return view('admin', compact('books'));
    }

    public function create() {
        $genres = Genre::all();
        return view('admin_pridanie_knihy', ['genres' => $genres, 'all_genres' => $genres]);
    }

        public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|integer',
            'description' => 'nullable',
            'status' => 'required',
            'language' => 'nullable|string',
            'binding' => 'nullable|string',
            'series' => 'nullable|string',
            'series_number' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string',
            'page_count' => 'nullable|integer|min:1',
            'gallery.*' => 'nullable|image|max:2048', 
        ]);

        $data['series_number'] = $request->filled('series_number') ? (int) $request->input('series_number') : null;

        $data['is_new'] = $request->boolean('is_new');
        $data['is_preorder'] = $request->boolean('is_preorder');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['published_at'] = $request->published_at;
        $data['preorder_date'] = $request->preorder_date;
        $data['language'] = $request->language;
        $data['binding'] = $request->binding;
        $data['series'] = $request->series;
        $data['publisher'] = $request->publisher;
        $data['page_count'] = $request->page_count;

        // HLAVNÝ OBRÁZOK
        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')->store('books', 'public');
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        // GALÉRIA - viac fotiek z počítača
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('books/gallery', 'public');
                $gallery[] = $path;
            }
        }
        $data['gallery'] = $gallery;

        $book = Book::create($data);

        $author = \App\Models\Author::where('name', $data['author'])->first();
        if ($author) {
            $book->update(['author_id' => $author->id]);    
        }

        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        }

        // Aktualizuj book_count autora
        if ($book->author_id) {
            $author = \App\Models\Author::find($book->author_id);
            if ($author) {
                $author->update(['book_count' => \App\Models\Book::where('author_id', $author->id)->count()]);
            }
        }

        return redirect('/admin')->with('success', 'Kniha pridaná');
    }

    public function edit($id) {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        $selectedGenres = $book->genres->pluck('id')->toArray();
        return view('admin_uprava_knihy', compact('book', 'genres', 'selectedGenres'));
    }

        public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|integer',
            'description' => 'nullable',
            'status' => 'required',
            'language' => 'nullable|string',
            'binding' => 'nullable|string',
            'series' => 'nullable|string',
            'series_number' => 'nullable|integer|min:1',
            'publisher' => 'nullable|string',
            'page_count' => 'nullable|integer|min:1',
            'gallery_new.*' => 'nullable|image|max:2048',
        ]);

        $data['series_number'] = $request->filled('series_number') ? (int) $request->input('series_number') : null;

        $data['is_new'] = $request->boolean('is_new');
        $data['is_preorder'] = $request->boolean('is_preorder');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['published_at'] = $request->published_at;
        $data['preorder_date'] = $request->preorder_date;
        $data['language'] = $request->language;
        $data['binding'] = $request->binding;
        $data['series'] = $request->series;
        $data['series_number'] = $request->filled('series_number') ? (int) $request->series_number : null;
        $data['publisher'] = $request->publisher;
        $data['page_count'] = $request->page_count;

        // HLAVNÝ OBRÁZOK
        if ($request->hasFile('image_file')) {
            if ($book->image && !str_starts_with($book->image, 'http')) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image_file')->store('books', 'public');
        } elseif ($request->filled('image_url')) {
            if ($book->image && !str_starts_with($book->image, 'http')) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->input('image_url');
        }

        // GALÉRIA - správa existujúcich + nových fotiek
        $gallery = $book->gallery ?? [];
        
        // Odstráň fotky označené na zmazanie
        if ($request->has('remove_gallery')) {
            foreach ($request->input('remove_gallery') as $path) {
                Storage::disk('public')->delete($path);
                $gallery = array_diff($gallery, [$path]);
            }
        }
        
        // Pridaj nové fotky
        if ($request->hasFile('gallery_new')) {
            foreach ($request->file('gallery_new') as $image) {
                $path = $image->store('books/gallery', 'public');
                $gallery[] = $path;
            }
        }
        
        $data['gallery'] = array_values($gallery); // Reindexuj pole

        $book->update($data);

        $author = \App\Models\Author::where('name', $data['author'])->first();
        if ($author) {
            $book->update(['author_id' => $author->id]);
        } else {
            $book->update(['author_id' => null]);
        }

        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        } else {
            $book->genres()->detach();
        }

        // Aktualizuj book_count – treba prepočítať aj starého autora (ak sa autor zmenil)
        \App\Models\Author::all()->each(function($a) {
            $a->update(['book_count' => \App\Models\Book::where('author_id', $a->id)->count()]);
        });

        return redirect('/admin')->with('success', 'Kniha upravená');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        if ($book->image && !str_starts_with($book->image, 'http')) {
            Storage::disk('public')->delete($book->image);
        }
        
        $book->genres()->detach();
        $book->delete();

        // Aktualizuj book_count autora po vymazaní
        if ($book->author_id) {
            $author = \App\Models\Author::find($book->author_id);
            if ($author) {
                $author->update(['book_count' => \App\Models\Book::where('author_id', $author->id)->count()]);
            }
        }

        return redirect('/admin')->with('success', 'Kniha zmazaná');
    }
}
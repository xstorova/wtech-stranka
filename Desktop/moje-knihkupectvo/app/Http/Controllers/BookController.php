<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::where('status', 'active');

        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('kategoria') && !empty($request->kategoria)) {
            $query->where('category', $request->kategoria);
        }

        if ($request->has('zlava') && $request->zlava == 'ano') {
            $query->where('discount', '>', 0);
        }

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

        $books = $query->paginate(6);
        $categories = Book::where('status', 'active')->distinct()->pluck('category');

        return view('hlavna_stranka', compact('books', 'categories'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('detajl_knihy', compact('book'));
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
            'image' => 'nullable',
            'category' => 'required',
            'status' => 'required',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_preorder'] = $request->boolean('is_preorder');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['published_at'] = $request->published_at;
        $data['preorder_date'] = $request->preorder_date;

        $book = Book::create($data);

        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
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
            'image' => 'nullable',
            'category' => 'required',
            'status' => 'required',
        ]);

        $data['is_new'] = $request->boolean('is_new');
        $data['is_preorder'] = $request->boolean('is_preorder');
        $data['is_bestseller'] = $request->boolean('is_bestseller');
        $data['published_at'] = $request->published_at;
        $data['preorder_date'] = $request->preorder_date;

        $book->update($data);

        if ($request->has('genres')) {
            $book->genres()->sync($request->genres);
        } else {
            $book->genres()->detach();
        }

        return redirect('/admin')->with('success', 'Kniha upravená');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->genres()->detach();
        $book->delete();

        return redirect('/admin')->with('success', 'Kniha zmazaná');
    }
}
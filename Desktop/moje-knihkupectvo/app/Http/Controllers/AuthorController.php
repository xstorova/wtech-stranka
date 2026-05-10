<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    // Verejný pohľad - stránka autora
    public function show($slug)
    {
        $author = Author::where('slug', $slug)->firstOrFail();
        
        $books = Book::where(function($query) use ($author) {
                $query->where('author_id', $author->id)
                      ->orWhere('author', $author->name);
            })
            ->where('status', 'active')
            ->get();
        
        if ($author->book_count != $books->count()) {
            $author->update(['book_count' => $books->count()]);
        }
        
        $carouselBooks = Book::where('status', 'active')
            ->where(function($q) use ($author) {
                $q->where('author_id', '!=', $author->id)
                  ->orWhere('author', '!=', $author->name);
            })
            ->inRandomOrder()
            ->limit(12)
            ->get();
        
        return view('autor', compact('author', 'books', 'carouselBooks'));
    }

    // ========== ADMIN ČASŤ ==========
    
    public function adminIndex()
    {
        $authors = Author::orderBy('name')->get();
        return view('admin_autori', compact('authors'));
    }

    public function create()
    {
        return view('admin_pridanie_autora');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:authors',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string',
            'website' => 'nullable|url',
            'is_active' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        $data['is_active'] = $request->boolean('is_active');

        Author::create($data);

        return redirect('/admin/autori')->with('success', 'Autor pridaný');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('admin_uprava_autora', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:authors,slug,'.$author->id,
            'bio' => 'nullable|string',
            'photo' => 'nullable|string',
            'website' => 'nullable|url',
            'is_active' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        $data['is_active'] = $request->boolean('is_active');

        $author->update($data);

        Book::where('author_id', $author->id)->update(['author' => $author->name]);

        return redirect('/admin/autori')->with('success', 'Autor upravený');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        
        Book::where('author_id', $author->id)->update(['author_id' => null]);
        
        $author->delete();

        return redirect('/admin/autori')->with('success', 'Autor zmazaný');
    }
}
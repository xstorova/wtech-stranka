@extends('layouts.app')

@section('title', 'Admin - Správa kníh')

@section('content')
<main class="admin-container">
    <div class="admin-header">
        <div>
            <h1 class="admin-title"><i class="fas fa-cog"></i> Admin rozhranie</h1>
            <a href="{{ url('/') }}" style="color: #666; text-decoration: none; font-size: 0.9rem;"><i class="fas fa-eye"></i> Prejsť do používateľského náhľadu</a>
        </div>
        <a href="{{ url('/admin/knihy/pridat') }}" class="btn-add"><i class="fas fa-plus"></i> Pridať novú knihu</a>
    </div>

    <div class="books-table">
        <table>
            <thead>
                <tr>
                    <th>Obálka</th>
                    <th>Názov knihy</th>
                    <th>Autor</th>
                    <th>Pôvodná cena</th>
                    <th>Zľava</th>
                    <th>Finálna cena</th>
                    <th>Stav</th>
                    <th>Akcie</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>
                        <div class="book-thumb">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}">
                            @endif
                        </div>
                    </td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td>{{ number_format($book->price, 2) }} €</td>
                    <td>
                        @if($book->discount > 0)
                            <span class="discount-badge">-{{ $book->discount }}%</span>
                        @endif
                    </td>
                    <td><span class="price-final">{{ number_format($book->final_price, 2) }} €</span></td>
                    <td>
                        <span class="status-{{ $book->status == 'active' ? 'active' : 'inactive' }}">
                            <i class="fas fa-check-circle"></i> {{ $book->status == 'active' ? 'Aktívna' : 'Neaktívna' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ url('/admin/knihy/'.$book->id.'/upravit') }}" class="btn-edit"><i class="fas fa-edit"></i> Upraviť</a>
                            <form method="POST" action="{{ url('/admin/knihy/'.$book->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Naozaj chcete zmazať túto knihu?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
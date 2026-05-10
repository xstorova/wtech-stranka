@extends('layouts.app')



@section('title', 'Admin - Správa kníh')

@section('content')
<main class="admin-container">
    <div class="admin-header">
        <div>
            <h1 class="admin-title"><i class="fas fa-cog"></i> Admin rozhranie - Knihy</h1>
            <a href="{{ url('/') }}" class="admin-view-link"><i class="fas fa-eye"></i> Prejsť do používateľského náhľadu</a>
        </div>
        <div class="admin-actions">
            @if(request()->is('admin/autori') || request()->is('admin/autori/*'))
                <a href="{{ url('/admin/autori/pridat') }}" class="btn-add"><i class="fas fa-user-plus"></i> Pridať autora</a>
                <a href="{{ url('/admin/knihy/pridat') }}" class="btn-add btn-add-secondary"><i class="fas fa-plus"></i> Pridať novú knihu</a>
            @else
                <a href="{{ url('/admin/autori/pridat') }}" class="btn-add btn-add-secondary"><i class="fas fa-user-plus"></i> Pridať autora</a>
                <a href="{{ url('/admin/knihy/pridat') }}" class="btn-add"><i class="fas fa-plus"></i> Pridať novú knihu</a>
            @endif
        </div>
    </div>

    <!-- ZÁLOŽKY -->
    <div class="admin-tabs">
        <a href="{{ url('/admin') }}" class="admin-tab {{ request()->is('admin') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Knihy
        </a>
        <a href="{{ url('/admin/autori') }}" class="admin-tab {{ request()->is('admin/autori') || request()->is('admin/autori/*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Autori
        </a>
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
                    <td data-label="">
                        <div class="book-thumb">
                            @if($book->image)
                                <img src="{{ $book->image }}" alt="{{ $book->title }}">
                            @endif
                        </div>
                        <div class="mobile-book-info">
                            <strong class="mobile-title">{{ $book->title }}</strong>
                            <span class="mobile-author">{{ $book->author }}</span>
                        </div>
                    </td>
                    <td data-label="Názov"><strong>{{ $book->title }}</strong></td>
                    <td data-label="Autor">{{ $book->author }}</td>
                    <td data-label="Pôvodná cena">{{ number_format($book->price, 2) }} €</td>
                    <td data-label="Zľava">
                        @if($book->discount > 0)
                            <span class="discount-badge">-{{ $book->discount }}%</span>
                        @else
                            <span style="color: #999;">—</span>
                        @endif
                    </td>
                    <td data-label="Finálna cena"><span class="price-final">{{ number_format($book->final_price, 2) }} €</span></td>
                    <td data-label="Stav">
                        <span class="status-{{ $book->status == 'active' ? 'active' : 'inactive' }}">
                            <i class="fas fa-check-circle"></i> {{ $book->status == 'active' ? 'Aktívna' : 'Neaktívna' }}
                        </span>
                    </td>
                    <td data-label="">
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
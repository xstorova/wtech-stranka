@extends('layouts.app')

@section('title', 'Admin - Správa autorov')

@section('content')
<main class="admin-container">
    <div class="admin-header">
        <div>
            <h1 class="admin-title"><i class="fas fa-cog"></i> Admin rozhranie - Autori</h1>
            <a href="{{ url('/') }}" class="admin-view-link"><i class="fas fa-eye"></i> Prejsť do používateľského náhľadu</a>
        </div>
        <div class="admin-actions">
            <a href="{{ url('/admin/autori/pridat') }}" class="btn-add "><i class="fas fa-user-plus"></i> Pridať autora</a>
            <a href="{{ url('/admin/knihy/pridat') }}" class="btn-add btn-add-secondary"><i class="fas fa-plus"></i> Pridať novú knihu</a>
        </div>
    </div>

    {{-- ZÁLOŽKY --}}
    <div class="admin-tabs">
        <a href="{{ url('/admin') }}" class="admin-tab {{ request()->is('admin') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Knihy
        </a>
        <a href="{{ url('/admin/autori') }}" class="admin-tab {{ request()->is('admin/autori') || request()->is('admin/autori/*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Autori
        </a>
    </div>

    <div class="authors-table">
        <table>
            <thead>
                <tr>
                    <th>Fotka</th>
                    <th>Meno</th>
                    <th>Počet kníh</th>
                    <th>Status</th>
                    <th>Akcie</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr>
                    <td data-label="">
                        <div class="author-thumb">
                            @if($author->photo)
                                <img src="{{ $author->photo }}" alt="{{ $author->name }}">
                            @else
                                <div class="author-thumb-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div class="mobile-author-info">
                            <strong class="mobile-author-name">{{ $author->name }}</strong>
                        </div>
                    </td>
                    <td data-label="Meno"><strong>{{ $author->name }}</strong></td>
                    <td data-label="Počet kníh">{{ $author->book_count ?? 0 }}</td>
                    <td data-label="Status">
                        <span class="status-{{ $author->is_active ? 'active' : 'inactive' }}">
                            <i class="fas fa-check-circle"></i> {{ $author->is_active ? 'Aktívny' : 'Neaktívny' }}
                        </span>
                    </td>
                    <td data-label="">
                        <div class="actions">
                            <a href="{{ url('/admin/autori/'.$author->id.'/upravit') }}" class="btn-edit"><i class="fas fa-edit"></i> Upraviť</a>
                            <form method="POST" action="{{ url('/admin/autori/'.$author->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Naozaj chcete zmazať tohto autora?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                        <i class="fas fa-users" style="font-size: 2rem; margin-bottom: 15px; display: block;"></i>
                        Zatiaľ nie sú pridaní žiadni autori.
                        <br><a href="{{ url('/admin/autori/pridat') }}" style="color: #a69aff; text-decoration: none;">Pridať prvého autora</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
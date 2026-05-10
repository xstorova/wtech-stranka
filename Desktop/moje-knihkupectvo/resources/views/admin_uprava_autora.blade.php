@extends('layouts.app')

@section('title', 'Upraviť autora')

@section('content')
<main>
    <div class="admin-form-container">
        <div class="admin-box">
            <h2><i class="fas fa-user-edit"></i> Upraviť autora</h2>
            <span class="book-id" style= " color: #ccc; display: block; margin-bottom: 8px;"">ID autora: #{{ $author->id }}</span>

            <form method="POST" action="{{ route('admin.autori.update', $author->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- MENO --}}
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Meno autora <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $author->name) }}" required>
                </div>

                {{-- BIO --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Biografia</label>
                    <textarea name="bio" placeholder="Krátka biografia autora..." style="min-height: 150px;">{{ old('bio', $author->bio) }}</textarea>
                </div>

                {{-- FOTO + PREVIEW --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">URL fotka autora</label>
                    <input type="text" name="photo" id="photoInput" value="{{ old('photo', $author->photo) }}" placeholder="https://..." oninput="updatePhotoPreview()">
                    <p class="hint">Vlož URL adresu fotky autora</p>

                    @if($author->photo)
                        <span class="current-image-label" style="display: block; margin-top: 10px; color: #ccc">Aktuálna fotka:</span>
                    @endif
                    <div class="image-preview" id="photoPreview" style="width: 160px; height: 230px; border-radius: 5px; margin-top: 10px;">
                        @if($author->photo)
                            <img src="{{ $author->photo }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" onerror="this.parentElement.innerHTML='<span>Nepodarilo sa načítať fotku</span>'">
                        @else
                            <span>Žiadna fotka</span>
                        @endif
                    </div>
                </div>

                {{-- WEB --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Oficiálny web</label>
                    <input type="url" name="website" value="{{ old('website', $author->website) }}" placeholder="https://...">
                </div>

                {{-- HODNOTENIE --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Hodnotenie (0-5)</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating', $author->rating) }}" placeholder="napr. 4.5" class="input-small">
                </div>

                {{-- AKTÍVNY --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Stav</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 10px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $author->is_active) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            Aktívny autor
                        </label>
                    </div>
                </div>

                {{-- TLAČIDLÁ --}}
                <div class="form-actions" style="margin-top: 30px;">
                    <button type="submit" class="btn-save">Uložiť zmeny</button>
                    <a href="{{ url('/admin/autori') }}" class="btn-cancel">Zrušiť</a>
                </div>
            </form>

            {{-- MAZANIE --}}
            <form method="POST" action="{{ url('/admin/autori/' . $author->id) }}" style="margin-top: 20px;" onsubmit="return confirm('Naozaj chceš zmazať tohto autora?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Vymazať autora</button>
            </form>
        </div>
    </div>
</main>

<script>
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');

    function updatePhotoPreview() {
        const url = photoInput.value;
        if (url) {
            photoPreview.innerHTML = '<img src="' + url + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;" onerror="this.parentElement.innerHTML=\'<span>Nepodarilo sa načítať fotku</span>\'">';
        } else {
            photoPreview.innerHTML = '<span>Žiadna fotka</span>';
        }
    }

    photoInput.addEventListener('input', updatePhotoPreview);
</script>
@endsection
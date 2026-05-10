@extends('layouts.app')

@section('title', 'Pridať autora')

@section('content')
<main>
    <div class="admin-form-container">
        <div class="admin-box">
            <h2><i class="fas fa-user-plus"></i> Pridať nového autora</h2>

            <form method="POST" action="{{ url('/admin/autori') }}">
                @csrf

                <!-- MENO -->
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Meno autora <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="napr. J.K. Rowlingová" required>
                </div>

                <!-- BIO -->
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Biografia</label>
                    <textarea name="bio" placeholder="Krátka biografia autora..." style="min-height: 150px;">{{ old('bio') }}</textarea>
                </div>

                <!-- FOTO + PREVIEW -->
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">URL fotky autora</label>
                    <input type="text" name="photo" id="photoInput" value="{{ old('photo') }}" placeholder="https://..." oninput="updatePhotoPreview()">
                    <p class="hint">Vlož URL adresu fotky autora</p>

                    <div class="image-preview" id="photoPreview" style="width: 160px; height: 230px; border-radius: 5px; margin-top: 10px;">
                        <span>Žiadna fotka</span>
                    </div>
                </div>

                <!-- WEB -->
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Oficiálny web</label>
                    <input type="url" name="website" value="{{ old('website') }}" placeholder="https://...">
                </div>

                <!-- HODNOTENIE -->
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Hodnotenie (0-5)</label>
                    <input type="number" step="0.1" min="0" max="5" name="rating" value="{{ old('rating') }}" placeholder="napr. 4.5" class="input-small">
                </div>

                <!-- AKTÍVNY -->
                <div class="form-group" style="margin-top: 20px;">
                    <label style="display: block; margin-bottom: 8px;">Stav</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 10px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            Aktívny autor
                        </label>
                    </div>
                </div>

                <!-- TLAČIDLÁ -->
                <div class="form-actions" style="margin-top: 30px;">
                    <button type="submit" class="btn-save">Uložiť autora</button>
                    <a href="{{ url('/admin/autori') }}" class="btn-cancel">Zrušiť</a>
                </div>
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
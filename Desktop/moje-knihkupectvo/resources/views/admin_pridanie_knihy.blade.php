@extends('layouts.app')

@section('title', 'Pridať knihu')

@section('content')
<main>
    <div class="admin-form-container">
        <div class="admin-box">
            <h2>Pridať novú knihu</h2>

            <form method="POST" action="{{ url('/admin/knihy') }}">
                @csrf

                {{-- NÁZOV --}}
                <div class="form-group">
                    <label>Názov knihy <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required>
                </div>

                {{-- AUTOR --}}
                <div class="form-group">
                    <label>Autor <span class="required">*</span></label>
                    <input type="text" name="author" value="{{ old('author') }}" required>
                </div>

                {{-- CENA A ZĽAVA --}}
                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Cena (€) <span class="required">*</span></label>
                        <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Zľava (%)</label>
                        <div style="display: flex; align-items: center;">
                            <input type="number" min="0" max="99" name="discount" id="discount" value="{{ old('discount', 0) }}" class="input-small">
                            <span class="percent-symbol">%</span>
                        </div>
                    </div>
                </div>

                {{-- VÝPOČET CENY --}}
                <div class="price-calc-box">
                    <div class="calc-row">
                        <span>Pôvodná cena:</span>
                        <span id="calc-original">0.00 €</span>
                    </div>
                    <div class="calc-row">
                        <span>Zľava:</span>
                        <span id="calc-discount">0 %</span>
                    </div>
                    <div class="calc-row final">
                        <span>Finálna cena:</span>
                        <span id="calc-final">0.00 €</span>
                    </div>
                </div>

                {{-- KATEGÓRIA --}}
                <div class="form-group" style="margin-top: 20px;">
                    <label>Hlavná kategória <span class="required">*</span></label>
                    <select name="category" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                        @foreach($all_genres as $genre)
                            <option value="{{ $genre->name }}" {{ old('category') == $genre->name ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <label>Status <span class="required">*</span></label>
                    <select name="status" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktívna</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Neaktívna</option>
                    </select>
                </div>

                {{-- ŽÁNRE --}}
                <div class="form-group">
                    <label>Žánre (môžeš vybrať viacero)</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px;">
                        @foreach($genres as $genre)
                            <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                    {{ is_array(old('genres')) && in_array($genre->id, old('genres')) ? 'checked' : '' }}
                                    style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                                {{ $genre->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- OZNAČENIE --}}
                <div class="form-group" style="margin-top: 10px;">
                    <label>Označenie</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 10px;">
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            Novinka
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="is_preorder" value="1" {{ old('is_preorder') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            Predpredaj
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            Bestseller
                        </label>
                    </div>
                </div>

                {{-- DÁTUMY --}}
                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 10px;">
                    <div class="form-group">
                        <label>Dátum vydania</label>
                        <input type="date" name="published_at" value="{{ old('published_at') }}">
                    </div>
                    <div class="form-group">
                        <label>Dátum predpredaja</label>
                        <input type="date" name="preorder_date" value="{{ old('preorder_date') }}">
                    </div>
                </div>

                {{-- POPIS --}}
                <div class="form-group" style="margin-top: 10px;">
                    <label>Popis</label>
                    <textarea name="description" placeholder="Krátky popis knihy...">{{ old('description') }}</textarea>
                </div>

                {{-- OBRÁZOK --}}
                <div class="form-group">
                    <label>URL obrázka</label>
                    <input type="text" name="image" value="{{ old('image') }}" placeholder="https://...">
                    <p class="hint">Vlož priamo URL adresu obrázka knihy</p>
                    <div class="image-preview" id="imagePreview">
                        <span>Žiadny obrázok</span>
                    </div>
                </div>

                {{-- TLAČIDLÁ --}}
                <div class="form-actions">
                    <button type="submit" class="btn-save">Uložiť knihu</button>
                    <a href="{{ url('/admin') }}" class="btn-cancel">Zrušiť</a>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const calcOriginal = document.getElementById('calc-original');
    const calcDiscount = document.getElementById('calc-discount');
    const calcFinal = document.getElementById('calc-final');
    const imageInput = document.querySelector('input[name="image"]');
    const imagePreview = document.getElementById('imagePreview');

    function updatePrice() {
        const price = parseFloat(priceInput.value) || 0;
        const discount = parseInt(discountInput.value) || 0;
        const final = discount > 0 ? (price * (1 - discount / 100)) : price;

        calcOriginal.textContent = price.toFixed(2) + ' €';
        calcDiscount.textContent = discount + ' %';
        calcFinal.textContent = final.toFixed(2) + ' €';
    }

    function updateImage() {
        const url = imageInput.value;
        if (url) {
            imagePreview.innerHTML = '<img src="' + url + '" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentElement.innerHTML=\'<span>Nepodarilo sa načítať obrázok</span>\'">';
        } else {
            imagePreview.innerHTML = '<span>Žiadny obrázok</span>';
        }
    }

    priceInput.addEventListener('input', updatePrice);
    discountInput.addEventListener('input', updatePrice);
    imageInput.addEventListener('input', updateImage);
    updatePrice();
</script>
@endsection
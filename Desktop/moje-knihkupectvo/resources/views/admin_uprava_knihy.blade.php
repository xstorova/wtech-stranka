@extends('layouts.app')

@section('title', 'Upraviť knihu')

@section('content')
<div class="admin-form-container">
    <div class="admin-box">
        <h2>Upraviť knihu</h2>
        <span class="book-id" style=" color: #ccc; display: block; margin-bottom: 8px;" >ID knihy: #{{ $book->id }}</span> 

        @if($errors->any())
            <div style="background: #ff6b6b; color: white; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                <strong>Chyby:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.knihy.update', $book->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px;">Názov knihy <span class="required">*</span></label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Autor <span class="required">*</span></label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Cena (€) <span class="required">*</span></label>
                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $book->price) }}" required>
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Zľava (%)</label>
                    <div style="display: flex; align-items: center;">
                        <input type="number" min="0" max="99" name="discount" id="discount" value="{{ old('discount', $book->discount) }}" class="input-small">
                        <span class="percent-symbol">%</span>
                    </div>
                </div>
            </div>

            <div class="price-calc-box" style="margin-top: 20px;">
                <div class="calc-row">
                    <span>Pôvodná cena:</span>
                    <span id="calc-original">{{ number_format($book->price, 2) }} €</span>
                </div>
                <div class="calc-row">
                    <span>Zľava:</span>
                    <span id="calc-discount">{{ $book->discount }} %</span>
                </div>
                <div class="calc-row final">
                    <span>Finálna cena:</span>
                    <span id="calc-final">{{ number_format($book->final_price, 2) }} €</span>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Jazyk</label>
                <select name="language" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="">Vyberte jazyk...</option>
                    <option value="Slovenčina" {{ old('language', $book->language) == 'Slovenčina' ? 'selected' : '' }}>Slovenčina</option>
                    <option value="Angličtina" {{ old('language', $book->language) == 'Angličtina' ? 'selected' : '' }}>Angličtina</option>
                    <option value="Čeština" {{ old('language', $book->language) == 'Čeština' ? 'selected' : '' }}>Čeština</option>
                    <option value="Nemčina" {{ old('language', $book->language) == 'Nemčina' ? 'selected' : '' }}>Nemčina</option>
                    <option value="Francúzština" {{ old('language', $book->language) == 'Francúzština' ? 'selected' : '' }}>Francúzština</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Typ väzby</label>
                <select name="binding" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="">Vyberte väzbu...</option>
                    <option value="Pevná väzba" {{ old('binding', $book->binding) == 'Pevná väzba' ? 'selected' : '' }}>Pevná väzba</option>
                    <option value="Brožovaná väzba" {{ old('binding', $book->binding) == 'Brožovaná väzba' ? 'selected' : '' }}>Brožovaná väzba</option>
                    <option value="E-kniha" {{ old('binding', $book->binding) == 'E-kniha' ? 'selected' : '' }}>E-kniha</option>
                    <option value="Audiokniha" {{ old('binding', $book->binding) == 'Audiokniha' ? 'selected' : '' }}>Audiokniha</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Séria</label>
                <input type="text" name="series" value="{{ old('series', $book->series) }}" placeholder="napr. Férska sága, Harry Potter..." style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Diel série</label>
                <input type="number" name="series_number" value="{{ old('series_number', $book->series_number) }}" placeholder="napr. 4" min="1" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Vydavateľstvo</label>
                <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" placeholder="napr. Slovart, Ikar..." style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Počet strán</label>
                <input type="number" min="1" name="page_count" id="page_count" value="{{ old('page_count', $book->page_count) }}" placeholder="napr. 400" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                <p class="hint" id="reading_time_hint" style="color: #c4b5fd; margin-top: 5px;">
                    @if($book->page_count)
                        ~{{ $book->reading_time }}
                    @endif
                </p>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Status <span class="required">*</span></label>
                <select name="status" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="active" {{ old('status', $book->status) == 'active' ? 'selected' : '' }}>Aktívna</option>
                    <option value="inactive" {{ old('status', $book->status) == 'inactive' ? 'selected' : '' }}>Neaktívna</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Žánre (môžeš vybrať viacero)</label>
                <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 10px;">
                    @foreach($genres as $genre)
                        <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                {{ (isset($selectedGenres) && in_array($genre->id, $selectedGenres)) ? 'checked' : '' }}
                                style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                            {{ $genre->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Označenie</label>
                <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 10px;">
                    <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                        <input type="checkbox" name="is_new" value="1" {{ old('is_new', $book->is_new) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                        Novinka
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                        <input type="checkbox" name="is_preorder" value="1" {{ old('is_preorder', $book->is_preorder) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                        Predpredaj
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; color: #ccc; font-size: 0.9rem; text-transform: none; letter-spacing: normal; cursor: pointer;">
                        <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller', $book->is_bestseller) ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: #c4b5fd; cursor: pointer;">
                        Bestseller
                    </label>
                </div>
            </div>

            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Dátum vydania</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $book->published_at ? $book->published_at->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Dátum predpredaja</label>
                    <input type="date" name="preorder_date" value="{{ old('preorder_date', $book->preorder_date ? $book->preorder_date->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Popis</label>
                <textarea name="description" placeholder="Krátky popis knihy...">{{ old('description', $book->description) }}</textarea>
            </div>

            {{-- === OBÁLKA KNIHY === --}}
            <div class="form-group" style="margin-top: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; ">Obálka knihy</label>
                
                <label style="display: block; margin-bottom: 8px;">Nahrať nový obrázok zo súboru</label>
                <input type="file" name="image_file" accept="image/*" onchange="previewMainImage(this)">
            </div>
            
            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">ALEBO URL obálky</label>
                <input type="text" name="image_url" id="imageInput" value="{{ old('image_url', $book->image) }}" placeholder="https..." oninput="updateMainImage()">
                <p class="hint">Vlož priamo URL adresu obrázka knihy</p>

                @if($book->image)
                    <span class="current-image-label" style="display: block; color: #ccc; margin-top: 10px;">Aktuálny obrázok:</span>
                @endif
                <div class="image-preview" id="mainImagePreview" style="width: 200px; height: 280px; margin-top: 10px;">
                    @if($book->image)
                        <img src="{{ $book->image }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentElement.innerHTML='<span>Nepodarilo sa načítať obrázok</span>'">
                    @else
                        <span>Žiadny obrázok</span>
                    @endif
                </div>
            </div>

            <hr style="border-color: #444; margin: 30px 0;">

            {{-- === GALÉRIA FOTIEK === --}}
            <div class="form-group">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; ">Galéria fotiek</label>
                
                {{-- Existujúce fotky z galérie --}}
                @if($book->gallery && count($book->gallery) > 0)
                <div id="existingGallery" style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                    @foreach($book->gallery as $index => $photo)
                    <div class="gallery-item-existing" data-path="{{ $photo }}" style="width: 100px; height: 140px; border-radius: 5px; overflow: hidden; position: relative; border: 2px solid #c4b5fd;">
                        <img src="{{ asset('storage/' . $photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        <button type="button" onclick="markGalleryForRemoval(this.parentNode)" style="position: absolute; top: 2px; right: 2px; background: #ff6b6b; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center;">×</button>
                        <input type="hidden" name="keep_gallery[]" value="{{ $photo }}">
                    </div>
                    @endforeach
                </div>
                @endif
                
                {{-- Pridať nové fotky --}}
                <label style="display: block; margin-bottom: 8px;">Pridať nové fotky</label>
                <input type="file" name="gallery_new[]" accept="image/*" multiple onchange="previewNewGallery(this)" style="padding: 10px; background: #333; border-radius: 4px;">
                
                <div id="galleryPreviewNew" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px;">
                    {{-- Náhľady nových fotiek --}}
                </div>
            </div>

            <div class="form-actions" style="margin-top: 30px;">
                <button type="submit" class="btn-save">Uložiť zmeny</button>
                <a href="{{ route('admin.knihy.index') }}" class="btn-cancel">Zrušiť</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.knihy.destroy', $book->id) }}" style="margin-top: 20px;" onsubmit="return confirm('Naozaj chceš zmazať túto knihu?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete"> Vymazať knihu</button>
        </form>
    </div>
</div>

<script>
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const calcOriginal = document.getElementById('calc-original');
    const calcDiscount = document.getElementById('calc-discount');
    const calcFinal = document.getElementById('calc-final');
    const imageInput = document.getElementById('imageInput');
    const pageCountInput = document.getElementById('page_count');
    const readingTimeHint = document.getElementById('reading_time_hint');

    function updatePrice() {
        const price = parseFloat(priceInput.value) || 0;
        const discount = parseInt(discountInput.value) || 0;
        const final = discount > 0 ? (price * (1 - discount / 100)) : price;

        calcOriginal.textContent = price.toFixed(2) + ' €';
        calcDiscount.textContent = discount + ' %';
        calcFinal.textContent = final.toFixed(2) + ' €';
    }

    function updateReadingTime() {
        const pages = parseInt(pageCountInput.value) || 0;
        if (pages > 0) {
            const hours = pages / 50;
            const low = Math.floor(hours);
            const high = Math.ceil(hours);
            let text = '~';
            if (low == high) {
                text += low + ' hodín čítania';
            } else {
                text += low + '-' + high + ' hodín čítania';
            }
            readingTimeHint.textContent = text;
        } else {
            readingTimeHint.textContent = '';
        }
    }

    // === OBÁLKA KNIHY ===
    function previewMainImage(input) {
        const preview = document.getElementById('mainImagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" style="width: 100%; height: 100%; object-fit: cover;">';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateMainImage() {
        const url = imageInput.value;
        const preview = document.getElementById('mainImagePreview');
        if (url) {
            preview.innerHTML = '<img src="' + url + '" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentElement.innerHTML=\'<span>Nepodarilo sa načítať obrázok</span>\'">';
        }
    }

    // === GALÉRIA - existujúce fotky ===
    function markGalleryForRemoval(element) {
        const path = element.dataset.path;
        element.style.opacity = '0.3';
        element.style.borderColor = '#ff6b6b';
        
        const input = element.querySelector('input[name="keep_gallery[]"]');
        if (input) {
            input.name = 'remove_gallery[]';
            input.value = path;
        }
        
        const btn = element.querySelector('button');
        btn.innerHTML = '↺';
        btn.onclick = function() { restoreGalleryItem(element); };
        btn.style.background = '#c4b5fd';
    }

    function restoreGalleryItem(element) {
        const path = element.dataset.path;
        element.style.opacity = '1';
        element.style.borderColor = '#c4b5fd';
        
        const input = element.querySelector('input[name="remove_gallery[]"]');
        if (input) {
            input.name = 'keep_gallery[]';
            input.value = path;
        }
        
        const btn = element.querySelector('button');
        btn.innerHTML = '×';
        btn.onclick = function() { markGalleryForRemoval(element); };
        btn.style.background = '#ff6b6b';
    }

    // === GALÉRIA - nové fotky ===
    function previewNewGallery(input) {
        const previewContainer = document.getElementById('galleryPreviewNew');
        
        if (input.files) {
            Array.from(input.files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'width: 100px; height: 140px; border-radius: 5px; overflow: hidden; position: relative; border: 2px solid #c4b5fd;';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                        <span style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.7); color: white; font-size: 10px; text-align: center; padding: 2px;">Nová</span>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    // Event listenery
    priceInput.addEventListener('input', updatePrice);
    discountInput.addEventListener('input', updatePrice);
    imageInput.addEventListener('input', updateMainImage);
    pageCountInput.addEventListener('input', updateReadingTime);
    
    updatePrice();
    updateReadingTime();
</script>
@endsection
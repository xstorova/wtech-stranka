@extends('layouts.app')

@section('title', 'Pridať knihu')

@section('content')
<div class="admin-form-container">
    <div class="admin-box">
        <h2>Pridať novú knihu</h2>

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

        <form method="POST" action="{{ route('admin.knihy.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label style="display: block; margin-bottom: 8px;">Názov knihy <span class="required">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Autor <span class="required">*</span></label>
                <input type="text" name="author" value="{{ old('author') }}" required>
            </div>

            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Cena (€) <span class="required">*</span></label>
                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}" required>
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Zľava (%)</label>
                    <div style="display: flex; align-items: center;">
                        <input type="number" min="0" max="99" name="discount" id="discount" value="{{ old('discount', 0) }}" class="input-small">
                        <span class="percent-symbol">%</span>
                    </div>
                </div>
            </div>

            <div class="price-calc-box" style="margin-top: 20px;">
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

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Jazyk</label>
                <select name="language" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="">Vyberte jazyk...</option>
                    <option value="Slovenčina" {{ old('language') == 'Slovenčina' ? 'selected' : '' }}>Slovenčina</option>
                    <option value="Angličtina" {{ old('language') == 'Angličtina' ? 'selected' : '' }}>Angličtina</option>
                    <option value="Čeština" {{ old('language') == 'Čeština' ? 'selected' : '' }}>Čeština</option>
                    <option value="Nemčina" {{ old('language') == 'Nemčina' ? 'selected' : '' }}>Nemčina</option>
                    <option value="Francúzština" {{ old('language') == 'Francúzština' ? 'selected' : '' }}>Francúzština</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Typ väzby</label>
                <select name="binding" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="">Vyberte väzbu...</option>
                    <option value="Pevná väzba" {{ old('binding') == 'Pevná väzba' ? 'selected' : '' }}>Pevná väzba</option>
                    <option value="Brožovaná väzba" {{ old('binding') == 'Brožovaná väzba' ? 'selected' : '' }}>Brožovaná väzba</option>
                    <option value="E-kniha" {{ old('binding') == 'E-kniha' ? 'selected' : '' }}>E-kniha</option>
                    <option value="Audiokniha" {{ old('binding') == 'Audiokniha' ? 'selected' : '' }}>Audiokniha</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Séria</label>
                <input type="text" name="series" value="{{ old('series') }}" placeholder="napr. Férska sága, Harry Potter..." style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Diel série</label>
                <input type="number" name="series_number" value="{{ old('series_number') }}" placeholder="napr. 4" min="1" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>  

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Vydavateľstvo</label>
                <input type="text" name="publisher" value="{{ old('publisher') }}" placeholder="napr. Slovart, Ikar..." style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Počet strán</label>
                <input type="number" min="1" name="page_count" id="page_count" value="{{ old('page_count') }}" placeholder="napr. 400" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                <p class="hint" id="reading_time_hint" style="color: #c4b5fd; margin-top: 5px;"></p>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Status <span class="required">*</span></label>
                <select name="status" style="padding: 12px 15px; border: none; border-radius: 4px; background: #d1d1d1; font-size: 0.95rem; color: #333; outline: none; width: 100%;">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktívna</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Neaktívna</option>
                </select>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Žánre (môžeš vybrať viacero)</label>
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

            <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Dátum vydania</label>
                    <input type="date" name="published_at" value="{{ old('published_at') }}">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 8px;">Dátum predpredaja</label>
                    <input type="date" name="preorder_date" value="{{ old('preorder_date') }}">
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">Popis</label>
                <textarea name="description" placeholder="Krátky popis knihy...">{{ old('description') }}</textarea>
            </div>

            <!-- OBÁLKA KNIHY -->
            <div class="form-group" style="margin-top: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">Obálka knihy</label>
                
                <label style="display: block; margin-bottom: 8px;">Nahrať obrázok zo súboru</label>
                <input type="file" name="image_file" accept="image/*" onchange="previewMainImage(this)">
                
                <div class="image-preview" id="mainImagePreview" style="width: 200px; height: 280px; margin-top: 10px;">
                    <span>Žiadny obrázok</span>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
                <label style="display: block; margin-bottom: 8px;">ALEBO URL obálky</label>
                <input type="text" name="image_url" id="imageInput" value="{{ old('image_url') }}" placeholder="https://..." oninput="updateMainImage()">
                <p class="hint">Vlož priamo URL adresu obrázka knihy</p>
            </div>

            <!-- GALÉRIA FOTIEK -->
            <div class="form-group" style="margin-top: 30px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold; ">Galéria fotiek</label>
                <input type="file" name="gallery[]" accept="image/*" multiple onchange="previewGallery(this)">
                
                <div id="galleryPreview" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;">
                </div>
            </div>

            <div class="form-actions" style="margin-top: 30px;">
                <button type="submit" class="btn-save">Uložiť knihu</button>
                <a href="{{ route('admin.knihy.index') }}" class="btn-cancel">Zrušiť</a>
            </div>
        </form>
    </div>
</div>

<script>
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const calcOriginal = document.getElementById('calc-original');
    const calcDiscount = document.getElementById('calc-discount');
    const calcFinal = document.getElementById('calc-final');
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

    // OBÁLKA KNIHY 
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
        const url = document.getElementById('imageInput').value;
        const preview = document.getElementById('mainImagePreview');
        if (url) {
            preview.innerHTML = '<img src="' + url + '" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentElement.innerHTML=\'<span style=color:#666>Neplatná URL</span>\'">';
        }
    }

    // GALÉRIA 
    let galleryFiles = [];

    function previewGallery(input) {
        const previewContainer = document.getElementById('galleryPreview');
        
        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                galleryFiles.push(file);
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'gallery-item';
                    div.dataset.index = galleryFiles.length - 1;
                    div.style.cssText = 'width: 100px; height: 140px; border-radius: 5px; overflow: hidden; position: relative; border: 2px solid #c4b5fd;';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">
                        <button type="button" onclick="removeGalleryItem(this.parentNode)" style="position: absolute; top: 2px; right: 2px; background: #ff6b6b; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center;">×</button>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function removeGalleryItem(element) {
        const index = parseInt(element.dataset.index);
        galleryFiles.splice(index, 1);
        element.remove();
        document.querySelectorAll('.gallery-item').forEach((el, i) => {
            el.dataset.index = i;
        });
    }

    priceInput.addEventListener('input', updatePrice);
    discountInput.addEventListener('input', updatePrice);
    pageCountInput.addEventListener('input', updateReadingTime);
    
    updatePrice();
    updateReadingTime();
</script>
@endsection
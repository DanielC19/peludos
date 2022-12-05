{{-- LIVEWIRE COMPONENT --}}
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="field mb-3">
            <label for="animal_id" class="label">Animal</label>
            <div class="control">
                <div class="select">
                    <select name="animal_id" wire:model="animal_id" wire:change="animalUpdate">
                        @foreach ($animals as $animal)
                            @if ($animal_id == $animal->id)
                                <option value="{{ $animal->id }}" selected>{{ $animal->name }}</option>
                            @else
                                <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="field mb-3">
            <label for="category_id" class="label">Categoría</label>
            <div class="control">
                <div class="select">
                    <select name="category_id" wire:model="category_id">
                        @foreach ($categories as $category)
                        @if ($category_id == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="field mb-3">
            <label for="name" class="label">Nombre</label>
            <div class="control">
                <input type="text" name="name" class="input" placeholder="Nombre Producto" wire:model="name">
            </div>
        </div>
        <div class="field mb-3">
            <label for="image" class="label">Imagen</label>
            <div class="control">
                <input type="number" name="image" class="input" placeholder="Imagen Producto" wire:model="image">
            </div>
        </div>

    </div>
    <div class="box-footer mt-4">
        <button type="submit" class="button is-primary" {{ $submit ? '' : 'disabled' }}>Enviar</button>
    </div>
</div>
<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="field mb-3">
            <label for="animal_id" class="label">Animal</label>
            <div class="control">
                <div class="select">
                    <select name="animal_id">
                        @foreach ($animals as $animal)
                            @if ($category->animal_id == $animal->id)
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
            <label for="name" class="label">Nombre</label>
            <div class="control">
                <input type="text" name="name" value="{{ $category->name }}" class="input" placeholder="Nombre Categoría">
            </div>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="button is-primary">Enviar</button>
    </div>
</div>
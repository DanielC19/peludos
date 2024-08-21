<div>
    <div class="field">
        <label class="label">Cedula/Nit</label>
        <div class="control has-icons-left has-icons-right">
            <input name="customer-data:document" wire:model="document" type="text" placeholder="Ingresa tu Cedula/Nit" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fas fa-id-card"></i>
            </span>
        </div>
        @error('name') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Nombre</label>
        <div class="control has-icons-left has-icons-right">
            <input name="customer-data:full-name" wire:model="name" type="text" placeholder="Ingresa tu nombre" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </div>
        @error('name') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input name="customer-data:email" wire:model="email" type="email" placeholder="Ingresa tu email" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-envelope"></i>
            </span>
        </div>
        @error('email') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Celular</label>
        <div class="control has-icons-left has-icons-right">
            <input name="shipping-address:phone-number" wire:model="cellphone" type="number" placeholder="Ingresa tu celular" class="input">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-phone"></i>
            </span>
        </div>
        @error('cellphone') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Ciudad</label>
        <div class="control has-icons-left has-icons-right">
            <select class="input" name="shipping-address:city" id="city">
                <option value="Medellín">Medellín</option>
                <option value="Bello">Bello</option>
                <option value="Copacabana">Copacabana</option>
                <option value="Itaguí">Itaguí</option>
                <option value="Envigado">Envigado</option>
                <option value="Girardota">Girardota</option>
                <option value="Sabaneta">Sabaneta</option>
                <option value="La Estrella">La Estrella</option>
            </select>
            <span class="icon is-small is-left">
                <i class="fa-solid fa-city"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">Dirección</label>
        <div class="control has-icons-left has-icons-right">
            <input name="shipping-address:address-line-1" wire:model="address" type="text" placeholder="Ingresa tu dirección" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-location-dot"></i>
            </span>
        </div>
        @error('address') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
</div>

<div>
    <div class="field">
        <label class="label">Nombre</label>
        <div class="control has-icons-left has-icons-right">
            <input name="buyerFullName" wire:model="name" type="text" placeholder="Ingresa tu nombre" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
            </span>
        </div>
        @error('name') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input name="buyerEmail" wire:model="email" type="email" placeholder="Ingresa tu email" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-envelope"></i>
            </span>
        </div>
        @error('email') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Celular</label>
        <div class="control has-icons-left has-icons-right">
            <input name="mobilePhone" wire:model="cellphone" type="number" placeholder="Ingresa tu celular" class="input">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-phone"></i>
            </span>
        </div>
        @error('cellphone') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label class="label">Ciudad</label>
        <div class="control has-icons-left has-icons-right">
            <input type="text" class="input" value="Medellín" disabled readonly>
            <span class="icon is-small is-left">
                <i class="fa-solid fa-city"></i>
            </span>
        </div>
    </div>
    <div class="field">
        <label class="label">Dirección</label>
        <div class="control has-icons-left has-icons-right">
            <input name="shippingAddress" wire:model="address" type="text" placeholder="Ingresa tu dirección" class="input" maxlength="250">
            <span class="icon is-small is-left">
                <i class="fa-solid fa-location-dot"></i>
            </span>
        </div>
        @error('address') <span class="help is-danger">{{ $message }}</span> @enderror
    </div>
</div>

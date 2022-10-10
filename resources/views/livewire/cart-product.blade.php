<article>
    <div class="shopping-cart__info">
        <span class="modify"><i class="fa-solid fa-eye fa-xl"></i> Ver más</span>
        <span>
            <img src="https://bulma.io/images/placeholders/1280x960.png" class="product-img" alt="Placeholder image">
        </span>
        <span class="info">
            <p>{{ $product->name }}</p>
            <p class="caption">Presentación: {{ $presentation }}</p>
        </span>
        <div class="is-desktop">
            <span class="is-flex is-align-items-center">
                <button class="button mr-3" wire:click="increment">+</button>
                {{ $amount }}
                <button class="button ml-3" wire:click="reduce">-</button>
            </span>
            <span>${{ number_format($price, 0, '.', ',') }}</span>
        </div>
        <span class="clear">
            <a href="{{ route('cart.delete', $product->id) }}"><i class="fa-solid fa-xmark fa-xl"></i></a>
        </span>
    </div>
    <div class="shopping-cart__prices is-mobile">
        <span class="is-flex is-align-items-center">
            <button class="button mr-3" wire:click="increment">+</button>
            {{ $amount }}
            <button class="button ml-3" wire:click="reduce">-</button>
        </span>
        <span>${{ number_format($price, 0, '.', ',') }}</span>
    </div>
</article>

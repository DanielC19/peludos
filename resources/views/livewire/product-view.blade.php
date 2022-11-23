<section class="section product-view">
    <figure class="image">
        <img src="https://bulma.io/images/placeholders/1280x960.png" class="product-img" alt="Imagen del producto">
    </figure>
    <div class="product-info">
        <p class="product-name">{{ $product->name }}</p>
        <p class="product-price">${{ number_format($price, 0, '.', ',') }}</p>
        <div id="{{ $product->id }}" class="presentations">
            @foreach ($product->presentations as $presentation)
                @if ($presentation->id == $presentation_selected)
                <button wire:click="selectPresentation({{ $presentation->id }})" class="product-amount button is-primary m-2">{{ $presentation->amount }}</button>
                @else
                <button wire:click="selectPresentation({{ $presentation->id }})" class="product-amount button m-2">{{ $presentation->amount }}</button>
                @endif
            @endforeach
        </div>
        <div class="product-buttons">
            <button wire:click="addCart" class="product-button button is-primary">{{ $cart_msg }}</button>
            <button wire:click="buyFast" class="product-button button is-secondary">Compra rápida</button>
        </div>
    </div>
</section>

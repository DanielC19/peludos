{{-- Product card --}}
<article class="product card">
    <a href="{{ route('product', $product->id) }}">
        <div class="card-image">
            <figure class="image">
                <img src="https://bulma.io/images/placeholders/1280x960.png" class="product-img" alt="Placeholder image">
            </figure>
        </div>
        <div class="card-content">
            <p class="product-name">
                {{ $product->name }}
            </p>
            <p class="product-price">
                ${{ number_format($price, 0, '.', ',') }}
            </p>
        </div>
    </a>
        <footer class="card-footer">
            <div id="{{ $product->id }}" class="presentations">
                @foreach ($product->presentations as $presentation)
                    @if ($presentation->id == $presentation_selected)
                    <button wire:click="selectPresentation({{ $presentation->id }})" class="product_amount button is-small is-primary">{{ $presentation->amount }}</button>
                    @else
                    <button {{ $presentation->availability ? "wire:click=selectPresentation($presentation->id)" : '' }} class="product_amount button is-small" {{ $presentation->availability ? '' : 'disabled' }}>{{ $presentation->amount }}</button>
                    @endif
                @endforeach
            </div>
            <hr>
            <button wire:click="addCart" class="product-cart button is-primary is-fullwidth mt-4 p-4">
                <div class="cart-1">¡Lo quiero!</div>
                <div class="cart-2">{{ $cart_msg }}</div>
            </button>
        </footer>    
</article>        
<section class="section product-grid">      
    @foreach ($products as $product)
    {{-- Product card --}}
    <article class="product card">
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
                ${{ number_format($product->presentations[0]->price, 0, ',', '.') }}
            </p>
        </div>
        <footer class="card-footer">
            <div class="presentations">
                @foreach ($product->presentations as $presentation)
                <button id="product_amount" class="button is-small">{{ $presentation->amount }}</button>
                @endforeach
            </div>
            <hr>
            <button class="product-cart button is-primary is-fullwidth mt-4 p-4">
                <div class="cart-1">¡Lo quiero!</div>
                <div class="cart-2">Añadir al carrito</div>
            </button>
        </footer>
    </article>        
    @endforeach
</section>
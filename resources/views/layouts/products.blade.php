<div>
    <section class="section product-grid">      
        @foreach ($products as $product)
            @livewire('product-grid', ['product' => $product], key($product->id))
        @endforeach
    </section>
    @if (!isset($home_view))
        {{ $products->links() }}
    @endif
</div>
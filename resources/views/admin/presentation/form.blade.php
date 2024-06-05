<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group mb-3">
            <label for="amount">Presentación - Cantidad</label>
            <input type="text" name="amount" value="{{ $presentation->amount }}" class="form-control {{ ($errors->has('amount') ? 'is-invalid' : '') }}" placeholder="Cantidad">
            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group mb-3">
            <label for="price">Precio</label>
            <input type="text" name="price" value="${{ number_format($presentation->price, 0, '.', ',') }}" id="price-input" class="form-control {{ ($errors->has('price') ? 'is-invalid' : '') }}" placeholder="Precio">
        </div>
        @if (isset($product_id))
            <input type="hidden" name="product_id" value="{{ $product_id }}">
        @endif
        @if (isset($presentation->product))
            <input type="hidden" name="product_id" value="{{ $presentation->product->id }}">
        @endif
        <input type="hidden" name="id" value="{{ $presentation->id }}">
    </div>
    <div class="box-footer mt-4">
        <button type="submit" class="button is-primary">Enviar</button>
    </div>
</div>
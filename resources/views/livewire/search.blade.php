<section class="center is-flex-direction-column">
    <h2 class="title is-2 mt-4 mb-3">Busca tus productos</h2>

    {{-- Input to search live --}}
    <div class="control has-icons-left my-4 mx-6" style="width: 80%; max-width: 550px;">
        <input wire:model.debounce.500ms="search" class="input is-link is-medium is-rounded" type="search">
        <span class="icon is-left">
            <i class="fas fa-search"></i>
        </span>
    </div>

    {{-- Result of search --}}
    @include('layouts.products')
</section>

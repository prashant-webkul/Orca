@if (app('Orca\Product\Repositories\ProductRepository')->getFeaturedProducts()->count())
    <section class="featured-products">

        <div class="featured-heading">
            {{ __('site::app.home.featured-products') }}<br/>

            <span class="featured-seperator" style="color:lightgrey;">_____</span>
        </div>

        <div class="featured-grid product-grid-4">

            @foreach (app('Orca\Product\Repositories\ProductRepository')->getFeaturedProducts() as $productFlat)

                @include ('site::products.list.card', ['product' => $productFlat])

            @endforeach

        </div>

    </section>
@endif
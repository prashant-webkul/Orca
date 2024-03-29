<?php
    $relatedProducts = $product->related_products()->get();
?>

@if ($relatedProducts->count())
    <div class="attached-products-wrapper">

        <div class="title">
            {{ __('site::app.products.related-product-title') }}
            <span class="border-bottom"></span>
        </div>

        <div class="product-grid-4">

            @foreach ($relatedProducts as $related_product)

                @include ('site::products.list.card', ['product' => $related_product])

            @endforeach

        </div>

    </div>
@endif
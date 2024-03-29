{!! view_render_event('orca.site.products.price.before', ['product' => $product]) !!}

<div class="product-price">
    @inject ('priceHelper', 'Orca\Product\Helpers\Price')

    @if ($product->type == 'configurable')
        <span class="price-label">{{ __('site::app.products.price-label') }}</span>

        <span class="final-price">{{ core()->currency($priceHelper->getMinimalPrice($product)) }}</span>
    @else
        @if ($priceHelper->haveSpecialPrice($product))
            <div class="sticker sale">
                {{ __('site::app.products.sale') }}
            </div>

            <span class="regular-price">{{ core()->currency($product->price) }}</span>

            <span class="special-price">{{ core()->currency($priceHelper->getSpecialPrice($product)) }}</span>
        @else
            <span>{{ core()->currency($product->price) }}</span>
        @endif
    @endif
</div>

{!! view_render_event('orca.site.products.price.after', ['product' => $product]) !!}
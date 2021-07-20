<?php


if (! function_exists('priceFormat')) {
    function priceFormat( $price )
    {
        return $price.' '.config('store.currency');
    }
}

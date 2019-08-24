<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    //Store front home
    Route::get('/', 'Orca\Site\Http\Controllers\HomeController@index')->defaults('_config', [
        'view' => 'site::home.index'
    ])->name('Site.home.index');

    //subscription
    //subscribe
    Route::get('/subscribe', 'Orca\Site\Http\Controllers\SubscriptionController@subscribe')->name('Site.subscribe');

    //unsubscribe
    Route::get('/unsubscribe/{token}', 'Orca\Site\Http\Controllers\SubscriptionController@unsubscribe')->name('Site.unsubscribe');

    //Store front header nav-menu fetch
    Route::get('/categories/{slug}', 'Orca\Site\Http\Controllers\CategoryController@index')->defaults('_config', [
        'view' => 'site::products.index'
    ])->name('Site.categories.index');

    //Store front search
    Route::get('/search', 'Orca\Site\Http\Controllers\SearchController@index')->defaults('_config', [
        'view' => 'site::search.search'
    ])->name('Site.search.index');

    //Country State Selector
    Route::get('get/countries', 'Orca\Core\Http\Controllers\CountryStateController@getCountries')->defaults('_config', [
        'view' => 'site::test'
    ])->name('get.countries');

    //Get States When Country is Passed
    Route::get('get/states/{country}', 'Orca\Core\Http\Controllers\CountryStateController@getStates')->defaults('_config', [
        'view' => 'site::test'
    ])->name('get.states');

    //checkout and cart
    //Cart Items(listing)
    Route::get('checkout/cart', 'Orca\Site\Http\Controllers\CartController@index')->defaults('_config', [
        'view' => 'site::checkout.cart.index'
    ])->name('Site.checkout.cart.index');

        Route::post('checkout/check/coupons', 'Orca\Site\Http\Controllers\OnepageController@applyCoupon')->name('Site.checkout.check.coupons');

        Route::post('checkout/remove/coupon', 'Orca\Site\Http\Controllers\OnepageController@removeCoupon')->name('Site.checkout.remove.coupon');

    //Cart Items Add
    Route::post('checkout/cart/add/{id}', 'Orca\Site\Http\Controllers\CartController@add')->defaults('_config', [
        'redirect' => 'Site.checkout.cart.index'
    ])->name('cart.add');

    //Cart Items Add Configurable for more
    Route::get('checkout/cart/addconfigurable/{slug}', 'Orca\Site\Http\Controllers\CartController@addConfigurable')->name('cart.add.configurable');

    //Cart Items Remove
    Route::get('checkout/cart/remove/{id}', 'Orca\Site\Http\Controllers\CartController@remove')->name('cart.remove');

    //Cart Update Before Checkout
    Route::post('/checkout/cart', 'Orca\Site\Http\Controllers\CartController@updateBeforeCheckout')->defaults('_config', [
        'redirect' => 'Site.checkout.cart.index'
    ])->name('Site.checkout.cart.update');

    //Cart Items Remove
    Route::get('/checkout/cart/remove/{id}', 'Orca\Site\Http\Controllers\CartController@remove')->defaults('_config', [
        'redirect' => 'Site.checkout.cart.index'
    ])->name('Site.checkout.cart.remove');

    //Checkout Index page
    Route::get('/checkout/onepage', 'Orca\Site\Http\Controllers\OnepageController@index')->defaults('_config', [
        'view' => 'site::checkout.onepage'
    ])->name('Site.checkout.onepage.index');

    //Checkout Save Order
    Route::get('/checkout/summary', 'Orca\Site\Http\Controllers\OnepageController@summary')->name('Site.checkout.summary');

    //Checkout Save Address Form Store
    Route::post('/checkout/save-address', 'Orca\Site\Http\Controllers\OnepageController@saveAddress')->name('Site.checkout.save-address');

    //Checkout Save Shipping Address Form Store
    Route::post('/checkout/save-shipping', 'Orca\Site\Http\Controllers\OnepageController@saveShipping')->name('Site.checkout.save-shipping');

    //Checkout Save Payment Method Form
    Route::post('/checkout/save-payment', 'Orca\Site\Http\Controllers\OnepageController@savePayment')->name('Site.checkout.save-payment');

    //Checkout Save Order
    Route::post('/checkout/save-order', 'Orca\Site\Http\Controllers\OnepageController@saveOrder')->name('Site.checkout.save-order');

    //Checkout Order Successfull
    Route::get('/checkout/success', 'Orca\Site\Http\Controllers\OnepageController@success')->defaults('_config', [
        'view' => 'site::checkout.success'
    ])->name('Site.checkout.success');

    //Site buynow button action
    Route::get('buynow/{id}', 'Orca\Site\Http\Controllers\CartController@buyNow')->name('Site.product.buynow');

    //Site buynow button action
    Route::get('move/wishlist/{id}', 'Orca\Site\Http\Controllers\CartController@moveToWishlist')->name('Site.movetowishlist');

    //Show Product Details Page(For individually Viewable Product)
    Route::get('/products/{slug}', 'Orca\Site\Http\Controllers\ProductController@index')->defaults('_config', [
        'view' => 'site::products.view'
    ])->name('Site.products.index');

    // Show Product Review Form
    Route::get('/reviews/{slug}', 'Orca\Site\Http\Controllers\ReviewController@show')->defaults('_config', [
        'view' => 'site::products.reviews.index'
    ])->name('Site.reviews.index');

    // Show Product Review(listing)
    Route::get('/product/{slug}/review', 'Orca\Site\Http\Controllers\ReviewController@create')->defaults('_config', [
        'view' => 'site::products.reviews.create'
    ])->name('Site.reviews.create');

    // Show Product Review Form Store
    Route::post('/product/{slug}/review', 'Orca\Site\Http\Controllers\ReviewController@store')->defaults('_config', [
        'redirect' => 'Site.home.index'
    ])->name('Site.reviews.store');

     // Download file or image
    Route::get('/product/{id}/{attribute_id}', 'Orca\Site\Http\Controllers\ProductController@download')->defaults('_config', [
        'view' => 'Site.products.index'
    ])->name('Site.product.file.download');

    //audience routes starts here
    Route::prefix('audience')->group(function () {
        // forgot Password Routes
        // Forgot Password Form Show
        Route::get('/forgot-password', 'Orca\Audience\Http\Controllers\ForgotPasswordController@create')->defaults('_config', [
            'view' => 'site::audiences.signup.forgot-password'
        ])->name('audience.forgot-password.create');

        // Forgot Password Form Store
        Route::post('/forgot-password', 'Orca\Audience\Http\Controllers\ForgotPasswordController@store')->name('audience.forgot-password.store');

        // Reset Password Form Show
        Route::get('/reset-password/{token}', 'Orca\Audience\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'site::audiences.signup.reset-password'
        ])->name('audience.reset-password.create');

        // Reset Password Form Store
        Route::post('/reset-password', 'Orca\Audience\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'audience.profile.index'
        ])->name('audience.reset-password.store');

        // Login Routes
        // Login form show
        Route::get('login', 'Orca\Audience\Http\Controllers\SessionController@show')->defaults('_config', [
            'view' => 'site::audiences.session.index',
        ])->name('audience.session.index');

        // Login form store
        Route::post('login', 'Orca\Audience\Http\Controllers\SessionController@create')->defaults('_config', [
            'redirect' => 'audience.profile.index'
        ])->name('audience.session.create');

        // Registration Routes
        //registration form show
        Route::get('register', 'Orca\Audience\Http\Controllers\RegistrationController@show')->defaults('_config', [
            'view' => 'site::audiences.signup.index'
        ])->name('audience.register.index');

        //registration form store
        Route::post('register', 'Orca\Audience\Http\Controllers\RegistrationController@create')->defaults('_config', [
            'redirect' => 'audience.session.index',
        ])->name('audience.register.create');

        //verify account
        Route::get('/verify-account/{token}', 'Orca\Audience\Http\Controllers\RegistrationController@verifyAccount')->name('audience.verify');

        //resend verification email
        Route::get('/resend/verification/{email}', 'Orca\Audience\Http\Controllers\RegistrationController@resendVerificationEmail')->name('audience.resend.verification-email');

        // Auth Routes
        Route::group(['middleware' => ['audience']], function () {

            //Audience logout
            Route::get('logout', 'Orca\Audience\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'audience.session.index'
            ])->name('audience.session.destroy');

            //Audience Wishlist add
            Route::get('wishlist/add/{id}', 'Orca\Audience\Http\Controllers\WishlistController@add')->name('audience.wishlist.add');

            //Audience Wishlist remove
            Route::get('wishlist/remove/{id}', 'Orca\Audience\Http\Controllers\WishlistController@remove')->name('audience.wishlist.remove');

            //Audience Wishlist remove
            Route::get('wishlist/removeall', 'Orca\Audience\Http\Controllers\WishlistController@removeAll')->name('audience.wishlist.removeall');

            //Audience Wishlist move to cart
            Route::get('wishlist/move/{id}', 'Orca\Audience\Http\Controllers\WishlistController@move')->name('audience.wishlist.move');

            //audience account
            Route::prefix('account')->group(function () {
                //Audience Dashboard Route
                Route::get('index', 'Orca\Audience\Http\Controllers\AccountController@index')->defaults('_config', [
                    'view' => 'site::audiences.account.index'
                ])->name('audience.account.index');

                //Audience Profile Show
                Route::get('profile', 'Orca\Audience\Http\Controllers\AudienceController@index')->defaults('_config', [
                    'view' => 'site::audiences.account.profile.index'
                ])->name('audience.profile.index');

                //Audience Profile Edit Form Show
                Route::get('profile/edit', 'Orca\Audience\Http\Controllers\AudienceController@edit')->defaults('_config', [
                    'view' => 'site::audiences.account.profile.edit'
                ])->name('audience.profile.edit');

                //Audience Profile Edit Form Store
                Route::post('profile/edit', 'Orca\Audience\Http\Controllers\AudienceController@update')->defaults('_config', [
                    'redirect' => 'audience.profile.index'
                ])->name('audience.profile.edit');
                /*  Profile Routes Ends Here  */

                /*    Routes for Addresses   */
                //Audience Address Show
                Route::get('addresses', 'Orca\Audience\Http\Controllers\AddressController@index')->defaults('_config', [
                    'view' => 'site::audiences.account.address.index'
                ])->name('audience.address.index');

                //Audience Address Create Form Show
                Route::get('addresses/create', 'Orca\Audience\Http\Controllers\AddressController@create')->defaults('_config', [
                    'view' => 'site::audiences.account.address.create'
                ])->name('audience.address.create');

                //Audience Address Create Form Store
                Route::post('addresses/create', 'Orca\Audience\Http\Controllers\AddressController@store')->defaults('_config', [
                    'view' => 'site::audiences.account.address.address',
                    'redirect' => 'audience.address.index'
                ])->name('audience.address.create');

                //Audience Address Edit Form Show
                Route::get('addresses/edit/{id}', 'Orca\Audience\Http\Controllers\AddressController@edit')->defaults('_config', [
                    'view' => 'site::audiences.account.address.edit'
                ])->name('audience.address.edit');

                //Audience Address Edit Form Store
                Route::put('addresses/edit/{id}', 'Orca\Audience\Http\Controllers\AddressController@update')->defaults('_config', [
                    'redirect' => 'audience.address.index'
                ])->name('audience.address.edit');

                //Audience Address Make Default
                Route::get('addresses/default/{id}', 'Orca\Audience\Http\Controllers\AddressController@makeDefault')->name('make.default.address');

                //Audience Address Delete
                Route::get('addresses/delete/{id}', 'Orca\Audience\Http\Controllers\AddressController@destroy')->name('address.delete');

                /* Wishlist route */
                //Audience wishlist(listing)
                Route::get('wishlist', 'Orca\Audience\Http\Controllers\WishlistController@index')->defaults('_config', [
                    'view' => 'site::audiences.account.wishlist.wishlist'
                ])->name('audience.wishlist.index');

                /* Orders route */
                //Audience orders(listing)
                Route::get('orders', 'Orca\Site\Http\Controllers\OrderController@index')->defaults('_config', [
                    'view' => 'site::audiences.account.orders.index'
                ])->name('audience.orders.index');

                //Audience orders view summary and status
                Route::get('orders/view/{id}', 'Orca\Site\Http\Controllers\OrderController@view')->defaults('_config', [
                    'view' => 'site::audiences.account.orders.view'
                ])->name('audience.orders.view');

                //Prints invoice
                Route::get('orders/print/{id}', 'Orca\Site\Http\Controllers\OrderController@print')->defaults('_config', [
                    'view' => 'site::audiences.account.orders.print'
                ])->name('audience.orders.print');

                /* Reviews route */
                //Audience reviews
                Route::get('reviews', 'Orca\Audience\Http\Controllers\AudienceController@reviews')->defaults('_config', [
                    'view' => 'site::audiences.account.reviews.index'
                ])->name('audience.reviews.index');

                //Audience review delete
                Route::get('reviews/delete/{id}', 'Orca\Site\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                    'redirect' => 'audience.reviews.index'
                ])->name('audience.review.delete');

                //Audience all review delete
                Route::get('reviews/all-delete', 'Orca\Site\Http\Controllers\ReviewController@deleteAll')->defaults('_config', [
                    'redirect' => 'audience.reviews.index'
                ])->name('audience.review.deleteall');
            });
        });
    });
    //audience routes end here

    Route::get('pages/{slug}', 'Orca\CMS\Http\Controllers\Site\PagePresenterController@presenter')->name('Site.cms.page');

    Route::fallback('Orca\Site\Http\Controllers\HomeController@notFound');
});

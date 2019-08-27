<?php

namespace Orca\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orca\Checkout\Repositories\CartRepository;
use Orca\Checkout\Repositories\CartItemRepository;
use Orca\Product\Repositories\ProductRepository;
use Orca\Audience\Repositories\AudienceRepository;
use Orca\Audience\Repositories\WishlistRepository;
use Illuminate\Support\Facades\Event;
use Cart;

/**
 * Cart controller for the audience and guest users for adding and
 * removing the products in the cart.
 *
 * @author   <>
 *
 */
class CartController extends Controller
{

    /**
     * Protected Variables that holds instances of the repository classes.
     *
     * @param Array $_config
     * @param $cart
     * @param $cartItem
     * @param $audience
     * @param $product
     * @param $productView
     */
    protected $_config;

    protected $cart;

    protected $cartItem;

    protected $audience;

    protected $product;

    protected $suppressFlash = false;

    /**
     * WishlistRepository Repository object
     *
     * @var array
     */
    protected $wishlist;

    public function __construct(
        CartRepository $cart,
        CartItemRepository $cartItem,
        AudienceRepository $audience,
        ProductRepository $product,
        WishlistRepository $wishlist
    )
    {

        $this->middleware('audience')->only(['moveToWishlist']);

        $this->audience = $audience;

        $this->cart = $cart;

        $this->cartItem = $cartItem;

        $this->product = $product;

        $this->wishlist = $wishlist;

        $this->_config = request('_config');
    }

    /**
     * Method to populate the cart page which will be populated before the checkout process.
     *
     * @return Mixed
     */
    public function index()
    {
        return view($this->_config['view'])->with('cart', Cart::getCart());
    }

    /**
     * Function for guests user to add the product in the cart.
     *
     * @return Mixed
     */
    public function add($id)
    {
        try {
            Event::fire('checkout.cart.add.before', $id);

            $result = Cart::add($id, request()->except('_token'));

            Event::fire('checkout.cart.add.after', $result);

            Cart::collectTotals();

            if ($result) {
                session()->flash('success', trans('site::app.checkout.cart.item.success'));

                if (auth()->guard('audience')->user()) {
                    $audience = auth()->guard('audience')->user();

                    if (count($audience->wishlist_items)) {
                        foreach ($audience->wishlist_items as $wishlist) {
                            if ($wishlist->product_id == $id) {
                                $this->wishlist->delete($wishlist->id);
                            }
                        }
                    }
                }

                return redirect()->back();
            } else {
                session()->flash('warning', trans('site::app.checkout.cart.item.error-add'));

                return redirect()->back();
            }

            return redirect()->route($this->_config['redirect']);

        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));

            return redirect()->back();
        }
    }

    /**
     * Removes the item from the cart if it exists
     *
     * @param integer $itemId
     */
    public function remove($itemId)
    {
        Event::fire('checkout.cart.delete.before', $itemId);

        Cart::removeItem($itemId);

        Event::fire('checkout.cart.delete.after', $itemId);

        Cart::collectTotals();

        return redirect()->back();
    }

    /**
     * Updates the quantity of the items present in the cart.
     *
     * @return response
     */
    public function updateBeforeCheckout()
    {
        try {
            $request = request()->except('_token');

            foreach ($request['qty'] as $id => $quantity) {
                if ($quantity <= 0) {
                    session()->flash('warning', trans('site::app.checkout.cart.quantity.illegal'));

                    return redirect()->back();
                }
            }

            foreach ($request['qty'] as $key => $value) {
                $item = $this->cartItem->findOneByField('id', $key);

                $data['quantity'] = $value;

                Event::fire('checkout.cart.update.before', $item);

                $result = Cart::updateItem($item->product_id, $data, $key);

                if ($result == false) {
                    $this->suppressFlash = true;
                }

                Event::fire('checkout.cart.update.after', $item);

                unset($item);
                unset($data);
            }

            Cart::collectTotals();

            if ($this->suppressFlash) {
                session()->forget('success');
                session()->forget('warning');
                session()->flash('info', trans('site::app.checkout.cart.partial-cart-update'));
            }
        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));
        }

        return redirect()->back();
    }

    /**
     * Add the configurable product
     * to the cart.
     *
     * @return response
     */
    public function addConfigurable($slug)
    {
        session()->flash('warning', trans('site::app.checkout.cart.add-config-warning'));
        return redirect()->route('Site.products.index', $slug);
    }

    public function buyNow($id, $quantity = 1)
    {
        try {
            Event::fire('checkout.cart.add.before', $id);

            $result = Cart::proceedToBuyNow($id, $quantity);

            Event::fire('checkout.cart.add.after', $result);

            Cart::collectTotals();

            if (! $result) {
                return redirect()->back();
            } else {
                return redirect()->route('Site.checkout.onepage.index');
            }
        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));

            return redirect()->back();
        }
    }

    /**
     * Function to move a already added product to wishlist
     * will run only on audience authentication.
     *
     * @param instance cartItem $id
     */
    public function moveToWishlist($id)
    {
        $result = Cart::moveToWishlist($id);

        if (! $result) {
            Cart::collectTotals();

            session()->flash('success', trans('site::app.wishlist.moved'));

            return redirect()->back();
        } else {
            session()->flash('warning', trans('site::app.wishlist.move-error'));

            return redirect()->back();
        }
    }
}
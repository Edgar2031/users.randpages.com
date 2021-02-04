<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// <= ======================== Home page ======================== =>
Route::get('/', 'ManagerController@index');  


// <= ======================== Voyager Admin ======================== =>
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// <= ======================== Sign up page ======================== =>
Route::get('/sign_up', 'UserController@sign_up')->middleware('checking:login');


// <= ======================== Register checking ======================== =>
Route::post('/register', 'UserController@register');


// <= ======================== Sign in page ======================== =>
Route::get('/sign_in', 'UserController@sign_in')->middleware('checking:login');


// <= ======================== Login checking ======================== =>
Route::post('/log_in', 'UserController@log_in');

// <= ======================== Personal area page ======================== =>
Route::get('/personal_area', 'UserController@personal_area')->middleware('checking:users');


// <= ======================== Personal area page ======================== =>
Route::get('/personal_history', 'UserController@personal_history')->middleware('checking:users');


// <= ======================== Personal password page ======================== =>
Route::get('/personal_password', 'UserController@personal_password')->middleware('checking:users');


// <= ======================== Repeat password page ======================== =>
Route::post('/repeat_password', 'UserController@repeat_password');


// <= ======================== User edit ======================== =>
Route::post('/user_edit', 'UserController@user_edit')->middleware('checking:users');


// <= ======================== Logout ======================== =>
Route::get('/logout', 'UserController@g_logout');








// <= ======================== Products by category pages ======================== =>
Route::get('/category/{category}', 'ProductController@products_by_category');


// <= ======================== Products by category and tag pages ======================== =>
Route::get('/category/{category}/{tag}', 'ProductController@products_by_category_and_tag');


// <= ======================== Item product view page ======================== =>
Route::get('/item_product_view/{product_id}', 'ProductController@item_product_view');


// <= ======================== Add star item product ======================== =>
Route::post('/product_item_add_star', 'ProductController@product_item_add_star');




// <= ======================== Add review page ======================== =>
Route::get('/set_review/{product_id}', 'ProductController@set_review')->middleware('checking:users');


// <= ======================== Add review ======================== =>
Route::post('/add_review/{product_id}', 'ProductController@add_review')->middleware('checking:users');






// <= ======================== Products category pages sort ======================== =>
Route::get('/category/{category}/{order_by}/{asc_or_desc}', 'Product_SortController@products_sort_no_tag_category');

Route::get('/category/{category}/{tag}/{order_by}/{asc_or_desc}', 'Product_SortController@products_sort_tag_category');





// <= ======================== Cart page ======================== =>
Route::get('/cart', 'CartController@cart')->middleware('checking:users');


// <= ======================== Add product to cart ======================== =>
Route::post('/product_item_add_to_cart', 'CartController@product_item_add_to_cart');


// <= ======================== Remove product of cart ======================== =>
Route::post('/product_item_remove_of_cart', 'CartController@product_item_remove_of_cart');







// <= ======================== Item product plus count of cart ======================== =>
Route::post('/item_product_plus_count_of_cart', 'CartController@item_product_plus_count_of_cart');


// <= ======================== Item product minus count of cart ======================== =>
Route::post('/item_product_minus_count_of_cart', 'CartController@item_product_minus_count_of_cart');











// <= ======================== Wishlist page ======================== =>
Route::get('/wishlist', 'WishlistController@wishlist')->middleware('checking:users');


// <= ======================== Add product to wishlist ======================== =>
Route::post('/product_item_add_to_wishlist', 'WishlistController@product_item_add_to_wishlist');


// <= ======================== Remove product of wishlist ======================== =>
Route::post('/product_item_remove_of_wishlist', 'WishlistController@product_item_remove_of_wishlist');


// <= ======================== Add product to cart of wishlist ======================== =>
Route::post('/product_item_add_to_cart_of_wishlist', 'WishlistController@product_item_add_to_cart_of_wishlist');




// <= ======================== Comparison page ======================== =>
Route::get('/comparison', 'ComparisonController@comparison')->middleware('checking:users');

// <= ======================== Add product to cart ======================== =>
Route::post('/product_item_add_to_comparison', 'ComparisonController@product_item_add_to_comparison');


// <= ======================== Remove product of cart ======================== =>
Route::post('/product_item_remove_of_comparison', 'ComparisonController@product_item_remove_of_comparison');



// <= ======================== Remove product of comparison ======================== =>
Route::post('/item_product_delete_of_comparison', 'ComparisonController@item_product_delete_of_comparison');











// <= ======================== Stripe ======================== =>
Route::get('/pay_stripe', 'StripeController@stripe');
Route::post('stripe', 'StripeController@stripePost')->name('stripe.post');














// Route::get("/order_history","OrderHistoryController@order_history");



// Route::get("/computers","ProductController@MyProductComputers");

// Route::get("/laptop","ProductController@MyProductLaptop");

// Route::get("/accessories","ProductController@MyProductAccessories");


// Route::get("/service_center","ProductController@MyProductService_center");








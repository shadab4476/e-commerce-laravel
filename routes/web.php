<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ReveiwController;
use App\Http\Controllers\ShopController;

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


Route::group(["middleware" => ["route_verify"]], function () {
    Route::get('email/verify', [AuthController::class, "getEmailPhoneVerify"])->name("get.registerVerify");
    Route::post('email/verify', [AuthController::class, "emailPhoneVerify"])->name("phone.email.verify");
    Route::get('/otp/verify', [AuthController::class, "getVerifyOtp"])->name('get.verifyOtp');
    Route::post('/otp/verify', [AuthController::class, "verifyOtp"])->name('verify.otp');
    Route::post('/resend/otp/verify', [AuthController::class, "resendOTP"])->name('resend.emailOtp');
    Route::get('/index', [AuthController::class, "home"])->name('index');
});
Route::group(["middleware" => ["otp_verify"]], function () {
    Route::group(["middleware" => ["guest"]], function () {
        Route::get('register', [AuthController::class, "getRegister"])->name("get.register");
        Route::post('register', [AuthController::class, "register"])->name("register");
        Route::get('login', [AuthController::class, "getLogin"])->name("get.login");
        Route::post('login', [AuthController::class, "login"])->name("login");
        Route::get('forgot/password', [AuthController::class, "getForgotPassword"])->name("get.forgot.password");
        Route::post('forgot/password', [AuthController::class, "forgotPassword"])->name("forgot.password");
    });

    Route::group(["middleware" => ["auth"]], function () {
        // Active Users ajex
        Route::post('/activeUsers', [UserController::class, "activeUsers"])->name('active.users');
        Route::post('/activeUsersStatus', [UserController::class, "activeUsersStatus"])->name('active.usersStatus');


        // home
        Route::get('/home', [AuthController::class, "home"])->name('home');

        // logout
        Route::get('/logout', [AuthController::class, "logout"])->name('logout');

        // reminder
        Route::post('/reminder/set', [UserController::class, "reminder"])->name('set.reminder');

        // admin side product and category curd
        Route::group(["prefix" => "admin", "middleware" => "role:admin"], function () {
            Route::resource('/products', ProductController::class);
            Route::post('related/image-delete', [ProductController::class, "relatedImageDelete"])->name('related.imageDelete');
            Route::post('related/image-update', [ProductController::class, "relatedImageUpdate"])->name('related.imageUpdate');

            Route::resource('/categories', CategoryController::class);
            Route::resource('/users', AdminUserController::class);
        });

        // cart 
        Route::post('cart_qty', [CartController::class, "cartQty"])->name('cart.qty');
        Route::resource('carts',  CartController::class);

        // profile update
        Route::get('account', [UserController::class, "edit"])->name('get.accountDetail');
        Route::post('account', [UserController::class, "update"])->name('update.accountDetail');
        Route::get('account/address', [AddressController::class, "index"])->name('get.addressDetail');
        Route::post('account/address/update', [AddressController::class, "store"])->name('update.addressDetail');
        Route::delete('account/address/{id}', [AddressController::class, "destroy"])->name('delete.addressDetail');
        Route::post('account/address/email', [UserController::class, "emailUpdate"])->name('profile-email.update');
        Route::post('account/address/emailVerify', [UserController::class, "emailUpdate"])->name('update-email.otpVerify');
        Route::post('phone/update', [UserController::class, "phoneUpdate"])->name('phone.update');
        Route::post('change/password', [UserController::class, "changePass"])->name('change.password');


        // review send
        Route::post('reveiw', [ReveiwController::class, "review"])->name('send.review');

        // checkout
        Route::post('/change/address/data', [CheckoutController::class, "addressChanged"])->name("address.change");
        Route::get('/checkout/{id}', [CheckoutController::class, "getCheckout"])->name("product.checkout");
        Route::get('/cart/checkout', [CheckoutController::class, "getCartCheckout"])->name("product.cartCheckout");
        // order confirm
        Route::post("/order/confirm", [CheckoutController::class, "orderConfirm"])->name("order.confirm");

        // order confirm Cart
        Route::post("/order/confirm/cart", [CheckoutController::class, "orderConfirmCart"])->name("order.confirmCart");
        // thankyou page
        Route::get("thankyou/{id?}", [CheckoutController::class, "thankyou"])->name("thankyou");

        // check all order
        Route::get("orders/{name?}", [OrderController::class, "index"])->name("order.index");
        Route::post("orders/detail/{id}", [OrderController::class, "orderDetail"])->name("order.detail");
        // order qty
        Route::post('order_qty', [OrderController::class, "orderQty"])->name('order.qty');
    });
});

// All Globle routes  


// home
Route::get('/', [AuthController::class, "home"])->name('index');
// contect  
Route::get('/contect', [PagesController::class, "contect"])->name('contect.page');
// about
Route::get('/about', [PagesController::class, "about"])->name('about.page');

// Shop
Route::resource('shop', ShopController::class);

// product view
// Route::group(["middleware" => "role:user"], function () {
Route::get('/products/{id}', [ProductController::class, "show"])->name("product.show");
// });

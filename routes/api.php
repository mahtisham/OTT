<?php

use Illuminate\Http\Request;
use App\User;
use App\HideForMe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
//Route::post('/check-for-update', 'UpdateController@checkforupate');
// });
 
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('sociallogin', 'Api\Auth\LoginController@sociallogin');
// Route::post('googlelogin', 'Api\Auth\LoginController@googlelogin');
Route::get('home', 'Api\MainController@home');
Route::post('register', 'Api\Auth\RegisterController@register');
Route::post('verifyemail', 'Api\Auth\RegisterController@verifyemail');
Route::post('refresh', 'Api\Auth\LoginController@refresh');
Route::post('forgotpassword', 'Api\Auth\LoginController@forgotApi');
Route::post('verifycode', 'Api\Auth\LoginController@verifyApi');
Route::post('resetpassword', 'Api\Auth\LoginController@resetApi');
Route::get('faq', 'Api\MainController@faq');
Route::post('addcomment', 'Api\RatingCommentController@comment_store');
Route::get('detail/{id}', 'Api\MainController@detail');

Route::group(['middleware' => ['auth:api', 'is_blocked']], function () {
    Route::get('menu', 'Api\MainController@menu');
    Route::get('movie', 'Api\MainController@movie');
    Route::get('tvseries', 'Api\MainController@tvseries');
    Route::get('movietv', 'Api\MainController@movietv');
    Route::get('main', 'Api\MainController@index');
    Route::post('logout', 'Api\Auth\LoginController@logoutApi');
    Route::get('userProfile', 'Api\MainController@userProfile');
    Route::get('package', 'Api\MainController@package');
    Route::get('slider', 'Api\MainController@slider');
    Route::get('advPlayer', 'Api\MainController@advPlayer');
    Route::get('audio', 'Api\MainController@audio');
    Route::get('liveEvent', 'Api\MainController@liveEvent');
    Route::get('customPage', 'Api\MainController@customPage');
    Route::get('filter/{menuid}/{menuname}', 'Api\MainController@filter');
    Route::get('language', 'Api\MainController@language');
    Route::get('reminderSubscription', 'Api\MainController@reminderSubscription');
    Route::get('languageTranslator', 'Api\MainController@languageTranslator');
    Route::get('wallet', 'Api\MainController@wallet');
    Route::get('affilate', 'Api\MainController@affilate');
    Route::get('topRated/{menu}', 'Api\MainController@topRated');
    Route::get('allang/{id}', 'Api\MainController@showallalang');
    Route::get('currency', 'Api\MainController@currency');
    Route::get('currency-switch/{currency}', 'Api\MainController@switchCurrency');
    Route::post('hideforme', 'Api\MainController@hideForMe');
    Route::post('subscribed', 'Api\MainController@subscribed');
    Route::get('appUiShorting', 'Api\MainController@appUiShorting');
    Route::get('view', 'Api\MainController@view');
    Route::get('countView', 'Api\MainController@countView');
    Route::get('ipBlock', 'Api\MainController@ipblock');
    Route::get('geoloaction', 'Api\MainController@geoloaction');
    Route::get('banneradd', 'Api\MainController@banneradd');

    // Route::get('footer', 'Api\MainController@footer_details');
    Route::get('RecentMovies', 'Api\MainController@RecentMovies');
    Route::get('RecentTvSeries', 'Api\MainController@Recenttvseries');
    Route::get('MenuByCategory/{id}', 'Api\MainController@MovieByCategory');
    Route::get('episodes/{id}', 'Api\MainController@episodes');

    Route::get('watchhistory', 'Api\MainController@watch_history');
    Route::get('addwatchhistory/{type}/{id}', 'Api\MainController@add_history');
    Route::get('delete_watchhistory', 'Api\MainController@watchistorydelete');
    Route::get('delete_watchhistory/{type}/{id}', 'Api\MainController@delete_history');
    Route::get('checkwishlist/{type}/{id}', 'Api\MainController@check_wishlist');
    Route::get('showwishlist', 'Api\MainController@show_wishlist');
    Route::get('removemovie/{id}', 'Api\MainController@removemovie');
    Route::get('removeseason/{id}', 'Api\MainController@removeseason');
    Route::post('addwishlist', 'Api\MainController@add_wishlist');

    Route::post('rating', 'Api\RatingCommentController@rating');
    Route::get('checkrating/{type}/{id}', 'Api\RatingCommentController@checkrating');
    Route::post('addreply', 'Api\RatingCommentController@reply');

    Route::post('profileupdate', 'Api\MainController@updateprofile');

    Route::post('stripeprofile', 'Api\PaymentController@stripeprofile');
    Route::get('stripeupdate/{id}/{value}', 'Api\PaymentController@stripeupdate');
    Route::get('paypalupdate/{id}/{value}', 'Api\PaymentController@paypalupdate');
    Route::get('stripedetail', 'Api\PaymentController@stripedetail');
    Route::get('bttoken', 'Api\PaymentController@bttoken');
    Route::post('btpayment', 'Api\PaymentController@btpayment');
    Route::post('paystack', 'Api\PaymentController@paystack');
    Route::post('paystore', 'Api\PaymentController@pay_store');

    Route::get('showscreens', 'Api\MultipleScreenController@manageprofile');
    Route::post('changescreen', 'Api\MultipleScreenController@changescreen');
    Route::post('screenprofile', 'Api\MultipleScreenController@screenprofile');
    Route::post('updatescreen', 'Api\MultipleScreenController@newupdate');
    Route::post('downloadcounter', 'Api\MultipleScreenController@downloadcounter');

    Route::get('notifications', 'Api\NotificationController@allnotification');
    Route::get('readnotification/{id}', 'Api\NotificationController@notificationread');

    Route::get('coupon', 'Api\MainController@coupon');

    Route::post('verifycoupon', 'Api\MainController@verify_coupon');

    Route::post('free/subscription', 'Api\PaymentController@freeSubscription');

    Route::get('/MovieTvByLanguage/{id}', 'Api\MainController@MovieTvByLanguage');

   

    //invoice Api
    Route::get('/invoice-download/{id}', 'Api\PaymentController@invoicedownload');

    //Manual Payment
    Route::get('manualPayment', 'Api\PaymentController@manual_payment_list');

    Route::post('store/manualPayment','Api\PaymentController@manual_payment_gateway');

    //Advertise
    Route::get('advertise', 'Api\MainController@advertise');
});

Route::post('/check-for-update', 'UpdateController@checkforupate');

Route::get('alllanguage', 'Api\MainController@alllanguage');
Route::get('allusers', 'Api\MainController@allusers');
Route::delete('user/destroy/{id}','Api\MainController@destroy');


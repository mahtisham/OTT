<?php

use App\Faq;
use App\User;
use App\Http\Controllers\HideForMeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*Route::get('/location', function () {

	$ip = Request::ip();
    $data = \Location::get($ip);
   // dd($data);
    var_dump($data);
    die();
   
});*/

Route::get('/location', 'MovieController@get_client_ip');

Route::get('/hidedata',[HideForMeController::class,'show'])->name('hidden.videos');

Route::post('hideforme/', 'HideForMeController@store')->name('hide.for.me');

Route::any('/notify/payhere', 'PayhereController@notify');

Route::get('/verify', 'TestController@getToken');

Route::get('verifylicense', 'InstallerController@verifylicense')->name('verifylicense');
Route::get('/install/procceed/verifyapp', 'InstallerController@verify')->name('verifyApp');
Route::post('verifycode', 'InitializeController@verify');

Route::get('/install/procceed/EULA', 'InstallerController@eula')->name('eulaterm');

Route::post('/install/procceed/EULA', 'InstallerController@storeeula')->name('store.eula');

/** SERVER CHECK**/
Route::get('/install/procceed/serverCheck', 'InstallerController@serverCheck')->name('servercheck');
Route::post('/install/procceed/serverCheck', 'InstallerController@storeserver')->name('store.server');

/** VERIFY COE ENTER*/
Route::get('/install/procceed/basic-setup', 'InstallerController@getBasicSetup')->name('installApp');
Route::post('store/basic-setup', 'InstallerController@storeBasicSetup')->name('storeBasicSetup');

/**  DATABASE SETUP*/
Route::get('/install/procceed/database-setup', 'InstallerController@getDatabaseSetup')->name('db.setup');
Route::post('stored/step2', 'InstallerController@step2')->name('store.step2');
Route::post('stored/step3', 'InstallerController@storeStep3')->name('store.step3');

Route::get('/existing/installation/', 'UpdateController@exitterm')->name('existterm');
Route::post('/existing/update/', 'UpdateController@updateeula')->name('store.updateeula');

Route::post('/change-domain', 'ChangeDomainController@changedomain');

Route::get('/getkids/{id}','KidsSectionController@index')->name('get.kids');
Route::get('/get-kids','KidsSectionController@update')->name('get.kids.mode');

Route::middleware(['IsInstalled', 'isActive', 'switch_languages', 'ip_block', 'comming_soon'])->group(function () {

    Route::get('manualpayment/{id}', 'ManualPaymentController@changemanualpayment')->name('quick.manualpayment.status');

    Route::post('/bttoken', 'BrainTreeController@accesstoken')->name('bttoken');

    Route::get('genre-sort', 'GenreController@sort');

    // download video code
    Route::get('/logout', 'LogoutController@logout')->name('custom.logout');

    Route::view('/offline', 'offline');
    Route::get('download/save/{file}', 'PrimeDetailController@filedownload')->name('file.download');

    Route::get('movie/save/{upload_video}', 'PrimeDetailController@moviedownload')->name('movie.download');
    Route::get('show/save/{upload_video}', 'PrimeDetailController@seasondownload')->name('season.download');
    Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}/{totaltime}', 'TimeHistoryController@movie_time');
    Route::get('/user/tv/time/{endtime}/{tv_id}/{totaltime}', 'TimeHistoryController@tv_time');
    Route::get('/user/watchhistory/{movie_id}/{type}', 'TimeHistoryController@watchhistory');

    Route::get('/user/episode/time/{endtime}/{episode_id}/{user_id}/{tv_id}/{totaltime}', 'TimeHistoryController@episode_time');

    // like and comment routes

    Route::get('comment/index', 'CommentController@index');
    Route::get('movie/comment/index', 'MovieCommentController@index');

    Route::post('movie/comment/store/{id}', 'MovieCommentController@store')->name('movie.comment.store');

    Route::post('movie/comment/reply/{cid}', 'MovieCommentController@reply')->name('movie.comment.reply');

    Route::delete('movie/comment/delete/{id}', 'MovieCommentController@deletecomment')->name('movie.comment.delete');

    Route::delete('movie/comment/reply/delete/{cid}', 'MovieCommentController@deletesubcomment')->name('movie.comment.subdelete');

    Route::get('tvseries/comment/index', 'TVCommentController@index');

    Route::post('tvseries/comment/store/{id}', 'TVCommentController@store')->name('tv.comment.store');

    Route::post('tvseries/comment/reply/{cid}', 'TVCommentController@reply')->name('tv.comment.reply');

    Route::delete('tvseries/comment/delete/{id}', 'TVCommentController@deletecomment')->name('tv.comment.delete');

    Route::delete('tvseries/comment/reply/delete/{cid}', 'TVCommentController@deletesubcomment')->name('tv.comment.subdelete');

    Route::get('unlike/unlike', 'LikeController@unlike')->name('unlike');

    Route::get('like/add', 'LikeController@add')->name('addtolike');

    Route::post('comment/store/{id}', 'CommentController@store')->name('comment.store');

    Route::post('comment/reply/{cid}/{bid}', 'CommentController@reply')->name('comment.reply');

    Route::delete('blog/comment/delete/{id}', 'CommentController@deletecomment')->name('blog.comment.delete');

    Route::delete('blog/comment/reply/delete/{bid}', 'CommentController@deletesubcomment')->name('blog.comment.subdelete');

    Route::get('/movietrailer/{user}/{code}/{id}', 'WatchApiController@watch_trailer');
    Route::get('/tvtrailer/{user}/{code}/{id}', 'WatchApiController@watchtv_trailer');
    Route::get('/watchseason/{user}/{code}/{id}', 'WatchApiController@watch_tv');
    Route::get('/watchmovie/{user}/{code}/{id}', 'WatchApiController@watch_movie');
    Route::get('/watchepisode/{user}/{code}/{id}', 'WatchApiController@watch_episode');
    //api payment thankyou
    Route::get('/payment-successfully', 'WatchApiController@paymentSuccess');

    Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

    Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

    // Test Controller Route to play video

    Route::get('/player', 'TestController@getVideo');

    // Paytem Routes
    Route::resource('/paytem', 'PaytemController');
    Route::get('/paytm-payment-redirect', 'PaytemController@handlePaytmRequest');
    Route::post('/paytm-callback', 'PaytemController@paytmCallback');

    //freepackagesubscription
    Route::post('free/subscription/{planid}', 'ManualPaymentController@freePackageSubscription')->name('free.package.subscription');

    // Routes With Only Language Switch Middleware
    Route::group(['middleware' => ['switch_languages']], function () {
        //Catlog view menus for user without logging in
        Route::get('/guest/{menus}', 'HomeController@guestindex')->name('guests');
        Route::get('/guest/watch/{id}', 'WatchController@watch')->name('guestwatchtrailer');
        Route::get('/guest/watch/tv/{id}', 'WatchController@watchtvtrailer')->name('guestwatchtvtrailer');
        Route::get('movie/guest/detail/{slug}', 'PrimeDetailController@showMovie');
        Route::get('audio/guest/detail/{id}', 'PrimeDetailController@audioshow');
        Route::get('show/guest/detail/{season_slug}', 'PrimeDetailController@showSeasons');
        Route::get('event/guest/detail/{slug}', 'PrimeDetailController@eventshow');
        Route::get('/guest', 'HomeController@mainPage');
        Route::get('/guest/viewall/{menuid}/{menuname}', 'HomeController@showall')->name('guestshowall');
        Route::get('/guest/viewall/movies', 'HomeController@showallsinglemovies')->name('guestshowall2');
        Route::get('/guest/viewall/tvseries', 'HomeController@showallsingletvseries')->name('guestshowall3');
        Route::get('movies/guest/genre/{id}', 'HomeController@movie_genre');
        Route::get('movies/guest/language/{id}', 'HomeController@movie_language');
        Route::get('tvseries/guest/genre/{id}', 'HomeController@tvseries_genre');
        Route::get('tvseries/guest/language/{id}', 'HomeController@tvseries_language');

        Route::get('show/all/guest/genres/{id}', 'HomeController@gusetshowallgenre')->name('show.in.guest.genre');
        Route::get('show/all/guest/langs/{id}', 'HomeController@guestshowallalang')->name('show.in.guest.alang');

        Route::get('home/search', 'HomeController@search')->name('search');
        Route::get('quick/search', 'HomeController@quicksearch')->name('quick.search');

        Route::get('video/detail/director_search/{director}', 'HomeController@director_search');
        Route::get('video/detail/actor_search/{actor}', 'HomeController@actor_search');
        Route::get('video/detail/genre_search/{genre}', 'HomeController@genre_search');

        Route::get('account/blog', 'BlogController@showBlogList')->name('allblog');
        Route::get('account/blog/{slug}', 'BlogController@showBlog');

        Route::get('/page/{slug}', 'CustomPageController@show')->name('custom.page.show');

        if (Auth::user()) {
            // menu routes
            Route::get('/{menu}', 'HomeController@index')->name('home');
        } else {
            // main page route
            Route::get('/', 'HomeController@mainPage');

        }

        // Faq routes

        Route::get('faq', function () {
            $faqs = Faq::all();
            return view('faq', compact('faqs'));
        });

        // general pages routes
        Route::view('terms_condition', 'term_condition');
        Route::view('privacy_policy', 'privacy_pol');
        Route::view('refund_policy', 'refund_pol');
        Route::view('seo', 'seo');

        // Auth Routes
        Auth::routes();

    });

    //Affiliate route

    Route::get('/user/affiliate/settings', 'AffilateController@userdashboard')->name('user.affiliate.settings');

    //2FA
    Route::post('/valid-2fa', 'TwoFactorController@login')->middleware('auth');

    // Language switch middleware
    Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

    // currency switch
    Route::get('currency-switch/{currency}', 'CurrencySwitchController@index')->name('currencySwitch');

    // Routes With Web, Auth Middlewares
    Route::group(['middleware' => ['web', 'auth', 'switch_languages']], function () {
        // User Account routes without subscription
        Route::get('account', 'UserAccountController@index');

        Route::post('/payviarazorpaysuccess/{planid}', 'PayViaRazorpayController@success')->name('paysuccess');

        Route::get('contactus', 'ContactController@contact')->name('contactus');
        Route::post('send/contactus', 'ContactController@send')->name('send.contactus');
        Route::get('account/profile', 'UserAccountController@edit_profile');
        Route::post('account/profile', 'UserAccountController@update_profile')->name('user.profile');
        Route::post('account/profile/age', 'UsersController@update_age')->name('user.age');
        Route::post('account/profile/address', 'UsersController@update_address')->name('user.address');
        Route::post('account/profile/uploadimage', 'UsersController@update_image')->name('user.uploadImage');
        Route::post('account/other/settings', 'UserAccountController@update_otherprofilesetting')->name('user.other.profile');
        Route::get('account/purchaseplan', 'UserAccountController@purchase_plan');
        Route::get('account/purchase/{id}', 'UserAccountController@get_payment')->name('get_payment');
        Route::post('account/purchase', 'UserAccountController@subscribe');
        Route::get('account/billing_history', 'UserAccountController@history');
        Route::post('emailsubscribe', 'emailSubscribe@subscribe');
        Route::post('paypal_subscription', 'PaypalController@postPaymentWithpaypal')->name('paypal_subscription');
        Route::get('paypal_subscription', 'PaypalController@getPaymentStatus')->name('getPaymentStatus');
        Route::get('paypal_subscription_failed', 'PaypalController@getPaymentFailed')->name('getPaymentFailed');
        // rating routes
        Route::POST('video/rating', 'UserRatingController@store');
        Route::POST('video/rating/tv', 'UserRatingController@tvstore');
        // susbscription routes
        Route::get('payment/braintree', 'BrainTreeController@get_bt');
        Route::post('payment/braintree', 'BrainTreeController@payment');
        Route::get('payment/coinpayment', 'CoinpaymentsController@get_bt');
        Route::post('payment/coinpayment', 'CoinpaymentsController@purchaseItems');
        Route::post('payment/paystack', 'PaystackController@paystackgateway');
        Route::get('paystack/callback', 'PaystackController@paystackcallback');
        // Paypal Routes
        Route::get('paypal/cancel-subscription', 'UserAccountController@PaypalCancel')->name('cancelSubPaypal');
        Route::get('paypal/resume-subscription', 'UserAccountController@PaypalResume')->name('resumeSubPaypal');

        # Status Route
        Route::get('payment/status', 'PayuController@status');
        Route::post('payment/payu', 'PayuController@payment');

        //Instamojo Routes
        Route::post('pay/instamojo', 'PayViaInstamojoController@pay')->name('payinstamojo');
        Route::get('instamojo/pay-success', 'PayViaInstamojoController@success');

        //Mollie Payment Routes

        Route::post('payviamollie/subscription', 'PayViaMollieController@payment')->name('payviamoli_subscription');
        Route::get('paymentmolliedone/status', 'PayViaMollieController@success')->name('moli.pay.success_subscription');

        // Cash free payment routes
        Route::post('/payviacashfree', 'PayViaCashFreeController@payment')->name('payviacashfree');
        Route::post('/cashfree/success', 'PayViaCashFreeController@success')->name('payviacashfreesuccess');

        // Omise Payment routes
        Route::post('/payviaomise', 'OmiseController@pay')->name('pay.via.omise');

        //Flutterrave route
        Route::post('/pay', 'FlutterwaveController@initialize')->name('flutterrave.pay');
        Route::get('/rave/callback', 'FlutterwaveController@callback')->name('flutterrave.callback');

        //PayHere Routes
        Route::get('/payhere/callback', 'PayhereController@callback');

        Route::get('account/watchlist/shows', 'WishListController@showWishListTvShows');
        Route::get('account/watchlist', 'WishListController@wishlistshow');
        Route::get('account/watchlist/{slug}', 'WishListController@showWishLists')->name('watchlist');

        Route::get('account/watchlist/movies', 'WishListController@showWishListMovies');
        Route::delete('account/watchlist/showdestroy/{id}', 'WishListController@showdestroy');
        Route::delete('account/watchlist/moviedestroy/{id}', 'WishListController@moviedestroy');
        Route::post('addtowishlist', 'WishListController@addWishList')->name('addtowishlist');

        Route::post('/manualpayment/verify/{planid}', 'ManualPaymentController@store')->name('manualpayment');

        Route::post('/coupon/apply', 'CouponApplyController@get')->name('coupon.apply');

        //2FA

        Route::get('/2fa', 'TwoFactorController@get2fa')->name('2fa.get');
        Route::post('/generate2faSecret', 'TwoFactorController@generate2faSecret');
        Route::post('/2fa-valid', 'TwoFactorController@valid2FA');
        Route::post('/disable-2fa', 'TwoFactorController@disable2FA');

        //generate invoice
        Route::get('invoice/show/{id}', 'UserAccountController@invoice')->name('invoice.show');
        Route::get('invoice/download/{id}', 'UserAccountController@pdfdownload')->name('invoice.download');

        //wallet route
        Route::get('/mywallet', 'WalletController@showWallet')->name('user.wallet.show');
        Route::post('/wallet/payment', 'WalletController@choosepaymentmethod')->name('wallet.choose.paymethod');

        /*Add money using Paytm in wallet*/
        Route::post('/wallet/addmoney/using/paytm', 'WalletController@addMoneyViaPaytm')->name('wallet.add.using.paytm');
        Route::post('/wallet/success/using/paytm', 'WalletController@paytmsuccess');
        /*END*/

        /*Add money using Paypal in wallet*/
        Route::post('/wallet/addmoney/using/paypal', 'WalletController@addMoneyViaPayPal')->name('wallet.add.using.paypal');
        Route::get('/wallet/success/using/paypal', 'WalletController@paypalSuccess');
        /*END*/

        /*Add money using Stripe in wallet*/
        Route::post('/wallet/addmoney/using/stripe', 'WalletController@addMoneyViaStripe')->name('wallet.add.using.stripe');
        Route::post('/wallet/success/using/stripe', 'WalletController@stripesuccess');
        /*END*/

        /*Wallet checkout*/
        Route::post('checkout/with/method/wallet', 'WalletController@checkout')->name('checkout.with.wallet');
        /** End */

    });

    

    Route::group(['middleware' => ['web', 'auth', 'is_subscriber', 'switch_languages', 'TwoFactor']], function () {

        Route::get('/changescreen/{id}', 'MultipleScreenController@newupdate');

        Route::get('/manageprofile/mus/{id}', 'MultipleScreenController@manageprofile')->name('manageprofile');

        Route::post('/manageprofile/mus/{id}', 'MultipleScreenController@updateprofile')->name('mus.pro.update');

    });

    // Routes With Web, Auth And Subscriber Middlewares
    Route::group(['middleware' => ['web', 'auth', 'is_subscriber', 'login_limit', 'switch_languages', 'TwoFactor']], function () {

        Route::get('show/all/genres/{id}', 'HomeController@showallgenre')->name('show.in.genre');

        Route::get('show/all/alang/{id}', 'HomeController@showallalang')->name('show.in.alang');

        Route::get('/viewall/filter/', 'HomeController@filter')->name('filter');

        Route::get('/viewall/{menuid}/{menuname}', 'HomeController@showall')->name('showall');

        Route::get('/viewall/movies', 'HomeController@showallsinglemovies')->name('showall2');

        Route::get('/viewall/tvseries', 'HomeController@showallsingletvseries')->name('showall3');
        // notification
        Route::get('user/notification/read/{id}', 'NotificationController@notificationread')->name('marksingleread');

        // User Main Movies And Shows routes Only With subscription
        Route::get('/{menu}', 'HomeController@index')->name('home');
        Route::get('movie/detail/{slug}', 'PrimeDetailController@showMovie');
        Route::get('show/detail/{season_slug}', 'PrimeDetailController@showSeasons');
        Route::get('event/detail/{slug}', 'PrimeDetailController@eventshow');
        Route::get('audio/detail/{id}', 'PrimeDetailController@audioshow');

        Route::get('movies/genre/{id}', 'HomeController@movie_genre');
        Route::get('movies/language/{id}', 'HomeController@movie_language');
        Route::get('tvseries/genre/{id}', 'HomeController@tvseries_genre');
        Route::get('tvseries/language/{id}', 'HomeController@tvseries_language');

        

        // User Accounts routes With subscription

        Route::delete('account/history/showdestroy/{id}', 'WatchController@showdestroy');
        Route::delete('account/history/moviedestroy/{id}', 'WatchController@moviedestroy');

        Route::get('cancelsubscription/{plan_id}', 'UserAccountController@cancelSub')->name('cancelSub');
        Route::get('resumesubscription/{plan_id}', 'UserAccountController@resumeSub')->name('resumeSub');

        // Api Routes For movie and Tv series
        Route::get('get_movie/{id}', 'ApiController@get_movie')->name('get_movie');
        Route::get('get_season/{id}', 'ApiController@get_season')->name('get_season');
        Route::get('get-video-data/{id}/{type}', 'ApiController@get_video_data');

        Route::get('/watch/{id}', 'WatchController@watch')->name('watchTrailer');
        Route::get('/watch/tv/{id}', 'WatchController@watchtvtrailer')->name('watchtvTrailer');

        Route::get('/watch/tvshow/{id}', 'WatchController@watchTV')->name('watchTvShow');

        Route::get('/watch/movie/{id}', 'WatchController@watchMovie')->name('watchmovie');

        Route::get('/watch/movie/iframe/{id}', 'WatchController@watchMovieiframe')->name('watchmovieiframe');

        Route::get('/watch/event/{id}', 'WatchController@watchEvent')->name('watchevent');

        Route::get('/watch/audiio/{id}', 'WatchController@watchAudio')->name('watchaudio');

        Route::get('/watch/tvshow/episode/{id}', 'WatchController@watchEpisode')->name('watch.Episode');

        Route::get('/account/watchhistory', 'WatchController@watchhistory')->name('watchhistory');

        //Route::get('/account/watchhistory','WatchController@watchistory')->name('watchhistory');
        Route::get('/account/watchhistory/delete', 'WatchController@watchistorydelete');

        Route::get('/download/clicks/update', 'PrimeDetailController@updateclick')->name('updateclick');

        Route::get('/protected/content', 'ProtectedVideoController@video')->name('protectedvideo');
        //Route::get('/protected/content', 'ProtectedpasController@videos');

    });

    // OAuth Routes
    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::post('/pkg/status/{id}', 'PackageController@pkgstatus')->name('pkgstatus');
    Route::post('/appUiShorting/is_active/{id}', 'AppUiShortigController@appmenustatus')->name('appmenustatus');


   

});

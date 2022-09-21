<?php

/** Admin Routes */

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AudioController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LiveEventController;
use App\Http\Controllers\LiveTvController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvseriesController;
use App\Movie;
use App\Season;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use CyrildeWit\EloquentViewable\Support\Period;

Route::group(['middleware' => ['web', 'IsInstalled', 'isActive', 'auth', 'is_admin', 'switch_languages', 'TwoFactor']], function () {

    Route::get('/admin', 'DashboardController@dashboard')->name('dashboard');

    Route::get('/viewstracker', function () {
        $movies = Movie::orderByUniqueViews()->get();
        $season = Season::orderByUniqueViews()->get();
        $movieslw = Movie::orderByUniqueViews('desc', Period::pastWeeks(1))->paginate(10);
        $seasonlw = Season::orderByUniqueViews('desc', Period::pastWeeks(1))->paginate(10);
        $movieslm = Movie::orderByUniqueViews('desc', Period::pastMonths(1))->paginate(10);
        $seasonlm = Season::orderByUniqueViews('desc', Period::pastMonths(1))->paginate(10);
        return view('admin.viewtracker', compact('movies', 'season','movieslw','seasonlw','movieslm','seasonlm'));
    })->name('view.track');
    
    Route::resource('admin/fakeViews', 'FakeViewController');
    Route::resource('admin/fakeSeasonViews', 'FakeSeasonViewController');


    Route::get('/quick/change/status/{id}', 'QuickUpdateController@change')->name('quick.movie.status');

    Route::get('/quick/change/status/tvseries/{id}', 'QuickUpdateController@changetvstatus')->name('quick.tv.status');

    Route::get('/admin/pending/movie', 'MovieController@addedMovies')->name('addedmovies');

    Route::get('/admin/pending/tvshows', 'TvSeriesController@addedTvSeries')->name('addedTvSeries');
    

    Route::get('/admin/pending/livtvs', 'LiveTvController@addedLiveTv')->name('addedLiveTv');

    Route::resource('admin/blog', 'BlogController');

    Route::post('admin/blog/bulk_delete', 'BlogController@bulk_delete');

    Route::post('admin/blog/create', 'BlogController@create');

    Route::patch('admin/blog/update/{id}', 'BlogController@update');

    Route::delete('admin/blog/destroy/{id}', 'BlogController@destroy');

    Route::resource('admin/banneradd', 'BannerAdvertismentController');

    Route::post('admin/banneradd/bulk_delete', 'BannerAdvertismentController@bulk_delete');

    Route::post('admin/banneradd/create', 'BannerAdvertismentController@create');

    Route::patch('admin/banneradd/update/{id}', 'BannerAdvertismentController@update');

    Route::delete('admin/banneradd/destroy/{id}', 'BannerAdvertismentController@destroy');

    Route::post('admin/movie/{id}/addsubtitle', 'SubtitleController@post')->name('add.subtitle');

    Route::post('admin/movie/{id}/delete/subtitle', 'SubtitleController@delete')->name('del.subtitle');

    Route::get('admin/profile', function () {
        $auth = Auth::user();
        return view('admin.profile', compact('auth'));
    });

    Route::get('/admin/player-setting', 'PlayerSettingController@get')->name('player.set');
    Route::post('/admin/player-setting/update', 'PlayerSettingController@update')->name('player.update');

    Route::resource('admin/menu', 'MenuController');
    Route::post('admin/menu/bulk_delete', 'MenuController@bulk_delete');
    Route::post('admin/menu/reposition', 'MenuController@reposition')->name('menu_reposition');
    Route::resource('admin/menuSectionShorting', 'MenuSectionShortingController');
    Route::post('admin/menuSection/reposition', 'MenuSectionShortingController@reposition')->name('menu_section_reposition');

    Route::resource('admin/app-menu', 'AppMenuController');
    Route::post('admin/app-menu/bulk_delete', 'AppMenuController@bulk_delete');
    Route::post('admin/app-menu/reposition', 'AppMenuController@reposition')->name('app_menu_reposition');

    Route::resource('admin/users', 'UsersController');
    Route::get('admin/user/status/{id}', 'UsersController@changestatus');
    Route::get('country-state-city','UsersController@getcountry');
    Route::post('get-states-by-country','UsersController@getState');
    Route::post('get-cities-by-state','UsersController@getCity');

    Route::get('user/subscription/{id}', 'UsersController@change_subscription_show')->name('change_subscription_show');
    Route::post('user/subscription', 'UsersController@change_subscription')->name('change_subscription');
    Route::post('admin/users/bulk_delete', 'UsersController@bulk_delete');
    Route::resource('admin/movies', 'MovieController');
    Route::get('admin/movie/upload_video/converting', 'MovieController@upload_video');
    Route::get('admin/tvshow/upload_video/converting', 'TvSeriesController@upload_video');
    Route::get('admin/movie/vimeoapi', 'MovieController@vimeoApicall');
    Route::get('admin/movies/link/{id}', 'MovieController@multiplelinks')->name('movies.link');
    Route::post('admin/movies/createlink/{id}', 'MovieController@storelink')->name('movies.storelink');
    Route::patch('admin/movies/editlink/{id}', 'MovieController@editlink')->name('movies.editlink');
    Route::delete('admin/movies/deletelink/{id}', 'MovieController@deletelink')->name('movies.deletelink');

    Route::get('admin/movies/tmdb/translations', 'MovieController@tmdb_translations')->name('tmdb_movie_translate');
    Route::post('admin/movies/bulk_delete', 'MovieController@bulk_delete');

    // live tv routes
    Route::resource('admin/livetv', 'LiveTvController');
    Route::get('admin/livetv/upload_video/converting', 'LiveTvController@upload_video');
    Route::get('admin/livetv/vimeoapi', 'LiveTvController@vimeoApicall');

    Route::get('admin/livetv/tmdb/translations', 'LiveTvController@tmdb_translations')->name('tmdb_livetv_translate');
    Route::post('admin/livetv/bulk_delete', 'LiveTvController@bulk_delete');

    // Live events routes

    Route::resource('admin/liveevent', 'LiveEventController');
    Route::post('admin/liveevent/bulk_delete', 'LiveEventController@bulk_delete');

    Route::resource('admin/audio', 'AudioController');
    Route::post('admin/audio/bulk_delete', 'AudioController@bulk_delete');

    // director controller

    Route::resource('admin/directors', 'DirectorController');
    Route::post('admin/directors/bulk_delete', 'DirectorController@bulk_delete');
    Route::resource('admin/actors', 'ActorController');
    Route::post('admin/actors/bulk_delete', 'ActorController@bulk_delete');

    // Genres Routes
    Route::resource('admin/genres', 'GenreController');
    Route::post('admin/genres/bulk_delete', 'GenreController@bulk_delete');
    Route::get('admin/update-to-english', 'GenreController@updateAll');

    Route::get('admin/front/slider/limit', 'SlideUpdateController@get')->name('front.slider.limit');

    Route::post('admin/front/slider/limit/{id}', 'SlideUpdateController@update')->name('front.slider.update');

    Route::resource('admin/packages', 'PackageController');
    Route::delete('/admin/packages/softdelete/{id}', 'PackageController@softDelete');
    Route::post('admin/packages/bulk_delete', 'PackageController@bulk_delete');
    Route::post('admin/packages/reposition', 'PackageController@reposition')->name('package_reposition');
    Route::resource('admin/faqs', 'FaqController');
    Route::post('admin/faqs/bulk_delete', 'FaqController@bulk_delete');
    Route::post('admin/faqs/reposition', 'FaqController@reposition')->name('faqs_reposition');
    Route::resource('admin/languages', 'LanguageController');
    Route::post('admin/languages/bulk_delete', 'LanguageController@bulk_delete');
    Route::resource('admin/settings', 'ConfigController');
    Route::get('admin/api-settings', 'ConfigController@setApiView');
    Route::post('admin/api-settings', 'ConfigController@changeEnvKeys');

    /*Mail Setting Routes*/
    Route::get('/admin/mail-setting', 'ConfigController@getset')->name('mail.getset');
    Route::post('admin/mail-settings', 'ConfigController@changeMailEnvKeys');
    /* end */

    /*Custom style css ad js routes*/
    Route::get('/admin/custom-style-settings', 'CustomStyleController@addStyle')->name('customstyle');
    Route::post('/admin/custom-style-settings/addcss', 'CustomStyleController@storeCSS')->name('css.store');
    Route::post('/admin/custom-style-settings/addjs', 'CustomStyleController@storeJS')->name('js.store');
    /*end*/

    /*custom price text routes*/
    Route::get('/admin/pricing-text-set/{planid}', 'CustomStyleController@pricingText')->name('pricing.text');
    Route::post('/admin/pricing-text-settings/update', 'CustomStyleController@pricingTextUpdate')->name('pr.update');
    Route::get('/admin/pricing-text-settings/get/{id}', 'CustomStyleController@getpricingText')->name('pricing.get');
    /*end*/

    Route::get('/admin/customize/social', 'SocialIconController@get')->name('social.ico');
    Route::post('/admin/customize/social', 'SocialIconController@post')->name('socialic');

    // notification route
    Route::resource('/admin/notification', 'NotificationController');
    Route::get('/admin/notification/send', 'NotificationController@sendNotification');
    Route::post('admin/notification/bulk_delete', 'NotificationController@bulk_delete');

    Route::resource('admin/seo', 'SeoController');
    Route::resource('admin/plan', 'PlanController');

    Route::post('admin/plan/bulk_delete', 'PlanController@bulk_delete');
    Route::post('admin/plan/change_subscription', 'PlanController@change_subscription');

    Route::get('admin/ads', 'AdsController@getAds')->name('ads');
    Route::post('admin/ads/insert', 'AdsController@store')->name('ad.store');

    Route::get('admin/ads/setting', 'AdsController@getAdsSettings')->name('ad.setting');

    Route::put('admin/ads/timer', 'AdsController@updateAd')->name('ad.update');

    Route::put('admin/ads/pop', 'AdsController@updatePopAd')->name('ad.pop.update');

    Route::delete('admin/ads/delete/{id}', 'AdsController@delete')->name('ad.delete');

    Route::get('admin/ads/create', 'AdsController@create')->name('ad.create');

    Route::get('admin/ads/edit/{id}', 'AdsController@showEdit')->name('ad.edit');

    Route::put('admin/ads/edit/{id}', 'AdsController@updateADSOLO')->name('ad.update.solo');

    Route::put('admin/ads/video/{id}', 'AdsController@updateVideoAD')->name('ad.update.video');

    Route::post('admin/ads/bulk_delete', 'AdsController@bulk_delete');

    //Google Ads

    Route::get('admin/googleads/', 'GoogleAdsController@index')->name('google.ads');
    Route::get('admin/googleads/create', 'GoogleAdsController@create')->name('google.ads.create');
    Route::post('admin/googleads/create', 'GoogleAdsController@store')->name('google.ads.store');
    Route::get('admin/googleads/edit/{id}', 'GoogleAdsController@edit')->name('google.ads.edit');
    Route::put('admin/googleads/update/{id}', 'GoogleAdsController@update')->name('google.ads.update');
    Route::delete('admin/googleads/delete/{id}', 'GoogleAdsController@destroy')->name('google.ads.delete');
    Route::post('admin/googleads/bulk_delete', 'GoogleAdsController@bulk_delete');

    //ajax director
    Route::get('admin/directors/using/ajax', 'DirectorController@ajaxstore')->name('ajax.director');
    Route::get('admin/listofd', 'DirectorController@listofd')->name('listofd');

    //ajax actor

    Route::get('admin/actors/using/ajax', 'ActorController@ajaxstore')->name('ajax.actor');
    Route::get('admin/listofactor', 'ActorController@listofactor')->name('listofactor');

    // coupon controllers
    Route::resource('admin/coupons', 'CouponController');
    Route::post('admin/coupons/bulk_delete', 'CouponController@bulk_delete');
    Route::resource('admin/audio_language', 'AudioLanguageController');
    Route::post('admin/audio_language/bulk_delete', 'AudioLanguageController@bulk_delete');
    Route::resource('admin/home_slider', 'HomeSliderController');
    Route::post('admin/home_slider/bulk_delete', 'HomeSliderController@bulk_delete');
    Route::post('admin/home_slider/reposition', 'HomeSliderController@slide_reposition')->name('slide_reposition');
    Route::resource('admin/tvseries', 'TvSeriesController');
    Route::post('admin/tvseries/bulk_delete', 'TvSeriesController@bulk_delete');
    Route::get('admin/tvseries/tmdb/translations', 'TvSeriesController@tmdb_translations')->name('tmdb_tv_translate');
    Route::post('admin/tvseries/seasons', 'TvSeriesController@store_seasons');
    Route::patch('admin/tvseries/seasons/{id}', 'TvSeriesController@update_seasons');
    Route::delete('admin/tvseries/seasons/{id}', 'TvSeriesController@destroy_seasons');
    Route::get('admin/tvseries/seasons/{id}/episodes', 'TvSeriesController@show_episodes')->name('show_episodes');
    Route::get('admin/tvseries/seasons/{id}/episodes/{ep_id}',
        'TvSeriesController@edit_episodes')->name('edit_episodes');
    Route::post('admin/tvseries/seasons/episodes', 'TvSeriesController@store_episodes');
    Route::delete('admin/tvseries/seasons/episodes/{id}', 'TvSeriesController@destroy_episodes');
    Route::patch('admin/tvseries/seasons/episodes/{id}', 'TvSeriesController@update_episodes');

    Route::get('admin/tvseries/seasons/episodes/link/{id}', 'TvSeriesController@multiplelinks')->name('episode.link');
    Route::post('admin/tvseries/seasons/episodes/createlink/{id}', 'TvSeriesController@storelink')->name('episode.storelink');
    Route::patch('admin/tvseries/seasons/episodes/editlink/{id}', 'TvSeriesController@editlink')->name('episode.editlink');
    Route::delete('admin/tvseries/seasons/episodes/deletelink/{id}', 'TvSeriesController@deletelink')->name('episode.deletelink');

    Route::get('admin/report', 'ReportController@get_report');

    /**************** revenue report ************************/
    Route::get('admin/report_revenue', 'ReportController@get_revenue_report')->name('revenue.report');
    Route::get('admin/report/data', 'ReportController@ajaxonLoad')->name('ajaxdatefilter');

    /*page setting routes*/
    Route::get('/admin/page-settings/', 'CustomStyleController@getPage')->name('pageset');

    Route::put('/admin/page-settings/{id}', 'CustomStyleController@updatePage')->name('pageset.update');

    /*Social Login setting routes*/
    Route::get('/admin/social-login/', 'SocialLoginController@index')->name('sociallogin');
    Route::put('/admin/social-login/{id}', 'SocialLoginController@updatePage')->name('sociallogin.update');
    Route::get('admin/social-login/', 'SocialLoginController@facebook')->name('set.facebook');
    Route::post('admin/facebook', 'SocialLoginController@updateFacebookKey')->name('key.facebook');
    Route::post('admin/google', 'SocialLoginController@updateGoogleKey')->name('key.google');
    Route::post('admin/gitlab', 'SocialLoginController@updategitlabKey')->name('key.gitlab');
    Route::post('admin/amazon', 'SocialLoginController@updateamazonKey')->name('key.amazon');

    /*end*/
    // adsense routes
    Route::get('/admin/adsensesetting/', 'AdsenseController@index')->name('adsense');
    Route::put('/admin/adsensesetting/{id}', 'AdsenseController@update')->name('adsense.update');

    /////////////////////////
    // Customizable Routes //
    /////////////////////////
    Route::resource('admin/customize/landing-page', 'LandingPageController');
    Route::post('admin/customize/landing-page/bulk_delete', 'LandingPageController@bulk_delete');
    Route::post('admin/customize/landing-page/reposition', 'LandingPageController@reposition')->name('landing_page_reposition');
    Route::get('admin/customize/auth-page-customize', 'AuthCustomizeController@index');
    Route::post('admin/customize/auth-page-customize', 'AuthCustomizeController@store');

    /////////////////////////
    // Customizable pages Routes //
    /////////////////////////
    Route::resource('admin/custom_page', 'CustomPageController');

    Route::resource('admin/home-block', 'HomeBlockController');

    Route::post('admin/home-block/bulk_delete', 'HomeBlockController@bulk_delete');


    Route::delete('admin/custom_page/destroy/{id}', 'CustomPageController@destroy')->name('custom-page.destroy');
    Route::post('admin/custom_page/bulk_delete', 'CustomPageController@bulk_delete');

    //PWA Settings

    Route::get('/pwa-settings', 'PWAController@index')->name('pwa.setting.index');

    Route::post('/pwa/update/setting', 'PWAController@updatesetting')->name('pwa.setting.update');

    Route::post('/pwa/update/icons/setting', 'PWAController@updateicons')->name('pwa.icons.update');

    //manual payment

    Route::resource('admin/manual-payment', 'ManualPaymentController');

    //chat settings
    Route::get('admin/chat_settings', 'ChatSettingController@index')->name('chat.index');

    Route::post('admin/chat_settings', 'ChatSettingController@update');

    // Site Policies Get Method
    Route::get('admin/term&con', function () {
        $config = \App\Config::whereId(1)->first();
        return view('admin.term&con', compact('config'));
    })->name('term_con');
    Route::get('admin/pri_pol', function () {
        $config = \App\Config::whereId(1)->first();
        return view('admin.pri_pol', compact('config'));
    })->name('pri_pol');
    Route::get('admin/refund_pol', function () {
        $config = \App\Config::whereId(1)->first();
        return view('admin.refund_pol', compact('config'));
    })->name('refund_pol');
    Route::get('admin/copyright', function () {
        $config = \App\Config::whereId(1)->first();
        return view('admin.copyright', compact('config'));
    })->name('copyright');

    // Site Policies Patch Method
    Route::patch('admin/term&con', function (\Illuminate\Http\Request $request) {
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['terms_condition'] = clean($request->terms_condition);
        $config->update($input);
        return back()->with('updated', 'Terms & Condition has been updated');
    })->name('term&con');
    Route::patch('admin/pri_pol', function (\Illuminate\Http\Request $request) {
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['privacy_pol'] = clean($request->privacy_pol);
        $config->update($input);
        return back()->with('updated', 'Privacy Policy has been updated');
    })->name('pri_pol');
    Route::patch('admin/refund_pol', function (\Illuminate\Http\Request $request) {
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['refund_pol'] = clean($request->refund_pol);
        $config->update($input);
        return back()->with('updated', 'Refund Policy has been updated');
    })->name('refund_pol');
    Route::patch('admin/copyright', function (\Illuminate\Http\Request $request) {
        $config = \App\Config::whereId(1)->first();
        $input = $request->all();
        $input['copyright'] = clean($request->copyright);
        $config->update($input);
        return back()->with('updated', 'Copyright text has been updated');
    })->name('copyright');

    /////////////////////////////////
    // Language Translation Routes //
    /////////////////////////////////
    

    Route::get('/admin/translation/{local}', 'LanguageController@staticword')->name('languages.staticword');

    Route::post('/admin/update/{lang}/frontTranslations/content','LanguageController@frontupdate')->name('static.update');

    Route::get('admin/adminstatic/{local}', 'LanguageController@adminstaticword')->name('adminstatic.lang');

    Route::post('/admin/update/{lang}/adminTranslations/content','LanguageController@adminupdate')->name('admin.static.update');

    Route::get('/admin/edit/{lang}/staticTranslations', 'LanguageController@editStaticTrans')->name('static.trans');

    Route::post('/admin/update/{lang}/staticTranslations/content', 'LanguageController@updateStaticTrans')->name('static.trans.update');

    Route::post('/admin/update/{lang}/adminstaticTranslations/content', 'LanguageController@updateAdminStaticTrans')->name('static.admin.trans.update');

    Route::get('admin/lang', 'LanguageController@showlang')->name('show.lang');

    Route::get('admin/custom-static-words', 'LanguageController@customstatic');

    Route::get('admin/header-translations', 'HeaderTranslationController@index')->name('header-translation-index');
    Route::post('admin/header-translations', 'HeaderTranslationController@update');

    // Footer Translation Routes
    Route::get('admin/footer-translations', 'FooterTranslationController@index')->name('footer-translation-index');
    Route::post('admin/footer-translations', 'FooterTranslationController@update');

    // Home Page Translation Routes
    Route::get('admin/home-translations', 'HomeTranslationController@index')->name('home-translation-index');
    Route::post('admin/home-translations', 'HomeTranslationController@update');

    // Popover Detail Translation Routes
    Route::get('admin/popover-detail-translations', 'PopoverTranslationController@index')->name('popover-detail-translation-index');
    Route::post('admin/popover-detail-translations', 'PopoverTranslationController@update');

    Route::get('/admin/device-history', 'DashboardController@device_history')->name('device_history');

    //package feature
    Route::resource('admin/package_feature', 'PackageFeatureController');
    Route::post('admin/package_feature/bulk_delete', 'PackageFeatureController@bulk_delete');

    //mobile app settings route

    Route::resource('admin/appsettings', 'AppConfigController');

    //app slider

    Route::resource('admin/appslider', 'AppSliderController');
    Route::post('admin/appslider/bulk_delete', 'AppSliderController@bulk_delete');
    Route::post('admin/appslider/reposition', 'AppSliderController@slide_reposition')->name('app_slide_reposition');

    //App ui Shorting
    Route::resource('admin/appUiShorting', 'AppUiShortigController');
    Route::post('admin/appUi/reposition', 'AppUiShortigController@reposition')->name('app_ui_reposition');

    // Database Backup

    Route::get('admin/backups/', 'BackupController@get')->name('admin.backup.settings');
    Route::post('admin/backup/path', 'BackupController@updatepath')->name('admin.backup.path');
    Route::get('admin/download/{filename}', 'BackupController@download')->name('admin.backup.download');
    Route::get('admin/backups/process', 'BackupController@process')->name('admin.backup.process');

    //clear cache
    Route::get('admin/clear-cache', 'BackupController@clearcahe')->name('clear.cache');

    // System Status
    Route::get('admin/system-status', 'BackupController@system_status')->name('system.status');

    // remove public
    Route::get('admin/remove/public', 'BackupController@getremove_public')->name('get.remove.public');
    Route::post('admin/remove-public', 'BackupController@remove_public')->name('remove.public');

    //onesignal notification route
    Route::get('/admin/push-notifications', 'PushNotificationsController@index')->name('admin.push.noti.settings');
    Route::post('/admin/one-signal/keys', 'PushNotificationsController@updateKeys')->name('admin.onesignal.keys');
    Route::post('/admin/push-notifications', 'PushNotificationsController@push')->name('admin.push.notif');

    //menual payment method
    Route::get('admin/manual-payment-settings', 'ManualPaymentGatewayController@getindex')->name('manual.payment.gateway');
    Route::post('admin/manual-payment-settings', 'ManualPaymentGatewayController@store')->name('manual.payment.gateway.store');
    Route::post('admin/manual-payment-settings/{id}', 'ManualPaymentGatewayController@update')->name('manual.payment.gateway.update');
    Route::delete('admin/manual-payment-settings/{id}', 'ManualPaymentGatewayController@delete')->name('manual.payment.gateway.delete');

    //Addon Manager Route
    Route::get('/admin/addon-manger', 'AddOnManagerController@index')->name('addonmanger.index');
    Route::post('/admin/toggle/module', 'AddOnManagerController@toggle');
    Route::post('/admin/addon/install', 'AddOnManagerController@install')->name('addon.install');
    Route::post('/admin/addon/delete', 'AddOnManagerController@delete')->name('addon.delete');

    //Label Routes
    Route::resource('/admin/label', 'LabelController');
    Route::post('admin/label/bulk_delete', 'LabelController@bulk_delete');

    //Comment in admin

    Route::get('/admin/comments', 'AdminCommentController@index')->name('admin.comment.index');
    Route::delete('/admin/comments/{id}', 'AdminCommentController@destroy')->name('comments.destroy');
    Route::get('/quick/change/comment_status/{id}', 'QuickUpdateController@commentchange')->name('quick.comment.status');
    Route::post('admin/comments/bulk_delete', 'AdminCommentController@bulk_delete');

    //SubComment settings in Admin

    Route::get('/admin/subcomments', 'AdminCommentController@subcommentindex')->name('admin.subcomment.index');
    Route::delete('/admin/subcomments/{id}', 'AdminCommentController@subcommentdestroy')->name('subcomments.destroy');
    Route::get('/quick/change/subcomment_status/{id}', 'QuickUpdateController@subcommentchange')->name('quick.subcomment.status');
    Route::post('admin/subcomments/bulk_delete', 'AdminCommentController@sub_bulk_delete');

    //color scheme
    Route::get('admin/color-scheme', 'ColorSchemeController@index')->name('admin.color.scheme');
    Route::post('admin/color-scheme/store', 'ColorSchemeController@store');

    //Quickfix update
    Route::post('/admin/merge-quick-update', 'UpdateController@mergeQuickupdate');

    //currency routes
    Route::resource('/admin/currency', 'CurrencyController');

    Route::post('/admin/save/exchange/key', 'CurrencyController@saveSetting')->name('currency.exchanges.save');

    Route::post("/admin/auto_update_currency", "CurrencyController@auto_update_currency")->name('auto.update.rates');

    Route::get("/admin/checkout-currency/{id}", "CurrencyController@checkoutCurrency");

    Route::post("/admin/checkout-currency/payment/update", "CurrencyController@checkoutPayment")->name('checkout.payment.method');

    //roles and permission
    Route::resource('/admin/roles', 'Roles\RolesController');
    Route::view('permission', 'per');
    Route::view('permission/bulk', 'perbulk');
    Route::post('permission/bulk', 'Roles\RolesController@bulkPermission');
    Route::post('permission', 'Roles\RolesController@createPermission');
    Route::get('admin/roles/{id}/delete', 'Roles\RolesController@destroy');

    //import demo
    Route::get('/admin/import-demo', 'OtherController@getImportDemo')->name('admin.import.demo');
    Route::post('/admin/import/import-demo', 'OtherController@ImportDemo');
    Route::post('/admin/reset-demo', 'OtherController@DemoReset');

    //get secret key for api
    Route::get('getsecretkey', 'AppConfigController@getkey')->name('get.api.key');
    Route::post('createkey', 'AppConfigController@createKey')->name('apikey.create');

    //affliate routes

    Route::name('admin.affilate.')->prefix('/admin/affiliate')->group(function () {

        Route::get('/settings', 'AffilateController@settings')->name('settings');
        Route::post('/settings', 'AffilateController@update')->name('update');
        Route::get('/reports', 'AffilateController@reports')->name('dashboard');

    });

    // wallet routes

    Route::prefix('/admin/wallet')->group(function () {

        Route::get('/settings', 'WalletSettingController@index')->name('admin.wallet.settings');
        Route::post('/settings/update', 'WalletSettingController@update')->name('admin.update.wallet.settings');
    });

    //bulk import
    Route::post('/admin/import/actors', [ActorController::class, 'importactors']);
    Route::post('/admin/import/directors', [DirectorController::class, 'importdirectors']);
    Route::post('/admin/import/genres', [GenreController::class, 'importgenres']);
    Route::post('/admin/import/movies', [MovieController::class, 'importmovies']);
    Route::post('/admin/import/tv-series', [TvseriesController::class, 'importtvseries']);
    Route::post('/admin/import/seasons', [TvseriesController::class, 'importseasons']);
    Route::post('/admin/import/live-event', [LiveEventController::class, 'importliveevent']);
    Route::post('/admin/import/audio', [AudioController::class, 'importaudio']);
    Route::post('/admin/import/episode', [TvseriesController::class, 'importepisodes']);
    Route::post('/admin/import/live-tv', [LiveTvController::class, 'importlivetv']);

    //site map
    Route::get('/sitemap', 'SiteMapController@sitemapGenerator');

    Route::get('/sitemap/download', 'SiteMapController@download');

    Route::view('/admin/media-manager','mediamanager')->name('media.manager');

});

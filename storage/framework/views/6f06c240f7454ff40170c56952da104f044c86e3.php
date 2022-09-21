<!DOCTYPE html>
<!--
**********************************************************************************************************
    Copyright (c) 2022 .
**********************************************************************************************************  
-->
<!--
Template Name: Next Hour - Movie Tv Show & Video Subscription Portal Cms Web And App
Version: 4.7
Author: Media City
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]> -->

<html lang="en" <?php if(selected_lang()->rtl == 1): ?> dir="rtl" <?php endif; ?>>
<!-- <![endif]-->
<!-- head -->

<head>
  <meta charset="utf-8" />
  <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($w_title); ?></title>


  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="MobileOptimized" content="320" />
  <?php echo $__env->yieldContent('custom-meta'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"><!-- CSRF Token -->

  <link rel="icon" type="image/icon" href="<?php echo e(url('images/favicon/favicon.png')); ?>"> <!-- favicon icon -->
  <link href="<?php echo e(url('css/starrating.css')); ?>" rel="stylesheet" type="text/css" />
  <!-- Star Rating -->
  <!-- theme style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> <!-- google font -->
  <link href="https://fonts.googleapis.com/css2?family=Londrina+Shadow&display=swap" rel="stylesheet">
  <?php if(selected_lang()->rtl == 0): ?>
  <link href="<?php echo e(url('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" /> <!-- bootstrap css -->
  <?php else: ?>
  <link href="<?php echo e(url('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" /> <!-- bootstrap css -->
  <link href="<?php echo e(url('css/bootstrap.rtl.min.css')); ?>" rel="stylesheet" type="text/css" /><!-- bootstrap rtl css -->
  <?php endif; ?>
  <link href="<?php echo e(url('css/menumaker.css')); ?>" type="text/css" rel="stylesheet"> <!-- menu css -->
  <link href="<?php echo e(url('css/owl.carousel.min.css')); ?>" rel="stylesheet" type="text/css" /> <!-- owl carousel css -->
  <link href="<?php echo e(url('css/owl.theme.default.min.css')); ?>" rel="stylesheet" type="text/css" /> <!-- owl carousel css -->
  <link href="<?php echo e(url('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" /> <!-- fontawsome css -->
  <link href="<?php echo e(url('fonts/flaticon/font/flaticon.css')); ?>" rel="stylesheet" type="text/css" /> <!-- flaticon css -->
  <link href="<?php echo e(url('css/popover.css')); ?>" rel="stylesheet" type="text/css" /> <!-- bootstrap popover css -->
  <link href="<?php echo e(url('css/layers.css')); ?>" rel="stylesheet" type="text/css" /> <!-- layers css -->
  <link href="<?php echo e(url('css/navigation.css')); ?>" rel="stylesheet" type="text/css" /> <!-- navigation css -->
  <link href="<?php echo e(url('css/pe-icon-7-stroke.css')); ?>" rel="stylesheet" type="text/css" /> <!-- pre-icon-7-stroke css -->
  <link href="<?php echo e(url('css/settings.css')); ?>" rel="stylesheet" type="text/css" /> <!-- settings css -->
  <link href="<?php echo e(url('css/jquery-ui.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(url('css/colorbox.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(url('css/venom-button.min.css')); ?>" rel="stylesheet" type="text/css" />



  <?php echo $__env->yieldContent('head-script'); ?>

  <?php
  if(Schema::hasTable('color_schemes')){
  $color = App\ColorScheme::first();
  }
  ?>
  <?php if(isset($color)): ?>
  <?php if($color->color_scheme == 'dark'): ?>

    <style type="text/css">
      
    :root {
    
      --body_bg_color: #111;
      --btn-prime_bg_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
      --footer_bg_color: <?php echo e($color->custom_footer_background_color != NULL ? $color->custom_footer_background_color : $color->default_footer_background_color); ?>;
      --background_black_bg_color: #111;
      --background_white_bg_color: #FFF;
      --background_dark-black_bg_color: #000;
      --back2top_bg_color: #DDD;
      --bg-success_bg_color: #198754;
      --blue_bg_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
      --light-blue_bg_color: #90DFFE;
      --watchhistory_remove_bg_color: #D9534F;
      --btn-default_bg_color: #515151;

      --blue_border_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
      --light-grey_border_color: #B1B1B1;
      --btn-prime_border_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
      --see-more_border_color: #B1B1B1;
      --btn-default_border_color: #515151;

      --text_blue_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
      --text_black_color: #111;
      --text_light_grey_color: #B1B1B1;
      --text_light_blue_color: <?php echo e($color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color); ?>;
      --text_grey_color: #949494;
      --text_white_color: #FFF;

      /*add more */
      --navigation_bg_color: <?php echo e($color->custom_navigation_color != NULL ? $color->custom_navigation_color : $color->default_navigation_color); ?>;
      --back2top_bg_color_on_hover:  <?php echo e($color->custom_back_to_top_bgcolor_on_hover != NULL ? $color->custom_back_to_top_bgcolor_on_hover : $color->default_back_to_top_bgcolor_on_hover); ?>;
      --back2top_color_on_hover: <?php echo e($color->custom_back_to_top_color_on_hover != NULL ? $color->custom_back_to_top_color_on_hover : $color->default_back_to_top_color_on_hover); ?>;
      
      }
    </style>
  <?php else: ?>
    <style type="text/css">
    :root {
  
        --body_bg_color: #111;
        --btn-prime_bg_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
        --footer_bg_color: <?php echo e($color->custom_footer_background_color != NULL ? $color->custom_footer_background_color : $color->default_footer_background_color); ?>;
        --background_black_bg_color: #111;
        --background_white_bg_color: #FFF;
        --background_dark-black_bg_color: #000;
        --back2top_bg_color: #DDD;
        --bg-success_bg_color: #198754;
        --blue_bg_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
        --light-blue_bg_color: <?php echo e($color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color); ?>;
        --watchhistory_remove_bg_color: #D9534F;
        --btn-default_bg_color: #515151;

        --blue_border_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
        --light-grey_border_color: #B1B1B1;
        --btn-prime_border_color: <?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
        --see-more_border_color: #B1B1B1;
        --btn-default_border_color: <?php echo e($color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color); ?>;

        --text_blue_color:<?php echo e($color->custom_text_color != NULL ? $color->custom_text_color : $color->default_text_color); ?>;
        --text_black_color: #111;
        --text_light_grey_color: #B1B1B1;
        --text_light_blue_color: <?php echo e($color->custom_text_on_color != NULL ? $color->custom_text_on_color : $color->default_text_on_color); ?>;
        --text_grey_color: #949494;
        --text_white_color: #FFF;

        --white: #FFF;

        --navigation_bg_color: <?php echo e($color->custom_navigation_color != NULL ? $color->custom_navigation_color : $color->default_navigation_color); ?>;
        --back2top_bg_color_on_hover:  <?php echo e($color->custom_back_to_top_bgcolor_on_hover != NULL ? $color->custom_back_to_top_bgcolor_on_hover : $color->default_back_to_top_bgcolor_on_hover); ?>;
        --back2top_color_on_hover: <?php echo e($color->custom_back_to_top_color_on_hover != NULL ? $color->custom_back_to_top_color_on_hover : $color->default_back_to_top_color_on_hover); ?>;
      }
    </style>
  <?php endif; ?>
  <?php if($color->color_scheme == 'light'): ?>
  <?php if(selected_lang()->rtl == 0): ?>
  <link href="<?php echo e(url('css/style-light.css')); ?>" rel="stylesheet" type="text/css" />
  <?php else: ?>
  <link href="<?php echo e(url('css/style-light-rtl.css')); ?>" rel="stylesheet" type="text/css" />
  <?php endif; ?>
  <?php else: ?>
  <?php if(selected_lang()->rtl == 0): ?>
  <link href="<?php echo e(url('css/style.css')); ?>" rel="stylesheet" type="text/css" />
  <?php else: ?>
  <link href="<?php echo e(url('css/style-rtl.css')); ?>" rel="stylesheet" type="text/css" />
  <?php endif; ?>
  <?php endif; ?>
  <?php endif; ?>

  <link href="<?php echo e(url('css/custom-style.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(url('css/goto.css')); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo e(url('content/global.css')); ?>" rel="stylesheet" type="text/css" /><!-- go to top css -->
  <script type="text/javascript" src="<?php echo e(url('js/stripe_v3.js')); ?>" defer></script> <!-- stripe script -->
  <script type="text/javascript" src="<?php echo e(url('js/jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('java/FWDUVPlayer.js')); ?>" defer></script> <!-- jquery library js -->
  <?php if(strlen( env('ONESIGNAL_APP_ID',""))>4): ?>
  <script type="text/javascript" src="<?php echo e(url('OneSignalSDK/OneSignalSDK.js')); ?>" async=""></script>
  <script>
    var ONESIGNAL_APP_ID = <?php echo json_encode(env('ONESIGNAL_APP_ID'), 15, 512) ?>;
    var USER_ID = '<?php echo e(auth()->user() ? auth()->user()->id : ""); ?>';
  </script>
  <script type="text/javascript" src="<?php echo e(url('js/onesignal.js')); ?>"></script>
  <?php endif; ?>
  <script>
    window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token()]); ?>';
  </script>
  <script type="text/javascript" src="<?php echo e(url('js/app.js')); ?>"></script> <!-- app library js -->

  <!-- end theme style -->

  <script type="text/javascript" src="<?php echo e(url('js/jquery.lazy.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('js/jquery.lazy.plugins.min.js')); ?>"></script>

  <script>
    $(function () {
      "use strict";
      $('.lazy').lazy({
        effect: "fadeIn",
        effectTime: 2000,
        scrollDirection: 'both',
        threshold: 0
      });
    });
  </script>
  <?php echo $__env->yieldContent('player-sc'); ?>

  <?php if(env('PWA_ENABLE') == 1): ?>
  <?php $config = (new \LaravelPWA\Services\ManifestService)->generate(); echo $__env->make( 'laravelpwa::meta' , ['config' => $config])->render(); ?>
  <?php endif; ?>

  <?php

  if($button->reminder_mail == 1){
  if(env('MAIL_USERNAME') != NULL && env('MAIL_PASSWORD') != NULL && env('MAIL_HOST') != NULL && env('MAIL_DRIVER') !=
  NULL){
  if(isset(Auth::user()->paypal_subscriptions)){
  //Run subscripption expire background process
  App\Jobs\CheckUserPlanValidity::dispatchNow();
  }
  }
  }


  ?>



</head>
<!-- end head -->
<!--body start-->

<body>
  <!-- preloader -->
  <?php if($preloader == 1): ?>
  <div class="loading">
    <div class="logo">
      <?php if($configs->preloader_img != NULL): ?>
      <img src="<?php echo e(url('images/'.$configs->preloader_img)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
      <?php else: ?>
      <img src="<?php echo e(url('images/logo/'.$configs->logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
      <?php endif; ?>
    </div>
    <div class="loading-text">
      <span class="loading-text-words"><?php echo e(__('L')); ?></span>
      <span class="loading-text-words"><?php echo e(__('O')); ?></span>
      <span class="loading-text-words"><?php echo e(__('A')); ?></span>
      <span class="loading-text-words"><?php echo e(__('D')); ?></span>
      <span class="loading-text-words"><?php echo e(__('l')); ?></span>
      <span class="loading-text-words"><?php echo e(__('N')); ?></span>
      <span class="loading-text-words"><?php echo e(__('G')); ?></span>

    </div>
  </div>
  <?php endif; ?>
  <!-- end preloader -->
  <div class="body-overlay-bg"></div>

  <?php if(Session::has('added')): ?>
  <div id="sessionModal" class="sessionmodal rgba-green-strong z-depth-2">
    <i class="fa fa-check-circle"></i>
    <p><?php echo e(session('added')); ?></p>
  </div>
  <?php elseif(Session::has('updated')): ?>
  <div id="sessionModal" class="sessionmodal rgba-cyan-strong z-depth-2">
    <i class="fa fa-exclamation-triangle"></i>
    <p><?php echo e(session('updated')); ?></p>
  </div>
  <?php elseif(Session::has('deleted')): ?>
  <div id="sessionModal" class="sessionmodal rgba-red-strong z-depth-2">
    <i class="fa fa-window-close"></i>
    <p><?php echo e(session('deleted')); ?></p>
  </div>
  <?php endif; ?>
  <!-- preloader -->
  <div class="preloader">
    <div class="status">
      <div class="status-message">
      </div>
    </div>
  </div>
  <!-- end preloader -->
  <?php
  $auth = Illuminate\Support\Facades\Auth::user();
  $subscribed = null;
  $withlogin= $configs->withlogin;
  $catlog = $configs->catlog;
  $allMenus = App\Menu::orderBy('position','ASC')->get();

  if(isset($auth) && $auth != NULL){
  if($catlog == 1){
  $menuh=$allMenus;
  }else{
  if(getSubscription()->getData()->subscribed == true){
  $menuh = getSubscription()->getData()->nav_menus;
  }
  }

  }else{
  if($catlog ==1 && $withlogin == 1){
  $menuh = $allMenus;
  }

  }

  $custom_page = App\CustomPage::where('in_show_menu','1')->where('is_active','1')->get();

  ?>

 
  <!-- navigation -->
  <div class="navigation">
    <div class="container-fluid nav-container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-2">
          <div class="nav-logo">
            <div class="nav-logo">
              <?php if($catlog == 0 && $configs->remove_landing_page == 1): ?>
              <a href="#" title="<?php echo e($w_title); ?>"><img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive"
                  alt="<?php echo e($w_title); ?>"></a>
              <?php else: ?>
              <a href="<?php echo e(url('/')); ?>" title="<?php echo e($w_title); ?>"><img src="<?php echo e(url('images/logo/'.$logo)); ?>"
                  class="img-responsive" alt="<?php echo e($w_title); ?>"></a>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- menu and navigation section -->
        
        <div class="col-sm-6 col-lg-5">
          <div id="cssmenu">
            <?php if($auth && isset($menuh) || isset($custom_page) && getSubscription()->getData()->subscribed == true): ?>
            <ul>
              <?php if(Auth::user()->kids_mode_active == 0): ?>
              <?php if(isset($menuh) && count($menuh) > 0): ?>
              <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($auth && getSubscription()->getData()->subscribed == true): ?>

              <li>
                <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"
                  title="<?php echo e($menus->name); ?>">
                  <?php echo e($menus->name); ?>

                </a>
              </li>
              <?php else: ?>

              <li>
                <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/guest', $menus->slug)); ?>"
                  title="<?php echo e($menus->name); ?>">
                  <?php echo e($menus->name); ?>

                </a>
              </li>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

              <?php if(isset($custom_page) && count($custom_page) >0): ?>
              <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(isset($custom)): ?>
              <li>
                <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"
                  title="<?php echo e($custom->title); ?>">
                  <?php echo e($custom->title); ?>

                </a>
              </li>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <?php if($button->kids_mode==1): ?>
                <?php if(Auth::user() && $auth != NULL && getSubscription()->getData()->subscribed == true): ?>
                  <li style="width:13%;padding: 0px">
                    <a href="<?php echo e(route('get.kids', Auth::user()->id)); ?>" style="background-image: url(<?php echo e(asset('images/kids.png')); ?>);background-repeat: no-repeat;background-size: contain;margin: 0px 12px;padding: 15px 7px !important;"></a>
                  </li>
                <?php endif; ?>
              <?php endif; ?>
            <?php else: ?>
              <?php if(Auth::user() && $auth != NULL && getSubscription()->getData()->subscribed == true): ?>
              <li style="width:13%;padding: 0px">
                <a style="background-image: url(<?php echo e(asset('images/kids.png')); ?>);background-repeat: no-repeat;background-size: contain;margin: 0px 12px;padding: 15px 7px !important;"></a>
              </li>
              <?php endif; ?>
            <?php endif; ?>

            </ul>
            <?php else: ?>
            <?php if($catlog == 1 && $withlogin == 1): ?>
            <ul>
              <?php if(isset($menuh) && count($menuh) > 0): ?>
              <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($auth && getSubscription()->getData()->subscribed == true): ?>

              <li>
                <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>"
                  title="<?php echo e($menus->name); ?>">
                  <?php echo e($menus->name); ?>

                </a>
              </li>
              <?php else: ?>

              <li>
                <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/guest', $menus->slug)); ?>"
                  title="<?php echo e($menus->name); ?>">
                  <?php echo e($menus->name); ?>

                </a>
              </li>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

              <?php if(isset($custom_page) && count($custom_page) >0): ?>
              <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(isset($custom)): ?>
              <li>
                <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"
                  title="<?php echo e($custom->title); ?>">
                  <?php echo e($custom->title); ?>

                </a>
              </li>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

            </ul>
            <?php endif; ?>
            <?php endif; ?>
          </div>

        </div>
        <div class="col-sm-6 col-md-6 col-lg-5 pull-right">
          <div class="login-panel-main-block small-screen-block">
            <ul>
              <?php if(auth()->guard()->check()): ?>
              <?php if(Auth::user()->kids_mode_active != 1): ?>
              <?php if($catlog == 0 && getSubscription()->getData()->subscribed == true): ?>
              <li class="prime-search-block">
                <form class="searchbar" action="<?php echo e(route('search')); ?>">
                  <input type="text" id="searchbar" class="btn-extended" placeholder="<?php echo e(__('search')); ?>" name="search" />
                  <label for="search-box" class="btn-search"><i class="flaticon-search"></i></label>
                </form>
              </li>
              <?php elseif($catlog == 1): ?>
              <li class="prime-search-block">
                <form class="searchbar" action="<?php echo e(route('search')); ?>">
                  <input type="text" id="searchbar" class="btn-extended" placeholder="<?php echo e(__('search')); ?>" name="search" />
                  <label for="search-box" class="btn-search"><i class="flaticon-search"></i></label>
                </form>
              </li>
              <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>

              <!-- notificaion -->
              <?php if(auth()->guard()->check()): ?>
              <?php if(Auth::user()->kids_mode_active == 1): ?>
              <li class="kids-btn">
                <a type="button" href="<?php echo e(route('get.kids', Auth::user()->id)); ?>" class="btn btn-primary">Exit Kids</a> 
              </li>
              <?php else: ?>
              <?php if(getSubscription()->getData()->subscribed == true): ?>
              <li>
                <div id="ex4" class="dropdown prime-dropdown">

                  <button class="btn btn-primary dropdown-toggle notification-dropdown" type="button"
                    data-toggle="dropdown" data-count="<?php echo e(auth()->user()->unreadnotifications->count()); ?>">
                    <i class="flaticon-bell" data-count="4b"></i>
                    <div class="notify-count count" count="0">
                      <div class="value"><?php echo e(auth()->user()->unreadnotifications->count()); ?></div>
                    </div>
                  </button>

                  <ul class="dropdown-menu prime-dropdown-menu">

                    <?php $__currentLoopData = auth()->user()->unreadnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                      <?php
                      $tv=null;$movie=null;$tvname=null;$moviename=null;
                      if(isset($n->tv_id) && !is_null($n->tv_id)){
                      $season=App\Season::where('id',$n->tv_id)->first();
                      if(isset($season)){
                      $tv=App\TvSeries::findOrFail($season->tv_series_id);
                      }
                      }
                      if(isset($n->movie_id) && !is_null($n->movie_id)){
                      $movie=App\Movie::where('id',$n->movie_id)->get();
                      if(isset($movie)){
                      foreach($movie as $m){
                      $moviename=$m->title;
                      $movieslug = $m->slug;
                      }

                      }
                      }
                      ?>
                      <div id="notification_id" onclick="readed('<?php echo e($n->id); ?>')" class="card notification-id">
                        <p class="notification-title"><b> <?php echo e($n->title); ?></b></p>
                        <p class="notification-data"> <?php echo e($n->data['data']); ?> &nbsp;
                          <?php if(isset($tv)): ?>
                          <a type="button" href="<?php echo e(url('show/detail',$season->season_slug)); ?>"
                            class="notification-button">
                            <b> "<?php echo e($tv->title); ?>"</b></a>
                          <?php endif; ?>
                          &nbsp;
                          <?php if(isset($moviename)): ?>
                          <a type="button" href="<?php echo e(url('movie/detail', $movieslug)); ?>" class="notification-button">
                            <b> "<?php echo e($moviename); ?>"</b>
                          </a>
                          <?php endif; ?>
                        </p>

                      </div>
                      <hr class="mt-1">
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </li>
              <?php endif; ?>

              <!-- language switch -->

              <?php if(isset($lang) && count($lang) > 1): ?>
              <?php if(count($lang) > 1): ?>
              <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                      class="flaticon-translate"></i>
                    <?php echo e(Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''); ?></button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">

                    <?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>

                      <a href="<?php echo e(route('languageSwitch', $langitem->local)); ?>">
                        <?php echo e($langitem->name); ?>

                      </a>
                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </ul>
                </div>
              </li>
              <?php endif; ?>
              <?php endif; ?>

              <!-- currency switch -->

              <?php if(isset($currencies) && count($currencies) > 1): ?>
              <li class="sign-in-block language-switch-block">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button"
                    data-toggle="dropdown"><?php echo e(Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $currency_code); ?></button>
                  <span class="caret caret-one"></span></button>
                  <ul class="dropdown-menu prime-dropdown-menu">

                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li>

                      <a href="<?php echo e(route('currencySwitch', $currency->code)); ?>">
                        <?php echo e($currency->code); ?>

                      </a>
                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  </ul>
                </div>
              </li>
              <?php endif; ?>

              <!-- profile settings -->

              <li class="sign-in-block admin-dropdown">
                <div class="dropdown prime-dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-toggle="dropdown"><i class="fa fa-user-circle"></i> <?php if(Session::has('nickname')): ?>
                    <?php echo e(Session::get('nickname')); ?> <?php else: ?> <?php echo e($auth ? $auth->name : ''); ?> <?php endif; ?>
                    <span class="caret"></span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php if($walletsetting->enable_wallet == 1): ?>
                    <div class="wallet-balance brd-btm">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="admin-wallet-block">
                            <ul>
                              <li><img src="<?php echo e(url('/images/walletnew.png')); ?>" class="img-fluid" alt="">
                                <?php echo e(__('Wallet Balance')); ?>

                                <span>
                                  <i class="<?php echo e($currency_symbol); ?>"></i>
                                  <?php if(isset($auth->wallet)): ?>
                                  <?php echo e($auth->wallet->balance); ?>

                                  <?php else: ?>
                                  0
                                  <?php endif; ?>
                                </span>
                              </li>

                            </ul>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="admin-money-block text-right">
                            <a href="<?php echo e(route('user.wallet.show')); ?>">
                              <ul>
                                <li><img src="<?php echo e(url('/images/money.png')); ?>" class="img-fluid" alt=""></li>
                                <li><?php echo e(__('Add Money')); ?></li>
                              </ul>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                      <div class="col-sm-6 col-lg-6">
                        <ul class="admin-list">
                          <?php if($auth->is_admin == 1): ?>
                          <li><a href="<?php echo e(url('admin')); ?>" target="_blank"><?php echo e(auth()->user()->getRoleNames()[0]); ?>

                              <?php echo e(__('Dashboard')); ?></a></li>
                          <?php endif; ?>
                          <?php if($auth->is_assistant == 1): ?>
                          <li>
                            <a href="<?php echo e(url('admin/movies')); ?>" target="_blank">
                              <?php echo e(__('ProducerDashboard')); ?></a>
                          </li>
                          <?php endif; ?>
                          <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('dashboard')); ?></a></li>
                          <?php if(getSubscription()->getData()->subscribed == true): ?>
                          <li><a href="<?php echo e(route('protectedvideo')); ?>"><?php echo e(__('protectedcontent')); ?></a></li>
                          <?php else: ?>
                          <li><a href="<?php echo e(url('account/purchaseplan')); ?>"><?php echo e(__('subscribe')); ?></a></li>
                          <?php endif; ?>
                          <?php if($auth && getSubscription()->getData()->subscribed == true && $configs->blog==1): ?>
                          <li><a href="<?php echo e(url('account/blog')); ?>"><?php echo e(__('blog')); ?></a></li>
                          <?php endif; ?>
                          <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('faq')); ?></a></li>

                        </ul>
                      </div>
                      <div class="col-sm-6 col-lg-6">
                        <ul>


                          <?php if($auth && getSubscription()->getData()->subscribed == true && $mlt_screen == 1): ?>
                          <li><a
                              href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?>"><?php echo e(__('manageprofile')); ?></a>
                          </li>
                          <?php endif; ?>
                          <?php
                          $donation= $configs->donation;
                          $donation_link=$configs->donation_link;
                          ?>
                          <?php if(!is_null($donation) && !is_null($donation_link) && $donation==1): ?>
                          <li><a target="_blank" href="<?php echo e($donation_link); ?>"><?php echo e(__('donation')); ?></a></li>
                          <?php endif; ?>

                          <?php if(isset($button) && $button->two_factor == 1): ?>
                          <li><a href="<?php echo e(route('2fa.get')); ?>"><?php echo e(__('2FactorAuthentication')); ?></a></li>
                          <?php endif; ?>
                          <?php
                            $nav=App\Menu::orderBy('position','ASC')->get();
                          ?>
                          <li><a href="<?php echo e(route('watchhistory')); ?>"> <?php echo e(__('Watch History')); ?> </a> </li>
                          <li><a href="<?php echo e(route('hidden.videos')); ?>"> <?php echo e(__('Hidden Videos')); ?> </a> </li>
                          <li><a href="<?php echo e(url('account/watchlist', $nav[0]->slug)); ?>"> <?php echo e(__('Watch list')); ?> </a> </li>
                          <li>
                            <a href="<?php echo e(route('custom.logout')); ?>">
                              <?php echo e(__('signout')); ?>

                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <!-- <ul class="dropdown-menu prime-dropdown-menu">
                    <?php if($auth->is_admin == 1): ?>
                      <li><a href="<?php echo e(url('admin')); ?>" target="_blank"><?php echo e(__('AdminDashboard')); ?></a></li>
                    <?php endif; ?>
                    <?php if($auth->is_assistant == 1): ?>
                      <li>
                        <a href="<?php echo e(url('admin/movies')); ?>" target="_blank"> <?php echo e(__('ProducerDashboard')); ?></a>
                      </li>
                    <?php endif; ?>
                    <?php if(getSubscription()->getData()->subscribed == true): ?>
                      <li><a href="<?php echo e(url('protected/content')); ?>"><?php echo e(__('protectedcontent')); ?></a></li>
                     
                    <?php else: ?>
                      <li><a href="<?php echo e(url('account/purchaseplan')); ?>"><?php echo e(__('subscribe')); ?></a></li>
                    <?php endif; ?>
                   
                      <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('dashboard')); ?></a></li>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $configs->blog==1): ?>
                      <li><a href="<?php echo e(url('account/blog')); ?>"><?php echo e(__('blog')); ?></a></li>
                    <?php endif; ?>
                    <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1): ?>
                      <li><a href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?>"><?php echo e(__('manageprofile')); ?></a></li>
                    <?php endif; ?>
                    <?php
                     
                      $donation= $configs->donation;
                      $donation_link=$configs->donation_link;
                    ?>
                    <?php if(!is_null($donation) && !is_null($donation_link) && $donation==1): ?>
                      <li><a target="_blank" href="<?php echo e($donation_link); ?>"><?php echo e(__('donation')); ?></a></li>
                    <?php endif; ?>
                      <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('faq')); ?></a></li>
                    <?php if(isset($button) && $button->two_factor == 1): ?>
                      <li><a href="<?php echo e(route('2fa.get')); ?>"><?php echo e(__('2FactorAuthentication')); ?></a></li>
                    <?php endif; ?>
                      <li>
                        <a href="<?php echo e(route('custom.logout')); ?>">
                        <?php echo e(__('signout')); ?>

                       </a>
                      </li>
                  </ul> -->
                </div>
              </li>
             <?php endif; ?>
              <?php else: ?>
              <li class="sign-in-block sign-in-block-one sign-in-block-two mrgn-rt-20"><a class="sign-in"
                  href="<?php echo e(url('login')); ?>"><i class="flaticon-login"></i> <?php echo e(__('signin')); ?></a></li>
              <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="<?php echo e(url('register')); ?>"><i
                    class="flaticon-profile"></i><?php echo e(__('register')); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div>




  <!-- small screen navigation start-->
  <div class="small-screen-navigation">
    <nav class="sidenav" id="mySidenav" role="navigation">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <h3 class="wrapper-heading">Menu</h3>
      <ul class="nav sidebar-nav">
        <?php if($catlog==1): ?>
        <?php if(isset($menuh) || isset($custom_page)): ?>
        <?php if(isset($menuh) && count($menuh) > 0): ?>
        <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($auth && getSubscription()->getData()->subscribed == true): ?>
        <li>
          <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>" title="<?php echo e($menus->name); ?>">
            <?php echo e($menus->name); ?>

          </a>
        </li>
        <?php else: ?>
        <li>
          <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/guest', $menus->slug)); ?>"
            title="<?php echo e($menus->name); ?>">
            <?php echo e($menus->name); ?>

          </a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(isset($custom_page) && count($custom_page) >0): ?>
        <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($custom)): ?>
        <li>
          <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"
            title="<?php echo e($custom->title); ?>">
            <?php echo e($custom->title); ?>

          </a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php endif; ?>
        <?php elseif($catlog == 0 && getSubscription()->getData()->subscribed == true): ?>
        <?php if(isset($menuh) ): ?>
        <?php if(isset($menuh) && count($menuh) > 0): ?>
        <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <a class="<?php echo e(Nav::hasSegment($menus->slug)); ?>" href="<?php echo e(url('/', $menus->slug)); ?>" title="<?php echo e($menus->name); ?>">
            <?php echo e($menus->name); ?>

          </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(isset($custom_page) && count($custom_page) >0): ?>
        <?php $__currentLoopData = $custom_page; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($custom)): ?>
        <li>
          <a class="<?php echo e(Nav::hasSegment($custom->slug)); ?>" href="<?php echo e(url('/page', $custom->slug)); ?>"
            title="<?php echo e($custom->title); ?>">
            <?php echo e($custom->title); ?>

          </a>
        </li>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <!-- notificaion -->
        <?php if(auth()->guard()->check()): ?>
        <?php if(getSubscription()->getData()->subscribed == true): ?>
        <li>
          <div id="ex4" class="dropdown prime-dropdown">

            <span class="p1 fa-stack fa-2x has-badge dropdown-toggle" type="button" data-toggle="dropdown"
              data-count="<?php echo e(auth()->user()->unreadnotifications->count()); ?>">

              <i class="p3 flaticon-bell fa-stack-1x xfa-inverse" data-count="4b"><?php echo e(__('Notification')); ?></i>
              <div class="notify-count count" count="0">
                <div class="value"><?php echo e(auth()->user()->unreadnotifications->count()); ?></div>
              </div>

            </span>

            <ul class="dropdown-menu prime-dropdown-menu">

              <?php $__currentLoopData = auth()->user()->unreadnotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <?php
                $tv=null;$movie=null;$tvname=null;$moviename=null;
                if(isset($n->tv_id) && !is_null($n->tv_id)){
                $season=App\Season::where('id',$n->tv_id)->first();
                if(isset($season)){
                $tv=App\TvSeries::findOrFail($season->tv_series_id);
                }
                }
                if(isset($n->movie_id) && !is_null($n->movie_id)){
                $movie=App\Movie::where('id',$n->movie_id)->get();
                if(isset($movie)){
                foreach($movie as $m){
                $moviename=$m->title;
                $movieslug = $m->slug;
                }

                }
                }
                ?>
                <div id="notification_id" onclick="readed('<?php echo e($n->id); ?>')" class="card notification-id">
                  <p class="notification-title"><b> <?php echo e($n->title); ?></b></p>
                  <p class="notification-data"> <?php echo e($n->data['data']); ?> &nbsp;
                    <?php if(isset($tv)): ?>
                    <a type="button" href="<?php echo e(url('show/detail',$season->season_slug)); ?>" class="notification-button">
                      <b> "<?php echo e($tv->title); ?>"</b></a>
                    <?php endif; ?>
                    &nbsp;
                    <?php if(isset($moviename)): ?>
                    <a type="button" href="<?php echo e(url('movie/detail', $movieslug)); ?>" class="notification-button">
                      <b> "<?php echo e($moviename); ?>"</b>
                    </a>
                    <?php endif; ?>
                  </p>

                </div>
                <hr class="mt-1">
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </li>
        <?php endif; ?>
        <?php if(isset($lang) && count($lang) > 1): ?>
        <?php if(count($lang) > 1): ?>
        <li class="sign-in-block language-switch-block">
          <div class="dropdown prime-dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                class="flaticon-translate"></i>
              <?php echo e(Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''); ?></button>
            <span class="caret caret-one"></span></button>
            <ul class="dropdown-menu prime-dropdown-menu">
              <?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li>
                <a href="<?php echo e(route('languageSwitch', $langitem->local)); ?>">
                  <?php echo e($langitem->name); ?>

                </a>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="sign-in-block">
          <div class="dropdown prime-dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i
                class="fa fa-user-circle"></i> <?php if(Session::has('nickname')): ?> <?php echo e(Session::get('nickname')); ?> <?php else: ?>
              <?php echo e($auth ? $auth->name : ''); ?> <?php endif; ?>
              <span class="caret"></span></button>
            <ul class="dropdown-menu prime-dropdown-menu">
              <?php if($auth->is_admin == 1): ?>
              <li><a href="<?php echo e(url('admin')); ?>" target="_blank"><?php echo e(__('AdminDashboard')); ?></a></li>
              <?php endif; ?>
              <?php if($auth->is_assistant == 1): ?>
              <li>
                <a href="<?php echo e(url('admin/movies')); ?>" target="_blank"> <?php echo e(__('ProducerDashboard')); ?></a>
              </li>
              <?php endif; ?>


              <?php if(getSubscription()->getData()->subscribed == true): ?>
              <li><a href="<?php echo e(route('protectedvideo')); ?>"><?php echo e(__('protectedcontent')); ?></a></li>

              <?php else: ?>

              <li><a href="<?php echo e(url('account/purchaseplan')); ?>"><?php echo e(__('subscribe')); ?></a></li>
              <?php endif; ?>


              <li><a href="<?php echo e(url('account')); ?>"><?php echo e(__('dashboard')); ?></a></li>
              <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1 && $configs->blog==1): ?>
              <li><a href="<?php echo e(url('account/blog')); ?>"><?php echo e(__('blog')); ?></a></li>
              <?php endif; ?>
              <?php if(isset(Auth::user()->paypal_subscriptions) && $subscribed == 1): ?>
              <li><a href="<?php echo e(url('/manageprofile/mus/'.Auth::user()->id)); ?>"><?php echo e(__('manageprofile')); ?></a>
              </li>
              <?php endif; ?>
              <?php

              $donation= $configs->donation;
              $donation_link=$configs->donation_link;
              ?>
              <?php if(!is_null($donation) && !is_null($donation_link) && $donation==1): ?>
              <li><a target="_blank" href="<?php echo e($donation_link); ?>"><?php echo e(__('donation')); ?></a></li>
              <?php endif; ?>
              <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('faq')); ?></a></li>
              <?php if(isset($button) && $button->two_factor == 1): ?>
              <li><a href="<?php echo e(route('2fa.get')); ?>"><?php echo e(__('2FactorAuthentication')); ?></a></li>
              <?php endif; ?>
              <?php
                $nav=App\Menu::orderBy('position','ASC')->get();
              ?>
              <li><a href="<?php echo e(route('watchhistory')); ?>"> <?php echo e(__('Watch History')); ?> </a> </li>
              <li><a href="<?php echo e(route('hidden.videos')); ?>"> <?php echo e(__('Hidden Videos')); ?> </a> </li>
              <li><a href="<?php echo e(url('account/watchlist', $nav[0]->slug)); ?>"> <?php echo e(__('Watch list')); ?> </a> </li>
              <li><a href="<?php echo e(route('custom.logout')); ?>"> <?php echo e(__('signout')); ?> </a> </li>
            </ul>
          </div>
        </li>
        <?php else: ?>

        <li class="sign-in-block sign-in-block-one sign-in-block-two"><a class="sign-in" href="<?php echo e(url('login')); ?>"><i
              class="flaticon-login"></i> <?php echo e(__('signin')); ?></a></li>
        <li class="sign-in-block sign-in-block-one "><a class="sign-in" href="<?php echo e(url('register')); ?>"><i
              class="flaticon-profile"></i><?php echo e(__('register')); ?></a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <span class="side-bar" onclick="openNav()">&#9776;</span>
  </div>
  <div id="find">
    <div class="themesearch">
      <button type="button" class="close">×</button>
      <?php echo Form::open(['method' => 'GET', 'action' => 'HomeController@search', 'class' => 'search_form']); ?>

      <input type="find" name="search" value="" placeholder="Type something to search.." />
      <button type="submit" class="btn btn-outline-info btn_sm"><?php echo e(__('Search')); ?></button>
      <?php echo Form::close(); ?>

    </div>
  </div>

  <?php if($auth): ?>
  <?php if(getSubscription()->getData()->subscribed != true): ?>
  <div class="purchase-sticky">
    <p><?php echo e(__('pleasesubscribetoaplan')); ?> &nbsp;<a href="<?php echo e(url('account/purchaseplan')); ?>"><button
          class="btn btn-sm text-white agree_btn js-cookie-consent-agree cookie-consent__agree"><?php echo e(__('clickhere')); ?></button></a>
    </p>
  </div>
  <?php endif; ?>
  <?php endif; ?>

  <!-- end navigation -->
  <?php echo $__env->yieldContent('main-wrapper'); ?>


  <!-- footer -->
  <?php if($prime_footer == 1): ?>
  <footer id="prime-footer" class="prime-footer-main-block">
    <div class="container-fluid">
      <div class="back-to-top">
        <a id="back2Top" title="Back to top" href="#">&#10148;</a>
      </div>
      <div class="logo">
        <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
      </div>

      <div class="text-center">

        <div class="footer-widgets social-widgets social-btns">
          <ul>
            <?php if(isset( $si->url1)): ?><li><a href="<?php echo e($si->url1); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            </li><?php endif; ?>
            <?php if(isset($si->url2)): ?><li><a href="<?php echo e($si->url2); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <?php endif; ?>
            <?php if(isset($si->url3)): ?><li><a href="<?php echo e($si->url3); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
      <?php

      $isplay=$configs->is_playstore;
      $isappstore=$configs->is_appstore;
      $appstore=$configs->appstore;
      $playstore=$configs->playstore;
      ?>
      <div class="text-center">
        <div class="footer-widgets social-widgets social-btns">
          <ul>
            <?php if($isappstore==1 && $isappstore != NULL): ?>
            <li> <a href="<?php echo e($appstore); ?>" target="_blank"> <img width="12%" height="12%"
                  src="<?php echo e(url('images/app_store_download.png')); ?>"></a></li>
            <?php endif; ?>
            <?php if($isplay==1 && $isplay != NULL): ?>
            <li>
              <a href="<?php echo e($playstore); ?>" target="_blank"> <img width="12%" height="12%"
                  src="<?php echo e(url('images/google_play_download.png')); ?>"></a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="copyright">
        <ul>
          <li>
            <?php if(isset($copyright)): ?>
            &copy;<?php echo e(date('Y')); ?> <?php echo $copyright; ?>

            <?php endif; ?>
          </li>
        </ul>
        <ul>
          <?php if(isset($configs->terms_condition) && $configs->terms_condition != NULL): ?>
          <li><a href="<?php echo e(url('terms_condition')); ?>"><?php echo e(__('termsandcondition')); ?></a></li>
          <?php endif; ?>
          <?php if(isset($configs->privacy_pol) && $configs->privacy_pol != NULL): ?>
          <li><a href="<?php echo e(url('privacy_policy')); ?>"><?php echo e(__('privacypolicy')); ?></a></li>
          <?php endif; ?>
          <?php if(isset($configs->refund_pol) && $configs->refund_pol != NULL): ?>
          <li><a href="<?php echo e(url('refund_policy')); ?>"><?php echo e(__('refundpolicy')); ?></a></li>
          <?php endif; ?>
          <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('help')); ?></a></li>
          <li><a href="<?php echo e(url('contactus')); ?>"><?php echo e(__('contactus')); ?></a></li>
        </ul>
      </div>
    </div>
  </footer>
  <?php else: ?>
  <footer id="footer-main-block" class="footer-main-block">
    <div class="pre-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="footer-logo footer-widgets">
              <?php if(isset($logo)): ?>
              <img src="<?php echo e(url('images/logo/'.$logo)); ?>" class="img-responsive" alt="<?php echo e($w_title); ?>">
              <?php endif; ?>
            </div>
          </div>

          <div class="col-md-4">
            <div class="footer-widgets">
              <div class="row">
                <div class="col-md-6">
                  <div class="footer-links-block">
                    <h4 class="footer-widgets-heading"><?php echo e(__('corporate')); ?></h4>
                    <ul>

                      <?php if(isset($configs->terms_condition) && $configs->terms_condition != NULL): ?>
                      <li><a href="<?php echo e(url('terms_condition')); ?>"><?php echo e(__('termsandcondition')); ?></a></li>
                      <?php endif; ?>
                      <?php if(isset($configs->privacy_policy) && $configs->privacy_policy != NULL): ?>
                      <li><a href="<?php echo e(url('privacy_policy')); ?>"><?php echo e(__('privacypolicy')); ?></a></li>
                      <?php endif; ?>
                      <?php if(isset($configs->refund_policy) && $configs->refund_policy != NULL): ?>
                      <li><a href="<?php echo e(url('refund_policy')); ?>"><?php echo e(__('refundpolicy')); ?></a></li>
                      <?php endif; ?>
                      <li><a href="<?php echo e(url('faq')); ?>"><?php echo e(__('help')); ?></a></li>

                    </ul>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="footer-links-block">
                    <h4 class="footer-widgets-heading"><?php echo e(__('sitemap')); ?></h4>
                    <ul>

                      <?php if(isset($menuh)): ?>
                      <?php $__currentLoopData = $menuh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($value->slug != null ||$value->slug != ''): ?>
                      <?php $mySlug = $value->slug; ?>
                      <li><a href="<?php echo e(url($mySlug)); ?>"><?php echo e($value->name); ?></a></li>
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="footer-widgets subscribe-widgets">
              <h4 class="footer-widgets-heading"><?php echo e(__('subscribe')); ?></h4>
              <p class="subscribe-text"><?php echo e(__('subscribetext')); ?></p>
              <?php echo Form::open(['method' => 'POST', 'action' => 'emailSubscribe@subscribe']); ?>

              <?php echo e(csrf_field()); ?>

              <div class="form-group">
                <input type="email" name="email" class="form-control subscribe-input" placeholder="Enter your e-mail">
                <button type="submit" class="subscribe-btn"><i class="fa fa-long-arrow-alt-right"></i></button>
              </div>
              <?php echo Form::close(); ?>

            </div>
          </div>
          <div class="col-md-2">

            <div class="footer-widgets social-widgets social-btns">
              <ul>
                <?php if(isset( $si->url1)): ?><li><a href="<?php echo e($si->url1); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li><?php endif; ?>
                <?php if(isset($si->url2)): ?><li><a href="<?php echo e($si->url2); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li><?php endif; ?>
                <?php if(isset($si->url3)): ?><li><a href="<?php echo e($si->url3); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li><?php endif; ?>
                <?php

                $isplay=$configs->is_playstore;
                $isappstore=$configs->is_appstore;
                $appstore=$configs->appstore;
                $playstore=$configs->playstore;
                ?>

                <?php if($isappstore==1 && $isappstore != NULL): ?>
                <li> <a href="<?php echo e($appstore); ?>" target="_blank"> <img width="72%" height="72%"
                      src="<?php echo e(url('images/app_store_download.png')); ?>"></a></li>
                <?php endif; ?>
                <?php if($isplay==1 && $isplay != NULL): ?>
                <li>
                  <a href="<?php echo e($playstore); ?>" target="_blank"> <img width="72%" height="72%"
                      src="<?php echo e(url('images/google_play_download.png')); ?>"></a>
                </li>
                <?php endif; ?>

              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container-fluid">
      <div class="copyright-footer">
        <?php if(isset($copyright)): ?>
        &copy;<?php echo e(date('Y')); ?> <?php echo $copyright; ?>

        <?php endif; ?>
      </div>
    </div>
  </footer>

  <?php endif; ?>
  <!-- end footer -->

    <div id="myButton"></div>

    <!-- jquery -->
    <script>
      var baseurl = <?php echo json_encode(url('/'), 15, 512) ?>;
    </script>
    <script type="text/javascript" src="<?php echo e(url('js/bootstrap.min.js')); ?>"></script> <!-- bootstrap js -->
    <script type="text/javascript" src="<?php echo e(url('js/jquery.popover.js')); ?>"></script> <!-- bootstrap popover js -->
    <script type="text/javascript" src="<?php echo e(url('js/menumaker.js')); ?>"></script> <!-- menumaker js -->
    <script type="text/javascript" src="<?php echo e(url('js/jquery.curtail.min.js')); ?>"></script> <!-- menumaker js -->
    <?php if(selected_lang()->rtl == 0): ?>
    <script type="text/javascript" src="<?php echo e(url('js/owl.carousel.min.js')); ?>"></script>
    <?php else: ?>
    <script type="text/javascript" src="<?php echo e(url('js/owl-carousel-rtl-js/owl.carousel.min.js')); ?>"></script>
    <!-- owl carousel js -->
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo e(url('js/jquery.scrollSpeed.js')); ?>"></script> <!-- owl carousel js -->
    <script type="text/javascript" src="<?php echo e(url('js/TweenMax.min.js')); ?>"></script> <!-- animation gsap js -->
    <script type="text/javascript" src="<?php echo e(url('js/ScrollMagic.min.js')); ?>"></script> <!-- custom js -->
    <script type="text/javascript" src="<?php echo e(url('js/animation.gsap.min.js')); ?>"></script> <!-- animation gsap js -->
    <script type="text/javascript" src="<?php echo e(url('js/modernizr-custom.js')); ?>"></script> <!-- debug addIndicators js -->
    <script type="text/javascript" src="<?php echo e(url('js/theme.js')); ?>"></script> <!-- custom js -->
    <script type="text/javascript" src="<?php echo e(url('js/custom-js.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/colorbox.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/checkit.js')); ?>"></script>
    <script src="<?php echo e(url('js/star-rating-front.min.js')); ?>"></script>
    <!-- venomem -->
    <script type="text/javascript" src="<?php echo e(url('js/venom-button.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('js/jquery-ui.min.js')); ?>"></script>
    <script>
      var hideurl = <?php echo json_encode(route('hide.for.me'), 15, 512) ?>;
    </script>
    <script type="text/javascript" src="<?php echo e(url('js/hidedata.js')); ?>"></script>

    <!-- end jquery -->
    
    <?php echo $__env->yieldContent('script'); ?>

    <!-- cookie -->
    <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- end cookie -->


    <?php if(isset($whatsapp_settings) && $whatsapp_settings->enable_whatsapp == 1): ?>
    <!-- whatsapp chat -->
    <script type="text/javascript">
      $('#myButton').venomButton({
        phone: "<?php echo e($whatsapp_settings->mobile); ?>",
        popupMessage: "<?php echo e($whatsapp_settings->text); ?>",
        message: "",
        showPopup: true,
        position: "<?php echo e($whatsapp_settings->position); ?>",
        linkButton: false,
        showOnIE: false,
        heigth: "<?php echo e($whatsapp_settings->size); ?>",
        width: "<?php echo e($whatsapp_settings->size); ?>",
        headerTitle: "<?php echo e($whatsapp_settings->header); ?>",
        headerColor: "<?php echo e($whatsapp_settings->color); ?>",
        backgroundColor: '#25d366',
        buttonImage: '<img src="<?php echo e(url('/images/whatsapp.svg')); ?>" />'
      });
    </script>
    <?php endif; ?>
    <!-- end whatsapp chat -->

    <!-- navigation -->
    <script>
      function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>
    <!-- end navigation -->

    
    
    <script>
      (function ($) {
        // Session Popup
        $('.sessionmodal').addClass("active");
        setTimeout(function () {
          $('.sessionmodal').removeClass("active");
        }, 7000);

        if (window.location.hash == '#_=_') {
          history.replaceState ?
            history.replaceState(null, null, window.location.href.split('#')[0]) :
            window.location.hash = '';
        }
      })(jQuery);
    </script>

    <?php if($google): ?>
    <script>
      (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

      ga('create', '<?php echo e($google); ?>', 'auto');
      ga('send', 'pageview');
    </script>
    <?php endif; ?>
    <?php if($fb): ?>
    <!-- facebook pixel -->
    <script>
      ! function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window,
        document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?php echo e($fb); ?>');
      fbq('track', 'PageView');
    </script>
    <!--End facebook pixel -->
    <?php endif; ?>

    <?php if($rightclick == 1): ?>
    <script type="text/javascript" language="javascript">
      // Right click disable
      $(function () {
        $(this).bind("contextmenu", function (inspect) {
          inspect.preventDefault();
        });
      });
      // End Right click disable
    </script>
    <?php endif; ?>

    <?php if($inspect == 1): ?>
    <script type="text/javascript" language="javascript">
      //all controller is disable
      $(function () {
        var isCtrl = false;
        document.onkeyup = function (e) {
          if (e.which == 17) isCtrl = false;
        }

        document.onkeydown = function (e) {
          if (e.which == 17) isCtrl = true;
          if (e.which == 85 && isCtrl == true) {
            return false;
          }
        };
        $(document).keydown(function (event) {
          if (event.keyCode == 123) { // Prevent F12
            return false;
          } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
            return false;
          }
        });
      });
      // end all controller is disable
    </script>
    <?php endif; ?>


    <?php if($goto==1): ?>
    <script type="text/javascript">
      // go to top
      $(window).scroll(function () {
        var height = $(window).scrollTop();
        if (height > 100) {
          $('#back2Top').fadeIn();
        } else {
          $('#back2Top').fadeOut();
        }
      });
      $(document).ready(function () {
        $("#back2Top").click(function (event) {
          event.preventDefault();
          $("html, body").animate({
            scrollTop: 0
          }, "slow");
          return false;
        });
      });
      // end go to top
    </script>
    <?php endif; ?>

    <!---------------- UC browser block --------------->
    <?php if($uc_browser == "1"): ?>
    <script>
      $(document).ready(function () {

        if (navigator.userAgent.indexOf("UBrowser") >= 0 || navigator.userAgent.indexOf("UCBrowser") >= 0) {
          // Run custom code for Internet Explorer.
          // window.document.write("/404 error");
          alert('Oops ! Its Look Like you are using a UCBrowser.We Blocked the access in it kindly use another browser like chrome.');
          var UcUrl = "http://www.ucweb.com/";
          window.location.replace(UcUrl);
        }
      });
    </script>
    <?php endif; ?>

    <!--------------- end UC browser Block ------------>

    <script type="text/javascript">
      function readed(id) {
        $.ajax({
          type: 'GET',
          data: {
            id: id
          },
          url: '<?php echo e(url('/user/notification/read')); ?>/' + id,
          success: function (data) {
            console.log(data);
          }
        });
      }
    </script>

    <!------ colorbox script ------->

    <script>
      $(document).ready(function () {

        $(".group1").colorbox({
          rel: 'group1'
        });
        $(".group2").colorbox({
          rel: 'group2',
          transition: "fade"
        });
        $(".group3").colorbox({
          rel: 'group3',
          transition: "none",
          width: "75%",
          height: "75%"
        });
        $(".group4").colorbox({
          rel: 'group4',
          slideshow: true
        });
        $(".ajax").colorbox();
        $(".youtube").colorbox({
          iframe: true,
          innerWidth: 640,
          innerHeight: 390
        });
        $(".vimeo").colorbox({
          iframe: true,
          innerWidth: 500,
          innerHeight: 409
        });
        $(".iframe").colorbox({
          iframe: true,
          width: "100%",
          height: "100%",
          controllist: "nodownload"
        });
        $(".inline").colorbox({
          inline: true,
          width: "50%"
        });
        $(".callbacks").colorbox({
          onOpen: function () {
            alert('onOpen: colorbox is about to open');
          },
          onLoad: function () {
            alert('onLoad: colorbox has started to load the targeted content');
          },
          onComplete: function () {
            alert('onComplete: colorbox has displayed the loaded content');
          },
          onCleanup: function () {
            alert('onCleanup: colorbox has begun the close process');
          },
          onClosed: function () {
            alert('onClosed: colorbox has completely closed');
          }
        });

        $('.non-retina').colorbox({
          rel: 'group5',
          transition: 'none'
        })
        $('.retina').colorbox({
          rel: 'group5',
          transition: 'none',
          retinaImage: true,
          retinaUrl: true
        });


        $("#click").click(function () {
          $('#click').css({
            "background-color": "#f00",
            "color": "#fff",
            "cursor": "inherit"
          }).text("Open this window again and this message will still be here.");
          return false;
        });
      });
    </script>


    <?php if(selected_lang()->rtl == 0): ?>
    <script src="<?php echo e(url('js/slider.js')); ?>"></script>
    <?php else: ?>
    <script src="<?php echo e(url('js/slider-rtl.js')); ?>"></script>
    <?php endif; ?>

    <script>
      $('.btn-search').click(function () {
        $('.searchbar').toggleClass('clicked');
        if ($('.searchbar').hasClass('clicked')) {
          $('.btn-extended').focus();
        }
      });
    </script>
    <script>
      $(function () {
        $("#searchbar").autocomplete({
          source: function (request, response) {
            $.ajax({
              url: "<?php echo e(route('quick.search')); ?>",
              data: {
                search: request.term
              },
              dataType: "json",
              success: function (data) {
                var resp = $.map(data, function (obj) {
                  return {
                    label: obj.value,
                    value: obj.value,
                    url: obj.url
                  }
                });
                response(resp);
              }
            });
          },
          select: function (event, ui) {
            if (ui.item.value != 'No Result found') {
              event.preventDefault();
              location.href = ui.item.url;
            } else {
              return false;
            }
          },
          html: true,
          open: function (event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
          },
        });
      });
    </script>
    <script>
      $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 10) {
          $(".navigation").addClass("scrolling");
        } else {
          $(".navigation").removeClass("scrolling");
        }
      });
    </script>
    <!------- end colorbox script----------->
    <!---- facebook chat ------->

    <?php if(isset($messanger_settings) && $messanger_settings->enable_messanger == 1): ?>
    <script src="<?php echo e($messanger_settings->script); ?>" async></script>
    <?php endif; ?>

    <!----- end facebook --------->


    <script>
      $('.copylink').on('click', function () {
        $(this).text('Copied !');
        var copyText = $('.cptext').val();
        console.log(copyText);
        $('.cptext').select();
        document.execCommand("copy");
      });
    </script>

    <?php echo $__env->yieldContent('custom-script'); ?>
</body>
<!--body end -->

</html>s<?php /**PATH C:\xampp\htdocs\nh4_7pc\resources\views/layouts/theme.blade.php ENDPATH**/ ?>
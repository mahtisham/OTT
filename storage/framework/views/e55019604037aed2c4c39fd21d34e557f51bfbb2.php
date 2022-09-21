<?php $__env->startSection('title',__('welcome')); ?>
<?php $__env->startSection('main-wrapper'); ?>
<!-- main wrapper -->

  

  <section id="main-wrapper" class="main-wrapper home-page">
  
    <div id="home-out-section-slider" class="home-out-section-slider home-out-section owl-carousel">
      <?php if(isset($blocks) && count($blocks) > 0): ?>
      <?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="slider-block">
        <div class="home-out-section-img">
          <img src="<?php echo e(url('images/main-home/'.$block->image)); ?>" class="img-fluid" alt="">
          <div class="overlay-bg <?php echo e($block->left == 1 ? 'gredient-overlay-left' : 'gredient-overlay-right'); ?> "></div>
          <div class="home-out-section-dtl">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-sm-7 <?php echo e($block->left == 1 ? 'col-md-offset-6 col-sm-offset-6 col-sm-6 col-md-6 text-right' : ''); ?>">
                  <h2 class="section-heading"><?php echo e($block->heading); ?></h2>
                  <p class="section-dtl <?php echo e($block->left == 1 ? 'pad-lt-100' : ''); ?>"><?php echo e($block->detail); ?></p>
                  <?php if($block->button == 1): ?>
                    <?php if($block->button_link == 'login'): ?>
                      <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(url('login')); ?>" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                      <?php endif; ?>
                    <?php else: ?>
                      <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(url('register')); ?>" class="btn btn-prime"><?php echo e($block->button_text); ?></a>
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </div>

    
    <!-- Pricing plan main block -->
    

    <?php if(isset($remove_subscription) && $remove_subscription == 0): ?> 
      <?php if(isset($plans) && count($plans) > 0): ?>
     
        <div class="purchase-plan-main-block  main-home-section-plans">
          <div class="panel-setting-main-block panel-subscribe">
            <div class="container-fluid">
              <div class="plan-block-dtl">
                <h3 class="plan-dtl-heading"><?php echo e(__('membershipplans')); ?></h3>
                <div class="plan-dtl-list">
                  
                  <ul>
                    <li><?php echo e(__('membershiplines1')); ?>

                    </li>
                    <li><?php echo e(__('membershiplines2')); ?> 
                    </li>
                   
                  </ul>
                 
                </div>
               
              </div>
              <?php if(Auth::check()): ?>
                <?php  
                  $id = Auth::user()->id;
                  $getuserplan = App\PaypalSubscription::where('status','=','1')->where('user_id',$id)->orderBy('id','DESC')->first();
                 
                ?>
              <?php endif; ?>
                <?php
                  $today =  date('Y-m-d h:i:s');
                ?>

            

              <div class="snip1404 row">
                  
                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($plan->delete_status ==1 ): ?>
                  <?php if($plan->status != 'inactive'): ?>
                    <div class="col-lg-3 col-sm-6">
                      <div class="main-plan-section <?php if(isset($getuserplan['package_id']) && ($getuserplan['package_id'] == $plan->id) && ($getuserplan->status == '1') && ($today <= $getuserplan->subscription_to)): ?> main-plan-section-two  <?php endif; ?>">
                        <header>
                          <h4 class="plan-home-title">
                            <?php echo e($plan->name); ?>

                          </h4>
                          <div class="plan-cost"><span class="plan-price">
                            <?php if(Session::has('current_currency')): ?>
                              <?php echo e(currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency_symbol, $format = true)); ?></span><span class="plan-type">
                              <?php echo e(currency($plan->amount, $from = $plan->currency, $to = Session::has('current_currency') ? ucfirst(Session::get('current_currency')) : $plan->currency_symbol, $format = true)); ?>/
                                <?php echo e($plan->interval); ?>

                            <?php else: ?>
                              <i class="<?php echo e($plan->currency_symbol); ?>"></i><?php echo e($plan->amount); ?></span><span class="plan-type">
                              <i class="<?php echo e($plan->currency_symbol); ?>"></i> <?php echo e(number_format(($plan->amount) / ($plan->interval_count),2)); ?>/
                                <?php echo e($plan->interval); ?>

                            <?php endif; ?>
                          </span></div>
                        </header>
                        <?php
                       
                      $pricingTexts = App\PricingText::where('package_id',$plan->id)->get();
                        ?>
                        <?php if(isset($package_feature)): ?>
                          <?php $__currentLoopData = $package_feature; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($plan['feature'])): ?>
                             <ul class="plan-features">
                              
                               <li><?php if(in_array($pf->id, $plan['feature'])): ?><i class="fa fa-check "> </i> <?php else: ?> <i class="fa fa-close"></i> <?php endif; ?> <?php echo e($pf->name); ?></li> 
                             </ul>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(isset($getuserplan['package_id']) && $getuserplan['package_id'] == $plan->id && $getuserplan->status == "1" && $today <= $getuserplan->subscription_to ): ?>
                          
                          <div class="plan-select"><a class="btn btn-prime btn-prime-bg"><?php echo e(__('alreadysubscribe')); ?></a></div>

                        <?php else: ?>
                          <?php if(!isset($getuserplan['package_id'])): ?>
                            <?php if($plan->free == 1 && $plan->status == 'upcoming'): ?>
                              <div class="plan-select"><a href="#"><?php echo e(__('COMING SOON!')); ?></a></div> 
                            <?php elseif($plan->free == 1 && $plan->status == 'status'): ?>
                              <form action="<?php echo e(route('free.package.subscription',$plan->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="plan-select btn-prime-subs"><a  class="btn btn-prime"><input type="submit" class="btn-subscribe" value="<?php echo e(__('subscribe')); ?>"></a></div>
                              </form>
                            <?php elseif($plan->status == 'upcoming'): ?>
                              <div class="plan-select"><a href="#"><?php echo e(__('COMING SOON!')); ?></a></div> 
                            <?php else: ?>
                              <div class="plan-select"><a href="<?php echo e(route('get_payment', $plan->id)); ?>" class="btn btn-prime"><?php echo e(__('subscribe')); ?></a></div>
                            <?php endif; ?>
                          <?php endif; ?>

                        <?php endif; ?>
                        <?php else: ?>
                            <?php if($plan->status == 'upcoming'): ?>
                               <div class="plan-select"><a href="#"><?php echo e(__('COMING SOON!')); ?></a></div> 
                            <?php else: ?>
                            <div class="plan-select"><a href="<?php echo e(route('register')); ?>"><?php echo e(__('registernow')); ?></a></div>
                            <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>



    
    <!-- end featured main block -->
    <!-- end out section -->
  </section>
<!-- end main wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
        
        <?php if(isset(Auth::user()->multiplescreen)): ?>
        <?php if((Auth::user()->multiplescreen->activescreen!= NULL)): ?>
         $(document).ready(function(){

           $('#showM').hide();

           });
          <?php else: ?>
           $(document).ready(function(){

            $('#showM').modal();

           });
          <?php endif; ?>
          <?php endif; ?>



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.theme', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nh4_7pc\resources\views/main.blade.php ENDPATH**/ ?>
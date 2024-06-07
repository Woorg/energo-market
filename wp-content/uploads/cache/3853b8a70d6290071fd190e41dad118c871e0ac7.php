<?php $__env->startSection('content'); ?>

<!-- Advices :: Start-->
<div class="advices">
  <div class="container-fluid">

    <h2 class="advices__title"><?php echo post_type_archive_title(); ?></h2>

    <?php

      $args = [
        'post_type'      => 'advices',
        'posts_per_page' => 12,
        'orderby'        => 'date',
        'order'          => 'ASC'
      ];

      $query = new WP_Query( $args );

    ?>

    <?php if($query->have_posts()): ?>

      <div class="advices__section">
        <ul class="advices__grid">
        <?php while($query->have_posts()): ?> <?php echo e($query->the_post()); ?>

          <?php
            $text = get_field('text', get_the_ID());
            $thumbnail_id    = get_post_thumbnail_id( get_the_ID() );
            $alt             = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
          ?>
          <li>
            <a class="advices__item" href="<?php echo e(the_permalink()); ?>">

              <figure class="advices__item-image">
                <img src="<?php echo e(get_the_post_thumbnail_url( get_the_ID(), 'full')); ?>" alt="<?php echo e($alt); ?>">
              </figure>

              <h3 class="advices__item-title"><?php echo e(the_title()); ?></h3>

              <p class="advices__item-text"><?php echo e($text); ?></p>
            </a>
          </li>

        <?php endwhile; ?>

        <?php echo e(wp_reset_postdata()); ?>


        </ul>


        <div class="advices__control">
          <button class="ui-btn ui-btn--red loadmore-advices">Еще советы
            <svg class="icon-arrow-btn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.4853 20.4853C18.2348 22.7357 15.1826 24 12 24C5.37258 24 0 18.6274 0 12C0 8.8174 1.26428 5.76515 3.51472 3.51472C5.76516 1.26428 8.8174 0 12 0C15.1826 0 18.2348 1.26428 20.4853 3.51472C22.7357 5.76515 24 8.8174 24 12C24 15.1826 22.7357 18.2348 20.4853 20.4853ZM7.4 11.2392L13.4865 11.2392L10.8236 8.57635L11.904 7.496L16.408 12L11.904 16.504L10.8236 15.4236L13.4865 12.7608L7.4 12.7608V11.2392ZM12 1.2C17.9647 1.2 22.8 6.03533 22.8 12C22.8 17.9647 17.9647 22.8 12 22.8C9.13566 22.8 6.38864 21.6621 4.36325 19.6368C2.33785 17.6114 1.2 14.8643 1.2 12C1.2 6.03533 6.03532 1.2 12 1.2Z" fill="white"/></svg>
          </buton>
        </div>


      </div>

    <?php endif; ?>
  </div>
</div>
<!-- Advices :: End-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-inner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
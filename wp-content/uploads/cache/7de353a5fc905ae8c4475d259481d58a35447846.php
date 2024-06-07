<?php $__env->startSection('content'); ?>

<?php
    $args = [
      'post_type'      => 'projects',
      'posts_per_page' => 100,
      // 'tax_query' => [
      //   [
      //     'taxonomy' => 'projects-categories',
      //     'field' => 'id',
      //     'terms' => 5,
      //   ]
      // ],
      'orderby'        => 'date',
      'order'          => 'ASC'
    ];

    $query = new WP_Query( $args );
?>

<!-- Reviews :: Start-->
<div class="reviews reviews_single">
  <div class="container-fluid">

<?php if($query->have_posts()): ?>

    <h2 class="reviews__title"><?php echo post_type_archive_title(); ?></h2>
    <div class="reviews__section">


            <?php while($query->have_posts()): ?> <?php echo e($query->the_post()); ?>


              <?php
                $reviews_text = get_field('reviews_text', get_the_ID());
                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              ?>

                <div class="reviews__slide">
                  <div class="reviews__slide-sidebar">
                    <figure class="reviews__slide-image">
                      <img src="<?php echo e(get_the_post_thumbnail_url( get_the_ID(), 'full' )); ?>" alt="<?php echo e($alt); ?>">
                    </figure>
                    <p class="reviews__slide-caption"><?php echo e(the_title()); ?></p>
                  </div>
                  <div class="reviews__slide-content">
                    <blockquote class="reviews__slide-blockquote"><?php echo $reviews_text; ?></blockquote>
                  </div>
                </div>

            <?php endwhile; ?>

            <?php echo e(wp_reset_postdata()); ?>



    </div>

<?php endif; ?>

  </div>
</div>
<!-- Reviews :: End-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-inner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
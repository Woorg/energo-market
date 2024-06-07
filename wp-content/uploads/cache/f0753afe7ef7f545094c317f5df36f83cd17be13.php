

<?php

$title = get_field('title');
$text = get_field('text');
$button_text = get_field('button_text');

$args = [

  'post_type'      => 'slider',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'ASC'

];

$query = new WP_Query( $args );


?>


<?php if($query->have_posts()): ?>

<!-- Intro :: Start-->
<div class="intro">
  <div class="container-fluid">
    <div class="swiper-container swiper-intro js-swiper-intro">
      <div class="swiper-wrapper">
      <?php while($query->have_posts()): ?> <?php echo e($query->the_post()); ?>

        <?php
          $title = get_field('title', get_the_ID());
          $text = get_field('text', get_the_ID());
          $image = get_field('image', get_the_ID());
        ?>
        <div class="swiper-slide">
          <div class="intro__item" data-swiper-parallax-opacity="0">
            <div class="row">
              <div class="col-md-6 push-md-6">
                <figure class="intro__item-image"><img src="<?php echo wp_get_attachment_image_url($image, 'full'); ?>" alt="">
                  <?php if(have_rows('advantages', get_the_ID())): ?>
                    <dl class="intro__item-dl">
                    <?php while(have_rows('advantages', get_the_ID())): ?> <?php echo e(the_row()); ?>


                      <?php
                        $term = get_sub_field('term', get_the_ID());
                        $desc = get_sub_field('desc', get_the_ID());
                      ?>

                      <dt><?php echo e($term); ?></dt><dd><?php echo e($desc); ?></dd>
                    <?php endwhile; ?>
                    </dl>
                  <?php endif; ?>

                </figure>
              </div>
              <div class="col-md-6 pull-md-6">
                <div class="intro__item-desc">
                  <h2 class="intro__item-title"><?php echo $title; ?></h2>
                  <p class="intro__item-text"><?php echo e($text); ?></p>
                  <div class="intro__item-control">
                    <div class="swiper-control">
                      <button class="swiper-prev js-swiper-intro-prev">
                        <svg class="icon-prev">
                          <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-prev"></use>
                        </svg>
                      </button>
                      <div class="swiper-pagination js-swiper-intro-pagination"></div>
                      <button class="swiper-next js-swiper-intro-next">
                        <svg class="icon-next">
                          <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-next"></use>
                        </svg>
                      </button>
                    </div><a class="ui-btn ui-btn--red" href="#popup-request" data-fancybox>Призыв к действию
                      <svg class="icon-arrow-btn">
                        <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-arrow-btn"></use>
                      </svg></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      <?php endwhile; ?>

      <?php echo e(wp_reset_postdata()); ?>


      </div>
    </div>
  </div>
</div>
<!-- Intro :: End-->

<?php endif; ?>

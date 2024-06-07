

<?php

$title = get_field('title');

?>


<!-- Interests :: Start-->
<div class="interests">
  <div class="container-fluid">
    <h2 class="interests__title"><?php echo $title; ?></h2>
    <div class="interests__section">

      <?php if(have_rows('list')): ?>
        <ul class="interests__caption">
          <?php while(have_rows('list')): ?> <?php echo e(the_row()); ?>

            <?php
              $list_item = get_sub_field('list_item');
            ?>

            <li><?php echo e($list_item); ?></li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>

      <?php
        $args = [
          'post_type'      => 'portfolio',
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'ASC'
        ];

        $query = new WP_Query( $args );

      ?>


      <?php if($query->have_posts()): ?>
        <ul class="interests__grid">
        <?php while($query->have_posts()): ?> <?php echo e($query->the_post()); ?>

          <li>
            <div class="interests__group">
              <?php if(have_rows('slider', get_the_ID())): ?>
                <div class="swiper-container swiper-interests js-swiper-interests">
                  <div class="swiper-wrapper">
                  <?php while(have_rows('slider', get_the_ID())): ?> <?php echo e(the_row()); ?>


                    <?php
                      $slider_image = get_sub_field('slider_image');
                      $slider_title = get_sub_field('slider_title');
                      $slider_file  = get_sub_field('slider_file');
                      $slider_link  = get_sub_field('slider_link');
                      $slider_text  = get_sub_field('slider_text');

                    ?>

                    

                    <div class="swiper-slide">
                      <div class="interests__item">
                        <figure class="interests__item-image">
                          <img src="<?php echo $slider_image['url']; ?>" alt="<?php echo e($slider_image['alt']); ?>">
                        </figure>
                        <h3 class="interests__item-title"><?php echo e($slider_title); ?></h3>
                        <p class="interests__item-file">
                          <a class="interests__item-file-name" href="<?php echo e($slider_file['url']); ?>" download><?php echo e($slider_file['title']); ?></a>
                          <a class="interests__item-file-view" href="<?php echo e($slider_file['link']); ?>" >
                            <svg class="icon-view">
                              <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-view"></use>
                            </svg>
                          </a>
                          <a class="interests__item-file-download" href="<?php echo e($slider_file['url']); ?>" download>
                            <svg class="icon-download">
                              <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-download"></use>
                            </svg>
                          </a>
                        </p>
                        <p class="interests__item-text"><?php echo e($slider_text); ?></p>
                      </div>
                    </div>

                  <?php endwhile; ?>
                  </div>

                  <div class="swiper-control">
                    <button class="swiper-prev js-swiper-interests-prev">
                      <svg class="icon-prev">
                        <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-prev"></use>
                      </svg>
                    </button>
                    <div class="swiper-pagination js-swiper-interests-pagination"></div>
                    <button class="swiper-next js-swiper-interests-next">
                      <svg class="icon-next">
                        <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-next"></use>
                      </svg>
                    </button>
                  </div>

                </div>
              <?php endif; ?>

            </div>
          </li>

        <?php endwhile; ?>

        <?php echo e(wp_reset_postdata()); ?>


        </ul>

        <?php
          $link = get_field('link');
          $button_text = get_field('button_text');
        ?>

        <?php if($link): ?>

        <div class="advices__control">
          <a class="ui-btn ui-btn--red" href="<?php echo e($link); ?>" target="_blank"><?php echo e($button_text); ?>

            <svg class="icon-arrow-btn">
              <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-arrow-btn"></use>
            </svg>
          </a>
        </div>

        <?php endif; ?>


      <?php endif; ?>
    </div>
  </div>
</div>
<!-- Interests :: End-->

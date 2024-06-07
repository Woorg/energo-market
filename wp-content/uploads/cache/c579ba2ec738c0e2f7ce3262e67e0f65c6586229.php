

<?php

$title = get_field('title');

?>

<!-- Services :: Start-->
<div class="services" data-tabs>
  <div class="container-fluid">
    <div class="services__topbar">
      <h2 class="services__title"><?php echo e($title); ?></h2>

      <?php

        $terms = get_terms( [
          'taxonomy'   => 'services-categories',
          'orderby'    => 'date',
          'order'      => 'ASC',
          'hide_empty' => true,
        ] );

      ?>

      <?php if($terms): ?>

        <?php
          $i = 0;
        ?>

      <div class="services__control">
        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <?php
            $i++;
            $tab_class = $i <= 1 ? 'services__control-btn is-active' : 'services__control-btn';
            $title = get_field('title', $term);
          ?>

          <button class="<?php echo e($tab_class); ?>" data-tabs-btn="0<?php echo e($i); ?>">
            <span class="services__control-btn-icon">
              <svg class="icon-services-0<?php echo e($i); ?>">
                <use xlink:href="<?php echo e(svg_sprite_path()); ?>#icon-services-0<?php echo e($i); ?>"></use>
              </svg>
            </span>
            <span class="services__control-btn-text"><?php echo $title; ?></span>
          </button>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
      <?php endif; ?>

    </div>

    <?php if($terms): ?>

      <?php
        $i = 0;
      ?>

      <div class="services__section">
        <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $i++;
            $tab_class = $i <= 1 ? 'services__content is-active' : 'services__content';
          ?>

          <div class="<?php echo e($tab_class); ?>" data-tabs-content="0<?php echo e($i); ?>">

            <?php
              $args = [
                'post_type'      => 'services',
                'tax_query' => [
                  [
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                  ]
                ],
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'ASC'
              ];

              $query = new WP_Query( $args );

            ?>

            <?php if($query->have_posts()): ?>

            <ul class="services__grid">
              <?php while($query->have_posts()): ?> <?php echo e($query->the_post()); ?>


                <?php
                  $mark = get_field('mark');
                  $text= get_field('text');
                ?>

              <li>
                <a class="services__item" href="<?php echo e(the_permalink()); ?>">
                  <h3 class="services__item-title"><?php echo e(the_title()); ?></h3>
                  <mark class="services__item-mark"><?php echo e($mark); ?></mark>
                  <p class="services__item-text"><?php echo e($text); ?></p>
                </a>
              </li>

              <?php endwhile; ?>

              <?php echo e(wp_reset_postdata()); ?>


            </ul>

            <?php endif; ?>

          </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    <?php endif; ?>
  </div>
</div>
<!-- Services :: End-->

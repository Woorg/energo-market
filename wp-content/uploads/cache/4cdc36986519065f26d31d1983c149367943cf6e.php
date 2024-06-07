

<?php

$title = get_field('title');


$args = [
  'post_type'      => 'advices',
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'ASC'
];

$query = new WP_Query( $args );

?>

<!-- Advices :: Start-->
<div class="advices">
  <div class="container-fluid">

    <?php if($title): ?>
      <h2 class="advices__title"><?php echo e($title); ?></h2>
    <?php endif; ?>

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

      </div>

    <?php endif; ?>
  </div>
</div>
<!-- Advices :: End-->

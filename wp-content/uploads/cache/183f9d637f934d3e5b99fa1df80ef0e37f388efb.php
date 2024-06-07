

<?php

  $title = get_field('title');

?>

<!-- Geo :: Start-->
<div class="geo">
  <div class="container-fluid">
    <div class="geo__map" id="map"></div>
    <div class="geo__desc">
      <?php if($title): ?>
        <h2 class="geo__title"><?php echo e($title); ?></h2>
      <?php endif; ?>
      <?php if(have_rows('stats')): ?>
        <ul class="geo__info">
          <?php while(have_rows('stats')): ?> <?php echo e(the_row()); ?>

            <?php
              $num = get_sub_field('num');
              $text = get_sub_field('text');
            ?>

            <li><span data-number="<?php echo e($num); ?>">-</span> <small><?php echo e($text); ?></small></li>

          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<!-- Geo :: End-->

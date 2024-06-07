<?php
  $single_hero_image = get_field('advice_image');
?>


<!-- Article or Ui-wysiwyg Class :: Start-->
<article class="article">
  <div class="container-fluid">
    <h1><?php echo e(the_title()); ?></h1>

    <?php if($single_hero_image): ?>

      <figure class="ui-image ui-image--outside">
        <img src="<?php echo e($single_hero_image['url']); ?>" alt="<?php echo e($single_hero_image['alt']); ?>">
      </figure>

    <?php endif; ?>

    
  </div>
</article>
<!-- Article or Ui-wysiwyg Class :: End-->

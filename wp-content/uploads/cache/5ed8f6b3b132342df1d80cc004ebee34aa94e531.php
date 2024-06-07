<?php
  $logo  = get_field('logo', 'options');
  $phone = get_field('phone', 'options');

?>

<!-- Header :: Start-->
<div class="header">
  <div class="container-fluid">
    <figure class="header__logo"><?php echo wp_get_attachment_image($logo, 'full'); ?></figure>
    <nav class="header__nav">
      <button class="header__nav-toggle">
        <span></span><span></span><span></span>
      </button>
      <div class="header__nav-offcanvas">

        <?php echo wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_id'     => '',
            'container'   => 'ul',
            'menu_class'  => 'header__nav-menu',
            'before'      => '',
            'after'       => '',
            'link_before' => '',
            'link_after'  => '',
            'walker'      => new Custom_Walker_Nav_Menu(),
          ]); ?>


      </div>
    </nav>
  </div>
</div>
<!-- Header :: End-->




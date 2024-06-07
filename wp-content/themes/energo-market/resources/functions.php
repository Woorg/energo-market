<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */

array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__) . '/config/assets.php',
            'theme' => require dirname(__DIR__) . '/config/theme.php',
            'view' => require dirname(__DIR__) . '/config/view.php',
        ]);
    }, true);


/**
 * Return svg sprite path
 * @return string
 */

function svg_sprite_path()
{
    $svg_path = get_template_directory_uri() . '/front/dist/sprites/sprite.svg';
    return $svg_path;
}


/**
 * Return fonts path
 * @return string
 */

function fonts_path()
{
    $fonts = get_template_directory_uri() . '/front/dist/';
    return $fonts;
}

/**
 * Return fonts path
 * @return string
 */

function app_path()
{
    $app_path = get_theme_root_uri() . '/energo-market/app';
    return $app_path;
}



// Change nav item class

// function energo_add_additional_class_on_li($classes, $item, $args)
// {
//     $classes[] = 'nav__item';
//     return $classes;
// }

// add_filter('nav_menu_css_class', 'energo_add_additional_class_on_li', 1, 3);


// Change nav link class

// function energo_filter_nav_menu_link_attributes($atts, $item, $args, $depth)
// {

//     $atts['class'] = 'nav__link';
//     return $atts;
// }

// add_filter('nav_menu_link_attributes', 'energo_filter_nav_menu_link_attributes', 10, 4);


// Add svg support


add_filter( 'mime_types', 'svg_upload_allow' );

function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
}


add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

    // WP 5.1 +
    if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
        $dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
    else
        $dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );

    // mime тип был обнулен, поправим его
    // а также проверим право пользователя
    if( $dosvg ){

        // разрешим
        if( current_user_can('manage_options') ){

            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }
        // запретим
        else {
            $data['ext'] = $type_and_ext['type'] = false;
        }

    }

    return $data;
}








/**
     * Archive Navigation
     *
     * @author Bill Erickson
     * @link https://www.billerickson.net/custom-pagination-links/
     *
     */
 //    function pagination() {

 //        $settings = array(
 //            'count' => 6,
 //            'prev_text' => '<svg class="pagination__icon" width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
 // <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6862 0.642822L0.327129 12.0019L11.6408 23.3157L13.055 21.9015L4.15038 12.9968L22.9978 13V10.9968L4.16073 10.9968L13.1004 2.05703L11.6862 0.642822Z" fill="currentColor"/>
 // </svg> Previous page',
 //            'next_text' => 'Next page <svg class="pagination__icon" width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
 // <path fill-rule="evenodd" clip-rule="evenodd" d="M11.6862 0.642822L0.327129 12.0019L11.6408 23.3157L13.055 21.9015L4.15038 12.9968L22.9978 13V10.9968L4.16073 10.9968L13.1004 2.05703L11.6862 0.642822Z" fill="currentColor"/>
 // </svg>'
 //        );

 //        global $wp_query;
 //        $current = max( 1, get_query_var( 'paged' ) );
 //        $total = $wp_query->max_num_pages;
 //        $links = array();

 //        // Offset for next link
 //        if( $current < $total )
 //            $settings['count']--;

 //        // Previous
 //        if( $current > 1 ) {
 //            $settings['count']--;
 //            $links[] = pagination_link( $current - 1, 'prev', $settings['prev_text'] );
 //        }

 //        // Current
 //        $links[] = pagination_link( $current, 'current' );

 //        // Next Pages
 //        for( $i = 1; $i < $settings['count']; $i++ ) {
 //            $page = $current + $i;
 //            if( $page <= $total ) {
 //                $links[] = pagination_link( $page );
 //            }
 //        }

 //        // Next
 //        if( $current < $total ) {
 //            $links[] = pagination_link( $current + 1, 'next', $settings['next_text'] );
 //        }


 //        echo '<nav class="navigation posts-navigation" role="navigation">';
 //            echo '<div class="nav-links">' . join( '', $links ) . '</div>';
 //        echo '</nav>';
 //    }
 //    add_action( 'tha_content_while_after', 'pagination' );

 //    /**
 //     * Archive Navigation Link
 //     *
 //     * @author Bill Erickson
 //     * @link https://www.billerickson.net/custom-pagination-links/
 //     *
 //     * @param int $page
 //     * @param string $class
 //     * @param string $label
 //     * @return string $link
 //     */
 //    function pagination_link( $page = false, $class = '', $label = '' ) {

 //        if( ! $page )
 //            return;

 //        $classes = array( 'page-numbers' );
 //        if( !empty( $class ) )
 //            $classes[] = $class;
 //        $classes = array_map( 'sanitize_html_class', $classes );

 //        $label = $label ? $label : $page;
 //        $link = esc_url_raw( get_pagenum_link( $page ) );

 //        return '<a class="' . join ( ' ', $classes ) . '" href="' . $link . '">' . $label . '</a>';

 //    }


// function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
//     return '<span class="breadcrumbs__sep">/</span>';
// };

// add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);



/*Contact form 7 remove span*/

// add_filter('wpcf7_form_elements', function($content) {
//     $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

//     $content = str_replace('<br />', '', $content);

//     return $content;
// });



add_filter( 'wp_get_nav_menu_items', 'cpt_locations_filter', 10, 3 );

function cpt_locations_filter( $items, $menu, $args ) {
  $child_items = [];
  $menu_order = count($items);
  $parent_item_id = 202;


  foreach ( $items as $item ) {
    if ( in_array('locations-menu', $item->classes) ){ //add this class to your menu item
        $parent_item_id = $item->ID;
    }

  }


  $args = [
    'post_type'      => 'services',
    'tax_query' => [
      [
        'taxonomy' => 'services-categories',
        'field' => 'id',
        'terms' => 2,
      ]
    ],
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'A#FFFFFFFFSC'
  ];

  foreach ( get_posts( $args ) as $post ) {

    $post->menu_item_parent = $parent_item_id;
    $post->post_type = 'nav_menu_item';
    $post->object = 'custom';
    $post->type = 'custom';
    $post->menu_order = ++$menu_order;
    $post->title = $post->post_title;
    $post->url = get_permalink( $post->ID );

    array_push($child_items, $post);

  }

  wp_reset_query();


return array_merge( $items, $child_items );


}


add_filter( 'wp_get_nav_menu_items', 'cpt_locations_filter2', 10, 3 );

function cpt_locations_filter2( $items, $menu, $args ) {
  $child_items = [];
  $menu_order = count($items);
  $parent_item_id = 203;


  foreach ( $items as $item ) {
    if ( in_array('locations-menu', $item->classes) ){ //add this class to your menu item
        $parent_item_id = $item->ID;
    }

  }


  $args = [
    'post_type'      => 'services',
    'tax_query' => [
      [
        'taxonomy' => 'services-categories',
        'field' => 'id',
        'terms' => 3,
      ]
    ],
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'A#FFFFFFFFSC'
  ];

  foreach ( get_posts( $args ) as $post ) {

    $post->menu_item_parent = $parent_item_id;
    $post->post_type = 'nav_menu_item';
    $post->object = 'custom';
    $post->type = 'custom';
    $post->menu_order = ++$menu_order;
    $post->title = $post->post_title;
    $post->url = get_permalink( $post->ID );

    array_push($child_items, $post);

  }

  wp_reset_query();


return array_merge( $items, $child_items );


}


add_filter( 'wp_get_nav_menu_items', 'cpt_locations_filter3', 10, 3 );

function cpt_locations_filter3( $items, $menu, $args ) {
  $child_items = [];
  $menu_order = count($items);
  $parent_item_id = 204;


  foreach ( $items as $item ) {
    if ( in_array('locations-menu', $item->classes) ){ //add this class to your menu item
        $parent_item_id = $item->ID;
    }

  }


  $args = [
    'post_type'      => 'services',
    'tax_query' => [
      [
        'taxonomy' => 'services-categories',
        'field' => 'id',
        'terms' => 4,
      ]
    ],
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'A#FFFFFFFFSC'
  ];

  foreach ( get_posts( $args ) as $post ) {

    $post->menu_item_parent = $parent_item_id;
    $post->post_type = 'nav_menu_item';
    $post->object = 'custom';
    $post->type = 'custom';
    $post->menu_order = ++$menu_order;
    $post->title = $post->post_title;
    $post->url = get_permalink( $post->ID );

    array_push($child_items, $post);

  }

  wp_reset_query();


return array_merge( $items, $child_items );


}

//register MegaMenu widget if the Mega Menu is set as the menu location
// $location = 'mega_menu';
// $css_class = 'mega-menu-parent';
// $locations = get_nav_menu_locations();
// if ( isset( $locations[ $location ] ) ) {
//   $menu = get_term( $locations[ $location ], 'nav_menu' );
//   if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
//     foreach ( $items as $item ) {
//       if ( in_array( $css_class, $item->classes ) ) {
//         register_sidebar( array(
//           'id'   => 'mega-menu-item-' . $item->ID,
//           'description' => 'Mega Menu items',
//           'name' => $item->title . ' - Mega Menu',
//           'before_widget' => '<li id="%1$s" class="mega-menu-item">',
//           'after_widget' => '</li>',

//         ));
//       }
//     }
//   }
// }


// Ajax portfolio


add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {

  check_ajax_referer('load_more_posts', 'security');

  $args = [
    'post_type'      => 'portfolio',
    'posts_per_page' => 12,
    'orderby'        => 'date',
    'order'          => 'ASC',
  ];

  $args['paged'] = $_POST['page'] + 1; // следующая страница
  $args['post_status'] = 'publish';


  $query = new WP_Query( $args );

  if ($query->have_posts()) {

      while ( $query->have_posts() ) {  $query->the_post(); ?>

        <li>
          <div class="interests__group">
            <?php if ( have_rows('slider', get_the_ID() ) ): ?>
              <div class="swiper-container swiper-interests js-swiper-interests">
                <div class="swiper-wrapper">
                <?php while ( have_rows( 'slider', get_the_ID() ) ):  the_row(); ?>

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
                        <img src="<?php echo $slider_image['url']; ?>" alt="<?php echo $slider_image['alt']; ?>">
                      </figure>
                      <h3 class="interests__item-title"><?php echo $slider_title; ?></h3>
                      <p class="interests__item-file">
                        <a class="interests__item-file-name" href="<?php echo $slider_file['url']; ?>" download><?php echo $slider_file['title']; ?></a>
                        <a class="interests__item-file-view" href="<?php echo $slider_file['link']; ?>" >
                          <svg class="icon-view">
                            <use xlink:href="<?php echo svg_sprite_path(); ?>#icon-view"></use>
                          </svg>
                        </a>
                        <a class="interests__item-file-download" href="<?php echo $slider_file['url']; ?>" download>
                          <svg class="icon-download">
                            <use xlink:href="<?php echo svg_sprite_path(); ?>#icon-download"></use>
                          </svg>
                        </a>
                      </p>
                      <p class="interests__item-text"><?php echo $slider_text; ?></p>
                    </div>
                  </div>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

                </div>

                <div class="swiper-control">

                  <button class="swiper-prev js-swiper-interests-prev">
                    <svg class="icon-prev">
                      <use xlink:href="<?php echo svg_sprite_path(); ?>#icon-prev"></use>
                    </svg>
                  </button>

                  <div class="swiper-pagination js-swiper-interests-pagination"></div>

                  <button class="swiper-next js-swiper-interests-next load-more">
                    <svg class="icon-next">
                      <use xlink:href="<?php echo svg_sprite_path(); ?>#icon-next"></use>
                    </svg>
                  </button>

                </div>

              </div>

            <?php endif; ?>

          </div>
        </li>

    <?php
      }


    }


    wp_die();



}


// Ajax advices

add_action('wp_ajax_load_advices_by_ajax', 'load_advices_by_ajax_callback');
add_action('wp_ajax_nopriv_load_advices_by_ajax', 'load_advices_by_ajax_callback');

function load_advices_by_ajax_callback() {

  check_ajax_referer('load_more_advices', 'security');

  $args = [
    'post_type'      => 'advices',
    'posts_per_page' => 12,
    'orderby'        => 'date',
    'order'          => 'ASC',
  ];

  $args['paged'] = $_POST['page'] + 1; // следующая страница
  $args['post_status'] = 'publish';


  $query = new WP_Query( $args );

  if ($query->have_posts()) {

      while ( $query->have_posts() ) {  $query->the_post();

        $text = get_field('text', get_the_ID());
        $thumbnail_id    = get_post_thumbnail_id( get_the_ID() );
        $alt             = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
      ?>
        <li>
          <a class="advices__item" href="<?php the_permalink() ?>">

            <figure class="advices__item-image">
              <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full'); ?>" alt="<?php echo $alt; ?> ">
            </figure>

            <h3 class="advices__item-title"><?php the_title(); ?></h3>

            <p class="advices__item-text"><?php echo $text; ?></p>
          </a>
        </li>

    <?php
      }

      wp_reset_postdata();

    }


    wp_die();


}

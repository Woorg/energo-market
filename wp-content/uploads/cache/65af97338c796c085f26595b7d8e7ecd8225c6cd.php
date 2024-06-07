<!doctype html>
<html class="is-page-default" <?php echo get_language_attributes(); ?>>
  <?php echo $__env->make('partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <body <?php body_class('page page_inner') ?>>
    <div class="app">
    <?php do_action('get_header') ?>
    <?php echo $__env->make('partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="main">
        <?php echo $__env->yieldContent('content'); ?>
      </div>
    <?php do_action('get_footer') ?>
    <?php echo $__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <?php wp_footer() ?>

    <!-- Scripts :: Start-->

<script>
function initMaps(){

    if ( $('#map').length ) {

        var map_contacts = new ymaps.Map('map', {
            center: [55.747229013464526,37.61898397265624],
            zoom: 10,
            controls: []
        });

        map_contacts.behaviors.disable('scrollZoom');


        var marker = new ymaps.Placemark([55.747229013464526,37.61898397265624], {}, {
            iconLayout: 'default#image',
            iconImageHref: 'images/icons/icon-location.svg',
            iconImageSize: [40, 40],
            iconImageOffset: [-20, -40]
        });

        map_contacts.geoObjects.add(marker);


    }

}

ymaps.ready(initMaps);
</script>
<!-- Scripts :: End-->

  </body>
</html>


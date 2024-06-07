<!doctype html>
<html class="is-page-default" {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class('page page_inner') @endphp>
    <div class="app">
    @php do_action('get_header') @endphp
    @include('partials.header')
      <div class="main">
        @yield('content')
      </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    </div>
    @php wp_footer() @endphp

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


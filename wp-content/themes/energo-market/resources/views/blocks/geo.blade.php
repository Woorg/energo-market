{{--
  Title: География
  Description: География
  Category: География
  Icon: editor-alignleft
  Keywords: География
  Mode: edit
  Align: full
  PostTypes: page
  SupportsAlign: left right full
  SupportsMode: false
  SupportsMultiple: true
  SupportsInnerBlocks: true
--}}

@php

  $title = get_field('title');

@endphp

<!-- Geo :: Start-->
<div class="geo">
  <div class="container-fluid">
    <div class="geo__map" id="map"></div>
    <div class="geo__desc">
      @if ($title)
        <h2 class="geo__title">{{ $title }}</h2>
      @endif
      @if (have_rows('stats'))
        <ul class="geo__info">
          @while (have_rows('stats')) {{ the_row() }}
            @php
              $num = get_sub_field('num');
              $text = get_sub_field('text');
            @endphp

            <li><span data-number="{{ $num }}">-</span> <small>{{ $text }}</small></li>

          @endwhile
        </ul>
      @endif
    </div>
  </div>
</div>
<!-- Geo :: End-->

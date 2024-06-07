{{--
  Title: Слайдер
  Description: Слайдер
  Category: layout
  Icon: editor-alignleft
  Keywords: Слайдер
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
$text = get_field('text');
$button_text = get_field('button_text');

$args = [

  'post_type'      => 'slider',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'ASC'

];

$query = new WP_Query( $args );


@endphp


@if ($query->have_posts())

<!-- Intro :: Start-->
<div class="intro">
  <div class="container-fluid">
    <div class="swiper-container swiper-intro js-swiper-intro">
      <div class="swiper-wrapper">
      @while ($query->have_posts()) {{ $query->the_post() }}
        @php
          $title = get_field('title', get_the_ID());
          $text = get_field('text', get_the_ID());
          $image = get_field('image', get_the_ID());
        @endphp
        <div class="swiper-slide">
          <div class="intro__item" data-swiper-parallax-opacity="0">
            <div class="row">
              <div class="col-md-6 push-md-6">
                <figure class="intro__item-image"><img src="{!! wp_get_attachment_image_url($image, 'full') !!}" alt="">
                  @if (have_rows('advantages', get_the_ID()))
                    <dl class="intro__item-dl">
                    @while (have_rows('advantages', get_the_ID())) {{ the_row() }}

                      @php
                        $term = get_sub_field('term', get_the_ID());
                        $desc = get_sub_field('desc', get_the_ID());
                      @endphp

                      <dt>{{ $term }}</dt><dd>{{ $desc }}</dd>
                    @endwhile
                    </dl>
                  @endif

                </figure>
              </div>
              <div class="col-md-6 pull-md-6">
                <div class="intro__item-desc">
                  <h2 class="intro__item-title">{!! $title !!}</h2>
                  <p class="intro__item-text">{{ $text }}</p>
                  <div class="intro__item-control">
                    <div class="swiper-control">
                      <button class="swiper-prev js-swiper-intro-prev">
                        <svg class="icon-prev">
                          <use xlink:href="{{ svg_sprite_path() }}#icon-prev"></use>
                        </svg>
                      </button>
                      <div class="swiper-pagination js-swiper-intro-pagination"></div>
                      <button class="swiper-next js-swiper-intro-next">
                        <svg class="icon-next">
                          <use xlink:href="{{ svg_sprite_path() }}#icon-next"></use>
                        </svg>
                      </button>
                    </div><a class="ui-btn ui-btn--red" href="#popup-request" data-fancybox>Призыв к действию
                      <svg class="icon-arrow-btn">
                        <use xlink:href="{{ svg_sprite_path() }}#icon-arrow-btn"></use>
                      </svg></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      @endwhile

      {{ wp_reset_postdata() }}

      </div>
    </div>
  </div>
</div>
<!-- Intro :: End-->

@endif

{{--
  Title: Отзывы
  Description: Отзывы
  Category: Отзывы
  Icon: editor-alignleft
  Keywords: Отзывы
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

$args = [
  'post_type'      => 'reviews',
  'posts_per_page' => 4,
  // 'tax_query' => [
  //   [
  //     'taxonomy' => 'projects-categories',
  //     'field' => 'id',
  //     'terms' => 6,
  //   ]
  // ],
  'orderby'        => 'date',
  'order'          => 'ASC'
];

$query = new WP_Query( $args );

@endphp


<!-- Reviews :: Start-->
<div class="reviews">
  <div class="container-fluid">

    <h2 class="reviews__title">{!! $title !!}</h2>

    <div class="reviews__section">

      @if ($query->have_posts())

      <div class="swiper-reviews js-swiper-reviews">

        <div class="swiper-container swiper-reviews-slides js-swiper-reviews-slides">
          <div class="swiper-wrapper">

            @while ($query->have_posts()) {{ $query->the_post() }}

              @php
                $reviews_project = get_field('reviews_project', get_the_ID());
                $reviews_image   = get_field('reviews_image', get_the_ID());
                $reviews_text    = get_field('reviews_text', get_the_ID());
                $thumbnail_id    = get_post_thumbnail_id( get_the_ID() );
                $alt             = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              @endphp

              <div class="swiper-slide">
                <div class="reviews__slide">
                  <div class="reviews__slide-sidebar">
                    <figure class="reviews__slide-image">
                      <img src="{{ $reviews_image['url'] }}" alt="{{ $reviews_image['alt'] }}">
                    </figure>
                    <p class="reviews__slide-caption">{{ the_title() }}
                      @if ($reviews_project)
                        <small>{{ $reviews_project }}</small>
                      @endif
                    </p>
                  </div>
                  <div class="reviews__slide-content">
                    <blockquote class="reviews__slide-blockquote">{!! $reviews_text !!}</blockquote>
                  </div>
                </div>
              </div>

            @endwhile

          </div>

          <div class="swiper-pagination js-swiper-reviews-pagination"></div>
        </div>


        <div class="swiper-container swiper-reviews-thumbs js-swiper-reviews-thumbs">

          <div class="swiper-wrapper">
            @while ($query->have_posts()) {{ $query->the_post() }}

              @php
                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              @endphp

              <div class="swiper-slide">
                <figure class="reviews__thumb">
                  <img src="{{ get_the_post_thumbnail_url( get_the_ID(), 'full' ) }}" alt="{{ $alt }}">
                </figure>
              </div>

            @endwhile

            @php
              $link = get_field('link');
            @endphp

            <div class="swiper-slide">
              <figure class="reviews__thumb"><a class="reviews__thumb-link" href="{!! $link !!}" target="_blank">Все отзывы
                  <svg class="icon-arrow-right">
                    <use xlink:href="{{ svg_sprite_path() }}#icon-arrow-right"></use>
                  </svg></a></figure>
            </div>

          </div>

          <button class="swiper-prev js-swiper-reviews-prev">
            <svg class="icon-prev"><use xlink:href="{{ svg_sprite_path() }}#icon-prev"></use></svg>
          </button>
          <button class="swiper-next js-swiper-reviews-next">
            <svg class="icon-next"><use xlink:href="{{ svg_sprite_path() }}#icon-next"></use></svg>
          </button>
        </div>

      </div>

        {{ wp_reset_postdata() }}

      @endif

    </div>
  </div>
</div>
<!-- Reviews :: End-->
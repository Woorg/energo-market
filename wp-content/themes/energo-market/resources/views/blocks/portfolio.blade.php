{{--
  Title: Портфолио
  Description: Портфолио
  Category: Портфолио
  Icon: editor-alignleft
  Keywords: Портфолио
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


<!-- Interests :: Start-->
<div class="interests">
  <div class="container-fluid">
    <h2 class="interests__title">{!! $title !!}</h2>
    <div class="interests__section">

      @if (have_rows('list'))
        <ul class="interests__caption">
          @while (have_rows('list')) {{ the_row() }}
            @php
              $list_item = get_sub_field('list_item');
            @endphp

            <li>{{ $list_item }}</li>
          @endwhile
        </ul>
      @endif

      @php
        $args = [
          'post_type'      => 'portfolio',
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'ASC'
        ];

        $query = new WP_Query( $args );

      @endphp


      @if ($query->have_posts())
        <ul class="interests__grid">
        @while ($query->have_posts()) {{ $query->the_post() }}
          <li>
            <div class="interests__group">
              @if (have_rows('slider', get_the_ID()))
                <div class="swiper-container swiper-interests js-swiper-interests">
                  <div class="swiper-wrapper">
                  @while (have_rows('slider', get_the_ID())) {{ the_row() }}

                    @php
                      $slider_image = get_sub_field('slider_image');
                      $slider_title = get_sub_field('slider_title');
                      $slider_file  = get_sub_field('slider_file');
                      $slider_link  = get_sub_field('slider_link');
                      $slider_text  = get_sub_field('slider_text');

                    @endphp

                    {{-- @dump($slider_file) --}}

                    <div class="swiper-slide">
                      <div class="interests__item">
                        <figure class="interests__item-image">
                          <img src="{!! $slider_image['url'] !!}" alt="{{ $slider_image['alt'] }}">
                        </figure>
                        <h3 class="interests__item-title">{{ $slider_title }}</h3>
                        <p class="interests__item-file">
                          <a class="interests__item-file-name" href="{{ $slider_file['url'] }}" download>{{ $slider_file['title'] }}</a>
                          <a class="interests__item-file-view" href="{{ $slider_file['link'] }}" >
                            <svg class="icon-view">
                              <use xlink:href="{{ svg_sprite_path() }}#icon-view"></use>
                            </svg>
                          </a>
                          <a class="interests__item-file-download" href="{{ $slider_file['url'] }}" download>
                            <svg class="icon-download">
                              <use xlink:href="{{ svg_sprite_path() }}#icon-download"></use>
                            </svg>
                          </a>
                        </p>
                        <p class="interests__item-text">{{ $slider_text }}</p>
                      </div>
                    </div>

                  @endwhile
                  </div>

                  <div class="swiper-control">
                    <button class="swiper-prev js-swiper-interests-prev">
                      <svg class="icon-prev">
                        <use xlink:href="{{ svg_sprite_path() }}#icon-prev"></use>
                      </svg>
                    </button>
                    <div class="swiper-pagination js-swiper-interests-pagination"></div>
                    <button class="swiper-next js-swiper-interests-next">
                      <svg class="icon-next">
                        <use xlink:href="{{ svg_sprite_path() }}#icon-next"></use>
                      </svg>
                    </button>
                  </div>

                </div>
              @endif

            </div>
          </li>

        @endwhile

        {{ wp_reset_postdata() }}

        </ul>

        @php
          $link = get_field('link');
          $button_text = get_field('button_text');
        @endphp

        @if ($link)

        <div class="advices__control">
          <a class="ui-btn ui-btn--red" href="{{ $link }}" target="_blank">{{ $button_text }}
            <svg class="icon-arrow-btn">
              <use xlink:href="{{ svg_sprite_path() }}#icon-arrow-btn"></use>
            </svg>
          </a>
        </div>

        @endif


      @endif
    </div>
  </div>
</div>
<!-- Interests :: End-->

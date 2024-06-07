@extends('layouts.app-inner')

@section('content')


<!-- Interests :: Start-->
<div class="interests interests_single">
  <div class="container-fluid">
    <h2 class="interests__title">{!! post_type_archive_title() !!}</h2>
    <div class="interests__section">

      @php

        $args = [
          'post_type'      => 'portfolio',
          'posts_per_page' => 12,
          'orderby'        => 'date',
          'order'          => 'ASC',
          // 'offset'         => 12,
          // 'paged'          => 1,
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
                    <button class="swiper-next js-swiper-interests-next load-more" data>
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


        <div class="advices__control">
          <button class="ui-btn ui-btn--red loadmore">Еще кейсы
            <svg class="icon-arrow-btn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.4853 20.4853C18.2348 22.7357 15.1826 24 12 24C5.37258 24 0 18.6274 0 12C0 8.8174 1.26428 5.76515 3.51472 3.51472C5.76516 1.26428 8.8174 0 12 0C15.1826 0 18.2348 1.26428 20.4853 3.51472C22.7357 5.76515 24 8.8174 24 12C24 15.1826 22.7357 18.2348 20.4853 20.4853ZM7.4 11.2392L13.4865 11.2392L10.8236 8.57635L11.904 7.496L16.408 12L11.904 16.504L10.8236 15.4236L13.4865 12.7608L7.4 12.7608V11.2392ZM12 1.2C17.9647 1.2 22.8 6.03533 22.8 12C22.8 17.9647 17.9647 22.8 12 22.8C9.13566 22.8 6.38864 21.6621 4.36325 19.6368C2.33785 17.6114 1.2 14.8643 1.2 12C1.2 6.03533 6.03532 1.2 12 1.2Z" fill="white"/></svg>

          </button>
        </div>


        @endif

    </div>
  </div>
</div>
<!-- Interests :: End-->

@endsection

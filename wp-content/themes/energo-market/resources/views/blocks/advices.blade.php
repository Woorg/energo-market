{{--
  Title: Советы
  Description: Советы
  Category: Советы
  Icon: editor-alignleft
  Keywords: Советы
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
  'post_type'      => 'advices',
  'posts_per_page' => 3,
  'orderby'        => 'date',
  'order'          => 'ASC'
];

$query = new WP_Query( $args );

@endphp

<!-- Advices :: Start-->
<div class="advices">
  <div class="container-fluid">

    @if ($title)
      <h2 class="advices__title">{{ $title }}</h2>
    @endif

    @if ($query->have_posts())

      <div class="advices__section">
        <ul class="advices__grid">
        @while ($query->have_posts()) {{ $query->the_post() }}
          @php
            $text = get_field('text', get_the_ID());
            $thumbnail_id    = get_post_thumbnail_id( get_the_ID() );
            $alt             = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
          @endphp
          <li>
            <a class="advices__item" href="{{ the_permalink() }}">

              <figure class="advices__item-image">
                <img src="{{ get_the_post_thumbnail_url( get_the_ID(), 'full') }}" alt="{{ $alt }}">
              </figure>

              <h3 class="advices__item-title">{{ the_title() }}</h3>

              <p class="advices__item-text">{{ $text }}</p>
            </a>
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

      </div>

    @endif
  </div>
</div>
<!-- Advices :: End-->

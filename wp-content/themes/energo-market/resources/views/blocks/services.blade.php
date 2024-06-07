{{--
  Title: Услуги
  Description: Услуги
  Category: layout
  Icon: editor-alignleft
  Keywords: Услуги
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

<!-- Services :: Start-->
<div class="services" data-tabs>
  <div class="container-fluid">
    <div class="services__topbar">
      <h2 class="services__title">{{ $title }}</h2>

      @php

        $terms = get_terms( [
          'taxonomy'   => 'services-categories',
          'orderby'    => 'date',
          'order'      => 'ASC',
          'hide_empty' => true,
        ] );

      @endphp

      @if ($terms)

        @php
          $i = 0;
        @endphp

      <div class="services__control">
        @foreach ($terms as $term)

          @php
            $i++;
            $tab_class = $i <= 1 ? 'services__control-btn is-active' : 'services__control-btn';
            $title = get_field('title', $term);
          @endphp

          <button class="{{ $tab_class }}" data-tabs-btn="0{{ $i }}">
            <span class="services__control-btn-icon">
              <svg class="icon-services-0{{ $i }}">
                <use xlink:href="{{ svg_sprite_path() }}#icon-services-0{{ $i }}"></use>
              </svg>
            </span>
            <span class="services__control-btn-text">{!! $title !!}</span>
          </button>

        @endforeach

      </div>
      @endif

    </div>

    @if ($terms)

      @php
        $i = 0;
      @endphp

      <div class="services__section">
        @foreach ($terms as $term)
          @php
            $i++;
            $tab_class = $i <= 1 ? 'services__content is-active' : 'services__content';
          @endphp

          <div class="{{ $tab_class }}" data-tabs-content="0{{ $i }}">

            @php
              $args = [
                'post_type'      => 'services',
                'tax_query' => [
                  [
                    'taxonomy' => $term->taxonomy,
                    'field' => 'slug',
                    'terms' => $term->slug,
                  ]
                ],
                'posts_per_page' => -1,
                'orderby'        => 'date',
                'order'          => 'ASC'
              ];

              $query = new WP_Query( $args );

            @endphp

            @if ($query->have_posts())

            <ul class="services__grid">
              @while ($query->have_posts()) {{ $query->the_post() }}

                @php
                  $mark = get_field('mark');
                  $text= get_field('text');
                @endphp

              <li>
                <a class="services__item" href="{{ the_permalink() }}">
                  <h3 class="services__item-title">{{ the_title() }}</h3>
                  <mark class="services__item-mark">{{ $mark }}</mark>
                  <p class="services__item-text">{{ $text }}</p>
                </a>
              </li>

              @endwhile

              {{ wp_reset_postdata() }}

            </ul>

            @endif

          </div>

        @endforeach

      </div>
    @endif
  </div>
</div>
<!-- Services :: End-->

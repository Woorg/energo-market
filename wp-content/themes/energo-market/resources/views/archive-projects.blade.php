@extends('layouts.app-inner')

@section('content')

@php
    $args = [
      'post_type'      => 'projects',
      'posts_per_page' => 100,
      // 'tax_query' => [
      //   [
      //     'taxonomy' => 'projects-categories',
      //     'field' => 'id',
      //     'terms' => 5,
      //   ]
      // ],
      'orderby'        => 'date',
      'order'          => 'ASC'
    ];

    $query = new WP_Query( $args );
@endphp

<!-- Reviews :: Start-->
<div class="reviews reviews_single">
  <div class="container-fluid">

@if ($query->have_posts())

    <h2 class="reviews__title">{!! post_type_archive_title()  !!}</h2>
    <div class="reviews__section">


            @while ($query->have_posts()) {{ $query->the_post() }}

              @php
                $reviews_text = get_field('reviews_text', get_the_ID());
                $thumbnail_id = get_post_thumbnail_id( get_the_ID() );
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
              @endphp

                <div class="reviews__slide">
                  <div class="reviews__slide-sidebar">
                    <figure class="reviews__slide-image">
                      <img src="{{ get_the_post_thumbnail_url( get_the_ID(), 'full' ) }}" alt="{{ $alt }}">
                    </figure>
                    <p class="reviews__slide-caption">{{ the_title() }}</p>
                  </div>
                  <div class="reviews__slide-content">
                    <blockquote class="reviews__slide-blockquote">{!! $reviews_text !!}</blockquote>
                  </div>
                </div>

            @endwhile

            {{ wp_reset_postdata() }}


    </div>

@endif

  </div>
</div>
<!-- Reviews :: End-->

@endsection

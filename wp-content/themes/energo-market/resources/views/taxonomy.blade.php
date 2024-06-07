@extends('layouts.app-inner-resort')

@section('content')
  <div class="article article_taxonomy">
    <div class="article__row container flex">

      <div class="article__content content">
        <div class="breadcrumbs content__breadcrumbs">
          @if(function_exists('yoast_breadcrumb'))
            @php yoast_breadcrumb() @endphp
          @endif
        </div>

        @while( have_posts() ) @php the_post() @endphp

        {{--  <div class="article__item">
           <a class="article__link" href="{{ the_permalink() }}">
             @if(has_post_thumbnail())
             <div class="article__image-w">
               {{ the_post_thumbnail('full', [ 'class' => 'article__image swiper-lazy']) }}
             </div>
             @endif
             <div class="article__name">{{ the_title() }}
               <svg class="article__name-icon" width="16px" height="16px">
                 <use xlink:href="{{ svg_sprite_path() }}#ext-link-arrow"></use>
               </svg>
             </div>
             <div class="article__text">{{ the_excerpt() }}</div>
             <div class="article__date">{{ the_time('d M Y') }}</div>
           </a>
         </div> --}}

        <div class="article__item">
          <a class="article__link" href="{{ the_permalink() }}">
            <div class="article__image-w">
              {{ the_post_thumbnail('full', ['class' => 'article__image swiper-lazy']) }}
            </div>

            <span class="article__name">{{ the_title() }}</span>
          </a>
        </div>
        @endwhile
        @php
          // wp_reset_postdata();
          the_posts_pagination();
        @endphp

      </div>

      {{-- <aside class="sidebar article__sidebar">
        <div class="sidebar__block sidebar__block_recent">
          <h3 class="sidebar__block-title">Recent Posts</h3>

          @php
            $args = [
              // 'post_type' => 'post',
              'cat' => 'articles',
              'posts_per_page' => 3,
              'order' => 'DESC',
              'orderby' => 'date'
            ];
            $query = new WP_Query($args);
          @endphp

          @if($query->have_posts())
            <ul class="sidebar__list">
              @while($query->have_posts()) @php $query->the_post(); @endphp
              <li class="sidebar__item">
                <a class="sidebar__item-link flex" href="{{ get_the_permalink(get_the_ID()) }}">
                  <svg class="sidebar__item-icon" width="22px" height="22px">
                    <use xlink:href="{{ svg_sprite_path() }}#recent-posts-icon"></use>
                  </svg>
                  <div class="sidebar__item-title">{{ get_the_title(get_the_ID()) }}</div>
                </a>
              </li>
              @endwhile
            </ul>
            @php wp_reset_postdata() @endphp
          @endif
        </div>
      </aside> --}}
    </div>
  </div>

@endsection

@php
  $copyright = get_field('copyright', 'options');
  $created = get_field('created', 'options');
  $form_title_1 = get_field('form_title_1', 'options');
  $form_shortcode_1 = get_field('form_shortcode_1', 'options');
@endphp

<!-- Footer :: Start-->
<div class="footer">
  <div class="container-fluid">
    <p class="footer__copyright">{{ date('Y') }} {!! $copyright !!}</p>
    <p class="footer__dev">Сделано в

    @if ($created)

      @php
        $created_link  = $created['created_link'];
        $created_image = $created['created_image'];
      @endphp
      <a class="footer__dev-link" href="{{ $created_link }}" target="_blank">
        <img src="{!! $created_image['sizes']['large'] !!}" alt="{!! $created_image['alt'] !!}">
      </a>
     @endif
    </p>
  </div>
</div>
<!-- Footer :: End-->
<!-- Popups :: Start-->
<div class="fancybox-is-hidden" id="popup-request">
  <div class="popup">
    <button class="popup__close" data-fancybox-close>
      <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.375 1.85063L16.5244 0L9.1875 7.33687L1.85063 0L0 1.85063L7.33687 9.1875L0 16.5244L1.85063 18.375L9.1875 11.0381L16.5244 18.375L18.375 16.5244L11.0381 9.1875L18.375 1.85063Z" fill="currentColor"/></svg>
    </button>

    <div class="popup__content">
      @if ($form_title_1)
        <span class="popup__title">{{ $form_title_1 }}</span>
      @endif

      <div class="popup__form">
        <form class="js-validate" action="#">
          <div class="ui-field">
            <input class="ui-input" type="text" name="firstname" placeholder="Имя">
          </div>
          <div class="ui-field">
            <input class="ui-input" type="tel" name="tel" placeholder="Телефон">
          </div>
          <div class="ui-field">
            <input class="ui-input" type="email" name="email" placeholder="E-mail">
          </div>
          <div class="ui-field">
            <textarea class="ui-textarea" name="message" placeholder="Сообщение"></textarea>
          </div>
          <button class="ui-btn ui-btn--red ui-btn--fullwidth">Отправить заявку</button>
        </form>
      </div>

    </div>

  </div>

</div>
<!-- Popups :: End-->


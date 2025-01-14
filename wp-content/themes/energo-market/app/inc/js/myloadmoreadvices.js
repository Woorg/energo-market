jQuery(function ($) { // use jQuery code inside this to avoid "$ is not defined" error
  $('.loadmore-advices').click(function () {

    var button = $(this),
      data = {
        'action': 'load_advices_by_ajax',
        'query': load_more_advices.posts, // that's how we get params from wp_localize_script() function
        'page': load_more_advices.current_page,
        'security': load_more_advices.security
      };


    $.ajax({ // you can also use $.post here
      url: load_more_advices.ajaxurl, // AJAX handler
      data: data,
      type: 'POST',
      beforeSend: function (xhr) {

        button.html('Загружаются cоветы... <svg class="icon-arrow-btn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.4853 20.4853C18.2348 22.7357 15.1826 24 12 24C5.37258 24 0 18.6274 0 12C0 8.8174 1.26428 5.76515 3.51472 3.51472C5.76516 1.26428 8.8174 0 12 0C15.1826 0 18.2348 1.26428 20.4853 3.51472C22.7357 5.76515 24 8.8174 24 12C24 15.1826 22.7357 18.2348 20.4853 20.4853ZM7.4 11.2392L13.4865 11.2392L10.8236 8.57635L11.904 7.496L16.408 12L11.904 16.504L10.8236 15.4236L13.4865 12.7608L7.4 12.7608V11.2392ZM12 1.2C17.9647 1.2 22.8 6.03533 22.8 12C22.8 17.9647 17.9647 22.8 12 22.8C9.13566 22.8 6.38864 21.6621 4.36325 19.6368C2.33785 17.6114 1.2 14.8643 1.2 12C1.2 6.03533 6.03532 1.2 12 1.2Z" fill="white"/></svg>');
           // change the button text, you can also add a preloader image

      },
      success: function (data) {
        // console.log(data);
        if (data) {
          button.html('Еще cоветы <svg class="icon-arrow-btn" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.4853 20.4853C18.2348 22.7357 15.1826 24 12 24C5.37258 24 0 18.6274 0 12C0 8.8174 1.26428 5.76515 3.51472 3.51472C5.76516 1.26428 8.8174 0 12 0C15.1826 0 18.2348 1.26428 20.4853 3.51472C22.7357 5.76515 24 8.8174 24 12C24 15.1826 22.7357 18.2348 20.4853 20.4853ZM7.4 11.2392L13.4865 11.2392L10.8236 8.57635L11.904 7.496L16.408 12L11.904 16.504L10.8236 15.4236L13.4865 12.7608L7.4 12.7608V11.2392ZM12 1.2C17.9647 1.2 22.8 6.03533 22.8 12C22.8 17.9647 17.9647 22.8 12 22.8C9.13566 22.8 6.38864 21.6621 4.36325 19.6368C2.33785 17.6114 1.2 14.8643 1.2 12C1.2 6.03533 6.03532 1.2 12 1.2Z" fill="white"/></svg>')
          .parent().prev('.advices__grid').append(data); // insert new posts
          load_more_advices.current_page++;


          if (load_more_advices.current_page == load_more_advices.max_page)
            button.remove(); // if last page, remove the button

          // you can also fire the "post-load" event here if you use a plugin that requires it
          // $( document.body ).trigger( 'post-load' );
        } else {
          button.remove(); // if no data, remove the button as well
        }
      }
    });
  });
});

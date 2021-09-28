jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
    
	$('.products_loadmore > a').click(function(event){
        event.preventDefault();

		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': products_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : products_loadmore_params.current_page
		};
        console.log(products_loadmore_params)
		$.ajax({ // you can also use $.post here
			url : products_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					button.text( 'Load more' ).parents('.best-sells').find('ul.products').append(data); // insert new posts
					products_loadmore_params.current_page++;
                    
					if ( products_loadmore_params.current_page == products_loadmore_params.max_page ) 
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

( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var MerchProductsHandler = function( $scope, $ ) {
		//console.log($scope);
        var nav = $scope.find('.tabs-nav'),
            panel = $scope.find('.tabs-panel');

            nav.find('li a').on('click', function(event) {
                event.preventDefault();
                nav.find('li').removeClass('active');
                $(this).parent().addClass('active');

                var href = $(this).attr('href')

                panel.removeClass('active');
                panel.each(function() {
                    if( href == '#' + $(this).data('term') ) {
                        $(this).addClass('active');
                    }
                });
            });

 	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/yolo-merch-products.default', MerchProductsHandler );

	} );

} )( jQuery );

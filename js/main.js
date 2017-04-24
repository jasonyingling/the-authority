jQuery(document).ready(function($){
    $('.js-toggle-site-search').click(function() {
        if ( $(this).hasClass('site-search-open') ) {
            closeSearch(this);
        } else {
            openSearch(this);
        }
    });

    function openSearch(button) {
        $(button).addClass('site-search-open');
        $(button).find('span').html('Close');
        $(button).find('.fa').removeClass('fa-search').addClass('fa-times');
        $('.js-site-search-dropdown').slideDown();
    }

    function closeSearch(button) {
        $(button).removeClass('site-search-open');
        $(button).find('span').html('Search');
        $(button).find('.fa').removeClass('fa-times').addClass('fa-search');
        $('.js-site-search-dropdown').slideUp();
    }

    $('#mobile-navigation').mmenu({
	    offCanvas: {
	        position: "right",
	    },
		navbar: {
			title: "Menu",
		},
	    extensions: ["pageshadow", "effect-slide-menu", "effect-slide-listitems", "theme-dark"]
	});
});

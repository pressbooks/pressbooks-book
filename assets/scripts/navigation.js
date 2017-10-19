jQuery(($) => {
	$('.js-header-menu-toggle').click((event) => {
    event.preventDefault();
    $(event.currentTarget).toggleClass('--active');
    $('.js-header-nav').toggleClass('--visible');
  });
});

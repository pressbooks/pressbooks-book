jQuery(document).ready(($) => {
	$('.toggle').click((event) => {
    event.preventDefault();
    $(event.currentTarget).toggleClass('toggle--active');
    $('.banner__navigation').toggleClass('banner__navigation--visible');
  });
});

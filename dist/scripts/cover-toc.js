jQuery(
	function($){
		$(document.body).on('click', '.js-toc-part-toggle', function(e){
			var $target = $(this);
			var $dropdown = $target.parents('.js-toc-part');
			$dropdown.toggleClass('open');
		});

		$(document.body).on('click', '.js-toc-toggle-all-show', function(e){
			var $target = $(this);
			$target.hide();
			$('.js-toc-toggle-all-hide').show();
			$('.js-toc-part').addClass('open');
		});

		$(document.body).on('click', '.js-toc-toggle-all-hide', function(e){
			var $target = $(this);
			$target.hide();
			$('.js-toc-toggle-all-show').show();
			$('.js-toc-part').removeClass('open');
		});

		$(document.body).on('click', '.js-toc-toggle', function(e){
			var $target = $(this);
			$target.parents('.js-toc-toggle-con').toggleClass('--visible');
			$('.js-toc').toggleClass('--visible');
		});
	}
);

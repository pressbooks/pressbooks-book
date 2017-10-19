jQuery(
	function($){
		$(document.body).on('click', '.section-toc__part__title a', function(e){
			var $target = $(this);
			var $dropdown = $target.parent().parent().parent('.section-toc__part');
			$dropdown.toggleClass('open');
		});

		$(document.body).on('click', '.section-toc__toggle-all__show', function(e){
			var $target = $(this);
			$target.hide();
			$('.section-toc__toggle-all__hide').show();
			$('.section-toc__part').addClass('open');
		});

		$(document.body).on('click', '.section-toc__toggle-all__hide', function(e){
			var $target = $(this);
			$target.hide();
			$('.section-toc__toggle-all__show').show();
			$('.section-toc__part').removeClass('open');
		});
	}
);

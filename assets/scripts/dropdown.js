jQuery(
	function($){

		$(document.body).on('click',function(e){
			var $target = $(e.target);

			if($target.is('[data-toggle=dropdown]')){
				return;
			}

			$('.dropdown-menu.show').each(function(){
				var $dropdown = $(this);
				console.log($dropdown);
				$dropdown.removeClass('show');
			})
		});

		$(document.body).on('click', '[data-toggle=dropdown]', function(e){
			var $target = $(this);
			var $dropdown = $target.parent('.dropdown').find('.dropdown-menu');

			$dropdown.toggleClass('show');


		});
	}
);
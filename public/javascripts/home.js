jQuery(function($){'use strict',

	$('a[href*=\\#]').on('click', function(e) {
		e.preventDefault();
	});

	// nav-hide |bouton-menu
	$('.nav-center-hide').on('click', 'i', function() {
		var i = $('.nav-center-hide i');
		if (i.hasClass('fa-bars')) {
			i.removeClass('fa-bars').addClass('fa-window-close');
			$('.nav-center').addClass('show-element');
		} else {
			i.addClass('fa-bars').removeClass('fa-window-close');
			$('.nav-center').removeClass('show-element');
		}
	});

	// tutoriels
	$('.actualites').after('<li class="li-hidden2"> <a href="">Resultats*</a> <div class="sub-nav2"> <ul class="sub-nav-group2"><li class="sub-nav-h">Continents</li><li><a href="" class="html"><i class="fa fa-globe-africa"></i> afrique</a></li><li><a href="" class="css"><i class="fa fa-globe-asia"></i> asie</a></li><li><a href="" class="javascript"><i class="fa fa-globe-europe"></i> europe</a></li><li><a href="" class="mysql"><i class="fa fa-globe-americas"></i> amerique</a></li></ul><ul class="sub-nav-group2"><li class="sub-nav-h">Ressources</li><li><a href=""><i class="fa fa-book-open"></i> Livres</a></li><li class="sub-nav-h mt-3">Catégories</li><li><a href=""><i class="fa fa-football-ball"></i> Premier league</a></li><li><a href=""><i class="fa fa-football-ball"></i> Bondesliga</a></li><li><a href=""><i class="fa fa-football-ball"></i> Serie A</a></li></ul></div> </li>');
	$('.actualites').after('<li class="mobile-show2"><a href="">Resultats</a></li>');
	$('.resultats').on( {
		mouseenter: function() {
			var sn2 = $('.sn2');
			sn2.addClass('show').removeClass('d-none');
			$('.sub-nav-2').show();
		}, 
		mouseleave: function()
		{
			var sn2 = $('.sn2');
			sn2.removeClass('show').addClass('d-none');
			$('.sub-nav-2').hide();
		}
	});

	// $('.language-menu-content').on('click', function() 
	// {
	// 	$('.language-menu-dropdown').toggle();
	// });
	
});
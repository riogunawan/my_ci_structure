$(document).ready(function() {
	var template = '';
				
	template += '<div class="grid-item">';
	template += '	<a href="{{link}}" class="grid-sizer" target="_blank">';
	template += '		<img src="{{image}}" class="img-responsive insta-img" data-link="{{link}}" style="width: 100%; display: block; cursor: pointer;" />';
	template += '	</a>';
	template += '</div>';

	var gridElem = $('.grid');
	var msnry;
	
	var feed = new Instafeed({
		get: "user",
		userId: 995838512,
		accessToken: "995838512.b160f11.69195b502a884deca081e4586d262148",
		links: true,
		limit: 9,
		resolution: "standard_resolution",
		template: template,
		filter: function(image) {
		    return image.type === "image";
		},
		after: function() {
			msnry = new Masonry('.grid', {
				itemSelector: '.grid-item',
				horizontalOrder : true,
				fitWidth: true,
				percentPosition : true,
			});
			// imagesLoaded( gridElem ).on( 'progress', function() {
				msnry.layout();
			// });
		}
	});
	
	feed.run();

	$('.grid').on('click', '.insta-img', function(event) {
		event.preventDefault();
		var link = $(this).data('link');
		window.open(link, "_blank");
	});;
});
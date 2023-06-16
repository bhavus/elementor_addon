jQuery(document).ready(function($) {
	$('.autogrid-select-posts').select2({
		ajax: {
			url: ajaxurl,
			dataType: 'json',
			method:"POST",
			data: function (params) {
				return {
					keyword: params.term,
					nonce: $(this).attr('data-nonce'),
					action: 'autogrid_featured_posts'
				};
			},
			processResults: function( response ) {
				var options = [];
				if ( response.status ) {
					$.each( response.post_data, function( index, text ) {
						options.push( { id: text['post_id'], text: text['post_title']  } );
					});
				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 3
	});

	$('.autogrid-select-cta').select2({
		ajax: {
			url: ajaxurl,
			dataType: 'json',
			method:"POST",
			data: function (params) {
				return {
					keyword: params.term,
					nonce: $(this).attr('data-nonce'),
					action: 'autogrid_category_cta'
				};
			},
			processResults: function( response ) {
				var options = [];
				if ( response.status ) {
					$.each( response.post_data, function( index, text ) {
						options.push( { id: text['post_id'], text: text['post_title']  } );
					});
				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 3
	});

});



(function( $ ){
	$(document).on('click','.js-filter-item > a',function(e){
		e.preventDefault();
		$('.js-filter-item').removeClass("active");
		$(this).parent().addClass("active");
		var category = $(this).data('category');
		$(' .load_more .btn-load-more').attr('data-category',category);
		var data = {
            'action': 'filter',
            'category':category
        };
		$.ajax({
			url: wp_ajax.ajax_url,
			data:data,
			type: 'post',
			beforeSend:function(data){ // Are not working with dataType:'jsonp'
		      $('#loading').show();
		      $('.js-filter').hide();
		    },
			success: function(result){
				$('.js-filter').html(result);
				openPopupClick();
				loadMoreClick();
			},
			complete: function(xhr){
                $('#loading').hide();
                $('.js-filter').show();
            },
			error: function(result){
				console.log(result);
			}
		});
	});
	/*searching*/
	$(document).on('keyup','.search-wrapper #keyword',function(e){
		e.preventDefault();
		var data = {
            'action': 'data_fetch',
            'keyword': jQuery('#keyword').val() 
        };
		jQuery.ajax({
	        url: wp_ajax.ajax_url,
	        type: 'post',
	        data:data,
	        success: function(data) {
	            jQuery('.js-filter').html( data );
	            openPopupClick();
	        },
	        error: function(result){
				console.log(result);
			}
	    });
	})
	openPopupClick();
	function openPopupClick(){
		$('.openpopup').on('click', function(e){
			// e.preventDefault();var id = $(this).next('input').val();
			console.log("id----"+id)
			openpopup(id);
		});
	}
	function openpopup(id){
		$.ajax({
			url: wp_ajax.ajax_url,
			data: {
				action:'videopopup',
				id: id,
			},
			type: 'post',
			success: function(result){
		    	$('#load').show();
				$('#pvideo').html(result);
			},
			complete: function(xhr){
	            $('#load').hide();
	        },
			error: function(result){
				console.log(result);
			}
		})
	}


	loadMoreClick();
    function loadMoreClick(){
    	$('.btn-load-more').click(function(e) {
	        e.preventDefault();
	        var button = $(this);
	        category = $(this).data('category');
	        console.log('category===='+category);
	        loadMore(button,category);

	    });
    }	
	function loadMore(button,category){
		// var category = $('this').data('category');var data = {
            'action': 'loadmore',
            'limit': limit,
            'page': page,
            'type': type,
            'category': category
        };
		$.ajax({
            url: wp_ajax.ajax_url,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text('Loading...'); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                if (data) {
					$(data).insertBefore('.load_more');
                    page++;
                    button.text('More Articles');
                    if (page == max_pages_latest)
                        button.remove(); // if last page, remove the button
                } else {
                    button.remove(); // if no data, remove the button as well
                }
            }
        });
	}

	
})( jQuery );
$(document).ready(function(){
	$(".btn-new-cat").click(function(){
		$(".btn-edit-cat").hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
		var description = $("#description").val();
    var parentId = $("#parent_id").val();
    var thumbnail = $("#thumbnail").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
            var url_post = $('input[name="cat_post"]').val();
            $.ajax({
                url: url_post,
                data: {
                  '_token' 		: token,
                  'name' 		   : name,
                  'thumbnail' : thumbnail,
                  'parent_id' : parentId,
                  'description' : description,
                  'slug' 		   : slug
                },
                type: 'post',
                success: function(res) {
                	
                  if(res){
                  	var data = $.parseJSON(res);
                  	$("#name").val('');
                  	$("#slug").val('');
                  	$("#description").val('');
                    $("#parent_id").val('');
                    $("#thumbnail").val('');
                    var imgSrc = $("#product_cat_thumbnail img").attr('src');
                    var defaultSrc = $("#product_cat_thumbnail img").data('src');
                    $("#product_cat_thumbnail img").attr('src', defaultSrc);
                  	var id = data.id;
                  	var xhtml = '';
                  	xhtml += '<tr class="cat-item cat-'+id+'">';
  					xhtml +=	'<th>';
  					xhtml +=	'<div class="custom-control custom-checkbox">';
  					xhtml +=		'<input class="custom-control-input" type="checkbox" id="cat-'+id+'" value="'+id+'">';
  					xhtml +=		'<label for="cat-'+id+'" class="custom-control-label"></label>';					      	
  		            xhtml +=    '</div>';          
  		            xhtml +=    '</th>';          
  		            xhtml +=    '<td class="cat-thumbnail"><img src="'+imgSrc+'"></td>';  
                  xhtml +=    '<td class="cat-name" data-id="'+id+'">'+data.name+'</td>';  
  		            xhtml +=    '<td class="cat-des">'+data.description+'</td>';         
  		            xhtml +=    '<td class="cat-slug">'+data.slug+'</td>';          
  		            xhtml +=    '<td>0</td>';          
  		            xhtml += '</tr>';  

  		            $("#cat-list").append(xhtml);    
  		                          
                  	$.notify("Created successfully", "success");
                  }else{
                  	$.notify("An error occurred, please try again", "error");
                  }
                  
                }
            });
		}else{
			$("#name").addClass('is-invalid');
		}
	});

	$(document).on('click', '#all-cat', function(){
		if($("#all-cat:checkbox:checked").length > 0){
			$(".cat-item :checkbox").prop('checked', true);
		}else{
			$(".cat-item :checkbox").prop('checked', false);
		}
	});

	$(document).on('click', '.btn-apply', function(){
		var action = $(".select-action").val();
		if(action == 'delete'){
			var items = $(".cat-item :checkbox:checked");
			var ids = [];
			$.each(items, function(index, item){
				let value = $(this).val();
				ids.push(value);
			});
      
			var token = $('input[name="_token"]').val();
      var cat_destroy = $('input[name="cat_destroy"]').val();
      $.ajax({
          url: cat_destroy,
          data: {
            '_token' 		: token,
            'name' 		: name,
            'ids' 		: ids
          },
          type: 'post',
          success: function(res) {
            if(res){
            	$(".select-action").val('');
      		$.each(ids, function(index, id){
      			$(".cat-item.cat-" + id).hide(200).remove();
      		});
            	$.notify("Deleted successfully", "success");
            }else{
            	$.notify("An error occurred, please try again", "error");
            }
            
          }
      });
		}
	});

	$(document).on('click', '#cat-list .edit', function(){
		var id = $(this).parents('.cat-name').data('id');
    var parentID = $(this).parents('.cat-name').data('parentid');
		var name = $(this).parents('.cat-name').find('span:first').text();
		var slug = $(".cat-" + id + ' .cat-slug').text();
		var des = $(".cat-" + id + ' .cat-des').text();
    var imgSrc = $(".cat-" + id + ' .cat-thumbnail img').attr('src');


		$("#name").val(name);
  	$("#slug").val(slug);
  	$("#description").val(des);
  	$("#id_cat").val(id);
    $("#product_cat_thumbnail img").attr('src', imgSrc);
    $('#parent_id').val(parentID);
    $("#parent_id").attr('disabled', 'disabled');
  	$(".btn-edit-cat").show();

	});

	$(document).on('click', '.btn-edit-cat', function(){
		$(this).hide();
    var name = $("#name").val();
    var slug = $("#slug").val();
    var description = $("#description").val();
    var parentId = $("#parent_id").val();
    var thumbnail = $("#thumbnail").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
      var url_update = $('input[name="cat_update"]').val();
      var id = $('#id_cat').val();
            $.ajax({
                url: url_update,
                data: {
                  '_token'    : token,
                  'name'       : name,
                  'thumbnail' : thumbnail,
                  'parent_id' : parentId,
                  'description' : description,
                  'slug'       : slug,
                  'id' 			: id
                },
                type: 'post',
                success: function(res) {
                  if(res){
                    var imgSrc = $("#product_cat_thumbnail img").attr('src');
                    var defaultSrc = $("#product_cat_thumbnail img").data('src');
                    $("#product_cat_thumbnail img").attr('src', defaultSrc);
                    $(".cat-" + id + " .cat-name span:first").text(name);
                    $(".cat-" + id + " .cat-name").data('parentid', parentId);
                    $(".cat-" + id + ' .cat-slug').text(slug);
                    $(".cat-" + id + ' .cat-des').text(description);
                    $(".cat-" + id + ' .cat-thumbnail img').attr('src', imgSrc);

                    $("#name").val('');
                    $("#slug").val('');
                    $("#description").val('');
                    $("#parent_id").val('');
                    $("#thumbnail").val('');
                    $("#parent_id").removeAttr('disabled');
                  	
                  	$.notify("Update successfully", "success");
                  }else{
                  	$.notify("An error occurred, please try again", "error");
                  }
                  
                }
            });
		}else{
			$("#name").addClass('is-invalid');
		}
	});

	$(document).on('keyup click', '.keyword, .btn-search', function(){
		var keyword = $(this).val();
		if($.trim(keyword) != ''){
			$.each($("#cat-list .cat-item"), function(index, item){
				let value = $(this).find('.cat-name').text();
				let result = value.search(keyword);
				if(result == '-1'){
					$(this).addClass('hide');
				}
			});
		}else{
			$("#cat-list .cat-item").removeClass('hide');
		}
		
	});
});

$(document).on("click", "#media-img .item-media", function(){
    var id = $(this).data('id');
    var imgSrc = $(this).find('img').attr('src');
    $('input[name="thumbnail"]').val(id);
    $("#product_cat_thumbnail img").attr('src', imgSrc);
    $(".btn-close-media").trigger('click');
    $(this).find('.preview').toggleClass('active');
  });
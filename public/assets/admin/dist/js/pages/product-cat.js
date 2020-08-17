$(document).ready(function(){
	$(".btn-new-cat").click(function(){
		$(".btn-edit-cat").hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
		var description = $("#description").val();
    var parentId = $("#parent_id").val();
    var thumbnail = '';

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
                  	var id = data.id;
                  	var xhtml = '';
                  	xhtml += '<tr class="cat-item cat-'+id+'">';
  					xhtml +=	'<th>';
  					xhtml +=	'<div class="custom-control custom-checkbox">';
  					xhtml +=		'<input class="custom-control-input" type="checkbox" id="cat-'+id+'" value="'+id+'">';
  					xhtml +=		'<label for="cat-'+id+'" class="custom-control-label"></label>';					      	
  		            xhtml +=    '</div>';          
  		            xhtml +=    '</th>';          
  		            xhtml +=    '<td class="cat-thumbnail">'+data.name+'</td>';  
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
      console.log(ids);
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

	$(document).on('click', '.tag-name', function(){
		var id = $(this).data('id');
		var name = $(this).text();
		var slug = $(".tag-" + id + ' .tag-slug').text();
		var des = $(".tag-" + id + ' .tag-des').text();
		
		$("#name").val(name);
      	$("#slug").val(slug);
      	$("#description").val(des);
      	$("#id_tag").val(id);

      	$(".btn-edit-tag").show();
	});

	$(document).on('click', '.btn-edit-tag', function(){
		var name = $("#name").val();
		var slug = $("#slug").val();
		var description = $("#description").val();
		var id = $("#id_tag").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
            var url_update = $('input[name="tag_update"]').val();
            $.ajax({
                url: url_update,
                data: {
                  '_token' 		: token,
                  'name' 		: name,
                  'description' : description,
                  'id' 			: id,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                	
                  if(res){
                  	$(".tag-" + id + ' .tag-name').text(name);
                  	$(".tag-" + id + ' .tag-slug').text(slug);
					$(".tag-" + id + ' .tag-des').text(description);

                  	$("#name").val('');
                  	$("#slug").val('');
                  	$("#description").val('');
                  	$("#id_tag").val('');
                  	
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
$(document).ready(function(){
	$(".btn-new-tag").click(function(){
		$(".btn-edit-tag").hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
		var description = $("#description").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
            var url_post = $('input[name="tag_post"]').val();
            $.ajax({
                url: url_post,
                data: {
                  '_token' 		: token,
                  'name' 		: name,
                  'description' : description,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                	
                  if(res){
                  	var data = $.parseJSON(res);
                  	$("#name").val('');
                  	$("#slug").val('');
                  	$("#description").val('');
                  	var id = data.id;
                  	var xhtml = '';
                  	xhtml += '<tr class="tag-item tag-'+id+'">';
  					xhtml +=	'<th>';
  					xhtml +=	'<div class="custom-control custom-checkbox">';
  					xhtml +=		'<input class="custom-control-input" type="checkbox" id="tag-'+id+'" value="'+id+'">';
  					xhtml +=		'<label for="tag-'+id+'" class="custom-control-label"></label>';					      	
  		            xhtml +=    '</div>';          
  		            xhtml +=    '</th>';          
  		            xhtml +=    '<td class="tag-name" data-id="'+id+'">'+data.name+'</td>';  
  		            xhtml +=    '<td class="tag-des">'+data.description+'</td>';         
  		            xhtml +=    '<td class="tag-slug">'+data.slug+'</td>';          
  		            xhtml +=    '<td>0</td>';          
  		            xhtml += '</tr>';  

  		            $("#tag-list").append(xhtml);    
  		                          
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

	$(document).on('click', '#all-tag', function(){
		if($("#all-tag:checkbox:checked").length > 0){
			$(".tag-item :checkbox").prop('checked', true);
		}else{
			$(".tag-item :checkbox").prop('checked', false);
		}
	});

	$(document).on('click', '.btn-apply', function(){
		var action = $(".select-action").val();
		if(action == 'delete'){
			var items = $(".tag-item :checkbox:checked");
			var ids = [];
			$.each(items, function(index, item){
				let value = $(this).val();
				ids.push(value);
			});

			var token = $('input[name="_token"]').val();
            var tag_destroy = $('input[name="tag_destroy"]').val();
            $.ajax({
                url: tag_destroy,
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
            			$(".tag-item.tag-" + id).hide(200).remove();
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
			$.each($("#tag-list .tag-item"), function(index, item){
				let value = $(this).find('.tag-name').text();
				let result = value.search(keyword);
				if(result == '-1'){
					$(this).addClass('hide');
				}
			});
		}else{
			$("#tag-list .tag-item").removeClass('hide');
		}
		
	});
});
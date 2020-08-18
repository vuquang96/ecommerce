$(document).ready(function(){
	$(".btn-new-attr").click(function(){
    $(".btn-edit-attr").hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
    var order = $("#order").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
      var router_detail = $('input[name="router_detail"]').val();
      var url_post = $('input[name="attr_post"]').val();
            $.ajax({
                url: url_post,
                data: {
                  '_token' 	: token,
                  'name' 		: name,
                  'order'   : order,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                  if(res){
                  	var data = $.parseJSON(res);
                  	$("#name").val('');
                  	$("#slug").val('');
                  	$("#order").val('');
                  	var id = data.id;
                  	var xhtml = '';
                    var href = router_detail.replace('9999', id.toString());
                  	xhtml += '<tr class="attr-item attr-'+id+'">';
    		            xhtml +=    '<td class="attr-name" data-id="'+id+'"><a href="'+href+'">';
                    xhtml +=      data.name;
                    xhtml +=      '<div class="row-actions">';
                    xhtml +=        '<span class="edit" data-id="'+id+'">Edit</span>';
                    xhtml +=      '</div>';
                    xhtml +=    '</a></td>';  
    		            xhtml +=    '<td class="attr-slug">'+data.slug+'</td>';         
    		            xhtml +=    '<td class="attr-order">'+data.order+'</td>';           
    		            xhtml +=    '<td class="attr-term"></td>';          
    		            xhtml += '</tr>';  

  		            $("#attr-list").append(xhtml);    
  		                          
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


	$(document).on('click', '.edit', function(){
		var id = $(this).data('id');
		var name = $(".attr-" + id + ' .attr-name a').text();
		var slug = $(".attr-" + id + ' .attr-slug').text();
		var order = $(".attr-" + id + ' .attr-order').text();

		$("#name").val($.trim(name));
  	$("#slug").val($.trim(slug));
  	$("#order").val($.trim(order));
  	$("#id_attr").val(id);

  	$(".btn-edit-attr").show();
	});

	$(document).on('click', '.btn-edit-attr', function(){
    $(this).hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
		var order = $("#order").val();
		var id = $("#id_attr").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
            var url_update = $('input[name="attr_update"]').val();
            $.ajax({
                url: url_update,
                data: {
                  '_token' 	: token,
                  'name' 		: name,
                  'order'   : order,
                  'id' 			: id,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                  if(res){
                    $(".attr-" + id + ' .attr-name a').text(name);
                    $(".attr-" + id + ' .attr-slug').text(slug);
                    $(".attr-" + id + ' .attr-order').text(order);

                  	$("#name").val('');
                    $("#slug").val('');
                    $("#order").val('');
                  	$("#id_attr").val('');
                  	
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

});
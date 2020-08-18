$(document).ready(function(){
	$(".btn-new-term").click(function(){
    $(".btn-edit-term").hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
    var order = $("#order").val();
    var description = $("#description").val();
    var parent_id = $("input[name='parent_id']").val();
    var type = $("input[name='type']").val();
    

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
                  'order'    : order,
                  'type'    : type,
                  'parent_id'    : parent_id,
                  'description'   : description,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                  if(res){
                  	var data = $.parseJSON(res);
                  	$("#name").val('');
                  	$("#slug").val('');
                    $("#description").val('');
                  	$("#order").val('');
                  	var id = data.id;
                  	var xhtml = '';
                  	xhtml += '<tr class="term-item term-'+id+'">';
    		            xhtml +=    '<td class="term-name" data-id="'+id+'">';
                    xhtml +=      data.name;
                    xhtml +=    '</td>';  
    		            xhtml +=    '<td class="term-des">'+data.description+'</td>';         
                    xhtml +=    '<td class="term-slug">'+data.slug+'</td>';         
    		            xhtml +=    '<td class="term-order">'+data.order+'</td>';           
    		            xhtml +=    '<td class="term-count">0</td>';          
    		            xhtml += '</tr>';  

  		            $("#term-list").append(xhtml);    
  		                          
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


	$(document).on('click', '.term-name', function(){
		var id = $(this).data('id');
		var name = $(".term-" + id + ' .term-name').text();
		var slug = $(".term-" + id + ' .term-slug').text();
		var order = $(".term-" + id + ' .term-order').text();
    var description = $(".term-" + id + ' .term-des').text();

    var parent_id = $("input[name='parent_id']").val();
    var type = $("input[name='type']").val();

		$("#name").val($.trim(name));
  	$("#slug").val($.trim(slug));
  	$("#order").val($.trim(order));
    $("#description").val($.trim(description));
  	$("#id_term").val(id);

  	$(".btn-edit-term").show();
	});

	$(document).on('click', '.btn-edit-term', function(){
    $(this).hide();
		var name = $("#name").val();
		var slug = $("#slug").val();
		var order = $("#order").val();
    var description = $("#description").val();
		var id = $("#id_term").val();

		if($.trim(name) != ''){
			$("#name").removeClass('is-invalid');

			var token = $('input[name="_token"]').val();
            var url_update = $('input[name="term_update"]').val();
            $.ajax({
                url: url_update,
                data: {
                  '_token' 	: token,
                  'name' 		: name,
                  'order'   : order,
                  'description'   : description,
                  'id' 			: id,
                  'slug' 		: slug
                },
                type: 'post',
                success: function(res) {
                  if(res){
                    $(".term-" + id + ' .term-name').text(name);
                    $(".term-" + id + ' .term-slug').text(slug);
                    $(".term-" + id + ' .term-order').text(order);
                    $(".term-" + id + ' .term-des').text(description);

                  	$("#name").val('');
                    $("#slug").val('');
                    $("#order").val('');
                    $("#description").val('');
                  	$("#id_term").val('');
                  	
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
  $(function() {
      $("#media-img").sortable({
          stop: function(event, ui) {
            var id = $(ui.item).data('id');
            var oldItemIndex = ui.item.index() + 1;
            var order = $("#media-img .item:eq("+ oldItemIndex +")").data('order');
            var idOldItem = $("#media-img .item:eq("+ oldItemIndex +")").data('id');
            var token = $('input[name="_token"]').val();
            var url_update = $('input[name="media_update"]').val();
            $.ajax({
                url: url_update,
                data: {
                  '_token' : token,
                  'order' : order,
                  'idOldItem' : idOldItem,
                  'id' : id
                },
                type: 'post',
                success: function(res) {
                  $(ui.item).data('order', order);
                  
                }
            });

          }
      });
      $("#media-img").disableSelection();

      $(".file-upload-btn").click(function() {
          $('.file-upload-input').trigger('click');
      });

      $(document).on('change', '.file-upload-input', function() {
          var file_data = $('.file-upload-input').prop('files')[0];
          //lấy ra kiểu file
          var type = file_data.type;
          //Xét kiểu file được upload
          var match = ["image/jpeg", "image/png", "image/jpg"];
          if (type == match[0] || type == match[1] || type == match[2]) {
              //khởi tạo đối tượng form data
              var form_data = new FormData();
              //thêm files vào trong form data
              form_data.append('file', file_data);
              var token = $('input[name="_token"]').val();
              var url_post = $('input[name="media_post"]').val();
              form_data.append('_token', token);
              //sử dụng ajax post
              $.ajax({
                  url: url_post,
                  dataType: 'text',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(res) {
                    var data = $.parseJSON(res);
                    if(data['status'] == 1){
                      var id = data['id'];
                      var xhtml = '<li class="item item-'+id+'" data-id="'+id+'">';
                          xhtml += '<div class="preview">';
                          xhtml +=  '<img src="'+data['guid']+'">';
                          xhtml += '</div>';
                          xhtml += '<i class="fas fa-times-circle"></i>';
                          xhtml += '</li>';
                          $("#media-img").prepend(xhtml);
                          $.notify("photo upload is successful", "success");
                      } else {
                          $.notify("Error, please try again", 'error')
                      }
                  }
              });
          } else {
              $.notify("File format not supported", "error");
          }
      });

   

    $(document).on('click', "#media-img .item i", function(){
      var itemID = $(this).parent('.item').data('id');

      var token = $('input[name="_token"]').val();
      var url_destroy = $('input[name="media_destroy"]').val();

      $.ajax({
          url: url_destroy,
          data: {
            '_token' : token,
            'id' : itemID
          },
          type: 'post',
          success: function(res) {
            if(res == "1"){
              $("#media-img .item-" + itemID).hide(200);
            }else{
              $.notify("Error, please try again", 'error')
            }
          }
      });
    }); 

    $(".btn-new").click(function(){
      $(".file-upload").toggle(200);
    }); 



    $(window).on('scroll', function () {
        var page = $('input[name="page"]').val();
        if ($("#media-img").hasClass('loading') || !page) {
            return;
        }
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var loaderPositionTop = $("#media-img").offset().top;
        
      //  if($(window).scrollTop() >= $(document).height() - $(window).height()) {
        if($(window).scrollTop() + 200 <= $(document).height() ) {
          $("#media-img").addClass('loading');
            var token = $('input[name="_token"]').val();
            var url_loadmore = $('input[name="media_loadmore"]').val();
            var assetLink = $('input[name="asset_link"]').val();

            $.ajax({
                url: url_loadmore,
                data: {
                  '_token' : token,
                  'page' : parseInt(page) + 1
                },
                type: 'post',
                success: function(res) {
                  var data = $.parseJSON(res);
                  
                  if(data.length > 0){
                    var xhtml = '';
                    $.each(data, function(index, item){
                      let id = item.id;
                      let srcImg = assetLink + item.guid;
                      xhtml = '<li class="item item-'+id+'" data-id="'+id+'">';
                      xhtml += '<div class="preview">';
                      xhtml +=  '<img src="'+srcImg+'">';
                      xhtml += '</div>';
                      xhtml += '<i class="fas fa-times-circle"></i>';
                      xhtml += '</li>';
                    });
                    $("#media-img").append(xhtml);
                    $('input[name="page"]').val(parseInt(page) + 1);
                    $("#media-img").removeClass('loading')
                  }else{
                    $('input[name="page"]').val(0);
                  }
                }
            });
        }

    });

  });



  function readURL(input) {
      if (input.files && input.files[0]) {

          var reader = new FileReader();

          reader.onload = function(e) {
              $('.image-upload-wrap').hide();

              $('.file-upload-image').attr('src', e.target.result);
              $('.file-upload-content').show();

              $('.image-title').html(input.files[0].name);
          };

          reader.readAsDataURL(input.files[0]);

      } else {
          removeUpload();
      }
  }

  function removeUpload() {
      $('.file-upload-input').replaceWith($('.file-upload-input').clone());
      $('.file-upload-content').hide();
      $('.image-upload-wrap').show();
  }
  $('.image-upload-wrap').bind('dragover', function() {
      $('.image-upload-wrap').addClass('image-dropping');
  });
  $('.image-upload-wrap').bind('dragleave', function() {
      $('.image-upload-wrap').removeClass('image-dropping');
  });
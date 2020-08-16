$(".modal-media").on('scroll', function () {
      var page = $('#media-img').data('page');
      
      if ($("#media-img").hasClass('loading') || !page ) {
          return;
      }
     
      if($('.modal-media').scrollTop() <= $('.modal-media .modal-lg').height() ) {

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
                console.log(data);
                if(data.length > 0){
                  var xhtml = '';
                  $.each(data, function(index, item){
                    let id = item.id;
                    let srcImg = assetLink + item.guid;
           
                    xhtml = '<div data-id="'+id+'" class="col-sm-3 col-lg-2 item-media item-'+id+'">';
                    xhtml += '<div class="preview">';
                    xhtml +=  '<img src="'+srcImg+'">';
                    xhtml += '</div>';
                    xhtml += '</div>';
                  });
                  $("#media-img").append(xhtml);
                  $('#media-img').data('page', parseInt(page) + 1);
                  $("#media-img").removeClass('loading')
                }else{
                  $('#media-img').data('page', '0');
                }
              }
          });
      }
});
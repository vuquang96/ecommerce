$(document).ready(function(){

	$('.product-tag').select2();

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

  $(document).on("click", "#media-img .item-media", function(){
    var id = $(this).data('id');
    var imgSrc = $(this).find('img').attr('src');

    if($(".btn-image-gallery").hasClass('active')){
      var productGallery = $('input[name="product_gallery"]').val();
      productGallery = productGallery.split(',');
      productGallery.push(id);
      productGallery = productGallery.filter(function (el) {
        return el != '';
      });

      productGallery = productGallery.join();
      $('input[name="product_gallery"]').val(productGallery);

      var xhtml = '<div class="col-md-4 item-media" data-id="'+id+'">';
          xhtml += '<div class="preview">';
          xhtml +=  '<img src="'+imgSrc+'">';
          xhtml += '</div>';
          xhtml += '<i class="fas fa-times-circle"></i>';
          xhtml += '</div>';
      $(".product-gallery").append(xhtml);
    }else if($(".btn-image-large").hasClass('active')){
      $('input[name="product_large"]').val(id);
      
      var xhtml = '<div class="col-md-12 item-media">';
          xhtml += '<div class="preview">';
          xhtml +=  '<img src="'+imgSrc+'">';
          xhtml += '</div>';
          xhtml += '<i class="fas fa-times-circle"></i>';
          xhtml += '</div>';
      $(".product-large").html(xhtml);
      $(".btn-close-media").trigger('click');
    }
    
    $(this).hide(200);
  });

  $(document).on('click', ".product-gallery .item-media i", function(){
    var id = $(this).parent('.item-media').data('id');
    var productGallery = $('input[name="product_gallery"]').val();
    productGallery = productGallery.split(',');
    productGallery = productGallery.filter(function (el) {
      return el != id;
    });
    productGallery = productGallery.join();
    $('input[name="product_gallery"]').val(productGallery);
    $(this).parent('.item-media').hide(200);
  }); 

  $(document).on('click', ".product-large .item-media i", function(){
    $('input[name="product_large"]').val('');
    $(this).parent('.item-media').hide(200);
  }); 

  $(document).on('click', '.btn-media', function(){
    $(".btn-media").removeClass('active');
      $(this).addClass('active');
  });

});

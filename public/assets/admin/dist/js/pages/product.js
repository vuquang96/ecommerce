$(document).ready(function(){

	$('.product-tag').select2();

	$(".btn-media").click(function(){
    $(".modal-media .item-media").removeClass('active');
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
    
    $(this).find('.preview').toggleClass('active');
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

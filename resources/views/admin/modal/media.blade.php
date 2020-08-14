<div class="modal fade modal-media " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="container-fluid">
      <div class="modal-content">
        <div class="row">
          <div class="file-upload">
            <button class="file-upload-btn" type="button">Add Image</button>
            <div class="image-upload-wrap">
              <input class="file-upload-input" type='file' />
              <div class="drag-text">
                <h3>Drag and drop a file or select add Image</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="media-img" data-page='1'>
          @foreach($mediaList as $item)
            <!-- <div class="col-sm-3 col-lg-2 item-media"> -->
            <div class="col-sm-3 col-lg-2 item-media item-{{ $item->id }}" data-id={{$item->id}}>
              <div class="preview">
                <img data-id="{{ $item->id }}" src="{{ asset($item->guid ) }}">
              </div>
            </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-close-media" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
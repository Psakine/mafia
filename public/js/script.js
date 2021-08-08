$(document).ready(function() {
  // $('#create-game-form select').each(function(i, e) {
  //   $(e).val('');
  // });
  $('#inputPhoto').on('change', function() {
    var formData = new FormData();
    formData.append('file', $(this)[0].files[0]);
    $.ajax({
      url         : '/api/file/upload',
      type        : 'POST',
      data        : formData,
      async       : false,
      cache       : false,
      contentType : false,
      enctype     : 'multipart/form-data',
      processData : false,
      headers     : false,
      success     : function(response) {
        let data = JSON.parse(response);
        let photo_src = $('#photo_src');
        let delete_photo = $('#delete-photo');
        if (!delete_photo) {
          $('form').append('<button class="btn btn-primary my-1" id="delete-photo" type="button">Удалить фото</button>');
        }
        $('#photo').attr('src', data.src);
        if (photo_src) {
          photo_src.val(data.src);
        }
      }
    });
  })

  $(document).on('click', '#delete-photo', function() {
    var photo = $('#photo').attr('src');
    $.ajax({
      url     : '/api/file/delete',
      type    : 'POST',
      data    : {src : photo},
      success : function() {
        let photo_src = $('#photo_src');
        $('#delete-photo').remove();
        $('#inputPhoto').val('');
        $('#photo').attr('src', null);
        if (photo_src) {
          photo_src.val(data.src);
        }
      }
    });
  });
});
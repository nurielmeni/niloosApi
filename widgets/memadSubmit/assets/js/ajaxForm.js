$(document).on('beforeSubmit', '#ajax-form-modal form', beforeSubmitHandler);  
$(document).on('change', '#applyform-cvfile', function() {
    if (this.files.length) {
        $('.drag-file-area').css('background-color', '#eafff2');
    } else {
        $('.drag-file-area').css('background-color', 'transparent');
    }
});

function beforeSubmitHandler() {
  var $yiiform = $(this);
  var $modal = $yiiform.parents('.modal');
  var $content = $('#ajax-form-modal .modal-content');
  var formData = new FormData($yiiform[0]);
  
  $.ajax(
    {
      type: $yiiform.attr('method'),
      url: $yiiform.attr('action'),
      data: formData,
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    }
  ).done(function(data) {
    // success actions
    $content.html(data);
    //setTimeout(function() { $modal.modal('hide'); },5000);
    //$yiiform.enableSubmitButtons(); // enable the submit buttons
  }).fail(function(err) {
    $content.html(err);
    //setTimeout(function() { $modal.modal('hide'); },5000);
  });

  return false; // prevent default form submission    
}

function dropHandler(ev) {
  console.log('File(s) dropped');
  var fileInput = document.getElementById('applyform-cvfile');

  // Prevent default behavior (Prevent file from being opened)
  ev.preventDefault();

  if (ev.dataTransfer.files) {

    fileInput.files = ev.dataTransfer.files;
    $('#applyform-cvfile').change();
  }
}

function dragOverHandler(ev) {
  console.log('File(s) in drop zone'); 

  // Prevent default behavior (Prevent file from being opened)
  ev.preventDefault();
}
<form enctype="multipart/form-data">
  <div class="form-group">
      <div class="text-center">
          <img id="tempprofile" src="<?=Yii::$app->urlManager->createUrl('assets/icons/user.png') ?>" height="140px" width="140px" class="img-circle"
                                                 alt="User Image"/>
          <p class="text-danger">
              NOTE : Upload only JPG, JPEG and PNG images and smaller than 300KB
          </p>
              <input type="file" class="form-control-file" id="fileid">

      </div>
      
     
      <div class="pull-right">
                <button type="submit" class="btn btn-primary" id="updatebtn">UPDATE </button>

      </div>
      <br>
  </div>
</form>

<?php
$this->registerJs(
        "
$(function(){



    // Variable to store your files
    var files;

    // Add events
    $('input[type=file]').on('change', prepareUpload);

    // Grab the files and set them to our variable
    function prepareUpload(event)
    {
   
      files = event.target.files;
    }
    

$('form').on('submit', uploadFiles);


// Catch the form submit and upload the files
function uploadFiles(event)
{
  event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value)
    {
        data.append(key, value);
    });

    $.ajax({
        url: 'submit.php?files',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(data, textStatus, jqXHR)
        {
            if(typeof data.error === 'undefined')
            {
                // Success so call function to process the form
                submitForm(event, data);
            }
            else
            {
                // Handle errors here
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            // Handle errors here
            console.log('ERRORS: ' + textStatus);
            // STOP LOADING SPINNER
        }
    });
}


















//    //gets the click event
//    $('#updatebtn').click(function(){
//        if ( uploader.files && uploader.files[0] ){
//                  $('#profileImage').attr('src', 
//                     window.URL.createObjectURL(uploader.files[0]) );
//            }
//
//        
//              
//    });
});

");
?>
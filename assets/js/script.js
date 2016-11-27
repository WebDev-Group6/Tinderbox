jQuery(document).ready(function (e) {
 jQuery('#form').on('submit',(function(e) {
  e.preventDefault();
  jQuery.ajax({
    url: 'http://localhost:8888/profile/upload_image',
    type: 'POST',
    data:  new FormData(this),
    contentType: false,
    cache: false,
    processData:false,
    beforeSend : function()
   {
    //$("#preview").fadeOut();
    jQuery('#err').fadeOut();
   },
   success: function(data)
      {
    if(data =='invalid file')
    {
     // invalid file format.
     jQuery('#err').html('Invalid File !').fadeIn();
    }
    else
    {
     // view uploaded file.
     jQuery('#preview').html(data);
     jQuery('#form')[0].reset(); 
     console.log('Success');
    }
      },
     error: function(e) 
      {
    jQuery('#err').html(e).fadeIn();
      }          
    });
 }));
});
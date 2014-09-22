jQuery(document).ready(function($){
   
   $('.ff-images-selection-div').on('change', '.ff-image-select-category', function(event) {
      var category = $(this).val();
      var id = $(this).attr("data-id");
      var filename = $(this).attr("data-fn");
     $.post(
       // see tip #1 for how we declare global javascript variables
       MyAjax.ajaxurl,
       {
           // here we declare the parameters to send along with the request
           // this means the following action hooks will be fired:
           // wp_ajax_nopriv_myajax-submit and wp_ajax_myajax-submit
           action : 'ff_get_images_options',
           wpnonce: MyAjax.wpnonce,
           category: category,
           filename: filename
       },
       function( response ) {
         var object = JSON.parse(response);
         if(object.success) {
            $('#' + id).html('<select id="ff-image-select-' + id + '">' + object.opts + '</select>');
            $('#ff-image-select-' + id).imagepicker();
         } else {
            $('#' + id).html("There was an error retreiving images. Sorry.");
         }
       }
      );
   });


});

function ff_close_tb(instance_setting, id) {
(function($) {
      var src = $('#ff-image-select-' + id).val();
      var api = wp.customize;
      mysetting = api.instance(instance_setting);
      mysetting.set(src);
      tb_remove();

   }) (jQuery)
}
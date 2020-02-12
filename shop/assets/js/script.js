$(document).ready(function(){

    // image upload 
    $('.uploadImage').hide();
    
    $('.close-me').click(function(){

        $('.uploadImage').fadeOut();
    
    });
    
    $('.show-imageupload').click(function(){
    
        $('.uploadImage').fadeIn();
    
    });

});

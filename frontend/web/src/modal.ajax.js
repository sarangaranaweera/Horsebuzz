$(function(){
//load the current page with the conten indicated by 'value' attribute for a given button.
    $(modalButton).on('click', '.loadMainContent', function(){
        $('#main-content').load($(this).attr('value'));
    });
});
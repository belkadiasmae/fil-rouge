$(function()
{
    'use strict';
    $('#login-page h1 span').click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');

        $('#login-page form').hide();

        $('.' + $(this).data('class')).fadeIn(100);
    });
    //hide placeholder in form focus

    $('[placeholder]').focus(function(){
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder','');

    }).blur(function(){
        $(this).attr('placeholder', $(this).attr('data-text'));
    })

    $('.confirm').click(function(){

        return confirm('Are You Sure?');

    });
})
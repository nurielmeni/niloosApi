/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function() {
    $('.social-share .social-toggle').click(function(){
        var $button = $(this);
        $(this).css('z-index', -1).siblings('.outer').animate({
            width: 'toggle'
        }, {
            duration: 400,
            easing: 'linear',
            complete: function() { $button.css('z-index', 10); }
        });
    });
    
    $('.social-share .inner img').on('click', function() {
        var url = $(this).data('url');
        window.open(url,'_blank');
    });
});
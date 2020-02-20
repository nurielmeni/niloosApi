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

/*
 * $(document).ready(function() {
    if (navigator.share) {
        const shareData = {
            title: 'MEMAD3',
            text: 'Find you next job!',
            url: 'https://memad3.hunterhrms.com',
        }
        
        const btn = document.querySelector('.social-share .social-toggle');
        const resultPara = document.querySelector('.result');

        // Must be triggered some kind of "user activation"
        btn.addEventListener('click', async () => {
            try {
              await navigator.share(shareData)
            } catch(err) {
              console.log('Error: ' + e);
            }
            console.log('MEMAD3 shared successfully');
        });
    } else {
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
    }

});
 */
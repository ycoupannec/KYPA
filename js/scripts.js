// RIPPLE EFFECT

              $(window, document, undefined).ready(function() {

                    $('input').blur(function() {
                        var $this = $(this);
                        if ($this.val())
                            $this.addClass('used');
                        else
                            $this.removeClass('used');
                    });

                    var $ripples = $('.ripples');

                    $ripples.on('click.Ripples', function(e) {

                        var $this = $(this);
                        var $offset = $this.parent().offset();
                        var $circle = $this.find('.ripplesCircle');

                        var x = e.pageX - $offset.left;
                        var y = e.pageY - $offset.top;

                        $circle.css({
                            top: y + 'px',
                            left: x + 'px'
                        });

                        $this.addClass('is-active');

                    });

                    $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
                        $(this).removeClass('is-active');
                    });

                });


// Scroll DOWN
$(document).ready(function(){
$('a[href^="#"]').on('click',function (e) {
    e.preventDefault();

    var target = this.hash;
    var $target = $(target);

    $('html, body').stop().animate({
        'scrollTop': $target.offset().top
    }, 900, 'swing', function () {
        window.location.hash = target;
    });
});
});
// Fin Scroll Down

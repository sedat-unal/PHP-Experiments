<!-- JS FILES -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/salvattore.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/panel.js"></script>
<script src="assets/js/reading-position-indicator.js"></script>
<script src="assets/js/custom.js"></script>
<!-- POST SLIDER -->
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#eskimo-post-slider').slick({
                autoplay: true,
                autoplaySpeed: 5000,
                slidesToScroll: 1,
                adaptiveHeight: true,
                slidesToShow: 1,
                arrows: true,
                dots: false,
                fade: true
            });
        });
        $(window).on('load', function() {
            $('#eskimo-post-slider').css('opacity', '1');
            $('#eskimo-post-slider').parent().removeClass('eskimo-bg-loader');
        });
    })(jQuery);
</script>
<!-- POST CAROUSEL -->
<script>
    (function($) {
        "use strict";
        $(document).ready(function() {
            $('#eskimo-post-carousel').slick({
                infinite: false,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                slidesToShow: 3,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                }, {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }]

            });
            $('#eskimo-post-carousel').css('opacity', '1');
        });
    })(jQuery);
</script>
</body>


</html>
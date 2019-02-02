<?php
function sg_homepage_style(){
    if( is_page() ) {
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script>
            var interval = null;
            function buttoncall() {
                //jQuery("html, body").stop();
                //clearInterval(interval);
                //jQuery("html, body").animate('pause');
                jQuery("html, body").stop(true,false);
                var scroll_time=parseInt(jQuery('input#glry_scroll_time').val());
                jQuery('html, body').animate({scrollTop:0}, scroll_time);
                jQuery("#startbtn").css('display','none');
                jQuery("#stopbtn").css('display','block');
                jQuery("#backtotop").css('display','none');
            }
            function stopbuttoncall() {
                jQuery("html, body").stop(true,false);
                clearInterval(interval);
                jQuery("#startbtn").css('display','block');
                jQuery("#stopbtn").css('display','none');
                jQuery("#backtotop").css('display','block');
                //jQuery("html, body").animate('pause');
            }
            function startbuttoncall() {
                //jQuery("html, body").stop();
                //clearInterval(interval);
                var size=jQuery(document).height();
                size=size-1201;
                var scroll_time=parseInt(jQuery('input#glry_scroll_time').val());
                //interval =setInterval(function() { jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, scroll_time,"linear"); }, 2000);
                jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, scroll_time,"linear");
                //clearInterval(interval);
                interval =setInterval(function() { jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, scroll_time,"linear"); }, scroll_time+2000);
                jQuery("#startbtn").css('display','none');
                jQuery("#stopbtn").css('display','block');
            }
            jQuery(document).ready(function() {
                var val=jQuery('input#glry_slide').val();
                if(val=='auto_reload'){
                    var scroll_back_up=jQuery('input#glry_scroll_back_up').val();
                    jQuery(".slideshow-container").append('<button id="startbtn" onclick="startbuttoncall()"> Start &darr; </button><button id="stopbtn" onclick="stopbuttoncall()"> Stop </button>');
                    jQuery("#startbtn").css('display','none');
                    jQuery("#stopbtn").css('display','none');
                    if(scroll_back_up=="yes"){
                        jQuery(".slideshow-container").append('<button id="backtotop" onclick="buttoncall()"> &uarr; </button>');
                        jQuery("#backtotop").css('display','none');
                    }
                    jQuery(window).on('load', function() {

                        jQuery("#backtotop").css({"position" : "fixed","bottom" : "0px","right":"0px"});
                        jQuery("#startbtn").css({"position" : "fixed","bottom" : "0px","right":"80px"});
                        jQuery("#stopbtn").css({"position" : "fixed","bottom" : "0px","right":"80px"});

                        jQuery("#stopbtn").css('display','block');
                        var size=jQuery(document).height();
                        size=size-1501;
                        console.log(size);
                        var scroll_time=parseInt(jQuery('input#glry_scroll_time').val());
                        console.log(scroll_time);
                        jQuery("html, body").animate({ scrollTop: size }, scroll_time,"linear",function(){
                            jQuery("#startbtn").css('display','block');
                            jQuery("#stopbtn").css('display','none');
                        });
                        //interval =setInterval(function() { jQuery("html, body").animate({ scrollTop: jQuery(document).height() }, scroll_time,"linear"); }, scroll_time+2000);
                        console.log(jQuery(document).height());

                    });

                }
            });
            jQuery(window).scroll(function() {

                if (jQuery(this).scrollTop()) {

                    //$('#toTop:hidden').stop(true, true).fadeIn();
                    jQuery("#backtotop").css('display','block');
                } else {

                    jQuery("#backtotop").css('display','none');
                    jQuery("#startbtn").css('display','block');
                    jQuery("#stopbtn").css('display','none');
                    //$('#toTop').stop(true, true).fadeOut();
                }
            });
        </script>
        <?php
    }
}
add_action( 'wp_enqueue_scripts', 'sg_homepage_style' );
// Rs Slider In home-agency-3.html & home-corporate-5.html 
jQuery(document).ready(function() {
    "use strict";
    jQuery("#slider1").revolution({
        sliderType: "standard",
        jsFileLocation: "../assets/revolution/js/",
        sliderLayout: "auto",
        delay: 5000,/* sets the Slider's default timeline */
        disableProgressBar: "on",
        spinner: "spinner0",/* PRELOADER OPTION "0" */ 
        /* basic navigation arrows and bullets */
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            onHoverStop: "on",
            bullets: {
                style: 'uranus',
                enable: true,
                hide_onmobile: false,
                hide_onleave: false,
                hide_delay: 200,
                hide_delay_mobile: 1200,
                hide_under: 0,
                hide_over: 9999,
                direction: "horizontal",
                h_align: "center",
                v_align: "center",
                space: 7,
                h_offset: 0,
                v_offset: 310,
                tmp: '<span class="tp-bullet-inner"></span>',
            },
            arrows: {
                style: "",
                enable: true,
                hide_onmobile: true,
                hide_onleave: false,
                left: {
                    h_align: "left",
                    v_align: "center",
                    h_offset: -8,
                    v_offset: 0
                },
                right: {
                    h_align: "right",
                    v_align: "center",
                    h_offset: -8,
                    v_offset: 0
                }
            }
        },
		responsiveLevels: [1240, 1024, 778, 480],
		gridwidth:[1240, 1024, 778, 320],
        gridheight: [700, 768, 600, 600],

    });
});
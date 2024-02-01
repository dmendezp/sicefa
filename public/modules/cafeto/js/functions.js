/*global jQuery */
/* Contents
// ------------------------------------------------>
	1.  LOADING SCREEN
	2.  BACKGROUND INSERT
	3.	NAV MODULE
	4.  MOBILE MENU
	5.  HEADER AFFIX
	6.  HEADER STATIC
	7.  COUNTER UP
	8.  COUNTDOWN DATE
	9.  AJAX MAILCHIMP
	10. AJAX CAMPAIGN MONITOR 
	11. OWL CAROUSEL
	12. MAGNIFIC POPUP
	13. MAGNIFIC POPUP VIDEO
	14. ROUNDED SKILL
	15. SWITCH GRID
	16. BACK TO TOP
	17. PORTFOLIO FLITER / SHOP FLITER
	18. FOLLOW INSTAGRAM
	19. TWITTER FEED
	20. SCROLL TO
	21. PROGRESS BAR
	22. NAV SPLIT
	23. SLIDER RANGE
	24. COLUMN HEIGHT
	25. AJAX CONTACT FORM
	26. AJAX RESERVATION POPUP FORM
	27. AJAX RESERVATION FORM
*/
(function($) {
    "use strict";
    /* ------------------  LOADING SCREEN ------------------ */

    $(window).on("load", function() {
        $(".preloader").fadeOut(10000);
        $(".preloader").remove();
    });


    /* ------------------  Background INSERT ------------------ */

    var $bgSection = $(".bg-section");
    var $bgPattern = $(".bg-pattern");
    var $colBg = $(".col-bg");

    $bgSection.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("bg-section");
        $(this).remove();
    });

    $bgPattern.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("bg-pattern");
        $(this).remove();
    });

    $colBg.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("col-bg");
        $(this).remove();
    });

    /* ------------------  NAV MODULE  ------------------ */
	
    var $moduleIcon = $(".module-icon"),
        $moduleCancel = $(".module-cancel");
    $moduleIcon.on("click", function(e) {
        $(this).parent().siblings().removeClass('module-active'); // Remove the class .active form any sibiling.
        $(this).parent(".module").toggleClass("module-active"); //Add the class .active to parent .module for this element.
        e.stopPropagation();
    });
    // If Click on [ Search-cancel ] Link
    $moduleCancel.on("click", function(e) {
        $(".module").removeClass("module-active");
        e.stopPropagation();
    });

    $(".side-nav-icon").on("click", function() {
        if ($(this).parent().hasClass('module-active')) {
            //$(".module-hamburger > .hamburger-panel").css;
            $(".wrapper").addClass("hamburger-active");
            $(this).addClass("module-hamburger-close");
        } else {
            //$(".module-hamburger").width(0);
            $(".wrapper").removeClass("hamburger-active");
            $(this).removeClass("module-hamburger-close");
        }

    });
    // If Click on [ Document ] and this click outside [ hamburger panel ]
    $(document).on("click", function(e) {
        if ($(e.target).is(".hamburger-panel,.hamburger-panel .list-links,.hamburger-panel .list-links a,.hamburger-panel .social-share,.hamburger-panel .social-share a i,.hamburger-panel .social-share a,.hamburger-panel .copywright") === false) {
            $(".wrapper").removeClass("page-transform"); // Remove the class .active form .module when click on outside the div.
            $(".module-side-nav").removeClass("module-active");
            e.stopPropagation();
        }
    });

    // If Click on [ Document ] and this click outside [ module ]
    $(document).on("click", function(e) {
        if ($(e.target).is(".module, .module-content, .search-form input,.cart-control .btn,.cart-overview a.cancel,.cart-box") === false) {
            $module.removeClass("module-active"); // Remove the class .active form .module when click on outside the div.
            e.stopPropagation();
        }
    });

    /* ------------------  MOBILE MENU ------------------ */

    var $dropToggle = $("ul.dropdown-menu [data-toggle=dropdown]"),
        $module = $(".module");
    $dropToggle.on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass("open");
        $(this).parent().toggleClass("open");
    });

    $module.on("click", function() {
        $(this).toggleClass("toggle-module");
    });
    $module.find("input.form-control", ".btn", ".module-cancel").on("click", function(e) {
        e.stopPropagation();
    });

    /* ------------------ HEADER AFFIX ------------------ */

    var $navAffix = $(".header-fixed .navbar-fixed-top");
    $navAffix.affix({
        offset: {
            top: 50
        }
    });

    $(window).on("scroll", function() {
        var wScroll = $(window).scrollTop();
        if (wScroll > 100) {
            $('.logo-centered').css('display', 'none');
        } else {
            $('.logo-centered').css('display', 'block');
        }

    });

    /* ------------------ HEADER STATIC ------------------ */

    $(window).on("scroll", function() {
        var wScroll = $(window).scrollTop();
        var heroSlider = $('.rev_slider_wrapper').outerHeight();
        if (wScroll > heroSlider) {

            $('nav').parent('.onepage-header').addClass('navbar-fixed-top');

        } else {
            $('nav').parent('.onepage-header').removeClass('navbar-fixed-top');
        }

    });

    /* ------------------  COUNTER UP ------------------ */

    $(".counting").counterUp({
        delay: 10,
        time: 1000
    });

    /* ------------------ COUNTDOWN DATE ------------------ */

    $(".countdown").each(function() {
        var $countDown = $(this),
            countDate = $countDown.data("count-date"),
            newDate = new Date(countDate);
        $countDown.countdown({
            until: newDate,
            format: "MMMM Do , h:mm:ss a"
        });
    });

    /* ------------------  AJAX MAILCHIMP ------------------ */

    $('.mailchimp').ajaxChimp({
        url: "http://wplly.us5.list-manage.com/subscribe/post?u=91b69df995c1c90e1de2f6497&id=aa0f2ab5fa", //Replace with your own mailchimp Campaigns URL.
        callback: chimpCallback
    });

    function chimpCallback(resp) {
        if (resp.result === 'success') {
            $('.subscribe-alert').html('<h5 class="alert alert-success">' + resp.msg + '</h5>').fadeIn(1000);
            //$('.subscribe-alert').delay(6000).fadeOut();

        } else if (resp.result === 'error') {
            $('.subscribe-alert').html('<h5 class="alert alert-danger">' + resp.msg + '</h5>').fadeIn(1000);
        }
    }

    /* ------------------  AJAX CAMPAIGN MONITOR  ------------------ */

    $('#campaignmonitor').submit(function(e) {
        e.preventDefault();
        $.getJSON(
            this.action + "?callback=?",
            $(this).serialize(),
            function(data) {
                if (data.Status === 400) {
                    alert("Error: " + data.Message);
                } else { // 200
                    alert("Success: " + data.Message);
                }
            });
    });

    /* ------------------ OWL CAROUSEL ------------------ */

    $(".carousel").each(function() {
        var $Carousel = $(this);
        $Carousel.owlCarousel({
            loop: $Carousel.data('loop'),
            autoplay: $Carousel.data("autoplay"),
            margin: $Carousel.data('space'),
            nav: $Carousel.data('nav'),
            dots: $Carousel.data('dots'),
            center: $Carousel.data('center'),
            dotsSpeed: $Carousel.data('speed'),
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: $Carousel.data('slide-rs'),
                },
                1000: {
                    items: $Carousel.data('slide'),
                }
            }
        });

    });

    /* ------------------ MAGNIFIC POPUP ------------------ */

    var $imgPopup = $(".img-popup");
    $imgPopup.magnificPopup({
        type: "image"
    });
    $('.img-gallery-item').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* ------------------  MAGNIFIC POPUP VIDEO ------------------ */

    $('.popup-video,.popup-gmaps').magnificPopup({
        disableOn: 700,
        mainClass: 'mfp-fade',
        removalDelay: 0,
        preloader: false,
        fixedContentPos: false,
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '</div>',
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                }
            },
            srcAction: 'iframe_src',
        }
    });

    /* ------------------  ROUNDED SKILL ------------------ */

    $(window).on("scroll", function() {
        var skill = $('.skill'),
            scrollTop = $(window).scrollTop(),
            windowHeight = $(window).height(),
            roundedSkill = $('.rounded-skill');
        if (roundedSkill.length) {
            var wScroll = scrollTop + windowHeight,
                skillScroll = skill.offset().top + skill.outerHeight();
            if (wScroll > skillScroll) {
                roundedSkill.each(function() {
                    $(this).easyPieChart({
                        duration: 1000,
                        enabled: true,
                        scaleColor: false,
                        size: $(this).attr('data-size'),
                        trackColor: false,
                        lineCap: $(this).attr('data-line'),
                        lineWidth: $(this).attr('data-width'),
                        barColor: $(this).attr('data-color'),
                        animate: 5000,
                        onStep: function(from, to, percent) {
                            $(this.el).find('.prcent').text(Math.round(percent));
                        }
                    });
                });
            }
        }
    });

    /* ------------------  SWITCH GRID ------------------ */

    $('#switch-list').on("click", function(event) {
        event.preventDefault();
        $(this).addClass('active');
        $(this).siblings().removeClass("active");
        $(".product-item").each(function() {
            // "this" points to current item in looping through all elements with
            // class="Mandatory"
            $(this).addClass('product-list');
        });

    });
    $('#switch-grid').on("click", function(event) {

        event.preventDefault();
        $(this).addClass('active');
        $(this).siblings().removeClass("active");
        $(".product-item").each(function() {
            // "this" points to current item in looping through all elements with
            // class="Mandatory"
            $(this).removeClass('product-list');
        });

    });

    /* ------------------  BACK TO TOP ------------------ */

    var backTop = $('#back-to-top');

    if (backTop.length) {
        var scrollTrigger = 200, // px
            backToTop = function() {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    backTop.addClass('show');
                } else {
                    backTop.removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function() {
            backToTop();
        });
        backTop.on('click', function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    /* ------------------ PORTFOLIO FLITER ------------------ */

    var $portfolioFilter = $(".portfolio-filter"),
        portfolioLength = $portfolioFilter.length,
        protfolioFinder = $portfolioFilter.find("a"),
        $portfolioAll = $("#portfolio-all");

    // init Isotope For Portfolio
    protfolioFinder.on("click", function(e) {
        e.preventDefault();
        $portfolioFilter.find("a.active-filter").removeClass("active-filter");
        $(this).addClass("active-filter");
    });
    if (portfolioLength > 0) {
        $portfolioAll.imagesLoaded().progress(function() {
            $portfolioAll.isotope({
                filter: "*",
                animationOptions: {
                    duration: 750,
                    itemSelector: ". portfolio-item ",
                    easing: "linear",
                    queue: false,
                }
            });
        });
    }
    protfolioFinder.on("click", function(e) {
        e.preventDefault();
        var $selector = $(this).attr("data-filter");
        $portfolioAll.imagesLoaded().progress(function() {
            $portfolioAll.isotope({
                filter: $selector,
                animationOptions: {
                    duration: 750,
                    itemSelector: ". portfolio-item ",
                    easing: "linear",
                    queue: false,
                }
            });
            return false;
        });
    });

    /* ------------------ SHOP FLITER ------------------ */

    var $shopFilter = $(".shop-filter"),
        shopLength = $shopFilter.length,
        shopFinder = $shopFilter.find("a"),
        $shopAll = $("#shop-all");

    // init Isotope For shop
    shopFinder.on("click", function(e) {
        e.preventDefault();
        $shopFilter.find("a.active-filter").removeClass("active-filter");
        $(this).addClass("active-filter");
    });
    if (shopLength > 0) {
        $shopAll.imagesLoaded().progress(function() {
            $shopAll.isotope({
                filter: "*",
                animationOptions: {
                    duration: 750,
                    itemSelector: ". productFilter",
                    easing: "linear",
                    queue: false,
                }
            });
        });
    }
    shopFinder.on("click", function(e) {
        e.preventDefault();
        var $selector = $(this).attr("data-filter");
        $shopAll.imagesLoaded().progress(function() {
            $shopAll.isotope({
                filter: $selector,
                animationOptions: {
                    duration: 750,
                    itemSelector: ". productFilter",
                    easing: "linear",
                    queue: false,
                }
            });
            return false;
        });
    });

    /* ------------------  FOLLOW INSTAGRAM ------------------ */
	
    var instafeedModule = $('#instafeedModule').length,
        instafeedSidebar = $('#instafeedSidebar').length,
        instafeedSection = $('#instafeedSection').length,
        instafeedFooter = $('#instafeedFooter').length,
        InstaUserID = '6069962191',
        /*YOUR_USER_ID*/
        InstaAccessToken = '6069962191.1677ed0.2378d7ca8d274dae89847215f19cc93f'; /*YOUR_ACCESS_TOKEN*/
    if (instafeedModule > 0) {

        var userFeedModule = new Instafeed({
            target: 'instafeedModule',
            get: 'user',
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $('.instafeed').data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fa fa-plus"></i></div></a>',
            resolution: 'low_resolution',
        });

        userFeedModule.run();
    }

    if (instafeedSidebar > 0) {

        var userFeedSidebar = new Instafeed({
            target: 'instafeedSidebar',
            get: 'user',
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $('.instafeed').data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fa fa-plus"></i></div></a>',
            resolution: 'low_resolution',
        });
        userFeedSidebar.run();
    }

    if (instafeedSection > 0) {

        var userFeedSection = new Instafeed({
            target: 'instafeedSection',
            get: 'user',
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $('.instafeed').data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fa fa-instagram"></i></div></a>',
            resolution: 'low_resolution',
        });
        userFeedSection.run();
    }

    if (instafeedFooter > 0) {

        var userFeedFooter = new Instafeed({
            target: 'instafeedFooter',
            get: 'user',
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $('.instafeed').data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fa fa-plus"></i></div></a>',
            resolution: 'low_resolution',
        });
        userFeedFooter.run();
    }

    /* ------------------  TWITTER FEED ------------------ */

    var twitterFeed = $('#twitter-feed'),
        twitterID = '721372281637888000'; // Your Twitter Widget Id Here
    if (twitterFeed.length > 0) {
        /* Get Last 2 Tweets */
        var twitterConfig = {
            "id": twitterID,
            "domId": 'twitter-feed',
            "maxTweets": 2,
            "showUser": false,
            "showTime": true,
            "showRetweet": false,
            "showInteraction": false,
            "enableLinks": true,
            "customCallback": handleTweets,
            "dateFunction": momentDateFormatter,
        };

        function handleTweets(tweets) {
            var x = tweets.length;
            var n = 0;
            var element = document.getElementById('twitter-feed');
            var html = '<ul class="list-unstyled mb-0">';
            while (n < x) {
                html += '<li>' + tweets[n] + '</li>';
                n++;
            }
            html += '</ul>';
            element.innerHTML = html;
        }

        function momentDateFormatter(date, dateString) {
            return moment(dateString).fromNow();
        }
        twitterFetcher.fetch(twitterConfig);
    }

    /* ------------------  SCROLL TO ------------------ */

    var aScroll = $('a[data-scroll="scrollTo"]');
    aScroll.on('click', function(event) {
        var target = $($(this).attr('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
            if ($(this).hasClass("menu-item")) {
                $(this).parent().addClass("active");
                $(this).parent().siblings().removeClass("active");
            }
        }
    });

    /* ------------------ PROGRESS BAR ------------------ */

    if ($(".skills").length > 0) {
        $(window).scroll(function() {
            var skillsTop = $(".skills").offset().top - 100,
                skillsHight = $(this).outerHeight(),
                wScroll = $(window).scrollTop();
            if (wScroll > skillsTop - 1 && wScroll < skillsTop + skillsHight - 1) {
                $(".progress-bar").each(function() {
                    $(this).width($(this).attr('aria-valuenow') + '%');
                });
            }
        });
    }

    /* ------------------ NAV SPLIT ------------------ */

    if ($('.body-split').length > 0) {
        $(window).on("scroll", function() {
            $('.section').each(function() {

                var sectionID = $(this).attr("id"),
                    sectionTop = $(this).offset().top - 100,
                    sectionHight = $(this).outerHeight(),
                    wScroll = $(window).scrollTop(),
                    $navHref = $("a[href='#" + sectionID + "']"),
                    $nav = $('.nav-split').find($navHref).parent();
                if (wScroll > sectionTop - 1 && wScroll < sectionTop + sectionHight - 1) {
                    $nav.addClass('active');
                    $nav.siblings().removeClass('active');
                }
            });
        });
    }

    var $section = $('.section'),
        $bodyScroll = $('.body-scroll');
    if ($bodyScroll.length > 0) {
        $(window).on("scroll", function() {
            $section.each(function() {
                var sectionID = $(this).attr("id"),
                    sectionTop = $(this).offset().top - 100,
                    sectionHight = $(this).outerHeight(),
                    wScroll = $(window).scrollTop(),
                    $navHref = $("a[href='#" + sectionID + "']"),
                    $nav = $('.nav-onepage').find($navHref).parent();
                if (wScroll > sectionTop - 1 && wScroll < sectionTop + sectionHight - 1) {
                    $nav.addClass('active');
                    $nav.siblings().removeClass('active');
                }
            });
        });
    }

    /* ------------------ SLIDER RANGE ------------------ */

    var $sliderRange = $("#slider-range"),
        $sliderAmount = $("#amount");
    $sliderRange.slider({
        range: true,
        min: 0,
        max: 500,
        values: [50, 300],
        slide: function(event, ui) {
            $sliderAmount.val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $sliderAmount.val("$" + $sliderRange.slider("values", 0) + " - $" + $sliderRange.slider("values", 1));


    /* ------------------ COLUMN HEIGHT ------------------ */
	
    $(window).on("load", function() {

        var comHeight = $(".comm-height"),
            comHeightOuter = comHeight.outerHeight(),
            colHeightContent = comHeight.children(".col-content").outerHeight();
        if (comHeight.length > 0) {
            if ($(window).width() > 991) {
                comHeight.each(function() {
                    $(this).children("[class*=col-]").css('height', comHeightOuter);
                });
            } else {
                comHeight.children("[class*=col-]").css('height', colHeightContent);
            }
        }
    });

    /* ------------------  AJAX CONTACT FORM  ------------------ */

    var contactForm = $(".contactForm"),
        contactResult = $('.contact-result');
    contactForm.validate({
        debug: false,
        submitHandler: function(contactForm) {
            $(contactResult, contactForm).html('Please Wait...');
            $.ajax({
                type: "POST",
                url: "assets/php/contact.php",
                data: $(contactForm).serialize(),
                timeout: 20000,
                success: function(msg) {
                    $(contactResult, contactForm).html('<div class="alert alert-success" role="alert"><strong>Thank you. We will contact you shortly.</strong></div>').delay(3000).fadeOut(2000);
                },
                error: $('.thanks').show()
            });
            return false;
        }
    });

    /* ------------------  AJAX RESERVATION POPUP FORM  ------------------ */

    var reservationPopupForm = $(".reservationPopupForm"),
        reservationResult = $('.reservation-result');
    reservationPopupForm.validate({
        debug: false,
        submitHandler: function(reservationPopupForm) {
            $(reservationResult, reservationPopupForm).html('Please Wait...');
            $.ajax({
                type: "POST",
                url: "assets/php/reservationpopup.php",
                data: $(reservationPopupForm).serialize(),
                timeout: 20000,
                success: function(msg) {
                    $(reservationResult, reservationPopupForm).html('<div class="alert alert-success" role="alert"><strong>Thank you. We will contact you shortly.</strong></div>').delay(3000).fadeOut(2000);
                },
                error: $('.thanks').show()
            });
            return false;
        }
    });

    /* ------------------  AJAX RESERVATION FORM  ------------------ */

    var reservationForm = $(".reservationForm"),
        reservationResult = $('.reservation-result');
    reservationForm.validate({
        debug: false,
        submitHandler: function(reservationForm) {
            $(reservationResult, reservationPopupForm).html('Please Wait...');
            $.ajax({
                type: "POST",
                url: "assets/php/reservationpopup.php",
                data: $(reservationForm).serialize(),
                timeout: 20000,
                success: function(msg) {
                    $(reservationResult, reservationForm).html('<div class="alert alert-success" role="alert"><strong>Thank you. We will contact you shortly.</strong></div>').delay(3000).fadeOut(2000);
                },
                error: $('.thanks').show()
            });
            return false;
        }
    });

}(jQuery));
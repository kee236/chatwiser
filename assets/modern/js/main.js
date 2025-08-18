(function() {
    
    "use strict";
    //===== Prealoder

    // window.onload = function() {
    //     window.setTimeout(fadeout, 500);
    // }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }

    
    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.getElementById("header_navbar");
        var sticky = header_navbar.offsetTop;

        if (window.pageYOffset > sticky) {
            header_navbar.classList.add("sticky");
        } else {
            header_navbar.classList.remove("sticky");
        }



        // show or hide the back-top-top button
        var backToTo = document.querySelector(".back-to-top");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = "block";
        } else {
            backToTo.style.display = "none";
        }
    };

    // Get the navbar


    // for menu scroll 
    var pageLink = document.querySelectorAll('.page-scroll');
    
    pageLink.forEach(elem => {
        elem.addEventListener('click', e => {
            e.preventDefault();
            document.querySelector(elem.getAttribute('href')).scrollIntoView({
                behavior: 'smooth',
                offsetTop: 1 - 60,
            });
        });
    });

    // section menu active
    function onScroll(event) {
        var sections = document.querySelectorAll('.page-scroll');
        var scrollPos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

        for (var i = 0; i < sections.length; i++) {
            var currLink = sections[i];
            var val = currLink.getAttribute('href');
            var refElement = document.querySelector(val);
            var scrollTopMinus = scrollPos + 73;
            if (refElement.offsetTop <= scrollTopMinus && (refElement.offsetTop + refElement.offsetHeight > scrollTopMinus)) {
                document.querySelector('.page-scroll').classList.remove('active');
                currLink.classList.add('active');
            } else {
                currLink.classList.remove('active');
            }
        }
    };

    window.document.addEventListener('scroll', onScroll);


    //===== close navbar-collapse when a  clicked
    let navbarToggler = document.querySelector(".navbar-toggler");    
    var navbarCollapse = document.querySelector(".navbar-collapse");

    document.querySelectorAll(".page-scroll").forEach(e =>
        e.addEventListener("click", () => {
            navbarToggler.classList.remove("active");
            navbarCollapse.classList.remove('show')
        })
    );
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    });
    

    //====== counter up 
    var cu = new counterUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
        append: 'k'
    });
    cu.start();


    //========= glightbox
    // const myGallery = GLightbox({
    //     'href': promo_video,
    //     'type': 'video',
    //     'source': video_source, //vimeo, youtube or local
    //     'width': 900,
    //     'autoplayVideos': true,
    // });


    //======== tiny slider (removed - replaced with Swiper for testimonials)
    // var slider = new tns({
    //     container: '.testimonial-slider',
    //     items: 2.4,
    //     slideBy: 'page',
    //     mouseDrag: true,
    //     autoplay: true,
    //     loop : true,
    //     gutter: 60,
    //     nav: false,
    //     controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
    //     responsive: {
    //         0: {
    //             items: 1,
    //         },
    //         992: {
    //             items: 1.8,
    //             gutter: 30,
    //         },
    //         1200: {
    //             items: 2,
    //             gutter: 100,
    //         },
    //         1400: {
    //             items: 2.4,
    //         },
    //     }
    // });

    //======== testimonials carousel swiper
    var testimonialsSwiper = new Swiper('.testimonial-carousel', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.testimonial-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.testimonial-next',
            prevEl: '.testimonial-prev',
        },
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 800,
        breakpoints: {
            992: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
        }
    });

    //======== screenshots swiper
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        speed: 1000,
        autoplay: {
          delay: 1500,
          disableOnInteraction: false,
        },
        centeredSlides: true,
        slidesPerView: 5,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 2,
            },
            1200: {
                slidesPerView: 2,
            },
        }
    });


    //WOW Scroll Spy
    var wow = new WOW({
        //disabled for mobile
        mobile: false
    });
    wow.init();



})();
// Cookie Alert Functionality
document.addEventListener('DOMContentLoaded', function() {
    const acceptCookies = document.querySelector('.accept-cookies');
    const cookieAlert = document.querySelector('.modern-cookie-alert');
    
    if (acceptCookies && cookieAlert) {
        acceptCookies.addEventListener('click', function() {
            // Set cookie acceptance
            document.cookie = "cookies_accepted=yes; path=/; max-age=" + (365 * 24 * 60 * 60);
            
            // Hide cookie alert with animation
            cookieAlert.style.transform = 'translateY(100%)';
            cookieAlert.style.opacity = '0';
            
            setTimeout(() => {
                cookieAlert.style.display = 'none';
            }, 300);
            
            // Send AJAX request to update session
            fetch(window.location.origin + '/home/accept_cookies', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({accept: true})
            }).catch(error => {
                console.log('Cookie acceptance logged locally');
            });
        });
    }
});

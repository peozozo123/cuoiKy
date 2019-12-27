$(document).ready(function(){
    $('.owl-product1').owlCarousel({
        rtl:false,
        loop:true,
        margin:10,
        nav:true,
        dots: false,
        nav: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    $('.owl-product2').owlCarousel({
        rtl:false,
        loop:true,
        margin:10,
        nav:true,
        dots: false,
        nav: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

    $('.owl-next-banner').click(function() {
        $('.owl-banner').trigger('next.owl.carousel');
    })

    $('.owl-prev-banner').click(function() {
        $('.owl-banner').trigger('prev.owl.carousel', [300]);
    })

    $('.owl-next-product1').click(function() {
        $('.owl-product1').trigger('next.owl.carousel');
    })

    $('.owl-prev-product1').click(function() {
        $('.owl-product1').trigger('prev.owl.carousel', [300]);
    })

    $('.owl-next-product2').click(function() {
        $('.owl-product2').trigger('next.owl.carousel');
    })

    $('.owl-prev-product2').click(function() {
        $('.owl-product2').trigger('prev.owl.carousel', [300]);
    })

    var owl_banner = $('.owl-banner')
    
    owl_banner.owlCarousel({
        items:1,
        loop: true,
        autoplay: true,
        center:true,
        dots: false,
        margin:10,
        URLhashListener:true,
        autoplayHoverPause:true,
        startPosition: 'URLHash'
    });

    owl_banner.on('changed.owl.carousel', function(e) {
        console.log(e.item.index)
    })

    var slider_menu = $('.menu-slider');
    var current_item = 0;
    var size = 4;
    
    slider_menu.owlCarousel({
        items: size,
        loop: false,
        center:false,
        dots: false,
        margin:10
    });

    slider_menu.on('changed.owl.carousel', function(e) {
        current_item = e.item.index;
    })

    var menu_item = $(".menu-item");

        menu_item.click(function(event) {
            event.preventDefault()
            var index_id = menu_item.index(this);
            owl_banner.trigger('to.owl.carousel', [index_id, 300]);
            // console.log(index_id);
            // console.log(current_item);
            $('.owl-item').removeClass('selected');
            $(this).parent().addClass('selected');
            if (index_id == current_item)
                slider_menu.trigger('prev.owl.carousel');
            else if (index_id >= current_item+size-1)
                slider_menu.trigger('next.owl.carousel');
        })

    var btn = $("#back-to-top");

    $(window).scroll(function() {
        if ($(window).scrollTop() > 50) {
          btn.addClass('show');
        } else {
          btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
});
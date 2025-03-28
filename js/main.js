(function () {
    "use strict";
/****menu hamburguesa mostrar icono y ocultar*****/
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('mobile-nav-toggle')) {
            document.querySelector('#navbar').classList.toggle('navbar-mobile');
            e.target.classList.toggle('bx-merch');
            e.target.classList.toggle('bx-x');
        }
    });
    /****Mostrar merch responsivo***/
    window.addEventListener('load', function () {
        let merchContainer = document.querySelector('.merch-container');
        if (merchContainer) {
            let merchIsotope = new Isotope(merchContainer, {
                itemSelector: '.merch-item',
                layoutMode: 'fitRows'
            });
            let merchFilters = document.querySelectorAll('#merch-filters li');
            merchFilters.forEach(function (merchFilter) {
                merchFilter.addEventListener('click', function (e) {
                    e.preventDefault();
                    merchFilters.forEach(function (filter){
                        filter.classList.remove('filter-active');
                    });
                    this.classList.add('filter-active');
                    merchIsotope.arrange({
                            filter: this.getAttribute('data-filter')
                        });
                    });
                });
            }
    });
    
    const swiper = new Swiper('.swiper', {
        loop:true,
        speed:600,
        autoplay:{
            delay:5000,
            disableOnInteraction:false
        },
        pagination: {
            el: '.swiper-pagination',
            type:'bullets',
            clicktable:true
        },
      
      });
      //***swiper testoimonios***/
      const swiperTestimonials = new Swiper('.testimonials-slider', {
        loop:true,
        speed:600,
        autoplay:{
            delay:5000,
            disableOnInteraction:false
        },
        slidesPerView:'auto',
        pagination: {
            el: '.swiper-pagination',
            type:'bullets',
            clickable:true
        },
      
      });
      /*****iniciar galeria */
      const galleryLightbox = GLightbox({
        selector:'.gallery-lightbox'
      });
      /****regresar al inicio */
})();

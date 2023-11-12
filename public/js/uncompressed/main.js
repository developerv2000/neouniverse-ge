// ----------------Ajax Request setup start----------------
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
// ----------------Ajax Request setup end----------------


// ----------------Main carousel start----------------
let main_carousel = $("#main_carousel");
if (main_carousel) {
    main_carousel.owlCarousel({
        loop: true,
        margin: 30,
        // autoplaySpeed: 2000,
        // autoplayTimeout: 8000,
        nav: false,
        dots: false,
        center: true,
        responsive: {
            0 : {
                autoWidth: false,
                items: 1,
                autoplay: true
            },
            991 : {
                autoWidth: true,
                autoplay: false
            },
        }
    });

    // Owl carousel navigations
    let owl_nav_prev = document.getElementsByClassName("main-carousel__owl-nav--prev");
    for (nav of owl_nav_prev) {
        nav.addEventListener("click", function () {
            main_carousel.trigger('prev.owl.carousel');
        });
    }

    let owl_nav_next = document.getElementsByClassName("main-carousel__owl-nav--next");
    for (nav of owl_nav_next) {
        nav.addEventListener("click", function () {
            main_carousel.trigger('next.owl.carousel');
        });
    }
}
// ----------------Main carousel end----------------


// ----------------Products carousel start----------------
let products_carousel = $("#products_carousel");
if (products_carousel) {
    products_carousel.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
            },
            991: {
                items: 4,
                autoplay: false,
            }
        }
    });

    // Owl carousel navigations
    let owl_nav_prev = document.getElementsByClassName("products-carousel__owl-nav--prev");
    for (nav of owl_nav_prev) {
        nav.addEventListener("click", function () {
            products_carousel.trigger('prev.owl.carousel');
        });
    }

    let owl_nav_next = document.getElementsByClassName("products-carousel__owl-nav--next");
    for (nav of owl_nav_next) {
        nav.addEventListener("click", function () {
            products_carousel.trigger('next.owl.carousel');
        });
    }
}

// ----------------Main carousel end----------------


// --------------Google Maps start----------------
let map = document.getElementById("map");
if (map) {
    let map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: map_latitude,
                lng: map_longitude
            },
            zoom: 14,
            mapTypeControl: false,
            streetViewControl: false
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            animation: google.maps.Animation.BOUNCE,
            position: {
                lat: marker_latitude,
                lng: marker_longitude
            },
            icon: '/img/main/marker.svg'
        });
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
}
// --------------Google Maps end----------------


// --------------Accordion start----------------
document.querySelectorAll('.accordion__button').forEach(item => {
    item.addEventListener('click', event => {
        let button = event.target;
        let parent = button.closest('.accordion__item');
        let accordion = button.closest('.accordion');
        let collapse = parent.getElementsByClassName('accordion__collapse')[0];

        // close any other active collapses
        let active_collapses = accordion.getElementsByClassName('accordion__collapse--show');
        for (i = 0; i < active_collapses.length; i ++) {
            if (active_collapses[i] !== collapse) { // remove active class from collapse button
                let active_collapse_parent = active_collapses[i].closest('.accordion__item');
                let active_button = active_collapse_parent.getElementsByClassName('accordion__button')[0];
                active_button.classList.remove('accordion__button--active');
                // remove show class from collapse
                active_collapses[i].style.height = null;
                active_collapses[i].classList.remove('accordion__collapse--show');
            }
        }

        // hide collapse body if its active
        if (collapse.clientHeight) {
            collapse.style.height = 0;
            collapse.classList.remove('accordion__collapse--show');
            button.classList.remove('accordion__button--active');
            // else show collapse body if its hidden
        } else {
            collapse.style.height = collapse.scrollHeight + "px";
            collapse.classList.add('accordion__collapse--show');
            button.classList.add('accordion__button--active');
        }
    });
});
// --------------Accordion end----------------


//---------------- Products filter select start----------------
$('.products__filter-select').selectric({
    onChange: function (element) {
        $(element).change();
        filter_products();
    },
    maxHeight: 300,
    keySearchTimeout: 500,
    arrowButtonMarkup: '<button class="selectric-button" type="button"><span class="material-icons-outlined">chevron_right</span></button>',
    disableOnMobile: false,
    nativeOnMobile: false,
    openOnFocus: true,
    openOnHover: false,
    hoverIntentTimeout: 500,
    expandToItemText: false,
    responsive: false,
    forceRenderAbove: false,
    forceRenderBelow: false,
    stopPropagation: true
});
//---------------- Products filter select end----------------


//---------------- Products filter radiobuttons & input start----------------
$(document).ready(function() {
    $('input[type=radio][name="prescription"]').change(function() {
        filter_products();
    });

    $('#products_filter_search').on('input', function () {
        this.setAttribute('value', this.value);
        filter_products();;
    });
});
//---------------- Products filter radiobuttons & input end----------------


//---------------- Filter products start----------------
let product_filter_form = document.getElementById('product_filter_form');
let products_list_container = document.getElementById('products_list_container');

function filter_products() {
    let data = new FormData(product_filter_form);

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/products/ajax-get',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        //update inner HTML of products list on success
        success: function (response) {
            products_list_container.innerHTML = response;
        },
        error: function () {
            console.log('Ajax products filter failed !');
        }
    });
}
//---------------- Filter products end----------------


//---------------- News filter select start----------------
$('.news__filter-select').selectric({
    onChange: function (element) {
        $(element).change();
        filter_news();
    },
    maxHeight: 300,
    keySearchTimeout: 500,
    arrowButtonMarkup: '<button class="selectric-button" type="button"><span class="material-icons-outlined">chevron_right</span></button>',
    disableOnMobile: false,
    nativeOnMobile: false,
    openOnFocus: true,
    openOnHover: false,
    hoverIntentTimeout: 500,
    expandToItemText: false,
    responsive: false,
    forceRenderAbove: false,
    forceRenderBelow: false,
    stopPropagation: true
});
//---------------- Products filter select end----------------


//---------------- News filter input start----------------
$(document).ready(function() {
    $('#news_filter_search').on('input', function () {
        this.setAttribute('value', this.value);
        filter_news();
    });
});
//---------------- News filter input end----------------


//---------------- Filter news start----------------
let news_filter_form = document.getElementById('news_filter_form');
let news_list_container = document.getElementById('news_list_container');

function filter_news() {
    let data = new FormData(news_filter_form);

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/news/ajax-get',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        //update inner HTML of products list on success
        success: function (response) {
            news_list_container.innerHTML = response;
        },
        error: function () {
            console.log('Ajax news filter failed !');
        }
    });
}
//---------------- Filter news end----------------


//---------------- Header search start ----------------
let header_search_result = document.getElementById('header_search_result');

$(document).ready(function() {
    $('#header_search_input').on('input', function () {
        if (this.value == '') {
            header_search_result.innerHTML = '';
        } else {
            ajax_header_search(this.value);
        }
    });
});
//---------------- Header search end ----------------


// ----------------Ajax header search star t----------------
function ajax_header_search(search_keyword) {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/search',
        data: {keyword : search_keyword},
        cache: false,
        timeout: 600000,
        //update inner HTML of search result on success
        success: function (response) {
            if (!response.resultsCount) {
                header_search_result.innerHTML = `<div class="search__no-results">${response.noResultsText}</div>`;
            } else {
                let content = '';

                for (item of response.products) {
                    clean_text = item.text.replace(/<\/?[^>]+(>|$)/g, "");
                    content += `<a href="${response.productsUrl}/${item.url}">`
                        + `<span><b>«${item.title}»</b> ${clean_text}</span>`
                        + '<span class="material-icons-outlined">arrow_forward</span></a>';
                }

                for (item of response.news) {
                    clean_text = item.text.replace(/<\/?[^>]+(>|$)/g, "");
                    content += `<a href="${response.newsUrl}/${item.url}">`
                        + `<span><b>«${item.title}»</b> ${clean_text}</span>`
                        + '<span class="material-icons-outlined">arrow_forward</span></a>';
                }
                    
                header_search_result.innerHTML = content;
            }
        },
        error: function () {
            console.log('Ajax header search failed !');
        }
    });
}
// ----------------Ajax header search end ----------------


// ----------------Dropdown start ----------------
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
  
// Close the dropdown menu if the user clicks outside of it
window.onclick = function (event) {
    if (event.target.matches('.dropdown__button')) {
        let dropdown = $(event.target).next();
        dropdown[0].classList.toggle('dropdown__content--visible')
    }

    if (!event.target.matches('.dropdown__button')) {
        let dropdowns = document.getElementsByClassName("dropdown__content");
        for (i = 0; i < dropdowns.length; i++) {
            if (dropdowns[i].classList.contains('dropdown__content--visible')) {
                dropdowns[i].classList.remove('dropdown__content--visible');
            }
        }
    }
}
// ---------------- Dropdown end ----------------
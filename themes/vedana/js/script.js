// Les variable de travail
    detectObjectArray = [];
// Le mode debug affiche les console.log
    debugMode = 0;

var brandPrimary = $('.brand-primary').css('background-color');
var brandPrimaryText = $('.brand-primary').css('color');
var brandSecondary = $('.brand-secondary').css('background-color');

$(document).ready(function(){

// Le loader 
    NProgress.configure({trickleRate: .5, trickleSpeed: 1000});
    NProgress.start();

// Le parallax du header    
    parallaxHandler();

// Le breadcrumb     
    $("#jquery_breadcrumb").rcrumbs();

// Le breakpoint.js
    // $(window).setBreakpoints({breakpoints: [992]});
    // $(window).bind('exitBreakpoint992',function() {
    //     l('exitBreakpoint992');
    // });    

// Maintenant comme référence pour fixer le menu,
// On prend le premier sous-header, sinon le deuxième, sinon le contenu principal
    var nav = $('.top-bar');
    var main = $('.main-container');
    var b = nav.height() + parseInt(nav.css('top'),10);
    var mainWatch = scrollMonitor.create(main,{top:b});
    mainWatch.stateChange(function() {
        nav.toggleClass('fixedtop', this.isAboveViewport);
    });

    // le démarrer manuelement si la page est chargé en plein milieu
    var i = $('.intro');
    if(i.height() < $(window).scrollTop())  nav.addClass('fixedtop') ;
    
// Le Google grid
    $('.g-gallery').each(function(){
        new CBPGridGallery(this);
    });
// Les masonery
    launchMasonery();

// Afficher les element avec la classe .detect
    detectOnView();

    $('.small-display-nav-bar-inner').autoHidingNavbar();
    
// Les accordions
    $('.accordionTitle').on('click',function(e){
        e.preventDefault();
        t = $(this);
        c = t.parent().next('.accordionItem');
        w = t.parent().parent().parent('.accordion');

        // On ferme les ouverts
        w.find('.accordionTitleActive').removeClass('accordionTitleActive');
        w.find('.accordionItem').not('.accordionItemCollapsed').addClass('accordionItemCollapsed').removeClass('animateIn').addClass('animateOut');

        if(c.is('.accordionItemCollapsed')) {
            // On ouvre
            if (c.is('.animateOut')) c.removeClass('animateOut');
            c.addClass('animateIn');
        } else {
            // On ferme
            c.removeClass('animateIn').addClass('animateOut');
        }
        t.toggleClass('accordionTitleActive');
        c.toggleClass('accordionItemCollapsed');
    });

// Ajouter l'attribut title au boutons 3D
    $('.outline-button:not([title])').each(function(){
        var t = $(this); 
        t.attr('title', t.html());
    });

// gérer le sliding-sidebar
    $slidingPages = $('.sliding-page');

    $slidingPages.each(function(i){
        var $article = $(this);
        var $sidebar = $article.find('.sliding-sidebar');

        var stopEdit = $('body').is('.edit-bar') ? 48 : 0;
        var stopTop = stopEdit - parseInt($sidebar.css('margin-top'));
        var stopBot = parseInt($sidebar.css('margin-bottom'));
        //var $nav = $('.top-nav');

        // Le watch qui determine si le bas de l'article et remonté 
        // la hauteur de l'article moins celle du header
        l( stopTop , stopEdit);
        var pageWatch = scrollMonitor.create($article,{bottom:-($sidebar.height() - stopTop ), top:stopTop });
        pageWatch.lock();
        // Dès le debut on calcule
        sidebarWatcherActions(pageWatch);
        // Et a tout changements on recalcule
        pageWatch.stateChange (function(){
            sidebarWatcherActions(this);
        });

    });

// -- Seulement pour que les images svg prennent la couleur 
    jQuery('.svg-primary img, .svg-quaternary img').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });    

// Le bouton qui failt glisser la page en full header
    $('.gotobottom').on('click', function(){
        $("body").animate({ scrollTop: $('.page-header').height() + $('.info-bar').height() }, "slow");
    });    

// Le Video BG n'est activé que si c'est pas mobile
    if (!jQuery.browser.mobile)
        $("#mb_YTPlayer").mb_YTPlayer();

// Finalement on affiche la page
    $('.ved').addClass('loaded');

}); // --  On document ready()

function sidebarWatcherActions(watcher) {
    var $e = $(watcher.watchItem);
    // Si la zone est au dessus MAIS qu'uen partie soit encore visible
    if (watcher.isAboveViewport && watcher.isInViewport) {
      $e.addClass('fixed').removeClass('bottom');
    }
    // Il est sorti entirement par le dessus
    if (!watcher.isInViewport && watcher.isAboveViewport ) {
      $e.addClass('bottom').removeClass('fixed');
    }
    // Tout est visible, tout est normal (aucune class speciale)
    if(watcher.isFullyInViewport) {
      $e.removeClass('fixed');
    }

}

$(window).load(function() {
    NProgress.done();
    
    l('document loaded');
})

function parallaxHandler () {    
    var nav = $('#top-nav');
    var intro = $('#intro-content');
    $(window).scroll(function(i){
        var scrollVar = $(window).scrollTop();
        intro.css({'top': .7*scrollVar });
    })
};


function launchMasonery() {
    l('launch masonry');
    var $container = $('.masonry');
    // initialize
    $container.each(function(){
        $c = $(this);
        $c.imagesLoaded(function(){
            $c.masonry({
                columnWidth:'.grid-sizer',
                itemSelector: '.item'
            });    
        })

    });
};

// -- Ajoute la classe 'view' sur les element '.detect' une fois qu'il arrive dans le viewport -- \\

function detectOnView () {
    l('launch detectOnView');
    $('.detect').each(function(i){
        var $e = $(this);
        var detectWatch = scrollMonitor.create($e);
        detectObjectArray.push(detectWatch); 
        var rand = Math.random() * 200;
          detectWatch.exitViewport(function() {
            $e.removeClass('view');
          });
          detectWatch.enterViewport(function() {
            setTimeout(function(){
              $e.addClass('view');  
            },rand);
          });
      });
}

// -- Detruit les observateurs (utilisé pour les mobiles) -- \\

function destroyDetectOnView () {
    l('launch destroyDetectOnView');
    // On rend tous les elements visibles
    $('.detect').each(function(i){$(this).addClass('view')});
    // et on detruit les eénement qui leurs sont liés
    $(detectObjectArray).each(function(e){this.destroy()});
}


// -- Responsive navigation -- \\

(function() {
    var container = $( 'div.ccm-page' ),
        triggerBttn = $('#hamburger-icon'),
        overlay = $( '.overlay' ),
        closeBttn = $( 'button.overlay-close' );
    function toggleOverlay() {
        if( overlay.is('.open' ) ) {
            overlay.removeClass('open' );
            container.removeClass('overlay-open' );
            triggerBttn.removeClass('active');
        }
        else {
            overlay.addClass('open' );
            container.addClass('overlay-open' );
            triggerBttn.addClass('active');
        }
    }

    triggerBttn.on( 'click', toggleOverlay );
})();



// -- Les log dans la console -- \\
function l(m) {
    if (debugMode) console.log(m)
}

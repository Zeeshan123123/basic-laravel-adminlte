$(function () {
    $(window).on('scroll', function () {
        if ( $(window).scrollTop() > 10 ) {
            $('.header-section').addClass('active sticky-top');
            $('.header-section').removeClass('position-absolute');
        } else {
            $('.header-section').removeClass('active sticky-top');
            $('.header-section').addClass('position-absolute');
        }
    });
});


$(window).on('load', function () {
    $('.filters_menu li').click(function () {
        $('.filters_menu li').removeClass('active');
        $(this).addClass('active');

        var data = $(this).attr('data-filter');
        $grid.isotope({
            filter: data
        })
    });

    var $grid = $(".grid").isotope({
        itemSelector: ".all",
        percentPosition: false,
        masonry: {
            columnWidth: ".all"
        }
    })
});


var first = $(".item:first")
$('#items').isotope({
  filter: first
});

// Filters out items
$('#filters li').click(function(e) {
  e.preventDefault()
  var selector = $(this).attr('data-filter')
    $(this).addClass('active');
  $('#items').isotope({
    filter: selector
  });
});

$(document).ready(function(){
        $('[data-bs-toggle="tooltip"]').tooltip();   
});
/******Multistep Gift Card Form******/
var Container = $('fieldset');
var listItems = $('#progressbar li');
var nextBtn     = $('.next');
var nextBtn     = $('.previous');
var submitBTn   = $('.submit');

$(Container).eq(0).css({'display':'block', 'z-index': '9'});
$(".next").click(function(){
        var number = $(this).parent().index();
        $(this).parent().css({'display':'none', 'z-index': '0', 'overflow':'hidden'});
        $(this).parent().next().css({'display':'block', 'z-index': '9'});
        $(listItems).eq(number).addClass("active");
} )
$(".previous").click(function(){
        var number = $(this).parent().index();
        $(this).parent().css({'display':'none', 'z-index': '0', 'overflow':'hidden'});
        $(this).parent().prev().css({'display':'block', 'z-index': '9'});
        $(listItems).eq(number - 1).removeClass("active");
} )
$(".submit").click(function(){
    return false;
})
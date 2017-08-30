/**
 * @file
 * custom.js
 *
 * Filename:     custom.js
 * Website:      http://www.ordasoft.com
 * Description:  template
 * Author:       ordasoft dev team ordasoft.com.
 */

(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.osDeltaReady = {
    attach: function (context, settings) {
      var mainMenu = $('.region-primary-menu ul');
      mainMenu.find('li.menu-item--expanded > a').once().append('<span class="arrow"></span>');
      $('.menu li a + ul').addClass('sub_menu');
      var slideButton = $('.views_slideshow_controls_text');
      $('.views_slideshow_controls_text_previous > a').addClass('previous');
      $('.views_slideshow_controls_text_next > a').addClass('next');
      slideButton.find('.previous').once().append('<i class="fa fa-angle-left"></i>');
      $('.views_slideshow_controls_text_next > a').addClass('next');
      slideButton.find('.next').once().append('<i class="fa fa-angle-Right"></i>');
      $('.switchButton span').click(function () {
        var page = $('body').removeClass();
        if ($(this).hasClass('bt-red')) {
          page.addClass('default');
        }
        if ($(this).hasClass('bt-lghtGre')) {
          page.addClass('divLghtGreen');
        }
        if ($(this).hasClass('bt-blue')) {
          page.addClass('divBlue');
        }
        if ($(this).hasClass('bt-red')) {
          page.addClass('divRed');
        }
        if ($(this).hasClass('bt-green')) {
          page.addClass('divGreen');
        }
        if ($(this).hasClass('bt-indigo')) {
          page.addClass('divIndigo');
        }
        if ($(this).hasClass('bt-orange')) {
          page.addClass('divOrange');
        }
      });

      $('.scrollup').click(function () {
        $('html,body').animate({scrollTop: 0}, 300);
        return false;
      });

      $(window).scroll(function () {
        if ($(window).scrollTop() >= 1) {
          $('.maimMenu').addClass('maimMenu-fixed');
        }
        else {
          $('.maimMenu').removeClass('maimMenu-fixed');
        }
      });

      $(window).scroll(function () {
        if ($(window).scrollTop() >= 39) {
          $('.toolbar-vertical .maimMenu').addClass('maimMenu-fixed');
        }
        else {
          $('.toolbar-vertical .maimMenu').removeClass('maimMenu-fixed');
        }
      });

      $(window).scroll(function () {
        if ($(window).scrollTop() >= 1) {
          $('.toolbar-fixed .maimMenu').addClass('maimMenu-fixed');
        }
        else {
          $('.toolbar-fixed .maimMenu').removeClass('maimMenu-fixed');
        }
      });

      $('.bottom1 .views-row:first-child').addClass('first');
      $('.bottom1 .views-row:last-child').addClass('last');

      var pContainerHeight = $('.top_block').height();

      $(window).scroll(function () {
        var wScroll = $(this).scrollTop();
        if (wScroll <= pContainerHeight) {
          $('.panet1').css('transform', 'translate(0px, ' + wScroll / 4 + '%)');
          $('.prlx').css('transform', 'translate(0px, -' + wScroll / 1 + '%)');
        }

        if ($('.center_block').length) {
          if (wScroll > $('.center_block').offset().top - $(window).height()) {
            $('.cloth1').css('transform', 'translate(' + -Math.abs() + 'px)');
            $('.cloth2').css('transform', 'translate(' + Math.abs() + 'px)');
            $('.blog_post').css('transform', 'translate(0px, ' + wScroll / 25 + '%)');
            if ($(window).width() < 990) {
              $('.blog_post').css('transform', 'translate(0px, ' + wScroll / 29 + '%)');
            }

            $('.city2').css('transform', 'translate(0px, -' + wScroll / 26 + '%)');
            if ($(window).width() < 550) {
              $('.blog_post').css('transform', 'none');
              $('.city2').css('transform', 'none');
            }
          }
        }

        if ($('.city_block').length) {
          if (wScroll > $('.city_block').offset().top - $(window).height()) {
            $('.left_block').css('transform', 'translate(0px, ' + wScroll / 25 + '%)');
            $('.right_block').css('transform', 'translate(0px, ' + wScroll / 27 + '%)');
            if ($(window).width() < 990) {
              $('.left_block').css('transform', 'translate(0px, ' + wScroll / 67 + '%)');
              $('.right_block').css('transform', 'translate(0px, ' + wScroll / 40 + '%)');
            }
            if ($(window).width() < 550) {
              $('.left_block').css('transform', 'none');
              $('.right_block').css('transform', 'none');
            }
          }
        }

        if ($('.bottom1').length) {
          if (wScroll > $('.bottom1').offset().top - $(window).height()) {
            var offset = (Math.min(0, wScroll - $('.bottom1').offset().top + $(window).height() - 350)).toFixed();
            $('.first').css('transform', 'translate(' + offset + 'px, ' + Math.abs(offset * 0.2) + 'px)');
            $('.last').css('transform', 'translate(' + Math.abs(offset) + 'px, ' + Math.abs(offset * 0.2) + 'px)');
          }
        }
      });

      var theToggle = document.getElementById('toggle');

      function hasClass(elem, className) {
        return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
      }

      function toggleClass(elem, className) {
        var newClass = ' ' + elem.className.replace(/[\t\r\n]/g, '') + ' ';
        if (hasClass(elem, className)) {
          while (newClass.indexOf('' + className + '') >= 0) {
            newClass = newClass.replace('' + className + '', '');
          }
          elem.className = newClass.replace(/^\s+|\s+$/g, '');
        }
        else {
          elem.className += ' ' + className;
        }
      }

      theToggle.onclick = function () {
        toggleClass(this, 'on');
        return false;
      };

    }
  };
})(jQuery, Drupal);

var screenWidth = 300;
var screenLeft;
var currentPage = '';
var defaultPage = 'home';
var isFirstPage = true;

var $screen = null;
var optionsButton = null;
var backButton = null;

var pageCache = [];

var powerOff = false;

var pageHistory = [];

$(function() {
  $screen = $('#screen');
  screenWidth = $screen.width();
  screenLeft  = $screen.position().left;
  optionsButton = $('#options-button');
  backButton = $('#back-button');
  pageCache[currentPage] = $screen.html();
});


function back() {
  if (powerOff === false) {
    if (pageHistory.length == 0) {
      if (!isFirstPage) {
        return changePage(defaultPage,true);
      }
      return false;
    } else {
      return changePage(pageHistory.pop(),true);
    }
  }
  return false;
}

function home() {
  if (powerOff !== false) {
    power();
  } else {
    pageHistory = [];
    changePage(defaultPage,true);
  }
}

function changePage(page,noPush) {
  if (page != currentPage) {
    isFirstPage = false;
    if (!noPush) {
      pageHistory.push((currentPage == '' ? defaultPage : currentPage));
    }
    if (!!pageCache[page]) {
      animateNewPage(pageCache[page]);
      currentPage = page;
    } else {
      $.get('index.php?page=' + page + '&ajax', function(data) {
        addToCache(page,data);
        animateNewPage(data);
        currentPage = page;
      });
    }
    return true;
  }
  return false;
}

function addToCache(page, data) {
  pageCache[page] = data;
}

var menuHeight = 0;
var menuUp = false;

function animateNewPage(data) {
  //$('#screen > .screen').animate({left: screenWidth, right: -screenWidth},500,function() {
  //$('#screen').html(data);
  
  $screen.fadeOut(100, function() {
    $screen.html(data);
    
    menu = $('#screen #menu');
    if (menu.length > 0) {
      optionsButton.addClass('has-menu');
    } else {
      optionsButton.removeClass('has-menu');
    }
    if (pageHistory.length == 0) {
      backButton.addClass('no-back');
    } else {
      backButton.removeClass('no-back');
    }
    
    $screen.fadeIn(200, function() {
      if (menu.length > 0) {
        menuHeight = menu.height();
        menu.css({bottom: -menuHeight, display: 'block'});
        menuUp = false;
      } else {
        menuHeight = 0;
      }
    });
  });
}

function toggleMenu() {
  console.log('toggle');
  if (menuHeight > 0) {
    if (menuUp) {
      $('#screen #menu').animate({bottom: -menuHeight}, 300);
      menuUp = false;
    } else {
      $('#screen #menu').animate({bottom: 0}, 300);
      menuUp = true;
    }
  }
}

function clickLink(page) {
  if (powerOff === false) {
    changePage(page,false);
  }
}

function power() {
  if (powerOff === false) {
    powerOff = currentPage;
    $('#phone').addClass('power-off');
  } else {
    changePage(powerOff,true);
    $('#phone').removeClass('power-off');
    powerOff = false;
  }
}
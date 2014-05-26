/*
Based on the demo of Recreating the Nikebetterworld.com Parallax Demo by Ian Lunn - http://www.ianlunn.co.uk/demos/recreate-nikebetterworld-parallax/
Author: David Cable and Jeff Rainey
Author URL: http://themespectrum.com/
Demo URL: http://themespectrum.com/parallax-demo

License: http://creativecommons.org/licenses/by-sa/3.0/ (Attribution Share Alike). 

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

;( function(){

  'use strict';

  var Parallax = function(){

    this._headerHeight = $("#header").height();
    this._windowHeight = $(window).height();

    this._bindEvents();

    this.resizePanel();
  };

  Parallax.prototype._bindEvents = function(){

    var that = this;

    $('.parallax-container').bind('inview', function ( event, visible ){

      $(this).toggleClass('inview', visible );
    });

    $( window ).resize( function(){ //if the user resizes the window...

      this._windowHeight = $(window).height();

      that.move(); //move the background images in relation to the movement of the scrollbar
      that.resizePanel();

    }).bind( 'scroll', function(){ //when the user is scrolling...

      this._windowHeight = $(window).height();

      that.move(); //move the background images in relation to the movement of the scrollbar
    });
  };

  //function that is called for every pixel the user scrolls. Determines the position of the background
  /*arguments:
   x = horizontal position of background
   windowHeight = height of the viewport
   pos = position of the scrollbar
   adjuster = adjust the position of the background
   inertia = how fast the background moves in relation to scrolling
   */
  Parallax.prototype._newPos = function( x, windowHeight, pos, adjuster, inertia ){
    return x + "% " + (-(( window.PARALLAX.height + pos) - adjuster) * inertia)  + "px";
  };

  Parallax.prototype._removeActive = function(){

    $("a.block-link.active").removeClass("active");
  };

  Parallax.prototype.resizePanel = function(){

    var panelHeight = ( ( this._windowHeight - this._headerHeight ) > window.PARALLAX.height ) ? ( this._windowHeight - this._headerHeight ) : window.PARALLAX.height;
    $('.parallax-container').height( panelHeight );
  };

  Parallax.prototype.move = function(){

    var pos = $(window).scrollTop(); //position of the scrollbar
    var blockAdjust = null;
    var firstBlockLink = null;
    var that = this;

    $('.parallax-container').each( function( i ){

      var blockAdjust = 0;

      $('#pixels').html( pos ); //display the number of pixels scrolled at the bottom of the page

      if( $(this).hasClass("inview") === true ) {

        $(this).css({
          'backgroundPosition': that._newPos( 50, this._windowHeight, pos, ( window.PARALLAX.height * ( i+1 ) ), 0.3 )
        }).find('.bg1').css({
          'backgroundPosition': that._newPos( 50, this._windowHeight, pos, ( window.PARALLAX.height * ( i+1 ) ) + window.PARALLAX.trainerBump, 0.6 )
        });
      }
    });

    var scrollPosition = $('body').scrollTop();
    var firstBlockId = $('.inview').first().attr('id');

    firstBlockLink = firstBlockId.replace("block","li#blockLink") + ' a' ;

    this._removeActive();

    $( firstBlockLink ).addClass("active");
  };

  $(document).ready(function(){

    new Parallax();
  });

} )();

//$(document).ready(function() { //when the document is ready...
//
//	//save selectors as variables to increase performance
//	var $window = $(window);
//	var windowHeight = $window.height(); //get the height of the window
//
//	//apply the class "inview" to a section that is in the viewport
//	$('.parallax-container').bind('inview', function (event, visible) {
//			if (visible == true) {
//			$(this).addClass("inview");
//			} else {
//			$(this).removeClass("inview");
//			}
//		});
//
//	function removeActive() {
//
//			$("a.block-link.active").removeClass("active");
//	}
//
//	//function that is called for every pixel the user scrolls. Determines the position of the background
//	/*arguments:
//		x = horizontal position of background
//		windowHeight = height of the viewport
//		pos = position of the scrollbar
//		adjuster = adjust the position of the background
//		inertia = how fast the background moves in relation to scrolling
//	*/
//	function newPos(x, windowHeight, pos, adjuster, inertia){
//		return x + "% " + (-(( window.PARALLAX.height + pos) - adjuster) * inertia)  + "px";
//	}
//
//	//function to be called whenever the window is scrolled or resized
//
//	function Move(){
//		var pos = $window.scrollTop(); //position of the scrollbar
//		var blockAdjust = null;
//		$('.parallax-container').each(function(i) {
//	    	var blockAdjust=0;
//	    	$('#pixels').html(pos); //display the number of pixels scrolled at the bottom of the page
//	    	if($(this).hasClass("inview"))
//	    	{
//	        	$(this).css({'backgroundPosition': newPos(50, windowHeight, pos, (window.PARALLAX.height * (i+1)), 0.3)});
//	        	$(this).find('.bg1').css({'backgroundPosition': newPos(50, windowHeight, pos, (window.PARALLAX.height * (i+1))+window.PARALLAX.trainerBump, 0.6)});
//	    	}
//		});
//		var scrollPosition = $("body").scrollTop();
//		var firstBlockId = $('.inview').first().attr('id');
//
//
//		firstBlockLink = firstBlockId.replace("block","li#blockLink") + ' a' ;
//		removeActive();
//		$(firstBlockLink).addClass("active");
//	};
//
//  /*
//   * Responsible for resizing the panels on resize of the panel
//   */
//  function ResizePanel(){
//
//    var headerHeight = $("#header").height();
//    var windowHeight = $window.height();
//    var panelHeight = ( ( windowHeight - headerHeight ) > window.PARALLAX.height ) ? ( windowHeight - headerHeight ) : window.PARALLAX.height;
//    $(".post").height( panelHeight );
//
//  };
//
//	ResizePanel();
//
//	$window.resize(function(){ //if the user resizes the window...
//		Move(); //move the background images in relation to the movement of the scrollbar
//    ResizePanel();
//	});
//
//	$window.bind('scroll', function(){ //when the user is scrolling...
//		Move(); //move the background images in relation to the movement of the scrollbar
//	});
//
//});
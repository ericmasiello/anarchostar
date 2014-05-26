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

;(function(){

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

      that._windowHeight = $(window).height();
      console.log( "Window height: " + that._windowHeight );
      that.resizePanel();
      that.move(); //move the background images in relation to the movement of the scrollbar

    }).bind( 'scroll', function(){ //when the user is scrolling...

      this._windowHeight = $(window).height();

      that.move(); //move the background images in relation to the movement of the scrollbar
    });
  };

  Parallax.prototype._removeActive = function(){

    $("a.block-link.active").removeClass("active");
  };

  Parallax.prototype.resizePanel = function(){

    var panelHeight = ( ( this._windowHeight - this._headerHeight ) > window.PARALLAX.height ) ? ( this._windowHeight - this._headerHeight ) : window.PARALLAX.height;
    console.log( "setting panel to:" + panelHeight );
    $('.parallax-container').height( panelHeight );
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

  Parallax.prototype.move = function(){

    var pos = $(window).scrollTop(); //position of the scrollbar
    var firstBlockLink = null;
    var that = this;

    $('.parallax-container').each( function( i ){

      //$('#pixels').html( pos );
      // display the number of pixels scrolled at the bottom of the page

      if( $(this).hasClass("inview") === true ) {

        //.find('.bg1') represent the extra image added, not the background image

        $(this).css({
          'minHeight': '0px',
          'backgroundPosition': that._newPos( 50, this._windowHeight, pos, ( window.PARALLAX.height * ( i+1 ) ), 0.3 )
        }).find('.bg1').css({
          'backgroundPosition': that._newPos( 50, this._windowHeight, pos, ( window.PARALLAX.height * ( i+1 ) ) + window.PARALLAX.trainerBump, 0.6 )
        });
      }
    });

    var firstBlockId = $('.inview').first().attr('id');

    firstBlockLink = firstBlockId.replace("block","li#blockLink") + ' a' ;

    this._removeActive();

    $( firstBlockLink ).addClass("active");
  };

  $(document).ready(function(){

    new Parallax();
  });

})();
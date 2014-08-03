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

  var Layout = function(){

    this._windowHeight = $(window).height();
    this._windowWidth = $(window).width();
    //90 = landscape, 180 = portrait
    this._baseOrientation = ( window.orientation < 0 ) ? window.orientation * -1 : window.orientation;

    this._setHeaderOffset();
    this._bindEvents();
    this.resizePanel();
  };

  /*
   * Apply top margin to page to make space for the header
   */
  Layout.prototype._setHeaderOffset = function(){

  };

  Layout.prototype._bindEvents = function(){

    var that = this;

    /*
     * Only bind parallax style events if we're on a non-mobile
     * device
     */
    if( window.ANARCHOSTAR.isMobile === false ){

      $('#container').localScroll({ offset: { left: 0 } });

      $('.parallax-container').bind('inview', function ( event, visible ){

        $(this).toggleClass('inview', visible );
      });

      $( window ).resize( function anarchoStarResize(){ //if the user resizes the window...

        var tmpHeaderHeight = $("#header").height();

        //that._headerHeight = $("#header").height();
        that._windowHeight = $(window).height();

        if( tmpHeaderHeight !== that._headerHeight ){

          that._headerHeight = tmpHeaderHeight;
          that._setHeaderOffset();
        }

        that.resizePanel();
        that.move(); //move the background images in relation to the movement of the scrollbar

      }).bind('scroll', function anarchoStarScroll(){ //when the user is scrolling...

        that.move(); //move the background images in relation to the movement of the scrollbar
      });

    } else {

      window.addEventListener('orientationchange', this.resizePanel.bind( this ) );
    }

  };

  Layout.prototype._orientationChange = function(){

    if( ( this._baseOrientation === undefined )
      || ( window.orientation === this._baseOrientation )
      || ( window.orientation === ( this._baseOrientation * -1 ) )
      || ( window.orientation === 0 && this._baseOrientation === 180 )
      || ( window.orientation === 180 && this._baseOrientation === 0 ) ){

      return false;

    } else {

      return true;
    }
  };

  Layout.prototype._removeActive = function(){

    $("a.block-link.active").removeClass("active");
  };

  Layout.prototype.resizePanel = function(){

    if( ( window.ANARCHOSTAR.isMobile === true )
      && ( this._orientationChange() === true ) ){

      var temp = this._windowHeight;
      this._windowHeight = this._windowWidth;
      this._windowWidth = temp;
    }

    $('.parallax-container').height( ( ( this._windowHeight ) > window.ANARCHOSTAR.height ) ? ( this._windowHeight ) : window.ANARCHOSTAR.height );
  };

  //function that is called for every pixel the user scrolls. Determines the position of the background
  /*arguments:
   x = horizontal position of background
   windowHeight = height of the viewport
   pos = position of the scrollbar
   adjuster = adjust the position of the background
   inertia = how fast the background moves in relation to scrolling
   */
  Layout.prototype._newPos = function( x, windowHeight, pos, adjuster, inertia ){

    return x + "% " + (-(( windowHeight + pos) - adjuster) * inertia)  + "px";
  };

  Layout.prototype.move = function(){

    var pos = $(window).scrollTop(); //position of the scrollbar
    var firstBlockLink;
    var firstBlockId;
    var that = this;

    $('.parallax-container').each( function( i ){

      //$('#pixels').html( pos );
      // display the number of pixels scrolled at the bottom of the page

      if( $(this).hasClass("inview") === true ) {

        //.find('.bg1') represent the extra image added, not the background image

        $(this).css({
          'minHeight': '0px',
          'backgroundPosition': that._newPos( 50, that._windowHeight, pos, ( that._windowHeight * ( i+1 ) ), 0.3 )
        }).find('.bg1').css({
          'backgroundPosition': that._newPos( 50, that._windowHeight, pos, ( that._windowHeight * ( i+1 ) ) + window.ANARCHOSTAR.trainerBump, 0.6 )
        });
      }
    });

    firstBlockId = $('.inview').first().attr('id');
    if( firstBlockId ){

      firstBlockLink = firstBlockId.replace("block","li#blockLink") + ' a' ;

      this._removeActive();

      $( firstBlockLink ).addClass("active");
    }

  };

  $(document).ready(function(){

    new Layout();
  });

})();
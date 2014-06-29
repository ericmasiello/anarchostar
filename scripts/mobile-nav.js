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

  var MAX_SIZE_S = 225;
  var MAX_SIZE_M = 300;
  var MQ_M = 768;
  var SPACER_SIZE = 10;

  var MobileNav = function(){

    this._$menuIcon = $(".js-menu-icon");
    this._$mobileNav = $("#footerNav");

    this._bindEvents();
  };

  MobileNav.prototype._bindEvents = function(){

    this._$menuIcon.on("click", this._toggleNav.bind( this ) );
    $(document).keyup(this._toggleNav.bind( this ));
  };

  MobileNav.prototype._toggleNav = function( e ){

    if( this._$mobileNav.is(":visible") === true
      && ( e.type === "click" || e.type === "keyup" && e.keyCode === 27 ) ){

      this._$mobileNav.hide();

    } else if( e.type === "click" ) {

      var windowWidth = $(document).width();
      var menuLength = this._$mobileNav.find(".menu-item").length;
      var size = ( windowWidth >= MQ_M ) ? (this._$mobileNav.width())/menuLength - ( SPACER_SIZE * (menuLength-1) ) : (this._$mobileNav.height())/menuLength  - ( SPACER_SIZE * (menuLength-1) );

      size = ( windowWidth >= MQ_M && size > MAX_SIZE_M ) ? MAX_SIZE_M : ( windowWidth < MQ_M && size > MAX_SIZE_S ? MAX_SIZE_S : size )
      //size = ( size > MAX_SIZE_S ) ? MAX_SIZE_S : size;
      this._$mobileNav.show().find(".menu-item").css({"height": size + 'px', "width": size + 'px'})
    }

  };

  $(document).ready(function(){

    new MobileNav();
  });

})();
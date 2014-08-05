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

  var CSS_OPEN_CLASS = "nav-is-open";

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

		var $body = $("body");

    if( $body.hasClass( CSS_OPEN_CLASS ) === true
      && ( e.type === "click" || e.type === "keyup" && e.keyCode === 27 ) ){

      this._$mobileNav.hide();

			$body.toggleClass( CSS_OPEN_CLASS );
      e.preventDefault()

    } else if( e.type === "click" ) {

      this._$mobileNav.show();

			$body.toggleClass( CSS_OPEN_CLASS );
      e.preventDefault()
    }
  };

  $(document).ready(function(){

    new MobileNav();
  });

})();
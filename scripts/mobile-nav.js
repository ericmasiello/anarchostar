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

  var MobileNav = function(){

    this._$menuIcon = $(".js-menu-icon");
    this._$mobileNav = $("#footerNav");

    this._bindEvents();
  };

  MobileNav.prototype._bindEvents = function(){

    this._$menuIcon.on("click", this._toggleNav.bind( this ) );
  };

  MobileNav.prototype._toggleNav = function(){

    if( this._$mobileNav.is(":visible") === true ){

      this._$mobileNav.hide();

    } else {

      var menuLength = this._$mobileNav.find(".menu-item").length;
      var size = (this._$mobileNav.show().height())/menuLength;
      this._$mobileNav.find(".menu-item").css({"height": size + 'px', "width": size + 'px'})
    }

  };

  $(document).ready(function(){

    new MobileNav();
  });

})();
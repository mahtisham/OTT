/*
 *  @author Interactive agency "Central marketing" http://iacm.ru
 *  @copyright Copyright (c) 2015, Interactive agency "Central marketing"	
 *  @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *  @version 1.0 at 24/02/2015 (13:45)
 *  
 *  checkit.js
 *  
 *  Useful jQuery plugin, which makes checking browsers, mobile devices, touch, flash and more — very simple.
 *  Easy connection to your project and high speed!
 *  
 *  @category jQuery plugin
 */
;(function($, window, document, undefined) {
	$(document).ready(function() {
		checkit = {
			/*
			 *  Browser
			 *  @example if (checkit.Browser.Chrome()) alert('Browser Chrome detected!');
			 */
			Browser: {
				Chrome: function() {
					return (navigator.userAgent.match(/Chrome/i) && navigator.vendor.match(/Google Inc/i));
				},
				Firefox: function() {
					return navigator.userAgent.match(/Firefox/i);
				},
				Opera: function() {
					return (navigator.userAgent.match(/Opera|OPR/i) && navigator.vendor.match(/Opera Software/i));
				},			
				Safari: function() {
					return (navigator.userAgent.match(/Safari/i) && navigator.vendor.match(/Apple Computer/i));
				},			
				YandexBrowser: function() {
					return (navigator.userAgent.match(/YaBrowser/i) && navigator.vendor.match(/Yandex/i));
				},
				Vivaldi: function() {
					return navigator.userAgent.match(/Vivaldi/i);
				},				    
				MSIE: {
					/*
					 *  Browser MS Internet Explorer (any versions)
					 *  @example if (checkit.Browser.MSIE.any()) alert('MSIE browser detected!');
					 */
					any: function() {
						return navigator.userAgent.match(/MSIE/i);
					},
					/*
					 *  Browser MS Internet Explorer (from 5.x to 10.x versions)
					 *  @example if (checkit.Browser.MSIE.v10()) alert('MSIE v10 browser detected!');
					 */	
					v10: function() {
						return document.all;
					},
					v9: function() {
						return document.all && !window.atob;
					},
					v8: function() {
						return document.all && !document.addEventListener;
					},			
					v7: function() {
						return document.all && !document.querySelector;
					},
					v6: function() {
						return document.all && !window.XMLHttpRequest;
					},
					v5: function() {
						return document.all && !document.compatMode;
					}
				},
				/*
				 *  Mobile specific browsers
				 *  @example if (checkit.Browser.IEMobile()) alert('IE Mobile browser detected!');
				*/
				MSIEMobile: function() {
					return navigator.userAgent.match(/IEMobile/i);
				},
				OperaMini: function() {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				UCBrowser: function() {
					return navigator.userAgent.match(/UCBrowser/i);
				},
				wOSBrowser: function() {
					return navigator.userAgent.match(/wOSBrowser|webOSBrowser/i);
				},
				/*
				 *  All WebKit browsers
				 *  @example if (checkit.Browser.WebKit()) alert('WebKit browser detected!');
				 */
				WebKit: function() {
					return (navigator.userAgent.match(/AppleWebKit|WebKit/i));
				}
			},
			/*
			 *  Mobile device
			 *  @example if (checkit.Mobile.Android()) alert('Android mobile device detected!');
			 */
			Mobile: {
				Android: function() {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function() {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function() {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				WindowsPhone: function() {
					return navigator.userAgent.match(/Windows Phone/i);				
				},
				webOS: function() {
					return navigator.userAgent.match(/webOS/i);
				},
				any: function() {
					return navigator.userAgent.match(/Mobi/i);
				}
			},
			/*
			 *  Support HTML5
			 *  @example if (checkit.HTML5()) alert('Your browser support HTML5!');
			*/
			HTML5: function() {
			    return (document.createElement('canvas').getContext && document.createElement('canvas').getContext('2d'));
			},
			/*
			 *  Support CSS3
			 *  @example if (checkit.CSS3()) alert('Your browser support CSS3!');
			 */
			CSS3: function() {
			    return (document.body.style.transition !== undefined);
			},
			/*
			 *  Flash player installed and enabled
			 *  @example if (checkit.Flash()) alert('Flash player installed and enabled!');
			 */
			Flash: function() {
			    return (navigator.mimeTypes && navigator.mimeTypes['application/x-shockwave-flash'] !== undefined && navigator.mimeTypes['application/x-shockwave-flash'].enabledPlugin);
			},
			/*
			 *  Support touch events
			 *  @example if (checkit.Touch()) alert('Device supported touch events!');
			 */
			Touch: function() {
				return (('ontouchstart' in window) || (navigator.MaxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
			}
		};
	});
})(jQuery, window, document);

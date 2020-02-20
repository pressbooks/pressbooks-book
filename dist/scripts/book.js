/*! For license information please see book.js.LICENSE */
!function(t){var e={};function n(o){if(e[o])return e[o].exports;var r=e[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,o){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(o,r,function(e){return t[e]}.bind(null,r));return o},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=0)}({0:function(t,e,n){n("oy8a"),n("nTgg"),t.exports=n("7++m")},"7++m":function(t,e){},nTgg:function(t,e){},oy8a:function(t,e,n){"use strict";n.r(e);var o=function(t){return"".concat(t.charAt(0).toLowerCase()).concat(t.replace(/[\W_]/g,"|").split("|").map((function(t){return"".concat(t.charAt(0).toUpperCase()).concat(t.slice(1))})).join("").slice(1))};function r(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}var i=function(){function t(e){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.routes=e}var e,n,i;return e=t,(n=[{key:"fire",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"init",n=arguments.length>2?arguments[2]:void 0,o=""!==t&&this.routes[t]&&"function"==typeof this.routes[t][e];o&&this.routes[t][e](n)}},{key:"loadEvents",value:function(){var t=this;this.fire("common"),document.body.className.toLowerCase().replace(/-/g,"_").split(/\s+/).map(o).forEach((function(e){t.fire(e),t.fire(e,"finalize")})),this.fire("common","finalize")}}])&&r(e.prototype,n),i&&r(e,i),t}(),a=(n("p46w"),new i({common:{init:function(){var t,e,n;document.body.classList.remove("no-js"),document.body.classList.add("js"),function(){for(var t=document.getElementsByTagName("section"),e=0,n=t.length;e<n;e++)t[e].setAttribute("tabindex",-1),t[e].className+=" focusable"}(),jQuery((function(t){t.localScroll.hash({duration:0}),t.localScroll({hash:!0,duration:0,onBefore:function(t,e){var n=e.closest("div[hidden]");if(n){n.hidden=!1;var o=n.previousElementSibling,r=o.querySelector("button");o.setAttribute("data-collapsed",!1),r.setAttribute("aria-expanded",!0)}}})})),document.querySelector(".js-header-nav-toggle").addEventListener("click",(function(t){t.preventDefault(),document.querySelector(".header__nav").classList.toggle("header__nav--active")})),t=document.querySelectorAll(".dropdown > p, .dropdown > div.reading-header__toc__title"),Array.prototype.forEach.call(t,(function(t){t.innerHTML='\n\t\t\t\t<button type="button" aria-expanded="false">\n\t\t\t\t\t'.concat(t.innerHTML,'\n\t\t\t\t\t<svg role="img" class="arrow" width="13" height="8" viewBox="0 0 13 8" xmlns="http://www.w3.org/2000/svg"><path d="M6.255 8L0 0h12.51z" fill="currentColor" fill-rule="evenodd"></path></svg>\n\t\t\t\t</button>\n\t\t\t\t');var e=t.nextElementSibling;e.hidden=!0;var n=t.querySelector("button"),o=t.querySelector("button > .arrow"),r=e.querySelectorAll("a");Array.prototype.forEach.call(r,(function(t){t.onblur=function(o){t===r[r.length-1]&&"LI"!==o.relatedTarget.parentNode.nodeName&&(n.setAttribute("aria-expanded",!1),e.hidden=!0)}}));var i=jQuery("button[aria-expanded] > svg"),a=jQuery("button[aria-expanded]");jQuery(a,i).click((function(t){var r="true"===n.getAttribute("aria-expanded")||!1;n===t.target||o===t.target?(n.setAttribute("aria-expanded",!r),e.hidden=r):(n.setAttribute("aria-expanded",!1),e.hidden=!0)})),document.onclick=function(t){var o=jQuery(t.target),r=jQuery(".".concat("book-header__cover__downloads")).find("button");0===r.length||o.closest("div").hasClass("book-header__cover__downloads")||o.hasClass("dropdown-item")||"true"===r.attr("aria-expanded")&&(n.setAttribute("aria-expanded",!1),e.hidden=!0)},document.onkeydown=function(t){27!==t.which||e.hidden||(n.setAttribute("aria-expanded",!1),e.hidden=!0)}})),e=document.querySelectorAll(".toc__part--full > .toc__title, .toc__chapter--full > .toc__title, .toc__front-matter--full > .toc__title, .toc__back-matter--full > .toc__title"),n=document.body.classList.contains("home"),Array.prototype.forEach.call(e,(function(t){var e=!!(n&&t.parentNode.classList.contains("toc__part")||!n&&t.parentNode.classList.contains("toc__parent")),o="".concat(pressbooksBook.toggle_contents," '").concat(t.innerText,"'");t.innerHTML="\n\t\t\t\t<span>".concat(t.innerHTML,'</span>\n\t\t\t\t<button type="button" aria-expanded="').concat(e,'" aria-label="').concat(o,'">\n\t\t\t\t\t<svg viewBox="0 0 9 9" aria-hidden="true" focusable="false">\n\t\t\t\t\t\t<rect class="vert" height="7" width="1" y="1" x="4" />\n\t\t\t\t\t\t<rect height="1" width="7" y="4" x="1" />\n\t\t\t\t\t</svg>\n\t\t\t\t</button>\n\t\t\t\t');var r=t.nextElementSibling;!1===e||!n&&!t.parentNode.classList.contains("toc__parent")?r.hidden=!0:n&&t.parentNode.classList.contains("toc__parent")&&(r.hidden=!1);var i=t.querySelector("button");i.onclick=function(){var t="true"===i.getAttribute("aria-expanded")||!1;i.setAttribute("aria-expanded",!t),r.hidden=t}})),jQuery((function(t){var e=t(".h5p-row-item"),n=t(".h5p-activity-container");n.hide(),t("#h5p-show-hide").text(t("#h5p-show-hide").attr("show-all-text")),t(".h5p-row-item").text(t(".h5p-row-item").attr("show-activity-text")),e.click((function(){t(this).text()===t(this).attr("show-activity-text")?(n.hide(),t(this).closest("tr").next(this).show("slow"),t(this).text(t(this).attr("hide-activity-text"))):(t(this).closest("tr").next(this).hide(),t(this).text(t(this).attr("show-activity-text")))})),t("#h5p-show-hide").click((function(){t(this).text()===t(this).attr("show-all-text")?(n.show(),t(this).text(t(this).attr("hide-all-text")),t(".h5p-row-item").text(t(".h5p-row-item").attr("hide-activity-text"))):(n.hide(),t(this).text(t(this).attr("show-all-text")),t(".h5p-row-item").text(t(".h5p-row-item").attr("show-activity-text")))}))}))},finalize:function(){}},home:{init:function(){jQuery((function(t){t(document.body).on("click",".js-toggle-block",(function(e){var n=t(this);n.parents(".js-block").toggleClass("block-toggle--visible"),n.toggleClass("--visible")})),t(document.body).on("click",".toc__toggle #show",(function(e){var n=t(this);t('.toc [class*="--full"]').each((function(e){t(this).find("button").attr("aria-expanded","true"),t(this).find("ol").removeAttr("hidden")})),n.parents(".toc__toggle").attr("aria-expanded","true")})),t(document.body).on("click",".toc__toggle #hide",(function(e){var n=t(this);t('.toc [class*="--full"]').each((function(e){t(this).find("button").attr("aria-expanded","false"),t(this).find("ol").attr("hidden","true")})),n.parents(".toc__toggle").attr("aria-expanded","false")}))}))},finalize:function(){}},single:{init:function(){jQuery((function(t){var e=t(".block-reading-meta__compare__toggle");e.click((function(n){var o=t(".block-reading-meta__compare__activity"),r=t(".alert"),i=t(".block-reading-meta__compare__comparison"),a=t(".block-reading-meta__compare__stats"),c=t(".block-reading-meta__compare__current");if(r.addClass("visually-hidden"),"false"===t(n.currentTarget).attr("aria-expanded"))if(e.attr("aria-expanded",!0),o.removeAttr("hidden"),i.hasClass("populated"))i.removeAttr("hidden"),o.attr("hidden",!0);else{r.text(pressbooksBook.comparison_loading);var s=c.html(),d=c.attr("data-source-endpoint");fetch(d).then((function(e){if(200!==e.status)return r.addClass("alert--error").removeClass("visually-hidden").text(pressbooksBook.chapter_not_loaded),void o.attr("hidden",!0);e.json().then((function(e){var n=t("<div>"+e.content.raw+"</div>").html();t.post(pressbooksBook.ajaxurl,{action:"text_diff",security:pressbooksBook.text_diff_nonce,left:n,right:s},(function(e){if(!0===e.success){var n=JSON.parse(e.data);i.append(n),i.children("table");var c=t(".diff del").length,s=t(".diff ins").length;a.children("ins").children(".num").text(s),a.children("del ").children(".num").text(c),o.attr("hidden",!0),r.text(pressbooksBook.comparison_loaded),i.removeAttr("hidden")}}))}))})).catch((function(t){r.addClass("alert--error").removeClass("visually-hidden").text(pressbooksBook.chapter_not_loaded),o.attr("hidden",!0)}))}else e.attr("aria-expanded",!1),i.attr("hidden",!0),t(".diff").remove()})),t(document).ready((function(){var e,n;t(window).scroll((function(){t(window).scrollTop()>250&&t(".nav-reading__up").animate({opacity:1},0),t(window).scrollTop()<250&&t(".nav-reading__up").animate({opacity:0},0)})),t(".nav-reading__up").click((function(e){return e.preventDefault(),t(".nav-reading__up").blur().animate({opacity:0},0),t("html, body").animate({scrollTop:0},0),!1})),t(document).keydown((function(e){if(!t("body").hasClass("no-navigation")){var n=!1;37===e.which?n=t(".nav-previous a, .js-nav-previous a").attr("href"):39===e.which&&(n=t(".nav-next a, .js-nav-next a").attr("href")),n&&!t("textarea, input").is(":focus")&&(window.location=n)}})),e=t("iframe[src*='//player.vimeo.com'], iframe[src*='//www.youtube.com']"),n=t("#content"),e.each((function(){t(this).data("aspectRatio",this.height/this.width).removeAttr("height").removeAttr("width")})),t(window).resize((function(){var o=n.width();e.each((function(){var e=t(this);e.width(o).height(o*e.data("aspectRatio"))}))})).resize()}))}))},finalize:function(){}}}));jQuery(document).ready((function(){return a.loadEvents()}))},p46w:function(t,e,n){var o,r;!function(i){if(void 0===(r="function"==typeof(o=i)?o.call(e,n,e,t):o)||(t.exports=r),!0,t.exports=i(),!!0){var a=window.Cookies,c=window.Cookies=i();c.noConflict=function(){return window.Cookies=a,c}}}((function(){function t(){for(var t=0,e={};t<arguments.length;t++){var n=arguments[t];for(var o in n)e[o]=n[o]}return e}function e(t){return t.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}return function n(o){function r(){}function i(e,n,i){if("undefined"!=typeof document){"number"==typeof(i=t({path:"/"},r.defaults,i)).expires&&(i.expires=new Date(1*new Date+864e5*i.expires)),i.expires=i.expires?i.expires.toUTCString():"";try{var a=JSON.stringify(n);/^[\{\[]/.test(a)&&(n=a)}catch(t){}n=o.write?o.write(n,e):encodeURIComponent(String(n)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),e=encodeURIComponent(String(e)).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var c="";for(var s in i)i[s]&&(c+="; "+s,!0!==i[s]&&(c+="="+i[s].split(";")[0]));return document.cookie=e+"="+n+c}}function a(t,n){if("undefined"!=typeof document){for(var r={},i=document.cookie?document.cookie.split("; "):[],a=0;a<i.length;a++){var c=i[a].split("="),s=c.slice(1).join("=");n||'"'!==s.charAt(0)||(s=s.slice(1,-1));try{var d=e(c[0]);if(s=(o.read||o)(s,d)||e(s),n)try{s=JSON.parse(s)}catch(t){}if(r[d]=s,t===d)break}catch(t){}}return t?r[t]:r}}return r.set=i,r.get=function(t){return a(t,!1)},r.getJSON=function(t){return a(t,!0)},r.remove=function(e,n){i(e,"",t(n,{expires:-1}))},r.defaults={},r.withConverter=n,r}((function(){}))}))}});
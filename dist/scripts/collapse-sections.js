!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=1)}({1:function(t,e,n){t.exports=n("nk2R")},nk2R:function(t,e){document.addEventListener("DOMContentLoaded",function(){var t=document.querySelectorAll("#content section > h1");Array.prototype.forEach.call(t,function(t){t.innerHTML='\n\t\t<button aria-expanded="false" class="button--text">\n\t\t  '+t.textContent+'\n\t\t  <svg aria-hidden="true" focusable="false" viewBox="0 0 10 10">\n\t\t\t<rect class="vert" height="8" width="2" y="1" x="4"/>\n\t\t\t<rect height="2" width="8" y="4" x="1"/>\n\t\t  </svg>\n\t\t</button>',t.setAttribute("data-collapsed","true");var e=function(t){for(var e=[];t.nextElementSibling&&"H1"!==t.nextElementSibling.tagName;)e.push(t.nextElementSibling),t=t.nextElementSibling;return e.forEach(function(t){t.parentNode.removeChild(t)}),e}(t),n=document.createElement("div");n.hidden=!0,e.forEach(function(t){n.appendChild(t)}),t.parentNode.insertBefore(n,t.nextElementSibling);var r=t.querySelector("button");r.onclick=function(){var e="true"===r.getAttribute("aria-expanded")||!1;r.setAttribute("aria-expanded",!e),t.setAttribute("data-collapsed",e),n.hidden=e}})})}});
!function(t){var n={};function e(o){if(n[o])return n[o].exports;var r=n[o]={i:o,l:!1,exports:{}};return t[o].call(r.exports,r,r.exports,e),r.l=!0,r.exports}e.m=t,e.c=n,e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:o})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="",e(e.s=1)}({1:function(t,n,e){t.exports=e("EDja")},EDja:function(t,n){window.hypothesisConfig=function(){return{onLayoutChange:function(t){var n=document.querySelector(".nav-reading");!0===t.expanded?(document.body.classList.add("has-annotator-pane"),document.body.clientWidth-t.width>400&&(document.body.style.marginRight=t.width-32+"px",n.style.width=document.body.clientWidth+"px")):(document.body.classList.remove("has-annotator-pane"),document.body.style.marginRight="0",n.style.width="100vw")}}}}});
!function(e){var t={};function n(r){if(t[r])return t[r].exports;var i=t[r]={i:r,l:!1,exports:{}};return e[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:r})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}({0:function(e,t,n){n("3lY/"),n("vABE"),e.exports=n("vGem")},"3lY/":function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var r=n("gAzQ"),i=function(e){return""+e.charAt(0).toLowerCase()+e.replace(/[\W_]/g,"|").split("|").map(function(e){return""+e.charAt(0).toUpperCase()+e.slice(1)}).join("").slice(1)},o=function(){function e(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}return function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}}();var a=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.routes=t}return o(e,[{key:"fire",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"init",n=arguments[2],r=""!==e&&this.routes[e]&&"function"==typeof this.routes[e][t];r&&this.routes[e][t](n)}},{key:"loadEvents",value:function(){var e=this;this.fire("common"),document.body.className.toLowerCase().replace(/-/g,"_").split(/\s+/).map(i).forEach(function(t){e.fire(t),e.fire(t,"finalize")}),this.fire("common","finalize")}}]),e}(),s=n("lbHh"),l=new a({common:{init:function(){var e,t,n;jQuery(function(e){e("body").removeClass("no-js").addClass("js"),e(document).ready(function(){"1"===s.get("a11y-larger-fontsize")&&(e("html").addClass("fontsize"),e("#is_normal_fontsize").attr("id","is_large_fontsize").attr("aria-checked",!0).addClass("active").text(PB_A11y.decrease_label).attr("title",PB_A11y.decrease_label)),e(".toggle-fontsize").on("click",function(){return"is_normal_fontsize"===e(this).attr("id")?(e("html").addClass("fontsize"),e(this).attr("id","is_large_fontsize").attr("aria-checked",!0).addClass("active").text(PB_A11y.decrease_label).attr("title",PB_A11y.decrease_label),e(".nav-reading").removeAttr("style"),s.set("a11y-larger-fontsize","1",{expires:365,path:PB_A11y.home_path}),!1):(e("html").removeClass("fontsize"),e(this).attr("id","is_normal_fontsize").removeAttr("aria-checked").removeClass("active").text(PB_A11y.increase_label).attr("title",PB_A11y.increase_label),e(".nav-reading").removeAttr("style"),s.set("a11y-larger-fontsize","0",{expires:365,path:PB_A11y.home_path}),!1)});for(var t=document.getElementsByTagName("section"),n=0,r=t.length;n<r;n++)t[n].setAttribute("tabindex",-1),t[n].className+=" focusable";if(document.location.hash&&"#"!==document.location.hash){var i=document.location.hash;setTimeout(function(){e(i).scrollTo({duration:1500}),e(i).focus()},100)}}),e(".js-header-nav-toggle").click(function(t){t.preventDefault(),e(".header__nav").toggleClass("header__nav--active")})}),e=document.querySelectorAll(".dropdown > h3"),Array.prototype.forEach.call(e,function(e){e.innerHTML='\n\t\t\t\t<button type="button" aria-expanded="false">\n\t\t\t\t\t'+e.innerHTML+'\n\t\t\t\t\t<svg role="img" class="arrow" width="13" height="8" viewBox="0 0 13 8" xmlns="http://www.w3.org/2000/svg"><path d="M6.255 8L0 0h12.51z" fill="currentColor" fill-rule="evenodd"></path></svg>\n\t\t\t\t</button>\n\t\t\t  ';var t=e.nextElementSibling;e.parentNode.classList.contains("toc__parent")||(t.hidden=!0);var n=e.querySelector("button");n.onclick=function(){var e="true"===n.getAttribute("aria-expanded")||!1;n.setAttribute("aria-expanded",!e),t.hidden=e}}),t=document.querySelectorAll(".toc__part--full > .toc__title, .toc__chapter--full > .toc__title, .toc__front-matter--full > .toc__title, .toc__back-matter--full > .toc__title"),n=document.body.classList.contains("home"),Array.prototype.forEach.call(t,function(e){var t=!(!n||!e.parentNode.classList.contains("toc__part"));e.innerHTML="\n\t\t\t\t<span>"+e.innerHTML+'</span>\n\t\t\t\t<button type="button" aria-expanded="'+t+'">\n\t\t\t\t\t<span class="screen-reader-text">'+e.innerHTML+'</span>\n\t\t\t\t\t<svg viewBox="0 0 9 9" aria-hidden="true" focusable="false">\n\t\t\t\t\t\t<rect class="vert" height="7" width="1" y="1" x="4" />\n\t\t\t\t\t\t<rect height="1" width="7" y="4" x="1" />\n\t\t\t\t\t</svg>\n\t\t\t\t</button>\n\t\t\t  ';var r=e.nextElementSibling;!1!==t&&(n||e.parentNode.classList.contains("toc__parent"))||(r.hidden=!0);var i=e.querySelector("button");i.onclick=function(){var e="true"===i.getAttribute("aria-expanded")||!1;i.setAttribute("aria-expanded",!e),r.hidden=e}})},finalize:function(){}},home:{init:function(){jQuery(function(e){e(document.body).on("click",".js-toggle-block",function(t){var n=e(this);n.parents(".js-block").toggleClass("block-toggle--visible"),n.toggleClass("--visible")}),e(document.body).on("click",".toc__toggle #show",function(t){var n=e(this);e('.toc [class*="--full"]').each(function(t){e(this).find("button").attr("aria-expanded","true"),e(this).find("ol").removeAttr("hidden")}),n.parents(".toc__toggle").attr("aria-expanded","true")}),e(document.body).on("click",".toc__toggle #hide",function(t){var n=e(this);e('.toc [class*="--full"]').each(function(t){e(this).find("button").attr("aria-expanded","false"),e(this).find("ol").attr("hidden","true")}),n.parents(".toc__toggle").attr("aria-expanded","false")})})},finalize:function(){}},single:{init:function(){jQuery(function(e){var t=e(".block-reading-meta__compare__toggle");t.click(function(n){var i=e(".block-reading-meta__compare__activity"),o=e(".alert"),a=e(".block-reading-meta__compare__comparison"),s=e(".block-reading-meta__compare__stats"),l=e(".block-reading-meta__compare__diff");if(o.addClass("visually-hidden"),"false"===e(n.currentTarget).attr("aria-expanded"))if(t.attr("aria-expanded",!0),i.removeAttr("hidden"),l.hasClass("populated"))a.removeAttr("hidden "),i.attr("hidden",!0);else{o.text(PB_A11y.comparison_loading);var u=l.html(),d=l.attr("data-source-endpoint");fetch(d).then(function(t){if(200!==t.status)return o.addClass("alert--error").removeClass("visually-hidden").text(PB_A11y.chapter_not_loaded),void i.attr("hidden",!0);t.json().then(function(t){var n=e("<div>"+t.content.raw+"</div>").html(),d=Object(r.diffWords)(n,u),c=document.createDocumentFragment();d.forEach(function(e){var t=e.added?"ins":e.removed?"del":"span",n=document.createElement(t);n.appendChild(document.createTextNode(e.value)),c.appendChild(n)}),l.html(c),l.addClass("populated");var f=l.children("del").length,h=l.children("ins").length;s.children("ins").children(".num").text(h),s.children("del ").children(".num").text(f),i.attr("hidden",!0),o.text(PB_A11y.comparison_loaded),a.removeAttr("hidden")})}).catch(function(e){o.addClass("alert--error").removeClass("visually-hidden").text(PB_A11y.chapter_not_loaded),i.attr("hidden",!0)})}else t.attr("aria-expanded",!1),a.attr("hidden",!0)}),e(document).ready(function(){e(window).scroll(function(){e(window).scrollTop()>250&&e(".nav-reading__up").animate({opacity:1},300),e(window).scrollTop()<250&&e(".nav-reading__up").animate({opacity:0},300)}),e(".nav-reading__up").click(function(t){return t.preventDefault(),e(".nav-reading__up").blur().animate({opacity:0},300),e("html, body").animate({scrollTop:0},300),!1}),e(document).keydown(function(t){if(!e("body").hasClass("no-navigation")){var n=!1;37===t.which?n=e(".nav-previous a, .js-nav-previous a").attr("href"):39===t.which&&(n=e(".nav-next a, .js-nav-next a").attr("href")),n&&!e("textarea, input").is(":focus")&&(window.location=n)}})})})},finalize:function(){}}});jQuery(document).ready(function(){return l.loadEvents()})},gAzQ:function(e,t,n){var r;r=function(){return function(e){var t={};function n(r){if(t[r])return t[r].exports;var i=t[r]={exports:{},id:r,loaded:!1};return e[r].call(i.exports,i,i.exports,n),i.loaded=!0,i.exports}return n.m=e,n.c=t,n.p="",n(0)}([function(e,t,n){"use strict";t.__esModule=!0,t.canonicalize=t.convertChangesToXML=t.convertChangesToDMP=t.merge=t.parsePatch=t.applyPatches=t.applyPatch=t.createPatch=t.createTwoFilesPatch=t.structuredPatch=t.diffArrays=t.diffJson=t.diffCss=t.diffSentences=t.diffTrimmedLines=t.diffLines=t.diffWordsWithSpace=t.diffWords=t.diffChars=t.Diff=void 0;var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r},a=n(2),s=n(3),l=n(5),u=n(6),d=n(7),c=n(8),f=n(9),h=n(10),p=n(11),v=n(13),m=n(14),g=n(16),_=n(17);t.Diff=o.default,t.diffChars=a.diffChars,t.diffWords=s.diffWords,t.diffWordsWithSpace=s.diffWordsWithSpace,t.diffLines=l.diffLines,t.diffTrimmedLines=l.diffTrimmedLines,t.diffSentences=u.diffSentences,t.diffCss=d.diffCss,t.diffJson=c.diffJson,t.diffArrays=f.diffArrays,t.structuredPatch=m.structuredPatch,t.createTwoFilesPatch=m.createTwoFilesPatch,t.createPatch=m.createPatch,t.applyPatch=h.applyPatch,t.applyPatches=h.applyPatches,t.parsePatch=p.parsePatch,t.merge=v.merge,t.convertChangesToDMP=g.convertChangesToDMP,t.convertChangesToXML=_.convertChangesToXML,t.canonicalize=c.canonicalize},function(e,t){"use strict";function n(){}function r(e,t,n,r,i){for(var o=0,a=t.length,s=0,l=0;o<a;o++){var u=t[o];if(u.removed){if(u.value=e.join(r.slice(l,l+u.count)),l+=u.count,o&&t[o-1].added){var d=t[o-1];t[o-1]=t[o],t[o]=d}}else{if(!u.added&&i){var c=n.slice(s,s+u.count);c=c.map(function(e,t){var n=r[l+t];return n.length>e.length?n:e}),u.value=e.join(c)}else u.value=e.join(n.slice(s,s+u.count));s+=u.count,u.added||(l+=u.count)}}var f=t[a-1];return a>1&&"string"==typeof f.value&&(f.added||f.removed)&&e.equals("",f.value)&&(t[a-2].value+=f.value,t.pop()),t}t.__esModule=!0,t.default=n,n.prototype={diff:function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},i=n.callback;"function"==typeof n&&(i=n,n={}),this.options=n;var o=this;function a(e){return i?(setTimeout(function(){i(void 0,e)},0),!0):e}e=this.castInput(e),t=this.castInput(t),e=this.removeEmpty(this.tokenize(e));var s=(t=this.removeEmpty(this.tokenize(t))).length,l=e.length,u=1,d=s+l,c=[{newPos:-1,components:[]}],f=this.extractCommon(c[0],t,e,0);if(c[0].newPos+1>=s&&f+1>=l)return a([{value:this.join(t),count:t.length}]);function h(){for(var n=-1*u;n<=u;n+=2){var i=void 0,d=c[n-1],f=c[n+1],h=(f?f.newPos:0)-n;d&&(c[n-1]=void 0);var p=d&&d.newPos+1<s,v=f&&0<=h&&h<l;if(p||v){if(!p||v&&d.newPos<f.newPos?(i={newPos:(m=f).newPos,components:m.components.slice(0)},o.pushComponent(i.components,void 0,!0)):((i=d).newPos++,o.pushComponent(i.components,!0,void 0)),h=o.extractCommon(i,t,e,n),i.newPos+1>=s&&h+1>=l)return a(r(o,i.components,t,e,o.useLongestToken));c[n]=i}else c[n]=void 0}var m;u++}if(i)!function e(){setTimeout(function(){if(u>d)return i();h()||e()},0)}();else for(;u<=d;){var p=h();if(p)return p}},pushComponent:function(e,t,n){var r=e[e.length-1];r&&r.added===t&&r.removed===n?e[e.length-1]={count:r.count+1,added:t,removed:n}:e.push({count:1,added:t,removed:n})},extractCommon:function(e,t,n,r){for(var i=t.length,o=n.length,a=e.newPos,s=a-r,l=0;a+1<i&&s+1<o&&this.equals(t[a+1],n[s+1]);)a++,s++,l++;return l&&e.components.push({count:l}),e.newPos=a,s},equals:function(e,t){return this.options.comparator?this.options.comparator(e,t):e===t||this.options.ignoreCase&&e.toLowerCase()===t.toLowerCase()},removeEmpty:function(e){for(var t=[],n=0;n<e.length;n++)e[n]&&t.push(e[n]);return t},castInput:function(e){return e},tokenize:function(e){return e.split("")},join:function(e){return e.join("")}}},function(e,t,n){"use strict";t.__esModule=!0,t.characterDiff=void 0,t.diffChars=function(e,t,n){return a.diff(e,t,n)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r};var a=t.characterDiff=new o.default},function(e,t,n){"use strict";t.__esModule=!0,t.wordDiff=void 0,t.diffWords=function(e,t,n){return n=(0,a.generateOptions)(n,{ignoreWhitespace:!0}),u.diff(e,t,n)},t.diffWordsWithSpace=function(e,t,n){return u.diff(e,t,n)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r},a=n(4);var s=/^[A-Za-z\xC0-\u02C6\u02C8-\u02D7\u02DE-\u02FF\u1E00-\u1EFF]+$/,l=/\S/,u=t.wordDiff=new o.default;u.equals=function(e,t){return this.options.ignoreCase&&(e=e.toLowerCase(),t=t.toLowerCase()),e===t||this.options.ignoreWhitespace&&!l.test(e)&&!l.test(t)},u.tokenize=function(e){for(var t=e.split(/(\s+|\b)/),n=0;n<t.length-1;n++)!t[n+1]&&t[n+2]&&s.test(t[n])&&s.test(t[n+2])&&(t[n]+=t[n+2],t.splice(n+1,2),n--);return t}},function(e,t){"use strict";t.__esModule=!0,t.generateOptions=function(e,t){if("function"==typeof e)t.callback=e;else if(e)for(var n in e)e.hasOwnProperty(n)&&(t[n]=e[n]);return t}},function(e,t,n){"use strict";t.__esModule=!0,t.lineDiff=void 0,t.diffLines=function(e,t,n){return s.diff(e,t,n)},t.diffTrimmedLines=function(e,t,n){var r=(0,a.generateOptions)(n,{ignoreWhitespace:!0});return s.diff(e,t,r)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r},a=n(4);var s=t.lineDiff=new o.default;s.tokenize=function(e){var t=[],n=e.split(/(\n|\r\n)/);n[n.length-1]||n.pop();for(var r=0;r<n.length;r++){var i=n[r];r%2&&!this.options.newlineIsToken?t[t.length-1]+=i:(this.options.ignoreWhitespace&&(i=i.trim()),t.push(i))}return t}},function(e,t,n){"use strict";t.__esModule=!0,t.sentenceDiff=void 0,t.diffSentences=function(e,t,n){return a.diff(e,t,n)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r};var a=t.sentenceDiff=new o.default;a.tokenize=function(e){return e.split(/(\S.+?[.!?])(?=\s+|$)/)}},function(e,t,n){"use strict";t.__esModule=!0,t.cssDiff=void 0,t.diffCss=function(e,t,n){return a.diff(e,t,n)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r};var a=t.cssDiff=new o.default;a.tokenize=function(e){return e.split(/([{}:;,]|\s+)/)}},function(e,t,n){"use strict";t.__esModule=!0,t.jsonDiff=void 0;var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e};t.diffJson=function(e,t,n){return u.diff(e,t,n)},t.canonicalize=d;var i,o=n(1),a=(i=o)&&i.__esModule?i:{default:i},s=n(5);var l=Object.prototype.toString,u=t.jsonDiff=new a.default;function d(e,t,n,i,o){t=t||[],n=n||[],i&&(e=i(o,e));var a=void 0;for(a=0;a<t.length;a+=1)if(t[a]===e)return n[a];var s=void 0;if("[object Array]"===l.call(e)){for(t.push(e),s=new Array(e.length),n.push(s),a=0;a<e.length;a+=1)s[a]=d(e[a],t,n,i,o);return t.pop(),n.pop(),s}if(e&&e.toJSON&&(e=e.toJSON()),"object"===(void 0===e?"undefined":r(e))&&null!==e){t.push(e),s={},n.push(s);var u=[],c=void 0;for(c in e)e.hasOwnProperty(c)&&u.push(c);for(u.sort(),a=0;a<u.length;a+=1)s[c=u[a]]=d(e[c],t,n,i,c);t.pop(),n.pop()}else s=e;return s}u.useLongestToken=!0,u.tokenize=s.lineDiff.tokenize,u.castInput=function(e){var t=this.options,n=t.undefinedReplacement,r=t.stringifyReplacer,i=void 0===r?function(e,t){return void 0===t?n:t}:r;return"string"==typeof e?e:JSON.stringify(d(e,null,null,i),i,"  ")},u.equals=function(e,t){return a.default.prototype.equals.call(u,e.replace(/,([\r\n])/g,"$1"),t.replace(/,([\r\n])/g,"$1"))}},function(e,t,n){"use strict";t.__esModule=!0,t.arrayDiff=void 0,t.diffArrays=function(e,t,n){return a.diff(e,t,n)};var r,i=n(1),o=(r=i)&&r.__esModule?r:{default:r};var a=t.arrayDiff=new o.default;a.tokenize=function(e){return e.slice()},a.join=a.removeEmpty=function(e){return e}},function(e,t,n){"use strict";t.__esModule=!0,t.applyPatch=s,t.applyPatches=function(e,t){"string"==typeof e&&(e=(0,i.parsePatch)(e));var n=0;!function r(){var i=e[n++];if(!i)return t.complete();t.loadFile(i,function(e,n){if(e)return t.complete(e);var o=s(n,i,t);t.patched(i,o,function(e){if(e)return t.complete(e);r()})})}()};var r,i=n(11),o=n(12),a=(r=o)&&r.__esModule?r:{default:r};function s(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};if("string"==typeof t&&(t=(0,i.parsePatch)(t)),Array.isArray(t)){if(t.length>1)throw new Error("applyPatch only works with a single input.");t=t[0]}var r=e.split(/\r\n|[\n\v\f\r\x85]/),o=e.match(/\r\n|[\n\v\f\r\x85]/g)||[],s=t.hunks,l=n.compareLine||function(e,t,n,r){return t===r},u=0,d=n.fuzzFactor||0,c=0,f=0,h=void 0,p=void 0;function v(e,t){for(var n=0;n<e.lines.length;n++){var i=e.lines[n],o=i.length>0?i[0]:" ",a=i.length>0?i.substr(1):i;if(" "===o||"-"===o){if(!l(t+1,r[t],o,a)&&++u>d)return!1;t++}}return!0}for(var m=0;m<s.length;m++){for(var g=s[m],_=r.length-g.oldLines,y=0,w=f+g.oldStart-1,x=(0,a.default)(w,c,_);void 0!==y;y=x())if(v(g,w+y)){g.offset=f+=y;break}if(void 0===y)return!1;c=g.offset+g.oldStart+g.oldLines}for(var b=0,L=0;L<s.length;L++){var C=s[L],k=C.oldStart+C.offset+b-1;b+=C.newLines-C.oldLines,k<0&&(k=0);for(var P=0;P<C.lines.length;P++){var S=C.lines[P],A=S.length>0?S[0]:" ",M=S.length>0?S.substr(1):S,N=C.linedelimiters[P];if(" "===A)k++;else if("-"===A)r.splice(k,1),o.splice(k,1);else if("+"===A)r.splice(k,0,M),o.splice(k,0,N),k++;else if("\\"===A){var F=C.lines[P-1]?C.lines[P-1][0]:null;"+"===F?h=!0:"-"===F&&(p=!0)}}}if(h)for(;!r[r.length-1];)r.pop(),o.pop();else p&&(r.push(""),o.push("\n"));for(var j=0;j<r.length-1;j++)r[j]=r[j]+o[j];return r.join("")}},function(e,t){"use strict";t.__esModule=!0,t.parsePatch=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=e.split(/\r\n|[\n\v\f\r\x85]/),r=e.match(/\r\n|[\n\v\f\r\x85]/g)||[],i=[],o=0;function a(){var e={};for(i.push(e);o<n.length;){var r=n[o];if(/^(\-\-\-|\+\+\+|@@)\s/.test(r))break;var a=/^(?:Index:|diff(?: -r \w+)+)\s+(.+?)\s*$/.exec(r);a&&(e.index=a[1]),o++}for(s(e),s(e),e.hunks=[];o<n.length;){var u=n[o];if(/^(Index:|diff|\-\-\-|\+\+\+)\s/.test(u))break;if(/^@@/.test(u))e.hunks.push(l());else{if(u&&t.strict)throw new Error("Unknown line "+(o+1)+" "+JSON.stringify(u));o++}}}function s(e){var t=/^(---|\+\+\+)\s+(.*)$/.exec(n[o]);if(t){var r="---"===t[1]?"old":"new",i=t[2].split("\t",2),a=i[0].replace(/\\\\/g,"\\");/^".*"$/.test(a)&&(a=a.substr(1,a.length-2)),e[r+"FileName"]=a,e[r+"Header"]=(i[1]||"").trim(),o++}}function l(){for(var e=o,i=n[o++],a=i.split(/@@ -(\d+)(?:,(\d+))? \+(\d+)(?:,(\d+))? @@/),s={oldStart:+a[1],oldLines:+a[2]||1,newStart:+a[3],newLines:+a[4]||1,lines:[],linedelimiters:[]},l=0,u=0;o<n.length&&!(0===n[o].indexOf("--- ")&&o+2<n.length&&0===n[o+1].indexOf("+++ ")&&0===n[o+2].indexOf("@@"));o++){var d=0==n[o].length&&o!=n.length-1?" ":n[o][0];if("+"!==d&&"-"!==d&&" "!==d&&"\\"!==d)break;s.lines.push(n[o]),s.linedelimiters.push(r[o]||"\n"),"+"===d?l++:"-"===d?u++:" "===d&&(l++,u++)}if(l||1!==s.newLines||(s.newLines=0),u||1!==s.oldLines||(s.oldLines=0),t.strict){if(l!==s.newLines)throw new Error("Added line count did not match for hunk at line "+(e+1));if(u!==s.oldLines)throw new Error("Removed line count did not match for hunk at line "+(e+1))}return s}for(;o<n.length;)a();return i}},function(e,t){"use strict";t.__esModule=!0,t.default=function(e,t,n){var r=!0,i=!1,o=!1,a=1;return function s(){if(r&&!o){if(i?a++:r=!1,e+a<=n)return a;o=!0}if(!i)return o||(r=!0),t<=e-a?-a++:(i=!0,s())}}},function(e,t,n){"use strict";t.__esModule=!0,t.calcLineCount=s,t.merge=function(e,t,n){e=l(e,n),t=l(t,n);var r={};(e.index||t.index)&&(r.index=e.index||t.index);(e.newFileName||t.newFileName)&&(u(e)?u(t)?(r.oldFileName=d(r,e.oldFileName,t.oldFileName),r.newFileName=d(r,e.newFileName,t.newFileName),r.oldHeader=d(r,e.oldHeader,t.oldHeader),r.newHeader=d(r,e.newHeader,t.newHeader)):(r.oldFileName=e.oldFileName,r.newFileName=e.newFileName,r.oldHeader=e.oldHeader,r.newHeader=e.newHeader):(r.oldFileName=t.oldFileName||e.oldFileName,r.newFileName=t.newFileName||e.newFileName,r.oldHeader=t.oldHeader||e.oldHeader,r.newHeader=t.newHeader||e.newHeader));r.hunks=[];var i=0,o=0,a=0,s=0;for(;i<e.hunks.length||o<t.hunks.length;){var p=e.hunks[i]||{oldStart:1/0},v=t.hunks[o]||{oldStart:1/0};if(c(p,v))r.hunks.push(f(p,a)),i++,s+=p.newLines-p.oldLines;else if(c(v,p))r.hunks.push(f(v,s)),o++,a+=v.newLines-v.oldLines;else{var m={oldStart:Math.min(p.oldStart,v.oldStart),oldLines:0,newStart:Math.min(p.newStart+a,v.oldStart+s),newLines:0,lines:[]};h(m,p.oldStart,p.lines,v.oldStart,v.lines),o++,i++,r.hunks.push(m)}}return r};var r=n(14),i=n(11),o=n(15);function a(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}function s(e){var t=function e(t){var n=0;var r=0;t.forEach(function(t){if("string"!=typeof t){var i=e(t.mine),o=e(t.theirs);void 0!==n&&(i.oldLines===o.oldLines?n+=i.oldLines:n=void 0),void 0!==r&&(i.newLines===o.newLines?r+=i.newLines:r=void 0)}else void 0===r||"+"!==t[0]&&" "!==t[0]||r++,void 0===n||"-"!==t[0]&&" "!==t[0]||n++});return{oldLines:n,newLines:r}}(e.lines),n=t.oldLines,r=t.newLines;void 0!==n?e.oldLines=n:delete e.oldLines,void 0!==r?e.newLines=r:delete e.newLines}function l(e,t){if("string"==typeof e){if(/^@@/m.test(e)||/^Index:/m.test(e))return(0,i.parsePatch)(e)[0];if(!t)throw new Error("Must provide a base reference or pass in a patch");return(0,r.structuredPatch)(void 0,void 0,t,e)}return e}function u(e){return e.newFileName&&e.newFileName!==e.oldFileName}function d(e,t,n){return t===n?t:(e.conflict=!0,{mine:t,theirs:n})}function c(e,t){return e.oldStart<t.oldStart&&e.oldStart+e.oldLines<t.oldStart}function f(e,t){return{oldStart:e.oldStart,oldLines:e.oldLines,newStart:e.newStart+t,newLines:e.newLines,lines:e.lines}}function h(e,t,n,r,i){var o={offset:t,lines:n,index:0},l={offset:r,lines:i,index:0};for(g(e,o,l),g(e,l,o);o.index<o.lines.length&&l.index<l.lines.length;){var u=o.lines[o.index],d=l.lines[l.index];if("-"!==u[0]&&"+"!==u[0]||"-"!==d[0]&&"+"!==d[0])if("+"===u[0]&&" "===d[0]){var c;(c=e.lines).push.apply(c,a(y(o)))}else if("+"===d[0]&&" "===u[0]){var f;(f=e.lines).push.apply(f,a(y(l)))}else"-"===u[0]&&" "===d[0]?v(e,o,l):"-"===d[0]&&" "===u[0]?v(e,l,o,!0):u===d?(e.lines.push(u),o.index++,l.index++):m(e,y(o),y(l));else p(e,o,l)}_(e,o),_(e,l),s(e)}function p(e,t,n){var r=y(t),i=y(n);if(w(r)&&w(i)){var s,l;if((0,o.arrayStartsWith)(r,i)&&x(n,r,r.length-i.length))return void(s=e.lines).push.apply(s,a(r));if((0,o.arrayStartsWith)(i,r)&&x(t,i,i.length-r.length))return void(l=e.lines).push.apply(l,a(i))}else if((0,o.arrayEqual)(r,i)){var u;return void(u=e.lines).push.apply(u,a(r))}m(e,r,i)}function v(e,t,n,r){var i,o=y(t),s=function(e,t){var n=[],r=[],i=0,o=!1,a=!1;for(;i<t.length&&e.index<e.lines.length;){var s=e.lines[e.index],l=t[i];if("+"===l[0])break;if(o=o||" "!==s[0],r.push(l),i++,"+"===s[0])for(a=!0;"+"===s[0];)n.push(s),s=e.lines[++e.index];l.substr(1)===s.substr(1)?(n.push(s),e.index++):a=!0}"+"===(t[i]||"")[0]&&o&&(a=!0);if(a)return n;for(;i<t.length;)r.push(t[i++]);return{merged:r,changes:n}}(n,o);s.merged?(i=e.lines).push.apply(i,a(s.merged)):m(e,r?s:o,r?o:s)}function m(e,t,n){e.conflict=!0,e.lines.push({conflict:!0,mine:t,theirs:n})}function g(e,t,n){for(;t.offset<n.offset&&t.index<t.lines.length;){var r=t.lines[t.index++];e.lines.push(r),t.offset++}}function _(e,t){for(;t.index<t.lines.length;){var n=t.lines[t.index++];e.lines.push(n)}}function y(e){for(var t=[],n=e.lines[e.index][0];e.index<e.lines.length;){var r=e.lines[e.index];if("-"===n&&"+"===r[0]&&(n="+"),n!==r[0])break;t.push(r),e.index++}return t}function w(e){return e.reduce(function(e,t){return e&&"-"===t[0]},!0)}function x(e,t,n){for(var r=0;r<n;r++){var i=t[t.length-n+r].substr(1);if(e.lines[e.index+r]!==" "+i)return!1}return e.index+=n,!0}},function(e,t,n){"use strict";t.__esModule=!0,t.structuredPatch=o,t.createTwoFilesPatch=a,t.createPatch=function(e,t,n,r,i,o){return a(e,e,t,n,r,i,o)};var r=n(5);function i(e){if(Array.isArray(e)){for(var t=0,n=Array(e.length);t<e.length;t++)n[t]=e[t];return n}return Array.from(e)}function o(e,t,n,o,a,s,l){l||(l={}),void 0===l.context&&(l.context=4);var u=(0,r.diffLines)(n,o,l);function d(e){return e.map(function(e){return" "+e})}u.push({value:"",lines:[]});for(var c=[],f=0,h=0,p=[],v=1,m=1,g=function(e){var t=u[e],r=t.lines||t.value.replace(/\n$/,"").split("\n");if(t.lines=r,t.added||t.removed){var a;if(!f){var s=u[e-1];f=v,h=m,s&&(p=l.context>0?d(s.lines.slice(-l.context)):[],f-=p.length,h-=p.length)}(a=p).push.apply(a,i(r.map(function(e){return(t.added?"+":"-")+e}))),t.added?m+=r.length:v+=r.length}else{if(f)if(r.length<=2*l.context&&e<u.length-2){var g;(g=p).push.apply(g,i(d(r)))}else{var _,y=Math.min(r.length,l.context);(_=p).push.apply(_,i(d(r.slice(0,y))));var w={oldStart:f,oldLines:v-f+y,newStart:h,newLines:m-h+y,lines:p};if(e>=u.length-2&&r.length<=l.context){var x=/\n$/.test(n),b=/\n$/.test(o);0!=r.length||x?x&&b||p.push("\\ No newline at end of file"):p.splice(w.oldLines,0,"\\ No newline at end of file")}c.push(w),f=0,h=0,p=[]}v+=r.length,m+=r.length}},_=0;_<u.length;_++)g(_);return{oldFileName:e,newFileName:t,oldHeader:a,newHeader:s,hunks:c}}function a(e,t,n,r,i,a,s){var l=o(e,t,n,r,i,a,s),u=[];e==t&&u.push("Index: "+e),u.push("==================================================================="),u.push("--- "+l.oldFileName+(void 0===l.oldHeader?"":"\t"+l.oldHeader)),u.push("+++ "+l.newFileName+(void 0===l.newHeader?"":"\t"+l.newHeader));for(var d=0;d<l.hunks.length;d++){var c=l.hunks[d];u.push("@@ -"+c.oldStart+","+c.oldLines+" +"+c.newStart+","+c.newLines+" @@"),u.push.apply(u,c.lines)}return u.join("\n")+"\n"}},function(e,t){"use strict";function n(e,t){if(t.length>e.length)return!1;for(var n=0;n<t.length;n++)if(t[n]!==e[n])return!1;return!0}t.__esModule=!0,t.arrayEqual=function(e,t){if(e.length!==t.length)return!1;return n(e,t)},t.arrayStartsWith=n},function(e,t){"use strict";t.__esModule=!0,t.convertChangesToDMP=function(e){for(var t=[],n=void 0,r=void 0,i=0;i<e.length;i++)n=e[i],r=n.added?1:n.removed?-1:0,t.push([r,n.value]);return t}},function(e,t){"use strict";function n(e){var t=e;return t=(t=(t=(t=t.replace(/&/g,"&amp;")).replace(/</g,"&lt;")).replace(/>/g,"&gt;")).replace(/"/g,"&quot;")}t.__esModule=!0,t.convertChangesToXML=function(e){for(var t=[],r=0;r<e.length;r++){var i=e[r];i.added?t.push("<ins>"):i.removed&&t.push("<del>"),t.push(n(i.value)),i.added?t.push("</ins>"):i.removed&&t.push("</del>")}return t.join("")}}])},e.exports=r()},lbHh:function(e,t,n){var r,i;!function(o){if(void 0===(i="function"==typeof(r=o)?r.call(t,n,t,e):r)||(e.exports=i),!0,e.exports=o(),!!0){var a=window.Cookies,s=window.Cookies=o();s.noConflict=function(){return window.Cookies=a,s}}}(function(){function e(){for(var e=0,t={};e<arguments.length;e++){var n=arguments[e];for(var r in n)t[r]=n[r]}return t}return function t(n){function r(t,i,o){var a;if("undefined"!=typeof document){if(arguments.length>1){if("number"==typeof(o=e({path:"/"},r.defaults,o)).expires){var s=new Date;s.setMilliseconds(s.getMilliseconds()+864e5*o.expires),o.expires=s}o.expires=o.expires?o.expires.toUTCString():"";try{a=JSON.stringify(i),/^[\{\[]/.test(a)&&(i=a)}catch(e){}i=n.write?n.write(i,t):encodeURIComponent(String(i)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),t=(t=(t=encodeURIComponent(String(t))).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent)).replace(/[\(\)]/g,escape);var l="";for(var u in o)o[u]&&(l+="; "+u,!0!==o[u]&&(l+="="+o[u]));return document.cookie=t+"="+i+l}t||(a={});for(var d=document.cookie?document.cookie.split("; "):[],c=/(%[0-9A-Z]{2})+/g,f=0;f<d.length;f++){var h=d[f].split("="),p=h.slice(1).join("=");this.json||'"'!==p.charAt(0)||(p=p.slice(1,-1));try{var v=h[0].replace(c,decodeURIComponent);if(p=n.read?n.read(p,v):n(p,v)||p.replace(c,decodeURIComponent),this.json)try{p=JSON.parse(p)}catch(e){}if(t===v){a=p;break}t||(a[v]=p)}catch(e){}}return a}}return r.set=r,r.get=function(e){return r.call(r,e)},r.getJSON=function(){return r.apply({json:!0},[].slice.call(arguments))},r.defaults={},r.remove=function(t,n){r(t,"",e(n,{expires:-1}))},r.withConverter=t,r}(function(){})})},vABE:function(e,t){},vGem:function(e,t){}});
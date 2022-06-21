/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/scripts/pane.js":
/*!************************************!*\
  !*** ./assets/src/scripts/pane.js ***!
  \************************************/
/***/ (() => {

eval("/**\n *\n */\nwindow.hypothesisConfig = function () {\n  return {\n    openSidebar: pressbooksHypothesis.openSidebar === '1' ? true : false,\n    showHighlights: pressbooksHypothesis.showHighlights === '1' ? true : false,\n\n    /**\n     * @param layoutParams\n     */\n    onLayoutChange: function onLayoutChange(layoutParams) {\n      var navReading = document.querySelector('.nav-reading');\n\n      if (layoutParams.expanded === true) {\n        document.body.classList.add('has-annotator-pane');\n\n        if (document.body.clientWidth - layoutParams.width > 400) {\n          document.body.style.marginRight = \"\".concat(layoutParams.width - 32, \"px\");\n\n          if (navReading) {\n            navReading.style.width = \"\".concat(document.body.clientWidth, \"px\");\n          }\n        }\n      } else {\n        document.body.classList.remove('has-annotator-pane');\n        document.body.style.marginRight = '0';\n\n        if (navReading) {\n          navReading.style.width = '100vw';\n        }\n      }\n    }\n  };\n};//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9AcHJlc3Nib29rcy9wcmVzc2Jvb2tzLWJvb2svLi9hc3NldHMvc3JjL3NjcmlwdHMvcGFuZS5qcz9hNjQyIl0sIm5hbWVzIjpbIndpbmRvdyIsImh5cG90aGVzaXNDb25maWciLCJvcGVuU2lkZWJhciIsInByZXNzYm9va3NIeXBvdGhlc2lzIiwic2hvd0hpZ2hsaWdodHMiLCJvbkxheW91dENoYW5nZSIsImxheW91dFBhcmFtcyIsIm5hdlJlYWRpbmciLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJleHBhbmRlZCIsImJvZHkiLCJjbGFzc0xpc3QiLCJhZGQiLCJjbGllbnRXaWR0aCIsIndpZHRoIiwic3R5bGUiLCJtYXJnaW5SaWdodCIsInJlbW92ZSJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0FBLE1BQU0sQ0FBQ0MsZ0JBQVAsR0FBMEIsWUFBTTtBQUMvQixTQUFPO0FBQ05DLElBQUFBLFdBQVcsRUFBSUMsb0JBQW9CLENBQUNELFdBQXJCLEtBQXFDLEdBQXZDLEdBQStDLElBQS9DLEdBQXNELEtBRDdEO0FBRU5FLElBQUFBLGNBQWMsRUFBSUQsb0JBQW9CLENBQUNDLGNBQXJCLEtBQXdDLEdBQTFDLEdBQWtELElBQWxELEdBQXlELEtBRm5FOztBQUdOO0FBQ0Y7QUFDQTtBQUNFQyxJQUFBQSxjQUFjLEVBQUUsd0JBQUFDLFlBQVksRUFBSTtBQUMvQixVQUFNQyxVQUFVLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF3QixjQUF4QixDQUFuQjs7QUFDQSxVQUFLSCxZQUFZLENBQUNJLFFBQWIsS0FBMEIsSUFBL0IsRUFBc0M7QUFDckNGLFFBQUFBLFFBQVEsQ0FBQ0csSUFBVCxDQUFjQyxTQUFkLENBQXdCQyxHQUF4QixDQUE2QixvQkFBN0I7O0FBQ0EsWUFBT0wsUUFBUSxDQUFDRyxJQUFULENBQWNHLFdBQWQsR0FBNEJSLFlBQVksQ0FBQ1MsS0FBM0MsR0FBcUQsR0FBMUQsRUFBZ0U7QUFDL0RQLFVBQUFBLFFBQVEsQ0FBQ0csSUFBVCxDQUFjSyxLQUFkLENBQW9CQyxXQUFwQixhQUFxQ1gsWUFBWSxDQUFDUyxLQUFiLEdBQXFCLEVBQTFEOztBQUNBLGNBQUtSLFVBQUwsRUFBa0I7QUFDakJBLFlBQUFBLFVBQVUsQ0FBQ1MsS0FBWCxDQUFpQkQsS0FBakIsYUFBNEJQLFFBQVEsQ0FBQ0csSUFBVCxDQUFjRyxXQUExQztBQUNBO0FBQ0Q7QUFDRCxPQVJELE1BUU87QUFDTk4sUUFBQUEsUUFBUSxDQUFDRyxJQUFULENBQWNDLFNBQWQsQ0FBd0JNLE1BQXhCLENBQWdDLG9CQUFoQztBQUNBVixRQUFBQSxRQUFRLENBQUNHLElBQVQsQ0FBY0ssS0FBZCxDQUFvQkMsV0FBcEIsR0FBa0MsR0FBbEM7O0FBQ0EsWUFBS1YsVUFBTCxFQUFrQjtBQUNqQkEsVUFBQUEsVUFBVSxDQUFDUyxLQUFYLENBQWlCRCxLQUFqQixHQUF5QixPQUF6QjtBQUNBO0FBQ0Q7QUFDRDtBQXZCSyxHQUFQO0FBeUJBLENBMUJEIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKlxuICovXG53aW5kb3cuaHlwb3RoZXNpc0NvbmZpZyA9ICgpID0+IHtcblx0cmV0dXJuIHtcblx0XHRvcGVuU2lkZWJhcjogKCBwcmVzc2Jvb2tzSHlwb3RoZXNpcy5vcGVuU2lkZWJhciA9PT0gJzEnICkgPyB0cnVlIDogZmFsc2UsXG5cdFx0c2hvd0hpZ2hsaWdodHM6ICggcHJlc3Nib29rc0h5cG90aGVzaXMuc2hvd0hpZ2hsaWdodHMgPT09ICcxJyApID8gdHJ1ZSA6IGZhbHNlLFxuXHRcdC8qKlxuXHRcdCAqIEBwYXJhbSBsYXlvdXRQYXJhbXNcblx0XHQgKi9cblx0XHRvbkxheW91dENoYW5nZTogbGF5b3V0UGFyYW1zID0+IHtcblx0XHRcdGNvbnN0IG5hdlJlYWRpbmcgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnLm5hdi1yZWFkaW5nJyApO1xuXHRcdFx0aWYgKCBsYXlvdXRQYXJhbXMuZXhwYW5kZWQgPT09IHRydWUgKSB7XG5cdFx0XHRcdGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmFkZCggJ2hhcy1hbm5vdGF0b3ItcGFuZScgKTtcblx0XHRcdFx0aWYgKCAoIGRvY3VtZW50LmJvZHkuY2xpZW50V2lkdGggLSBsYXlvdXRQYXJhbXMud2lkdGggKSA+IDQwMCApIHtcblx0XHRcdFx0XHRkb2N1bWVudC5ib2R5LnN0eWxlLm1hcmdpblJpZ2h0ID0gYCR7bGF5b3V0UGFyYW1zLndpZHRoIC0gMzJ9cHhgO1xuXHRcdFx0XHRcdGlmICggbmF2UmVhZGluZyApIHtcblx0XHRcdFx0XHRcdG5hdlJlYWRpbmcuc3R5bGUud2lkdGggPSBgJHtkb2N1bWVudC5ib2R5LmNsaWVudFdpZHRofXB4YDtcblx0XHRcdFx0XHR9XG5cdFx0XHRcdH1cblx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LnJlbW92ZSggJ2hhcy1hbm5vdGF0b3ItcGFuZScgKTtcblx0XHRcdFx0ZG9jdW1lbnQuYm9keS5zdHlsZS5tYXJnaW5SaWdodCA9ICcwJztcblx0XHRcdFx0aWYgKCBuYXZSZWFkaW5nICkge1xuXHRcdFx0XHRcdG5hdlJlYWRpbmcuc3R5bGUud2lkdGggPSAnMTAwdncnO1xuXHRcdFx0XHR9XG5cdFx0XHR9XG5cdFx0fSxcblx0fTtcbn07XG4iXSwiZmlsZSI6Ii4vYXNzZXRzL3NyYy9zY3JpcHRzL3BhbmUuanMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./assets/src/scripts/pane.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/scripts/pane.js"]();
/******/ 	
/******/ })()
;
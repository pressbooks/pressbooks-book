/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/scripts/lightbox.js":
/***/ (function(module, exports) {

eval("document.addEventListener('DOMContentLoaded', function () {\n\tvar imageLinks = document.querySelectorAll('#content a[href$=\".gif\"], #content a[href$=\".jpg\"], #content a[href$=\".png\"]');\n\tArray.prototype.forEach.call(imageLinks, function (imageLink) {\n\t\timageLink.setAttribute('data-lity', 'true');\n\t});\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvc3JjL3NjcmlwdHMvbGlnaHRib3guanM/YmVjZiJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJpbWFnZUxpbmtzIiwicXVlcnlTZWxlY3RvckFsbCIsIkFycmF5IiwicHJvdG90eXBlIiwiZm9yRWFjaCIsImNhbGwiLCJpbWFnZUxpbmsiLCJzZXRBdHRyaWJ1dGUiXSwibWFwcGluZ3MiOiJBQUFBQSxTQUFTQyxnQkFBVCxDQUEyQixrQkFBM0IsRUFBK0MsWUFBWTtBQUMxRCxLQUFNQyxhQUFhRixTQUFTRyxnQkFBVCxDQUNsQiw4RUFEa0IsQ0FBbkI7QUFHQUMsT0FBTUMsU0FBTixDQUFnQkMsT0FBaEIsQ0FBd0JDLElBQXhCLENBQThCTCxVQUE5QixFQUEwQyxxQkFBYTtBQUN0RE0sWUFBVUMsWUFBVixDQUF3QixXQUF4QixFQUFxQyxNQUFyQztBQUNBLEVBRkQ7QUFHQSxDQVBEIiwiZmlsZSI6Ii4vYXNzZXRzL3NyYy9zY3JpcHRzL2xpZ2h0Ym94LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lciggJ0RPTUNvbnRlbnRMb2FkZWQnLCBmdW5jdGlvbiAoKSB7XG5cdGNvbnN0IGltYWdlTGlua3MgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKFxuXHRcdCcjY29udGVudCBhW2hyZWYkPVwiLmdpZlwiXSwgI2NvbnRlbnQgYVtocmVmJD1cIi5qcGdcIl0sICNjb250ZW50IGFbaHJlZiQ9XCIucG5nXCJdJ1xuXHQpO1xuXHRBcnJheS5wcm90b3R5cGUuZm9yRWFjaC5jYWxsKCBpbWFnZUxpbmtzLCBpbWFnZUxpbmsgPT4ge1xuXHRcdGltYWdlTGluay5zZXRBdHRyaWJ1dGUoICdkYXRhLWxpdHknLCAndHJ1ZScgKTtcblx0fSApO1xufSApO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL3NyYy9zY3JpcHRzL2xpZ2h0Ym94LmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./assets/src/scripts/lightbox.js\n");

/***/ }),

/***/ 2:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./assets/src/scripts/lightbox.js");


/***/ })

/******/ });
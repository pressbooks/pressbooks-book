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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/src/scripts/collapse-sections.js":
/***/ (function(module, exports) {

eval("/**\n * @see https://inclusive-components.design/collapsible-sections/\n */\n\ndocument.addEventListener('DOMContentLoaded', function () {\n\t// Get all the headings\n\tvar sectionHeadingEl = 'h1';\n\tvar headings = document.querySelectorAll('#content section ' + sectionHeadingEl + ':not(.entry-title)');\n\n\tArray.prototype.forEach.call(headings, function (heading) {\n\t\t// Give each <h1> a toggle button child\n\t\t// with the SVG plus/minus icon\n\t\theading.innerHTML = '\\n\\t\\t<button aria-expanded=\"false\" class=\"button--text\">\\n\\t\\t  <span>' + heading.innerHTML + '</span>\\n\\t\\t  <svg aria-hidden=\"true\" focusable=\"false\" viewBox=\"0 0 10 10\">\\n\\t\\t\\t<rect class=\"vert\" height=\"8\" width=\"2\" y=\"1\" x=\"4\"/>\\n\\t\\t\\t<rect height=\"2\" width=\"8\" y=\"4\" x=\"1\"/>\\n\\t\\t  </svg>\\n\\t\\t</button>';\n\t\theading.setAttribute('data-collapsed', 'true');\n\n\t\t// Function to create a node list\n\t\t// of the content between this <h1> and the next\n\t\tvar getContent = function getContent(elem) {\n\t\t\tvar elems = [];\n\t\t\twhile (elem.nextElementSibling && elem.nextElementSibling.tagName !== 'H1') {\n\t\t\t\telems.push(elem.nextElementSibling);\n\t\t\t\telem = elem.nextElementSibling;\n\t\t\t}\n\n\t\t\t// Delete the old versions of the content nodes\n\t\t\telems.forEach(function (node) {\n\t\t\t\tnode.parentNode.removeChild(node);\n\t\t\t});\n\n\t\t\treturn elems;\n\t\t};\n\n\t\t// Assign the contents to be expanded/collapsed (array)\n\t\tvar contents = getContent(heading);\n\n\t\t// Create a wrapper element for `contents` and hide it\n\t\tvar wrapper = document.createElement('div');\n\t\twrapper.hidden = true;\n\n\t\t// Add each element of `contents` to `wrapper`\n\t\tcontents.forEach(function (node) {\n\t\t\twrapper.appendChild(node);\n\t\t});\n\n\t\t// Add the wrapped content back into the DOM\n\t\t// after the heading\n\t\theading.parentNode.insertBefore(wrapper, heading.nextElementSibling);\n\n\t\t// Assign the button\n\t\tvar btn = heading.querySelector('button');\n\n\t\tbtn.onclick = function () {\n\t\t\t// Cast the state as a boolean\n\t\t\tvar expanded = btn.getAttribute('aria-expanded') === 'true' || false;\n\n\t\t\t// Switch the state\n\t\t\tbtn.setAttribute('aria-expanded', !expanded);\n\t\t\theading.setAttribute('data-collapsed', expanded);\n\t\t\t// Switch the content's visibility\n\t\t\twrapper.hidden = expanded;\n\t\t};\n\t});\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvc3JjL3NjcmlwdHMvY29sbGFwc2Utc2VjdGlvbnMuanM/OWU0ZCJdLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJzZWN0aW9uSGVhZGluZ0VsIiwiaGVhZGluZ3MiLCJxdWVyeVNlbGVjdG9yQWxsIiwiQXJyYXkiLCJwcm90b3R5cGUiLCJmb3JFYWNoIiwiY2FsbCIsImhlYWRpbmciLCJpbm5lckhUTUwiLCJzZXRBdHRyaWJ1dGUiLCJnZXRDb250ZW50IiwiZWxlbXMiLCJlbGVtIiwibmV4dEVsZW1lbnRTaWJsaW5nIiwidGFnTmFtZSIsInB1c2giLCJub2RlIiwicGFyZW50Tm9kZSIsInJlbW92ZUNoaWxkIiwiY29udGVudHMiLCJ3cmFwcGVyIiwiY3JlYXRlRWxlbWVudCIsImhpZGRlbiIsImFwcGVuZENoaWxkIiwiaW5zZXJ0QmVmb3JlIiwiYnRuIiwicXVlcnlTZWxlY3RvciIsIm9uY2xpY2siLCJleHBhbmRlZCIsImdldEF0dHJpYnV0ZSJdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7QUFJQUEsU0FBU0MsZ0JBQVQsQ0FBMkIsa0JBQTNCLEVBQStDLFlBQVk7QUFDMUQ7QUFDQSxLQUFNQyxtQkFBbUIsSUFBekI7QUFDQSxLQUFNQyxXQUFXSCxTQUFTSSxnQkFBVCx1QkFDSUYsZ0JBREosd0JBQWpCOztBQUlBRyxPQUFNQyxTQUFOLENBQWdCQyxPQUFoQixDQUF3QkMsSUFBeEIsQ0FBOEJMLFFBQTlCLEVBQXdDLG1CQUFXO0FBQ2xEO0FBQ0E7QUFDQU0sVUFBUUMsU0FBUiwrRUFFVUQsUUFBUUMsU0FGbEI7QUFRQUQsVUFBUUUsWUFBUixDQUFzQixnQkFBdEIsRUFBd0MsTUFBeEM7O0FBRUE7QUFDQTtBQUNBLE1BQU1DLGFBQWEsU0FBYkEsVUFBYSxPQUFRO0FBQzFCLE9BQUlDLFFBQVEsRUFBWjtBQUNBLFVBQ0NDLEtBQUtDLGtCQUFMLElBQ0FELEtBQUtDLGtCQUFMLENBQXdCQyxPQUF4QixLQUFvQyxJQUZyQyxFQUdFO0FBQ0RILFVBQU1JLElBQU4sQ0FBWUgsS0FBS0Msa0JBQWpCO0FBQ0FELFdBQU9BLEtBQUtDLGtCQUFaO0FBQ0E7O0FBRUQ7QUFDQUYsU0FBTU4sT0FBTixDQUFlLGdCQUFRO0FBQ3RCVyxTQUFLQyxVQUFMLENBQWdCQyxXQUFoQixDQUE2QkYsSUFBN0I7QUFDQSxJQUZEOztBQUlBLFVBQU9MLEtBQVA7QUFDQSxHQWhCRDs7QUFrQkE7QUFDQSxNQUFJUSxXQUFXVCxXQUFZSCxPQUFaLENBQWY7O0FBRUE7QUFDQSxNQUFJYSxVQUFVdEIsU0FBU3VCLGFBQVQsQ0FBd0IsS0FBeEIsQ0FBZDtBQUNBRCxVQUFRRSxNQUFSLEdBQWlCLElBQWpCOztBQUVBO0FBQ0FILFdBQVNkLE9BQVQsQ0FBa0IsZ0JBQVE7QUFDekJlLFdBQVFHLFdBQVIsQ0FBcUJQLElBQXJCO0FBQ0EsR0FGRDs7QUFJQTtBQUNBO0FBQ0FULFVBQVFVLFVBQVIsQ0FBbUJPLFlBQW5CLENBQWlDSixPQUFqQyxFQUEwQ2IsUUFBUU0sa0JBQWxEOztBQUVBO0FBQ0EsTUFBSVksTUFBTWxCLFFBQVFtQixhQUFSLENBQXVCLFFBQXZCLENBQVY7O0FBRUFELE1BQUlFLE9BQUosR0FBYyxZQUFNO0FBQ25CO0FBQ0EsT0FBSUMsV0FBV0gsSUFBSUksWUFBSixDQUFrQixlQUFsQixNQUF3QyxNQUF4QyxJQUFrRCxLQUFqRTs7QUFFQTtBQUNBSixPQUFJaEIsWUFBSixDQUFrQixlQUFsQixFQUFtQyxDQUFFbUIsUUFBckM7QUFDQXJCLFdBQVFFLFlBQVIsQ0FBc0IsZ0JBQXRCLEVBQXdDbUIsUUFBeEM7QUFDQTtBQUNBUixXQUFRRSxNQUFSLEdBQWlCTSxRQUFqQjtBQUNBLEdBVEQ7QUFVQSxFQTlERDtBQStEQSxDQXRFRCIsImZpbGUiOiIuL2Fzc2V0cy9zcmMvc2NyaXB0cy9jb2xsYXBzZS1zZWN0aW9ucy5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8qKlxuICogQHNlZSBodHRwczovL2luY2x1c2l2ZS1jb21wb25lbnRzLmRlc2lnbi9jb2xsYXBzaWJsZS1zZWN0aW9ucy9cbiAqL1xuXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCAnRE9NQ29udGVudExvYWRlZCcsIGZ1bmN0aW9uICgpIHtcblx0Ly8gR2V0IGFsbCB0aGUgaGVhZGluZ3Ncblx0Y29uc3Qgc2VjdGlvbkhlYWRpbmdFbCA9ICdoMSc7XG5cdGNvbnN0IGhlYWRpbmdzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChcblx0XHRgI2NvbnRlbnQgc2VjdGlvbiAke3NlY3Rpb25IZWFkaW5nRWx9Om5vdCguZW50cnktdGl0bGUpYFxuXHQpO1xuXG5cdEFycmF5LnByb3RvdHlwZS5mb3JFYWNoLmNhbGwoIGhlYWRpbmdzLCBoZWFkaW5nID0+IHtcblx0XHQvLyBHaXZlIGVhY2ggPGgxPiBhIHRvZ2dsZSBidXR0b24gY2hpbGRcblx0XHQvLyB3aXRoIHRoZSBTVkcgcGx1cy9taW51cyBpY29uXG5cdFx0aGVhZGluZy5pbm5lckhUTUwgPSBgXG5cdFx0PGJ1dHRvbiBhcmlhLWV4cGFuZGVkPVwiZmFsc2VcIiBjbGFzcz1cImJ1dHRvbi0tdGV4dFwiPlxuXHRcdCAgPHNwYW4+JHtoZWFkaW5nLmlubmVySFRNTH08L3NwYW4+XG5cdFx0ICA8c3ZnIGFyaWEtaGlkZGVuPVwidHJ1ZVwiIGZvY3VzYWJsZT1cImZhbHNlXCIgdmlld0JveD1cIjAgMCAxMCAxMFwiPlxuXHRcdFx0PHJlY3QgY2xhc3M9XCJ2ZXJ0XCIgaGVpZ2h0PVwiOFwiIHdpZHRoPVwiMlwiIHk9XCIxXCIgeD1cIjRcIi8+XG5cdFx0XHQ8cmVjdCBoZWlnaHQ9XCIyXCIgd2lkdGg9XCI4XCIgeT1cIjRcIiB4PVwiMVwiLz5cblx0XHQgIDwvc3ZnPlxuXHRcdDwvYnV0dG9uPmA7XG5cdFx0aGVhZGluZy5zZXRBdHRyaWJ1dGUoICdkYXRhLWNvbGxhcHNlZCcsICd0cnVlJyApO1xuXG5cdFx0Ly8gRnVuY3Rpb24gdG8gY3JlYXRlIGEgbm9kZSBsaXN0XG5cdFx0Ly8gb2YgdGhlIGNvbnRlbnQgYmV0d2VlbiB0aGlzIDxoMT4gYW5kIHRoZSBuZXh0XG5cdFx0Y29uc3QgZ2V0Q29udGVudCA9IGVsZW0gPT4ge1xuXHRcdFx0bGV0IGVsZW1zID0gW107XG5cdFx0XHR3aGlsZSAoXG5cdFx0XHRcdGVsZW0ubmV4dEVsZW1lbnRTaWJsaW5nICYmXG5cdFx0XHRcdGVsZW0ubmV4dEVsZW1lbnRTaWJsaW5nLnRhZ05hbWUgIT09ICdIMSdcblx0XHRcdCkge1xuXHRcdFx0XHRlbGVtcy5wdXNoKCBlbGVtLm5leHRFbGVtZW50U2libGluZyApO1xuXHRcdFx0XHRlbGVtID0gZWxlbS5uZXh0RWxlbWVudFNpYmxpbmc7XG5cdFx0XHR9XG5cblx0XHRcdC8vIERlbGV0ZSB0aGUgb2xkIHZlcnNpb25zIG9mIHRoZSBjb250ZW50IG5vZGVzXG5cdFx0XHRlbGVtcy5mb3JFYWNoKCBub2RlID0+IHtcblx0XHRcdFx0bm9kZS5wYXJlbnROb2RlLnJlbW92ZUNoaWxkKCBub2RlICk7XG5cdFx0XHR9ICk7XG5cblx0XHRcdHJldHVybiBlbGVtcztcblx0XHR9O1xuXG5cdFx0Ly8gQXNzaWduIHRoZSBjb250ZW50cyB0byBiZSBleHBhbmRlZC9jb2xsYXBzZWQgKGFycmF5KVxuXHRcdGxldCBjb250ZW50cyA9IGdldENvbnRlbnQoIGhlYWRpbmcgKTtcblxuXHRcdC8vIENyZWF0ZSBhIHdyYXBwZXIgZWxlbWVudCBmb3IgYGNvbnRlbnRzYCBhbmQgaGlkZSBpdFxuXHRcdGxldCB3cmFwcGVyID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCggJ2RpdicgKTtcblx0XHR3cmFwcGVyLmhpZGRlbiA9IHRydWU7XG5cblx0XHQvLyBBZGQgZWFjaCBlbGVtZW50IG9mIGBjb250ZW50c2AgdG8gYHdyYXBwZXJgXG5cdFx0Y29udGVudHMuZm9yRWFjaCggbm9kZSA9PiB7XG5cdFx0XHR3cmFwcGVyLmFwcGVuZENoaWxkKCBub2RlICk7XG5cdFx0fSApO1xuXG5cdFx0Ly8gQWRkIHRoZSB3cmFwcGVkIGNvbnRlbnQgYmFjayBpbnRvIHRoZSBET01cblx0XHQvLyBhZnRlciB0aGUgaGVhZGluZ1xuXHRcdGhlYWRpbmcucGFyZW50Tm9kZS5pbnNlcnRCZWZvcmUoIHdyYXBwZXIsIGhlYWRpbmcubmV4dEVsZW1lbnRTaWJsaW5nICk7XG5cblx0XHQvLyBBc3NpZ24gdGhlIGJ1dHRvblxuXHRcdGxldCBidG4gPSBoZWFkaW5nLnF1ZXJ5U2VsZWN0b3IoICdidXR0b24nICk7XG5cblx0XHRidG4ub25jbGljayA9ICgpID0+IHtcblx0XHRcdC8vIENhc3QgdGhlIHN0YXRlIGFzIGEgYm9vbGVhblxuXHRcdFx0bGV0IGV4cGFuZGVkID0gYnRuLmdldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnICkgPT09ICd0cnVlJyB8fCBmYWxzZTtcblxuXHRcdFx0Ly8gU3dpdGNoIHRoZSBzdGF0ZVxuXHRcdFx0YnRuLnNldEF0dHJpYnV0ZSggJ2FyaWEtZXhwYW5kZWQnLCAhIGV4cGFuZGVkICk7XG5cdFx0XHRoZWFkaW5nLnNldEF0dHJpYnV0ZSggJ2RhdGEtY29sbGFwc2VkJywgZXhwYW5kZWQgKTtcblx0XHRcdC8vIFN3aXRjaCB0aGUgY29udGVudCdzIHZpc2liaWxpdHlcblx0XHRcdHdyYXBwZXIuaGlkZGVuID0gZXhwYW5kZWQ7XG5cdFx0fTtcblx0fSApO1xufSApO1xuXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIC4vYXNzZXRzL3NyYy9zY3JpcHRzL2NvbGxhcHNlLXNlY3Rpb25zLmpzIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./assets/src/scripts/collapse-sections.js\n");

/***/ }),

/***/ 1:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./assets/src/scripts/collapse-sections.js");


/***/ })

/******/ });
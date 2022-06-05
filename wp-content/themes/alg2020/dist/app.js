/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _logic_when_in_viewport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./logic/when-in-viewport.js */ "./src/js/logic/when-in-viewport.js");


/***/ }),

/***/ "./src/js/logic/when-in-viewport.js":
/*!******************************************!*\
  !*** ./src/js/logic/when-in-viewport.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var when_in_viewport__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! when-in-viewport */ "./node_modules/when-in-viewport/src/whenInViewport.js");
/* harmony import */ var when_in_viewport__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(when_in_viewport__WEBPACK_IMPORTED_MODULE_0__);

var elements = Array.prototype.slice.call(document.querySelectorAll(".scrollAnimation"));
elements.forEach(function (element) {
  new (when_in_viewport__WEBPACK_IMPORTED_MODULE_0___default())(element, function (elementInViewport) {
    var delay = parseInt(element.getAttribute("data-delay")) || 0;
    setTimeout(function () {
      elementInViewport.classList.add("inViewport");
    }, delay);
  });
});

/***/ }),

/***/ "./src/css/style.scss":
/*!****************************!*\
  !*** ./src/css/style.scss ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/css/theme.css":
/*!***************************!*\
  !*** ./src/css/theme.css ***!
  \***************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/when-in-viewport/src/whenInViewport.js":
/*!*************************************************************!*\
  !*** ./node_modules/when-in-viewport/src/whenInViewport.js ***!
  \*************************************************************/
/***/ (function(module, exports) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;(function(root, factory) {

    /* istanbul ignore next */
    if (true) {
        !(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
    } else {}

}(this, function() {

    var windowHeight;
    var scrollOffset;

    function WhenInViewport(element, callback, options) {

        events.setup();
        this.registryItem = registry.addItem(element, typeof callback === 'function' ? assign(options || {}, {callback: callback}) : callback);
        registry.processItem(this.registryItem);

    }

    WhenInViewport.prototype.stopListening = function() {

        registry.removeItem(this.registryItem);
        events.removeIfStoreEmpty();

    };

    WhenInViewport.defaults = {
        threshold: 0,
        context: null
    };

    assign(WhenInViewport, {

        setRateLimiter: function(rateLimiter, rateLimitDelay) {

            events.rateLimiter = rateLimiter;

            if (rateLimitDelay) {
                events.rateLimitDelay = rateLimitDelay;
            }

            return this;

        },

        checkAll: function() {

            scrollOffset = getWindowScrollOffset();
            windowHeight = getWindowHeight();

            registry.adjustPositions(registry.processItem);
            events.removeIfStoreEmpty();

            return this;

        },

        destroy: function() {

            registry.store = {};

            events.remove();
            delete events.scrollHandler;
            delete events.resizeHandler;

            return this;

        },

        registerAsJqueryPlugin: function($) {

            $.fn.whenInViewport = function(options, moreOptions) {

                var pluginOptions;
                var callbackProxy = function(callback) {
                    return function(el) { callback.call(this, $(el)); };
                };

                if (typeof options === 'function') {
                    pluginOptions = $.extend({}, moreOptions, {callback: callbackProxy(options)});
                } else {
                    pluginOptions = $.extend(options, {callback: callbackProxy(options.callback)});
                }

                return this.each(function() {

                    if (pluginOptions.setupOnce) {
                        !$.data(this, 'whenInViewport') && $.data(this, 'whenInViewport', new WhenInViewport(this, pluginOptions));
                    } else {
                        $.data(this, 'whenInViewport', new WhenInViewport(this, pluginOptions));
                    }

                });

            };

            return this;

        }

    });

    function getWindowHeight() {

        /* istanbul ignore next */
        return 'innerHeight' in window ? window.innerHeight : document.documentElement.offsetHeight;

    }

    function getWindowScrollOffset() {

        /* istanbul ignore next */
        return 'pageYOffset' in window ? window.pageYOffset : document.documentElement.scrollTop || document.body.scrollTop;

    }

    function getElementOffset(element) {

        return element.getBoundingClientRect().top + getWindowScrollOffset();

    }

    function iterate(obj, callback, context) {

        for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
                if (callback.call(context, obj[key], key) === false) {
                    break;
                }
            }
        }

    }

    function assign(out) {

        for (var i = 1; i < arguments.length; i++) {
            iterate(arguments[i], function(obj, key) {
                out[key] = obj;
            });
        }

        return out;

    }

    var registry = {

        store: {},
        counter: 0,

        addItem: function(element, options) {

            var storeKey = 'whenInViewport' + (++this.counter);
            var item = assign({}, WhenInViewport.defaults, options, {
                storeKey: storeKey,
                element: element,
                topOffset: getElementOffset(element)
            });

            return this.store[storeKey] = item;

        },

        adjustPositions: function(callback) {

            iterate(this.store, function(storeItem) {
                storeItem.topOffset = getElementOffset(storeItem.element);
                callback && callback.call(registry, storeItem);
            });

        },

        processAll: function() {

            iterate(this.store, this.processItem, this);

        },

        processItem: function(item) {

            if (scrollOffset + windowHeight >= item.topOffset - item.threshold) {

                this.removeItem(item);
                item.callback.call(item.context || window, item.element);

            }

        },

        removeItem: function(registryItem) {

            delete this.store[registryItem.storeKey];

        },

        isEmpty: function() {

            var isEmpty = true;

            iterate(this.store, function() {
                return isEmpty = false;
            });

            return isEmpty;

        }

    };

    var events = {

        setuped: false,

        rateLimiter: function(callback, timeout) {
            return callback;
        },

        rateLimitDelay: 100,

        on: function(eventName, callback) {

            /* istanbul ignore next */
            if (window.addEventListener) {
                window.addEventListener(eventName, callback, false);
            } else if (window.attachEvent) {
                window.attachEvent(eventName, callback);
            }

            return this;

        },

        off: function(eventName, callback) {

            /* istanbul ignore next */
            if (window.removeEventListener) {
                window.removeEventListener(eventName, callback, false);
            } else if (window.detachEvent) {
                window.detachEvent('on' + eventName, callback);
            }

            return this;

        },

        setup: function() {

            var self = this;

            if (!this.setuped) {

                scrollOffset = getWindowScrollOffset();
                windowHeight = getWindowHeight();

                this.scrollHandler = this.scrollHandler || this.rateLimiter(function() {

                    scrollOffset = getWindowScrollOffset();
                    registry.processAll();
                    self.removeIfStoreEmpty();

                }, this.rateLimitDelay);

                this.resizeHandler = this.resizeHandler || this.rateLimiter(function() {

                    windowHeight = getWindowHeight();
                    registry.adjustPositions(registry.processItem);
                    self.removeIfStoreEmpty();

                }, this.rateLimitDelay);

                this.on('scroll', this.scrollHandler).on('resize', this.resizeHandler);

                this.setuped = true;

            }

        },

        removeIfStoreEmpty: function() {

            registry.isEmpty() && this.remove();

        },

        remove: function() {

            if (this.setuped) {
                this.off('scroll', this.scrollHandler).off('resize', this.resizeHandler);
                this.setuped = false;
            }

        }

    };

    if (typeof window !== 'undefined') {
        var $ = window.jQuery || window.$;
        $ && WhenInViewport.registerAsJqueryPlugin($);
    }

    return WhenInViewport;

}));


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/app": 0,
/******/ 			"theme": 0,
/******/ 			"style": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkalg2020"] = self["webpackChunkalg2020"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["theme","style"], () => (__webpack_require__("./src/js/app.js")))
/******/ 	__webpack_require__.O(undefined, ["theme","style"], () => (__webpack_require__("./src/css/style.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["theme","style"], () => (__webpack_require__("./src/css/theme.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
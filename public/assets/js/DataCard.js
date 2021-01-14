/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ([
/* 0 */
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var DataCard_1 = __webpack_require__(1);
var Register_1 = __webpack_require__(9);
var request_1 = __webpack_require__(2);
// setting up ajax header alongside token
request_1.default.setup();
// Registry Event That Run on window load
new Register_1.default().register();
window["DataCard"] = new DataCard_1.default($("#content"));


/***/ }),
/* 1 */
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


var __assign = (this && this.__assign) || function () {
    __assign = Object.assign || function(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p))
                t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};
Object.defineProperty(exports, "__esModule", ({ value: true }));
var request_1 = __webpack_require__(2);
var Card_1 = __webpack_require__(3);
var loading_1 = __webpack_require__(5);
var Modal_1 = __webpack_require__(6);
var NotFoundCard_1 = __webpack_require__(7);
var PaginationOrigin_1 = __webpack_require__(8);
var DataCard = /** @class */ (function () {
    function DataCard(c) {
        this.c = c;
        this.configure = {
            url: "/search",
            search: false,
            page: 1,
        };
        this.setting = {};
        this.data = [];
        this.loading = new loading_1.default(this.c);
    }
    DataCard.prototype.ajax = function (url, search, draw) {
        if (url === void 0) { url = null; }
        if (search === void 0) { search = null; }
        if (draw === void 0) { draw = 1; }
        var data = {};
        var hasSearchEmpty = search === null;
        // ========================== Event Binding ==========================
        var beforeSend = this.bindThisForce(this.eventBeforeSend);
        var complete = this.bindThisForce(this.eventComplete);
        var error = this.bindThisForce(this.eventError);
        var success = this.eventSuccess;
        var _this = this;
        // Ignore Empty String
        if (search === "")
            this.configure.search = false;
        // Check if Search is filled by value
        else if (!hasSearchEmpty)
            this.configure.search = search;
        // if is not pagination this page num will reset to 1
        this.configure.page = draw;
        // is search mode push data to object
        if (this.configure.search)
            data["search"] = this.configure.search;
        // set Pagination number
        data["page"] = this.configure.page;
        // if url doesnt exist
        url = url || this.configure.url;
        this.configure.url = url;
        request_1.default.url({
            url: url,
            data: JSON.stringify(data),
            success: function (data) {
                // console.log(data);
                success.apply(_this, [data]);
            },
            beforeSend: beforeSend,
            complete: complete,
            error: error,
        });
    };
    DataCard.prototype.loadPage = function (pageNumber) {
        this.ajax(null, null, pageNumber);
    };
    /**
     * Jquery Event beforeSend Ajax
     *
     */
    DataCard.prototype.eventBeforeSend = function () {
        this.loading.show();
    };
    /**
     * Error Handling
     *
     */
    DataCard.prototype.eventError = function () {
        new Noty({
            type: "error",
            text: "<strong>Error</strong><br>Error loading page. Please refresh the page.",
        }).show();
    };
    /**
     * Jquery Event complete Ajax
     *
     */
    DataCard.prototype.eventComplete = function () {
        this.renderCard();
        // register detail model into model
        new Modal_1.default(this.data).RegisterEvent();
        // Render Pagination Number
        if (this.configure.page === 1)
            PaginationOrigin_1.default(this.setting.totalPage);
        this.loading.hide();
    };
    DataCard.prototype.eventSuccess = function (result) {
        this.data = result.data;
        // deleting Data
        delete result.data;
        // fetching Setup
        this.setting = result;
    };
    /**
     * Rendering Card Into Html Format
     *
     */
    DataCard.prototype.renderCard = function () {
        var content = "";
        if (this.data.length <= 0)
            content = NotFoundCard_1.default();
        this.data.forEach(function (data, index) {
            content += Card_1.default(__assign(__assign({}, data), { index: index }));
        });
        this.c.html(content);
    };
    DataCard.prototype.updateUrl = function (url) {
        this.configure.url = url;
    };
    DataCard.prototype.bindThisForce = function (closure) {
        var param = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            param[_i - 1] = arguments[_i];
        }
        return closure.bind(this, param);
    };
    return DataCard;
}());
exports.default = DataCard;


/***/ }),
/* 2 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var RequestAJAX = {
    settingHeader: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        "Content-Type": "application/json",
    },
    defaultMethod: "POST",
    url: function (setting) {
        $.ajax(setting);
    },
    setup: function () {
        $.ajaxSetup({
            async: true,
            headers: this.settingHeader,
            method: this.defaultMethod,
            processData: false,
        });
    },
};
exports.default = RequestAJAX;


/***/ }),
/* 3 */
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var styles_1 = __webpack_require__(4);
var truntcateText = function (text, num) {
    if (num === void 0) { num = 90; }
    return text.substr(0, num) + (text.length >= num ? "..." : "");
};
var Card = function (_a) {
    var title = _a.title, description = _a.description, thumbnail = _a.thumbnail, index = _a.index, unlock = _a.unlock, subscriptionType = _a.subscriptionType;
    var style = styles_1.TypeStyles(subscriptionType);
    var cardContent = "\n  \n\n  <div class=\"col-12 col-md-6 col-lg-4\">\n        <div class=\"card card-content\">\n        " + (!unlock
        ? "<div class=\"card-cover\">\n              <div class=\"lock-content-cover\">\n                    <i class=\"icon nav-icon las la-lock\"></i>\n              </div>"
        : "") + "\n          \n            <img src=\"" + thumbnail + "\" class=\"bd-placeholder-img card-img-top\">\n                " + (!unlock ? "</div>" : "") + "\n\n            <div class=\"card-body\">\n                <span class=\"" + style + "\">" + subscriptionType + "</span>\n                <h5 class=\"mt-3 text-overflow\"> " + title + "\n                </h5>\n                    \n                <p class=\"card-text text-muted\">\n                " + truntcateText(description) + "\n                </p>\n\n                <button class=\"btn btn-primary btn-block mt-4\" data-detail-index=\"" + index + "\">\n                    <i class=\"nav-icon las la-eye mr-1\"></i> Details\n                </button>\n            </div>\n        </div>\n    </div>\n  \n";
    return cardContent;
};
exports.default = Card;


/***/ }),
/* 4 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
exports.TypeStyles = void 0;
var TypeStyles = function (type) {
    var styles = "px-2 py-1 rounded ";
    switch (type) {
        case "Low":
            styles += "bg-dark";
            break;
        case "Medium":
            styles += "bg-success";
            break;
        case "High":
            styles += "bg-primary";
            break;
    }
    return styles;
};
exports.TypeStyles = TypeStyles;


/***/ }),
/* 5 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var loading = /** @class */ (function () {
    function loading(c) {
        this.c = c;
        this.load = true;
        this.l = $("#crud-loader");
    }
    loading.prototype.show = function () {
        //   stop if has show
        if (this.load)
            return;
        this.l.removeClass("d-none");
        this.c.addClass("d-none");
        this.load = true;
    };
    loading.prototype.hide = function () {
        //   stop if has hide
        if (!this.load)
            return;
        this.c.removeClass("d-none");
        this.l.addClass("d-none");
        this.load = false;
    };
    loading.prototype.toggle = function () {
        this.load ? this.show() : this.hide();
    };
    return loading;
}());
exports.default = loading;


/***/ }),
/* 6 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var Modal = /** @class */ (function () {
    function Modal(data) {
        this.data = data;
        this.e = $("#content-detail");
        this.f = $("#video-preview");
    }
    Modal.prototype.RegisterEvent = function () {
        var _this = this;
        $("[data-detail-index]").on("click", function (event) {
            return _this.showDetail.apply(_this, [event]);
        });
    };
    Modal.prototype.modalDetail = function (_a) {
        var title = _a.title, videoPath = _a.videoPath, description = _a.description, subscriptionType = _a.subscriptionType;
        videojs("my-video").src({
            src: videoPath,
        });
        this.e.find("#detail-description").text(description);
        this.e.find("#detail-level").text(subscriptionType);
        this.e.find("#detail-title").text(title);
    };
    Modal.prototype.showDetail = function (event) {
        $("#content-detail").modal("show");
        var index = parseInt($(event.target).attr("data-detail-index"));
        var Selected = this.data[index];
        this.modalDetail(Selected);
    };
    return Modal;
}());
exports.default = Modal;


/***/ }),
/* 7 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var NotFoundCard = function () {
    var element = "\n     \n\n  <div class=\"col-12\">\n        <div class=\"card card-body\">\n         <h3>No Matching Content Found :(</h3>\n            </div>\n        </div>\n    </div>\n  \n\n    ";
    return element;
};
exports.default = NotFoundCard;


/***/ }),
/* 8 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var DataName = "data-pagination-card";
var DataCardPlugins = function () { return window["DataCard"]; };
var renderPagination = function (TotalPage) {
    var DC = DataCardPlugins();
    var page = DC.configure.page;
    var html = "\n    \n\n      <li class=\"page-item " + (page === 1 ? "disabled" : "") + "\">\n        <a class=\"page-link\" href=\"javscript:void(0)\" " + DataName + "=" + (page - 1) + ">\n          &laquo;\n        </a>\n      </li>\n\n      " + renderPaginationItems(TotalPage) + "\n \n\n    <li class=\"page-item " + (page === TotalPage ? "disabled" : "") + "\">\n      <a class=\"page-link\" href=\"javscript:void(0)\" " + DataName + "=" + (page + 1) + ">\n      &raquo;\n      </a>\n    </li>\n    \n\n    ";
    compileToDOM(html);
};
var renderPaginationItems = function (totalPage) {
    return pagination(DataCardPlugins().configure.page, totalPage)
        .map(paginateItems)
        .join("\n");
};
var paginateItems = function (num) { return "\n  \n\n  <li class=\"page-item " + (num === "..." ? "disabled" : "") + " \n  " + (DataCardPlugins().configure.page === num ? "active" : "") + "\">\n    <a class=\"page-link\" href=\"javscript:void(0)\" " + DataName + "=" + num + ">\n      " + num + "\n    </a>\n  </li>\n  \n\n  "; };
var compileToDOM = function (html) {
    var p = $("#pagination-card");
    p.html(html);
    // After Render Adding Active To First Pagination Link
    componentDidMount(p);
};
// create event after rendering page
var componentDidMount = function (p) {
    var DataPlugins = DataCardPlugins();
    p.find("[" + DataName + "=\"" + DataPlugins.configure.page + "\"]").addClass("active");
    // Event Click On link page
    var listItemClick = function (event) {
        var pgLink = $(event.target);
        var pageNum = parseInt(pgLink.attr(DataName));
        var hasPage = DataPlugins.configure.page === pageNum;
        var totalPage = DataPlugins.setting.totalPage;
        if (hasPage || pageNum === NaN || pageNum > totalPage || pageNum < 1)
            return;
        DataPlugins.loadPage(pageNum);
        renderPagination(totalPage);
    };
    p.find("a.page-link").on("click", listItemClick);
};
function pagination(c, m) {
    // execute when one page only
    console.log(m);
    if (m === 0 || m === 1)
        return [1];
    var delta = 2, range = [], rangeWithDots = [], l;
    range.push(1);
    for (var i = c - delta; i <= c + delta; i++) {
        if (i < m && i > 1) {
            range.push(i);
        }
    }
    range.push(m);
    for (var _i = 0, range_1 = range; _i < range_1.length; _i++) {
        var i = range_1[_i];
        if (l) {
            if (i - l === 2) {
                rangeWithDots.push(l + 1);
            }
            else if (i - l !== 1) {
                rangeWithDots.push("...");
            }
        }
        rangeWithDots.push(i);
        l = i;
    }
    return rangeWithDots;
}
exports.default = renderPagination;


/***/ }),
/* 9 */
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var search_1 = __webpack_require__(10);
var register = [search_1.default];
var RegisterEvent = /** @class */ (function () {
    function RegisterEvent() {
    }
    RegisterEvent.prototype.register = function () {
        register.forEach(function (regEvent) {
            return $(regEvent.selector).on(regEvent.type, regEvent.closure);
        });
        console.log("All Event Has Been Registred");
    };
    RegisterEvent.prototype.DebugMode = function (regEvent, closure) {
        console.log(regEvent);
    };
    return RegisterEvent;
}());
exports.default = RegisterEvent;


/***/ }),
/* 10 */
/***/ (function(__unused_webpack_module, exports, __webpack_require__) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var eventHandler_1 = __webpack_require__(11);
var SearchEvent = /** @class */ (function () {
    function SearchEvent() {
        this.type = "input";
        this.selector = "#crudTable_filter input";
        this.delayTyping = 300;
        this.TimeoutContainer = setTimeout(function () { }, 0);
    }
    SearchEvent.prototype.Input = function (event) {
        var val = event.target.value;
        window["DataCard"].ajax(null, val);
    };
    SearchEvent.prototype.closure = function () {
        return this.DelayInput.bind(this);
    };
    /**
     * Event Delaying Input
     *
     */
    SearchEvent.prototype.DelayInput = function (event) {
        clearTimeout(this.TimeoutContainer);
        // can call this references from this class
        var input = this.Input.bind(this, event);
        this.TimeoutContainer = setTimeout(function () { return input(); }, this.delayTyping);
    };
    return SearchEvent;
}());
var Search = eventHandler_1.default(SearchEvent);
exports.default = Search;


/***/ }),
/* 11 */
/***/ (function(__unused_webpack_module, exports) {


Object.defineProperty(exports, "__esModule", ({ value: true }));
var Registry = function (RegisterClass) {
    var cls = new RegisterClass();
    return {
        closure: cls.closure(),
        selector: cls.selector,
        type: cls.type,
    };
};
exports.default = Registry;


/***/ })
/******/ 	]);
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
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
/************************************************************************/
/******/ 	// startup
/******/ 	// Load entry module
/******/ 	__webpack_require__(0);
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;
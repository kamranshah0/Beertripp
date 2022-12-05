;
(function (factory) {
    if (typeof define === 'function' && define.amd) {

        define(['jquery'], factory);
    } else if (typeof exports === 'object') {

        factory(require('jquery'));
    } else {

        factory(window.jQuery || window.Zepto);
    }
}(function ($) {


    var CLOSE_EVENT = 'Close',
            BEFORE_CLOSE_EVENT = 'BeforeClose',
            AFTER_CLOSE_EVENT = 'AfterClose',
            BEFORE_APPEND_EVENT = 'BeforeAppend',
            MARKUP_PARSE_EVENT = 'MarkupParse',
            OPEN_EVENT = 'Open',
            CHANGE_EVENT = 'Change',
            NS = 'Oxipopup',
            EVENT_NS = '.' + NS,
            READY_CLASS = 'Oxipopup-ready',
            REMOVING_CLASS = 'Oxipopup-removing',
            PREVENT_CLOSE_CLASS = 'Oxipopup-prevent-close';



    var Oxipopup,
            OxiZenPopup = function () {},
            _isJQ = !!(window.jQuery),
            _prevStatus,
            _window = $(window),
            _document,
            _prevContentType,
            _wrapClasses,
            _currPopupType;



    var _OxipopupOn = function (name, f) {
        Oxipopup.ev.on(NS + name + EVENT_NS, f);
    },
            _getEl = function (className, appendTo, html, raw) {
                var el = document.createElement('div');
                el.className = 'Oxipopup-' + className;
                if (html) {
                    el.innerHTML = html;
                }
                if (!raw) {
                    el = $(el);
                    if (appendTo) {
                        el.appendTo(appendTo);
                    }
                } else if (appendTo) {
                    appendTo.appendChild(el);
                }
                return el;
            },
            _OxipopupTrigger = function (e, data) {
                Oxipopup.ev.triggerHandler(NS + e, data);

                if (Oxipopup.st.callbacks) {

                    e = e.charAt(0).toLowerCase() + e.slice(1);
                    if (Oxipopup.st.callbacks[e]) {
                        Oxipopup.st.callbacks[e].apply(Oxipopup, $.isArray(data) ? data : [data]);
                    }
                }
            },
            _getCloseBtn = function (type) {
                if (type !== _currPopupType || !Oxipopup.currTemplate.closeBtn) {
                    Oxipopup.currTemplate.closeBtn = $(Oxipopup.st.closeMarkup.replace('%title%', Oxipopup.st.tClose));
                    _currPopupType = type;
                }
                return Oxipopup.currTemplate.closeBtn;
            },
            _checkInstance = function () {
                if (!$.OxizenPopup.instance) {

                    Oxipopup = new OxiZenPopup();
                    Oxipopup.init();
                    $.OxizenPopup.instance = Oxipopup;
                }
            },
            supportsTransitions = function () {
                var s = document.createElement('p').style,
                        v = ['ms', 'O', 'Moz', 'Webkit'];

                if (s['transition'] !== undefined) {
                    return true;
                }

                while (v.length) {
                    if (v.pop() + 'Transition' in s) {
                        return true;
                    }
                }

                return false;
            };




    OxiZenPopup.prototype = {

        constructor: OxiZenPopup,

        init: function () {
            var appVersion = navigator.appVersion;
            Oxipopup.isLowIE = Oxipopup.isIE8 = document.all && !document.addEventListener;
            Oxipopup.isAndroid = (/android/gi).test(appVersion);
            Oxipopup.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
            Oxipopup.supportsTransition = supportsTransitions();

            Oxipopup.probablyMobile = (Oxipopup.isAndroid || Oxipopup.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent));
            _document = $(document);

            Oxipopup.popupsCache = {};
        },

        open: function (data) {

            var i;

            if (data.isObj === false) {
                Oxipopup.items = data.items.toArray();

                Oxipopup.index = 0;
                var items = data.items,
                        item;
                for (i = 0; i < items.length; i++) {
                    item = items[i];
                    if (item.parsed) {
                        item = item.el[0];
                    }
                    if (item === data.el[0]) {
                        Oxipopup.index = i;
                        break;
                    }
                }
            } else {
                Oxipopup.items = $.isArray(data.items) ? data.items : [data.items];
                Oxipopup.index = data.index || 0;
            }

            if (Oxipopup.isOpen) {
                Oxipopup.updateItemHTML();
                return;
            }

            Oxipopup.types = [];
            _wrapClasses = '';
            if (data.mainEl && data.mainEl.length) {
                Oxipopup.ev = data.mainEl.eq(0);
            } else {
                Oxipopup.ev = _document;
            }

            if (data.key) {
                if (!Oxipopup.popupsCache[data.key]) {
                    Oxipopup.popupsCache[data.key] = {};
                }
                Oxipopup.currTemplate = Oxipopup.popupsCache[data.key];
            } else {
                Oxipopup.currTemplate = {};
            }



            Oxipopup.st = $.extend(true, {}, $.OxizenPopup.defaults, data);
            Oxipopup.fixedContentPos = Oxipopup.st.fixedContentPos === 'auto' ? !Oxipopup.probablyMobile : Oxipopup.st.fixedContentPos;

            if (Oxipopup.st.modal) {
                Oxipopup.st.closeOnContentClick = false;
                Oxipopup.st.closeOnBgClick = false;
                Oxipopup.st.showCloseBtn = false;
                Oxipopup.st.enableEscapeKey = false;
            }


            if (!Oxipopup.bgOverlay) {


                Oxipopup.bgOverlay = _getEl('bg').on('click' + EVENT_NS, function () {
                    Oxipopup.close();
                });

                Oxipopup.wrap = _getEl('wrap').attr('tabindex', -1).on('click' + EVENT_NS, function (e) {
                    if (Oxipopup._checkIfClose(e.target)) {
                        Oxipopup.close();
                    }
                });

                Oxipopup.container = _getEl('container', Oxipopup.wrap);
            }

            Oxipopup.contentContainer = _getEl('content');
            if (Oxipopup.st.preloader) {
                Oxipopup.preloader = _getEl('preloader', Oxipopup.container, Oxipopup.st.tLoading);
            }



            var modules = $.OxizenPopup.modules;
            for (i = 0; i < modules.length; i++) {
                var n = modules[i];
                n = n.charAt(0).toUpperCase() + n.slice(1);
                Oxipopup['init' + n].call(Oxipopup);
            }
            _OxipopupTrigger('BeforeOpen');


            if (Oxipopup.st.showCloseBtn) {

                if (!Oxipopup.st.closeBtnInside) {
                    Oxipopup.wrap.append(_getCloseBtn());
                } else {
                    _OxipopupOn(MARKUP_PARSE_EVENT, function (e, template, values, item) {
                        values.close_replaceWith = _getCloseBtn(item.type);
                    });
                    _wrapClasses += ' Oxipopup-close-btn-in';
                }
            }

            if (Oxipopup.st.alignTop) {
                _wrapClasses += ' Oxipopup-align-top';
            }



            if (Oxipopup.fixedContentPos) {
                Oxipopup.wrap.css({
                    overflow: Oxipopup.st.overflowY,
                    overflowX: 'hidden',
                    overflowY: Oxipopup.st.overflowY
                });
            } else {
                Oxipopup.wrap.css({
                    top: _window.scrollTop(),
                    position: 'absolute'
                });
            }
            if (Oxipopup.st.fixedBgPos === false || (Oxipopup.st.fixedBgPos === 'auto' && !Oxipopup.fixedContentPos)) {
                Oxipopup.bgOverlay.css({
                    height: _document.height(),
                    position: 'absolute'
                });
            }



            if (Oxipopup.st.enableEscapeKey) {
                _document.on('keyup' + EVENT_NS, function (e) {
                    if (e.keyCode === 27) {
                        Oxipopup.close();
                    }
                });
            }

            _window.on('resize' + EVENT_NS, function () {
                Oxipopup.updateSize();
            });


            if (!Oxipopup.st.closeOnContentClick) {
                _wrapClasses += ' Oxipopup-auto-cursor';
            }

            if (_wrapClasses)
                Oxipopup.wrap.addClass(_wrapClasses);


            var windowHeight = Oxipopup.wH = _window.height();


            var windowStyles = {};

            if (Oxipopup.fixedContentPos) {
                if (Oxipopup._hasScrollBar(windowHeight)) {
                    var s = Oxipopup._getScrollbarSize();
                    if (s) {
                        windowStyles.marginRight = s;
                    }
                }
            }

            if (Oxipopup.fixedContentPos) {
                if (!Oxipopup.isIE7) {
                    windowStyles.overflow = 'hidden';
                } else {

                    $('body, html').css('overflow', 'hidden');
                }
            }



            var classesToadd = Oxipopup.st.mainClass;
            if (Oxipopup.isIE7) {
                classesToadd += ' Oxipopup-ie7';
            }
            if (classesToadd) {
                Oxipopup._addClassToOPU(classesToadd);
            }


            Oxipopup.updateItemHTML();

            _OxipopupTrigger('BuildControls');


            $('html').css(windowStyles);


            Oxipopup.bgOverlay.add(Oxipopup.wrap).prependTo(Oxipopup.st.prependTo || $(document.body));


            Oxipopup._lastFocusedEl = document.activeElement;


            setTimeout(function () {

                if (Oxipopup.content) {
                    Oxipopup._addClassToOPU(READY_CLASS);
                    Oxipopup._setFocus();
                } else {

                    Oxipopup.bgOverlay.addClass(READY_CLASS);
                }


                _document.on('focusin' + EVENT_NS, Oxipopup._onFocusIn);

            }, 16);

            Oxipopup.isOpen = true;
            Oxipopup.updateSize(windowHeight);
            _OxipopupTrigger(OPEN_EVENT);

            return data;
        },

        close: function () {
            if (!Oxipopup.isOpen)
                return;
            _OxipopupTrigger(BEFORE_CLOSE_EVENT);

            Oxipopup.isOpen = false;

            if (Oxipopup.st.removalDelay && !Oxipopup.isLowIE && Oxipopup.supportsTransition) {
                Oxipopup._addClassToOPU(REMOVING_CLASS);
                setTimeout(function () {
                    Oxipopup._close();
                }, Oxipopup.st.removalDelay);
            } else {
                Oxipopup._close();
            }
        },

        _close: function () {
            _OxipopupTrigger(CLOSE_EVENT);

            var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

            Oxipopup.bgOverlay.detach();
            Oxipopup.wrap.detach();
            Oxipopup.container.empty();

            if (Oxipopup.st.mainClass) {
                classesToRemove += Oxipopup.st.mainClass + ' ';
            }

            Oxipopup._removeClassFromOPU(classesToRemove);

            if (Oxipopup.fixedContentPos) {
                var windowStyles = {marginRight: ''};
                if (Oxipopup.isIE7) {
                    $('body, html').css('overflow', '');
                } else {
                    windowStyles.overflow = '';
                }
                $('html').css(windowStyles);
            }

            _document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
            Oxipopup.ev.off(EVENT_NS);


            Oxipopup.wrap.attr('class', 'Oxipopup-wrap').removeAttr('style');
            Oxipopup.bgOverlay.attr('class', 'Oxipopup-bg');
            Oxipopup.container.attr('class', 'Oxipopup-container');


            if (Oxipopup.st.showCloseBtn &&
                    (!Oxipopup.st.closeBtnInside || Oxipopup.currTemplate[Oxipopup.currItem.type] === true)) {
                if (Oxipopup.currTemplate.closeBtn)
                    Oxipopup.currTemplate.closeBtn.detach();
            }


            if (Oxipopup.st.autoFocusLast && Oxipopup._lastFocusedEl) {
                $(Oxipopup._lastFocusedEl).focus(); 
            }
            Oxipopup.currItem = null;
            Oxipopup.content = null;
            Oxipopup.currTemplate = null;
            Oxipopup.prevHeight = 0;

            _OxipopupTrigger(AFTER_CLOSE_EVENT);
        },

        updateSize: function (winHeight) {

            if (Oxipopup.isIOS) {

                var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
                var height = window.innerHeight * zoomLevel;
                Oxipopup.wrap.css('height', height);
                Oxipopup.wH = height;
            } else {
                Oxipopup.wH = winHeight || _window.height();
            }

            if (!Oxipopup.fixedContentPos) {
                Oxipopup.wrap.css('height', Oxipopup.wH);
            }

            _OxipopupTrigger('Resize');

        },

        updateItemHTML: function () {
            var item = Oxipopup.items[Oxipopup.index];


            Oxipopup.contentContainer.detach();

            if (Oxipopup.content)
                Oxipopup.content.detach();

            if (!item.parsed) {
                item = Oxipopup.parseEl(Oxipopup.index);
            }

            var type = item.type;

            _OxipopupTrigger('BeforeChange', [Oxipopup.currItem ? Oxipopup.currItem.type : '', type]);

            Oxipopup.currItem = item;

            if (!Oxipopup.currTemplate[type]) {
                var markup = Oxipopup.st[type] ? Oxipopup.st[type].markup : false;


                _OxipopupTrigger('FirstMarkupParse', markup);

                if (markup) {
                    Oxipopup.currTemplate[type] = $(markup);
                } else {

                    Oxipopup.currTemplate[type] = true;
                }
            }

            if (_prevContentType && _prevContentType !== item.type) {
                Oxipopup.container.removeClass('Oxipopup-' + _prevContentType + '-holder');
            }

            var newContent = Oxipopup['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, Oxipopup.currTemplate[type]);
            Oxipopup.appendContent(newContent, type);

            item.preloaded = true;

            _OxipopupTrigger(CHANGE_EVENT, item);
            _prevContentType = item.type;


            Oxipopup.container.prepend(Oxipopup.contentContainer);

            _OxipopupTrigger('AfterChange');
        },

        appendContent: function (newContent, type) {
            Oxipopup.content = newContent;

            if (newContent) {
                if (Oxipopup.st.showCloseBtn && Oxipopup.st.closeBtnInside &&
                        Oxipopup.currTemplate[type] === true) {
                   
                    if (!Oxipopup.content.find('.Oxipopup-close').length) {
                        Oxipopup.content.append(_getCloseBtn());
                    }
                } else {
                    Oxipopup.content = newContent;
                }
            } else {
                Oxipopup.content = '';
            }

            _OxipopupTrigger(BEFORE_APPEND_EVENT);
            Oxipopup.container.addClass('Oxipopup-' + type + '-holder');

            Oxipopup.contentContainer.append(Oxipopup.content);
        },

        parseEl: function (index) {
            var item = Oxipopup.items[index],
                    type;

            if (item.tagName) {
                item = {el: $(item)};
            } else {
                type = item.type;
                item = {data: item, src: item.src};
            }

            if (item.el) {
                var types = Oxipopup.types;

                for (var i = 0; i < types.length; i++) {
                    if (item.el.hasClass('Oxipopup-' + types[i])) {
                        type = types[i];
                        break;
                    }
                }

                item.src = item.el.attr('data-Oxipopup-src');
                if (!item.src) {
                    item.src = item.el.attr('href');
                }
            }

            item.type = type || Oxipopup.st.type || 'inline';
            item.index = index;
            item.parsed = true;
            Oxipopup.items[index] = item;
            _OxipopupTrigger('ElementParse', item);

            return Oxipopup.items[index];
        },

        addGroup: function (el, options) {
            var eHandler = function (e) {
                e.OxipopupEl = this;
                Oxipopup._openClick(e, el, options);
            };

            if (!options) {
                options = {};
            }

            var eName = 'click.OxizenPopup';
            options.mainEl = el;

            if (options.items) {
                options.isObj = true;
                el.off(eName).on(eName, eHandler);
            } else {
                options.isObj = false;
                if (options.delegate) {
                    el.off(eName).on(eName, options.delegate, eHandler);
                } else {
                    options.items = el;
                    el.off(eName).on(eName, eHandler);
                }
            }
        },
        _openClick: function (e, el, options) {
            var midClick = options.midClick !== undefined ? options.midClick : $.OxizenPopup.defaults.midClick;


            if (!midClick && (e.which === 2 || e.ctrlKey || e.metaKey || e.altKey || e.shiftKey)) {
                return;
            }

            var disableOn = options.disableOn !== undefined ? options.disableOn : $.OxizenPopup.defaults.disableOn;

            if (disableOn) {
                if ($.isFunction(disableOn)) {
                    if (!disableOn.call(Oxipopup)) {
                        return true;
                    }
                } else {
                    if (_window.width() < disableOn) {
                        return true;
                    }
                }
            }

            if (e.type) {
                e.preventDefault();

                if (Oxipopup.isOpen) {
                    e.stopPropagation();
                }
            }

            options.el = $(e.OxipopupEl);
            if (options.delegate) {
                options.items = el.find(options.delegate);
            }
            Oxipopup.open(options);
        },

        updateStatus: function (status, text) {

            if (Oxipopup.preloader) {
                if (_prevStatus !== status) {
                    Oxipopup.container.removeClass('Oxipopup-s-' + _prevStatus);
                }

                if (!text && status === 'loading') {
                    text = Oxipopup.st.tLoading;
                }

                var data = {
                    status: status,
                    text: text
                };

                _OxipopupTrigger('UpdateStatus', data);

                status = data.status;
                text = data.text;

                Oxipopup.preloader.html(text);

                Oxipopup.preloader.find('a').on('click', function (e) {
                    e.stopImmediatePropagation();
                });

                Oxipopup.container.addClass('Oxipopup-s-' + status);
                _prevStatus = status;
            }
        },

        _checkIfClose: function (target) {

            if ($(target).hasClass(PREVENT_CLOSE_CLASS)) {
                return;
            }

            var closeOnContent = Oxipopup.st.closeOnContentClick;
            var closeOnBg = Oxipopup.st.closeOnBgClick;

            if (closeOnContent && closeOnBg) {
                return true;
            } else {

                if (!Oxipopup.content || $(target).hasClass('Oxipopup-close') || (Oxipopup.preloader && target === Oxipopup.preloader[0])) {
                    return true;
                }


                if ((target !== Oxipopup.content[0] && !$.contains(Oxipopup.content[0], target))) {
                    if (closeOnBg) {
                       
                        if ($.contains(document, target)) {
                            return true;
                        }
                    }
                } else if (closeOnContent) {
                    return true;
                }

            }
            return false;
        },
        _addClassToOPU: function (cName) {
            Oxipopup.bgOverlay.addClass(cName);
            Oxipopup.wrap.addClass(cName);
        },
        _removeClassFromOPU: function (cName) {
            this.bgOverlay.removeClass(cName);
            Oxipopup.wrap.removeClass(cName);
        },
        _hasScrollBar: function (winHeight) {
            return ((Oxipopup.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()));
        },
        _setFocus: function () {
            (Oxipopup.st.focus ? Oxipopup.content.find(Oxipopup.st.focus).eq(0) : Oxipopup.wrap).focus();
        },
        _onFocusIn: function (e) {
            if (e.target !== Oxipopup.wrap[0] && !$.contains(Oxipopup.wrap[0], e.target)) {
                Oxipopup._setFocus();
                return false;
            }
        },
        _parseMarkup: function (template, values, item) {
            var arr;
            if (item.data) {
                values = $.extend(item.data, values);
            }
            _OxipopupTrigger(MARKUP_PARSE_EVENT, [template, values, item]);

            $.each(values, function (key, value) {
                if (value === undefined || value === false) {
                    return true;
                }
                arr = key.split('_');
                if (arr.length > 1) {
                    var el = template.find(EVENT_NS + '-' + arr[0]);

                    if (el.length > 0) {
                        var attr = arr[1];
                        if (attr === 'replaceWith') {
                            if (el[0] !== value[0]) {
                                el.replaceWith(value);
                            }
                        } else if (attr === 'img') {
                            if (el.is('img')) {
                                el.attr('src', value);
                            } else {
                                el.replaceWith($('<img>').attr('src', value).attr('class', el.attr('class')));
                            }
                        } else {
                            el.attr(arr[1], value);
                        }
                    }

                } else {
                    template.find(EVENT_NS + '-' + key).html(value);
                }
            });
        },

        _getScrollbarSize: function () {

            if (Oxipopup.scrollbarSize === undefined) {
                var scrollDiv = document.createElement("div");
                scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
                document.body.appendChild(scrollDiv);
                Oxipopup.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
                document.body.removeChild(scrollDiv);
            }
            return Oxipopup.scrollbarSize;
        }

    };




    $.OxizenPopup = {
        instance: null,
        proto: OxiZenPopup.prototype,
        modules: [],

        open: function (options, index) {
            _checkInstance();

            if (!options) {
                options = {};
            } else {
                options = $.extend(true, {}, options);
            }

            options.isObj = true;
            options.index = index || 0;
            return this.instance.open(options);
        },

        close: function () {
            return $.OxizenPopup.instance && $.OxizenPopup.instance.close();
        },

        registerModule: function (name, module) {
            if (module.options) {
                $.OxizenPopup.defaults[name] = module.options;
            }
            $.extend(this.proto, module.proto);
            this.modules.push(name);
        },

        defaults: {

            disableOn: 0,

            key: null,

            midClick: false,

            mainClass: '',

            preloader: true,

            focus: '',

            closeOnContentClick: false,

            closeOnBgClick: true,

            closeBtnInside: true,

            showCloseBtn: true,

            enableEscapeKey: true,

            modal: false,

            alignTop: false,

            removalDelay: 0,

            prependTo: null,

            fixedContentPos: 'auto',

            fixedBgPos: 'auto',

            overflowY: 'auto',

            closeMarkup: '<button title="%title%" type="button" class="Oxipopup-close">&#215;</button>',

            tClose: 'Close (Esc)',

            tLoading: 'Loading...',

            autoFocusLast: true

        }
    };



    $.fn.OxizenPopup = function (options) {
        _checkInstance();

        var jqEl = $(this);

        if (typeof options === "string") {

            if (options === 'open') {
                var items,
                        itemOpts = _isJQ ? jqEl.data('OxizenPopup') : jqEl[0].OxizenPopup,
                        index = parseInt(arguments[1], 10) || 0;

                if (itemOpts.items) {
                    items = itemOpts.items[index];
                } else {
                    items = jqEl;
                    if (itemOpts.delegate) {
                        items = items.find(itemOpts.delegate);
                    }
                    items = items.eq(index);
                }
                Oxipopup._openClick({OxipopupEl: items}, jqEl, itemOpts);
            } else {
                if (Oxipopup.isOpen)
                    Oxipopup[options].apply(Oxipopup, Array.prototype.slice.call(arguments, 1));
            }

        } else {

            options = $.extend(true, {}, options);


            if (_isJQ) {
                jqEl.data('OxizenPopup', options);
            } else {
                jqEl[0].OxizenPopup = options;
            }

            Oxipopup.addGroup(jqEl, options);

        }
        return jqEl;
    };



    var INLINE_NS = 'inline',
            _hiddenClass,
            _inlinePlaceholder,
            _lastInlineElement,
            _putInlineElementsBack = function () {
                if (_lastInlineElement) {
                    _inlinePlaceholder.after(_lastInlineElement.addClass(_hiddenClass)).detach();
                    _lastInlineElement = null;
                }
            };

    $.OxizenPopup.registerModule(INLINE_NS, {
        options: {
            hiddenClass: 'hide', 
            markup: '',
            tNotFound: 'Content not found'
        },
        proto: {

            initInline: function () {
                Oxipopup.types.push(INLINE_NS);

                _OxipopupOn(CLOSE_EVENT + '.' + INLINE_NS, function () {
                    _putInlineElementsBack();
                });
            },

            getInline: function (item, template) {

                _putInlineElementsBack();

                if (item.src) {
                    var inlineSt = Oxipopup.st.inline,
                            el = $(item.src);

                    if (el.length) {

                        var parent = el[0].parentNode;
                        if (parent && parent.tagName) {
                            if (!_inlinePlaceholder) {
                                _hiddenClass = inlineSt.hiddenClass;
                                _inlinePlaceholder = _getEl(_hiddenClass);
                                _hiddenClass = 'Oxipopup-' + _hiddenClass;
                            }

                            _lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
                        }

                        Oxipopup.updateStatus('ready');
                    } else {
                        Oxipopup.updateStatus('error', inlineSt.tNotFound);
                        el = $('<div>');
                    }

                    item.inlineElement = el;
                    return el;
                }

                Oxipopup.updateStatus('ready');
                Oxipopup._parseMarkup(template, {}, item);
                return template;
            }
        }
    });


    var AJAX_NS = 'ajax',
            _ajaxCur,
            _removeAjaxCursor = function () {
                if (_ajaxCur) {
                    $(document.body).removeClass(_ajaxCur);
                }
            },
            _destroyAjaxRequest = function () {
                _removeAjaxCursor();
                if (Oxipopup.req) {
                    Oxipopup.req.abort();
                }
            };

    $.OxizenPopup.registerModule(AJAX_NS, {

        options: {
            settings: null,
            cursor: 'Oxipopup-ajax-cur',
            tError: '<a href="%url%">The content</a> could not be loaded.'
        },

        proto: {
            initAjax: function () {
                Oxipopup.types.push(AJAX_NS);
                _ajaxCur = Oxipopup.st.ajax.cursor;

                _OxipopupOn(CLOSE_EVENT + '.' + AJAX_NS, _destroyAjaxRequest);
                _OxipopupOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
            },
            getAjax: function (item) {

                if (_ajaxCur) {
                    $(document.body).addClass(_ajaxCur);
                }

                Oxipopup.updateStatus('loading');

                var opts = $.extend({
                    url: item.src,
                    success: function (data, textStatus, jqXHR) {
                        var temp = {
                            data: data,
                            xhr: jqXHR
                        };

                        _OxipopupTrigger('ParseAjax', temp);

                        Oxipopup.appendContent($(temp.data), AJAX_NS);

                        item.finished = true;

                        _removeAjaxCursor();

                        Oxipopup._setFocus();

                        setTimeout(function () {
                            Oxipopup.wrap.addClass(READY_CLASS);
                        }, 16);

                        Oxipopup.updateStatus('ready');

                        _OxipopupTrigger('AjaxContentAdded');
                    },
                    error: function () {
                        _removeAjaxCursor();
                        item.finished = item.loadError = true;
                        Oxipopup.updateStatus('error', Oxipopup.st.ajax.tError.replace('%url%', item.src));
                    }
                }, Oxipopup.st.ajax.settings);

                Oxipopup.req = $.ajax(opts);

                return '';
            }
        }
    });


    var _imgInterval,
            _getTitle = function (item) {
                if (item.data && item.data.title !== undefined)
                    return item.data.title;

                var src = Oxipopup.st.image.titleSrc;

                if (src) {
                    if ($.isFunction(src)) {
                        return src.call(Oxipopup, item);
                    } else if (item.el) {
                        return item.el.attr(src) || '';
                    }
                }
                return '';
            };

    $.OxizenPopup.registerModule('image', {

        options: {
            markup: '<div class="Oxipopup-figure">' +
                    '<div class="Oxipopup-close"></div>' +
                    '<figure>' +
                    '<div class="Oxipopup-img"></div>' +
                    '<figcaption>' +
                    '<div class="Oxipopup-bottom-bar">' +
                    '<div class="Oxipopup-title"></div>' +
                    '<div class="Oxipopup-counter"></div>' +
                    '</div>' +
                    '</figcaption>' +
                    '</figure>' +
                    '</div>',
            cursor: 'Oxipopup-zoom-out-cur',
            titleSrc: 'title',
            verticalFit: true,
            tError: '<a href="%url%">The image</a> could not be loaded.'
        },

        proto: {
            initImage: function () {
                var imgSt = Oxipopup.st.image,
                        ns = '.image';

                Oxipopup.types.push('image');

                _OxipopupOn(OPEN_EVENT + ns, function () {
                    if (Oxipopup.currItem.type === 'image' && imgSt.cursor) {
                        $(document.body).addClass(imgSt.cursor);
                    }
                });

                _OxipopupOn(CLOSE_EVENT + ns, function () {
                    if (imgSt.cursor) {
                        $(document.body).removeClass(imgSt.cursor);
                    }
                    _window.off('resize' + EVENT_NS);
                });

                _OxipopupOn('Resize' + ns, Oxipopup.resizeImage);
                if (Oxipopup.isLowIE) {
                    _OxipopupOn('AfterChange', Oxipopup.resizeImage);
                }
            },
            resizeImage: function () {
                var item = Oxipopup.currItem;
                if (!item || !item.img)
                    return;

                if (Oxipopup.st.image.verticalFit) {
                    var decr = 0;
                    if (Oxipopup.isLowIE) {
                        decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'), 10);
                    }
                    item.img.css('max-height', Oxipopup.wH - decr);
                }
            },
            _onImageHasSize: function (item) {
                if (item.img) {

                    item.hasSize = true;

                    if (_imgInterval) {
                        clearInterval(_imgInterval);
                    }

                    item.isCheckingImgSize = false;

                    _OxipopupTrigger('ImageHasSize', item);

                    if (item.imgHidden) {
                        if (Oxipopup.content)
                            Oxipopup.content.removeClass('Oxipopup-loading');

                        item.imgHidden = false;
                    }

                }
            },

            findImageSize: function (item) {

                var counter = 0,
                        img = item.img[0],
                        OxipopupSetInterval = function (delay) {

                            if (_imgInterval) {
                                clearInterval(_imgInterval);
                            }
                            _imgInterval = setInterval(function () {
                                if (img.naturalWidth > 0) {
                                    Oxipopup._onImageHasSize(item);
                                    return;
                                }

                                if (counter > 200) {
                                    clearInterval(_imgInterval);
                                }

                                counter++;
                                if (counter === 3) {
                                    OxipopupSetInterval(10);
                                } else if (counter === 40) {
                                    OxipopupSetInterval(50);
                                } else if (counter === 100) {
                                    OxipopupSetInterval(500);
                                }
                            }, delay);
                        };

                OxipopupSetInterval(1);
            },

            getImage: function (item, template) {

                var guard = 0,
                        onLoadComplete = function () {
                            if (item) {
                                if (item.img[0].complete) {
                                    item.img.off('.Oxipopuploader');

                                    if (item === Oxipopup.currItem) {
                                        Oxipopup._onImageHasSize(item);

                                        Oxipopup.updateStatus('ready');
                                    }

                                    item.hasSize = true;
                                    item.loaded = true;

                                    _OxipopupTrigger('ImageLoadComplete');

                                } else {
                                    guard++;
                                    if (guard < 200) {
                                        setTimeout(onLoadComplete, 100);
                                    } else {
                                        onLoadError();
                                    }
                                }
                            }
                        },
                        onLoadError = function () {
                            if (item) {
                                item.img.off('.Oxipopuploader');
                                if (item === Oxipopup.currItem) {
                                    Oxipopup._onImageHasSize(item);
                                    Oxipopup.updateStatus('error', imgSt.tError.replace('%url%', item.src));
                                }

                                item.hasSize = true;
                                item.loaded = true;
                                item.loadError = true;
                            }
                        },
                        imgSt = Oxipopup.st.image;


                var el = template.find('.Oxipopup-img');
                if (el.length) {
                    var img = document.createElement('img');
                    img.className = 'Oxipopup-img';
                    if (item.el && item.el.find('img').length) {
                        img.alt = item.el.find('img').attr('alt');
                    }
                    item.img = $(img).on('load.Oxipopuploader', onLoadComplete).on('error.Oxipopuploader', onLoadError);
                    img.src = item.src;

                    if (el.is('img')) {
                        item.img = item.img.clone();
                    }

                    img = item.img[0];
                    if (img.naturalWidth > 0) {
                        item.hasSize = true;
                    } else if (!img.width) {
                        item.hasSize = false;
                    }
                }

                Oxipopup._parseMarkup(template, {
                    title: _getTitle(item),
                    img_replaceWith: item.img
                }, item);

                Oxipopup.resizeImage();

                if (item.hasSize) {
                    if (_imgInterval)
                        clearInterval(_imgInterval);

                    if (item.loadError) {
                        template.addClass('Oxipopup-loading');
                        Oxipopup.updateStatus('error', imgSt.tError.replace('%url%', item.src));
                    } else {
                        template.removeClass('Oxipopup-loading');
                        Oxipopup.updateStatus('ready');
                    }
                    return template;
                }

                Oxipopup.updateStatus('loading');
                item.loading = true;

                if (!item.hasSize) {
                    item.imgHidden = true;
                    template.addClass('Oxipopup-loading');
                    Oxipopup.findImageSize(item);
                }

                return template;
            }
        }
    });


    var hasMozTransform,
            getHasMozTransform = function () {
                if (hasMozTransform === undefined) {
                    hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
                }
                return hasMozTransform;
            };

    $.OxizenPopup.registerModule('zoom', {

        options: {
            enabled: false,
            easing: 'ease-in-out',
            duration: 300,
            opener: function (element) {
                return element.is('img') ? element : element.find('img');
            }
        },

        proto: {

            initZoom: function () {
                var zoomSt = Oxipopup.st.zoom,
                        ns = '.zoom',
                        image;

                if (!zoomSt.enabled || !Oxipopup.supportsTransition) {
                    return;
                }

                var duration = zoomSt.duration,
                        getElToAnimate = function (image) {
                            var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('Oxipopup-animated-image'),
                                    transition = 'all ' + (zoomSt.duration / 1000) + 's ' + zoomSt.easing,
                                    cssObj = {
                                        position: 'fixed',
                                        zIndex: 9999,
                                        left: 0,
                                        top: 0,
                                        '-webkit-backface-visibility': 'hidden'
                                    },
                                    t = 'transition';

                            cssObj['-webkit-' + t] = cssObj['-moz-' + t] = cssObj['-o-' + t] = cssObj[t] = transition;

                            newImg.css(cssObj);
                            return newImg;
                        },
                        showMainContent = function () {
                            Oxipopup.content.css('visibility', 'visible');
                        },
                        openTimeout,
                        animatedImg;

                _OxipopupOn('BuildControls' + ns, function () {
                    if (Oxipopup._allowZoom()) {

                        clearTimeout(openTimeout);
                        Oxipopup.content.css('visibility', 'hidden');


                        image = Oxipopup._getItemToZoom();

                        if (!image) {
                            showMainContent();
                            return;
                        }

                        animatedImg = getElToAnimate(image);

                        animatedImg.css(Oxipopup._getOffset());

                        Oxipopup.wrap.append(animatedImg);

                        openTimeout = setTimeout(function () {
                            animatedImg.css(Oxipopup._getOffset(true));
                            openTimeout = setTimeout(function () {

                                showMainContent();

                                setTimeout(function () {
                                    animatedImg.remove();
                                    image = animatedImg = null;
                                    _OxipopupTrigger('ZoomAnimationEnded');
                                }, 16);

                            }, duration);

                        }, 16);



                    }
                });
                _OxipopupOn(BEFORE_CLOSE_EVENT + ns, function () {
                    if (Oxipopup._allowZoom()) {

                        clearTimeout(openTimeout);

                        Oxipopup.st.removalDelay = duration;

                        if (!image) {
                            image = Oxipopup._getItemToZoom();
                            if (!image) {
                                return;
                            }
                            animatedImg = getElToAnimate(image);
                        }

                        animatedImg.css(Oxipopup._getOffset(true));
                        Oxipopup.wrap.append(animatedImg);
                        Oxipopup.content.css('visibility', 'hidden');

                        setTimeout(function () {
                            animatedImg.css(Oxipopup._getOffset());
                        }, 16);
                    }

                });

                _OxipopupOn(CLOSE_EVENT + ns, function () {
                    if (Oxipopup._allowZoom()) {
                        showMainContent();
                        if (animatedImg) {
                            animatedImg.remove();
                        }
                        image = null;
                    }
                });
            },

            _allowZoom: function () {
                return Oxipopup.currItem.type === 'image';
            },

            _getItemToZoom: function () {
                if (Oxipopup.currItem.hasSize) {
                    return Oxipopup.currItem.img;
                } else {
                    return false;
                }
            },

            _getOffset: function (isLarge) {
                var el;
                if (isLarge) {
                    el = Oxipopup.currItem.img;
                } else {
                    el = Oxipopup.st.zoom.opener(Oxipopup.currItem.el || Oxipopup.currItem);
                }

                var offset = el.offset();
                var paddingTop = parseInt(el.css('padding-top'), 10);
                var paddingBottom = parseInt(el.css('padding-bottom'), 10);
                offset.top -= ($(window).scrollTop() - paddingTop);



                var obj = {
                    width: el.width(),
                    
                    height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
                };


                if (getHasMozTransform()) {
                    obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
                } else {
                    obj.left = offset.left;
                    obj.top = offset.top;
                }
                return obj;
            }

        }
    });





    var IFRAME_NS = 'iframe',
            _emptyPage = '//about:blank',
            _fixIframeBugs = function (isShowing) {
                if (Oxipopup.currTemplate[IFRAME_NS]) {
                    var el = Oxipopup.currTemplate[IFRAME_NS].find('iframe');
                    if (el.length) {

                        if (!isShowing) {
                            el[0].src = _emptyPage;
                        }


                        if (Oxipopup.isIE8) {
                            el.css('display', isShowing ? 'block' : 'none');
                        }
                    }
                }
            };

    $.OxizenPopup.registerModule(IFRAME_NS, {

        options: {
            markup: '<div class="Oxipopup-iframe-scaler">' +
                    '<div class="Oxipopup-close"></div>' +
                    '<iframe class="Oxipopup-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>' +
                    '</div>',

            srcAction: 'iframe_src',

            patterns: {
                youtube: {
                    index: 'youtube.com',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                    index: '//maps.google.',
                    src: '%id%&output=embed'
                }
            }
        },

        proto: {
            initIframe: function () {
                Oxipopup.types.push(IFRAME_NS);

                _OxipopupOn('BeforeChange', function (e, prevType, newType) {
                    if (prevType !== newType) {
                        if (prevType === IFRAME_NS) {
                            _fixIframeBugs();
                        } else if (newType === IFRAME_NS) {
                            _fixIframeBugs(true);
                        }
                    }
                });

                _OxipopupOn(CLOSE_EVENT + '.' + IFRAME_NS, function () {
                    _fixIframeBugs();
                });
            },

            getIframe: function (item, template) {
                var embedSrc = item.src;
                var iframeSt = Oxipopup.st.iframe;

                $.each(iframeSt.patterns, function () {
                    if (embedSrc.indexOf(this.index) > -1) {
                        if (this.id) {
                            if (typeof this.id === 'string') {
                                embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id) + this.id.length, embedSrc.length);
                            } else {
                                embedSrc = this.id.call(this, embedSrc);
                            }
                        }
                        embedSrc = this.src.replace('%id%', embedSrc);
                        return false;
                    }
                });

                var dataObj = {};
                if (iframeSt.srcAction) {
                    dataObj[iframeSt.srcAction] = embedSrc;
                }
                Oxipopup._parseMarkup(template, dataObj, item);

                Oxipopup.updateStatus('ready');

                return template;
            }
        }
    });




    var _getLoopedId = function (index) {
        var numSlides = Oxipopup.items.length;
        if (index > numSlides - 1) {
            return index - numSlides;
        } else if (index < 0) {
            return numSlides + index;
        }
        return index;
    },
            _replaceCurrTotal = function (text, curr, total) {
                return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
            };

    $.OxizenPopup.registerModule('gallery', {

        options: {
            enabled: false,
            arrowMarkup: '<button title="%title%" type="button" class="Oxipopup-arrow Oxipopup-arrow-%dir%"></button>',
            preload: [0, 2],
            navigateByImgClick: true,
            arrows: true,

            tPrev: 'Previous (Left arrow key)',
            tNext: 'Next (Right arrow key)',
            tCounter: '%curr% of %total%'
        },

        proto: {
            initGallery: function () {

                var gSt = Oxipopup.st.gallery,
                        ns = '.Oxipopup-gallery';

                Oxipopup.direction = true;

                if (!gSt || !gSt.enabled)
                    return false;

                _wrapClasses += ' Oxipopup-gallery';

                _OxipopupOn(OPEN_EVENT + ns, function () {

                    if (gSt.navigateByImgClick) {
                        Oxipopup.wrap.on('click' + ns, '.Oxipopup-img', function () {
                            if (Oxipopup.items.length > 1) {
                                Oxipopup.next();
                                return false;
                            }
                        });
                    }

                    _document.on('keydown' + ns, function (e) {
                        if (e.keyCode === 37) {
                            Oxipopup.prev();
                        } else if (e.keyCode === 39) {
                            Oxipopup.next();
                        }
                    });
                });

                _OxipopupOn('UpdateStatus' + ns, function (e, data) {
                    if (data.text) {
                        data.text = _replaceCurrTotal(data.text, Oxipopup.currItem.index, Oxipopup.items.length);
                    }
                });

                _OxipopupOn(MARKUP_PARSE_EVENT + ns, function (e, element, values, item) {
                    var l = Oxipopup.items.length;
                    values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
                });

                _OxipopupOn('BuildControls' + ns, function () {
                    if (Oxipopup.items.length > 1 && gSt.arrows && !Oxipopup.arrowLeft) {
                        var markup = gSt.arrowMarkup,
                                arrowLeft = Oxipopup.arrowLeft = $(markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left')).addClass(PREVENT_CLOSE_CLASS),
                                arrowRight = Oxipopup.arrowRight = $(markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right')).addClass(PREVENT_CLOSE_CLASS);

                        arrowLeft.click(function () {
                            Oxipopup.prev();
                        });
                        arrowRight.click(function () {
                            Oxipopup.next();
                        });

                        Oxipopup.container.append(arrowLeft.add(arrowRight));
                    }
                });

                _OxipopupOn(CHANGE_EVENT + ns, function () {
                    if (Oxipopup._preloadTimeout)
                        clearTimeout(Oxipopup._preloadTimeout);

                    Oxipopup._preloadTimeout = setTimeout(function () {
                        Oxipopup.preloadNearbyImages();
                        Oxipopup._preloadTimeout = null;
                    }, 16);
                });


                _OxipopupOn(CLOSE_EVENT + ns, function () {
                    _document.off(ns);
                    Oxipopup.wrap.off('click' + ns);
                    Oxipopup.arrowRight = Oxipopup.arrowLeft = null;
                });

            },
            next: function () {
                Oxipopup.direction = true;
                Oxipopup.index = _getLoopedId(Oxipopup.index + 1);
                Oxipopup.updateItemHTML();
            },
            prev: function () {
                Oxipopup.direction = false;
                Oxipopup.index = _getLoopedId(Oxipopup.index - 1);
                Oxipopup.updateItemHTML();
            },
            goTo: function (newIndex) {
                Oxipopup.direction = (newIndex >= Oxipopup.index);
                Oxipopup.index = newIndex;
                Oxipopup.updateItemHTML();
            },
            preloadNearbyImages: function () {
                var p = Oxipopup.st.gallery.preload,
                        preloadBefore = Math.min(p[0], Oxipopup.items.length),
                        preloadAfter = Math.min(p[1], Oxipopup.items.length),
                        i;

                for (i = 1; i <= (Oxipopup.direction ? preloadAfter : preloadBefore); i++) {
                    Oxipopup._preloadItem(Oxipopup.index + i);
                }
                for (i = 1; i <= (Oxipopup.direction ? preloadBefore : preloadAfter); i++) {
                    Oxipopup._preloadItem(Oxipopup.index - i);
                }
            },
            _preloadItem: function (index) {
                index = _getLoopedId(index);

                if (Oxipopup.items[index].preloaded) {
                    return;
                }

                var item = Oxipopup.items[index];
                if (!item.parsed) {
                    item = Oxipopup.parseEl(index);
                }

                _OxipopupTrigger('LazyLoad', item);

                if (item.type === 'image') {
                    item.img = $('<img class="Oxipopup-img" />').on('load.Oxipopuploader', function () {
                        item.hasSize = true;
                    }).on('error.Oxipopuploader', function () {
                        item.hasSize = true;
                        item.loadError = true;
                        _OxipopupTrigger('LazyLoadError', item);
                    }).attr('src', item.src);
                }


                item.preloaded = true;
            }
        }
    });



    var RETINA_NS = 'retina';

    $.OxizenPopup.registerModule(RETINA_NS, {
        options: {
            replaceSrc: function (item) {
                return item.src.replace(/\.\w+$/, function (m) {
                    return '@2x' + m;
                });
            },
            ratio: 1
        },
        proto: {
            initRetina: function () {
                if (window.devicePixelRatio > 1) {

                    var st = Oxipopup.st.retina,
                            ratio = st.ratio;

                    ratio = !isNaN(ratio) ? ratio : ratio();

                    if (ratio > 1) {
                        _OxipopupOn('ImageHasSize' + '.' + RETINA_NS, function (e, item) {
                            item.img.css({
                                'max-width': item.img[0].naturalWidth / ratio,
                                'width': '100%'
                            });
                        });
                        _OxipopupOn('ElementParse' + '.' + RETINA_NS, function (e, item) {
                            item.src = st.replaceSrc(item, ratio);
                        });
                    }
                }

            }
        }
    });


    _checkInstance();
}));
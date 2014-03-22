/*
 * jQuery FlexSlider v2.2.0
 * Copyright 2012 WooThemes
 * Contributing Author: Tyler Smith
 */
!function($) {
    //FlexSlider: Object Instance
    $.flexslider = function(el, options) {
        var slider = $(el);
        // making variables public
        slider.vars = $.extend({}, $.flexslider.defaults, options);
        var watchedEventClearTimer, namespace = slider.vars.namespace, msGesture = window.navigator && window.navigator.msPointerEnabled && window.MSGesture, touch = ("ontouchstart" in window || msGesture || window.DocumentTouch && document instanceof DocumentTouch) && slider.vars.touch, // depricating this idea, as devices are being released with both of these events
        //eventType = (touch) ? "touchend" : "click",
        eventType = "click touchend MSPointerUp", watchedEvent = "", vertical = "vertical" === slider.vars.direction, reverse = slider.vars.reverse, carousel = slider.vars.itemWidth > 0, fade = "fade" === slider.vars.animation, asNav = "" !== slider.vars.asNavFor, methods = {}, focused = !0;
        // Store a reference to the slider object
        $.data(el, "flexslider", slider), // Private slider methods
        methods = {
            init: function() {
                slider.animating = !1, // Get current slide and make sure it is a number
                slider.currentSlide = parseInt(slider.vars.startAt ? slider.vars.startAt : 0), isNaN(slider.currentSlide) && (slider.currentSlide = 0), 
                slider.animatingTo = slider.currentSlide, slider.atEnd = 0 === slider.currentSlide || slider.currentSlide === slider.last, 
                slider.containerSelector = slider.vars.selector.substr(0, slider.vars.selector.search(" ")), 
                slider.slides = $(slider.vars.selector, slider), slider.container = $(slider.containerSelector, slider), 
                slider.count = slider.slides.length, // SYNC:
                slider.syncExists = $(slider.vars.sync).length > 0, // SLIDE:
                "slide" === slider.vars.animation && (slider.vars.animation = "swing"), slider.prop = vertical ? "top" : "marginLeft", 
                slider.args = {}, // SLIDESHOW:
                slider.manualPause = !1, slider.stopped = !1, //PAUSE WHEN INVISIBLE
                slider.started = !1, slider.startTimeout = null, // TOUCH/USECSS:
                slider.transitions = !slider.vars.video && !fade && slider.vars.useCSS && function() {
                    var obj = document.createElement("div"), props = [ "perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective" ];
                    for (var i in props) if (void 0 !== obj.style[props[i]]) return slider.pfx = props[i].replace("Perspective", "").toLowerCase(), 
                    slider.prop = "-" + slider.pfx + "-transform", !0;
                    return !1;
                }(), // CONTROLSCONTAINER:
                "" !== slider.vars.controlsContainer && (slider.controlsContainer = $(slider.vars.controlsContainer).length > 0 && $(slider.vars.controlsContainer)), 
                // MANUAL:
                "" !== slider.vars.manualControls && (slider.manualControls = $(slider.vars.manualControls).length > 0 && $(slider.vars.manualControls)), 
                // RANDOMIZE:
                slider.vars.randomize && (slider.slides.sort(function() {
                    return Math.round(Math.random()) - .5;
                }), slider.container.empty().append(slider.slides)), slider.doMath(), // INIT
                slider.setup("init"), // CONTROLNAV:
                slider.vars.controlNav && methods.controlNav.setup(), // DIRECTIONNAV:
                slider.vars.directionNav && methods.directionNav.setup(), // KEYBOARD:
                slider.vars.keyboard && (1 === $(slider.containerSelector).length || slider.vars.multipleKeyboard) && $(document).bind("keyup", function(event) {
                    var keycode = event.keyCode;
                    if (!slider.animating && (39 === keycode || 37 === keycode)) {
                        var target = 39 === keycode ? slider.getTarget("next") : 37 === keycode ? slider.getTarget("prev") : !1;
                        slider.flexAnimate(target, slider.vars.pauseOnAction);
                    }
                }), // MOUSEWHEEL:
                slider.vars.mousewheel && slider.bind("mousewheel", function(event, delta) {
                    event.preventDefault();
                    var target = slider.getTarget(0 > delta ? "next" : "prev");
                    slider.flexAnimate(target, slider.vars.pauseOnAction);
                }), // PAUSEPLAY
                slider.vars.pausePlay && methods.pausePlay.setup(), //PAUSE WHEN INVISIBLE
                slider.vars.slideshow && slider.vars.pauseInvisible && methods.pauseInvisible.init(), 
                // SLIDSESHOW
                slider.vars.slideshow && (slider.vars.pauseOnHover && slider.hover(function() {
                    slider.manualPlay || slider.manualPause || slider.pause();
                }, function() {
                    slider.manualPause || slider.manualPlay || slider.stopped || slider.play();
                }), // initialize animation
                //If we're visible, or we don't use PageVisibility API
                slider.vars.pauseInvisible && methods.pauseInvisible.isHidden() || (slider.vars.initDelay > 0 ? slider.startTimeout = setTimeout(slider.play, slider.vars.initDelay) : slider.play())), 
                // ASNAV:
                asNav && methods.asNav.setup(), // TOUCH
                touch && slider.vars.touch && methods.touch(), // FADE&&SMOOTHHEIGHT || SLIDE:
                (!fade || fade && slider.vars.smoothHeight) && $(window).bind("resize orientationchange focus", methods.resize), 
                slider.find("img").attr("draggable", "false"), // API: start() Callback
                setTimeout(function() {
                    slider.vars.start(slider);
                }, 200);
            },
            asNav: {
                setup: function() {
                    slider.asNav = !0, slider.animatingTo = Math.floor(slider.currentSlide / slider.move), 
                    slider.currentItem = slider.currentSlide, slider.slides.removeClass(namespace + "active-slide").eq(slider.currentItem).addClass(namespace + "active-slide"), 
                    msGesture ? (el._slider = slider, slider.slides.each(function() {
                        var that = this;
                        that._gesture = new MSGesture(), that._gesture.target = that, that.addEventListener("MSPointerDown", function(e) {
                            e.preventDefault(), e.currentTarget._gesture && e.currentTarget._gesture.addPointer(e.pointerId);
                        }, !1), that.addEventListener("MSGestureTap", function(e) {
                            e.preventDefault();
                            var $slide = $(this), target = $slide.index();
                            $(slider.vars.asNavFor).data("flexslider").animating || $slide.hasClass("active") || (slider.direction = slider.currentItem < target ? "next" : "prev", 
                            slider.flexAnimate(target, slider.vars.pauseOnAction, !1, !0, !0));
                        });
                    })) : slider.slides.click(function(e) {
                        e.preventDefault();
                        var $slide = $(this), target = $slide.index(), posFromLeft = $slide.offset().left - $(slider).scrollLeft();
                        // Find position of slide relative to left of slider container
                        0 >= posFromLeft && $slide.hasClass(namespace + "active-slide") ? slider.flexAnimate(slider.getTarget("prev"), !0) : $(slider.vars.asNavFor).data("flexslider").animating || $slide.hasClass(namespace + "active-slide") || (slider.direction = slider.currentItem < target ? "next" : "prev", 
                        slider.flexAnimate(target, slider.vars.pauseOnAction, !1, !0, !0));
                    });
                }
            },
            controlNav: {
                setup: function() {
                    slider.manualControls ? // MANUALCONTROLS:
                    methods.controlNav.setupManual() : methods.controlNav.setupPaging();
                },
                setupPaging: function() {
                    var item, slide, type = "thumbnails" === slider.vars.controlNav ? "control-thumbs" : "control-paging", j = 1;
                    if (slider.controlNavScaffold = $('<ol class="' + namespace + "control-nav " + namespace + type + '"></ol>'), 
                    slider.pagingCount > 1) for (var i = 0; i < slider.pagingCount; i++) {
                        if (slide = slider.slides.eq(i), item = "thumbnails" === slider.vars.controlNav ? '<img src="' + slide.attr("data-thumb") + '"/>' : "<a>" + j + "</a>", 
                        "thumbnails" === slider.vars.controlNav && !0 === slider.vars.thumbCaptions) {
                            var captn = slide.attr("data-thumbcaption");
                            "" != captn && void 0 != captn && (item += '<span class="' + namespace + 'caption">' + captn + "</span>");
                        }
                        slider.controlNavScaffold.append("<li>" + item + "</li>"), j++;
                    }
                    // CONTROLSCONTAINER:
                    slider.controlsContainer ? $(slider.controlsContainer).append(slider.controlNavScaffold) : slider.append(slider.controlNavScaffold), 
                    methods.controlNav.set(), methods.controlNav.active(), slider.controlNavScaffold.delegate("a, img", eventType, function(event) {
                        if (event.preventDefault(), "" === watchedEvent || watchedEvent === event.type) {
                            var $this = $(this), target = slider.controlNav.index($this);
                            $this.hasClass(namespace + "active") || (slider.direction = target > slider.currentSlide ? "next" : "prev", 
                            slider.flexAnimate(target, slider.vars.pauseOnAction));
                        }
                        // setup flags to prevent event duplication
                        "" === watchedEvent && (watchedEvent = event.type), methods.setToClearWatchedEvent();
                    });
                },
                setupManual: function() {
                    slider.controlNav = slider.manualControls, methods.controlNav.active(), slider.controlNav.bind(eventType, function(event) {
                        if (event.preventDefault(), "" === watchedEvent || watchedEvent === event.type) {
                            var $this = $(this), target = slider.controlNav.index($this);
                            $this.hasClass(namespace + "active") || (slider.direction = target > slider.currentSlide ? "next" : "prev", 
                            slider.flexAnimate(target, slider.vars.pauseOnAction));
                        }
                        // setup flags to prevent event duplication
                        "" === watchedEvent && (watchedEvent = event.type), methods.setToClearWatchedEvent();
                    });
                },
                set: function() {
                    var selector = "thumbnails" === slider.vars.controlNav ? "img" : "a";
                    slider.controlNav = $("." + namespace + "control-nav li " + selector, slider.controlsContainer ? slider.controlsContainer : slider);
                },
                active: function() {
                    slider.controlNav.removeClass(namespace + "active").eq(slider.animatingTo).addClass(namespace + "active");
                },
                update: function(action, pos) {
                    slider.pagingCount > 1 && "add" === action ? slider.controlNavScaffold.append($("<li><a>" + slider.count + "</a></li>")) : 1 === slider.pagingCount ? slider.controlNavScaffold.find("li").remove() : slider.controlNav.eq(pos).closest("li").remove(), 
                    methods.controlNav.set(), slider.pagingCount > 1 && slider.pagingCount !== slider.controlNav.length ? slider.update(pos, action) : methods.controlNav.active();
                }
            },
            directionNav: {
                setup: function() {
                    var directionNavScaffold = $('<ul class="' + namespace + 'direction-nav"><li><a class="' + namespace + 'prev" href="#">' + slider.vars.prevText + '</a></li><li><a class="' + namespace + 'next" href="#">' + slider.vars.nextText + "</a></li></ul>");
                    // CONTROLSCONTAINER:
                    slider.controlsContainer ? ($(slider.controlsContainer).append(directionNavScaffold), 
                    slider.directionNav = $("." + namespace + "direction-nav li a", slider.controlsContainer)) : (slider.append(directionNavScaffold), 
                    slider.directionNav = $("." + namespace + "direction-nav li a", slider)), methods.directionNav.update(), 
                    slider.directionNav.bind(eventType, function(event) {
                        event.preventDefault();
                        var target;
                        ("" === watchedEvent || watchedEvent === event.type) && (target = slider.getTarget($(this).hasClass(namespace + "next") ? "next" : "prev"), 
                        slider.flexAnimate(target, slider.vars.pauseOnAction)), // setup flags to prevent event duplication
                        "" === watchedEvent && (watchedEvent = event.type), methods.setToClearWatchedEvent();
                    });
                },
                update: function() {
                    var disabledClass = namespace + "disabled";
                    1 === slider.pagingCount ? slider.directionNav.addClass(disabledClass).attr("tabindex", "-1") : slider.vars.animationLoop ? slider.directionNav.removeClass(disabledClass).removeAttr("tabindex") : 0 === slider.animatingTo ? slider.directionNav.removeClass(disabledClass).filter("." + namespace + "prev").addClass(disabledClass).attr("tabindex", "-1") : slider.animatingTo === slider.last ? slider.directionNav.removeClass(disabledClass).filter("." + namespace + "next").addClass(disabledClass).attr("tabindex", "-1") : slider.directionNav.removeClass(disabledClass).removeAttr("tabindex");
                }
            },
            pausePlay: {
                setup: function() {
                    var pausePlayScaffold = $('<div class="' + namespace + 'pauseplay"><a></a></div>');
                    // CONTROLSCONTAINER:
                    slider.controlsContainer ? (slider.controlsContainer.append(pausePlayScaffold), 
                    slider.pausePlay = $("." + namespace + "pauseplay a", slider.controlsContainer)) : (slider.append(pausePlayScaffold), 
                    slider.pausePlay = $("." + namespace + "pauseplay a", slider)), methods.pausePlay.update(slider.vars.slideshow ? namespace + "pause" : namespace + "play"), 
                    slider.pausePlay.bind(eventType, function(event) {
                        event.preventDefault(), ("" === watchedEvent || watchedEvent === event.type) && ($(this).hasClass(namespace + "pause") ? (slider.manualPause = !0, 
                        slider.manualPlay = !1, slider.pause()) : (slider.manualPause = !1, slider.manualPlay = !0, 
                        slider.play())), // setup flags to prevent event duplication
                        "" === watchedEvent && (watchedEvent = event.type), methods.setToClearWatchedEvent();
                    });
                },
                update: function(state) {
                    "play" === state ? slider.pausePlay.removeClass(namespace + "pause").addClass(namespace + "play").html(slider.vars.playText) : slider.pausePlay.removeClass(namespace + "play").addClass(namespace + "pause").html(slider.vars.pauseText);
                }
            },
            touch: function() {
                function onTouchStart(e) {
                    slider.animating ? e.preventDefault() : (window.navigator.msPointerEnabled || 1 === e.touches.length) && (slider.pause(), 
                    // CAROUSEL:
                    cwidth = vertical ? slider.h : slider.w, startT = Number(new Date()), // CAROUSEL:
                    // Local vars for X and Y points.
                    localX = e.touches[0].pageX, localY = e.touches[0].pageY, offset = carousel && reverse && slider.animatingTo === slider.last ? 0 : carousel && reverse ? slider.limit - (slider.itemW + slider.vars.itemMargin) * slider.move * slider.animatingTo : carousel && slider.currentSlide === slider.last ? slider.limit : carousel ? (slider.itemW + slider.vars.itemMargin) * slider.move * slider.currentSlide : reverse ? (slider.last - slider.currentSlide + slider.cloneOffset) * cwidth : (slider.currentSlide + slider.cloneOffset) * cwidth, 
                    startX = vertical ? localY : localX, startY = vertical ? localX : localY, el.addEventListener("touchmove", onTouchMove, !1), 
                    el.addEventListener("touchend", onTouchEnd, !1));
                }
                function onTouchMove(e) {
                    // Local vars for X and Y points.
                    localX = e.touches[0].pageX, localY = e.touches[0].pageY, dx = vertical ? startX - localY : startX - localX, 
                    scrolling = vertical ? Math.abs(dx) < Math.abs(localX - startY) : Math.abs(dx) < Math.abs(localY - startY);
                    var fxms = 500;
                    (!scrolling || Number(new Date()) - startT > fxms) && (e.preventDefault(), !fade && slider.transitions && (slider.vars.animationLoop || (dx /= 0 === slider.currentSlide && 0 > dx || slider.currentSlide === slider.last && dx > 0 ? Math.abs(dx) / cwidth + 2 : 1), 
                    slider.setProps(offset + dx, "setTouch")));
                }
                function onTouchEnd() {
                    if (// finish the touch by undoing the touch session
                    el.removeEventListener("touchmove", onTouchMove, !1), slider.animatingTo === slider.currentSlide && !scrolling && null !== dx) {
                        var updateDx = reverse ? -dx : dx, target = slider.getTarget(updateDx > 0 ? "next" : "prev");
                        slider.canAdvance(target) && (Number(new Date()) - startT < 550 && Math.abs(updateDx) > 50 || Math.abs(updateDx) > cwidth / 2) ? slider.flexAnimate(target, slider.vars.pauseOnAction) : fade || slider.flexAnimate(slider.currentSlide, slider.vars.pauseOnAction, !0);
                    }
                    el.removeEventListener("touchend", onTouchEnd, !1), startX = null, startY = null, 
                    dx = null, offset = null;
                }
                function onMSPointerDown(e) {
                    e.stopPropagation(), slider.animating ? e.preventDefault() : (slider.pause(), el._gesture.addPointer(e.pointerId), 
                    accDx = 0, cwidth = vertical ? slider.h : slider.w, startT = Number(new Date()), 
                    // CAROUSEL:
                    offset = carousel && reverse && slider.animatingTo === slider.last ? 0 : carousel && reverse ? slider.limit - (slider.itemW + slider.vars.itemMargin) * slider.move * slider.animatingTo : carousel && slider.currentSlide === slider.last ? slider.limit : carousel ? (slider.itemW + slider.vars.itemMargin) * slider.move * slider.currentSlide : reverse ? (slider.last - slider.currentSlide + slider.cloneOffset) * cwidth : (slider.currentSlide + slider.cloneOffset) * cwidth);
                }
                function onMSGestureChange(e) {
                    e.stopPropagation();
                    var slider = e.target._slider;
                    if (slider) {
                        var transX = -e.translationX, transY = -e.translationY;
                        //Accumulate translations.
                        return accDx += vertical ? transY : transX, dx = accDx, scrolling = vertical ? Math.abs(accDx) < Math.abs(-transX) : Math.abs(accDx) < Math.abs(-transY), 
                        e.detail === e.MSGESTURE_FLAG_INERTIA ? void setImmediate(function() {
                            el._gesture.stop();
                        }) : void ((!scrolling || Number(new Date()) - startT > 500) && (e.preventDefault(), 
                        !fade && slider.transitions && (slider.vars.animationLoop || (dx = accDx / (0 === slider.currentSlide && 0 > accDx || slider.currentSlide === slider.last && accDx > 0 ? Math.abs(accDx) / cwidth + 2 : 1)), 
                        slider.setProps(offset + dx, "setTouch"))));
                    }
                }
                function onMSGestureEnd(e) {
                    e.stopPropagation();
                    var slider = e.target._slider;
                    if (slider) {
                        if (slider.animatingTo === slider.currentSlide && !scrolling && null !== dx) {
                            var updateDx = reverse ? -dx : dx, target = slider.getTarget(updateDx > 0 ? "next" : "prev");
                            slider.canAdvance(target) && (Number(new Date()) - startT < 550 && Math.abs(updateDx) > 50 || Math.abs(updateDx) > cwidth / 2) ? slider.flexAnimate(target, slider.vars.pauseOnAction) : fade || slider.flexAnimate(slider.currentSlide, slider.vars.pauseOnAction, !0);
                        }
                        startX = null, startY = null, dx = null, offset = null, accDx = 0;
                    }
                }
                var startX, startY, offset, cwidth, dx, startT, scrolling = !1, localX = 0, localY = 0, accDx = 0;
                msGesture ? (el.style.msTouchAction = "none", el._gesture = new MSGesture(), el._gesture.target = el, 
                el.addEventListener("MSPointerDown", onMSPointerDown, !1), el._slider = slider, 
                el.addEventListener("MSGestureChange", onMSGestureChange, !1), el.addEventListener("MSGestureEnd", onMSGestureEnd, !1)) : el.addEventListener("touchstart", onTouchStart, !1);
            },
            resize: function() {
                !slider.animating && slider.is(":visible") && (carousel || slider.doMath(), fade ? // SMOOTH HEIGHT:
                methods.smoothHeight() : carousel ? (//CAROUSEL:
                slider.slides.width(slider.computedW), slider.update(slider.pagingCount), slider.setProps()) : vertical ? (//VERTICAL:
                slider.viewport.height(slider.h), slider.setProps(slider.h, "setTotal")) : (// SMOOTH HEIGHT:
                slider.vars.smoothHeight && methods.smoothHeight(), slider.newSlides.width(slider.computedW), 
                slider.setProps(slider.computedW, "setTotal")));
            },
            smoothHeight: function(dur) {
                if (!vertical || fade) {
                    var $obj = fade ? slider : slider.viewport;
                    dur ? $obj.animate({
                        height: slider.slides.eq(slider.animatingTo).height()
                    }, dur) : $obj.height(slider.slides.eq(slider.animatingTo).height());
                }
            },
            sync: function(action) {
                var $obj = $(slider.vars.sync).data("flexslider"), target = slider.animatingTo;
                switch (action) {
                  case "animate":
                    $obj.flexAnimate(target, slider.vars.pauseOnAction, !1, !0);
                    break;

                  case "play":
                    $obj.playing || $obj.asNav || $obj.play();
                    break;

                  case "pause":
                    $obj.pause();
                }
            },
            pauseInvisible: {
                visProp: null,
                init: function() {
                    var prefixes = [ "webkit", "moz", "ms", "o" ];
                    if ("hidden" in document) return "hidden";
                    for (var i = 0; i < prefixes.length; i++) prefixes[i] + "Hidden" in document && (methods.pauseInvisible.visProp = prefixes[i] + "Hidden");
                    if (methods.pauseInvisible.visProp) {
                        var evtname = methods.pauseInvisible.visProp.replace(/[H|h]idden/, "") + "visibilitychange";
                        document.addEventListener(evtname, function() {
                            methods.pauseInvisible.isHidden() ? slider.startTimeout ? clearTimeout(slider.startTimeout) : slider.pause() : slider.started ? slider.play() : slider.vars.initDelay > 0 ? setTimeout(slider.play, slider.vars.initDelay) : slider.play();
                        });
                    }
                },
                isHidden: function() {
                    return document[methods.pauseInvisible.visProp] || !1;
                }
            },
            setToClearWatchedEvent: function() {
                clearTimeout(watchedEventClearTimer), watchedEventClearTimer = setTimeout(function() {
                    watchedEvent = "";
                }, 3e3);
            }
        }, // public methods
        slider.flexAnimate = function(target, pause, override, withSync, fromNav) {
            if (slider.vars.animationLoop || target === slider.currentSlide || (slider.direction = target > slider.currentSlide ? "next" : "prev"), 
            asNav && 1 === slider.pagingCount && (slider.direction = slider.currentItem < target ? "next" : "prev"), 
            !slider.animating && (slider.canAdvance(target, fromNav) || override) && slider.is(":visible")) {
                if (asNav && withSync) {
                    var master = $(slider.vars.asNavFor).data("flexslider");
                    if (slider.atEnd = 0 === target || target === slider.count - 1, master.flexAnimate(target, !0, !1, !0, fromNav), 
                    slider.direction = slider.currentItem < target ? "next" : "prev", master.direction = slider.direction, 
                    Math.ceil((target + 1) / slider.visible) - 1 === slider.currentSlide || 0 === target) return slider.currentItem = target, 
                    slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide"), 
                    !1;
                    slider.currentItem = target, slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide"), 
                    target = Math.floor(target / slider.visible);
                }
                // SLIDE:
                if (slider.animating = !0, slider.animatingTo = target, // SLIDESHOW:
                pause && slider.pause(), // API: before() animation Callback
                slider.vars.before(slider), // SYNC:
                slider.syncExists && !fromNav && methods.sync("animate"), // CONTROLNAV
                slider.vars.controlNav && methods.controlNav.active(), // !CAROUSEL:
                // CANDIDATE: slide active class (for add/remove slide)
                carousel || slider.slides.removeClass(namespace + "active-slide").eq(target).addClass(namespace + "active-slide"), 
                // INFINITE LOOP:
                // CANDIDATE: atEnd
                slider.atEnd = 0 === target || target === slider.last, // DIRECTIONNAV:
                slider.vars.directionNav && methods.directionNav.update(), target === slider.last && (// API: end() of cycle Callback
                slider.vars.end(slider), // SLIDESHOW && !INFINITE LOOP:
                slider.vars.animationLoop || slider.pause()), fade) // FADE:
                touch ? (slider.slides.eq(slider.currentSlide).css({
                    opacity: 0,
                    zIndex: 1
                }), slider.slides.eq(target).css({
                    opacity: 1,
                    zIndex: 2
                }), slider.wrapup(dimension)) : (//slider.slides.eq(slider.currentSlide).fadeOut(slider.vars.animationSpeed, slider.vars.easing);
                //slider.slides.eq(target).fadeIn(slider.vars.animationSpeed, slider.vars.easing, slider.wrapup);
                slider.slides.eq(slider.currentSlide).css({
                    zIndex: 1
                }).animate({
                    opacity: 0
                }, slider.vars.animationSpeed, slider.vars.easing), slider.slides.eq(target).css({
                    zIndex: 2
                }).animate({
                    opacity: 1
                }, slider.vars.animationSpeed, slider.vars.easing, slider.wrapup)); else {
                    var margin, slideString, calcNext, dimension = vertical ? slider.slides.filter(":first").height() : slider.computedW;
                    // INFINITE LOOP / REVERSE:
                    carousel ? (//margin = (slider.vars.itemWidth > slider.w) ? slider.vars.itemMargin * 2 : slider.vars.itemMargin;
                    margin = slider.vars.itemMargin, calcNext = (slider.itemW + margin) * slider.move * slider.animatingTo, 
                    slideString = calcNext > slider.limit && 1 !== slider.visible ? slider.limit : calcNext) : slideString = 0 === slider.currentSlide && target === slider.count - 1 && slider.vars.animationLoop && "next" !== slider.direction ? reverse ? (slider.count + slider.cloneOffset) * dimension : 0 : slider.currentSlide === slider.last && 0 === target && slider.vars.animationLoop && "prev" !== slider.direction ? reverse ? 0 : (slider.count + 1) * dimension : reverse ? (slider.count - 1 - target + slider.cloneOffset) * dimension : (target + slider.cloneOffset) * dimension, 
                    slider.setProps(slideString, "", slider.vars.animationSpeed), slider.transitions ? (slider.vars.animationLoop && slider.atEnd || (slider.animating = !1, 
                    slider.currentSlide = slider.animatingTo), slider.container.unbind("webkitTransitionEnd transitionend"), 
                    slider.container.bind("webkitTransitionEnd transitionend", function() {
                        slider.wrapup(dimension);
                    })) : slider.container.animate(slider.args, slider.vars.animationSpeed, slider.vars.easing, function() {
                        slider.wrapup(dimension);
                    });
                }
                // SMOOTH HEIGHT:
                slider.vars.smoothHeight && methods.smoothHeight(slider.vars.animationSpeed);
            }
        }, slider.wrapup = function(dimension) {
            // SLIDE:
            fade || carousel || (0 === slider.currentSlide && slider.animatingTo === slider.last && slider.vars.animationLoop ? slider.setProps(dimension, "jumpEnd") : slider.currentSlide === slider.last && 0 === slider.animatingTo && slider.vars.animationLoop && slider.setProps(dimension, "jumpStart")), 
            slider.animating = !1, slider.currentSlide = slider.animatingTo, // API: after() animation Callback
            slider.vars.after(slider);
        }, // SLIDESHOW:
        slider.animateSlides = function() {
            !slider.animating && focused && slider.flexAnimate(slider.getTarget("next"));
        }, // SLIDESHOW:
        slider.pause = function() {
            clearInterval(slider.animatedSlides), slider.animatedSlides = null, slider.playing = !1, 
            // PAUSEPLAY:
            slider.vars.pausePlay && methods.pausePlay.update("play"), // SYNC:
            slider.syncExists && methods.sync("pause");
        }, // SLIDESHOW:
        slider.play = function() {
            slider.playing && clearInterval(slider.animatedSlides), slider.animatedSlides = slider.animatedSlides || setInterval(slider.animateSlides, slider.vars.slideshowSpeed), 
            slider.started = slider.playing = !0, // PAUSEPLAY:
            slider.vars.pausePlay && methods.pausePlay.update("pause"), // SYNC:
            slider.syncExists && methods.sync("play");
        }, // STOP:
        slider.stop = function() {
            slider.pause(), slider.stopped = !0;
        }, slider.canAdvance = function(target, fromNav) {
            // ASNAV:
            var last = asNav ? slider.pagingCount - 1 : slider.last;
            return fromNav ? !0 : asNav && slider.currentItem === slider.count - 1 && 0 === target && "prev" === slider.direction ? !0 : asNav && 0 === slider.currentItem && target === slider.pagingCount - 1 && "next" !== slider.direction ? !1 : target !== slider.currentSlide || asNav ? slider.vars.animationLoop ? !0 : slider.atEnd && 0 === slider.currentSlide && target === last && "next" !== slider.direction ? !1 : slider.atEnd && slider.currentSlide === last && 0 === target && "next" === slider.direction ? !1 : !0 : !1;
        }, slider.getTarget = function(dir) {
            return slider.direction = dir, "next" === dir ? slider.currentSlide === slider.last ? 0 : slider.currentSlide + 1 : 0 === slider.currentSlide ? slider.last : slider.currentSlide - 1;
        }, // SLIDE:
        slider.setProps = function(pos, special, dur) {
            var target = function() {
                var posCheck = pos ? pos : (slider.itemW + slider.vars.itemMargin) * slider.move * slider.animatingTo, posCalc = function() {
                    if (carousel) return "setTouch" === special ? pos : reverse && slider.animatingTo === slider.last ? 0 : reverse ? slider.limit - (slider.itemW + slider.vars.itemMargin) * slider.move * slider.animatingTo : slider.animatingTo === slider.last ? slider.limit : posCheck;
                    switch (special) {
                      case "setTotal":
                        return reverse ? (slider.count - 1 - slider.currentSlide + slider.cloneOffset) * pos : (slider.currentSlide + slider.cloneOffset) * pos;

                      case "setTouch":
                        return reverse ? pos : pos;

                      case "jumpEnd":
                        return reverse ? pos : slider.count * pos;

                      case "jumpStart":
                        return reverse ? slider.count * pos : pos;

                      default:
                        return pos;
                    }
                }();
                return -1 * posCalc + "px";
            }();
            slider.transitions && (target = vertical ? "translate3d(0," + target + ",0)" : "translate3d(" + target + ",0,0)", 
            dur = void 0 !== dur ? dur / 1e3 + "s" : "0s", slider.container.css("-" + slider.pfx + "-transition-duration", dur)), 
            slider.args[slider.prop] = target, (slider.transitions || void 0 === dur) && slider.container.css(slider.args);
        }, slider.setup = function(type) {
            // SLIDE:
            if (fade) // FADE:
            slider.slides.css({
                width: "100%",
                "float": "left",
                marginRight: "-100%",
                position: "relative"
            }), "init" === type && (touch ? slider.slides.css({
                opacity: 0,
                display: "block",
                webkitTransition: "opacity " + slider.vars.animationSpeed / 1e3 + "s ease",
                zIndex: 1
            }).eq(slider.currentSlide).css({
                opacity: 1,
                zIndex: 2
            }) : //slider.slides.eq(slider.currentSlide).fadeIn(slider.vars.animationSpeed, slider.vars.easing);
            slider.slides.css({
                opacity: 0,
                display: "block",
                zIndex: 1
            }).eq(slider.currentSlide).css({
                zIndex: 2
            }).animate({
                opacity: 1
            }, slider.vars.animationSpeed, slider.vars.easing)), // SMOOTH HEIGHT:
            slider.vars.smoothHeight && methods.smoothHeight(); else {
                var sliderOffset, arr;
                "init" === type && (slider.viewport = $('<div class="' + namespace + 'viewport"></div>').css({
                    overflow: "hidden",
                    position: "relative"
                }).appendTo(slider).append(slider.container), // INFINITE LOOP:
                slider.cloneCount = 0, slider.cloneOffset = 0, // REVERSE:
                reverse && (arr = $.makeArray(slider.slides).reverse(), slider.slides = $(arr), 
                slider.container.empty().append(slider.slides))), // INFINITE LOOP && !CAROUSEL:
                slider.vars.animationLoop && !carousel && (slider.cloneCount = 2, slider.cloneOffset = 1, 
                // clear out old clones
                "init" !== type && slider.container.find(".clone").remove(), slider.container.append(slider.slides.first().clone().addClass("clone").attr("aria-hidden", "true")).prepend(slider.slides.last().clone().addClass("clone").attr("aria-hidden", "true"))), 
                slider.newSlides = $(slider.vars.selector, slider), sliderOffset = reverse ? slider.count - 1 - slider.currentSlide + slider.cloneOffset : slider.currentSlide + slider.cloneOffset, 
                // VERTICAL:
                vertical && !carousel ? (slider.container.height(200 * (slider.count + slider.cloneCount) + "%").css("position", "absolute").width("100%"), 
                setTimeout(function() {
                    slider.newSlides.css({
                        display: "block"
                    }), slider.doMath(), slider.viewport.height(slider.h), slider.setProps(sliderOffset * slider.h, "init");
                }, "init" === type ? 100 : 0)) : (slider.container.width(200 * (slider.count + slider.cloneCount) + "%"), 
                slider.setProps(sliderOffset * slider.computedW, "init"), setTimeout(function() {
                    slider.doMath(), slider.newSlides.css({
                        width: slider.computedW,
                        "float": "left",
                        display: "block"
                    }), // SMOOTH HEIGHT:
                    slider.vars.smoothHeight && methods.smoothHeight();
                }, "init" === type ? 100 : 0));
            }
            // !CAROUSEL:
            // CANDIDATE: active slide
            carousel || slider.slides.removeClass(namespace + "active-slide").eq(slider.currentSlide).addClass(namespace + "active-slide");
        }, slider.doMath = function() {
            var slide = slider.slides.first(), slideMargin = slider.vars.itemMargin, minItems = slider.vars.minItems, maxItems = slider.vars.maxItems;
            slider.w = void 0 === slider.viewport ? slider.width() : slider.viewport.width(), 
            slider.h = slide.height(), slider.boxPadding = slide.outerWidth() - slide.width(), 
            // CAROUSEL:
            carousel ? (slider.itemT = slider.vars.itemWidth + slideMargin, slider.minW = minItems ? minItems * slider.itemT : slider.w, 
            slider.maxW = maxItems ? maxItems * slider.itemT - slideMargin : slider.w, slider.itemW = slider.minW > slider.w ? (slider.w - slideMargin * (minItems - 1)) / minItems : slider.maxW < slider.w ? (slider.w - slideMargin * (maxItems - 1)) / maxItems : slider.vars.itemWidth > slider.w ? slider.w : slider.vars.itemWidth, 
            slider.visible = Math.floor(slider.w / slider.itemW), slider.move = slider.vars.move > 0 && slider.vars.move < slider.visible ? slider.vars.move : slider.visible, 
            slider.pagingCount = Math.ceil((slider.count - slider.visible) / slider.move + 1), 
            slider.last = slider.pagingCount - 1, slider.limit = 1 === slider.pagingCount ? 0 : slider.vars.itemWidth > slider.w ? slider.itemW * (slider.count - 1) + slideMargin * (slider.count - 1) : (slider.itemW + slideMargin) * slider.count - slider.w - slideMargin) : (slider.itemW = slider.w, 
            slider.pagingCount = slider.count, slider.last = slider.count - 1), slider.computedW = slider.itemW - slider.boxPadding;
        }, slider.update = function(pos, action) {
            slider.doMath(), // update currentSlide and slider.animatingTo if necessary
            carousel || (pos < slider.currentSlide ? slider.currentSlide += 1 : pos <= slider.currentSlide && 0 !== pos && (slider.currentSlide -= 1), 
            slider.animatingTo = slider.currentSlide), // update controlNav
            slider.vars.controlNav && !slider.manualControls && ("add" === action && !carousel || slider.pagingCount > slider.controlNav.length ? methods.controlNav.update("add") : ("remove" === action && !carousel || slider.pagingCount < slider.controlNav.length) && (carousel && slider.currentSlide > slider.last && (slider.currentSlide -= 1, 
            slider.animatingTo -= 1), methods.controlNav.update("remove", slider.last))), // update directionNav
            slider.vars.directionNav && methods.directionNav.update();
        }, slider.addSlide = function(obj, pos) {
            var $obj = $(obj);
            slider.count += 1, slider.last = slider.count - 1, // append new slide
            vertical && reverse ? void 0 !== pos ? slider.slides.eq(slider.count - pos).after($obj) : slider.container.prepend($obj) : void 0 !== pos ? slider.slides.eq(pos).before($obj) : slider.container.append($obj), 
            // update currentSlide, animatingTo, controlNav, and directionNav
            slider.update(pos, "add"), // update slider.slides
            slider.slides = $(slider.vars.selector + ":not(.clone)", slider), // re-setup the slider to accomdate new slide
            slider.setup(), //FlexSlider: added() Callback
            slider.vars.added(slider);
        }, slider.removeSlide = function(obj) {
            var pos = isNaN(obj) ? slider.slides.index($(obj)) : obj;
            // update count
            slider.count -= 1, slider.last = slider.count - 1, // remove slide
            isNaN(obj) ? $(obj, slider.slides).remove() : vertical && reverse ? slider.slides.eq(slider.last).remove() : slider.slides.eq(obj).remove(), 
            // update currentSlide, animatingTo, controlNav, and directionNav
            slider.doMath(), slider.update(pos, "remove"), // update slider.slides
            slider.slides = $(slider.vars.selector + ":not(.clone)", slider), // re-setup the slider to accomdate new slide
            slider.setup(), // FlexSlider: removed() Callback
            slider.vars.removed(slider);
        }, //FlexSlider: Initialize
        methods.init();
    }, // Ensure the slider isn't focussed if the window loses focus.
    $(window).blur(function() {
        focused = !1;
    }).focus(function() {
        focused = !0;
    }), //FlexSlider: Default Settings
    $.flexslider.defaults = {
        namespace: "flex-",
        //{NEW} String: Prefix string attached to the class of every element generated by the plugin
        selector: ".slides > li",
        //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
        animation: "fade",
        //String: Select your animation type, "fade" or "slide"
        easing: "swing",
        //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
        direction: "horizontal",
        //String: Select the sliding direction, "horizontal" or "vertical"
        reverse: !1,
        //{NEW} Boolean: Reverse the animation direction
        animationLoop: !0,
        //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
        smoothHeight: !1,
        //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
        startAt: 0,
        //Integer: The slide that the slider should start on. Array notation (0 = first slide)
        slideshow: !0,
        //Boolean: Animate slider automatically
        slideshowSpeed: 7e3,
        //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 600,
        //Integer: Set the speed of animations, in milliseconds
        initDelay: 0,
        //{NEW} Integer: Set an initialization delay, in milliseconds
        randomize: !1,
        //Boolean: Randomize slide order
        thumbCaptions: !1,
        //Boolean: Whether or not to put captions on thumbnails when using the "thumbnails" controlNav.
        // Usability features
        pauseOnAction: !0,
        //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: !1,
        //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
        pauseInvisible: !0,
        //{NEW} Boolean: Pause the slideshow when tab is invisible, resume when visible. Provides better UX, lower CPU usage.
        useCSS: !0,
        //{NEW} Boolean: Slider will use CSS3 transitions if available
        touch: !0,
        //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
        video: !1,
        //{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
        // Primary Controls
        controlNav: !0,
        //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
        directionNav: !0,
        //Boolean: Create navigation for previous/next navigation? (true/false)
        prevText: "Previous",
        //String: Set the text for the "previous" directionNav item
        nextText: "Next",
        //String: Set the text for the "next" directionNav item
        // Secondary Navigation
        keyboard: !0,
        //Boolean: Allow slider navigating via keyboard left/right keys
        multipleKeyboard: !1,
        //{NEW} Boolean: Allow keyboard navigation to affect multiple sliders. Default behavior cuts out keyboard navigation with more than one slider present.
        mousewheel: !1,
        //{UPDATED} Boolean: Requires jquery.mousewheel.js (https://github.com/brandonaaron/jquery-mousewheel) - Allows slider navigating via mousewheel
        pausePlay: !1,
        //Boolean: Create pause/play dynamic element
        pauseText: "Pause",
        //String: Set the text for the "pause" pausePlay item
        playText: "Play",
        //String: Set the text for the "play" pausePlay item
        // Special properties
        controlsContainer: "",
        //{UPDATED} jQuery Object/Selector: Declare which container the navigation elements should be appended too. Default container is the FlexSlider element. Example use would be $(".flexslider-container"). Property is ignored if given element is not found.
        manualControls: "",
        //{UPDATED} jQuery Object/Selector: Declare custom control navigation. Examples would be $(".flex-control-nav li") or "#tabs-nav li img", etc. The number of elements in your controlNav should match the number of slides/tabs.
        sync: "",
        //{NEW} Selector: Mirror the actions performed on this slider with another slider. Use with care.
        asNavFor: "",
        //{NEW} Selector: Internal property exposed for turning the slider into a thumbnail navigation for another slider
        // Carousel Options
        itemWidth: 0,
        //{NEW} Integer: Box-model width of individual carousel items, including horizontal borders and padding.
        itemMargin: 0,
        //{NEW} Integer: Margin between carousel items.
        minItems: 1,
        //{NEW} Integer: Minimum number of carousel items that should be visible. Items will resize fluidly when below this.
        maxItems: 0,
        //{NEW} Integer: Maxmimum number of carousel items that should be visible. Items will resize fluidly when above this limit.
        move: 0,
        //{NEW} Integer: Number of carousel items that should move on animation. If 0, slider will move all visible items.
        allowOneSlide: !0,
        //{NEW} Boolean: Whether or not to allow a slider comprised of a single slide
        // Callback API
        start: function() {},
        //Callback: function(slider) - Fires when the slider loads the first slide
        before: function() {},
        //Callback: function(slider) - Fires asynchronously with each slider animation
        after: function() {},
        //Callback: function(slider) - Fires after each slider animation completes
        end: function() {},
        //Callback: function(slider) - Fires when the slider reaches the last slide (asynchronous)
        added: function() {},
        //{NEW} Callback: function(slider) - Fires after a slide is added
        removed: function() {}
    }, //FlexSlider: Plugin Function
    $.fn.flexslider = function(options) {
        if (void 0 === options && (options = {}), "object" == typeof options) return this.each(function() {
            var $this = $(this), selector = options.selector ? options.selector : ".slides > li", $slides = $this.find(selector);
            1 === $slides.length && options.allowOneSlide === !0 || 0 === $slides.length ? ($slides.fadeIn(400), 
            options.start && options.start($this)) : void 0 === $this.data("flexslider") && new $.flexslider(this, options);
        });
        // Helper strings to quickly perform functions on the slider
        var $slider = $(this).data("flexslider");
        switch (options) {
          case "play":
            $slider.play();
            break;

          case "pause":
            $slider.pause();
            break;

          case "stop":
            $slider.stop();
            break;

          case "next":
            $slider.flexAnimate($slider.getTarget("next"), !0);
            break;

          case "prev":
          case "previous":
            $slider.flexAnimate($slider.getTarget("prev"), !0);
            break;

          default:
            "number" == typeof options && $slider.flexAnimate(options, !0);
        }
    };
}(jQuery), /*global jQuery */
/*jshint multistr:true browser:true */
/*!
* FitVids 1.0
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/
function($) {
    "use strict";
    $.fn.fitVids = function(options) {
        var settings = {
            customSelector: null
        };
        if (!document.getElementById("fit-vids-style")) {
            var div = document.createElement("div"), ref = document.getElementsByTagName("base")[0] || document.getElementsByTagName("script")[0], cssStyles = "&shy;<style>.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>";
            div.className = "fit-vids-style", div.id = "fit-vids-style", div.style.display = "none", 
            div.innerHTML = cssStyles, ref.parentNode.insertBefore(div, ref);
        }
        return options && $.extend(settings, options), this.each(function() {
            var selectors = [ "iframe[src*='player.vimeo.com']", "iframe[src*='youtube.com']", "iframe[src*='youtube-nocookie.com']", "iframe[src*='kickstarter.com'][src*='video.html']", "object", "embed" ];
            settings.customSelector && selectors.push(settings.customSelector);
            var $allVideos = $(this).find(selectors.join(","));
            $allVideos = $allVideos.not("object object"), // SwfObj conflict patch
            $allVideos.each(function() {
                var $this = $(this);
                if (!("embed" === this.tagName.toLowerCase() && $this.parent("object").length || $this.parent(".fluid-width-video-wrapper").length)) {
                    var height = "object" === this.tagName.toLowerCase() || $this.attr("height") && !isNaN(parseInt($this.attr("height"), 10)) ? parseInt($this.attr("height"), 10) : $this.height(), width = isNaN(parseInt($this.attr("width"), 10)) ? $this.width() : parseInt($this.attr("width"), 10), aspectRatio = height / width;
                    if (!$this.attr("id")) {
                        var videoID = "fitvid" + Math.floor(999999 * Math.random());
                        $this.attr("id", videoID);
                    }
                    $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", 100 * aspectRatio + "%"), 
                    $this.removeAttr("height").removeAttr("width");
                }
            });
        });
    };
}(window.jQuery || window.Zepto), // remap jQuery to $
function($) {
    $(document).ready(function() {
        // Seriously there's no way to add a class to this?!?!
        $("#commentform #submit").addClass("btn"), // Large Gallery Flexslider
        $(".gallery-size-large").addClass("flexslider").flexslider({
            animation: "slide",
            selector: ".row > .gallery-item"
        }), // Fitvids.
        $("body").fitVids();
    });
}(this.jQuery);
//# sourceMappingURL=theme.map
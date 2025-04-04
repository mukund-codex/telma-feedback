var Jcrop = function (t) {
    var e = {};

    function n(r) {
        if (e[r]) return e[r].exports;
        var i = e[r] = {
            i: r,
            l: !1,
            exports: {}
        };
        return t[r].call(i.exports, i, i.exports, n), i.l = !0, i.exports
    }
    return n.m = t, n.c = e, n.d = function (t, e, r) {
        n.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: r
        })
    }, n.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function (t, e) {
        if (1 & e && (t = n(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var r = Object.create(null);
        if (n.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t)
            for (var i in t) n.d(r, i, function (e) {
                return t[e]
            }.bind(null, i));
        return r
    }, n.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return n.d(e, "a", e), e
    }, n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, n.p = "", n(n.s = 12)
}([function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e.default = function () {
        var t = {};
        for (var e in arguments) {
            var n = arguments[e];
            for (var r in n) Object.prototype.hasOwnProperty.call(n, r) && (t[r] = n[r])
        }
        return t
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
        function t(t, e) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
            }
        }
        return function (e, n, r) {
            return n && t(e.prototype, n), r && t(e, r), e
        }
    }();
    var i = function () {
        function t(e) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), "string" == typeof e && (e = document.getElementById(e)), this.el = e
        }
        return r(t, [{
            key: "appendTo",
            value: function (t) {
                return "string" == typeof t && (t = document.getElementById(t)), t.appendChild(this.el), this
            }
        }, {
            key: "emit",
            value: function (t) {
                var e = document.createEvent("Event");
                e.initEvent(t, !0, !0), e.cropTarget = this, this.el.dispatchEvent(e)
            }
        }, {
            key: "removeClass",
            value: function (t) {
                return this.el.className = this.el.className.split(" ").filter(function (e) {
                    return t !== e
                }).join(" "), this
            }
        }, {
            key: "hasClass",
            value: function (t) {
                return this.el.className.split(" ").filter(function (e) {
                    return t === e
                }).length
            }
        }, {
            key: "addClass",
            value: function (t) {
                return this.hasClass(t) || (this.el.className += " " + t), this
            }
        }, {
            key: "listen",
            value: function (t, e) {
                return this.el.addEventListener(t, function (t) {
                    return e(t.cropTarget, t)
                }), this
            }
        }]), t
    }();
    e.default = i
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
        function t(t, e) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
            }
        }
        return function (e, n, r) {
            return n && t(e.prototype, n), r && t(e, r), e
        }
    }();
    var i = function () {
        function t() {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.x = 0, this.y = 0, this.w = 0, this.h = 0
        }
        return r(t, [{
            key: "round",
            value: function () {
                return t.create(Math.round(this.x), Math.round(this.y), Math.round(this.w), Math.round(this.h))
            }
        }, {
            key: "normalize",
            value: function () {
                var e = [Math.min(this.x, this.x2), Math.min(this.y, this.y2), Math.max(this.x, this.x2), Math.max(this.y, this.y2)],
                    n = e[0],
                    r = e[1],
                    i = e[2],
                    o = e[3];
                return t.create(n, r, i - n, o - r)
            }
        }, {
            key: "rebound",
            value: function (t, e) {
                var n = this.normalize();
                return n.x < 0 && (n.x = 0), n.y < 0 && (n.y = 0), n.x2 > t && (n.x = t - n.w), n.y2 > e && (n.y = e - n.h), n
            }
        }, {
            key: "scale",
            value: function (e, n) {
                return n = n || e, t.create(this.x * e, this.y * n, this.w * e, this.h * n)
            }
        }, {
            key: "unscale",
            value: function (e, n) {
                return n = n || e, t.create(this.x / e, this.y / n, this.w / e, this.h / n)
            }
        }, {
            key: "center",
            value: function (e, n) {
                return t.create((e - this.w) / 2, (n - this.h) / 2, this.w, this.h)
            }
        }, {
            key: "toArray",
            value: function () {
                return [this.x, this.y, this.w, this.h]
            }
        }, {
            key: "x1",
            set: function (t) {
                this.w = this.x2 - t, this.x = t
            }
        }, {
            key: "y1",
            set: function (t) {
                this.h = this.y2 - t, this.y = t
            }
        }, {
            key: "x2",
            get: function () {
                return this.x + this.w
            },
            set: function (t) {
                this.w = t - this.x
            }
        }, {
            key: "y2",
            get: function () {
                return this.y + this.h
            },
            set: function (t) {
                this.h = t - this.y
            }
        }, {
            key: "aspect",
            get: function () {
                return this.w / this.h
            }
        }]), t
    }();
    i.fromPoints = function (t, e) {
        var n = [Math.min(t[0], e[0]), Math.min(t[1], e[1]), Math.max(t[0], e[0]), Math.max(t[1], e[1])],
            r = n[0],
            o = n[1],
            a = n[2],
            s = n[3];
        return i.create(r, o, a - r, s - o)
    }, i.create = function () {
        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
            e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0,
            n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : 0,
            r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : 0,
            o = new i;
        return o.x = t, o.y = e, o.w = n, o.h = r, o
    }, i.from = function (t) {
        if (Array.isArray(t)) return i.fromArray(t);
        var e = new i;
        return e.x = t.offsetLeft, e.y = t.offsetTop, e.w = t.offsetWidth, e.h = t.offsetHeight, e
    }, i.fromArray = function (t) {
        if (4 === t.length) return i.create.apply(this, t);
        if (2 === t.length) return i.fromPoints(t[0], t[1]);
        throw new Error("fromArray method problem")
    }, i.sizeOf = function (t, e) {
        if (e) return i.create(0, 0, t, e);
        var n = new i;
        return n.w = t.offsetWidth, n.h = t.offsetHeight, n
    }, i.getMax = function (t, e, n) {
        return t / e > n ? [e * n, e] : [t, t / n]
    }, i.fromPoint = function (t, e, n) {
        var r = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : "br",
            o = new i;
        switch (o.x = t[0], o.y = t[1], r) {
            case "br":
                o.x2 = o.x + e, o.y2 = o.y + n;
                break;
            case "bl":
                o.x2 = o.x - e, o.y2 = o.y + n;
                break;
            case "tl":
                o.x2 = o.x - e, o.y2 = o.y - n;
                break;
            case "tr":
                o.x2 = o.x + e, o.y2 = o.y - n
        }
        return o
    }, e.default = i
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e.default = {
        animateEasingFunction: "swing",
        animateFrames: 30,
        multi: !1,
        multiMax: null,
        multiMin: 1,
        cropperClass: "jcrop-widget",
        disabledClass: "jcrop-disable",
        canDrag: !0,
        canResize: !0,
        canSelect: !0,
        canRemove: !0,
        multiple: !1,
        autoFront: !0,
        active: !0,
        handles: ["n", "s", "e", "w", "sw", "nw", "ne", "se"],
        shade: !0,
        shadeClass: "jcrop-shade",
        shadeColor: "black",
        shadeOpacity: .5,
        widgetConstructor: null,
        x: 0,
        y: 0,
        w: 100,
        h: 100
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    e.default = function (t, e, n, r) {
        var i, o;

        function a(t) {
            var n = "touchstart" === t.type ? t.touches[0] : t;
            i = n.pageX, o = n.pageY, t.preventDefault(), t.stopPropagation(), e(i, o, n) && ("mousedown" === t.type ? (window.addEventListener("mousemove", s), document.addEventListener("mouseup", u)) : "touchstart" === t.type && (document.addEventListener("touchmove", s), document.addEventListener("touchend", u)))
        }

        function s(t) {
            var e = "touchmove" === t.type ? t.changedTouches[0] : t;
            t.stopPropagation(), n(e.pageX - i, e.pageY - o)
        }

        function u(t) {
            var e = "touchend" === t.type ? t.changedTouches[0] : t;
            e.pageX && e.pageY && n(e.pageX - i, e.pageY - o), document.removeEventListener("mouseup", u), window.removeEventListener("mousemove", s), document.removeEventListener("touchmove", s), document.removeEventListener("touchend", u), r()
        }
        return "string" == typeof t && (t = document.getElementById(t)), t.addEventListener("mousedown", a), t.addEventListener("touchstart", a), {
            remove: function () {
                t.removeEventListener("mousedown", a), t.removeEventListener("touchstart", a)
            }
        }
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            return function (t, e) {
                if (Array.isArray(t)) return t;
                if (Symbol.iterator in Object(t)) return function (t, e) {
                    var n = [],
                        r = !0,
                        i = !1,
                        o = void 0;
                    try {
                        for (var a, s = t[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !e || n.length !== e); r = !0);
                    } catch (t) {
                        i = !0, o = t
                    } finally {
                        try {
                            !r && s.return && s.return()
                        } finally {
                            if (i) throw o
                        }
                    }
                    return n
                }(t, e);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(),
        i = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        o = function (t) {
            return t && t.__esModule ? t : {
                default: t
            }
        }(n(2));
    var a = function () {
        function t(e, n, r, i) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.sw = n, this.sh = r, this.rect = e, this.locked = this.getCornerPoint(this.getOppositeCorner(i)), this.stuck = this.getCornerPoint(i)
        }
        return i(t, [{
            key: "move",
            value: function (t, e) {
                return o.default.fromPoints(this.locked, this.translateStuckPoint(t, e))
            }
        }, {
            key: "getDragQuadrant",
            value: function (t, e) {
                var n = this.locked[0] - t,
                    r = this.locked[1] - e;
                return n < 0 && r < 0 ? "br" : n >= 0 && r >= 0 ? "tl" : n < 0 && r >= 0 ? "tr" : "bl"
            }
        }, {
            key: "getMaxRect",
            value: function (t, e, n) {
                return o.default.getMax(Math.abs(this.locked[0] - t), Math.abs(this.locked[1] - e), n)
            }
        }, {
            key: "translateStuckPoint",
            value: function (t, e) {
                var n = r(this.stuck, 3),
                    i = n[0],
                    a = n[1],
                    s = n[2],
                    u = null === i ? s : i + t,
                    c = null === a ? s : a + e;
                if (u > this.sw && (u = this.sw), c > this.sh && (c = this.sh), u < 0 && (u = 0), c < 0 && (c = 0), this.aspect) {
                    var f = this.getMaxRect(u, c, this.aspect),
                        l = r(f, 2),
                        h = l[0],
                        d = l[1],
                        p = this.getDragQuadrant(u, c),
                        v = o.default.fromPoint(this.locked, h, d, p);
                    return [v.x2, v.y2]
                }
                return [u, c]
            }
        }, {
            key: "getCornerPoint",
            value: function (t) {
                var e = this.rect;
                switch (t) {
                    case "n":
                        return [null, e.y, e.x];
                    case "s":
                        return [null, e.y2, e.x2];
                    case "e":
                        return [e.x2, null, e.y2];
                    case "w":
                        return [e.x, null, e.y];
                    case "se":
                        return [e.x2, e.y2];
                    case "sw":
                        return [e.x, e.y2];
                    case "ne":
                        return [e.x2, e.y];
                    case "nw":
                        return [e.x, e.y]
                }
            }
        }, {
            key: "getOppositeCorner",
            value: function (t) {
                switch (t) {
                    case "n":
                        return "se";
                    case "s":
                    case "e":
                        return "nw";
                    case "w":
                        return "se";
                    case "se":
                        return "nw";
                    case "sw":
                        return "ne";
                    case "ne":
                        return "sw";
                    case "nw":
                        return "se"
                }
            }
        }]), t
    }();
    a.create = function (t, e, n, r) {
        return new a(t, e, n, r)
    }, e.default = a
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        i = f(n(0)),
        o = f(n(7)),
        a = f(n(11)),
        s = f(n(4)),
        u = f(n(9)),
        c = f(n(5));

    function f(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }
    var l = function (t) {
        function e(t, n) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            var r = function (t, e) {
                if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return !e || "object" != typeof e && "function" != typeof e ? t : e
            }(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, t, n));
            return r.scalex = 1, r.scaley = 1, r.crops = new Set, r.active = null, r.enabled = !0, r.init(), r
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, u.default), r(e, [{
            key: "init",
            value: function () {
                this.initStageDrag(), a.default.Manager.attach(this)
            }
        }, {
            key: "initOptions",
            value: function () {
                var t = this;
                this._optconf.multi = function (e) {
                    e || t.limitWidgets()
                }
            }
        }, {
            key: "setEnabled",
            value: function () {
                var t = !(arguments.length > 0 && void 0 !== arguments[0]) || arguments[0],
                    e = this.options.disabledClass || "jcrop-disable";
                return this[t ? "removeClass" : "addClass"](e), this.enabled = !!t, this
            }
        }, {
            key: "focus",
            value: function () {
                return !!this.enabled && (this.active ? this.active.el.focus() : this.el.focus(), this)
            }
        }, {
            key: "limitWidgets",
            value: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 1;
                if (!this.crops || t < 1) return !1;
                for (var e = Array.from(this.crops); e.length > t;) this.removeWidget(e.shift());
                return this
            }
        }, {
            key: "canCreate",
            value: function () {
                var t = this.crops.size,
                    e = this.options;
                return !!this.enabled && (!(null !== e.multiMax && t >= e.multiMax) && !(!e.multi && t >= e.multiMin))
            }
        }, {
            key: "canRemove",
            value: function () {
                var t = this.crops.size,
                    e = this.options;
                return !!this.enabled && (!(this.active && !this.active.options.canRemove) && !(!e.canRemove || t <= e.multiMin))
            }
        }, {
            key: "initStageDrag",
            value: function () {
                var t, e, n, r, i, a = this;
                (0, s.default)(this.el, function (s, u, f) {
                    return !!a.canCreate() && (t = (a.options.widgetConstructor || o.default).create(a.options), (e = t.pos).x = f.pageX - a.el.offsetParent.offsetLeft - a.el.offsetLeft, e.y = f.pageY - a.el.offsetParent.offsetTop - a.el.offsetTop, n = a.el.offsetWidth, r = a.el.offsetHeight, a.addWidget(t), i = c.default.create(e, n, r, "se"), a.options.aspectRatio && (i.aspect = a.options.aspectRatio), t.render(e), a.focus(), !0)
                }, function (e, n) {
                    t.render(i.move(e, n))
                }, function () {
                    t.emit("crop.change")
                })
            }
        }, {
            key: "reorderWidgets",
            value: function () {
                var t = this,
                    e = 10;
                this.crops.forEach(function (n) {
                    n.el.style.zIndex = e++, t.active === n ? n.addClass("active") : n.removeClass("active")
                }), this.refresh()
            }
        }, {
            key: "activate",
            value: function (t) {
                if (!this.enabled) return this;
                if (t = t || Array.from(this.crops).pop()) {
                    if (this.active === t) return;
                    this.active = t, this.crops.delete(t), this.crops.add(t), this.reorderWidgets(), this.active.el.focus(), this.options.shade && this.shades.enable(), t.emit("crop.activate")
                } else this.shades.disable();
                return this
            }
        }, {
            key: "addWidget",
            value: function (t) {
                return t.attachToStage(this), t.appendTo(this.el), this.activate(t), this
            }
        }, {
            key: "newWidget",
            value: function (t) {
                var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                e = (0, i.default)({}, this.options, e);
                var n = (this.options.widgetConstructor || o.default).create(e);
                return n.render(t.unscale(this.scalex, this.scaley)), this.addWidget(n), n.el.focus(), n
            }
        }, {
            key: "removeWidget",
            value: function (t) {
                if (!this.canRemove()) return !1;
                t.emit("crop.remove"), t.el.remove(), this.crops.delete(t), this.activate()
            }
        }, {
            key: "refresh",
            value: function () {
                this.crops.forEach(function (t) {
                    t.render()
                }), this.options.shade && this.active && this.shades.adjust(this.active.pos)
            }
        }, {
            key: "updateShades",
            value: function () {
                if (this.shades) return this.options.shade ? this.shades.enable() : this.shades.disable(), this.options.shade && this.active && this.shades.adjust(this.active.pos), this
            }
        }, {
            key: "setOptions",
            value: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                (function t(e, n, r) {
                    null === e && (e = Function.prototype);
                    var i = Object.getOwnPropertyDescriptor(e, n);
                    if (void 0 === i) {
                        var o = Object.getPrototypeOf(e);
                        return null === o ? void 0 : t(o, n, r)
                    }
                    if ("value" in i) return i.value;
                    var a = i.get;
                    return void 0 !== a ? a.call(r) : void 0
                })(e.prototype.__proto__ || Object.getPrototypeOf(e.prototype), "setOptions", this).call(this, t), this.crops && Array.from(this.crops).forEach(function (e) {
                    return e.setOptions(t)
                })
            }
        }, {
            key: "destroy",
            value: function () {}
        }]), e
    }();
    e.default = l
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            return function (t, e) {
                if (Array.isArray(t)) return t;
                if (Symbol.iterator in Object(t)) return function (t, e) {
                    var n = [],
                        r = !0,
                        i = !1,
                        o = void 0;
                    try {
                        for (var a, s = t[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !e || n.length !== e); r = !0);
                    } catch (t) {
                        i = !0, o = t
                    } finally {
                        try {
                            !r && s.return && s.return()
                        } finally {
                            if (i) throw o
                        }
                    }
                    return n
                }(t, e);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(),
        i = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        o = p(n(0)),
        a = p(n(8)),
        s = p(n(3)),
        u = p(n(4)),
        c = p(n(2)),
        f = p(n(5)),
        l = p(n(9)),
        h = p(n(13)),
        d = p(n(14));

    function p(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }
    var v = function (t) {
        function e(t) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            var r = function (t, e) {
                if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return !e || "object" != typeof e && "function" != typeof e ? t : e
            }(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, t, n));
            return r.pos = c.default.from(r.el), r.init(), r
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, l.default), i(e, [{
            key: "init",
            value: function () {
                return this.createHandles(), this.createMover(), this.attachFocus(), h.default.attach(this), this
            }
        }, {
            key: "initOptions",
            value: function () {
                var t = this;
                this._optconf.aspectRatio = function (e) {
                    var n = t.pos;
                    if (t.aspect = e || null, t.aspect && n) {
                        var i = c.default.getMax(n.w, n.h, e),
                            o = r(i, 2),
                            a = o[0],
                            s = o[1];
                        t.render(c.default.fromPoint([n.x, n.y], a, s))
                    }
                }
            }
        }, {
            key: "attachToStage",
            value: function (t) {
                this.stage = t, this.emit("crop.attach")
            }
        }, {
            key: "attachFocus",
            value: function () {
                var t = this;
                this.el.addEventListener("focus", function (e) {
                    t.stage.activate(t), t.emit("crop.update")
                }, !1)
            }
        }, {
            key: "animate",
            value: function (t, e, n) {
                var r = this,
                    i = this;
                return n = n || i.options.animateEasingFunction || "swing", e = e || i.options.animateFrames || 30, (0, d.default)(i.el, i.pos, t, function (t) {
                    return i.render(t.normalize())
                }, e, n).then(function () {
                    return r.emit("crop.change")
                })
            }
        }, {
            key: "createMover",
            value: function () {
                var t, e, n, r = this;
                this.pos = c.default.from(this.el), (0, u.default)(this.el, function () {
                    var i = r.el.parentElement;
                    if (!r.stage.enabled) return !1;
                    var o = [i.offsetWidth, i.offsetHeight];
                    return t = o[0], e = o[1], n = c.default.from(r.el), r.el.focus(), r.stage.activate(r), !0
                }, function (i, o) {
                    r.pos.x = n.x + i, r.pos.y = n.y + o, r.render(r.pos.rebound(t, e))
                }, function () {
                    r.emit("crop.change")
                })
            }
        }, {
            key: "nudge",
            value: function () {
                var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 0,
                    e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 0,
                    n = this.el.parentElement,
                    r = [n.offsetWidth, n.offsetHeight],
                    i = r[0],
                    o = r[1];
                t && (this.pos.x += t), e && (this.pos.y += e), this.render(this.pos.rebound(i, o)), this.emit("crop.change")
            }
        }, {
            key: "createHandles",
            value: function () {
                var t = this;
                return this.options.handles.forEach(function (e) {
                    var n, r = a.default.create("jcrop-handle " + e);
                    r.appendTo(t.el), (0, u.default)(r.el, function () {
                        if (!t.stage.enabled) return !1;
                        var r = t.el.parentElement,
                            i = r.offsetWidth,
                            o = r.offsetHeight;
                        return n = f.default.create(c.default.from(t.el), i, o, e), t.aspect && (n.aspect = t.aspect), t.el.focus(), t.emit("crop.active"), !0
                    }, function (e, r) {
                        return t.render(n.move(e, r))
                    }, function () {
                        t.emit("crop.change")
                    })
                }), this
            }
        }, {
            key: "isActive",
            value: function () {
                return this.stage && this.stage.active === this
            }
        }, {
            key: "render",
            value: function (t) {
                return t = t || this.pos, this.el.style.top = Math.round(t.y) + "px", this.el.style.left = Math.round(t.x) + "px", this.el.style.width = Math.round(t.w) + "px", this.el.style.height = Math.round(t.h) + "px", this.pos = t, this.emit("crop.update"), this
            }
        }, {
            key: "doneDragging",
            value: function () {
                this.pos = c.default.from(this.el)
            }
        }, {
            key: "sel",
            get: function () {
                var t = this.stage;
                return this.pos.scale(t.scalex, t.scaley)
            }
        }]), e
    }();
    v.create = function () {
        var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {},
            e = document.createElement("div"),
            n = (0, o.default)({}, s.default, t);
        return e.setAttribute("tabindex", "0"), e.className = n.cropperClass || "jcrop-widget", new(t.widgetConstructor || v)(e, n)
    }, e.default = v
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function (t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }(n(1));
    var i = function (t) {
        function e() {
            return function (t, e) {
                    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
                }(this, e),
                function (t, e) {
                    if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !e || "object" != typeof e && "function" != typeof e ? t : e
                }(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments))
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, r.default), e
    }();
    i.create = function (t) {
        var e = document.createElement("div");
        return e.className = t, new i(e)
    }, e.default = i
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        i = s(n(0)),
        o = s(n(1)),
        a = s(n(3));

    function s(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }
    var u = function (t) {
        function e(t) {
            var n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            var r = function (t, e) {
                if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return !e || "object" != typeof e && "function" != typeof e ? t : e
            }(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, t));
            return r.options = {}, Object.defineProperty(r, "_optconf", {
                configurable: !1,
                enumerable: !1,
                value: {},
                writable: !0
            }), r.initOptions(), r.setOptions((0, i.default)({}, a.default, n)), r
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, o.default), r(e, [{
            key: "setOptions",
            value: function (t) {
                var e = this;
                return this.options = (0, i.default)({}, this.options, t), Object.keys(t).forEach(function (n) {
                    e._optconf[n] && e._optconf[n](t[n])
                }), this
            }
        }, {
            key: "initOptions",
            value: function () {}
        }]), e
    }();
    e.default = u
}, function (t, e, n) {
    "use strict";
    var r = t.exports = {
        def: "outQuad",
        swing: function (t, e, n, i) {
            return r[r.def](t, e, n, i)
        },
        inQuad: function (t, e, n, r) {
            return n * (t /= r) * t + e
        },
        outQuad: function (t, e, n, r) {
            return -n * (t /= r) * (t - 2) + e
        },
        inOutQuad: function (t, e, n, r) {
            return (t /= r / 2) < 1 ? n / 2 * t * t + e : -n / 2 * (--t * (t - 2) - 1) + e
        },
        inCubic: function (t, e, n, r) {
            return n * (t /= r) * t * t + e
        },
        outCubic: function (t, e, n, r) {
            return n * ((t = t / r - 1) * t * t + 1) + e
        },
        inOutCubic: function (t, e, n, r) {
            return (t /= r / 2) < 1 ? n / 2 * t * t * t + e : n / 2 * ((t -= 2) * t * t + 2) + e
        },
        inQuart: function (t, e, n, r) {
            return n * (t /= r) * t * t * t + e
        },
        outQuart: function (t, e, n, r) {
            return -n * ((t = t / r - 1) * t * t * t - 1) + e
        },
        inOutQuart: function (t, e, n, r) {
            return (t /= r / 2) < 1 ? n / 2 * t * t * t * t + e : -n / 2 * ((t -= 2) * t * t * t - 2) + e
        },
        inQuint: function (t, e, n, r) {
            return n * (t /= r) * t * t * t * t + e
        },
        outQuint: function (t, e, n, r) {
            return n * ((t = t / r - 1) * t * t * t * t + 1) + e
        },
        inOutQuint: function (t, e, n, r) {
            return (t /= r / 2) < 1 ? n / 2 * t * t * t * t * t + e : n / 2 * ((t -= 2) * t * t * t * t + 2) + e
        },
        inSine: function (t, e, n, r) {
            return -n * Math.cos(t / r * (Math.PI / 2)) + n + e
        },
        outSine: function (t, e, n, r) {
            return n * Math.sin(t / r * (Math.PI / 2)) + e
        },
        inOutSine: function (t, e, n, r) {
            return -n / 2 * (Math.cos(Math.PI * t / r) - 1) + e
        },
        inExpo: function (t, e, n, r) {
            return 0 == t ? e : n * Math.pow(2, 10 * (t / r - 1)) + e
        },
        outExpo: function (t, e, n, r) {
            return t == r ? e + n : n * (1 - Math.pow(2, -10 * t / r)) + e
        },
        inOutExpo: function (t, e, n, r) {
            return 0 == t ? e : t == r ? e + n : (t /= r / 2) < 1 ? n / 2 * Math.pow(2, 10 * (t - 1)) + e : n / 2 * (2 - Math.pow(2, -10 * --t)) + e
        },
        inCirc: function (t, e, n, r) {
            return -n * (Math.sqrt(1 - (t /= r) * t) - 1) + e
        },
        outCirc: function (t, e, n, r) {
            return n * Math.sqrt(1 - (t = t / r - 1) * t) + e
        },
        inOutCirc: function (t, e, n, r) {
            return (t /= r / 2) < 1 ? -n / 2 * (Math.sqrt(1 - t * t) - 1) + e : n / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + e
        },
        inElastic: function (t, e, n, r) {
            var i = 1.70158,
                o = 0,
                a = n;
            if (0 == t) return e;
            if (1 == (t /= r)) return e + n;
            if (o || (o = .3 * r), a < Math.abs(n)) {
                a = n;
                i = o / 4
            } else i = o / (2 * Math.PI) * Math.asin(n / a);
            return -a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * r - i) * (2 * Math.PI) / o) + e
        },
        outElastic: function (t, e, n, r) {
            var i = 1.70158,
                o = 0,
                a = n;
            if (0 == t) return e;
            if (1 == (t /= r)) return e + n;
            if (o || (o = .3 * r), a < Math.abs(n)) {
                a = n;
                i = o / 4
            } else i = o / (2 * Math.PI) * Math.asin(n / a);
            return a * Math.pow(2, -10 * t) * Math.sin((t * r - i) * (2 * Math.PI) / o) + n + e
        },
        inOutElastic: function (t, e, n, r) {
            var i = 1.70158,
                o = 0,
                a = n;
            if (0 == t) return e;
            if (2 == (t /= r / 2)) return e + n;
            if (o || (o = r * (.3 * 1.5)), a < Math.abs(n)) {
                a = n;
                i = o / 4
            } else i = o / (2 * Math.PI) * Math.asin(n / a);
            return t < 1 ? a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * r - i) * (2 * Math.PI) / o) * -.5 + e : a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * r - i) * (2 * Math.PI) / o) * .5 + n + e
        },
        inBack: function (t, e, n, r, i) {
            return void 0 == i && (i = 1.70158), n * (t /= r) * t * ((i + 1) * t - i) + e
        },
        outBack: function (t, e, n, r, i) {
            return void 0 == i && (i = 1.70158), n * ((t = t / r - 1) * t * ((i + 1) * t + i) + 1) + e
        },
        inOutBack: function (t, e, n, r, i) {
            return void 0 == i && (i = 1.70158), (t /= r / 2) < 1 ? n / 2 * (t * t * ((1 + (i *= 1.525)) * t - i)) + e : n / 2 * ((t -= 2) * t * ((1 + (i *= 1.525)) * t + i) + 2) + e
        },
        inBounce: function (t, e, n, i) {
            return n - r.outBounce(i - t, 0, n, i) + e
        },
        outBounce: function (t, e, n, r) {
            return (t /= r) < 1 / 2.75 ? n * (7.5625 * t * t) + e : t < 2 / 2.75 ? n * (7.5625 * (t -= 1.5 / 2.75) * t + .75) + e : t < 2.5 / 2.75 ? n * (7.5625 * (t -= 2.25 / 2.75) * t + .9375) + e : n * (7.5625 * (t -= 2.625 / 2.75) * t + .984375) + e
        },
        inOutBounce: function (t, e, n, i) {
            return t < i / 2 ? .5 * r.inBounce(2 * t, 0, n, i) + e : .5 * r.outBounce(2 * t - i, 0, n, i) + .5 * n + e
        }
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        i = a(n(2)),
        o = a(n(1));

    function a(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }

    function s(t, e) {
        if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
    }
    var u = function () {
        function t(e) {
            s(this, t), "string" == typeof e && (e = document.getElementById(e)), this.el = e, this.shades = {}
        }
        return r(t, [{
            key: "init",
            value: function () {
                var t = this,
                    e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : {};
                this.active = void 0 === e.shade || e.shade, this.keys().forEach(function (n) {
                    t.shades[n] = c.create(e, n)
                }), this.el.addEventListener("crop.update", function (e) {
                    e.cropTarget.isActive() && e.cropTarget.options.shade && t.adjust(e.cropTarget.pos)
                }, !1), this.enable()
            }
        }, {
            key: "adjust",
            value: function (t) {
                var e = i.default.from(this.el),
                    n = this.shades;
                n.t.h = t.y, n.b.h = e.h - t.y2, n.t.w = n.b.w = Math.floor(t.w), n.l.w = n.t.x = n.b.x = Math.ceil(t.x), n.r.w = e.w - (Math.ceil(t.x) + Math.floor(t.w))
            }
        }, {
            key: "keys",
            value: function () {
                return ["t", "l", "r", "b"]
            }
        }, {
            key: "enable",
            value: function () {
                var t = this,
                    e = this.shades;
                this.keys().forEach(function (n) {
                    return e[n].insert(t.el)
                })
            }
        }, {
            key: "disable",
            value: function () {
                var t = this.shades;
                this.keys().forEach(function (e) {
                    return t[e].remove()
                })
            }
        }, {
            key: "setStyle",
            value: function (t, e) {
                var n = this.shades;
                this.keys().forEach(function (r) {
                    return n[r].color(t).opacity(e)
                })
            }
        }]), t
    }();
    u.attach = function (t) {
        var e = t.el,
            n = new u(e);
        return n.init(t.options), t.shades = n, t._optconf.shade = function (e) {
            return t.updateShades()
        }, t._optconf.shadeColor = function (t) {
            return n.setStyle(t)
        }, t._optconf.shadeOpacity = function (t) {
            return n.setStyle(null, t)
        }, n
    };
    var c = function (t) {
        function e() {
            return s(this, e),
                function (t, e) {
                    if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return !e || "object" != typeof e && "function" != typeof e ? t : e
                }(this, (e.__proto__ || Object.getPrototypeOf(e)).apply(this, arguments))
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, o.default), r(e, [{
            key: "insert",
            value: function (t) {
                t.appendChild(this.el)
            }
        }, {
            key: "remove",
            value: function () {
                this.el.remove()
            }
        }, {
            key: "color",
            value: function (t) {
                return t && (this.el.style.backgroundColor = t), this
            }
        }, {
            key: "opacity",
            value: function (t) {
                return t && (this.el.style.opacity = t), this
            }
        }, {
            key: "w",
            set: function (t) {
                this.el.style.width = t + "px"
            }
        }, {
            key: "h",
            set: function (t) {
                this.el.style.height = t + "px"
            }
        }, {
            key: "x",
            set: function (t) {
                this.el.style.left = t + "px"
            }
        }]), e
    }();
    c.create = function (t, e) {
        var n = document.createElement("div"),
            r = t.shadeClass || "jcrop-shade";
        return n.className = r + " " + e, new c(n).color(t.shadeColor).opacity(t.shadeOpacity)
    }, c.Manager = u, e.default = c
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), e.DomObj = e.Shade = e.load = e.easing = e.Sticker = e.Handle = e.Rect = e.Widget = e.Dragger = e.defaults = e.Stage = void 0, e.attach = b;
    var r = y(n(0)),
        i = y(n(3)),
        o = y(n(6)),
        a = y(n(15)),
        s = y(n(7)),
        u = y(n(11)),
        c = y(n(8)),
        f = y(n(4)),
        l = y(n(2)),
        h = y(n(5)),
        d = y(n(1)),
        p = y(n(10)),
        v = y(n(18));

    function y(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }

    function b(t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
        return e = (0, r.default)({}, i.default, e), "string" == typeof t && (t = document.getElementById(t)), "IMG" === t.tagName ? new a.default(t, e) : new o.default(t, e)
    }
    e.Stage = o.default, e.defaults = i.default, e.Dragger = f.default, e.Widget = s.default, e.Rect = l.default, e.Handle = c.default, e.Sticker = h.default, e.easing = p.default, e.load = v.default, e.Shade = u.default, e.DomObj = d.default, e.default = {
        Stage: o.default,
        defaults: i.default,
        Dragger: f.default,
        Widget: s.default,
        Rect: l.default,
        Handle: c.default,
        Sticker: h.default,
        easing: p.default,
        load: v.default,
        attach: b,
        Shade: u.default,
        DomObj: d.default
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
        function t(t, e) {
            for (var n = 0; n < e.length; n++) {
                var r = e[n];
                r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
            }
        }
        return function (e, n, r) {
            return n && t(e.prototype, n), r && t(e, r), e
        }
    }();
    var i = function () {
        function t(e) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t), this.widget = e, this.attach()
        }
        return r(t, [{
            key: "attach",
            value: function () {
                var t = this.widget;
                t.el.addEventListener("keydown", function (e) {
                    var n = e.shiftKey ? 10 : 1;
                    switch (e.key) {
                        case "ArrowRight":
                            t.nudge(n);
                            break;
                        case "ArrowLeft":
                            t.nudge(-n);
                            break;
                        case "ArrowUp":
                            t.nudge(0, -n);
                            break;
                        case "ArrowDown":
                            t.nudge(0, n);
                            break;
                        case "Delete":
                        case "Backspace":
                            t.stage.removeWidget(t);
                            break;
                        default:
                            return
                    }
                    e.preventDefault()
                })
            }
        }]), t
    }();
    i.attach = function (t) {
        return new i(t)
    }, e.default = i
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function (t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }(n(10));
    e.default = function (t, e, n, i) {
        var o = arguments.length > 4 && void 0 !== arguments[4] ? arguments[4] : 30,
            a = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : "swing",
            s = ["x", "y", "w", "h"],
            u = e.normalize();
        a = "string" == typeof a ? r.default[a] : a;
        var c = 0;
        return new Promise(function (t, r) {
            requestAnimationFrame(function r() {
                c < o ? (s.forEach(function (t) {
                    u[t] = Math.round(a(c, e[t], n[t] - e[t], o))
                }), i(u), c++, requestAnimationFrame(r)) : (i(n), t())
            })
        })
    }
}, function (t, e, n) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0
    });
    var r = function () {
            return function (t, e) {
                if (Array.isArray(t)) return t;
                if (Symbol.iterator in Object(t)) return function (t, e) {
                    var n = [],
                        r = !0,
                        i = !1,
                        o = void 0;
                    try {
                        for (var a, s = t[Symbol.iterator](); !(r = (a = s.next()).done) && (n.push(a.value), !e || n.length !== e); r = !0);
                    } catch (t) {
                        i = !0, o = t
                    } finally {
                        try {
                            !r && s.return && s.return()
                        } finally {
                            if (i) throw o
                        }
                    }
                    return n
                }(t, e);
                throw new TypeError("Invalid attempt to destructure non-iterable instance")
            }
        }(),
        i = function () {
            function t(t, e) {
                for (var n = 0; n < e.length; n++) {
                    var r = e[n];
                    r.enumerable = r.enumerable || !1, r.configurable = !0, "value" in r && (r.writable = !0), Object.defineProperty(t, r.key, r)
                }
            }
            return function (e, n, r) {
                return n && t(e.prototype, n), r && t(e, r), e
            }
        }(),
        o = s(n(6)),
        a = s(n(16));

    function s(t) {
        return t && t.__esModule ? t : {
            default: t
        }
    }
    var u = function (t) {
        function e(t, n) {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, e);
            var r = function (t) {
                var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : document.createElement("div");
                return e.className = t, e
            }("jcrop-stage jcrop-image-stage");
            t.parentNode.insertBefore(r, t);
            var i = function (t, e) {
                if (!t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return !e || "object" != typeof e && "function" != typeof e ? t : e
            }(this, (e.__proto__ || Object.getPrototypeOf(e)).call(this, r, n));
            return i.srcEl = t, t.onload = i.resizeToImage.bind(i), i.resizeToImage(), i.initResizeObserver(), i
        }
        return function (t, e) {
            if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function, not " + typeof e);
            t.prototype = Object.create(e && e.prototype, {
                constructor: {
                    value: t,
                    enumerable: !1,
                    writable: !0,
                    configurable: !0
                }
            }), e && (Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : t.__proto__ = e)
        }(e, o.default), i(e, [{
            key: "initResizeObserver",
            value: function () {
                var t = this;
                new a.default(function (e, n) {
                    t.resizeToImage()
                }).observe(this.srcEl)
            }
        }, {
            key: "resizeToImage",
            value: function () {
                var t = this.getImageDimensions(),
                    e = r(t, 2),
                    n = e[0],
                    i = e[1],
                    o = this.getNaturalDimensions(),
                    a = r(o, 2),
                    s = a[0],
                    u = a[1];
                this.el.style.width = n + "px", this.el.style.height = i + "px", this.rescaleWidgets(n / s, i / u), this.scalex = s / n, this.scaley = u / i, this.refresh()
            }
        }, {
            key: "rescaleWidgets",
            value: function (t, e) {
                this.crops.forEach(function (n) {
                    n.pos = n.sel.scale(t, e)
                })
            }
        }, {
            key: "getImageDimensions",
            value: function () {
                return [this.srcEl.width, this.srcEl.height]
            }
        }, {
            key: "getNaturalDimensions",
            value: function () {
                return [this.srcEl.naturalWidth || this.srcEl.width, this.srcEl.naturalHeight || this.srcEl.height]
            }
        }, {
            key: "destroy",
            value: function () {
                this.el.remove()
            }
        }]), e
    }();
    e.default = u
}, function (t, e, n) {
    "use strict";
    n.r(e),
        function (t) {
            var n = function () {
                    if ("undefined" != typeof Map) return Map;

                    function t(t, e) {
                        var n = -1;
                        return t.some(function (t, r) {
                            return t[0] === e && (n = r, !0)
                        }), n
                    }
                    return function () {
                        function e() {
                            this.__entries__ = []
                        }
                        var n = {
                            size: {
                                configurable: !0
                            }
                        };
                        return n.size.get = function () {
                            return this.__entries__.length
                        }, e.prototype.get = function (e) {
                            var n = t(this.__entries__, e),
                                r = this.__entries__[n];
                            return r && r[1]
                        }, e.prototype.set = function (e, n) {
                            var r = t(this.__entries__, e);
                            ~r ? this.__entries__[r][1] = n : this.__entries__.push([e, n])
                        }, e.prototype.delete = function (e) {
                            var n = this.__entries__,
                                r = t(n, e);
                            ~r && n.splice(r, 1)
                        }, e.prototype.has = function (e) {
                            return !!~t(this.__entries__, e)
                        }, e.prototype.clear = function () {
                            this.__entries__.splice(0)
                        }, e.prototype.forEach = function (t, e) {
                            void 0 === e && (e = null);
                            for (var n = 0, r = this.__entries__; n < r.length; n += 1) {
                                var i = r[n];
                                t.call(e, i[1], i[0])
                            }
                        }, Object.defineProperties(e.prototype, n), e
                    }()
                }(),
                r = "undefined" != typeof window && "undefined" != typeof document && window.document === document,
                i = void 0 !== t && t.Math === Math ? t : "undefined" != typeof self && self.Math === Math ? self : "undefined" != typeof window && window.Math === Math ? window : Function("return this")(),
                o = "function" == typeof requestAnimationFrame ? requestAnimationFrame.bind(i) : function (t) {
                    return setTimeout(function () {
                        return t(Date.now())
                    }, 1e3 / 60)
                },
                a = 2,
                s = ["top", "right", "bottom", "left", "width", "height", "size", "weight"],
                u = "undefined" != typeof MutationObserver,
                c = function () {
                    this.connected_ = !1, this.mutationEventsAdded_ = !1, this.mutationsObserver_ = null, this.observers_ = [], this.onTransitionEnd_ = this.onTransitionEnd_.bind(this), this.refresh = function (t, e) {
                        var n = !1,
                            r = !1,
                            i = 0;

                        function s() {
                            n && (n = !1, t()), r && c()
                        }

                        function u() {
                            o(s)
                        }

                        function c() {
                            var t = Date.now();
                            if (n) {
                                if (t - i < a) return;
                                r = !0
                            } else n = !0, r = !1, setTimeout(u, e);
                            i = t
                        }
                        return c
                    }(this.refresh.bind(this), 20)
                };
            c.prototype.addObserver = function (t) {
                ~this.observers_.indexOf(t) || this.observers_.push(t), this.connected_ || this.connect_()
            }, c.prototype.removeObserver = function (t) {
                var e = this.observers_,
                    n = e.indexOf(t);
                ~n && e.splice(n, 1), !e.length && this.connected_ && this.disconnect_()
            }, c.prototype.refresh = function () {
                this.updateObservers_() && this.refresh()
            }, c.prototype.updateObservers_ = function () {
                var t = this.observers_.filter(function (t) {
                    return t.gatherActive(), t.hasActive()
                });
                return t.forEach(function (t) {
                    return t.broadcastActive()
                }), t.length > 0
            }, c.prototype.connect_ = function () {
                r && !this.connected_ && (document.addEventListener("transitionend", this.onTransitionEnd_), window.addEventListener("resize", this.refresh), u ? (this.mutationsObserver_ = new MutationObserver(this.refresh), this.mutationsObserver_.observe(document, {
                    attributes: !0,
                    childList: !0,
                    characterData: !0,
                    subtree: !0
                })) : (document.addEventListener("DOMSubtreeModified", this.refresh), this.mutationEventsAdded_ = !0), this.connected_ = !0)
            }, c.prototype.disconnect_ = function () {
                r && this.connected_ && (document.removeEventListener("transitionend", this.onTransitionEnd_), window.removeEventListener("resize", this.refresh), this.mutationsObserver_ && this.mutationsObserver_.disconnect(), this.mutationEventsAdded_ && document.removeEventListener("DOMSubtreeModified", this.refresh), this.mutationsObserver_ = null, this.mutationEventsAdded_ = !1, this.connected_ = !1)
            }, c.prototype.onTransitionEnd_ = function (t) {
                var e = t.propertyName;
                void 0 === e && (e = ""), s.some(function (t) {
                    return !!~e.indexOf(t)
                }) && this.refresh()
            }, c.getInstance = function () {
                return this.instance_ || (this.instance_ = new c), this.instance_
            }, c.instance_ = null;
            var f = function (t, e) {
                    for (var n = 0, r = Object.keys(e); n < r.length; n += 1) {
                        var i = r[n];
                        Object.defineProperty(t, i, {
                            value: e[i],
                            enumerable: !1,
                            writable: !1,
                            configurable: !0
                        })
                    }
                    return t
                },
                l = function (t) {
                    return t && t.ownerDocument && t.ownerDocument.defaultView || i
                },
                h = m(0, 0, 0, 0);

            function d(t) {
                return parseFloat(t) || 0
            }

            function p(t) {
                for (var e = [], n = arguments.length - 1; n-- > 0;) e[n] = arguments[n + 1];
                return e.reduce(function (e, n) {
                    return e + d(t["border-" + n + "-width"])
                }, 0)
            }

            function v(t) {
                var e = t.clientWidth,
                    n = t.clientHeight;
                if (!e && !n) return h;
                var r = l(t).getComputedStyle(t),
                    i = function (t) {
                        for (var e = {}, n = 0, r = ["top", "right", "bottom", "left"]; n < r.length; n += 1) {
                            var i = r[n],
                                o = t["padding-" + i];
                            e[i] = d(o)
                        }
                        return e
                    }(r),
                    o = i.left + i.right,
                    a = i.top + i.bottom,
                    s = d(r.width),
                    u = d(r.height);
                if ("border-box" === r.boxSizing && (Math.round(s + o) !== e && (s -= p(r, "left", "right") + o), Math.round(u + a) !== n && (u -= p(r, "top", "bottom") + a)), ! function (t) {
                        return t === l(t).document.documentElement
                    }(t)) {
                    var c = Math.round(s + o) - e,
                        f = Math.round(u + a) - n;
                    1 !== Math.abs(c) && (s -= c), 1 !== Math.abs(f) && (u -= f)
                }
                return m(i.left, i.top, s, u)
            }
            var y = "undefined" != typeof SVGGraphicsElement ? function (t) {
                return t instanceof l(t).SVGGraphicsElement
            } : function (t) {
                return t instanceof l(t).SVGElement && "function" == typeof t.getBBox
            };

            function b(t) {
                return r ? y(t) ? function (t) {
                    var e = t.getBBox();
                    return m(0, 0, e.width, e.height)
                }(t) : v(t) : h
            }

            function m(t, e, n, r) {
                return {
                    x: t,
                    y: e,
                    width: n,
                    height: r
                }
            }
            var g = function (t) {
                this.broadcastWidth = 0, this.broadcastHeight = 0, this.contentRect_ = m(0, 0, 0, 0), this.target = t
            };
            g.prototype.isActive = function () {
                var t = b(this.target);
                return this.contentRect_ = t, t.width !== this.broadcastWidth || t.height !== this.broadcastHeight
            }, g.prototype.broadcastRect = function () {
                var t = this.contentRect_;
                return this.broadcastWidth = t.width, this.broadcastHeight = t.height, t
            };
            var w = function (t, e) {
                    var n = function (t) {
                        var e = t.x,
                            n = t.y,
                            r = t.width,
                            i = t.height,
                            o = "undefined" != typeof DOMRectReadOnly ? DOMRectReadOnly : Object,
                            a = Object.create(o.prototype);
                        return f(a, {
                            x: e,
                            y: n,
                            width: r,
                            height: i,
                            top: n,
                            right: e + r,
                            bottom: i + n,
                            left: e
                        }), a
                    }(e);
                    f(this, {
                        target: t,
                        contentRect: n
                    })
                },
                _ = function (t, e, r) {
                    if (this.activeObservations_ = [], this.observations_ = new n, "function" != typeof t) throw new TypeError("The callback provided as parameter 1 is not a function.");
                    this.callback_ = t, this.controller_ = e, this.callbackCtx_ = r
                };
            _.prototype.observe = function (t) {
                if (!arguments.length) throw new TypeError("1 argument required, but only 0 present.");
                if ("undefined" != typeof Element && Element instanceof Object) {
                    if (!(t instanceof l(t).Element)) throw new TypeError('parameter 1 is not of type "Element".');
                    var e = this.observations_;
                    e.has(t) || (e.set(t, new g(t)), this.controller_.addObserver(this), this.controller_.refresh())
                }
            }, _.prototype.unobserve = function (t) {
                if (!arguments.length) throw new TypeError("1 argument required, but only 0 present.");
                if ("undefined" != typeof Element && Element instanceof Object) {
                    if (!(t instanceof l(t).Element)) throw new TypeError('parameter 1 is not of type "Element".');
                    var e = this.observations_;
                    e.has(t) && (e.delete(t), e.size || this.controller_.removeObserver(this))
                }
            }, _.prototype.disconnect = function () {
                this.clearActive(), this.observations_.clear(), this.controller_.removeObserver(this)
            }, _.prototype.gatherActive = function () {
                var t = this;
                this.clearActive(), this.observations_.forEach(function (e) {
                    e.isActive() && t.activeObservations_.push(e)
                })
            }, _.prototype.broadcastActive = function () {
                if (this.hasActive()) {
                    var t = this.callbackCtx_,
                        e = this.activeObservations_.map(function (t) {
                            return new w(t.target, t.broadcastRect())
                        });
                    this.callback_.call(t, e, t), this.clearActive()
                }
            }, _.prototype.clearActive = function () {
                this.activeObservations_.splice(0)
            }, _.prototype.hasActive = function () {
                return this.activeObservations_.length > 0
            };
            var O = "undefined" != typeof WeakMap ? new WeakMap : new n,
                k = function (t) {
                    if (!(this instanceof k)) throw new TypeError("Cannot call a class as a function.");
                    if (!arguments.length) throw new TypeError("1 argument required, but only 0 present.");
                    var e = c.getInstance(),
                        n = new _(t, e, this);
                    O.set(this, n)
                };
            ["observe", "unobserve", "disconnect"].forEach(function (t) {
                k.prototype[t] = function () {
                    return (e = O.get(this))[t].apply(e, arguments);
                    var e
                }
            });
            var E = void 0 !== i.ResizeObserver ? i.ResizeObserver : k;
            e.default = E
        }.call(this, n(17))
}, function (t, e) {
    var n;
    n = function () {
        return this
    }();
    try {
        n = n || Function("return this")() || (0, eval)("this")
    } catch (t) {
        "object" == typeof window && (n = window)
    }
    t.exports = n
}, function (t, e, n) {
    "use strict";

    function r(t) {
        return "string" == typeof t && (t = document.getElementById(t)), new Promise(function (e, n) {
            if (r.check(t)) return e(t);

            function i(r) {
                t.removeEventListener("load", i), t.removeEventListener("error", i), "load" === r.type ? e(t) : n(t)
            }
            t.addEventListener("load", i), t.addEventListener("error", i)
        })
    }
    Object.defineProperty(e, "__esModule", {
        value: !0
    }), r.check = function (t) {
        return !!t.complete && 0 !== t.naturalWidth
    }, e.default = r
}]);
//# sourceMappingURL=jcrop.js.map
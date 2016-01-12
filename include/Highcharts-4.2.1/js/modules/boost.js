(function (c) {
    typeof module === "object" && module.exports ? module.exports = c : c(Highcharts)
})(function (c) {
    function v(a, b, d, e, f) {
        f = f || 0;
        e = e || w;
        k(a.slice(f, f + e), b);
        f + e < a.length ? setTimeout(function () {
            v(a, b, d, e, f + e)
        }) : d && d()
    }

    var p = c.win.document, M = function () {
    }, N = c.Color, j = c.Series, h = c.seriesTypes, k = c.each, q = c.extend, O = c.addEvent, P = c.fireEvent, Q = c.merge, R = c.pick, g = c.wrap, n = c.getOptions().plotOptions, w = 5E4;
    k(["area", "arearange", "column", "line", "scatter"], function (a) {
        if (n[a])n[a].boostThreshold = 5E3
    });
    k(["translate",
        "generatePoints", "drawTracker", "drawPoints", "render"], function (a) {
        function b(b) {
            var e = this.options.stacking && (a === "translate" || a === "generatePoints");
            if ((this.processedXData || this.options.data).length < (this.options.boostThreshold || Number.MAX_VALUE) || e) {
                if (a === "render" && this.image)this.image.attr({href: ""}), this.animate = null;
                b.call(this)
            } else if (this[a + "Canvas"])this[a + "Canvas"]()
        }

        g(j.prototype, a, b);
        a === "translate" && (h.column && g(h.column.prototype, a, b), h.arearange && g(h.arearange.prototype, a, b))
    });
    g(j.prototype,
        "getExtremes", function (a) {
            this.hasExtremes() || a.apply(this, Array.prototype.slice.call(arguments, 1))
        });
    g(j.prototype, "setData", function (a) {
        this.hasExtremes(!0) || a.apply(this, Array.prototype.slice.call(arguments, 1))
    });
    g(j.prototype, "processData", function (a) {
        this.hasExtremes(!0) || a.apply(this, Array.prototype.slice.call(arguments, 1))
    });
    c.extend(j.prototype, {
        pointRange: 0, hasExtremes: function (a) {
            var b = this.options, d = this.xAxis && this.xAxis.options, e = this.yAxis && this.yAxis.options;
            return b.data.length > (b.boostThreshold ||
                Number.MAX_VALUE) && typeof e.min === "number" && typeof e.max === "number" && (!a || typeof d.min === "number" && typeof d.max === "number")
        }, destroyGraphics: function () {
            var a = this, b = this.points, d, e;
            if (b)for (e = 0; e < b.length; e += 1)if ((d = b[e]) && d.graphic)d.graphic = d.graphic.destroy();
            k(["graph", "area", "tracker"], function (b) {
                a[b] && (a[b] = a[b].destroy())
            })
        }, getContext: function () {
            var a = this.chart, b = a.plotWidth, d = a.plotHeight, e = this.ctx, f = function (a, b, d, e, f, c, i) {
                a.call(this, d, b, e, f, c, i)
            };
            this.canvas ? e.clearRect(0, 0, b, d) : (this.canvas =
                p.createElement("canvas"), this.image = a.renderer.image("", 0, 0, b, d).add(this.group), this.ctx = e = this.canvas.getContext("2d"), a.inverted && k(["moveTo", "lineTo", "rect", "arc"], function (a) {
                g(e, a, f)
            }));
            this.canvas.setAttribute("width", b);
            this.canvas.setAttribute("height", d);
            this.image.attr({width: b, height: d});
            return e
        }, canvasToSVG: function () {
            this.image.attr({href: this.canvas.toDataURL("image/png")})
        }, cvsLineTo: function (a, b, d) {
            a.lineTo(b, d)
        }, renderCanvas: function () {
            var a = this, b = a.options, d = a.chart, e = this.xAxis,
                f = this.yAxis, c, h, g = 0, j = a.processedXData, k = a.processedYData, n = b.data, i = e.getExtremes(), p = i.min, S = i.max, i = f.getExtremes(), T = i.min, U = i.max, x = {}, r, V = !!a.sampling, y, z = b.marker && b.marker.radius, A = this.cvsDrawPoint, B = b.lineWidth ? this.cvsLineTo : !1, C = z <= 1 ? this.cvsMarkerSquare : this.cvsMarkerCircle, W = b.enableMouseTracking !== !1, D, i = b.threshold, l = f.getThreshold(i), E = typeof i === "number", F = l, X = this.fill, G = a.pointArrayMap && a.pointArrayMap.join(",") === "low,high", H = !!b.stacking, Y = a.cropStart || 0, i = d.options.loading,
                Z = a.requireSorting, I, $ = b.connectNulls, J = !j, s, t, m, o, aa = a.fillOpacity ? (new N(a.color)).setOpacity(R(b.fillOpacity, 0.75)).get() : a.color, K = function () {
                    X ? (c.fillStyle = aa, c.fill()) : (c.strokeStyle = a.color, c.lineWidth = b.lineWidth, c.stroke())
                }, L = function (a, b, d) {
                    g === 0 && c.beginPath();
                    I ? c.moveTo(a, b) : A ? A(c, a, b, d, D) : B ? B(c, a, b) : C && C(c, a, b, z);
                    g += 1;
                    g === 1E3 && (K(), g = 0);
                    D = {clientX: a, plotY: b, yBottom: d}
                }, u = function (a, b, c) {
                    W && !x[a + "," + b] && (x[a + "," + b] = !0, d.inverted && (a = e.len - a, b = f.len - b), y.push({
                        clientX: a, plotX: a, plotY: b,
                        i: Y + c
                    }))
                };
            (this.points || this.graph) && this.destroyGraphics();
            a.plotGroup("group", "series", a.visible ? "visible" : "hidden", b.zIndex, d.seriesGroup);
            a.getAttribs();
            a.markerGroup = a.group;
            O(a, "destroy", function () {
                a.markerGroup = null
            });
            y = this.points = [];
            c = this.getContext();
            a.buildKDTree = M;
            if (n.length > 99999)d.options.loading = Q(i, {
                labelStyle: {
                    backgroundColor: "rgba(255,255,255,0.75)",
                    padding: "1em",
                    borderRadius: "0.5em"
                }, style: {backgroundColor: "none", opacity: 1}
            }), d.showLoading("Drawing..."), d.options.loading = i, d.loadingShown === !0 ? d.loadingShown = 1 : d.loadingShown += 1;
            h = 0;
            v(H ? a.data : j || n, function (b) {
                var d, c, g, i = !0;
                J ? (d = b[0], c = b[1]) : (d = b, c = k[h]);
                if (G)J && (c = b.slice(1, 3)), g = c[0], c = c[1]; else if (H)d = b.x, c = b.stackY, g = c - b.y;
                b = c === null;
                Z || (i = c >= T && c <= U);
                if (!b && d >= p && d <= S && i)if (d = Math.round(e.toPixels(d, !0)), V) {
                    if (m === void 0 || d === r) {
                        G || (g = c);
                        if (o === void 0 || c > t)t = c, o = h;
                        if (m === void 0 || g < s)s = g, m = h
                    }
                    d !== r && (m !== void 0 && (c = f.toPixels(t, !0), l = f.toPixels(s, !0), L(d, E ? Math.min(c, F) : c, E ? Math.max(l, F) : l), u(d, c, o), l !== c && u(d, l, m)), m = o = void 0, r =
                        d)
                } else c = Math.round(f.toPixels(c, !0)), L(d, c, l), u(d, c, h);
                I = b && !$;
                h += 1;
                h % w === 0 && a.canvasToSVG()
            }, function () {
                var b = d.loadingDiv, c = +d.loadingShown;
                K();
                a.canvasToSVG();
                P(a, "renderedCanvas");
                if (c === 1)q(b.style, {
                    transition: "opacity 250ms",
                    opacity: 0
                }), d.loadingShown = !1, setTimeout(function () {
                    b.parentNode && b.parentNode.removeChild(b);
                    d.loadingDiv = d.loadingSpan = null
                }, 250);
                if (c)d.loadingShown = c - 1;
                a.directTouch = !1;
                a.options.stickyTracking = !0;
                delete a.buildKDTree;
                a.buildKDTree()
            }, d.renderer.forExport ? Number.MAX_VALUE :
                void 0)
        }
    });
    h.scatter.prototype.cvsMarkerCircle = function (a, b, d, c) {
        a.moveTo(b, d);
        a.arc(b, d, c, 0, 2 * Math.PI, !1)
    };
    h.scatter.prototype.cvsMarkerSquare = function (a, b, d, c) {
        a.moveTo(b, d);
        a.rect(b - c, d - c, c * 2, c * 2)
    };
    h.scatter.prototype.fill = !0;
    q(h.area.prototype, {
        cvsDrawPoint: function (a, b, c, e, f) {
            f && b !== f.clientX && (a.moveTo(f.clientX, f.yBottom), a.lineTo(f.clientX, f.plotY), a.lineTo(b, c), a.lineTo(b, e))
        }, fill: !0, fillOpacity: !0, sampling: !0
    });
    q(h.column.prototype, {
        cvsDrawPoint: function (a, b, c, e) {
            a.rect(b - 1, c, 1, e - c)
        }, fill: !0,
        sampling: !0
    });
    j.prototype.getPoint = function (a) {
        var b = a;
        if (a && !(a instanceof this.pointClass))b = (new this.pointClass).init(this, this.options.data[a.i]), b.category = b.x, b.dist = a.dist, b.distX = a.distX, b.plotX = a.plotX, b.plotY = a.plotY;
        return b
    };
    g(j.prototype, "searchPoint", function (a) {
        return this.getPoint(a.apply(this, [].slice.call(arguments, 1)))
    })
});

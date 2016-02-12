<?php

include './view/header.php';
?>
<script type="text/javascript" src="./js/clickListener.js"></script>

<div class="menutopClick" id='menutop'>
    <h3>Menu ...</h3>
    <div id="swimbi">
        <ul>
            <li><a data-icon="f015" class="empty" href=""></a></li>
            <li><a data-icon="f193" href="#">Mitarbeiter</a>
                <ul>
                    <li><a class="menuItem" data-icon="f0c0" href="#" id="menuMitarbeiterAnzeige">Anzeigen</a></li>
                    <li><a class="menuItem" data-icon="f0a6" href="#" id="menuMitarbeiterNeuAnlegen">neu Anlegen</a></li>
                </ul>
            </li>
            <li><a data-icon="f02d" href="#">Abteilungen</a>
                <ul>
                    <li><a class="menuItem" data-icon="f0C9" href="#" id="menuAbteilungAnzeigen">Anzeigen</a></li>
                    <li><a class="menuItem" data-icon="f0A6" href="#" id="menuAbteilungNeuAnlegen">neu Anlegen</a></li>
                </ul>
            </li>
            <li><a data-icon="f1b9" href="#">Fuhrpark</a>
                <ul>
                    <li><a href="#">Hersteller</a>
                        <ul>
                            <li><a class="menuItem" href="#" id="menuHerstellerAnzeigen">Anzeigen</a></li>
                            <li><a class="menuItem" href="#" id="menuHerstellerNeuAnlegen">neu Anlegen</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Autos</a>
                        <ul>
                            <li><a class="menuItem" href="#" id="menuAutosAnzeigen">Anzeigen</a></li>
                            <li><a class="menuItem" href="#" id="menuAutoNeuAnlegen">neu Anlegen</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Ausleihen</a>
                        <ul>
                            <li><a class="menuItem" href="#" id="menuAusleihe">Anzeigen</a></li>
                            <li><a class="menuItem" href="#" id="menuAusleiheNeuAnlegen">neu Anlegen</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a data-icon="f03A" href="#">Projekte</a>
                <ul>
                    <li><a class="menuItem" href="#" id="menuProjekteAnzeigen">Anzeigen</a></li>
                    <li><a class="menuItem" href="#" id="menuProjektNeuAnlegen">neu Anlegen</a></li>
                </ul>
            </li>
            <li><a data-icon="f03c" href="#">Projekt Mitarbeiter</a>
                <ul>
                    <li><a class="menuItem" href="#" id="menuProjektMitarbeiterAnzeigen">Anzeigen</a></li>
                    <li><a class="menuItem" href="#" id="menuProjektMitarbeiterNeuAnlegen">neu Anlegen</a></li>
                </ul>
            </li>
            <li><a data-icon="f1fe" href="#">Views</a>
                <ul>
                    <li><a class="menuItem" href="#" id="menuMitarbeiterAbteilungVorgesetzter">Mitarbeiter mit Abteilung und Vorgesetzten</a></li>
                    <li><a class="menuItem" href="#" id="menuAusleiherAutoListe">Die Ausleihenliste der Autos mit Zeiten</a></li>
                    <li><a class="menuItem" href="#" id="menuAbteilungAusleihenListe">Die Ausleihenliste der Projekte mit Zeiten</a></li>
                    <li><a class="menuItem" href="#" id="menuMitarbeiterZeiteZuProjekt">Zeit der Mitarbeiter im Projekt</a></li>
                    <li><a class="menuItem" href="#" id="menuProjektKosten">Kosten der Projekte Anzeigen</a></li>
                </ul>
            </li>
            <li><a data-icon="f003" href="#">Kontakt</a></li>
        </ul>
    </div>
</div>

<div id='menuleft'>
    <div id='cssmenu'>
        <ul>
            <li class='active'><a href='' id="menuHome"><span>Home</span></a></li>
            <li class='has-sub'><a href='#' id="menuMitarbeiter"><span>Mitarbeiter</span></a>
                <ul>
                    <li><a class="menuItem" view="Mitarbeiter" href='#' id="menuMitarbeiterAnzeige"><span>Anzeigen</span></a></li>
                    <li class='last'><a class="menuItem" id="menuMitarbeiterNeuAnlegen" href='#'><span>neu Anlegen</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="menuAbteilungen"><span>Abteilungen</span></a>
                <ul>
                    <li><a class="menuItem" href='#' id="menuAbteilungAnzeigen"><span>Anzeigen</span></a></li>
                    <li class='last'><a class="menuItem" href='#' id="menuAbteilungNeuAnlegen"><span>neu Anlegen</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="menuFuhrpark"><span>Fuhrpark</span></a>
                <ul>
                    <li><a class="menuItem" href='#' id="menuHerstellerAnzeigen"><span>Hersteller Anzeigen</span></a></li>
                    <li><a class="menuItem" href='#' id="menuAutosAnzeigen"><span>Autos Anzeigen</span></a></li>
                    <li><a class="menuItem" href='#' id="menuAusleihe"><span>Ausleihen anzeigen</span></a></li>
                    <li><a class="menuItem" href='#' id="menuHerstellerNeuAnlegen"><span>Hersteller neu Anlegen</span></a></li>
                    <li><a class="menuItem" href='#' id="menuAutoNeuAnlegen"><span>Auto neu Anlegen</span></a></li>
                    <li class='last'><a class="menuItem" href='#' id="menuAusleiheNeuAnlegen"><span>Ausleihe neu Anlegen</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="menuProjekte"><span>Projekte</span></a>
                <ul>
                    <li><a class="menuItem" href='#' id="menuProjekteAnzeigen"><span>Anzeigen</span></a></li>
                    <li class='last'><a class="menuItem" href='#' id="menuProjektNeuAnlegen"><span>neu Anlegen</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="menuMitarbeiterToProjekt"><span>Projekt Mitarbeiter</span></a>
                <ul>
                    <li><a class="menuItem" href='#' id="menuProjektMitarbeiterAnzeigen"><span>Anzeigen</span></a></li>
                    <li class='last'><a class="menuItem" href='#' id="menuProjektMitarbeiterNeuAnlegen"><span>neu Anlegen</span></a></li>
                </ul>
            </li>
            <li class='has-sub'><a href='#' id="menuViews"><span>Views (workingname so dont cry)</span></a>
                <ul>
                    <li><a class="menuItem" href='#' id="menuMitarbeiterAbteilungVorgesetzter"><span>Mitarbeiter mit Abteilung und Vorgesetzten</span></a></li>
                    <li><a class="menuItem" href='#' id="menuAusleiherAutoListe"><span>Die Ausleihenliste der Autos mit Zeiten</span></a></li>
                    <li><a class="menuItem" href='#' id="menuAbteilungAusleihenListe"><span>Die Ausleihenliste der Projekte mit Zeiten</span></a></li>
                    <li><a class="menuItem" href='#' id="menuMitarbeiterZeiteZuProjekt"><span>Zeit der Mitarbeiter im Projekt</span></a></li>
                    <li class='last'><a class="menuItem" href='#' id="menuProjektKosten"><span>Kosten der Projekte Anzeigen</span></a></li>
                </ul>
            </li>


            <li class='last'><a href='#' id="menuKontakt"><span>Kontakt</span></a></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
//#swimbi 1.9.4w
    var u = !1; (function(r, W, G, w, e, L, X, ea, oa, g, x, S, C, y, M, b, T, pa, qa, ra, sa, fa, xa, H, N, O, P){function ga(a){z = A + r; return String.fromCharCode(a) + x}function Y(a){z = A + r; return W.createElement(a)}function Q(a){D.width = a.offsetWidth; D.height = a.offsetHeight}function ha(a, h){for (var c; a < Z.length; a++)c = Z[a], c.w.offsetWidth != c.C && (c.C = c.w.offsetWidth, h = 1); h && !$ && ($ = !n(k, C).offsetWidth); c = G.innerWidth != U; $ && (F = u, h = 0, c && n(k, C).offsetWidth && G.location.reload(u), ta()); if (c || F || h)U = G.innerWidth, ia(R, b.m, b.k, b.l, 0, 0), F && (F = u); setTimeout(function(){ha(0, 0)}, 100)}function ta(){var a = k.getElementsByClassName("swsearch")[0]; if (a){var b = a.parentNode; a.id = "swmobsearch"; R.appendChild(a); k.removeChild(b)}}function ja(a){y.src = b.H + "," + a.b; y.onload = function(){D.width = D.width; a.s = y.width; a.r = y.height; t.drawImage(y, e, e, a.s, a.r); ka = t.getImageData(e, e, a.s, a.r); a.J = ka; a.a[g] && (a.A = a.a[g]); var b = a.a[s]; b && (b == r && (a.L = r), b == A && (a.M = r), b == g && (a.K = r)); a.K && (a.d.src = y.src); a.e = a.a[e]; a.f = a.a[r]; a.z = a.a[A]; a.g = a.a[z]; a.j = e; a.B = e; a.q = e; a.v = e; a.a[s + r] && (a.j = a.a[s + r]); a.a[s + A] && (a.B = a.a[s + A]); a.a[s + z] && (a.q = a.a[s + z]); a.a[s + g] && (a.v = a.a[s + g]); a.A && (a.d = new Image, a.d.src = y.src); T.length > e?ja(T.pop()):ha()}}function V(a){function b(c, f){for (var h = e; h < g; h++)s[c + h] = x[f + h], h == z && (s[c + h] = a.alpha * x[f + h] | e)}function c(a, c){for (var d = e; d < a; d += g)b(v + d, c?f:f + d); v += n}function d(a, c){for (var d = e; d < a; d += g)b(v + d, c?f:f + d), y.I(f, v + d, c?f:f + d); v += n + k}function la(b, c, f){for (var d = e; d < g; d++)s[c + d] = (x[f + d] + x[q + f + d]) / A | e, d == z && (s[c + d] = a.alpha * s[c + d] | e); --b; b > e && la(b, n + c, f)}if (!(a.b < e)){var E = D.width - a.j - a.B, l = D.height - a.q - a.v, m = a.s, p = a.r; if (a.A)t.globalAlpha = a.alpha, t.drawImage(a.d, a.j, a.q, E, l), t.globalAlpha = 1;  else if (0 != E){var ma = t.createImageData(E, l), q = m * g, n = E * g, k = e, B = a.z + a.g, w = (l - B - (p - B) + r) / (p - B), s = ma.data, x = a.J.data, B = a.z * q, C = (p - a.g) * q, v = e, f; for (f = e; f < B; f += q)c(a.e * g, u); var y = new function(){var a, b, c; return{I:function(d, f, h){b < d && (a += w, a > r?(c = a | e, k = n * c, a %= r):c = k = e); b = d; c > e && la(c, n + f, h)}, t:function(){a = b = c = e}}}; y.t(); for (f = B; f < C; f += q)d(a.e * g, u); var v = (l - a.g) * n, F = (p - a.g) * q; for (f = F; f < p * q; f += q)c(a.e * g, u); v = (E - a.f) * g; for (f = m = (m - a.f) * g; f < B; f += q)c(a.f * g, u); y.t(); for (f = m + B; f < m + C; f += q)d(a.f * g, u); v = (l - a.g) * n + (E - a.f) * g; for (f = F + m; f < p * q; f += q)c(a.f * g, u); v = a.e * g; E = (E - a.e - a.f) * g; for (f = v; f < B; f += q)c(E, !0); B = a.e * g + C; for (y.t(); f < B; f += q)d(E, !0); v = a.e * g + (l - a.g) * n; for (f = B; f < p * q; f += q)c(E, !0); t.putImageData(ma, a.j, a.q)}}}function na(a, h){if (a && a.parentNode.getAttribute(P) !== O){var c = I(a) + a.offsetWidth; if (0 == h && a.getAttribute(P) == O + "s" && !b.u){var d = I(k) + k.offsetWidth; if (k.offsetWidth >= a.offsetWidth){if (c > d)var e = c - d} else I(k) < I(a) && (e = I(a) - (I(k) - (a.offsetWidth - k.offsetWidth) / 2 | 0)); J(a, "left:-" + e + H)} else c > U && (0 == h?J(a, "left:-" + (c - U + 10) + H):J(a, "left:" + - (a.offsetWidth - a.parentNode.offsetWidth + 30) + H + "; margin-top:" + n(a, C).offsetHeight + H))}}function ua(a, h, c, d){function e(){var a = parseInt(p.style.top); 0 != a && (0 < a && a--, 0 > a && a++, p.style.top = a + H, setTimeout(function(){e()}, 20))}function g(){clearInterval(l); l = null; m.setAttribute(b.c, "background:none;"); Q(m); K(m)}var l, m = n(a, C), p; a.onmouseover = function(){if (!l && a.offsetHeight === m.offsetHeight && (Q(m), V(h), c || aa(b.i, 1), K(m), c && "number" !== typeof swAnim && a.getAttribute(P) !== O)){var g = !0; ba && ba.offsetTop < a.offsetTop && (g = u); ba = a; if (p = n(a, S))p.style.top = (g?8: - 8) + H, e()}clearInterval(l); l = null; g = n(a, S); na(g, d); !g && h.M && m.setAttribute(b.c, "background:none;")}; a.onmouseout = function(){l = setInterval(g, 10)}}function ia(a, h, c, d, e, g){var l = n(a, S); if (l){if (e){var m = g++; J(l, ra); na(l, m)}for (var p; p = p?ca(p.nextSibling):ca(l.firstChild); )if (m = n(p, C)){var k = m, q = k.getAttribute("data-icon"); q && k.setAttribute("data-icn", ga("0x" + q)); p.removeAttribute(b.c); Q(m); c.L && n(l, sa) == p || l.getAttribute(P) === O + "s" || V(c); if (e)K(m);  else if (b.u){var k = p, q = h, s = !e; Q(k); k.removeAttribute(b.c); V(q); s && aa(b.h); K(k)}K(p); J(p, "width:" + m.offsetWidth + "px"); ua(p, d, e, g); ia(p, b.p, b.n, b.o, r, g)}if ((!b.u || e) && a.getAttribute(P) !== O)a = !e, Q(l), l.removeAttribute(b.c), V(h), a && aa(b.h), K(l); e && (h = l.getAttribute(b.c).replace(/display\s*:\s*block\s*;/, x), l.setAttribute(b.c, h))}!e && "function" === typeof swdoneCB && swdoneCB(ea)}function I(a){for (var b = 0; a; )b += a.offsetLeft, a = a.offsetParent; return b}function aa(a, b){if (a.d.src){var c = t.createPattern(a.d, "repeat"), d = a.a; t.rect(d[e], d[A], D.width - d[e] - d[r], D.height - d[A] - d[z]); t.fillStyle = c; b && (t.globalCompositeOperation = "source-atop"); t.globalAlpha = a.alpha; t.fill(); t.globalAlpha = 1}}function J(a, e){var c = a.getAttribute(b.c); a.setAttribute(b.c, (c?c + ";":x) + e)}function K(a){J(a, b.G + pa + D.toDataURL() + qa)}function n(a, b){g = A + A; return a.getElementsByTagName(b)[e]}function ca(a){if (a)return!a.tagName?ca(a.nextSibling):a}function va(){ja(T.pop())}var ka, A = r + r, z = g - r, wa = L.slice( - r), s = A + z; b.m = {}; b.k = {}; b.l = {}; b.m.b = 924; b.m.alpha = 1; b.m.a = [5, 5, 4, 4]; b.k.b = 980; b.k.alpha = 1; b.k.a = [10, 0, 4, 5, 0, 1]; b.l.b = 2984; b.l.alpha = .85; b.l.a = [0, 0, 0, 0, 1, 0, 9, 0, 2, 3]; b.D = 5; b.c = 2; b.H = 18; b.G = 11; b.N = 4; b.F = 1030; b.h = {}; b.p = {}; b.n = {}; b.o = {}; b.i = {}; b.h.b = - 3; b.h.alpha = .40; b.h.a = [4, 4, 2, 3, 0, 4]; b.h.d = new Image; b.p.b = 104; b.p.alpha = .92; b.p.a = [2, 2, 2, 3]; b.n.b = 68; b.n.alpha = .92; b.n.a = [0, 0, 0, 0, 0, 1]; b.o.b = 68; b.o.alpha = .83; b.o.a = [0, 0, 1, 1, 0, 0, 0, 0, 1, 0]; b.i.b = 1740; b.i.alpha = .82; b.i.a = [9, 0, 2, 3, 0, 4]; b.i.d = new Image; b.u = 0; var da = "AsAAAAcCAYAAAC3f0UFAAACj0lEQVQ4T42UvUtyYRjGrwcaWhocWtSyj0FRo0IpmvoDamgJcTEkKogGoagwUGqIdFBpKPrAwakUi7SlraGlIaEPkhqCCopoaDAQ/Dqv9y3n4c3eeDvT0fM7F7/nvm6OODs7U1B3CSHq/+LfYnd3l2G9Xo/qPR4fHyXY0tKCyclJPD8/1+CtrS3FYDBgZ2cHJpMJQ0NDyOfzaGxsxPHxMe7u7viFh4cHiI2NDYUSVlZWEIlE8PHxIZM1Gg08Hg/8fj+enp4gwuGw0tbWhtXVVcRiMWSzWVQqFX7BbDZjbGwMS0tLteS1tTWls7MTwWAQ0WgUNzc3MtlisWB8fBwLCwusI5aXl5WOjg6sr69je3sbV1dXMrm7uxtTU1OYnp6uaXi9XqW9vZ3Bzc1NZDIZqKOz2WwMu91unoiYnZ1lZ/INhUK4vLz8kjw3N4fR0VG8vLxAzMzMMLy/v8+HvL6+ls6ksbi4iOHhYby/v0NMTEzwnI+OjuDz+fiA6jQIrp4Jg4ODPFLhcrmU1tZWnJycYH5+Hre3t1+mEQgEQO65XA7C4XAwfHp6ym71pSQSCdC0uO6BgQGGaej9/f14e3tDuVzmh1qtFufn56AmOblaNcOFQgF9fX3Y29uTGk6nk+GGhobanP+G7XY74vG4hEnr4uLi3zAdhBzV6xtc3WMeHWn09vYimUxKeGRkhOuXGgSTc7FYRE9PDw4ODn4HUwmHh4c/wzqdjjUouauri5tUL6qZSiIN3meCSaNUKsFqtSKVSv0OpmVPp9M/w9WWWIOS1dpVmhaI9lhqqPDr6yuamppgNBrl1t3f33PNVDs7E0xJlE4L/vn5KTXoc6DujVwk+fQ/N6K5ufnb50td/vp3/wC8IW/B0R6s3QAAAABJRU5ErkJggg==AsAAAAgCAYAAADEx4LTAAACuklEQVQ4T7WUMUhyURiG35sNLQ0NDkVl6WCQYVlk4eAgtNggVLOEaOAgDZFCVKQgFBGhqJXV0CBYEAQh1KLRIA5RREg1BBUY0dBQkwrnv98pPfwU0T/8Z7j3Ds9573u+7/2OhH9YktFoZC0tLXC5XHh8fORbJUni7+bmZmxubuL+/h65XE6SstksOzw8xM3NDd9wd3cHhUIBlUqFeDyOjo4OWK1WDAwMfEjQhsnJSczPz+Ph4YGr0t/8fj9WV1cxODjIOf64vr5mdrsdMzMzXJlstLW1IRgMYmdnB1qtVsBXV1fM4XDA6/VyO2RDo9FgaWkJ29vb6OzsFPDFxQWbmJiA2+2u2lCr1QiFQtjY2IBer/8Kj4+P84qQjfb2dg7GYjEYDAYBn56esqmpKYyNjaFQKHAb5Jn8rqyswGQyCfjk5IRNT0/DZrPh+fm5esBEIsF9m81mAafTaebz+TA8PIyXlxdeOlJOJpO8IhaLRcCpVIotLCyQAl5fX1FTU8ObcnBwgLm5OWqKgPf399ni4iJ6e3vx9vbGPbe2tuLo6Ahkb2RkRMDLy8tsb28PVK7KIjiTyfBDy4cX8OzsLDs+PkZjYyOKxSLnCT4/P8fQ0BACgYCAPR4Pk1OFhoYGbqMCU+vlVFJzvsK1tbW8g3RAUqa/9Pf3IxwOC1huMzs7O8N3cF9fHyKRyO9gqlA0GhWwHCImh6mqTNmgOpMNOReUDwE7nU52eXn5LdzT04O1tbWfYTpgqVRCd3c31tfXfwfLWaaoCljOMcvn89wG1Zbe5JmUu7q6aMJ/hslGuVyGTqfD1tbWf4DlYaWhFcqjo6OMZq/iuXLJkA2yIyfyAybw9vaWB6ipqemvG+np6Qn19fV0b2B3d1eSlEolq6ur4wpUCVqkTIsqQgP8/v5O4/Z5A1Yj//PHx3X5y/UH6WR8MFIe4wcAAAAASUVORK5CYII=DYAAAAWCAYAAACL6W/rAAAImklEQVRYR92X24olSRWGV0Qe96m6qumyGRCRQRDGS68avRAvBC+87FfwOXwNfQTnHbwS5wkURRlExLGspqum9inP6fev3LlnW7bzAO4mOvIQmbm++P+1IirY/+kvwBV+QRPfJ2+n/u29hV9tLfywspB/y8L9o8Vvv7IQawuPe4u3VxwXFndHiy+WFjaVxbvewjq1uCotvOPZVcG7uLbIp3c+/x0bGy2xcV/b+GpDX9m462x4zbVtacOXBxvXCxuG2ob7JxuvVxwXNv71nY231zY0f7Pxt6WNP+fZT295F78/fDr18IxnMEEJyAfcWxTQd44WPgPm443F/wLKLR5qi4I5tgDRV7QFMAQcy8HCl7Qy+zBY1dr4ItpY0ZiA4QhQCdietshsEOSyALCx4Tng51sb3gD5l4WNAvzk1gbFLUDBORj/xUulLqG+AOij0uL7ncWzQieg12tLmPVYgbEQCHA1xwUgTWeRT4Um0vPLOb5UjOs+s1wfGDHmqQ01oAWIFVBHQEuOUXu421n/HPDl2oYvKhs+AvAS7lK5M5jU+jqohKBluT19jJY4kFkS6JsGIOCINcnpmfW40nli4dBYyOgvwdrexmXuSo17IFB7aOgZ09f0eW79yN0j5wIcButX9LJor3Ps+XVwUi38+q0lc079+BsWZb9LpV4S3pYm20klgkkFVdcAjpZuCmWKpS1QbWfJMrOk6y2mqFWNFtIwqZZyrL4Lk1rdiCocd6iWJjYcWuuzlAYMI7ttDQB9UUxwfKWb1dsA+p72HO43/7JhzjkHe/jcogoFXo0fgoqAHI+WJKWlrhIgavqHnTKBdVz3nrEpxz1giQBRqz5BzaoVAkKtHqAEMJ7tAXcgnvUeu7bWwc+xmtTrK+sWC4AZ+yE4HDeooNx8bEMYf2TpbEFVvzfftEQ5NSslqDhMKt3Qb3vLQgYYPbbLHDBOcGrI4pBSCttELKyMCkmcFOsHnQGFYtwbpJxgkLETkLfBWsFgz3ZMaCBu6B+idW5N+udwn/3d+rlaqpiEX37fslmtu9wSVb/Xt6gjIGwnqEBj1lNZj1zKAi0LlleoRVCkOD1wPVAOGGmDvyP2/wMsAUhwjFV2OVACHNakDBmutqakb0drRgDJvdatKQUFpoY9lXN399ZrOXjdWD+rFn7/PctV2kngRBXw4cGSfWJJRoB8PJX9YmfZIkUVgpf1sEUuMFTJeTGFl3sCVB8sowoQI88KjNBdtYufq0XddDBguIkxAQo0gNTzTI2ajcCwf+PWBPrYAZhaK1syaV1LW/XW39xYr0pJ4eq1BDiYcktqUb0SWZAXpLagoRhzmcl+JHEuKD5WCEg9ChUoVggqSSbAljEElTG7xG4JlqGI0k5WpMKN0AxYnEPrcUEPYJspcID63mrBoVjN7NR8ywHVC46i1ciWRNaqoNiRhnoqJlTbflYt/PmnVsy5JbXSDQrJgi2WQ6WSRjnP82i5lGL2CkGFaKSplXy8ILCS8wIAAUu5yY6TfWOk9A8qCfw4HjkeANfqpnxyGxJ4A2gDdc3EVEwaWwOrOK8ExbdrV26whuWgqVBulHoZDcBua51Um3NNxaNUJSw6S2e13qHSOpvA8HS+by1fZRMQgQjCofjwAkXUl1iXzYYVtBwYt6TsiDIRabRUT2sZiqHewHNuQ1kQyJZJQRCrsRabK6t4Tj2LzwTH8w5ILDWxNOR8I7Bda+0rqXdSrcZjWrgdTDbEZulztVqANrkV+NxtRzKzRE5A5M6CSNkpYlqjCZD7BFwQ1KSaionyDThgHQyIkX++GDsYavFMwzMsuwAIyAACikp5wM9+LDCKVSV7kt/1tqEH8LlqzE4nO4bfvbGFSvwjrmXdSTcoVVWWSy0BrU/WQ62SFy4chMYHlgS0YvaXKLKc4TiXarKlK8ZspwLjeN59OBiqk0ZAmatV8w63nqB4x4HzA7BsTIzt8ARHPEdUc+V2J0CBlaU1W5RjXeyuM+tkx/CPn9ny6b0l37229I68usqxIDM+qyWFKFuuFNeXAC0oXUuSfSUwhzMa9wiqVGM7VOgdJ8VSrWeXYFq/XC1tQFCLsSoYgqp434Gbe0GpUYz2zNABwCNjD27JkzXPqvGOp8ba1+Tbnx6tu3oJ2D9/YitVw6y0TEVjRUDsqPMXJwuyhrn1+LirxAeWLAMOxPW1GjZbEczSrQkYY1UpVVTcjlxX+T8rhsXchgAKriZgB5P1mIEDdt2j0E7NVaPxAsEdGDvZFEBZklhrYm32wKmItBVrH9XRwTy/FpadbUgFZEehYlFSxUq2O8sLMNhtDdia7dKaXNtwvuL+ig/6OFVJgs4ZMxcQdk6nqsifFNo1CIygW8Y2qoIecPDAiRGQaFu2XQLbcb4DzG2pcWzbDlRWWbJih1Jj92a2I3uvVnkWxre2Vn5d15Z5NVxhw8oKFQ3PJxRjOpdM/ZLAV+QGa/ykFMFt5iY4jgWm3HPFaALLvDJS6VU8+G+uiFqM1WoVDreZAgeAfntuUi4ChyX5JuuvHXixW1LKuR1Lcm5vjarjY2Gt8szBGJbN+bUgqIagVDioAF4oBOUWVF7NUChFkl9dwK2Z/bMdCbZwxbSWsehroXYwLcwspqqGUozrZxuinOCoCxMY4554auuWBA53uCUFJ6h6sKPsSDLXR/o5z5CgDX/8gW3OhSOxXFDKr7loOBQBK6+AcxsSlCtFbl2hxBXXZMe17hOc59mpMnrZ1xYLiKncUxN9C6Uyf1q7lF984yC7yXY0/lKyJ3LtySFH257tqHxjAgQ3FxHlmeCeemvmAuJgq7VlN4Vlc+Hg745yTW6x/HvRIMeUPyspxofcggLi2hUBX2GjK8Yp76bqyILt69pXC/V/FA+e/2pveFqQVQ1VKHjXjnc9cf7Ee54EeFLQFXM7TuOObHuOO3Kt76yaC8hDbe1+Z+2/AfqxfPwrcUosAAAAAElFTkSuQmCCGvodujpotuzmfebub;jnbhf0qoh<cbtf75cbdlhspvoe;vsmdRtwkLcwbs!ovtus>(=dbowbt?=b!isfg>#iuuq;00txjncj/dpn#?iunm!cvjmefs!cz!wjsuvf!pg!nfov=0b?!wjtju!txjncj/dpn=0dbowbt?(<b\\5^)*-xjoepx/beeFwfouMjtufofs)#mpbe#-gvodujpo)*|wbs!f-j-u>epdvnfou-s>xjoepx-o>s/mpdbujpo-m>o/iptuobnf-p>gvodujpo)f*|sfuvso!f/tqmju)#@#*\\1^/tqmju)#$#*\\1^/sfqmbdf)0)joefy}efgbvmu*]/\\]T^+%0j-##*~-t>gvodujpo)f*|wbs!j>f''s/hfuDpnqvufeTuzmf''s/hfuDpnqvufeTuzmf)f*<sfuvso!j'')#opof#>>>j/ejtqmbz}}#ijeefo#>>>j/wjtjcjmjuz}}ovmm>>>f/pggtfuQbsfou*~-g>u/hfuFmfnfouCzJe)#tx.mjol#*-n>1<jg)m>m'')m/tqmju)#/#*/sfwfstf)*\\2^}}m*-_0gjmf;}bqq;0/uftu)o/qspupdpm**|gps)j>b\\3^/hfuFmfnfoutCzUbhObnf)#mj#*<t)j\\n^*<*n,,<jg)p)b\\2^)j\\n^-#b#*/isfg*>>>p)o/isfg**|jg)f>m''b\\4^''b\\4^/joefyPg)m*?>1-f}}m/nbudi)0txjncj}tncj}mpdbmiptu0**<fmtf|wbs!d>g''g/isfg''g/opefObnf/nbudi)0b0j*''g/isfg/nbudi)0]0]0)@;xxx]/*@txjncj/dpn0*''_g/sfm-e>g''g/joofsIUNM/nbudi)0]T,]t]T,0*<d''_t)g*''e}})j\\n^/joofsIUNM>#=b!isfg>00txjncj/dpn0sfh?=j?sfhjtufs=0j?=0b?#-j\\n,2^'')j\\n,2^/joofsIUNM>#=b?=0b?#**~u/sfgfssfs/nbudi)0ufyt/dg0*''u/rvfszTfmfdups)#b\\isfg+>txjncj^#*/dmjdl)*~~~*<AoAAAAKCAYAAACNMs+9AAAAKUlEQVQYV2MUFhb+7+3tzYAPbN26lYERphDEwQZAhowqJC4c8aqCSgIAUuk8O8/pM68AAAAASUVORK5CYII=AEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2OMi4v7DwAEVwIbQ66lxwAAAABJRU5ErkJggg==AEAAAADCAYAAABS3WWCAAAAD0lEQVQIW2N0cnL6zwgnACSrBVOlo6JGAAAAAElFTkSuQmCCDwAAAA8CAYAAAA6/NlyAAAE9ElEQVRoQ+VbW3LjMAyrD9keIYfqEdpDdkONoYEZvmTJ7s40P5s0tiUQIEhJ2e3tF14/Pz+P7+/vt4+Pj8+7h9/uHvDr6+uBMf8M4CfQtyfwhlveP1+3MX0rwyJlAShyfn9/b6Dx+S7QdwF+MKMC9rdAXw1Y8vUTeStsCli8BLQEQv52F9NXAW5ABRgcWcBZLwZNzt3vX22qqwF3RsEk56w3eZa3XHMl8JWAW54y0BF2oACYmQI+8qjw2lWAH0/p9jIDxs7OUjO+bduysrUCcGf2ObGGkY3JAg2XzgLC+b0K9ArAzZgquYpgALBnZBwIuUbUs+f1dJMyC/ilvkasCVDNbgaa5b2C5VnAnd1Mnmg8LIAZaChj772nStYM4M5uNuEIrJavFzjD/U8Z2RnAh1q7N/8uwVWwKENZSsj3M6usEcAHoMJqxKzuoDLJ4/tMLboCjIKvAu6lJwMKptBARC0lQGoQGWjcB/WMmFkF8KGpqDDFzqonrz9bNbsK+EydzgB3ZrNc1ZJE9HWALDBnGYaa0NLujU9oZhngctnRpmMB9pjj9XHFvKwgSnNSkXYIGOvYTGIeawKav8ueA6az6yzAVZZTwNngvFDQEx6VKndheqOg4h0COmPZA9xLUOSyaBXRCeFab3GA7zlIGki08KiUwb1Ouz23y3BlQaAl67GgA8GfLcCZk+utIn5GtjFoAS4tCEbAAgDusT5nS0qoiPe/rJTJ9sg04BRstYOyzIpzPMv3ak89CvoAmI5A2njWw0Y6KO6k0KFZZlRhlwNgbSPp54JpGZfbzwZYyg9LxQLL7VylXeRGRE9G192KA1sObrW5+joKTmtItoxVZilz30pXxc+zmoyIbT0+PCHrArmabHy4ZclOS8kCnZULVoxXkqJSZSnAkrV1ne74eg5rWVuR9gwra05Y3hZ4TzlV4/ICQgro/TWbVstjloknL8vMsjzUtXjWpa385XRRcjcBy/Xt7JZ3CTPQFXZ1owH5wijBeoVpXOONC9K8syqz8dA3rQDNCvA6Lc26VYrkb5FJZVu6bi+tjzezfLK+z/pwy7Ejl2YZW2qAG0eH7NHioUl7ZIPdYjHLba9M6drNwfM8RLWu5kZAtDw8HKFEkbfqL6JdyXEGnZmRp6QKu3JvCLiayysBWzmayVzu2VdJ6V51tsUzfFAmg7MLjzKM+6upYDj+3J6WlCrlfG0uWdTPShoMZynETp+tgTl4GcO49uX81ysZswxH7a02Ls7b/btpSTOuwwn/vuwKlTdyzMI12OqrmVFWD9XkFGxmWhpM68IwGN5TR/MCnq/VuazrKHdQUdnBIMrNS2BHAXd54w03Jx7VEWjtBWDLAqzKDoYrA8UN1Ry28LTFBvfDFdDswlrGCIDl7JWmouLsU4BlAL0xFw3KbDvSdG//HwDL5PqSEj9oyaKMZqZiekHqDEt5haR7TldymQOBupkFBxLfTxRO5y2PMyPpg4lZzUkFUJYCI01FZbwVgA/Slg9RqapMCrku/+5nRVM/ZFnN8IFpnixqZbWfxl6yCtrpfLWCu4phfvahQUFDEe1SwMgMdSwFK8+/AvAL49H+ceDay8FeDbgD90Dp9fZ+wyVAV5alig/1es2Glm24VR48es2VktZzOZxMqtp9KatXuXQp2HLCgeXf6I/KSgMkF93JcJ/Kn/qfaYIaB3i/wfA/R72QQRo5FYUAAAAASUVORK5CYII="; (function(){for (var a in b){var h; var c = b[a].b || b[a], d = (c ^ c >> 31) - (c >> 31); c < e?h = x:(c = da.slice(e, d + z), da = da.substr(d + z), h = c); if (b[a].b){if (b[a].b > e){d = oa + h; c = d.length % g; for (c > e && (c = g - c); c-- > e; )d += wa; b[a].b = d; T.push(b[a])}} else if (h){var d = b, c = a, k = x, n = e, l = h.length, m = x; do m = h.charCodeAt(n++) - (g - z) * r, 94 == m && (m = 33), k += ga(m); while (n < l); d[c] = k} else 0 > b[a] && (b[a] = x)}})(); var U = 0, ba, R = W.getElementById(ea); if (R){var k = n(R, S); L = k.childNodes; var Z = []; for (M = 0; M < L.length; M++)(fa = L[M].offsetWidth) && Z.push({w:L[M], C:fa}); var D = Y(w), $ = !n(k, C).offsetWidth, F = u; if (D.getContext){var t = D.getContext(X); X = [Y, n, R, b.N, va]; (new G[b.D](C, b.F))(X)}}})(1, document, window, "canvas", 0, "(){}.,;=", "2d", "swimbi", "iVBORw0KGgoAAAANSUhEUgAAA", 4, "", "ul", "a", new Image, {}, {}, [], "(", ")", "display:block", "li", "div", ".", "px", "google", "column", "class");
    (function(d, e, h){function g(){var b, c = 0, a = document.querySelectorAll(".hvr"), f = a.length; if (0 != f)for (; c < f; c++)b = a[c], b.nodeName.toLowerCase() != d && (b.getElementsByTagName("a")[0].href = b.a, b.a = !1, b.classList.remove(e))}function l(b){b.target.nodeName.toLowerCase() == d && b.preventDefault()}function k(b, c){document.addEventListener && document.addEventListener(b, c)}k("touchstart", function(b){var c = b.target, a; a:{for (a = c.parentNode; null != a; ){if (a == h){a = !0; break a}a = a.parentNode}a = !1}if (a){a = c.parentNode; var f = !!a.getElementsByTagName(d)[0]; c.nodeName.toLowerCase() == d?(b.preventDefault(), c.classList.add(e)):f?(a.a?c.href = a.a:(a.a = c.href, c.href = "javascript:void(0);", g()), a.classList.add(e)):g()} else h.getElementsByTagName(d)[0].classList.remove(e), g()}); navigator.userAgent.match(/(iPod|iPhone|iPad)/) && navigator.userAgent.match(/AppleWebKit/) && k("touchend", l)})("ul", "hvr", document.getElementById("swimbi"));
</script>



<div id="content">
</div>
<?php

include './view/footer.php';
?>
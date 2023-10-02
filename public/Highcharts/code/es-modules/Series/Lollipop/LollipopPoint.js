/* *
 *
 *  (c) 2010-2021 Torstein Honsi
 *
 *  License: www.highcharts.com/license
 *
 *  !!!!!!! SOURCE GETS TRANSPILED BY TYPESCRIPT. EDIT TS FILE ONLY. !!!!!!!
 *
 * */
'use strict';
var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        if (typeof b !== "function" && b !== null)
            throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
import SeriesRegistry from '../../Core/Series/SeriesRegistry.js';
var pointProto = SeriesRegistry.series.prototype.pointClass.prototype, _a = SeriesRegistry.seriesTypes, areaProto = _a.area.prototype, DumbbellPoint = _a.dumbbell.prototype.pointClass;
import U from '../../Core/Utilities.js';
var isObject = U.isObject, extend = U.extend;
/* *
 *
 *  Class
 *
 * */
var LollipopPoint = /** @class */ (function (_super) {
    __extends(LollipopPoint, _super);
    function LollipopPoint() {
        /* *
         *
         *  Properties
         *
         * */
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.options = void 0;
        _this.series = void 0;
        return _this;
    }
    /* *
     *
     *  Functions
     *
     * */
    LollipopPoint.prototype.init = function (_series, options, _x) {
        if (isObject(options) && 'low' in options) {
            options.y = options.low;
            delete options.low;
        }
        return pointProto.init.apply(this, arguments);
    };
    return LollipopPoint;
}(DumbbellPoint));
extend(LollipopPoint.prototype, {
    pointSetState: areaProto.pointClass.prototype.setState,
    // Does not work with the inherited `isvalid`
    isValid: pointProto.isValid
});
/* *
 *
 *  Default Export
 *
 * */
export default LollipopPoint;

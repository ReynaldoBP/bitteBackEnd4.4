(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["dashboard-dashboard-module"],{

/***/ "./src/app/_pipes/PipeRedSocial.ts":
/*!*****************************************!*\
  !*** ./src/app/_pipes/PipeRedSocial.ts ***!
  \*****************************************/
/*! exports provided: PipeRedSocial */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PipeRedSocial", function() { return PipeRedSocial; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var PipeRedSocial = /** @class */ (function () {
    function PipeRedSocial() {
    }
    PipeRedSocial.prototype.transform = function (items, buscar) {
        if (!items || !buscar) {
            return items;
        }
        return items.find(function (item) {
            return item['DESCRIPCION'] == buscar.toUpperCase();
        });
    };
    PipeRedSocial = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Pipe"])({
            name: 'filterRedSocial',
            pure: false
        })
    ], PipeRedSocial);
    return PipeRedSocial;
}());



/***/ }),

/***/ "./src/app/dashboard/dashboard-routing.module.ts":
/*!*******************************************************!*\
  !*** ./src/app/dashboard/dashboard-routing.module.ts ***!
  \*******************************************************/
/*! exports provided: DashboardRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DashboardRoutingModule", function() { return DashboardRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _dashboard1_dashboard1_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./dashboard1/dashboard1.component */ "./src/app/dashboard/dashboard1/dashboard1.component.ts");
/* harmony import */ var _dashboard2_dashboard2_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./dashboard2/dashboard2.component */ "./src/app/dashboard/dashboard2/dashboard2.component.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};




var routes = [
    {
        path: '',
        children: [
            {
                path: 'dashboard1',
                component: _dashboard1_dashboard1_component__WEBPACK_IMPORTED_MODULE_2__["Dashboard1Component"],
                data: {
                    title: 'Dashboard 1'
                }
            },
            {
                path: 'dashboard2',
                component: _dashboard2_dashboard2_component__WEBPACK_IMPORTED_MODULE_3__["Dashboard2Component"],
                data: {
                    title: 'Dashboard 2'
                }
            },
        ]
    }
];
var DashboardRoutingModule = /** @class */ (function () {
    function DashboardRoutingModule() {
    }
    DashboardRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]],
        })
    ], DashboardRoutingModule);
    return DashboardRoutingModule;
}());



/***/ }),

/***/ "./src/app/dashboard/dashboard.module.ts":
/*!***********************************************!*\
  !*** ./src/app/dashboard/dashboard.module.ts ***!
  \***********************************************/
/*! exports provided: DashboardModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DashboardModule", function() { return DashboardModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm5/common.js");
/* harmony import */ var _dashboard_routing_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./dashboard-routing.module */ "./src/app/dashboard/dashboard-routing.module.ts");
/* harmony import */ var ng_chartist__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ng-chartist */ "./node_modules/ng-chartist/dist/ng-chartist.js");
/* harmony import */ var ng_chartist__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(ng_chartist__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @ng-bootstrap/ng-bootstrap */ "./node_modules/@ng-bootstrap/ng-bootstrap/index.js");
/* harmony import */ var _shared_directives_match_height_directive__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../shared/directives/match-height.directive */ "./src/app/shared/directives/match-height.directive.ts");
/* harmony import */ var _dashboard1_dashboard1_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./dashboard1/dashboard1.component */ "./src/app/dashboard/dashboard1/dashboard1.component.ts");
/* harmony import */ var _dashboard2_dashboard2_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./dashboard2/dashboard2.component */ "./src/app/dashboard/dashboard2/dashboard2.component.ts");
/* harmony import */ var app_pipes_PipeRedSocial__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! app/_pipes/PipeRedSocial */ "./src/app/_pipes/PipeRedSocial.ts");
/* harmony import */ var app_pipes_PipeCliente__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! app/_pipes/PipeCliente */ "./src/app/_pipes/PipeCliente.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};










var DashboardModule = /** @class */ (function () {
    function DashboardModule() {
    }
    DashboardModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _angular_common__WEBPACK_IMPORTED_MODULE_1__["CommonModule"],
                _dashboard_routing_module__WEBPACK_IMPORTED_MODULE_2__["DashboardRoutingModule"],
                ng_chartist__WEBPACK_IMPORTED_MODULE_3__["ChartistModule"],
                _ng_bootstrap_ng_bootstrap__WEBPACK_IMPORTED_MODULE_4__["NgbModule"],
                _shared_directives_match_height_directive__WEBPACK_IMPORTED_MODULE_5__["MatchHeightModule"]
            ],
            exports: [],
            declarations: [
                _dashboard1_dashboard1_component__WEBPACK_IMPORTED_MODULE_6__["Dashboard1Component"],
                _dashboard2_dashboard2_component__WEBPACK_IMPORTED_MODULE_7__["Dashboard2Component"],
                app_pipes_PipeRedSocial__WEBPACK_IMPORTED_MODULE_8__["PipeRedSocial"],
                app_pipes_PipeCliente__WEBPACK_IMPORTED_MODULE_9__["PipeClienteTotalGenero"]
            ],
            providers: [],
        })
    ], DashboardModule);
    return DashboardModule;
}());



/***/ }),

/***/ "./src/app/dashboard/dashboard1/dashboard1.component.html":
/*!****************************************************************!*\
  !*** ./src/app/dashboard/dashboard1/dashboard1.component.html ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Statistics cards Starts-->\n<div class=\"row\">\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-blackberry\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{encuestaActual.cantidad}}</h3>\n\t\t\t\t\t\t\t<span>{{'Encuestas ' + monthNames[date.getMonth()]}}</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"icon-note font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-ibiza-sunset\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{user.DESCRIPCION_TIPO_ROL=='ADMINISTRADOR'?totalRestaurantes:totalAlcance}}</h3>\n\t\t\t\t\t\t\t<span>{{user.DESCRIPCION_TIPO_ROL=='ADMINISTRADOR'?'Total Restaurantes':'Alcance Redes ('+monthNames[date.getMonth()].substring(0,3)+')'}}</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-cutlery font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-green-tea\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{ user.DESCRIPCION_TIPO_ROL=='ADMINISTRADOR'?totalClientes:nivelSatisfaccion}}</h3>\n\t\t\t\t\t\t\t<span>{{user.DESCRIPCION_TIPO_ROL=='ADMINISTRADOR'?'Total Usuarios':'Nivel Satisfaccion ('+monthNames[date.getMonth()].substring(0,3)+')'}}</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-users font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-pomegranate\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{totalPublicaciones}}</h3>\n\t\t\t\t\t\t\t<span>Publicaciones {{monthNames[date.getMonth()]}}</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-share-alt font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n</div>\n<!--Statistics cards Ends-->\n\n<div *ngIf=\"totalEncuestaSemanal && redSocialMensual\" class=\"row\" matchHeight =\"card\">\n\t<div class=\"col-xl-4 col-lg-12 col-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Encuestas</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center pb-2\">Últimos 6 meses</p>\n\t\t\t\t<div id=\"Stack-bar-chart\" class=\"height-300 Stackbarchart mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"Stackbarchart.data\" [type]=\"Stackbarchart.type\" [options]=\"Stackbarchart.options\"\n\t\t\t\t\t [responsiveOptions]=\"Stackbarchart.responsiveOptions\" [events]=\"Stackbarchart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-4 col-lg-12 col-12\">\n\t\t<div class=\"card gradient-blackberry\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div  class=\"card-block\">\n\t\t\t\t\t<h4 class=\"card-title white\">Encuestas {{date.getFullYear()}}</h4>\n\t\t\t\t\t<div class=\"p-2 text-center\">\n\t\t\t\t\t\t<a class=\"btn btn-raised btn-round bg-white mx-3 px-3\">Semana {{totalEncuestaSemanal[0].SEMANA}}</a>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"my-3 text-center white\">\n\t\t\t\t\t\t<a class=\"font-large-2 d-block mb-1\">{{totalEncuestaSemanal[0].CANTIDAD}}<span class=\"ft-arrow-up font-large-2\"></span></a>\n\t\t\t\t\t\t<span class=\"font-medium-1\">Semana {{totalEncuestaSemanal[1].SEMANA}} {{(totalEncuestaSemanal[0].CANTIDAD - totalEncuestaSemanal[1].CANTIDAD)>=0?'+':''}}{{totalEncuestaSemanal[0].CANTIDAD - totalEncuestaSemanal[1].CANTIDAD}}</span>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"lineChart\" class=\"height-250 lineChart lineChartShadow\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"lineChart.data\" [type]=\"lineChart.type\" [options]=\"lineChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"lineChart.responsiveOptions\" [events]=\"lineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-4 col-lg-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Publicaciones {{monthNames[date.getMonth()]}}</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center\">Redes Sociales</p>\n\t\t\t\t<div id=\"bar-chart\" class=\"height-250 BarChartShadow BarChart\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"BarChart.data\" [type]=\"BarChart.type\" [options]=\"BarChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"BarChart.responsiveOptions\" [events]=\"BarChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"card-block\">\n\t\t\t\t\t<div class=\"row\">\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-pomegranate d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">{{(redSocialMensual | filterRedSocial : 'FACEBOOK').CANTIDAD}}</span>\n\t\t\t\t\t\t\t<span>Facebook</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-green-tea d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">{{(redSocialMensual | filterRedSocial : 'INSTAGRAM').CANTIDAD}}</span>\n\t\t\t\t\t\t\t<span>Instagram</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-blackberry d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">{{(redSocialMensual | filterRedSocial : 'TWITTER').CANTIDAD}}</span>\n\t\t\t\t\t\t\t<span>Twitter</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\t\t\n</div>\n\n<div class=\"row\" matchHeight =\"card\">\n\t<div class=\"col-xl-4 col-lg-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Clientes ({{monthNames[date.getMonth()]}})</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center\">Género</p>\n\t\t\t\t<div id=\"donut-dashboard-chart\" class=\"height-250 donut\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"DonutChart.data\" [type]=\"DonutChart.type\" [options]=\"DonutChart.options\" [responsiveOptions]=\"DonutChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"DonutChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"card-block\">\n\t\t\t\t\t<div class=\"row mb-3\">\n\t\t\t\t\t\t<div class=\"col\">\n\t\t\t\t\t\t\t<span class=\"mb-1 text-muted d-block\">{{clientesGeneroMensual | totalClienteGenero : 'MASCULINO'}} - Masculino</span>\n\t\t\t\t\t\t\t<div class=\"progress\" style=\"height: 5px;\">\n\t\t\t\t\t\t\t\t<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 23%;\" aria-valuenow=\"23\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col\">\n\t\t\t\t\t\t\t<span class=\"mb-1 text-muted d-block\">{{clientesGeneroMensual | totalClienteGenero : 'FEMENINO'}} - Femenino</span>\n\t\t\t\t\t\t\t<div class=\"progress\" style=\"height: 5px;\">\n\t\t\t\t\t\t\t\t<div class=\"progress-bar bg-amber\" role=\"progressbar\" style=\"width: 14%;\" aria-valuenow=\"14\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-8 col-lg-12 col-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Edades de clientes que realizaron encuestas </h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center pb-2\">{{monthNames[date.getMonth()]}}</p>\n\t\t\t\t<div id=\"Stack-bar-chart\" class=\"height-300 EdadesChart mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"EdadesChart.data\" [type]=\"EdadesChart.type\" [options]=\"EdadesChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"EdadesChart.responsiveOptions\" [events]=\"EdadesChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "./src/app/dashboard/dashboard1/dashboard1.component.scss":
/*!****************************************************************!*\
  !*** ./src/app/dashboard/dashboard1/dashboard1.component.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ":host /deep/ .ct-grid {\n  stroke-dasharray: 0px;\n  stroke: rgba(0, 0, 0, 0.1); }\n\n:host /deep/ .ct-label {\n  font-size: 0.9rem; }\n\n:host /deep/ .lineArea .ct-series-a .ct-area {\n  fill-opacity: 0.7;\n  fill: url(\"/dashboard/dashboard1#gradient1\") !important; }\n\n:host /deep/ .lineArea .ct-series-b .ct-area {\n  fill: url(\"/dashboard/dashboard1#gradient\") !important;\n  fill-opacity: 0.9; }\n\n:host /deep/ .lineArea .ct-line {\n  stroke-width: 0px; }\n\n:host /deep/ .lineArea .ct-point {\n  stroke-width: 0px; }\n\n:host /deep/ .Stackbarchart .ct-series-a .ct-bar {\n  stroke: url(\"/dashboard/dashboard1#linear\") !important; }\n\n:host /deep/ .Stackbarchart .ct-series-b .ct-bar {\n  stroke: #e9e9e9; }\n\n:host /deep/ .EdadesChart .ct-series-a .ct-bar {\n  fill: url(\"/dashboard/dashboard1#gradient2\") !important; }\n\n:host /deep/ .EdadesChart .ct-series-b .ct-bar {\n  stroke: #e9e9e9; }\n\n:host /deep/ .lineArea2 .ct-series-a .ct-area {\n  fill: url(\"/dashboard/dashboard1#gradient2\") !important; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-area {\n  fill: url(\"/dashboard/dashboard1#gradient3\") !important; }\n\n:host /deep/ .lineArea2 .ct-point-circle {\n  stroke-width: 2px;\n  fill: white; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-point-circle {\n  stroke: #843cf7; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-line {\n  stroke: #A675F4; }\n\n:host /deep/ .lineArea2 .ct-series-a .ct-point-circle {\n  stroke: #31afb2; }\n\n:host /deep/ .lineArea2 .ct-line {\n  fill: none;\n  stroke-width: 2px; }\n\n:host /deep/ .lineChart .ct-point-circle {\n  stroke-width: 2px;\n  fill: white; }\n\n:host /deep/ .lineChart .ct-series-a .ct-point-circle {\n  stroke: white; }\n\n:host /deep/ .lineChart .ct-line {\n  fill: none;\n  stroke: white;\n  stroke-width: 1px; }\n\n:host /deep/ .lineChart .ct-label {\n  color: #FFF; }\n\n:host /deep/ .lineChartShadow {\n  -webkit-filter: drop-shadow(0px 25px 8px rgba(0, 0, 0, 0.3));\n  filter: drop-shadow(0px 25px 8px rgba(0, 0, 0, 0.3));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n\n:host /deep/ .donut .ct-done .ct-slice-donut {\n  stroke: #0CC27E;\n  stroke-width: 24px !important; }\n\n:host /deep/ .donut .ct-progress .ct-slice-donut {\n  stroke: #FFC107;\n  stroke-width: 16px !important; }\n\n:host /deep/ .donut .ct-outstanding .ct-slice-donut {\n  stroke: #7E57C2;\n  stroke-width: 8px !important; }\n\n:host /deep/ .donut .ct-started .ct-slice-donut {\n  stroke: #2196F3;\n  stroke-width: 32px !important; }\n\n:host /deep/ .donut .ct-label {\n  text-anchor: middle;\n  alignment-baseline: middle;\n  font-size: 20px;\n  fill: #868e96; }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+1) {\n  stroke: url(\"/dashboard/dashboard1#gradient7\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+2) {\n  stroke: url(\"/dashboard/dashboard1#gradient5\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+3) {\n  stroke: url(\"/dashboard/dashboard1#gradient6\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+4) {\n  stroke: url(\"/dashboard/dashboard1#gradient4\"); }\n\n:host /deep/ .BarChartShadow {\n  -webkit-filter: drop-shadow(0px 20px 8px rgba(0, 0, 0, 0.3));\n  filter: drop-shadow(0px 20px 8px rgba(0, 0, 0, 0.3));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n\n:host /deep/ .WidgetlineChart .ct-point {\n  stroke-width: 0px; }\n\n:host /deep/ .WidgetlineChart .ct-line {\n  stroke: #fff; }\n\n:host /deep/ .WidgetlineChart .ct-grid {\n  stroke-dasharray: 0px;\n  stroke: rgba(255, 255, 255, 0.2); }\n\n:host /deep/ .WidgetlineChartshadow {\n  -webkit-filter: drop-shadow(0px 15px 5px rgba(0, 0, 0, 0.8));\n  filter: drop-shadow(0px 15px 5px rgba(0, 0, 0, 0.8));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n"

/***/ }),

/***/ "./src/app/dashboard/dashboard1/dashboard1.component.ts":
/*!**************************************************************!*\
  !*** ./src/app/dashboard/dashboard1/dashboard1.component.ts ***!
  \**************************************************************/
/*! exports provided: Dashboard1Component */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Dashboard1Component", function() { return Dashboard1Component; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var chartist__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! chartist */ "./node_modules/chartist/dist/chartist.js");
/* harmony import */ var chartist__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(chartist__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var app_services_cliente_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! app/_services/cliente.service */ "./src/app/_services/cliente.service.ts");
/* harmony import */ var app_services_encuesta_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! app/_services/encuesta.service */ "./src/app/_services/encuesta.service.ts");
/* harmony import */ var app_services_sucursal_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! app/_services/sucursal.service */ "./src/app/_services/sucursal.service.ts");
/* harmony import */ var app_services_charts_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! app/_services/charts.service */ "./src/app/_services/charts.service.ts");
/* harmony import */ var ngx_toastr__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ngx-toastr */ "./node_modules/ngx-toastr/fesm5/ngx-toastr.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};







var data = __webpack_require__(/*! ../../shared/data/chartist.json */ "./src/app/shared/data/chartist.json");
var Dashboard1Component = /** @class */ (function () {
    function Dashboard1Component(sucursalService, clienteService, encuestaService, chartsService, toastr) {
        this.sucursalService = sucursalService;
        this.clienteService = clienteService;
        this.encuestaService = encuestaService;
        this.chartsService = chartsService;
        this.toastr = toastr;
        this.date = new Date();
        this.monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        this.encuestaActual = {
            id: '',
            titulo: '',
            cantidad: ''
        };
        this.parametros = {
            fechaInicio: '',
            fechaFin: '',
        };
        // Line area chart configuration Starts
        this.lineArea = {
            type: 'Line',
            data: data['lineAreaDashboard'],
            options: {
                low: 0,
                showArea: true,
                fullWidth: true,
                onlyInteger: true,
                axisY: {
                    low: 0,
                    scaleMinSpace: 50,
                },
                axisX: {
                    showGrid: false
                }
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient',
                        x1: 0,
                        y1: 1,
                        x2: 1,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 201, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(146, 254, 157, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient1',
                        x1: 0,
                        y1: 1,
                        x2: 1,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(132, 60, 247, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(56, 184, 242, 1)'
                    });
                },
            },
        };
        // Line area chart configuration Ends
        // Stacked Bar chart configuration Starts
        this.Stackbarchart = {
            type: 'Bar',
            data: {
                labels: [],
                series: [[], []]
            },
            options: {
                stackBars: true,
                fullWidth: true,
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                chartPadding: 30
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'linear',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 201, 255,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(17,228,183, 1)'
                    });
                },
                draw: function (data) {
                    if (data.type === 'bar') {
                        data.element.attr({
                            style: 'stroke-width: 5px',
                            x1: data.x1 + 0.001
                        });
                    }
                    else if (data.type === 'label') {
                        data.element.attr({
                            y: 270
                        });
                    }
                }
            },
        };
        this.EdadesChart = {
            type: 'Bar',
            data: {
                labels: [],
                series: [
                    [],
                    []
                ]
            },
            options: {
                stackBars: true,
                fullWidth: true,
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                chartPadding: 30
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient2',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgb(255, 133, 51)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgb(204, 0, 0)'
                    });
                },
                draw: function (data) {
                    if (data.type === 'bar') {
                        data.element.attr({
                            style: 'stroke-width: 15px',
                            x1: data.x1 + 0.001
                        });
                    }
                    else if (data.type === 'label') {
                        data.element.attr({
                            y: 270
                        });
                    }
                }
            },
        };
        // Stacked Bar chart configuration Ends
        // Line area chart 2 configuration Starts
        this.lineArea2 = {
            type: 'Line',
            data: data['lineArea2'],
            options: {
                showArea: true,
                fullWidth: true,
                lineSmooth: chartist__WEBPACK_IMPORTED_MODULE_1__["Interpolation"].none(),
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    low: 0,
                    scaleMinSpace: 50,
                }
            },
            responsiveOptions: [
                ['screen and (max-width: 640px) and (min-width: 381px)', {
                        axisX: {
                            labelInterpolationFnc: function (value, index) {
                                return index % 2 === 0 ? value : null;
                            }
                        }
                    }],
                ['screen and (max-width: 380px)', {
                        axisX: {
                            labelInterpolationFnc: function (value, index) {
                                return index % 3 === 0 ? value : null;
                            }
                        }
                    }]
            ],
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient2',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(255, 255, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(0, 201, 255, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient3',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0.3,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(255, 255, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(132, 60, 247, 1)'
                    });
                },
                draw: function (data) {
                    var circleRadius = 4;
                    if (data.type === 'point') {
                        var circle = new chartist__WEBPACK_IMPORTED_MODULE_1__["Svg"]('circle', {
                            cx: data.x,
                            cy: data.y,
                            r: circleRadius,
                            class: 'ct-point-circle'
                        });
                        data.element.replace(circle);
                    }
                    else if (data.type === 'label') {
                        // adjust label position for rotation
                        var dX = data.width / 2 + (30 - data.width);
                        data.element.attr({ x: data.element.attr('x') - dX });
                    }
                }
            },
        };
        // Line area chart 2 configuration Ends
        // Line chart configuration Starts
        this.lineChart = {
            type: 'Line', data: data['LineDashboard'],
            options: {
                axisX: {
                    showGrid: false
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    low: 0,
                    high: 100,
                    offset: 0,
                },
                fullWidth: true,
                offset: 0,
            },
            events: {
                draw: function (data) {
                    var circleRadius = 4;
                    if (data.type === 'point') {
                        var circle = new chartist__WEBPACK_IMPORTED_MODULE_1__["Svg"]('circle', {
                            cx: data.x,
                            cy: data.y,
                            r: circleRadius,
                            class: 'ct-point-circle'
                        });
                        data.element.replace(circle);
                    }
                    else if (data.type === 'label') {
                        // adjust label position for rotation
                        var dX = data.width / 2 + (30 - data.width);
                        data.element.attr({ x: data.element.attr('x') - dX });
                    }
                }
            },
        };
        // Line chart configuration Ends
        // Donut chart configuration Starts
        this.DonutChart = {
            type: 'Pie',
            data: {
                series: [
                    {
                        name: "done",
                        className: "ct-done",
                        value: 23
                    },
                    {
                        name: "progress",
                        className: "ct-progress",
                        value: 14
                    }
                ]
            },
            options: {
                donut: true,
                startAngle: 0,
                labelInterpolationFnc: function (value) {
                    var total = data['donutDashboard'].series.reduce(function (prev, series) {
                        return prev + series.value;
                    }, 0);
                    return total + '%';
                }
            },
            events: {
                draw: function (data) {
                    if (data.type === 'label') {
                        if (data.index === 0) {
                            data.element.attr({
                                dx: data.element.root().width() / 2,
                                dy: data.element.root().height() / 2
                            });
                        }
                        else {
                            data.element.remove();
                        }
                    }
                }
            }
        };
        // Donut chart configuration Ends
        //  Bar chart configuration Starts
        this.BarChart = {
            type: 'Bar', data: {
                labels: [],
                series: [
                    []
                ]
            }, options: {
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                low: 0,
                high: 60,
            },
            responsiveOptions: [
                ['screen and (max-width: 640px)', {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            }
                        }
                    }]
            ],
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient4',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(238, 9, 121,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(255, 106, 0, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient5',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 75, 145,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(120, 204, 55, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient6',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(132, 60, 247,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(56, 184, 242, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient7',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(155, 60, 183,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(255, 57, 111, 1)'
                    });
                },
                draw: function (data) {
                    var barHorizontalCenter, barVerticalCenter, label, value;
                    if (data.type === 'bar') {
                        data.element.attr({
                            y1: 195,
                            x1: data.x1 + 0.001
                        });
                    }
                }
            },
        };
        // Bar chart configuration Ends
        // line chart configuration Starts
        this.WidgetlineChart = {
            type: 'Line', data: data['WidgetlineChart'],
            options: {
                axisX: {
                    showGrid: true,
                    showLabel: false,
                    offset: 0,
                },
                axisY: {
                    showGrid: false,
                    low: 40,
                    showLabel: false,
                    offset: 0,
                },
                lineSmooth: chartist__WEBPACK_IMPORTED_MODULE_1__["Interpolation"].cardinal({
                    tension: 0
                }),
                fullWidth: true,
            },
        };
        this.nivelSatisfaccion = 0;
        this.getPermisos("Dashboard");
        this.user = JSON.parse(localStorage.getItem('usuario'));
    }
    Dashboard1Component.prototype.ngOnInit = function () {
        if (this.getAccion('VER')) {
            this.getTotalSucursales();
            this.getTotalClientes();
            this.getTotalEncuestaActiva();
            this.getTotalEncuestaMensual();
            this.getTotalEncuestaSemanal();
            this.getRedSocialMensual(this.date.getMonth() + 1, this.date.getFullYear());
            this.getClientesGeneroMensual(this.date.getMonth() + 1, this.date.getFullYear());
            this.getClientesEdadMensual(this.date.getMonth() + 1, this.date.getFullYear());
            if (this.user.DESCRIPCION_TIPO_ROL != "ADMINISTRADOR") {
                this.parametros.fechaInicio = (new Date(Date.now() - (30 * 24 * 60 * 60 * 1000))).toISOString().slice(0, 10);
                this.parametros.fechaFin = (new Date(Date.now())).toISOString().slice(0, 10);
                this.getPreguntasEncuestaActiva();
            }
        }
    };
    Dashboard1Component.prototype.getWeek = function () {
        var firstDayOfYear = new Date(this.date.getFullYear(), 0, 1);
        var pastDaysOfYear = (this.date - firstDayOfYear) / 86400000;
        return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
    };
    Dashboard1Component.prototype.getPermisos = function (descModulo) {
        this.permisos = JSON.parse(localStorage.getItem('permisos'));
        this.acciones = this.permisos.filter(function (item) { return item['DESCRIPCION_MODULO'] == descModulo; });
    };
    Dashboard1Component.prototype.getAccion = function (descAccion) {
        return (this.acciones.find(function (item) { return item['DESCRIPCION_ACCION'] == descAccion; }) != undefined);
    };
    Dashboard1Component.prototype.getTotalSucursales = function () {
        var _this = this;
        this.sucursalService.getSucursalesActivas()
            .subscribe(function (data) {
            _this.totalRestaurantes = data['resultado']['cantidad'];
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getTotalClientes = function () {
        var _this = this;
        this.clienteService.getTotalClientes()
            .subscribe(function (data) {
            _this.totalClientes = data['resultado']['cantidad'];
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getTotalEncuestaActiva = function () {
        var _this = this;
        this.encuestaService.getTotalEncuestaActiva((this.date.getMonth() + 1).toString(), this.date.getFullYear().toString())
            .subscribe(function (data) {
            _this.encuestaActual.id = data['resultado']['resultados'][0].ENCUESTA_ID;
            _this.encuestaActual.titulo = data['resultado']['resultados'][0].TITULO;
            _this.encuestaActual.cantidad = data['resultado']['resultados'][0].CANTIDAD;
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getTotalEncuestaMensual = function () {
        var _this = this;
        this.encuestaService.getTotalEncuestaMensual()
            .subscribe(function (data) {
            _this.totalEncuestasMensual = data['resultado']['resultados'];
            var maxValue = _this.totalEncuestasMensual.reduce(function (prev, current) {
                return (Number.parseInt(prev.CANTIDAD) > Number.parseInt(current.CANTIDAD)) ? prev : current;
            });
            _this.Stackbarchart.data = {
                labels: _this.totalEncuestasMensual.map(function (item) { return _this.monthNames[item.MES - 1]; }),
                series: [_this.totalEncuestasMensual.map(function (item) { return item.CANTIDAD; }), _this.totalEncuestasMensual.map(function (item) { return maxValue.CANTIDAD - item.CANTIDAD; })
                ]
            };
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getTotalEncuestaSemanal = function () {
        var _this = this;
        this.encuestaService.getTotalEncuestaSemanal()
            .subscribe(function (data) {
            _this.totalEncuestaSemanal = data['resultado']['resultados'];
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getRedSocialMensual = function (mes, anio) {
        var _this = this;
        this.encuestaService.getRedesSocialMensual(mes, anio)
            .subscribe(function (data) {
            _this.redSocialMensual = data['resultado']['resultados'];
            var sumRedes = _this.redSocialMensual.filter(function (item) { return item.DESCRIPCION != 'NO COMPARTIDO'; }).map(function (element) { return Number.parseInt(element.CANTIDAD); })
                .reduce(function (prev, current) {
                return Number.parseInt(prev) + Number.parseInt(current);
            });
            _this.totalAlcance = _this.redSocialMensual.filter(function (item) { return item.DESCRIPCION != 'NO COMPARTIDO'; }).map(function (element) {
                switch (element.DESCRIPCION) {
                    case 'FACEBOOK':
                        return Number.parseInt(element.CANTIDAD) * 100;
                        break;
                    case 'INSTAGRAM':
                        return Number.parseInt(element.CANTIDAD) * 150;
                        break;
                    case 'TWITTER':
                        return Number.parseInt(element.CANTIDAD) * 200;
                        break;
                }
            })
                .reduce(function (prev, current) {
                return Number.parseInt(prev) + Number.parseInt(current);
            });
            _this.totalPublicaciones = sumRedes;
            _this.BarChart.data = {
                labels: _this.redSocialMensual.filter(function (item) { return item.DESCRIPCION != 'NO COMPARTIDO'; }).map(function (element) { return element.DESCRIPCION; }),
                series: [_this.redSocialMensual.filter(function (item) { return item.DESCRIPCION != 'NO COMPARTIDO'; }).map(function (element) { return (Number.parseInt(element.CANTIDAD) * 100 / sumRedes); })]
            };
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getClientesGeneroMensual = function (mes, anio) {
        var _this = this;
        this.encuestaService.getClienteGenero(mes, anio)
            .subscribe(function (data) {
            _this.clientesGeneroMensual = data['resultado']['resultados'];
            _this.DonutChart.data = {
                series: [
                    {
                        name: "Masculino",
                        className: "ct-done",
                        value: _this.clientesGeneroMensual.filter(function (item) { return item.GENERO == 'MASCULINO'; })
                            .map(function (element) { return Number.parseInt(element.CANTIDAD); })
                            .reduce(function (prev, current) {
                            return (prev + current);
                        }, 0)
                    },
                    {
                        name: "Femenino",
                        className: "ct-progress",
                        value: _this.clientesGeneroMensual.filter(function (item) { return item.GENERO == 'FEMENINO'; })
                            .map(function (element) { return Number.parseInt(element.CANTIDAD); })
                            .reduce(function (prev, current) {
                            return (prev + current);
                        }, 0)
                    }
                ]
            };
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getClientesEdadMensual = function (mes, anio) {
        var _this = this;
        this.encuestaService.getClienteEdad(mes, anio)
            .subscribe(function (data) {
            _this.clientesEdadMensual = data['resultado']['resultados'];
            var maxValue = _this.clientesEdadMensual.reduce(function (prev, current) {
                return (Number.parseInt(prev.CANTIDAD) > Number.parseInt(current.CANTIDAD)) ? prev : current;
            });
            _this.EdadesChart.data = {
                labels: _this.clientesEdadMensual.map(function (item) { return item.GENERACION; }),
                series: [
                    _this.clientesEdadMensual.map(function (item) { return item.CANTIDAD; }),
                    _this.clientesEdadMensual.map(function (item) { return maxValue.CANTIDAD - item.CANTIDAD; })
                ]
            };
        }, function (error) {
        });
    };
    Dashboard1Component.prototype.getPreguntasEncuestaActiva = function () {
        var _this = this;
        this.chartsService.getPreguntasEncuestaActiva(this.parametros)
            .subscribe(function (data) {
            var resultados = data['resultado']['resultados'];
            _this.nivelSatisfaccion = resultados.map(function (element) { return Number.parseFloat(element.PROMEDIO); })
                .reduce(function (prev, current) {
                return (prev + current);
            }, 0);
            _this.nivelSatisfaccion = Math.round(_this.nivelSatisfaccion / resultados.length);
        }, function (error) {
            _this.toastr.warning("Error en el servidor, comuniquise con el dpto. de sistemas");
        });
    };
    Dashboard1Component = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-dashboard1',
            template: __webpack_require__(/*! ./dashboard1.component.html */ "./src/app/dashboard/dashboard1/dashboard1.component.html"),
            styles: [__webpack_require__(/*! ./dashboard1.component.scss */ "./src/app/dashboard/dashboard1/dashboard1.component.scss")]
        }),
        __metadata("design:paramtypes", [app_services_sucursal_service__WEBPACK_IMPORTED_MODULE_4__["SucursalService"],
            app_services_cliente_service__WEBPACK_IMPORTED_MODULE_2__["ClienteService"],
            app_services_encuesta_service__WEBPACK_IMPORTED_MODULE_3__["EncuestaService"],
            app_services_charts_service__WEBPACK_IMPORTED_MODULE_5__["ChartsService"],
            ngx_toastr__WEBPACK_IMPORTED_MODULE_6__["ToastrService"]])
    ], Dashboard1Component);
    return Dashboard1Component;
}());



/***/ }),

/***/ "./src/app/dashboard/dashboard2/dashboard2.component.html":
/*!****************************************************************!*\
  !*** ./src/app/dashboard/dashboard2/dashboard2.component.html ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Statistics cards Starts-->\n<div class=\"row\">\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-blackberry\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{encuestaActual.cantidad}}</h3>\n\t\t\t\t\t\t\t<span>{{'Encuestas ' + monthNames[date.getMonth()]}}</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"icon-note font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-ibiza-sunset\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{totalRestaurantes}}</h3>\n\t\t\t\t\t\t\t<span>Total Sucursales</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-cutlery font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-green-tea\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{totalClientes}}</h3>\n\t\t\t\t\t\t\t<span>Total Clientes</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-users font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-3 col-lg-6 col-md-6 col-12\">\n\t\t<div class=\"card gradient-pomegranate\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block pt-2 pb-0\">\n\t\t\t\t\t<div class=\"media\">\n\t\t\t\t\t\t<div class=\"media-body white text-left\">\n\t\t\t\t\t\t\t<h3 class=\"font-large-1 mb-0\">{{totalPublicaciones}}</h3>\n\t\t\t\t\t\t\t<span>Total publiciaciones</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"media-right white text-right\">\n\t\t\t\t\t\t\t<i class=\"fa fa-share-alt font-large-1\"></i>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"Widget-line-chart\" class=\"height-75 WidgetlineChart WidgetlineChartshadow mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"WidgetlineChart.data\" [type]=\"WidgetlineChart.type\" [options]=\"WidgetlineChart.options\" [responsiveOptions]=\"WidgetlineChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"WidgetlineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n</div>\n<!--Statistics cards Ends-->\n\n<div class=\"row\" matchHeight =\"card\">\n\t<div class=\"col-xl-4 col-lg-12 col-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Encuestas</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center pb-2\">Últimos 6 meses</p>\n\t\t\t\t<div id=\"Stack-bar-chart\" class=\"height-300 Stackbarchart mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"Stackbarchart.data\" [type]=\"Stackbarchart.type\" [options]=\"Stackbarchart.options\"\n\t\t\t\t\t [responsiveOptions]=\"Stackbarchart.responsiveOptions\" [events]=\"Stackbarchart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-4 col-lg-12 col-12\">\n\t\t<div class=\"card gradient-blackberry\">\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<div class=\"card-block\">\n\t\t\t\t\t<h4 class=\"card-title white\">Encuestas</h4>\n\t\t\t\t\t<div class=\"p-2 text-center\">\n\t\t\t\t\t\t<a class=\"btn btn-raised btn-round bg-white mx-3 px-3\">De la semana 2</a>\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class=\"my-3 text-center white\">\n\t\t\t\t\t\t<a class=\"font-large-2 d-block mb-1\">785<span class=\"ft-arrow-up font-large-2\"></span></a>\n\t\t\t\t\t\t<span class=\"font-medium-1\">Semana 1 +30</span>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t\t<div id=\"lineChart\" class=\"height-250 lineChart lineChartShadow\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"lineChart.data\" [type]=\"lineChart.type\" [options]=\"lineChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"lineChart.responsiveOptions\" [events]=\"lineChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-4 col-lg-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Alcance {{monthNames[date.getMonth()]}}</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center\">Redes Sociales</p>\n\t\t\t\t<div id=\"bar-chart\" class=\"height-250 BarChartShadow BarChart\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"BarChart.data\" [type]=\"BarChart.type\" [options]=\"BarChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"BarChart.responsiveOptions\" [events]=\"BarChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"card-block\">\n\t\t\t\t\t<div class=\"row\">\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-pomegranate d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">48</span>\n\t\t\t\t\t\t\t<span>Facebook</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-green-tea d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">9</span>\n\t\t\t\t\t\t\t<span>Instagram</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col text-center\">\n\t\t\t\t\t\t\t<span class=\"gradient-blackberry d-block rounded-circle mx-auto mb-2\" style=\"width:10px; height:10px;\"></span>\n\t\t\t\t\t\t\t<span class=\"font-large-1 d-block mb-2\">26</span>\n\t\t\t\t\t\t\t<span>Twitter</span>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\t\t\n</div>\n\n<div class=\"row\" matchHeight =\"card\">\n\t<div class=\"col-xl-4 col-lg-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Clientes que realizaron Encuestas ({{monthNames[date.getMonth()]}})</h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center\">Género</p>\n\t\t\t\t<div id=\"donut-dashboard-chart\" class=\"height-250 donut\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"DonutChart.data\" [type]=\"DonutChart.type\" [options]=\"DonutChart.options\" [responsiveOptions]=\"DonutChart.responsiveOptions\"\n\t\t\t\t\t [events]=\"DonutChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"card-block\">\n\t\t\t\t\t<div class=\"row mb-3\">\n\t\t\t\t\t\t<div class=\"col\">\n\t\t\t\t\t\t\t<span class=\"mb-1 text-muted d-block\">46% - Hombre</span>\n\t\t\t\t\t\t\t<div class=\"progress\" style=\"height: 5px;\">\n\t\t\t\t\t\t\t\t<div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: 23%;\" aria-valuenow=\"23\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class=\"col\">\n\t\t\t\t\t\t\t<span class=\"mb-1 text-muted d-block\">54% - Mujer</span>\n\t\t\t\t\t\t\t<div class=\"progress\" style=\"height: 5px;\">\n\t\t\t\t\t\t\t\t<div class=\"progress-bar bg-amber\" role=\"progressbar\" style=\"width: 14%;\" aria-valuenow=\"14\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t</div>\n\t<div class=\"col-xl-8 col-lg-12 col-12\">\n\t\t<div class=\"card\">\n\t\t\t<div class=\"card-header\">\n\t\t\t\t<h4 class=\"card-title\">Edades de clientes que realizaron encuestas </h4>\n\t\t\t</div>\n\t\t\t<div class=\"card-body\">\n\n\t\t\t\t<p class=\"font-medium-2 text-muted text-center pb-2\">{{monthNames[date.getMonth()]}}</p>\n\t\t\t\t<div id=\"Stack-bar-chart\" class=\"height-300 EdadesChart mb-2\">\n\t\t\t\t\t<x-chartist class=\"\" [data]=\"EdadesChart.data\" [type]=\"EdadesChart.type\" [options]=\"EdadesChart.options\"\n\t\t\t\t\t [responsiveOptions]=\"EdadesChart.responsiveOptions\" [events]=\"EdadesChart.events\">\n\t\t\t\t\t</x-chartist>\n\t\t\t\t</div>\n\n\t\t\t</div>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "./src/app/dashboard/dashboard2/dashboard2.component.scss":
/*!****************************************************************!*\
  !*** ./src/app/dashboard/dashboard2/dashboard2.component.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ":host /deep/ .ct-grid {\n  stroke-dasharray: 0px;\n  stroke: rgba(0, 0, 0, 0.1); }\n\n:host /deep/ .ct-label {\n  font-size: 0.9rem; }\n\n:host /deep/ .lineArea .ct-series-a .ct-area {\n  fill-opacity: 0.7;\n  fill: url(\"/dashboard/dashboard2#gradient1\") !important; }\n\n:host /deep/ .lineArea .ct-series-b .ct-area {\n  fill: url(\"/dashboard/dashboard2#gradient\") !important;\n  fill-opacity: 0.9; }\n\n:host /deep/ .lineArea .ct-line {\n  stroke-width: 0px; }\n\n:host /deep/ .lineArea .ct-point {\n  stroke-width: 0px; }\n\n:host /deep/ .Stackbarchart .ct-series-a .ct-bar {\n  stroke: url(\"/dashboard/dashboard2#linear\") !important; }\n\n:host /deep/ .Stackbarchart .ct-series-b .ct-bar {\n  stroke: #e9e9e9; }\n\n:host /deep/ .EdadesChart .ct-series-a .ct-bar {\n  fill: url(\"/dashboard/dashboard2#gradient2\") !important; }\n\n:host /deep/ .EdadesChart .ct-series-b .ct-bar {\n  stroke: #e9e9e9; }\n\n:host /deep/ .lineArea2 .ct-series-a .ct-area {\n  fill: url(\"/dashboard/dashboard2#gradient2\") !important; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-area {\n  fill: url(\"/dashboard/dashboard2#gradient3\") !important; }\n\n:host /deep/ .lineArea2 .ct-point-circle {\n  stroke-width: 2px;\n  fill: white; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-point-circle {\n  stroke: #843cf7; }\n\n:host /deep/ .lineArea2 .ct-series-b .ct-line {\n  stroke: #A675F4; }\n\n:host /deep/ .lineArea2 .ct-series-a .ct-point-circle {\n  stroke: #31afb2; }\n\n:host /deep/ .lineArea2 .ct-line {\n  fill: none;\n  stroke-width: 2px; }\n\n:host /deep/ .lineChart .ct-point-circle {\n  stroke-width: 2px;\n  fill: white; }\n\n:host /deep/ .lineChart .ct-series-a .ct-point-circle {\n  stroke: white; }\n\n:host /deep/ .lineChart .ct-line {\n  fill: none;\n  stroke: white;\n  stroke-width: 1px; }\n\n:host /deep/ .lineChart .ct-label {\n  color: #FFF; }\n\n:host /deep/ .lineChartShadow {\n  -webkit-filter: drop-shadow(0px 25px 8px rgba(0, 0, 0, 0.3));\n  filter: drop-shadow(0px 25px 8px rgba(0, 0, 0, 0.3));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n\n:host /deep/ .donut .ct-done .ct-slice-donut {\n  stroke: #0CC27E;\n  stroke-width: 24px !important; }\n\n:host /deep/ .donut .ct-progress .ct-slice-donut {\n  stroke: #FFC107;\n  stroke-width: 16px !important; }\n\n:host /deep/ .donut .ct-outstanding .ct-slice-donut {\n  stroke: #7E57C2;\n  stroke-width: 8px !important; }\n\n:host /deep/ .donut .ct-started .ct-slice-donut {\n  stroke: #2196F3;\n  stroke-width: 32px !important; }\n\n:host /deep/ .donut .ct-label {\n  text-anchor: middle;\n  alignment-baseline: middle;\n  font-size: 20px;\n  fill: #868e96; }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+1) {\n  stroke: url(\"/dashboard/dashboard2#gradient7\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+2) {\n  stroke: url(\"/dashboard/dashboard2#gradient5\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+3) {\n  stroke: url(\"/dashboard/dashboard2#gradient6\"); }\n\n:host /deep/ .BarChart .ct-series-a .ct-bar:nth-of-type(4n+4) {\n  stroke: url(\"/dashboard/dashboard2#gradient4\"); }\n\n:host /deep/ .BarChartShadow {\n  -webkit-filter: drop-shadow(0px 20px 8px rgba(0, 0, 0, 0.3));\n  filter: drop-shadow(0px 20px 8px rgba(0, 0, 0, 0.3));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n\n:host /deep/ .WidgetlineChart .ct-point {\n  stroke-width: 0px; }\n\n:host /deep/ .WidgetlineChart .ct-line {\n  stroke: #fff; }\n\n:host /deep/ .WidgetlineChart .ct-grid {\n  stroke-dasharray: 0px;\n  stroke: rgba(255, 255, 255, 0.2); }\n\n:host /deep/ .WidgetlineChartshadow {\n  -webkit-filter: drop-shadow(0px 15px 5px rgba(0, 0, 0, 0.8));\n  filter: drop-shadow(0px 15px 5px rgba(0, 0, 0, 0.8));\n  /* Same syntax as box-shadow, except \n                                                       for the spread property */ }\n"

/***/ }),

/***/ "./src/app/dashboard/dashboard2/dashboard2.component.ts":
/*!**************************************************************!*\
  !*** ./src/app/dashboard/dashboard2/dashboard2.component.ts ***!
  \**************************************************************/
/*! exports provided: Dashboard2Component */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Dashboard2Component", function() { return Dashboard2Component; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var chartist__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! chartist */ "./node_modules/chartist/dist/chartist.js");
/* harmony import */ var chartist__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(chartist__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var app_services_restaurante_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! app/_services/restaurante.service */ "./src/app/_services/restaurante.service.ts");
/* harmony import */ var app_services_cliente_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! app/_services/cliente.service */ "./src/app/_services/cliente.service.ts");
/* harmony import */ var app_services_encuesta_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! app/_services/encuesta.service */ "./src/app/_services/encuesta.service.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var data = __webpack_require__(/*! ../../shared/data/chartist.json */ "./src/app/shared/data/chartist.json");
var Dashboard2Component = /** @class */ (function () {
    // Line chart configuration Ends
    function Dashboard2Component(restauranteService, clienteService, encuestaService) {
        this.restauranteService = restauranteService;
        this.clienteService = clienteService;
        this.encuestaService = encuestaService;
        this.date = new Date();
        this.totalPublicaciones = "0";
        this.monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        this.encuestaActual = {
            id: '',
            titulo: '',
            cantidad: ''
        };
        // Line area chart configuration Starts
        this.lineArea = {
            type: 'Line',
            data: data['lineAreaDashboard'],
            options: {
                low: 0,
                showArea: true,
                fullWidth: true,
                onlyInteger: true,
                axisY: {
                    low: 0,
                    scaleMinSpace: 50,
                },
                axisX: {
                    showGrid: false
                }
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient',
                        x1: 0,
                        y1: 1,
                        x2: 1,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 201, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(146, 254, 157, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient1',
                        x1: 0,
                        y1: 1,
                        x2: 1,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(132, 60, 247, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(56, 184, 242, 1)'
                    });
                },
            },
        };
        // Line area chart configuration Ends
        // Stacked Bar chart configuration Starts
        this.Stackbarchart = {
            type: 'Bar',
            data: data['Stackbarchart'],
            options: {
                stackBars: true,
                fullWidth: true,
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                chartPadding: 30
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'linear',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 201, 255,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(17,228,183, 1)'
                    });
                },
                draw: function (data) {
                    if (data.type === 'bar') {
                        data.element.attr({
                            style: 'stroke-width: 5px',
                            x1: data.x1 + 0.001
                        });
                    }
                    else if (data.type === 'label') {
                        data.element.attr({
                            y: 270
                        });
                    }
                }
            },
        };
        this.EdadesChart = {
            type: 'Bar',
            data: data['Edades'],
            options: {
                stackBars: true,
                fullWidth: true,
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                chartPadding: 30
            },
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient2',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgb(255, 133, 51)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgb(204, 0, 0)'
                    });
                },
                draw: function (data) {
                    if (data.type === 'bar') {
                        data.element.attr({
                            style: 'stroke-width: 15px',
                            x1: data.x1 + 0.001
                        });
                    }
                    else if (data.type === 'label') {
                        data.element.attr({
                            y: 270
                        });
                    }
                }
            },
        };
        // Stacked Bar chart configuration Ends
        // Line area chart 2 configuration Starts
        this.lineArea2 = {
            type: 'Line',
            data: data['lineArea2'],
            options: {
                showArea: true,
                fullWidth: true,
                lineSmooth: chartist__WEBPACK_IMPORTED_MODULE_1__["Interpolation"].none(),
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    low: 0,
                    scaleMinSpace: 50,
                }
            },
            responsiveOptions: [
                ['screen and (max-width: 640px) and (min-width: 381px)', {
                        axisX: {
                            labelInterpolationFnc: function (value, index) {
                                return index % 2 === 0 ? value : null;
                            }
                        }
                    }],
                ['screen and (max-width: 380px)', {
                        axisX: {
                            labelInterpolationFnc: function (value, index) {
                                return index % 3 === 0 ? value : null;
                            }
                        }
                    }]
            ],
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient2',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(255, 255, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(0, 201, 255, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient3',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0.3,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(255, 255, 255, 1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-opacity': '0.2',
                        'stop-color': 'rgba(132, 60, 247, 1)'
                    });
                },
                draw: function (data) {
                    var circleRadius = 4;
                    if (data.type === 'point') {
                        var circle = new chartist__WEBPACK_IMPORTED_MODULE_1__["Svg"]('circle', {
                            cx: data.x,
                            cy: data.y,
                            r: circleRadius,
                            class: 'ct-point-circle'
                        });
                        data.element.replace(circle);
                    }
                    else if (data.type === 'label') {
                        // adjust label position for rotation
                        var dX = data.width / 2 + (30 - data.width);
                        data.element.attr({ x: data.element.attr('x') - dX });
                    }
                }
            },
        };
        // Line area chart 2 configuration Ends
        // Line chart configuration Starts
        this.lineChart = {
            type: 'Line', data: data['LineDashboard'],
            options: {
                axisX: {
                    showGrid: false
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    low: 0,
                    high: 100,
                    offset: 0,
                },
                fullWidth: true,
                offset: 0,
            },
            events: {
                draw: function (data) {
                    var circleRadius = 4;
                    if (data.type === 'point') {
                        var circle = new chartist__WEBPACK_IMPORTED_MODULE_1__["Svg"]('circle', {
                            cx: data.x,
                            cy: data.y,
                            r: circleRadius,
                            class: 'ct-point-circle'
                        });
                        data.element.replace(circle);
                    }
                    else if (data.type === 'label') {
                        // adjust label position for rotation
                        var dX = data.width / 2 + (30 - data.width);
                        data.element.attr({ x: data.element.attr('x') - dX });
                    }
                }
            },
        };
        // Line chart configuration Ends
        // Donut chart configuration Starts
        this.DonutChart = {
            type: 'Pie',
            data: data['donutDashboard'],
            options: {
                donut: true,
                startAngle: 0,
                labelInterpolationFnc: function (value) {
                    var total = data['donutDashboard'].series.reduce(function (prev, series) {
                        return prev + series.value;
                    }, 0);
                    return total + '%';
                }
            },
            events: {
                draw: function (data) {
                    if (data.type === 'label') {
                        if (data.index === 0) {
                            data.element.attr({
                                dx: data.element.root().width() / 2,
                                dy: data.element.root().height() / 2
                            });
                        }
                        else {
                            data.element.remove();
                        }
                    }
                }
            }
        };
        // Donut chart configuration Ends
        //  Bar chart configuration Starts
        this.BarChart = {
            type: 'Bar', data: data['DashboardBar'], options: {
                axisX: {
                    showGrid: false,
                },
                axisY: {
                    showGrid: false,
                    showLabel: false,
                    offset: 0
                },
                low: 0,
                high: 60,
            },
            responsiveOptions: [
                ['screen and (max-width: 640px)', {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                return value[0];
                            }
                        }
                    }]
            ],
            events: {
                created: function (data) {
                    var defs = data.svg.elem('defs');
                    defs.elem('linearGradient', {
                        id: 'gradient4',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(238, 9, 121,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(255, 106, 0, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient5',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(0, 75, 145,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(120, 204, 55, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient6',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(132, 60, 247,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(56, 184, 242, 1)'
                    });
                    defs.elem('linearGradient', {
                        id: 'gradient7',
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    }).elem('stop', {
                        offset: 0,
                        'stop-color': 'rgba(155, 60, 183,1)'
                    }).parent().elem('stop', {
                        offset: 1,
                        'stop-color': 'rgba(255, 57, 111, 1)'
                    });
                },
                draw: function (data) {
                    var barHorizontalCenter, barVerticalCenter, label, value;
                    if (data.type === 'bar') {
                        data.element.attr({
                            y1: 195,
                            x1: data.x1 + 0.001
                        });
                    }
                }
            },
        };
        // Bar chart configuration Ends
        // line chart configuration Starts
        this.WidgetlineChart = {
            type: 'Line', data: data['WidgetlineChart'],
            options: {
                axisX: {
                    showGrid: true,
                    showLabel: false,
                    offset: 0,
                },
                axisY: {
                    showGrid: false,
                    low: 40,
                    showLabel: false,
                    offset: 0,
                },
                lineSmooth: chartist__WEBPACK_IMPORTED_MODULE_1__["Interpolation"].cardinal({
                    tension: 0
                }),
                fullWidth: true,
            },
        };
    }
    Dashboard2Component.prototype.ngOnInit = function () {
        this.getTotalRestaurantes();
        this.getTotalClientes();
        this.getTotalEncuestaActiva();
    };
    Dashboard2Component.prototype.getTotalRestaurantes = function () {
        var _this = this;
        this.restauranteService.getTotalRestaurantes()
            .subscribe(function (data) {
            _this.totalRestaurantes = data['resultado']['cantidad'];
        }, function (error) {
        });
    };
    Dashboard2Component.prototype.getTotalClientes = function () {
        var _this = this;
        this.clienteService.getTotalClientes()
            .subscribe(function (data) {
            _this.totalClientes = data['resultado']['cantidad'];
        }, function (error) {
        });
    };
    Dashboard2Component.prototype.getTotalEncuestaActiva = function () {
        var _this = this;
        this.encuestaService.getTotalEncuestaActiva((this.date.getMonth() + 1).toString(), this.date.getFullYear().toString())
            .subscribe(function (data) {
            _this.encuestaActual.id = data['resultado']['resultados'][0].ENCUESTA_ID;
            _this.encuestaActual.titulo = data['resultado']['resultados'][0].TITULO;
            _this.encuestaActual.cantidad = data['resultado']['resultados'][0].CANTIDAD;
        }, function (error) {
        });
    };
    Dashboard2Component = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-dashboard2',
            template: __webpack_require__(/*! ./dashboard2.component.html */ "./src/app/dashboard/dashboard2/dashboard2.component.html"),
            styles: [__webpack_require__(/*! ./dashboard2.component.scss */ "./src/app/dashboard/dashboard2/dashboard2.component.scss")]
        }),
        __metadata("design:paramtypes", [app_services_restaurante_service__WEBPACK_IMPORTED_MODULE_2__["RestauranteService"],
            app_services_cliente_service__WEBPACK_IMPORTED_MODULE_3__["ClienteService"],
            app_services_encuesta_service__WEBPACK_IMPORTED_MODULE_4__["EncuestaService"]])
    ], Dashboard2Component);
    return Dashboard2Component;
}());



/***/ })

}]);
//# sourceMappingURL=dashboard-dashboard-module.js.map
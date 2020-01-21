(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["pages-content-pages-content-pages-module"],{

/***/ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.html":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/coming-soon/coming-soon-page.component.html ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Coming soon starts-->\n<section id=\"coming-soon\">\n  <div class=\"container-fluid gradient-flickr white\">\n    <div class=\"row full-height-vh\">\n      <div class=\"col-12 d-flex align-items-center justify-content-center\">\n        <div class=\"card card-transparent box-shadow-0 no-border\">\n          <div class=\"card-body\">\n            <div class=\"text-center\">\n              <h5 class=\"card-text pb-2\">WE ARE LAUNCHING SOON.</h5>\n              <img alt=\"avtar\" class=\"img-fluid mb-2\" src=\"assets/img/logos/logo-big-white.png\" width=\"100\">\n              <h1>Apex</h1>\n              <div id=\"clockFlat\" class=\"card-text getting-started pt-1 mt-2 display-inline-block\">\n                <div class=\"clockCard px-3 py-3 mr-3 mb-3 bg-pink bg-darken-2 box-shadow-2\"> <span>57</span> <br>\n                  <p class=\"lead mt-2 mb-0\"> Weeks </p>\n                </div>\n                <div class=\"clockCard px-3 py-3 mr-3 mb-3 bg-pink bg-darken-2 box-shadow-2\"> <span>05</span> <br>\n                  <p class=\"lead mt-2 mb-0\"> Days </p>\n                </div>\n                <div class=\"clockCard px-3 py-3 mr-3 mb-3 bg-pink bg-darken-2 box-shadow-2\"> <span>11</span> <br>\n                  <p class=\"lead mt-2 mb-0\"> Hours </p>\n                </div>\n                <div class=\"clockCard px-2 py-3 mr-3 mb-3 bg-pink bg-darken-2 box-shadow-2\"> <span>12</span> <br>\n                  <p class=\"lead mt-2 mb-0\"> Minutes </p>\n                </div>\n                <div class=\"clockCard px-2 py-3 mr-3 mb-3 bg-pink bg-darken-2 box-shadow-2\"> <span>34</span> <br>\n                  <p class=\"lead mt-2 mb-0\"> Seconds </p>\n                </div>\n              </div>\n              <div class=\"col-12 pt-1\">\n                <p class=\"card-text lead\">Our website is under construction.</p>\n              </div>\n              <div class=\"col-12 text-center pt-2\">\n                <p class=\"socialIcon card-text\">\n                  <a class=\"white\"><i class=\"fa fa-facebook-square\"></i></a>\n                  <a class=\"white\"><i class=\"fa fa-twitter-square\"></i></a>\n                  <a class=\"white\"><i class=\"fa fa-google-plus-square\"></i></a>\n                  <a class=\"white\"><i class=\"fa fa-linkedin-square\"></i></a>\n                </p>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<!--Coming soon ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.scss":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/coming-soon/coming-soon-page.component.scss ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.ts":
/*!*******************************************************************************!*\
  !*** ./src/app/pages/content-pages/coming-soon/coming-soon-page.component.ts ***!
  \*******************************************************************************/
/*! exports provided: ComingSoonPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ComingSoonPageComponent", function() { return ComingSoonPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var ComingSoonPageComponent = /** @class */ (function () {
    function ComingSoonPageComponent() {
    }
    ComingSoonPageComponent.prototype.ngOnInit = function () {
        // countdown JS
        $.getScript('./assets/js/coming-soon/jquery.countdown.min.js');
        // coming soon JS start working after page load
        $.getScript('./assets/js/coming-soon/coming-soon.js');
    };
    ComingSoonPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-coming-soon-page',
            template: __webpack_require__(/*! ./coming-soon-page.component.html */ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.html"),
            styles: [__webpack_require__(/*! ./coming-soon-page.component.scss */ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.scss")]
        })
    ], ComingSoonPageComponent);
    return ComingSoonPageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/content-pages-routing.module.ts":
/*!*********************************************************************!*\
  !*** ./src/app/pages/content-pages/content-pages-routing.module.ts ***!
  \*********************************************************************/
/*! exports provided: ContentPagesRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ContentPagesRoutingModule", function() { return ContentPagesRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _coming_soon_coming_soon_page_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./coming-soon/coming-soon-page.component */ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.ts");
/* harmony import */ var _error_error_page_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./error/error-page.component */ "./src/app/pages/content-pages/error/error-page.component.ts");
/* harmony import */ var _forgot_password_forgot_password_page_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./forgot-password/forgot-password-page.component */ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.ts");
/* harmony import */ var _lock_screen_lock_screen_page_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./lock-screen/lock-screen-page.component */ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.ts");
/* harmony import */ var _login_login_page_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./login/login-page.component */ "./src/app/pages/content-pages/login/login-page.component.ts");
/* harmony import */ var _maintenance_maintenance_page_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./maintenance/maintenance-page.component */ "./src/app/pages/content-pages/maintenance/maintenance-page.component.ts");
/* harmony import */ var _register_register_page_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./register/register-page.component */ "./src/app/pages/content-pages/register/register-page.component.ts");
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
                path: 'comingsoon',
                component: _coming_soon_coming_soon_page_component__WEBPACK_IMPORTED_MODULE_2__["ComingSoonPageComponent"],
                data: {
                    title: 'Coming Soon page'
                }
            },
            {
                path: 'error',
                component: _error_error_page_component__WEBPACK_IMPORTED_MODULE_3__["ErrorPageComponent"],
                data: {
                    title: 'Error Page'
                }
            },
            {
                path: 'forgotpassword',
                component: _forgot_password_forgot_password_page_component__WEBPACK_IMPORTED_MODULE_4__["ForgotPasswordPageComponent"],
                data: {
                    title: 'Forgot Password Page'
                }
            },
            {
                path: 'lockscreen',
                component: _lock_screen_lock_screen_page_component__WEBPACK_IMPORTED_MODULE_5__["LockScreenPageComponent"],
                data: {
                    title: 'Lock Screen page'
                }
            },
            {
                path: 'login',
                component: _login_login_page_component__WEBPACK_IMPORTED_MODULE_6__["LoginPageComponent"],
                data: {
                    title: 'Login Page'
                }
            },
            {
                path: 'maintenance',
                component: _maintenance_maintenance_page_component__WEBPACK_IMPORTED_MODULE_7__["MaintenancePageComponent"],
                data: {
                    title: 'Maintenance Page'
                }
            },
            {
                path: 'register',
                component: _register_register_page_component__WEBPACK_IMPORTED_MODULE_8__["RegisterPageComponent"],
                data: {
                    title: 'Register Page'
                }
            }
        ]
    }
];
var ContentPagesRoutingModule = /** @class */ (function () {
    function ContentPagesRoutingModule() {
    }
    ContentPagesRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]],
        })
    ], ContentPagesRoutingModule);
    return ContentPagesRoutingModule;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/content-pages.module.ts":
/*!*************************************************************!*\
  !*** ./src/app/pages/content-pages/content-pages.module.ts ***!
  \*************************************************************/
/*! exports provided: ContentPagesModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ContentPagesModule", function() { return ContentPagesModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm5/common.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _content_pages_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./content-pages-routing.module */ "./src/app/pages/content-pages/content-pages-routing.module.ts");
/* harmony import */ var _coming_soon_coming_soon_page_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./coming-soon/coming-soon-page.component */ "./src/app/pages/content-pages/coming-soon/coming-soon-page.component.ts");
/* harmony import */ var _error_error_page_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./error/error-page.component */ "./src/app/pages/content-pages/error/error-page.component.ts");
/* harmony import */ var _forgot_password_forgot_password_page_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./forgot-password/forgot-password-page.component */ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.ts");
/* harmony import */ var _lock_screen_lock_screen_page_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./lock-screen/lock-screen-page.component */ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.ts");
/* harmony import */ var _login_login_page_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./login/login-page.component */ "./src/app/pages/content-pages/login/login-page.component.ts");
/* harmony import */ var _maintenance_maintenance_page_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./maintenance/maintenance-page.component */ "./src/app/pages/content-pages/maintenance/maintenance-page.component.ts");
/* harmony import */ var _register_register_page_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./register/register-page.component */ "./src/app/pages/content-pages/register/register-page.component.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};











var ContentPagesModule = /** @class */ (function () {
    function ContentPagesModule() {
    }
    ContentPagesModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _angular_common__WEBPACK_IMPORTED_MODULE_1__["CommonModule"],
                _content_pages_routing_module__WEBPACK_IMPORTED_MODULE_3__["ContentPagesRoutingModule"],
                _angular_forms__WEBPACK_IMPORTED_MODULE_2__["FormsModule"]
            ],
            declarations: [
                _coming_soon_coming_soon_page_component__WEBPACK_IMPORTED_MODULE_4__["ComingSoonPageComponent"],
                _error_error_page_component__WEBPACK_IMPORTED_MODULE_5__["ErrorPageComponent"],
                _forgot_password_forgot_password_page_component__WEBPACK_IMPORTED_MODULE_6__["ForgotPasswordPageComponent"],
                _lock_screen_lock_screen_page_component__WEBPACK_IMPORTED_MODULE_7__["LockScreenPageComponent"],
                _login_login_page_component__WEBPACK_IMPORTED_MODULE_8__["LoginPageComponent"],
                _maintenance_maintenance_page_component__WEBPACK_IMPORTED_MODULE_9__["MaintenancePageComponent"],
                _register_register_page_component__WEBPACK_IMPORTED_MODULE_10__["RegisterPageComponent"]
            ]
        })
    ], ContentPagesModule);
    return ContentPagesModule;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/error/error-page.component.html":
/*!*********************************************************************!*\
  !*** ./src/app/pages/content-pages/error/error-page.component.html ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Error page starts-->\n<section id=\"error\">\n    <div class=\"container-fluid bg-grey bg-lighten-3\">\n        <div class=\"container\">\n            <div class=\"row full-height-vh\">\n                <div class=\"col-md-12 col-lg-3 ml-auto d-flex align-items-center\">\n                    <div class=\"row text-center mb-3\">\n                        <div class=\"col-12\">\n                            <h4 class=\"grey darken-2 font-large-5\">Opps...</h4>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"col-md-12 col-lg-8 d-flex align-items-center justify-content-center\">\n                    <div class=\"error-container\">\n                        <div class=\"no-border\">\n                            <div class=\"text-center text-bold-700 grey darken-2 mt-5\" style=\"font-size: 11rem; margin-bottom: 4rem;\">404</div>\n                        </div>\n                        <div class=\"error-body\">\n                            <fieldset class=\"row py-2\">\n                                <div class=\"col-12\">\n                                    <div class=\"text-center text-bold-100 grey darken-2 mt-2\" style=\"font-size: 2rem; margin-bottom: 1rem;\">La pagina que esta buscando no existe</div>\n                                </div>\n                            </fieldset>\n                            <div class=\"row py-2 justify-content-center\">\n                                <div class=\"col-8\">\n                                    <a class=\"btn btn-brown btn-raised btn-block font-medium-2\" [routerLink]=\"['/pages/login']\"><i class=\"ft-home\"></i> Volver al Login</a>\n                                </div>\n                            </div>\n                        </div>\n                        <div class=\"error-footer bg-transparent\">\n                            <div class=\"row\">\n                                <p class=\"text-muted text-center col-12 py-1\">© Copyright 2019 <a href=\"http://massvision.tv/\" target=\"_blank\">MASSVISION</a>, All rights reserved. </p>\n                                \n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Error page ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/error/error-page.component.scss":
/*!*********************************************************************!*\
  !*** ./src/app/pages/content-pages/error/error-page.component.scss ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/error/error-page.component.ts":
/*!*******************************************************************!*\
  !*** ./src/app/pages/content-pages/error/error-page.component.ts ***!
  \*******************************************************************/
/*! exports provided: ErrorPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ErrorPageComponent", function() { return ErrorPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var ErrorPageComponent = /** @class */ (function () {
    function ErrorPageComponent() {
    }
    ErrorPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-error-page',
            template: __webpack_require__(/*! ./error-page.component.html */ "./src/app/pages/content-pages/error/error-page.component.html"),
            styles: [__webpack_require__(/*! ./error-page.component.scss */ "./src/app/pages/content-pages/error/error-page.component.scss")]
        })
    ], ErrorPageComponent);
    return ErrorPageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.html":
/*!*****************************************************************************************!*\
  !*** ./src/app/pages/content-pages/forgot-password/forgot-password-page.component.html ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Forgot Password Starts-->\n<section id=\"forgot-password\" style=\"background-image: url('assets/img/photos/restaurante4.jpg');background-size: cover;\">\n    <div class=\"container-fluid\" style=\"background-color:rgb(0, 0, 0,0.5)\">\n        <div class=\"row text-left full-height-vh\">\n            <div class=\"col-12 d-flex align-items-center justify-content-center\">\n                <div class=\"card bg-blue-grey bg-darken-3 px-4\">\n                    <div class=\"card-header\">\n                        <div class=\"card-image text-center\">\n                            <i class=\"fa fa-key font-large-5 blue-grey lighten-4\"></i>\n                        </div>\n                    </div>\n                    <div class=\"card-body\">\n                        <div class=\"card-block\">\n                            <div class=\"text-center\">\n                                <h4 class=\"text-uppercase text-bold-400 white\">Recuperar clave</h4>\n                            </div>\n                            <form class=\"pt-4\" (ngSubmit)=\"onSubmit()\" #f=\"ngForm\">\n                                <div class=\"form-group\" align=\"center\">\n                                    <p class=\"white\">\n                                        Ingrese su dirección de correo electrónico <br>y le enviaremos una clave temporal.\n                                    </p>\n                                </div>\n                                <div class=\"form-group\">\n                                    <input type=\"email\" class=\"form-control\" name=\"inputEmail\" id=\"inputEmail\" [(ngModel)]=\"correo\" placeholder=\"Su correo electrónico\">\n                                </div>\n                                <div class=\"form-group pt-2\">\n                                    <div class=\"text-center mt-3\">\n                                        <button type=\"button\" class=\"btn btn-danger btn-raised btn-block\" (click)=\"enviarCorreo()\">Enviar correo</button>\n                                        <button type=\"button\" class=\"btn btn-secondary btn-raised btn-block\" (click)=\"onLogin()\">Volver a Login</button>\n                                    </div>\n                                </div>\n                            </form>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Forgot Password Ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.scss":
/*!*****************************************************************************************!*\
  !*** ./src/app/pages/content-pages/forgot-password/forgot-password-page.component.scss ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.ts":
/*!***************************************************************************************!*\
  !*** ./src/app/pages/content-pages/forgot-password/forgot-password-page.component.ts ***!
  \***************************************************************************************/
/*! exports provided: ForgotPasswordPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ForgotPasswordPageComponent", function() { return ForgotPasswordPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var app_services_usuario_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! app/_services/usuario.service */ "./src/app/_services/usuario.service.ts");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_4__);
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var ForgotPasswordPageComponent = /** @class */ (function () {
    function ForgotPasswordPageComponent(router, route, usuarioService) {
        this.router = router;
        this.route = route;
        this.usuarioService = usuarioService;
    }
    // On submit click, reset form fields
    ForgotPasswordPageComponent.prototype.onSubmit = function () {
        this.forogtPasswordForm.reset();
    };
    // On login link click
    ForgotPasswordPageComponent.prototype.onLogin = function () {
        this.router.navigate(['login'], { relativeTo: this.route.parent });
    };
    // On registration link click
    ForgotPasswordPageComponent.prototype.onRegister = function () {
        this.router.navigate(['register'], { relativeTo: this.route.parent });
    };
    ForgotPasswordPageComponent.prototype.enviarCorreo = function () {
        var _this = this;
        this.usuarioService.generarPass(this.correo)
            .subscribe(function (data) {
            if (data['status'] == 404) {
                sweetalert2__WEBPACK_IMPORTED_MODULE_4___default()({ title: 'Error al generar clave', text: data['resultado'], type: "error", showConfirmButton: true })
                    .then(function (result) {
                    if (result.value)
                        _this.router.navigate(['/pages/forgotpassword']);
                });
            }
            else {
                sweetalert2__WEBPACK_IMPORTED_MODULE_4___default()({ title: _this.correo, text: data['resultado'], type: "success", showConfirmButton: true })
                    .then(function (result) {
                    if (result.value)
                        _this.router.navigate(['/pages/login']);
                });
            }
        }, function (error) {
        });
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", _angular_forms__WEBPACK_IMPORTED_MODULE_1__["NgForm"])
    ], ForgotPasswordPageComponent.prototype, "forogtPasswordForm", void 0);
    ForgotPasswordPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-forgot-password-page',
            template: __webpack_require__(/*! ./forgot-password-page.component.html */ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.html"),
            styles: [__webpack_require__(/*! ./forgot-password-page.component.scss */ "./src/app/pages/content-pages/forgot-password/forgot-password-page.component.scss")]
        }),
        __metadata("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"],
            _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"],
            app_services_usuario_service__WEBPACK_IMPORTED_MODULE_3__["UsuarioService"]])
    ], ForgotPasswordPageComponent);
    return ForgotPasswordPageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.html":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/lock-screen/lock-screen-page.component.html ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Lock Screen Starts-->\n<section id=\"lock-screen\">\n    <div class=\"container-fluid gradient-crystal-clear\">\n        <div class=\"row full-height-vh\">\n            <div class=\"col-12 d-flex align-items-center justify-content-center\">\n                <div class=\"card width-400\">\n                    <div class=\"row\">\n                        <div class=\"col-sm-8\">\n                            <div class=\"card-title font-medium-5 pt-2 ml-2\">Peter Andil</div>\n                        </div>\n                        <div class=\"col-sm-4\">\n                            <div class=\"text-right card-img overlap\">\n                                <img alt=\"avtar\" class=\"mb-1\" src=\"assets/img/portrait/avatars/avatar-03.png\" width=\"150\">\n                            </div>                   \n                        </div>\n                    </div>\n                    <div class=\"card-body\">\n                        <div class=\"card-block\">\n                            <form (ngSubmit)=\"onSubmit()\" #f=\"ngForm\" novalidate=\"\">\n                                <div class=\"form-group mt-3\">\n                                    <h3 class=\"text-center text-uppercase text-bold-400\">Unlock User</h3>\n                                </div>\n                                <div class=\"form-group pt-3\">\n                                    <input type=\"password\" class=\"form-control\" id=\"inputPass\" name=\"inputPass\" placeholder=\"Password\" ngModel required>\n                                </div>\n                                <div class=\"form-group\">\n                                    <div class=\"text-center mt-3\">\n                                        <button type=\"button\" class=\"btn btn-info btn-raised btn-lg py-1 mt-3 font-small-5 btn-block\">Unlock</button>\n                                    </div>\n                                </div>\n                            </form>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Lock Screen Ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.scss":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/lock-screen/lock-screen-page.component.scss ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.ts":
/*!*******************************************************************************!*\
  !*** ./src/app/pages/content-pages/lock-screen/lock-screen-page.component.ts ***!
  \*******************************************************************************/
/*! exports provided: LockScreenPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LockScreenPageComponent", function() { return LockScreenPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var LockScreenPageComponent = /** @class */ (function () {
    function LockScreenPageComponent() {
    }
    LockScreenPageComponent.prototype.onSubmit = function () {
        this.lockScreenForm.reset();
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", _angular_forms__WEBPACK_IMPORTED_MODULE_1__["NgForm"])
    ], LockScreenPageComponent.prototype, "lockScreenForm", void 0);
    LockScreenPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-lock-screen-page',
            template: __webpack_require__(/*! ./lock-screen-page.component.html */ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.html"),
            styles: [__webpack_require__(/*! ./lock-screen-page.component.scss */ "./src/app/pages/content-pages/lock-screen/lock-screen-page.component.scss")]
        })
    ], LockScreenPageComponent);
    return LockScreenPageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/login/login-page.component.html":
/*!*********************************************************************!*\
  !*** ./src/app/pages/content-pages/login/login-page.component.html ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Login Page Starts-->\n<section id=\"login\" [style.background]=\"'url('+ruta_bg+')'\" style.background-size =\"{{'cover'}}\">\n    <div class=\"container-fluid\" style=\"background-color:rgb(0, 0, 0,0.5)\">\n        <div class=\"row full-height-vh\">\n            <div class=\"col-12 d-flex align-items-center justify-content-center\">\n                <div class=\"card gradient-massvision text-center width-400\">\n                    <div class=\"card-img \">\n                        <img alt=\"element 06\" class=\"mb-1 mt-3\" src=\"assets/img/logos/bitte-logo.png\" width=\"190\">\n                    </div>\n                    <div class=\"card-body\">\n                        <div class=\"card-block\">\n                            <h2 class=\"white\">Login</h2>\n                            <form novalidate=\"\" (ngSubmit)=\"login()\" #f=\"ngForm\">\n                                <div class=\"form-group\">\n                                    <div class=\"col-md-12\">\n                                        <input type=\"text\" class=\"form-control\" name=\"inputEmail\" id=\"inputEmail\" placeholder=\"Email\" [(ngModel)]=\"user.CORREO\" required >\n                                    </div>\n                                </div>\n\n                                <div class=\"form-group\">\n                                    <div class=\"col-md-12\">\n                                        <input type=\"password\" class=\"form-control\" name=\"inputPass\" id=\"inputPass\" placeholder=\"Password\" [(ngModel)]=\"user.CLAVE\" required>\n                                    </div>\n                                </div>\n\n                                <div class=\"form-group\">\n                                    <div class=\"col-md-12\">\n                                        <button type=\"submit\" class=\"btn btn-block btn-raised\" style=\"background-color: #65a8ea;color: #ffffff\">Iniciar Sesion</button>\n                                    </div>\n                                </div>\n\n                                <div class=\"form-group\">\n                                    <div class=\"col-md-12 text-center\">\n                                        <div *ngIf=\"loading\" style=\"width: 3rem; height: 3rem;\"  class=\"spinner-border text-default\" role=\"status\">\n                                            <span class=\"sr-only\">Loading...</span>\n                                        </div>\n                                    </div>\n                                </div>\n                                \n                            </form>\n                        </div>\n                    </div>\n                    <div class=\"card-footer\">\n                        <div class=\"float-left\"><a (click)=\"onForgotPassword()\" class=\"white\">Recuperar Contraseña</a></div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Login Page Ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/login/login-page.component.scss":
/*!*********************************************************************!*\
  !*** ./src/app/pages/content-pages/login/login-page.component.scss ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/login/login-page.component.ts":
/*!*******************************************************************!*\
  !*** ./src/app/pages/content-pages/login/login-page.component.ts ***!
  \*******************************************************************/
/*! exports provided: LoginPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LoginPageComponent", function() { return LoginPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var ngx_toastr__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ngx-toastr */ "./node_modules/ngx-toastr/fesm5/ngx-toastr.js");
/* harmony import */ var app_services_login_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! app/_services/login.service */ "./src/app/_services/login.service.ts");
/* harmony import */ var app_services_usuario_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! app/_services/usuario.service */ "./src/app/_services/usuario.service.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






var LoginPageComponent = /** @class */ (function () {
    function LoginPageComponent(router, route, toastr, loginService, usuarioService) {
        this.router = router;
        this.route = route;
        this.toastr = toastr;
        this.loginService = loginService;
        this.usuarioService = usuarioService;
        this.user = {
            CORREO: '',
            CLAVE: ''
        };
        toastr.toastrConfig.timeOut = 3000;
        this.ruta_bg = "assets/img/photos/";
        this.num_bg = (Math.floor(Math.random() * 3) + 1);
        this.ruta_bg += this.num_bg == 1 ? 'restaurante1.jpg' : this.num_bg == 2 ? 'restaurante2.jpg' : 'restaurante3.jpg';
        this.permisos = [];
        this.loading = false;
    }
    LoginPageComponent.prototype.ngOnInit = function () {
        localStorage.removeItem('usuario');
        localStorage.removeItem('permisos');
    };
    // On submit button click    
    LoginPageComponent.prototype.onSubmit = function () {
    };
    // On Forgot password link click
    LoginPageComponent.prototype.onForgotPassword = function () {
        this.router.navigate(['forgotpassword'], { relativeTo: this.route.parent });
    };
    // On registration link click
    LoginPageComponent.prototype.onRegister = function () {
        this.router.navigate(['register'], { relativeTo: this.route.parent });
    };
    LoginPageComponent.prototype.login = function () {
        var _this = this;
        if (this.loginForm.valid) {
            this.loading = true;
            this.loginService.login(this.user.CORREO, this.user.CLAVE)
                .subscribe(function (data) {
                if (data['resultado']['resultados'] == null) {
                    _this.loading = false;
                    _this.toastr.warning('Usuario y/o contraseña incorrectos', 'Datos incorrectos');
                }
                else {
                    localStorage.setItem('usuario', JSON.stringify(data['resultado']['resultados'][0]));
                    _this.getPermisos(data['resultado']['resultados'][0]['ID_USUARIO']);
                }
            }, function (error) {
                _this.toastr.warning('Hubo un error, comuniquese con el dpto de sistemas', 'Error');
                _this.loading = false;
            });
        }
        else {
            this.toastr.warning('Ingrese usuario y contraseña', 'Datos incompletos');
        }
    };
    LoginPageComponent.prototype.getPermisos = function (idUsuario) {
        var _this = this;
        this.usuarioService.getPermisosByUsuario(idUsuario)
            .subscribe(function (data) {
            _this.loading = false;
            _this.permisos = data['resultado']['resultados'];
            localStorage.setItem('permisos', JSON.stringify(data['resultado']['resultados']));
            var usuario = JSON.parse(localStorage.getItem('usuario'));
            _this.router.navigate(['/dashboard/dashboard1']);
        }, function (error) {
            _this.loading = false;
            _this.toastr.warning('Hubo un error, comuniquese con el dpto de sistemas', 'Error');
        });
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", _angular_forms__WEBPACK_IMPORTED_MODULE_1__["NgForm"])
    ], LoginPageComponent.prototype, "loginForm", void 0);
    LoginPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-login-page',
            template: __webpack_require__(/*! ./login-page.component.html */ "./src/app/pages/content-pages/login/login-page.component.html"),
            styles: [__webpack_require__(/*! ./login-page.component.scss */ "./src/app/pages/content-pages/login/login-page.component.scss")]
        }),
        __metadata("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"],
            _angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"],
            ngx_toastr__WEBPACK_IMPORTED_MODULE_3__["ToastrService"],
            app_services_login_service__WEBPACK_IMPORTED_MODULE_4__["LoginService"],
            app_services_usuario_service__WEBPACK_IMPORTED_MODULE_5__["UsuarioService"]])
    ], LoginPageComponent);
    return LoginPageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/maintenance/maintenance-page.component.html":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/maintenance/maintenance-page.component.html ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Under Maintenance Starts-->\n<section id=\"maintenance\">\n    <div class=\"container-fluid gradient-ibiza-sunset\">\n        <div class=\"row full-height-vh\">\n            <div class=\"col-12 d-flex align-items-center justify-content-center\">\n                <div class=\"card border-grey border-lighten-3 px-1 py-1 box-shadow-3\">\n                    <div class=\"card-block\">\n                        <span class=\"card-title text-center\">\n                        <img alt=\"avtar\" class=\"img-fluid mx-auto d-block pt-2 mb-1\" src=\"assets/img/logos/logo-color-big.png\" width=\"100\">\n                    </span>\n                    </div>\n                    <div class=\"card-block text-center\">\n                        <h3>This page is under maintenance</h3>\n                        <p>We're sorry for the inconvenience.\n                            <br> Please come back later.</p>\n                        <div class=\"mt-2\"><i class=\"fa fa-cog spinner font-large-2\"></i></div>\n                    </div>\n                    <hr>\n                    <p class=\"socialIcon card-text text-center pt-2 pb-2\">\n                        <a class=\"btn btn-social-icon mr-1 mb-1 btn-outline-facebook\">\n                        <span class=\"fa fa-facebook\"></span>\n                    </a>\n                        <a class=\"btn btn-social-icon mr-1 mb-1 btn-outline-twitter\">\n                        <span class=\"fa fa-twitter\"></span>\n                    </a>\n                        <a class=\"btn btn-social-icon mr-1 mb-1 btn-outline-linkedin\">\n                        <span class=\"fa fa-linkedin font-medium-4\"></span>\n                    </a>\n                        <a class=\"btn btn-social-icon mr-1 mb-1 btn-outline-github\">\n                        <span class=\"fa fa-github font-medium-4\"></span>\n                    </a>\n                    </p>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Under Maintenance Starts-->"

/***/ }),

/***/ "./src/app/pages/content-pages/maintenance/maintenance-page.component.scss":
/*!*********************************************************************************!*\
  !*** ./src/app/pages/content-pages/maintenance/maintenance-page.component.scss ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/maintenance/maintenance-page.component.ts":
/*!*******************************************************************************!*\
  !*** ./src/app/pages/content-pages/maintenance/maintenance-page.component.ts ***!
  \*******************************************************************************/
/*! exports provided: MaintenancePageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MaintenancePageComponent", function() { return MaintenancePageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var MaintenancePageComponent = /** @class */ (function () {
    function MaintenancePageComponent() {
    }
    MaintenancePageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-maintenance-page',
            template: __webpack_require__(/*! ./maintenance-page.component.html */ "./src/app/pages/content-pages/maintenance/maintenance-page.component.html"),
            styles: [__webpack_require__(/*! ./maintenance-page.component.scss */ "./src/app/pages/content-pages/maintenance/maintenance-page.component.scss")]
        })
    ], MaintenancePageComponent);
    return MaintenancePageComponent;
}());



/***/ }),

/***/ "./src/app/pages/content-pages/register/register-page.component.html":
/*!***************************************************************************!*\
  !*** ./src/app/pages/content-pages/register/register-page.component.html ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<!--Registration Page Starts-->\n<section id=\"regestration\">\n    <div class=\"container\">\n        <div class=\"row full-height-vh\">\n            <div class=\"col-12 d-flex align-items-center justify-content-center\">\n                <div class=\"card\">\n                    <div class=\"card-body\">\n                        <div class=\"row d-flex\">\n                            <div class=\"col-12 col-sm-12 col-md-6 gradient-deep-orange-orange\">\n                                <div class=\"card-block\">\n                                    <div class=\"card-img overlap\">  \n                                        <img alt=\"Card image cap\" src=\"assets/img/elements/13.png\" width=\"350\" class=\"mx-auto d-block\">\n                                    </div>\n                                    <h2 class=\"card-title font-large-1 text-center white mt-3\">Registration</h2>\n                                </div>\n                            </div>\n                            <div class=\"col-12 col-sm-12 col-md-6 d-flex align-items-center\">\n                                <div class=\"card-block mx-auto\">\n                                    <form   (ngSubmit)=\"onSubmit()\" #f=\"ngForm\">\n                                        <div class=\"input-group mb-3\">\n                                            <div class=\"input-group-prepend\">\n                                                <span class=\"input-group-text\">\n                                                    <i class=\"icon-user\"></i>\n                                                </span>\n                                            </div>\n                                            <input type=\"text\" class=\"form-control\" name=\"fname\" id=\"fname\" placeholder=\"Name\" ngModel required >\n                                        </div>\n                                        <div class=\"input-group mb-3\">\n                                            <div class=\"input-group-prepend\">\n                                                <span class=\"input-group-text\">\n                                                    <i class=\"ft-mail\"></i>\n                                                </span>\n                                            </div>\n                                            <input type=\"email\" class=\"form-control\" name=\"inputEmail\" id=\"inputEmail\" placeholder=\"Email\" ngModel required email >\n                                        </div>\n                                        <div class=\"input-group mb-3\">\n                                            <div class=\"input-group-prepend\">\n                                                <span class=\"input-group-text\">\n                                                    <i class=\"ft-lock\"></i>\n                                                </span>\n                                            </div>\n                                            <input type=\"password\" class=\"form-control\" name=\"inputPass\" id=\"inputPass\" placeholder=\"Password\" ngModel required >\n                                        </div>\n                                        <div class=\"form-group col-sm-offset-1\">\n                                            <div class=\"custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0\">\n                                                <input type=\"checkbox\" class=\"custom-control-input\" checked id=\"terms\">\n                                                <label class=\"custom-control-label pl-2\" for=\"terms\">I agree <a>terms and conditions</a></label>\n                                            </div>\n                                        </div>\n                                        <div class=\"form-group text-center\">\n                                            <button type=\"button\" class=\"btn btn-warning btn-raised\" [disabled]=\"!f.valid\">Get Started</button>\n                                        </div>\n                                    </form>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n    </div>\n</section>\n<!--Registration Page Ends-->"

/***/ }),

/***/ "./src/app/pages/content-pages/register/register-page.component.scss":
/*!***************************************************************************!*\
  !*** ./src/app/pages/content-pages/register/register-page.component.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/pages/content-pages/register/register-page.component.ts":
/*!*************************************************************************!*\
  !*** ./src/app/pages/content-pages/register/register-page.component.ts ***!
  \*************************************************************************/
/*! exports provided: RegisterPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "RegisterPageComponent", function() { return RegisterPageComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm5/forms.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var RegisterPageComponent = /** @class */ (function () {
    function RegisterPageComponent() {
    }
    //  On submit click, reset field value
    RegisterPageComponent.prototype.onSubmit = function () {
        this.registerForm.reset();
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", _angular_forms__WEBPACK_IMPORTED_MODULE_1__["NgForm"])
    ], RegisterPageComponent.prototype, "registerForm", void 0);
    RegisterPageComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            selector: 'app-register-page',
            template: __webpack_require__(/*! ./register-page.component.html */ "./src/app/pages/content-pages/register/register-page.component.html"),
            styles: [__webpack_require__(/*! ./register-page.component.scss */ "./src/app/pages/content-pages/register/register-page.component.scss")]
        })
    ], RegisterPageComponent);
    return RegisterPageComponent;
}());



/***/ })

}]);
//# sourceMappingURL=pages-content-pages-content-pages-module.js.map
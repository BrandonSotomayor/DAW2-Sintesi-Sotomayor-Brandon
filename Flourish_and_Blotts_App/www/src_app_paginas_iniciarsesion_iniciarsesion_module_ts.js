"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_iniciarsesion_iniciarsesion_module_ts"],{

/***/ 9677:
/*!***********************************************************************!*\
  !*** ./src/app/paginas/iniciarsesion/iniciarsesion-routing.module.ts ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "IniciarsesionPageRoutingModule": () => (/* binding */ IniciarsesionPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _iniciarsesion_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./iniciarsesion.page */ 544);




const routes = [
    {
        path: '',
        component: _iniciarsesion_page__WEBPACK_IMPORTED_MODULE_0__.IniciarsesionPage
    }
];
let IniciarsesionPageRoutingModule = class IniciarsesionPageRoutingModule {
};
IniciarsesionPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], IniciarsesionPageRoutingModule);



/***/ }),

/***/ 812:
/*!***************************************************************!*\
  !*** ./src/app/paginas/iniciarsesion/iniciarsesion.module.ts ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "IniciarsesionPageModule": () => (/* binding */ IniciarsesionPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _iniciarsesion_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./iniciarsesion-routing.module */ 9677);
/* harmony import */ var _iniciarsesion_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./iniciarsesion.page */ 544);







let IniciarsesionPageModule = class IniciarsesionPageModule {
};
IniciarsesionPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _iniciarsesion_routing_module__WEBPACK_IMPORTED_MODULE_0__.IniciarsesionPageRoutingModule
        ],
        declarations: [_iniciarsesion_page__WEBPACK_IMPORTED_MODULE_1__.IniciarsesionPage]
    })
], IniciarsesionPageModule);



/***/ }),

/***/ 544:
/*!*************************************************************!*\
  !*** ./src/app/paginas/iniciarsesion/iniciarsesion.page.ts ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "IniciarsesionPage": () => (/* binding */ IniciarsesionPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _iniciarsesion_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./iniciarsesion.page.html?ngResource */ 7348);
/* harmony import */ var _iniciarsesion_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./iniciarsesion.page.scss?ngResource */ 186);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common/http */ 8784);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/auth.service */ 6893);







let IniciarsesionPage = class IniciarsesionPage {
    constructor(_router, _authService, _http) {
        this._router = _router;
        this._authService = _authService;
        this._http = _http;
        this.BASE_URL = "http://localhost:80/api";
        this.correo_electronico = '';
        this.contrasena = '';
        if (this._authService.isUserAuthenticated()) {
            this._router.navigate(["paginas", 'privada-administrador']);
            console.log('cesion iniciada');
        }
        else {
            this._router.navigate(["paginas", 'iniciarsesion']);
            console.log('cesion no iniciada');
        }
    }
    iniciar_sesion() {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_3__.__awaiter)(this, void 0, void 0, function* () {
            /*L'estructura try/catch ens permet gestionar qualsevol error de xarxa en la
            comunicació amb el servidor*/
            try {
                const response = yield this._authService.login(this.correo_electronico, this.contrasena);
                if (response) {
                    this._router.navigate(["paginas", 'privada-administrador']);
                }
            }
            catch (error) {
                console.log("Error!");
            }
        });
    }
    ngOnInit() {
    }
};
IniciarsesionPage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_4__.Router },
    { type: src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__.AuthService },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_5__.HttpClient }
];
IniciarsesionPage = (0,tslib__WEBPACK_IMPORTED_MODULE_3__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_6__.Component)({
        selector: 'app-iniciarsesion',
        template: _iniciarsesion_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_iniciarsesion_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], IniciarsesionPage);



/***/ }),

/***/ 186:
/*!**************************************************************************!*\
  !*** ./src/app/paginas/iniciarsesion/iniciarsesion.page.scss?ngResource ***!
  \**************************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJpbmljaWFyc2VzaW9uLnBhZ2Uuc2NzcyJ9 */";

/***/ }),

/***/ 7348:
/*!**************************************************************************!*\
  !*** ./src/app/paginas/iniciarsesion/iniciarsesion.page.html?ngResource ***!
  \**************************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Iniciar Sesión</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n  <ion-grid>\n    <ion-row>\n      <ion-col></ion-col>\n      <ion-col size=\"8\">\n        <ion-item>\n          <ion-label position=\"floating\">Correo Electrónico</ion-label>\n          <ion-input placeholder=\"Correo Electrónico\" [(ngModel)]=\"correo_electronico\"></ion-input>\n        </ion-item>\n        <ion-item>\n          <ion-label position=\"floating\">Contraseña</ion-label>\n          <ion-input type=\"password\" placeholder=\"Password\" [(ngModel)]=\"contrasena\"></ion-input>\n        </ion-item>\n      </ion-col>\n      <ion-col></ion-col>\n    </ion-row>\n\n    <ion-row>\n      <ion-col size=\"2\"></ion-col>\n      <ion-col><ion-button color=\"dark\" (click)=\"iniciar_sesion()\">Entrar<ion-icon name=\"log-in-outline\"></ion-icon></ion-button></ion-col>\n      <ion-col><ion-button [routerLink]=\"['/register']\" color=\"medium\">Registrarme</ion-button></ion-col>\n      <ion-col size=\"2\"></ion-col>\n    </ion-row>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_iniciarsesion_iniciarsesion_module_ts.js.map
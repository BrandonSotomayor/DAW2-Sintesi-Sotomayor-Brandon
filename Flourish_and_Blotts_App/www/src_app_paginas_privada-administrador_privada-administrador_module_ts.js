"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_privada-administrador_privada-administrador_module_ts"],{

/***/ 540:
/*!***************************************************************************************!*\
  !*** ./src/app/paginas/privada-administrador/privada-administrador-routing.module.ts ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PrivadaAdministradorPageRoutingModule": () => (/* binding */ PrivadaAdministradorPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _privada_administrador_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./privada-administrador.page */ 111);




const routes = [
    {
        path: '',
        component: _privada_administrador_page__WEBPACK_IMPORTED_MODULE_0__.PrivadaAdministradorPage
    }
];
let PrivadaAdministradorPageRoutingModule = class PrivadaAdministradorPageRoutingModule {
};
PrivadaAdministradorPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], PrivadaAdministradorPageRoutingModule);



/***/ }),

/***/ 7810:
/*!*******************************************************************************!*\
  !*** ./src/app/paginas/privada-administrador/privada-administrador.module.ts ***!
  \*******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PrivadaAdministradorPageModule": () => (/* binding */ PrivadaAdministradorPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _privada_administrador_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./privada-administrador-routing.module */ 540);
/* harmony import */ var _privada_administrador_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./privada-administrador.page */ 111);







let PrivadaAdministradorPageModule = class PrivadaAdministradorPageModule {
};
PrivadaAdministradorPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _privada_administrador_routing_module__WEBPACK_IMPORTED_MODULE_0__.PrivadaAdministradorPageRoutingModule
        ],
        declarations: [_privada_administrador_page__WEBPACK_IMPORTED_MODULE_1__.PrivadaAdministradorPage]
    })
], PrivadaAdministradorPageModule);



/***/ }),

/***/ 111:
/*!*****************************************************************************!*\
  !*** ./src/app/paginas/privada-administrador/privada-administrador.page.ts ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PrivadaAdministradorPage": () => (/* binding */ PrivadaAdministradorPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _privada_administrador_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./privada-administrador.page.html?ngResource */ 8991);
/* harmony import */ var _privada_administrador_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./privada-administrador.page.scss?ngResource */ 3099);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/auth.service */ 6893);






let PrivadaAdministradorPage = class PrivadaAdministradorPage {
    constructor(_router, _authService) {
        this._router = _router;
        this._authService = _authService;
        if (this._authService.isUserAuthenticated()) {
            this._router.navigate(["paginas", 'privada-administrador']);
        }
        else
            this._router.navigate(["paginas", 'iniciarsesion']);
    }
    rol() {
        this._authService.rol();
    }
    cerrar() {
        this._authService.logout();
        this._router.navigate(['paginas', 'iniciarsesion']);
    }
    ngOnInit() {
    }
};
PrivadaAdministradorPage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__.Router },
    { type: src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__.AuthService }
];
PrivadaAdministradorPage = (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_5__.Component)({
        selector: 'app-privada-administrador',
        template: _privada_administrador_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_privada_administrador_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], PrivadaAdministradorPage);



/***/ }),

/***/ 3099:
/*!******************************************************************************************!*\
  !*** ./src/app/paginas/privada-administrador/privada-administrador.page.scss?ngResource ***!
  \******************************************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJwcml2YWRhLWFkbWluaXN0cmFkb3IucGFnZS5zY3NzIn0= */";

/***/ }),

/***/ 8991:
/*!******************************************************************************************!*\
  !*** ./src/app/paginas/privada-administrador/privada-administrador.page.html?ngResource ***!
  \******************************************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Privada Administrador</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n\n  <ion-grid>\n    <ion-row>\n      <ion-col></ion-col>\n      <ion-col size=\"3\">\n        <ion-button color=\"dark\" (click)=\"cerrar()\">Cerrar Sesión</ion-button>\n      </ion-col>\n      <ion-col size=\"1\"></ion-col>\n    </ion-row>\n    <ion-row>\n      <ion-button (click)=\"rol()\">Obtener rol</ion-button>\n    </ion-row>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_privada-administrador_privada-administrador_module_ts.js.map
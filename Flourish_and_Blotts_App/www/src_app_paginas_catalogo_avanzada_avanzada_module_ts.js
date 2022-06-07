"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_catalogo_avanzada_avanzada_module_ts"],{

/***/ 107:
/*!**********************************************************************!*\
  !*** ./src/app/paginas/catalogo/avanzada/avanzada-routing.module.ts ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AvanzadaPageRoutingModule": () => (/* binding */ AvanzadaPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _avanzada_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./avanzada.page */ 2964);




const routes = [
    {
        path: '',
        component: _avanzada_page__WEBPACK_IMPORTED_MODULE_0__.AvanzadaPage
    }
];
let AvanzadaPageRoutingModule = class AvanzadaPageRoutingModule {
};
AvanzadaPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], AvanzadaPageRoutingModule);



/***/ }),

/***/ 2785:
/*!**************************************************************!*\
  !*** ./src/app/paginas/catalogo/avanzada/avanzada.module.ts ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AvanzadaPageModule": () => (/* binding */ AvanzadaPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _avanzada_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./avanzada-routing.module */ 107);
/* harmony import */ var _avanzada_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./avanzada.page */ 2964);







let AvanzadaPageModule = class AvanzadaPageModule {
};
AvanzadaPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _avanzada_routing_module__WEBPACK_IMPORTED_MODULE_0__.AvanzadaPageRoutingModule
        ],
        declarations: [_avanzada_page__WEBPACK_IMPORTED_MODULE_1__.AvanzadaPage]
    })
], AvanzadaPageModule);



/***/ }),

/***/ 2964:
/*!************************************************************!*\
  !*** ./src/app/paginas/catalogo/avanzada/avanzada.page.ts ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AvanzadaPage": () => (/* binding */ AvanzadaPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _avanzada_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./avanzada.page.html?ngResource */ 4810);
/* harmony import */ var _avanzada_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./avanzada.page.scss?ngResource */ 9520);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/publica.service */ 9480);






let AvanzadaPage = class AvanzadaPage {
    constructor(_router, _publicaS) {
        this._router = _router;
        this._publicaS = _publicaS;
        this.autor = '';
        this.titulo = '';
        this.categoria = '';
    }
    busqueda_avanzada() {
        this._publicaS.busqueda_avanzada(this.autor, this.titulo, this.categoria);
    }
    ngOnInit() {
    }
};
AvanzadaPage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__.Router },
    { type: src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__.PublicaService }
];
AvanzadaPage = (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_5__.Component)({
        selector: 'app-avanzada',
        template: _avanzada_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_avanzada_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], AvanzadaPage);



/***/ }),

/***/ 9520:
/*!*************************************************************************!*\
  !*** ./src/app/paginas/catalogo/avanzada/avanzada.page.scss?ngResource ***!
  \*************************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJhdmFuemFkYS5wYWdlLnNjc3MifQ== */";

/***/ }),

/***/ 4810:
/*!*************************************************************************!*\
  !*** ./src/app/paginas/catalogo/avanzada/avanzada.page.html?ngResource ***!
  \*************************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Catálogo</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n  \n  <ion-grid>\n    <ion-row>\n      <ion-col size=\"9\">\n        <ion-item>\n          <ion-label position=\"floating\">Autor</ion-label>\n          <ion-input [(ngModel)]=\"autor\"></ion-input>\n        </ion-item>\n        <ion-item>\n          <ion-label position=\"floating\">Título</ion-label>\n          <ion-input [(ngModel)]=\"titulo\"></ion-input>\n        </ion-item>\n        <ion-item>\n          <ion-label position=\"floating\">Categoria</ion-label>\n          <ion-input [(ngModel)]=\"categoria\"></ion-input>\n        </ion-item>\n      </ion-col>\n      <ion-col style=\"margin-top: 20%;\">\n        <ion-button color=\"dark\" (click)=\"busqueda_avanzada()\"><ion-icon name=\"search-outline\"></ion-icon></ion-button>\n      </ion-col>\n    </ion-row>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_catalogo_avanzada_avanzada_module_ts.js.map
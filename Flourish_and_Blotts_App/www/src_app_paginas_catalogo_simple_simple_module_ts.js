"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_catalogo_simple_simple_module_ts"],{

/***/ 4170:
/*!******************************************************************!*\
  !*** ./src/app/paginas/catalogo/simple/simple-routing.module.ts ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SimplePageRoutingModule": () => (/* binding */ SimplePageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _simple_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./simple.page */ 651);




const routes = [
    {
        path: '',
        component: _simple_page__WEBPACK_IMPORTED_MODULE_0__.SimplePage
    }
];
let SimplePageRoutingModule = class SimplePageRoutingModule {
};
SimplePageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], SimplePageRoutingModule);



/***/ }),

/***/ 7190:
/*!**********************************************************!*\
  !*** ./src/app/paginas/catalogo/simple/simple.module.ts ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SimplePageModule": () => (/* binding */ SimplePageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _simple_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./simple-routing.module */ 4170);
/* harmony import */ var _simple_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./simple.page */ 651);







let SimplePageModule = class SimplePageModule {
};
SimplePageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _simple_routing_module__WEBPACK_IMPORTED_MODULE_0__.SimplePageRoutingModule
        ],
        declarations: [_simple_page__WEBPACK_IMPORTED_MODULE_1__.SimplePage]
    })
], SimplePageModule);



/***/ }),

/***/ 651:
/*!********************************************************!*\
  !*** ./src/app/paginas/catalogo/simple/simple.page.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SimplePage": () => (/* binding */ SimplePage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _simple_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./simple.page.html?ngResource */ 1175);
/* harmony import */ var _simple_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./simple.page.scss?ngResource */ 5598);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/publica.service */ 9480);






let SimplePage = class SimplePage {
    constructor(_router, _publicaS) {
        this._router = _router;
        this._publicaS = _publicaS;
        this.titulo = '';
        this.uno_varios = true;
        this._publicaS.cargar_catalogo();
    }
    get libros() {
        return this._publicaS.catalogo;
    }
    onKey(event) {
        if (event.target.value != '') {
            this.uno_varios = false;
            /*let len = this._publicaS.catalogo.length;
            let catalogo = this._publicaS.catalogo;
            for ( let i=0;i<len;i++ ){
              let titulo = catalogo[i].titulo.toLowerCase();
              if ( titulo.includes(event.target.value) ){
              }
            }*/
        }
        else
            this.uno_varios = true;
    }
    pdf() {
        this._publicaS.pdf();
    }
    ngOnInit() {
    }
};
SimplePage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__.Router },
    { type: src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__.PublicaService }
];
SimplePage = (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_5__.Component)({
        selector: 'app-simple',
        template: _simple_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_simple_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], SimplePage);



/***/ }),

/***/ 5598:
/*!*********************************************************************!*\
  !*** ./src/app/paginas/catalogo/simple/simple.page.scss?ngResource ***!
  \*********************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzaW1wbGUucGFnZS5zY3NzIn0= */";

/***/ }),

/***/ 1175:
/*!*********************************************************************!*\
  !*** ./src/app/paginas/catalogo/simple/simple.page.html?ngResource ***!
  \*********************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Catálogo</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n\n  <ion-grid>\n    <ion-row>\n\n      <ion-col size=\"9\">\n        <ion-item>\n          <ion-label position=\"floating\">Título</ion-label>\n          <ion-input (keyup)=\"onKey($event)\" [(ngModel)]=\"titulo\"></ion-input>\n        </ion-item>\n      </ion-col>\n      <ion-col>\n        <ion-button (click)=\"pdf()\" color=\"dark\"><ion-icon name=\"download-outline\"></ion-icon></ion-button>\n      </ion-col>\n      \n\n    </ion-row>\n    <div *ngIf=\"uno_varios; else elseBlock\">\n      <ion-row *ngFor=\"let libro of libros\">\n        <ion-col size=\"5\">\n          <img src=\"{{libro.imagen}}\">\n        </ion-col>\n        <ion-col>\n          <ion-item><b>{{libro.titulo}}</b></ion-item>\n          <ion-item>{{libro.editorial}}</ion-item>\n          <ion-item>{{libro.idioma}}</ion-item>\n          <ion-item>Pág. {{libro.numero_paginas}}</ion-item>\n          <ion-item>ISBN:{{libro.isbn_13}}</ion-item>\n        </ion-col>\n      </ion-row>\n    </div>\n    <ng-template #elseBlock>\n      <ion-row *ngFor=\"let libro of libros\">\n        <ion-item *ngIf=\"libro.titulo.includes(titulo)\">\n          <ion-col size=\"5\">\n            <img src=\"{{libro.imagen}}\">\n          </ion-col>\n          <ion-col>\n            <ion-item><b>{{libro.titulo}}</b></ion-item>\n            <ion-item>{{libro.editorial}}</ion-item>\n            <ion-item>{{libro.idioma}}</ion-item>\n            <ion-item>Pág. {{libro.numero_paginas}}</ion-item>\n            <ion-item>ISBN:{{libro.isbn_13}}</ion-item>\n          </ion-col>\n        </ion-item>\n      </ion-row>\n    </ng-template>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_catalogo_simple_simple_module_ts.js.map
"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_catalogo_catalogo_module_ts"],{

/***/ 4495:
/*!*************************************************************!*\
  !*** ./src/app/paginas/catalogo/catalogo-routing.module.ts ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CatalogoPageRoutingModule": () => (/* binding */ CatalogoPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _catalogo_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./catalogo.page */ 4773);




const routes = [
    {
        path: '',
        component: _catalogo_page__WEBPACK_IMPORTED_MODULE_0__.CatalogoPage,
        children: [
            {
                path: 'avanzada',
                loadChildren: () => __webpack_require__.e(/*! import() */ "src_app_paginas_catalogo_avanzada_avanzada_module_ts").then(__webpack_require__.bind(__webpack_require__, /*! ./avanzada/avanzada.module */ 2785)).then(m => m.AvanzadaPageModule)
            },
            {
                path: 'simple',
                loadChildren: () => __webpack_require__.e(/*! import() */ "src_app_paginas_catalogo_simple_simple_module_ts").then(__webpack_require__.bind(__webpack_require__, /*! ./simple/simple.module */ 7190)).then(m => m.SimplePageModule)
            },
        ]
    },
    {
        path: 'simple',
        loadChildren: () => __webpack_require__.e(/*! import() */ "src_app_paginas_catalogo_simple_simple_module_ts").then(__webpack_require__.bind(__webpack_require__, /*! ./simple/simple.module */ 7190)).then(m => m.SimplePageModule)
    },
    {
        path: 'avanzada',
        loadChildren: () => __webpack_require__.e(/*! import() */ "src_app_paginas_catalogo_avanzada_avanzada_module_ts").then(__webpack_require__.bind(__webpack_require__, /*! ./avanzada/avanzada.module */ 2785)).then(m => m.AvanzadaPageModule)
    },
    {
        path: 'horario',
        loadChildren: () => __webpack_require__.e(/*! import() */ "common").then(__webpack_require__.bind(__webpack_require__, /*! ./../horario/horario.module */ 4155)).then(m => m.HorarioPageModule)
    }
];
let CatalogoPageRoutingModule = class CatalogoPageRoutingModule {
};
CatalogoPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], CatalogoPageRoutingModule);



/***/ }),

/***/ 4673:
/*!*****************************************************!*\
  !*** ./src/app/paginas/catalogo/catalogo.module.ts ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CatalogoPageModule": () => (/* binding */ CatalogoPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _catalogo_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./catalogo-routing.module */ 4495);
/* harmony import */ var _catalogo_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./catalogo.page */ 4773);







let CatalogoPageModule = class CatalogoPageModule {
};
CatalogoPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _catalogo_routing_module__WEBPACK_IMPORTED_MODULE_0__.CatalogoPageRoutingModule
        ],
        declarations: [_catalogo_page__WEBPACK_IMPORTED_MODULE_1__.CatalogoPage]
    })
], CatalogoPageModule);



/***/ }),

/***/ 4773:
/*!***************************************************!*\
  !*** ./src/app/paginas/catalogo/catalogo.page.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CatalogoPage": () => (/* binding */ CatalogoPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _catalogo_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./catalogo.page.html?ngResource */ 8160);
/* harmony import */ var _catalogo_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./catalogo.page.scss?ngResource */ 1284);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/publica.service */ 9480);






let CatalogoPage = class CatalogoPage {
    constructor(_router, _publicaS) {
        this._router = _router;
        this._publicaS = _publicaS;
        this._publicaS.cargar_catalogo();
    }
    get libros() {
        return this._publicaS.catalogo;
    }
    ngOnInit() {
    }
};
CatalogoPage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__.Router },
    { type: src_app_servicios_publica_service__WEBPACK_IMPORTED_MODULE_2__.PublicaService }
];
CatalogoPage = (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_5__.Component)({
        selector: 'app-catalogo',
        template: _catalogo_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_catalogo_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], CatalogoPage);



/***/ }),

/***/ 1284:
/*!****************************************************************!*\
  !*** ./src/app/paginas/catalogo/catalogo.page.scss?ngResource ***!
  \****************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJjYXRhbG9nby5wYWdlLnNjc3MifQ== */";

/***/ }),

/***/ 8160:
/*!****************************************************************!*\
  !*** ./src/app/paginas/catalogo/catalogo.page.html?ngResource ***!
  \****************************************************************/
/***/ ((module) => {

module.exports = "<ion-tabs>\n  <ion-tab-bar slot=\"bottom\" color=\"dark\">\n    <ion-tab-button tab=\"simple\">\n      <ion-icon name=\"search-outline\"></ion-icon>\n      <ion-label>Simple</ion-label>\n    </ion-tab-button>\n\n    <ion-tab-button tab=\"avanzada\">\n      <ion-icon name=\"search-circle-outline\"></ion-icon>\n      <ion-label>Avanzada</ion-label>\n    </ion-tab-button>\n  </ion-tab-bar>\n</ion-tabs>";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_catalogo_catalogo_module_ts.js.map
"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_paginas_module_ts"],{

/***/ 4634:
/*!***************************************************!*\
  !*** ./src/app/paginas/paginas-routing.module.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PaginasPageRoutingModule": () => (/* binding */ PaginasPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ 2816);



const routes = [
    {
        path: '',
        redirectTo: 'paginas',
        pathMatch: 'full',
        children: [
            {
                path: 'iniciarsesion',
                loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_iniciarsesion_iniciarsesion_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./iniciarsesion/iniciarsesion.module */ 812)).then(m => m.IniciarsesionPageModule)
            },
            {
                path: 'home',
                loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_home_home_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./home/home.module */ 7317)).then(m => m.HomePageModule)
            },
            {
                path: 'privada-administrador',
                loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_privada-administrador_privada-administrador_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./privada-administrador/privada-administrador.module */ 7810)).then(m => m.PrivadaAdministradorPageModule)
            },
            {
                path: 'catalogo',
                loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_catalogo_catalogo_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./catalogo/catalogo.module */ 4673)).then(m => m.CatalogoPageModule)
            },
            {
                path: 'horario',
                loadChildren: () => __webpack_require__.e(/*! import() */ "common").then(__webpack_require__.bind(__webpack_require__, /*! ./horario/horario.module */ 4155)).then(m => m.HorarioPageModule)
            },
        ]
    },
    {
        path: 'iniciarsesion',
        loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_iniciarsesion_iniciarsesion_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./iniciarsesion/iniciarsesion.module */ 812)).then(m => m.IniciarsesionPageModule)
    },
    {
        path: 'privada-administrador',
        loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_privada-administrador_privada-administrador_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./privada-administrador/privada-administrador.module */ 7810)).then(m => m.PrivadaAdministradorPageModule)
    },
    {
        path: 'catalogo',
        loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_catalogo_catalogo_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./catalogo/catalogo.module */ 4673)).then(m => m.CatalogoPageModule)
    },
    {
        path: 'horario',
        loadChildren: () => __webpack_require__.e(/*! import() */ "common").then(__webpack_require__.bind(__webpack_require__, /*! ./horario/horario.module */ 4155)).then(m => m.HorarioPageModule)
    },
    {
        path: 'home',
        loadChildren: () => Promise.all(/*! import() */[__webpack_require__.e("common"), __webpack_require__.e("src_app_paginas_home_home_module_ts")]).then(__webpack_require__.bind(__webpack_require__, /*! ./home/home.module */ 7317)).then(m => m.HomePageModule)
    },
    {
        path: 'responsable',
        loadChildren: () => __webpack_require__.e(/*! import() */ "src_app_paginas_privada_usuarios_responsable_responsable_module_ts").then(__webpack_require__.bind(__webpack_require__, /*! ./privada_usuarios/responsable/responsable.module */ 5325)).then(m => m.ResponsablePageModule)
    },
];
let PaginasPageRoutingModule = class PaginasPageRoutingModule {
};
PaginasPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_0__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_1__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterModule],
    })
], PaginasPageRoutingModule);



/***/ }),

/***/ 5552:
/*!*******************************************!*\
  !*** ./src/app/paginas/paginas.module.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PaginasPageModule": () => (/* binding */ PaginasPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _paginas_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./paginas-routing.module */ 4634);
/* harmony import */ var _paginas_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./paginas.page */ 4881);







let PaginasPageModule = class PaginasPageModule {
};
PaginasPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _paginas_routing_module__WEBPACK_IMPORTED_MODULE_0__.PaginasPageRoutingModule
        ],
        declarations: [_paginas_page__WEBPACK_IMPORTED_MODULE_1__.PaginasPage]
    })
], PaginasPageModule);



/***/ }),

/***/ 4881:
/*!*****************************************!*\
  !*** ./src/app/paginas/paginas.page.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PaginasPage": () => (/* binding */ PaginasPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _paginas_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./paginas.page.html?ngResource */ 6694);
/* harmony import */ var _paginas_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./paginas.page.scss?ngResource */ 6615);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);




let PaginasPage = class PaginasPage {
    constructor() { }
    ngOnInit() {
    }
};
PaginasPage.ctorParameters = () => [];
PaginasPage = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.Component)({
        selector: 'app-paginas',
        template: _paginas_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_paginas_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], PaginasPage);



/***/ }),

/***/ 6615:
/*!******************************************************!*\
  !*** ./src/app/paginas/paginas.page.scss?ngResource ***!
  \******************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJwYWdpbmFzLnBhZ2Uuc2NzcyJ9 */";

/***/ }),

/***/ 6694:
/*!******************************************************!*\
  !*** ./src/app/paginas/paginas.page.html?ngResource ***!
  \******************************************************/
/***/ ((module) => {

module.exports = "<ion-tabs>\n  \n</ion-tabs>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_paginas_module_ts.js.map
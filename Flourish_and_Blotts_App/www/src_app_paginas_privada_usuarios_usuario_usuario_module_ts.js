"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_privada_usuarios_usuario_usuario_module_ts"],{

/***/ 4230:
/*!****************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/usuario/usuario-routing.module.ts ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "UsuarioPageRoutingModule": () => (/* binding */ UsuarioPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _usuario_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./usuario.page */ 5876);




const routes = [
    {
        path: '',
        component: _usuario_page__WEBPACK_IMPORTED_MODULE_0__.UsuarioPage
    }
];
let UsuarioPageRoutingModule = class UsuarioPageRoutingModule {
};
UsuarioPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], UsuarioPageRoutingModule);



/***/ }),

/***/ 3689:
/*!********************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/usuario/usuario.module.ts ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "UsuarioPageModule": () => (/* binding */ UsuarioPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _usuario_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./usuario-routing.module */ 4230);
/* harmony import */ var _usuario_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./usuario.page */ 5876);







let UsuarioPageModule = class UsuarioPageModule {
};
UsuarioPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _usuario_routing_module__WEBPACK_IMPORTED_MODULE_0__.UsuarioPageRoutingModule
        ],
        declarations: [_usuario_page__WEBPACK_IMPORTED_MODULE_1__.UsuarioPage]
    })
], UsuarioPageModule);



/***/ }),

/***/ 5876:
/*!******************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/usuario/usuario.page.ts ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "UsuarioPage": () => (/* binding */ UsuarioPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _usuario_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./usuario.page.html?ngResource */ 1692);
/* harmony import */ var _usuario_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./usuario.page.scss?ngResource */ 9246);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/auth.service */ 6893);
/* harmony import */ var src_app_servicios_barcodescanner_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! src/app/servicios/barcodescanner.service */ 6240);
/* harmony import */ var src_app_servicios_library_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! src/app/servicios/library.service */ 5727);








let UsuarioPage = class UsuarioPage {
    constructor(_bsService, _router, _authService, _libraryService) {
        this._bsService = _bsService;
        this._router = _router;
        this._authService = _authService;
        this._libraryService = _libraryService;
        this.post = 0;
        this.scanActive = false;
        this.scanContent = '';
        this.nuevo_libro = false;
        this._bsService.configureScanner();
    }
    startScanner() {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_5__.__awaiter)(this, void 0, void 0, function* () {
            const allowed = yield this._bsService.checkPermissions();
            if (allowed == true) {
                this.scanActive = true;
                document.body.classList.add('qrscanner');
                const code = yield this._bsService.startScanner();
                //const result = await this._bsService.startScanner();
                document.body.classList.remove('qrscanner');
                if (code != null) {
                    this.scanContent = code;
                    this._libraryService.seach(code);
                    console.log(code);
                    //his._libraryService.seach(code);
                    this._bsService.stopScanner();
                    this.scanActive = false;
                }
                console.log('startScanner');
            }
        });
    }
    mi_cuenta() {
    }
    cerrar_sesion() {
        this._authService.logout();
        this._router.navigate(['paginas', 'iniciarsesion']);
    }
    obtainBook() {
        this.nuevo_libro = true;
        let code = ['9788401336560', '9786073807869', '9786073193948', '9788415745167', '9786073193917'];
        this._libraryService.seach(code[this.post % 5]);
        this.post += 1;
        this.agregar_libro = this._libraryService.getLibros;
    }
    ngOnInit() {
    }
};
UsuarioPage.ctorParameters = () => [
    { type: src_app_servicios_barcodescanner_service__WEBPACK_IMPORTED_MODULE_3__.BarcodescannerService },
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_6__.Router },
    { type: src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__.AuthService },
    { type: src_app_servicios_library_service__WEBPACK_IMPORTED_MODULE_4__.LibraryService }
];
UsuarioPage = (0,tslib__WEBPACK_IMPORTED_MODULE_5__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_7__.Component)({
        selector: 'app-usuario',
        template: _usuario_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_usuario_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], UsuarioPage);



/***/ }),

/***/ 9246:
/*!*******************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/usuario/usuario.page.scss?ngResource ***!
  \*******************************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJ1c3VhcmlvLnBhZ2Uuc2NzcyJ9 */";

/***/ }),

/***/ 1692:
/*!*******************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/usuario/usuario.page.html?ngResource ***!
  \*******************************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Usuario</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n\n  <ion-grid>\n    <ion-row>\n      <ion-col></ion-col>\n      <ion-col size=\"2\"><ion-button (click)=\"mi_cuenta()\" color=\"medium\"><ion-icon name=\"person-circle-outline\"></ion-icon></ion-button></ion-col>\n      <ion-col size=\"3\"><ion-button (click)=\"cerrar_sesion()\" color=\"dark\"><ion-icon name=\"log-out-outline\"></ion-icon>Cerrar</ion-button></ion-col>\n      <ion-col size=\"1\"></ion-col>\n    </ion-row>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_privada_usuarios_usuario_usuario_module_ts.js.map
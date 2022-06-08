"use strict";
(self["webpackChunkapp"] = self["webpackChunkapp"] || []).push([["src_app_paginas_privada_usuarios_administrador_administrador_module_ts"],{

/***/ 5567:
/*!****************************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/administrador/administrador-routing.module.ts ***!
  \****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AdministradorPageRoutingModule": () => (/* binding */ AdministradorPageRoutingModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var _administrador_page__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./administrador.page */ 2682);




const routes = [
    {
        path: '',
        component: _administrador_page__WEBPACK_IMPORTED_MODULE_0__.AdministradorPage
    }
];
let AdministradorPageRoutingModule = class AdministradorPageRoutingModule {
};
AdministradorPageRoutingModule = (0,tslib__WEBPACK_IMPORTED_MODULE_1__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.NgModule)({
        imports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule.forChild(routes)],
        exports: [_angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterModule],
    })
], AdministradorPageRoutingModule);



/***/ }),

/***/ 9970:
/*!********************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/administrador/administrador.module.ts ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AdministradorPageModule": () => (/* binding */ AdministradorPageModule)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 6362);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 587);
/* harmony import */ var _ionic_angular__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @ionic/angular */ 3819);
/* harmony import */ var _administrador_routing_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./administrador-routing.module */ 5567);
/* harmony import */ var _administrador_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./administrador.page */ 2682);







let AdministradorPageModule = class AdministradorPageModule {
};
AdministradorPageModule = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_3__.NgModule)({
        imports: [
            _angular_common__WEBPACK_IMPORTED_MODULE_4__.CommonModule,
            _angular_forms__WEBPACK_IMPORTED_MODULE_5__.FormsModule,
            _ionic_angular__WEBPACK_IMPORTED_MODULE_6__.IonicModule,
            _administrador_routing_module__WEBPACK_IMPORTED_MODULE_0__.AdministradorPageRoutingModule
        ],
        declarations: [_administrador_page__WEBPACK_IMPORTED_MODULE_1__.AdministradorPage]
    })
], AdministradorPageModule);



/***/ }),

/***/ 2682:
/*!******************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/administrador/administrador.page.ts ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AdministradorPage": () => (/* binding */ AdministradorPage)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _administrador_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./administrador.page.html?ngResource */ 9210);
/* harmony import */ var _administrador_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./administrador.page.scss?ngResource */ 9311);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ 2816);
/* harmony import */ var src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! src/app/servicios/auth.service */ 6893);
/* harmony import */ var src_app_servicios_privada_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! src/app/servicios/privada.service */ 8599);







let AdministradorPage = class AdministradorPage {
    constructor(_router, _authService, _privadaService) {
        this._router = _router;
        this._authService = _authService;
        this._privadaService = _privadaService;
        if (this._authService.isUserAuthenticated()) {
            this._router.navigate(["paginas", 'privada-administrador']);
        }
        else
            this._router.navigate(["paginas", 'iniciarsesion']);
    }
    mi_cuenta() {
        this._privadaService.mi_cuenta_datos();
        this._router.navigate(['paginas', 'micuenta']);
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
AdministradorPage.ctorParameters = () => [
    { type: _angular_router__WEBPACK_IMPORTED_MODULE_4__.Router },
    { type: src_app_servicios_auth_service__WEBPACK_IMPORTED_MODULE_2__.AuthService },
    { type: src_app_servicios_privada_service__WEBPACK_IMPORTED_MODULE_3__.PrivadaService }
];
AdministradorPage = (0,tslib__WEBPACK_IMPORTED_MODULE_5__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_6__.Component)({
        selector: 'app-administrador',
        template: _administrador_page_html_ngResource__WEBPACK_IMPORTED_MODULE_0__,
        styles: [_administrador_page_scss_ngResource__WEBPACK_IMPORTED_MODULE_1__]
    })
], AdministradorPage);



/***/ }),

/***/ 6893:
/*!*******************************************!*\
  !*** ./src/app/servicios/auth.service.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AuthService": () => (/* binding */ AuthService)
/* harmony export */ });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ 4929);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 3184);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common/http */ 8784);



let AuthService = class AuthService {
    constructor(_http) {
        this._http = _http;
        this.BASE_URL = "http://localhost:80/api/";
        this._email = null;
        this._passwd = null;
    }
    login(email, passwd) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_0__.__awaiter)(this, void 0, void 0, function* () {
            this._email = email;
            this._passwd = passwd;
            /*La crida necessita els headers, en aquest cas, el 'Content-Type'.
            També s'hi pot afegir el header 'Accept'*/
            let options = {
                headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_1__.HttpHeaders({
                    'Content-Type': 'application/json'
                })
            };
            //CON EL NOMBRE DE LOS CAMPOS VERDADEROS DE LA TABLA
            const data = {
                'correo_electronico': this._email,
                'contrasena': this._passwd
            };
            //Realització de la crida, embolcallada en una Promise (per poder fer l'await)
            return new Promise((resolve, reject) => {
                //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
                this._http.post(this.BASE_URL + "iniciar_sesion", data, options).subscribe((response) => {
                    if (response.status == 200) {
                        //Si tot va bé, emmagatzemem el TOKEN al LS
                        localStorage.setItem("TOKEN", response.token);
                        resolve(true);
                        console.log('entra login');
                    }
                    else {
                        resolve(false);
                        console.log('no inicia sesion');
                    }
                }, (error) => {
                    reject("Error");
                });
            });
        });
    }
    /*Utilitzarem aquesta funció per reinicar la sessió quan el token hagi expirat.
          Cal tenir en compte que, per poder-la executar, ens cal assegurar que el service tingui
          les dades de les credencials de l'usuari*/
    restartSession() {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_0__.__awaiter)(this, void 0, void 0, function* () {
            if (this._email != null && this._passwd != null) {
                const logResult = yield this.login(this._email, this._passwd);
                if (logResult)
                    return true;
            }
            return false;
        });
    }
    //Per tancar la sessió només cal esborrar credencials i el TOKEN
    logout() {
        this._email = null;
        this._passwd = null;
        localStorage.removeItem("TOKEN");
        console.log('cerrado');
    }
    get token() {
        return localStorage.getItem("TOKEN");
    }
    set token(token) {
        console.log(token);
        localStorage.setItem("TOKEN", token);
    }
    /*Per ajudar-vos durant el desenvolupament i per tal que pugueu ser més àgils programant,
          podeu comentar la comprovació de les credencials. En el codi final, aquesta comprovació
          hi ha de ser*/
    isUserAuthenticated() {
        return localStorage.getItem("TOKEN") != null;
        //return this._email != null && this._passwd != null && localStorage.getItem("TOKEN") != null;
    }
    rol() {
        let options = {
            headers: new _angular_common_http__WEBPACK_IMPORTED_MODULE_1__.HttpHeaders()
                .set('Accept', 'application/json')
                .set('Content-Type', 'application/json')
                .set('Authorization', 'Bearer: ' + this.token)
        };
        new Promise((resolve, reject) => {
            //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
            this._http.get(this.BASE_URL + "rol", options).subscribe((response) => {
                if (response.status == 200) {
                    console.log(response);
                    //Si tot va bé, emmagatzemem el TOKEN al LS
                    //localStorage.setItem("TOKEN", response.token);
                    //resolve(true);
                }
                else {
                    resolve(false);
                }
            }, (error) => {
                reject("Error");
            });
        });
    }
};
AuthService.ctorParameters = () => [
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_1__.HttpClient }
];
AuthService = (0,tslib__WEBPACK_IMPORTED_MODULE_0__.__decorate)([
    (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.Injectable)({
        providedIn: 'root'
    })
], AuthService);



/***/ }),

/***/ 9311:
/*!*******************************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/administrador/administrador.page.scss?ngResource ***!
  \*******************************************************************************************/
/***/ ((module) => {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJhZG1pbmlzdHJhZG9yLnBhZ2Uuc2NzcyJ9 */";

/***/ }),

/***/ 9210:
/*!*******************************************************************************************!*\
  !*** ./src/app/paginas/privada_usuarios/administrador/administrador.page.html?ngResource ***!
  \*******************************************************************************************/
/***/ ((module) => {

module.exports = "<ion-header [translucent]=\"true\">\n  <ion-toolbar color=\"dark\">\n    <ion-buttons slot=\"start\">\n      <ion-menu-button></ion-menu-button>\n    </ion-buttons>\n    <ion-title>Privada Administrador</ion-title>\n  </ion-toolbar>\n</ion-header>\n\n<ion-content>\n\n  <ion-grid>\n    <ion-row>\n      <ion-col></ion-col>\n      <ion-col size=\"2\"><ion-button (click)=\"mi_cuenta()\" color=\"medium\"><ion-icon name=\"person-circle-outline\"></ion-icon></ion-button></ion-col>\n      <ion-col size=\"3\">\n        <ion-button color=\"dark\" (click)=\"cerrar()\">Cerrar Sesión</ion-button>\n      </ion-col>\n      <ion-col size=\"1\"></ion-col>\n    </ion-row>\n    <ion-row>\n      <ion-button (click)=\"rol()\">Obtener rol</ion-button>\n    </ion-row>\n  </ion-grid>\n\n</ion-content>\n";

/***/ })

}]);
//# sourceMappingURL=src_app_paginas_privada_usuarios_administrador_administrador_module_ts.js.map
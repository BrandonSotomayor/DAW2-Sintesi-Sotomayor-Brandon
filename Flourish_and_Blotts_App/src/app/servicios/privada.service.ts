import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class PrivadaService {

  private BASE_URL: string = "http://localhost:80/api/";

  private responsables_get;
  private reservas_get;

  private dni_nie :string = null;
  private nombre: string = null;
  private apellido1 : string = null;
  private apellido2 : string = null;
  private correo_electronico: string = null;
  private contrasena: string = null;
  private nueva_contrasena :string = null;
  
  private cuenta_usuario;

  constructor(public _http: HttpClient, private _authService: AuthService) {
    //this.mi_cuenta_datos();
    if ( this._authService.rol == 'administrador' ){
      console.log('entra admi');
      this.gestion_responsable_get();
    }
    if ( this._authService.rol == 'responsable' ) {
      console.log('entra respoons');
      this.reservas_responsable_get();
    }
   }

   gestion_responsable_get():void{
    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }

    new Promise(
      (resolve, reject) => {
          this._http.get(this.BASE_URL + "usuarios/privado/1/gestion_responsable", options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    console.log(response);
                    this.responsables_get = response.usuarios;
                    this._authService.token = response.refreshToken; 
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }

  mi_cuenta_datos_post(dni_nie:string,nombre:string,apellido1:string,apellido2:string,correo_electronico:string,contrasena:string, nueva_contrasena:string):void{

    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }
    const data: any = {
      "dni_nie": dni_nie,
      "nombre": nombre,
      "apellido1": apellido1,
      "apellido2": apellido2,
      "correo_electronico": correo_electronico,
      "contrasena":  contrasena,
      "nueva_contrasena": nueva_contrasena
    }

    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "usuarios/privado/1/mi_cuenta_administrador", data, options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this._authService.token = response.refreshToken; 
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }

  mi_cuenta_responsable_post(dni_nie:string,nombre:string,apellido1:string,apellido2:string,correo_electronico:string,contrasena:string, nueva_contrasena:string):void{

    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }
    const data: any = {
      "dni_nie": dni_nie,
      "nombre": nombre,
      "apellido1": apellido1,
      "apellido2": apellido2,
      "correo_electronico": correo_electronico,
      "contrasena":  contrasena,
      "nueva_contrasena": nueva_contrasena
    }

    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "usuarios/privado/2/mi_cuenta", data, options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this._authService.token = response.refreshToken; 
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }

  reservas_responsable_get():void{
    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }

    new Promise(
      (resolve, reject) => {
          this._http.get(this.BASE_URL + "usuarios/privado/2/reservas", options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.reservas_get = response.reservas;
                    this._authService.token = response.refreshToken; 
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }

  reserva_aceptada_responsable_post(id_ejemplar: string):void{

    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }
    const data: any = {
      "id_ejemplar": id_ejemplar,
    }

    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "usuarios/privado/2/reserva_aceptada", data, options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this._authService.token = response.refreshToken; 
                    console.log('Reserva aceptada');
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }
  devolver_responsable_post(id_ejemplar: string):void{

    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }
    const data: any = {
      "id_ejemplar": id_ejemplar,
    }

    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "usuarios/privado/2/devolver", data, options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this._authService.token = response.refreshToken; 
                    console.log('Ejemplar devuelto');
                  }
                  else {
                    resolve(false);
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
  }

  mi_cuenta_usuario_datos_post(dni_nie:string,nombre:string,apellido1:string,apellido2:string,correo_electronico:string,contrasena:string, nueva_contrasena:string):void{

    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      .set('Authorization', 'Bearer '+ this._authService.token)
    }

    const data: any = {
      "dni_nie": dni_nie,
      "nombre": nombre,
      "apellido1": apellido1,
      "apellido2": apellido2,
      "correo_electronico": correo_electronico,
      "contrasena":  contrasena,
      "nueva_contrasena": nueva_contrasena
    }

    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "usuarios/privado/"+this._authService.id_rol+"/mi_cuenta", data, options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this._authService.token = response.refreshToken; 
                    console.log(1);
                  }
                  else {
                    resolve(false);
                    console.log(2);
                  }
              },
              (error: any) => {
                console.log(error);
                  reject("Error");
              }
          );
      }
    );
  }
  

  get responsables():any{
    return this.responsables_get;
  } 

  get mi_cuenta():any{
    return this.cuenta_usuario;
  }

  get reservas():any{
    return this.reservas_get;
  }
}

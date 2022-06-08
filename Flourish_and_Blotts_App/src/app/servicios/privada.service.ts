import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class PrivadaService {

  private BASE_URL: string = "http://localhost:80/api/";

  private dni_nie :string = null;
  private nombre: string = null;
  private apellido1 : string = null;
  private apellido2 : string = null;
  private correo_electronico: string = null;
  private contrasena: string = null;
  private nueva_contrasena :string = null;
  
  private cuenta_usuario;

  constructor(public _http: HttpClient, private _authService: AuthService) {
    this.mi_cuenta_datos();
   }

  rol():void{
    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      //.set('Authorization', 'Bearer: '+ this._authService.token)
    }

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "rol", options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                      console.log(response);
                      //Si tot va bé, emmagatzemem el TOKEN al LS
                      //localStorage.setItem("TOKEN", response.token);
                      //resolve(true);
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

  mi_cuenta_datos():void{
    let options: any = {
      headers: new HttpHeaders()
      .set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      //.set('Authorization', 'Bearer: '+ this._authService.token)
    }

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "usuarios/privado/1/mi_cuenta_administrador", options).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                      this.cuenta_usuario = response.usuario;
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
    this.dni_nie = dni_nie;
    this.nombre=nombre;
    this.apellido1=apellido1;
    this.correo_electronico=correo_electronico;
    this.contrasena=contrasena;
    this.nueva_contrasena=nueva_contrasena;

    let options: any = {
      headers: new HttpHeaders()
      //.set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      //.set('Authorization', 'Bearer: '+ this._authService.token)
    }
    const data: any = {
      'dni_nie': this.dni_nie,
      'nombre': this.nombre,
      'apellido1': this.apellido1,
      'apellido2': this.apellido2,
      'correo_electronico': this.correo_electronico,
      'contrasena':  this.contrasena,
      'nueva_contrasena': this.nueva_contrasena
    }
    console.log(data); 

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.post(this.BASE_URL + "usuarios/privado/1/mi_cuenta_administrador", options, data).subscribe(
              (response: any) => {

                  if(response.status == 200) {
                      console.log('usuario actualizado');
                  }
                  else {
                    console.log(response);
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



  get mi_cuenta():any{
    return this.cuenta_usuario;
  }
}

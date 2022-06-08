import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root'
})
export class LibrosService {

  private BASE_URL: string = "http://localhost:80/api/";

  constructor(public _http: HttpClient, private _authService: AuthService) { }

  agregar_libro_datos_post(libro_datos:any,autor_datos:string, categoria_datos:string):void{
    /*this.dni_nie = dni_nie;
    this.nombre=nombre;
    this.apellido1=apellido1;
    this.correo_electronico=correo_electronico;
    this.contrasena=contrasena;
    this.nueva_contrasena=nueva_contrasena;
*/
  /*  let options: any = {
      headers: new HttpHeaders()
      //.set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      //.set('Authorization', 'Bearer: '+ this._authService.token)
    }
    const data: any = {
      'isbn_13': libro_datos.isbn_13,
      'titulo': libro_datos.titulo,
      'subtitulo': libro_datos.subtitulo,
      'idioma': libro_datos.idioma,
      'imagen': libro_datos.imagen,
      'editorial': libro_datos.editorial,
      'fecha_publicacion': libro_datos.fecha_publicacion,
      'numero_paginas': libro_datos.numero_paginas,
      'descripcion':libro_datos.descripcion,
      'autores': autor_datos,
      'categorias':categoria_datos
    }
    console.log(data); 

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.post(this.BASE_URL + "usuarios/privado/2/agregar_libro", options, data).subscribe(
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
    );*/
  }

  agregar_ejemplar_datos_post(isbn_13:string):void{
    /*this.dni_nie = dni_nie;
    this.nombre=nombre;
    this.apellido1=apellido1;
    this.correo_electronico=correo_electronico;
    this.contrasena=contrasena;
    this.nueva_contrasena=nueva_contrasena;
*/
  /*  let options: any = {
      headers: new HttpHeaders()
      //.set('Accept','application/json')
      .set('Content-Type', 'application/json',)
      //.set('Authorization', 'Bearer: '+ this._authService.token)
    }
    const data: any = {
      'isbn_13': isbn_13,
    }

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "usuarios/privado/2/agregar_ejemplar", options, data).subscribe(
              (response: any) => {

                  if(response.status == 200) {
                      console.log('ejemplar agregado');
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
    );*/
  }
}

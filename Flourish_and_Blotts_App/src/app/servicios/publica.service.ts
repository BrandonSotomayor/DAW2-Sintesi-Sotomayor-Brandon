import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Biblioteca } from '../modelos/biblioteca';

@Injectable({
  providedIn: 'root'
})
export class PublicaService {

  private biblioteca;
  private libros;
  private datos_horarios;

  private BASE_URL: string = "http://localhost:80/api/";

  constructor(public _http: HttpClient) {
    this.horarios_api();
    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "publica/inicio").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.biblioteca = response.data.biblioteca;                    
                  }
                  else {
                    resolve(false);
                    console.log('no recibe');
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
   }

  cargar_catalogo(){

    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "publica/catalogo").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.libros = response.data.libros;
                    //console.log(response.data.libros);
                  }
                  else {
                    resolve(false);
                    console.log('no recibe');
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );

   }

   pdf(){

    new Promise(
      (resolve, reject) => {
          this._http.get(this.BASE_URL + "publica/pdf").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    console.log('200');
                    this.libros = response.data.libros;
                  }
                  else {
                    resolve(false);
                    console.log('no recibe');
                  }
              },
              (error: any) => {
                console.log('200');
                  reject("Error");
              }
          );
      }
    );
   }

   busqueda_avanzada(autor:string,titulo:string,categoria:string){

    const data: any = {
        'autor':  autor,
        'titulo':  titulo,
        'categoria': categoria
    }
    new Promise(
      (resolve, reject) => {
          this._http.post(this.BASE_URL + "publica/busqueda_avanzada",data).subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    console.log(response);
                  }
                  else {
                    resolve(false);
                    console.log('no recibe');
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );
   }

   horarios_api(){

    new Promise(
      (resolve, reject) => {
          this._http.get(this.BASE_URL + "publica/horarios").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.datos_horarios = response.data;
                  }
                  else {
                    resolve(false);
                    console.log('no recibe');
                  }
              },
              (error: any) => {
                  reject("Error");
              }
          );
      }
    );

   }

  get horarios():any{
    return this.datos_horarios;
  }

  get bibliotecas():Biblioteca{
    return this.biblioteca;
  }

  get catalogo():any{
    return this.libros;
  }
}

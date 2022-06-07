import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Biblioteca } from '../modelos/biblioteca';

@Injectable({
  providedIn: 'root'
})
export class PublicaService {

  private biblioteca;
  private libros;

  private BASE_URL: string = "http://localhost:80/api/";

  constructor(public _http: HttpClient) {
    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "publica/inicio").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.biblioteca = response.data.biblioteca;
                    console.log(this.biblioteca);
                    
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

  get bibliotecas():Biblioteca{
    return this.biblioteca;
  }

  get catalogo():any{
    return this.libros;
  }
}

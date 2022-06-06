import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Biblioteca } from '../modelos/biblioteca';

@Injectable({
  providedIn: 'root'
})
export class PublicaService {

  private biblioteca;

  private BASE_URL: string = "http://localhost:80/api";

  constructor(public _http: HttpClient) {
    new Promise(
      (resolve, reject) => {
          //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
          this._http.get(this.BASE_URL + "/publica/inicio").subscribe(
              (response: any) => {
                  if(response.status == 200) {
                    this.biblioteca = response.data.biblioteca;
                    console.log(this.biblioteca);
                    
                    
                    let biblioteca : Biblioteca = {
                      descripcion : response.data.biblioteca.descripcion,
                      //'id_biblioteca':response.data.biblioteca.id_biblioteca,
                      //'nombre_biblioteca':response.data.biblioteca.nombre_biblioteca,
                      //'descripcion':response.data.biblioteca.descripcion,
                    }
                    //this.biblioteca.push(biblioteca)



                    //this.biblioteca = biblioteca;
                    //console.log(this.biblioteca);
                    //this.biblioteca = response.data;
                    //console.log(datos);
                    //this.biblioteca = response.data.biblioteca.biblioteca;
                    //console.log(this.biblioteca);
                    //return response;
                    //console.log(this.biblioteca.biblioteca);
                      //Si tot va bé, emmagatzemem el TOKEN al LS
                      //localStorage.setItem("TOKEN", response.token);
                      //resolve(true);
                      //console.log('entra login');
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
}

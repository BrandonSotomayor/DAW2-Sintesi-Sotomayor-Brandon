import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Libro } from '../models/libro';

@Injectable({
  providedIn: 'root'
})
export class LibraryService {

  private libros: Libro;

  private autor = '';
  private categoria = '';

  constructor(private _http: HttpClient) {
   }

   seach(isbn: string){
    let libro: Libro;
    this._http.get("https://www.googleapis.com/books/v1/volumes?q=isbn:"+isbn).subscribe(
      (dchar : any) => { 
        for( let i= 0; i< dchar.items.length; i++ ){

          let ISBN = isbn.toString();
          libro = { 
            isbn_13: ISBN,
            titulo: dchar.items[i].volumeInfo.title,
            subtitulo: dchar.items[i].volumeInfo.title,
            idioma: dchar.items[i].volumeInfo.language,
            imagen: dchar.items[i].volumeInfo.imageLinks.thumbnail,
            editorial: dchar.items[i].volumeInfo.publisher,
            fecha_publicacion: dchar.items[i].volumeInfo.publishedDate,
            numero_paginas: dchar.items[i].volumeInfo.pageCount,
            descripcion: dchar.items[i].volumeInfo.description
          }
          
          if ( dchar.items[i].volumeInfo.authors.length <= 1 ){
            this.autor = dchar.items[i].volumeInfo.authors[0];
          }
          else{
            let len_autor = dchar.items[i].volumeInfo.authors.length;
            for( let j=0; j<dchar.items[i].volumeInfo.authors.length; j++ ){
              if ( j==0 ) this.autor = dchar.items[i].volumeInfo.authors[j];
              else if ( len_autor == (j+1) ) this.autor += dchar.items[i].volumeInfo.authors[j];
              else this.autor += ';'+dchar.items[i].volumeInfo.authors[j];
            }
          }
          if ( dchar.items[i].volumeInfo.categories.length <= 1 ){
            //console.log('Hi ha més autors');
            this.categoria = dchar.items[i].volumeInfo.categories[0];
          }
          else{
            let len_categoria = dchar.items[i].volumeInfo.categories.length;
            for( let j=0; j<dchar.items[i].volumeInfo.categories.length; j++ ){
              if ( j==0 ) this.categoria = dchar.items[i].volumeInfo.categories[j];
              else if ( len_categoria == (j+1) ) this.categoria += dchar.items[i].volumeInfo.categories[j];
              else this.categoria += ';'+dchar.items[i].volumeInfo.categories[j];
            }
          }
        }
        this.libros = libro;
      }
    );
  }

  get getLibros():Libro{
    return this.libros;
  }

  get autores():string{
    return this.autor;
  }

  get categorias():string{
    return this.categoria;
  }
}

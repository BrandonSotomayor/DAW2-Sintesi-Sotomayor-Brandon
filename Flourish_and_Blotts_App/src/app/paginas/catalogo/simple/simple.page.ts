import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-simple',
  templateUrl: './simple.page.html',
  styleUrls: ['./simple.page.scss'],
})
export class SimplePage implements OnInit {

  public titulo = '';
  public uno_varios = true;

  constructor(private _router: Router, private _publicaS: PublicaService) { 
    this._publicaS.cargar_catalogo();
  }

  get libros():any{
    console.log(this._publicaS.catalogo);
    return this._publicaS.catalogo;
  }

  onKey(event: any) { // without type info
    if ( event.target.value != '' ){
      
      this.uno_varios = false;
      /*let len = this._publicaS.catalogo.length;
      let catalogo = this._publicaS.catalogo;
      for ( let i=0;i<len;i++ ){
        let titulo = catalogo[i].titulo.toLowerCase();
        if ( titulo.includes(event.target.value) ){
        }
      }*/
    }else this.uno_varios = true;
  }

  pdf(){
    this._publicaS.pdf();
  }

  ngOnInit() {
  }

}

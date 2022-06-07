import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-catalogo',
  templateUrl: './catalogo.page.html',
  styleUrls: ['./catalogo.page.scss'],
})
export class CatalogoPage implements OnInit {

  constructor(private _router: Router, private _publicaS: PublicaService) { 
    this._publicaS.cargar_catalogo();
  }

  get libros():any{
    return this._publicaS.catalogo;
  }

  ngOnInit() {
  }

}

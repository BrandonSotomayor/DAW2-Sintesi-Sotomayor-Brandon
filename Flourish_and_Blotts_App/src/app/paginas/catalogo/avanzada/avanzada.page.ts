import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-avanzada',
  templateUrl: './avanzada.page.html',
  styleUrls: ['./avanzada.page.scss'],
})
export class AvanzadaPage implements OnInit {

  public autor = '';
  public titulo = '';
  public categoria = '';

  constructor(private _router: Router, private _publicaS: PublicaService) { }

  busqueda_avanzada(){
    this._publicaS.busqueda_avanzada(this.autor,this.titulo,this.categoria);
  }

  ngOnInit() {
  }

}

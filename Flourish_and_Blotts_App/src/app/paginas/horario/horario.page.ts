import { Component, OnInit } from '@angular/core';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-horario',
  templateUrl: './horario.page.html',
  styleUrls: ['./horario.page.scss'],
})
export class HorarioPage implements OnInit {

  public datos;
  public biblioteca;
  public responsables;

  constructor(private _publicaS: PublicaService) {
    this.horarios();
   }

  horarios(){
    console.log(this._publicaS.horarios);
    //this._publicaS.horarios_api();
    this.biblioteca = this._publicaS.horarios.biblioteca;
    this.responsables = this._publicaS.horarios.responsables;
    //this.datos = this._publicaS.horarios;
    console.log(this.responsables);
  }

  ngOnInit() {
  }

}

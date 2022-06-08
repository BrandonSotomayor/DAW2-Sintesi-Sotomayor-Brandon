import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { PrivadaService } from 'src/app/servicios/privada.service';

@Component({
  selector: 'app-micuenta',
  templateUrl: './micuenta.page.html',
  styleUrls: ['./micuenta.page.scss'],
})
export class MicuentaPage implements OnInit {

  dni_nie = '';
  nombre = '';
  apellido1 = '';
  apellido2 = '';
  correo_electronico = '';
  contrasena = '';
  nueva_contrasena = '';
  public datos_usuario;

  constructor(private router: Router, private _privadaService: PrivadaService) { 
    this.datos_usuario = this._privadaService.mi_cuenta;
  }

  actualizar(){
    this._privadaService.mi_cuenta_datos_post(this.dni_nie,this.nombre,this.apellido1,this.apellido2,this.correo_electronico,this.contrasena,this.nueva_contrasena);
  }

  cancelar(){
    this.router.navigate(['paginas','administrador']);
  }

  ngOnInit() {
  }

}

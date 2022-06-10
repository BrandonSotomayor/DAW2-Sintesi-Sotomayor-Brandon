import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { PrivadaService } from 'src/app/servicios/privada.service';

@Component({
  selector: 'app-micuentausuario',
  templateUrl: './micuentausuario.page.html',
  styleUrls: ['./micuentausuario.page.scss'],
})
export class MicuentausuarioPage implements OnInit {

  dni_nie = '';
  nombre = '';
  apellido1 = '';
  apellido2 = '';
  correo_electronico = '';
  contrasena = '';
  nueva_contrasena = '';
  public datos_usuario;

  constructor(private _router: Router, private _privadaService: PrivadaService, private _authService: AuthService) { }

  actualizar(){
    this._privadaService.mi_cuenta_usuario_datos_post(this.dni_nie,this.nombre,this.apellido1,this.apellido2,this.correo_electronico,this.contrasena,this.nueva_contrasena);
    this._router.navigate(['paginas', this._authService.rol]);
  }

  cancelar(){
    this._router.navigate(['paginas',this._authService.rol]);
  }

  ngOnInit() {
  }

}

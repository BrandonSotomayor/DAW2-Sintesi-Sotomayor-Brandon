import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
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

  constructor(private _router: Router, private _privadaService: PrivadaService, private _authService: AuthService) { 
    if ( this._authService.isUserAuthenticated() ) {
      this._router.navigate(["paginas", 'micuenta']);
    }
    else this._router.navigate(["paginas",'iniciarsesion']);
   }

  actualizar(){
    this._privadaService.mi_cuenta_datos_post(this.dni_nie,this.nombre,this.apellido1,this.apellido2,this.correo_electronico,this.contrasena,this.nueva_contrasena);
    this._router.navigate(['paginas','administrador']);
  }

  cancelar(){
    this._router.navigate(['paginas','administrador']);
  }

  ngOnInit() {
  }

}

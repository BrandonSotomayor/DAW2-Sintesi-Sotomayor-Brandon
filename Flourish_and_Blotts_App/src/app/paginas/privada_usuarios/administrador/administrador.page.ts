import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { PrivadaService } from 'src/app/servicios/privada.service';

@Component({
  selector: 'app-administrador',
  templateUrl: './administrador.page.html',
  styleUrls: ['./administrador.page.scss'],
})
export class AdministradorPage implements OnInit {

  constructor(private _router: Router, private _authService: AuthService, private _privadaService: PrivadaService) {
    if ( this._authService.isUserAuthenticated() ) {
      this._router.navigate(["paginas", this._authService.rol]);
    }
    else this._router.navigate(["paginas",'iniciarsesion']);

  }

  get responsables():any{
    return this._privadaService.responsables;
  }

  mi_cuenta(){
    this._router.navigate(['paginas','micuenta']);
  }

  cerrar(){
    this._authService.logout();
    this._router.navigate(['paginas','iniciarsesion']);
  }

  ngOnInit() {
  }

}

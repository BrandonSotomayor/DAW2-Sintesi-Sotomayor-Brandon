import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';

@Component({
  selector: 'app-privada-administrador',
  templateUrl: './privada-administrador.page.html',
  styleUrls: ['./privada-administrador.page.scss'],
})
export class PrivadaAdministradorPage implements OnInit {

  constructor(private _router: Router, private _authService: AuthService) {
    if ( this._authService.isUserAuthenticated() ) {
      this._router.navigate(["paginas",'privada-administrador']);
    }
    else this._router.navigate(["paginas",'iniciarsesion']);
  }

  rol(){
    this._authService.rol();
  }

  cerrar(){
    this._authService.logout();
    this._router.navigate(['paginas','iniciarsesion']);
  }

  ngOnInit() {
  }

}

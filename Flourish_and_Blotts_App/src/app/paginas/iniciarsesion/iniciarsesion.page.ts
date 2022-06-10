import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';

@Component({
  selector: 'app-iniciarsesion',
  templateUrl: './iniciarsesion.page.html',
  styleUrls: ['./iniciarsesion.page.scss'],
})
export class IniciarsesionPage implements OnInit {

  private BASE_URL: string = "http://localhost:80/api";
  public correo_electronico: string = '';
  public contrasena: string = '';

  constructor(private _router: Router, private _authService: AuthService, public _http: HttpClient) {
    if ( this._authService.isUserAuthenticated() ) {
      this._router.navigate(["paginas",this._authService.rol]);
    }
    else {
      this._router.navigate(["paginas",'iniciarsesion']);
    }
  }
  
  async iniciar_sesion(): Promise<void> {
    /*L'estructura try/catch ens permet gestionar qualsevol error de xarxa en la
    comunicació amb el servidor*/
    try {
        const response = await this._authService.login(this.correo_electronico, this.contrasena);
        if(response) {
            this._router.navigate(["paginas", this._authService.rol]);
        }
    } catch(error) {
        console.log("Error!");
    }
  }
  cancelar(){
    this._router.navigate(['paginas','home']);
  }

  ngOnInit() {
  }

}

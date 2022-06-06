import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';

@Component({
  selector: 'app-iniciarsesion',
  templateUrl: './iniciarsesion.page.html',
  styleUrls: ['./iniciarsesion.page.scss'],
})
export class IniciarsesionPage implements OnInit {

  private email: string = 'admin@gmail.com';
  private passwd: string = '1234';

  constructor(private _router: Router, private _authService: AuthService) { }
  
  async iniciar_sesion(): Promise<void> {
    /*L'estructura try/catch ens permet gestionar qualsevol error de xarxa en la
    comunicació amb el servidor*/
    try {
        const response = await this._authService.login(this.email, this.passwd);
        console.log(response);
        if(response) {
            this._router.navigate(["paginas",'iniciarsesion']);
        }
    } catch(error) {
        console.log("Error!");
    }
  }

  ngOnInit() {
  }

}

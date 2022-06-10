import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { PrivadaService } from 'src/app/servicios/privada.service';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-catalogoprivado',
  templateUrl: './catalogoprivado.page.html',
  styleUrls: ['./catalogoprivado.page.scss'],
})
export class CatalogoprivadoPage implements OnInit {

  public id_ejemplar = "";

  constructor(private _authService: AuthService, private _router: Router, private _privadaService: PrivadaService) { 
    if ( !this._authService.isUserAuthenticated ) this._router.navigate(['paginas','iniciarsesion']);
    this._privadaService.catalogo_usuario();
  }

  volver(){
    this._router.navigate(['paginas',this._authService.rol]);
  }
  reservar(id_ejemplar:string){
    this._privadaService.reservar_usuario_post(id_ejemplar);
  }

  get libros():any{
    return this._privadaService.libros_catalogo;
  }
  get ejemplares():any{
    return this._privadaService.ejemplares_catalogo;
  }

  ngOnInit() {
  }

}

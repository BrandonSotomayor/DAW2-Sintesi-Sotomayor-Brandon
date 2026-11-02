import { Component } from '@angular/core';
import { MenuController } from '@ionic/angular';
import { Biblioteca } from 'src/app/modelos/biblioteca';
import { PublicaService } from 'src/app/servicios/publica.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  private _cathegoriesIsOpen: boolean = false;
  //public biblioteca;

  constructor(private _menu: MenuController, private _publicaS: PublicaService) {  }

  get biblioteca():Biblioteca{
    //console.log(this._publicaS.bibliotecas);
    return this._publicaS.bibliotecas;
  }

  openCathegories(): void {
    this._cathegoriesIsOpen = !this._cathegoriesIsOpen;
  }

  isCathegoriesOpen(): boolean {
    return this._cathegoriesIsOpen;
  }

  closeMenu(): void {
    console.log("closing...");
    this._menu.close();
  }

}

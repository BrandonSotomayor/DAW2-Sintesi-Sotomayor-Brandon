import { Component } from '@angular/core';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {

  private _cathegoriesIsOpen: boolean = false;

  constructor(private _menu: MenuController) {}

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

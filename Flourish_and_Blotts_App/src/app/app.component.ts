import { Component } from '@angular/core';
import { MenuController } from '@ionic/angular';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  
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

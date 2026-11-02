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

  closeMenu(): void {
    console.log("closing...");
    this._menu.close();
  }
}

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CatalogoprivadoPageRoutingModule } from './catalogoprivado-routing.module';

import { CatalogoprivadoPage } from './catalogoprivado.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CatalogoprivadoPageRoutingModule
  ],
  declarations: [CatalogoprivadoPage]
})
export class CatalogoprivadoPageModule {}

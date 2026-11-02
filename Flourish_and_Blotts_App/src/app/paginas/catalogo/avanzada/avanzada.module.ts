import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { AvanzadaPageRoutingModule } from './avanzada-routing.module';

import { AvanzadaPage } from './avanzada.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    AvanzadaPageRoutingModule
  ],
  declarations: [AvanzadaPage]
})
export class AvanzadaPageModule {}

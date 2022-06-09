import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { MicuentaresponsablePageRoutingModule } from './micuentaresponsable-routing.module';

import { MicuentaresponsablePage } from './micuentaresponsable.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    MicuentaresponsablePageRoutingModule
  ],
  declarations: [MicuentaresponsablePage]
})
export class MicuentaresponsablePageModule {}

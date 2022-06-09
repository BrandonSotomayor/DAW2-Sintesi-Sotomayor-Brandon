import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { MicuentausuarioPageRoutingModule } from './micuentausuario-routing.module';

import { MicuentausuarioPage } from './micuentausuario.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    MicuentausuarioPageRoutingModule
  ],
  declarations: [MicuentausuarioPage]
})
export class MicuentausuarioPageModule {}

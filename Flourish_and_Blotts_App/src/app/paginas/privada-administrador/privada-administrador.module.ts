import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PrivadaAdministradorPageRoutingModule } from './privada-administrador-routing.module';

import { PrivadaAdministradorPage } from './privada-administrador.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PrivadaAdministradorPageRoutingModule
  ],
  declarations: [PrivadaAdministradorPage]
})
export class PrivadaAdministradorPageModule {}

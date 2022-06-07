import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PrivadaAdministradorPage } from './privada-administrador.page';

const routes: Routes = [
  {
    path: '',
    component: PrivadaAdministradorPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PrivadaAdministradorPageRoutingModule {}

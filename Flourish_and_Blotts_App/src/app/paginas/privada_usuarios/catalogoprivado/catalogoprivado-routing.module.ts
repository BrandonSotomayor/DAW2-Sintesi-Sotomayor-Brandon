import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CatalogoprivadoPage } from './catalogoprivado.page';

const routes: Routes = [
  {
    path: '',
    component: CatalogoprivadoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CatalogoprivadoPageRoutingModule {}

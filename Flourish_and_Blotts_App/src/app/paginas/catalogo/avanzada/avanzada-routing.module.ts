import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AvanzadaPage } from './avanzada.page';

const routes: Routes = [
  {
    path: '',
    component: AvanzadaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AvanzadaPageRoutingModule {}

import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { MicuentaresponsablePage } from './micuentaresponsable.page';

const routes: Routes = [
  {
    path: '',
    component: MicuentaresponsablePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MicuentaresponsablePageRoutingModule {}

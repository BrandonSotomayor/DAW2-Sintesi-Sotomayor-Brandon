import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { MicuentausuarioPage } from './micuentausuario.page';

const routes: Routes = [
  {
    path: '',
    component: MicuentausuarioPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MicuentausuarioPageRoutingModule {}

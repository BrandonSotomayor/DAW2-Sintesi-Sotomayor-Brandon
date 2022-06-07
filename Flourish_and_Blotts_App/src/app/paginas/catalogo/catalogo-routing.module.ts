import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CatalogoPage } from './catalogo.page';

const routes: Routes = [
  {
    path: '',
    component: CatalogoPage,
    children: [
      {
        path: 'avanzada',
        loadChildren: () => import('./avanzada/avanzada.module').then( m => m.AvanzadaPageModule)
      },
      {
        path: 'simple',
        loadChildren: () => import('./simple/simple.module').then( m => m.SimplePageModule)
      },
    ]
  },
  {
    path: 'simple',
    loadChildren: () => import('./simple/simple.module').then( m => m.SimplePageModule)
  },
  {
    path: 'avanzada',
    loadChildren: () => import('./avanzada/avanzada.module').then( m => m.AvanzadaPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CatalogoPageRoutingModule {}

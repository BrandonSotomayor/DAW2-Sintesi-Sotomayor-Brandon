import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PaginasPage } from './paginas.page';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'paginas',
    pathMatch: 'full',
    children: [
      {
        path: 'iniciarsesion',
        loadChildren: () => import('./iniciarsesion/iniciarsesion.module').then( m => m.IniciarsesionPageModule)
      },
      {
        path: 'home',
        loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
      },
      {
        path: 'privada-administrador',
        loadChildren: () => import('./privada-administrador/privada-administrador.module').then( m => m.PrivadaAdministradorPageModule)
      },
      {
        path: 'catalogo',
        loadChildren: () => import('./catalogo/catalogo.module').then( m => m.CatalogoPageModule)
      },
      {
        path: 'horario',
        loadChildren: () => import('./horario/horario.module').then( m => m.HorarioPageModule)
      },
    ]
  },
  {
    path: 'iniciarsesion',
    loadChildren: () => import('./iniciarsesion/iniciarsesion.module').then( m => m.IniciarsesionPageModule)
  },
  {
    path: 'privada-administrador',
    loadChildren: () => import('./privada-administrador/privada-administrador.module').then( m => m.PrivadaAdministradorPageModule)
  },
  {
    path: 'catalogo',
    loadChildren: () => import('./catalogo/catalogo.module').then( m => m.CatalogoPageModule)
  },
  {
    path: 'horario',
    loadChildren: () => import('./horario/horario.module').then( m => m.HorarioPageModule)
  },
  {
    path: 'home',
    loadChildren: () => import('./home/home.module').then( m => m.HomePageModule)
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PaginasPageRoutingModule {}

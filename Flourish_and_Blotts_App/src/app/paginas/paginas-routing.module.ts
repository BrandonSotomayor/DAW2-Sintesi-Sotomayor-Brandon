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
        path: 'catalogo',
        loadChildren: () => import('./catalogo/catalogo.module').then( m => m.CatalogoPageModule)
      },
      {
        path: 'horario',
        loadChildren: () => import('./horario/horario.module').then( m => m.HorarioPageModule)
      },
      {
        path: 'micuenta',
        loadChildren: () => import('./privada_usuarios/micuenta/micuenta.module').then( m => m.MicuentaPageModule)
      },
      {
        path: 'micuentaresponsable',
        loadChildren: () => import('./privada_usuarios/micuentaresponsable/micuentaresponsable.module').then( m => m.MicuentaresponsablePageModule)
      },
      
    ]
  },
  {
    path: 'iniciarsesion',
    loadChildren: () => import('./iniciarsesion/iniciarsesion.module').then( m => m.IniciarsesionPageModule)
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
  {
    path: 'responsable',
    loadChildren: () => import('./privada_usuarios/responsable/responsable.module').then( m => m.ResponsablePageModule)
  },
  {
    path: 'usuario',
    loadChildren: () => import('./privada_usuarios/usuario/usuario.module').then( m => m.UsuarioPageModule)
  },
  {
    path: 'administrador',
    loadChildren: () => import('./privada_usuarios/administrador/administrador.module').then( m => m.AdministradorPageModule)
  },
  {
    path: 'micuenta',
    loadChildren: () => import('./privada_usuarios/micuenta/micuenta.module').then( m => m.MicuentaPageModule)
  },
  {
    path: 'micuentaresponsable',
    loadChildren: () => import('./privada_usuarios/micuentaresponsable/micuentaresponsable.module').then( m => m.MicuentaresponsablePageModule)
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PaginasPageRoutingModule {}

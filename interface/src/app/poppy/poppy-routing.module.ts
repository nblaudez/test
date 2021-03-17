import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PoppyListComponent } from './components/poppy-list/poppy-list.component';
import { PoppyCreateComponent } from './components/poppy-create/poppy-create.component';
import { PoppyGameComponent } from './components/poppy-game/poppy-game.component';


const routes: Routes = [
  {
    path: 'poppy/friends',
    component: PoppyListComponent
  },
  {
    path: 'poppy/create',
    component: PoppyCreateComponent
  },
  {
    path: 'poppy/game',
    component: PoppyGameComponent
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PoppyRoutingModule { }

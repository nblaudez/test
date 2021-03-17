import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { PoppyRoutingModule } from './poppy-routing.module';
import { PoppyCreateComponent } from './components/poppy-create/poppy-create.component';
import { PoppyListComponent } from './components/poppy-list/poppy-list.component';
import { PoppyGameComponent } from './components/poppy-game/poppy-game.component';


@NgModule({
  declarations: [PoppyCreateComponent, PoppyListComponent, PoppyGameComponent],
  imports: [
    CommonModule,
    PoppyRoutingModule,
    FormsModule,
    HttpClientModule
  ]
})
export class PoppyModule { }


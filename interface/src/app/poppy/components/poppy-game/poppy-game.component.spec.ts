import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PoppyGameComponent } from './poppy-game.component';

describe('PoppyGameComponent', () => {
  let component: PoppyGameComponent;
  let fixture: ComponentFixture<PoppyGameComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PoppyGameComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PoppyGameComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

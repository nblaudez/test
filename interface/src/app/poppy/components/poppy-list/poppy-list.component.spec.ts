import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PoppyListComponent } from './poppy-list.component';

describe('PoppyListComponent', () => {
  let component: PoppyListComponent;
  let fixture: ComponentFixture<PoppyListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PoppyListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PoppyListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

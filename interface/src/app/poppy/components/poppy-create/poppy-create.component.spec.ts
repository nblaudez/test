import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PoppyCreateComponent } from './poppy-create.component';

describe('PoppyCreateComponent', () => {
  let component: PoppyCreateComponent;
  let fixture: ComponentFixture<PoppyCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PoppyCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PoppyCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

import { Component, OnInit } from '@angular/core';
import { HttpService } from '../../services/Http.service';

@Component({
  selector: 'app-poppy-game',
  templateUrl: './poppy-game.component.html',
  styleUrls: ['./poppy-game.component.scss']
})
export class PoppyGameComponent implements OnInit {


  public message;

  constructor(public httpService: HttpService) { }

  ngOnInit(): void {
    this.play();
  }

  play() {
    this.httpService.get('http://localhost:8000/call-monster').subscribe(result => {
      this.message = result['message'];
    })
  }

}

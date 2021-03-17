import { Component, OnInit } from '@angular/core';
import { HttpService } from '../../services/Http.service';

@Component({
  selector: 'app-poppy-list',
  templateUrl: './poppy-list.component.html',
  styleUrls: ['./poppy-list.component.scss']
})
export class PoppyListComponent implements OnInit {


  public friends;
  public messageNoFriend;
  public noFriend = false;
  public eatenfriends;
  public messageNoFriendEaten;
  public noFriendEaten = false;
  constructor(public httpService: HttpService) { }

  ngOnInit(): void {
    this.httpService.get('http://localhost:8000/friends').subscribe(result => {
      if(result['message'] != undefined) {
        this.noFriend = true;
        this.messageNoFriend = result['message'];
      } else {
        this.friends = result;
      }
    })
    this.httpService.get('http://localhost:8000/eaten').subscribe(result => {
      if(result['message'] != undefined) {
        this.noFriendEaten = true;
        this.messageNoFriendEaten = result['message'];
      } else {
        this.eatenfriends = result;
      }
    })
  }

}

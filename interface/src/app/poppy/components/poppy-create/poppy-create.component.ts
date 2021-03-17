import { Component, OnInit } from '@angular/core';
import { HttpService } from '../../services/Http.service';

@Component({
  selector: 'app-poppy-create',
  templateUrl: './poppy-create.component.html',
  styleUrls: ['./poppy-create.component.scss']
})
export class PoppyCreateComponent implements OnInit {

  public poppy= {"name":"","friendshipvalue":"","type":"","tags":[]}
  public addedMessage = false;
  public newTag;

  constructor(public httpService: HttpService) { }

  ngOnInit(): void {
  }

  addFriend() {
    this.httpService.put("http://localhost:8000/friend", this.poppy).subscribe(response => {
      if(response['message'] != undefined)
        this.addedMessage = response['message'];
      if(response['error'] != undefined)
        this.addedMessage = response['error'];
        
      this.poppy= {"name":"","friendshipvalue":"","type":"","tags":[]};
      this.newTag="";
    })
  }

  addTag() {    
    this.poppy.tags.push(this.newTag);
    
  }

}

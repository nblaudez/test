import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import {tap} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class HttpService {
  constructor(protected http: HttpClient) {}

  get(url, params = undefined, headers = {}, ) {
    if(params != undefined) {
      let queryString = this.objectToQuerystring(params);
      url = url + queryString;
    }
    return this.http.get(url, {headers: new HttpHeaders(headers), params: params}).pipe(tap(
       data => this.successHandler(url, data),
      error => this.errorHandler(url, error)
    ));
  }
  put(url, params = undefined, headers = undefined) {
    return this.http.put(url, params).pipe(tap(
      data => this.successHandler(url, data),
      error => this.errorHandler(url, error)
    ));
  }


  objectToQuerystring (obj) {
    return Object.keys(obj).reduce(function (str, key, i) {
      var delimiter, val;
      delimiter = (i === 0) ? '?' : '&';
      key = encodeURIComponent(key);
      val = encodeURIComponent(obj[key]);
      return [str, delimiter, key, '=', val].join('');
    }, '');
  }

  successHandler(url, data) {    
    return data;
  }
  errorHandler(url, error) {
      console.log("#### ERROR:", error);    
  }

}

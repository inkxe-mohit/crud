import { Component} from '@angular/core';
import {Http} from '@angular/http';
import 'rxjs/add/operator/map';

@Component({
  selector: 'app-insert',
  templateUrl: './insert.component.html',
  styleUrls: ['./insert.component.css']
})

export class InsertComponent  
{
  public id="";
  public firstname="";
  public lastname="";
  public email="";
  public students = [];

  constructor( private http:Http )
  {
    this.http.get("http://localhost/phpfolder/merge.php")
    .map(res =>res.json())
    .subscribe((data ) =>{
      //console.log(data);
     this.students=data;
   });
  }
  
 
  submit=function()
  {
    var opt = 1;
    console.log(this.id);
    console.log(this.firstname);
    console.log(this.lastname);
    console.log(this.email);
   
    var info =JSON.stringify({ option:opt, id:this.id, firstname:this.firstname, lastname:this.lastname, email:this.email });
    this.http.post('http://localhost/phpfolder/merge.php',info) 
    .subscribe(data => {});
  }

  update=function()
  {
    var opt = 2;
    console.log(this.id);
    console.log(this.firstname);
    console.log(this.lastname);
    console.log(this.email);

    //converts a js data into a string to send to web server

    var info =JSON.stringify({ option:opt, id:this.id, firstname:this.firstname, lastname:this.lastname, email:this.email });
    //posting the data to the php file address
    this.http.post('http://localhost/phpfolder/merge.php',info) 
    .subscribe(data => {});
  }

  delete=function()
  {
    var opt = 3;
    console.log(this.id);
    console.log(this.firstname);
    console.log(this.lastname);
    console.log(this.email);
   
    var info =JSON.stringify({ option:opt, id:this.id, firstname:this.firstname, lastname:this.lastname, email:this.email });
    this.http.post('http://localhost/phpfolder/merge.php',info) 
    .subscribe(data => {});
  }
}
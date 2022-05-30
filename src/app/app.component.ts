import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http'; 
@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  imageSrc:any = '';
  status:boolean = false
  constructor(private http: HttpClient) { }
  ngOnInit(): void { }
  onFileChange(event:any) {
    this.status = false
    const file = event.target.files[0];
    this.status = event.target.files.length>0?true:false
    if(this.status==true){
       const reader = new FileReader();
       reader.readAsDataURL(file);
       reader.onload = () => {
          this.imageSrc = reader.result;          
       }
    }
  }
  submit(){
    this.http.post('http://localhost/api/imageupload.php', {'image':this.imageSrc})
      .subscribe(response => {
          console.log('Uploaded Successfully.',response);
       
      })
  }
}
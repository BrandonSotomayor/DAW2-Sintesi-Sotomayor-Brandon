import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-avanzada',
  templateUrl: './avanzada.page.html',
  styleUrls: ['./avanzada.page.scss'],
})
export class AvanzadaPage implements OnInit {

  public autor = '';
  public titulo = '';
  public categoria = '';

  constructor() { }

  buscar(){
    
  }

  ngOnInit() {
  }

}

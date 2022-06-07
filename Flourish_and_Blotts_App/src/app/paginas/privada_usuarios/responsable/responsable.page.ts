import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { BarcodescannerService } from 'src/app/servicios/barcodescanner.service';
import { LibraryService } from 'src/app/servicios/library.service';

@Component({
  selector: 'app-responsable',
  templateUrl: './responsable.page.html',
  styleUrls: ['./responsable.page.scss'],
})
export class ResponsablePage implements OnInit {
  
  public post = 0;

  scanActive: boolean = false;
  scanContent: string = '';

  public nuevo_libro = false;
  public agregar_libro;

  constructor(private _bsService: BarcodescannerService, private _router: Router, private _authService: AuthService, private _libraryService: LibraryService) { 
    this._bsService.configureScanner();
  }

  async startScanner(){
    const allowed = await this._bsService.checkPermissions();
    if ( allowed == true ){

      this.scanActive = true;
      document.body.classList.add('qrscanner');
      const code = await this._bsService.startScanner();
      //const result = await this._bsService.startScanner();
      document.body.classList.remove('qrscanner');


      if ( code != null ){
        this.scanContent = code;
        this._libraryService.seach(code);
        console.log(code);
        //his._libraryService.seach(code);

        this._bsService.stopScanner();
        this.scanActive = false;
      }

      console.log('startScanner');
    }
  }

  mi_cuenta(){

  }

  cerrar_sesion(){
    this._authService.logout();
    this._router.navigate(['paginas','iniciarsesion']);
  }

  obtainBook(){
    this.nuevo_libro = true;

    let code:string[] = ['9788401336560','9786073807869','9786073193948','9788415745167','9786073193917'];
    this._libraryService.seach(code[this.post%5]);
    this.post += 1;
    
    this.agregar_libro = this._libraryService.getLibros;
  }

  ngOnInit() {
  }
}

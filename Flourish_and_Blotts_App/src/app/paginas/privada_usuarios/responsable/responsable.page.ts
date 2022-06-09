import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/servicios/auth.service';
import { BarcodescannerService } from 'src/app/servicios/barcodescanner.service';
import { LibraryService } from 'src/app/servicios/library.service';
import { LibrosService } from 'src/app/servicios/libros.service';

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
  public datos_libro:any;
  public datos_autor: string;
  public datos_categoria: string;

  constructor(private _bsService: BarcodescannerService, private _router: Router, private _authService: AuthService, private _libraryService: LibraryService, private _libroService: LibrosService) { 
    this._bsService.configureScanner();
    if ( this._authService.isUserAuthenticated() ) {
      this._router.navigate(["paginas", this._authService.rol]);
    }
    else this._router.navigate(["paginas",'iniciarsesion']);
  }

  async startScanner(){
    this.nuevo_libro = true;
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

        this._bsService.stopScanner();
        this.scanActive = false;
      }
    }
  }

  async startScannerEjemplar(){
    const allowed = await this._bsService.checkPermissions();
    if ( allowed == true ){

      this.scanActive = true;
      document.body.classList.add('qrscanner');
      const code = await this._bsService.startScanner();
      //const result = await this._bsService.startScanner();
      document.body.classList.remove('qrscanner');


      if ( code != null ){
        this.scanContent = code;
        this._libroService.agregar_ejemplar_datos_post(code);
        this._libraryService.seach(code);
        console.log(code);

        this._bsService.stopScanner();
        this.scanActive = false;
      }
    }
  }

  mi_cuenta(){
    this._router.navigate(['paginas','micuentaresponsable']);
  }

  cerrar_sesion(){
    this._authService.logout();
    this._router.navigate(['paginas','iniciarsesion']);
  }

  obtainBook(){
    this.nuevo_libro = true;

    let code:string[] = ['9788401336560','9786073193948','9788415745167','9786073193917'];
    this._libraryService.seach(code[this.post%4]);
    this.post += 1;
  }

  agregar_libro(){
    this._libroService.agregar_libro_datos_post(this.datos_libro, this.datos_autor, this.datos_categoria);
    this.nuevo_libro = false;
  }

  prueba_ejemplar(){

    this._libroService.agregar_ejemplar_datos_post('9788401336560');
    
  }

  cancelar(){
    this.nuevo_libro = false;
  }


  get libro():any{
    this.datos_libro = this._libraryService.getLibros;
    console.log(this.datos_libro);
    return this.datos_libro;
  }

  get autor():string{
    this.datos_autor = this._libraryService.autores;
    console.log(this._libraryService.autores);
    return this._libraryService.autores;
  }

  get categoria():string{
    this.datos_categoria = this._libraryService.categorias;
    console.log(this._libraryService.categorias);
    return this._libraryService.categorias;
  }
  

  ngOnInit() {
  }
}

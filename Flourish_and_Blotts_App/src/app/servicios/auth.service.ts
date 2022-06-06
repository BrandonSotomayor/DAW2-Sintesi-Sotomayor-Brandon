import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private BASE_URL: string = "http://localhost:80/api";
  private _email: string = null;
  private _passwd: string = null;

  constructor(public _http: HttpClient) { }

  async login(email: string, passwd: string): Promise<boolean> {
    this._email = email;
    this._passwd = passwd;

    /*La crida necessita els headers, en aquest cas, el 'Content-Type'.
    També s'hi pot afegir el header 'Accept'*/
    let options: any = {
        headers: new HttpHeaders({
            'Content-Type': 'application/json',
        })
    }

    //CON EL NOMBRE DE LOS CAMPOS VERDADEROS DE LA TABLA
    const data: any = {
        'correo_electronico':  this._email,
        'contrasena':  this._passwd
    }

    //Realització de la crida, embolcallada en una Promise (per poder fer l'await)
    return new Promise(
        (resolve, reject) => {
            //Una crida POST ha de rebre l'URL, les dades i les opcions (capçaleres)
            this._http.post(this.BASE_URL + "/iniciar_sesion", data, options).subscribe(
                (response: any) => {
                    if(response.status == 200) {
                        //Si tot va bé, emmagatzemem el TOKEN al LS
                        localStorage.setItem("TOKEN", response.token);
                        resolve(true);
                        console.log('entra login');
                    }
                    else {
                      resolve(false);
                      console.log('no inicia sesion');
                    }
                },
                (error: any) => {
                    reject("Error");
                }
            );
        }
    );
  }

  /*Utilitzarem aquesta funció per reinicar la sessió quan el token hagi expirat.
        Cal tenir en compte que, per poder-la executar, ens cal assegurar que el service tingui
        les dades de les credencials de l'usuari*/
  async restartSession(): Promise<boolean> {
    if(this._email != null && this._passwd != null) {
      const logResult = await this.login(this._email, this._passwd);
      if(logResult) return true;
    }
    return false;
  }
  
  //Per tancar la sessió només cal esborrar credencials i el TOKEN
  logout(): void {
    this._email = null;
    this._passwd = null;
    localStorage.removeItem("TOKEN");
  }
  
  get token(): string {
    return localStorage.getItem("TOKEN");
  }
  
  set token(token: string) {
    console.log(token);
    localStorage.setItem("TOKEN", token);
  }
  
  /*Per ajudar-vos durant el desenvolupament i per tal que pugueu ser més àgils programant,
        podeu comentar la comprovació de les credencials. En el codi final, aquesta comprovació 
        hi ha de ser*/
  isUserAuthenticated(): boolean {
    return this._email != null && this._passwd != null && localStorage.getItem("TOKEN") != null;
  }
}

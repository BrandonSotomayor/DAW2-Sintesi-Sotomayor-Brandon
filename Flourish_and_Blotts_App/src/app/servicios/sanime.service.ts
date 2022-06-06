import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { AnimeCharacter } from '../models/anime';

@Injectable({
  providedIn: 'root'
})
export class SanimeService {

  private BASE_URL = "https://api.jikan.moe/v4/";
  private CHARACTERS_ENDPOINT: string = "anime";
  private _animeCharactersTv: AnimeCharacter[] = [];
  private _animeCharactersMovie: AnimeCharacter[] = [];
  private _animeCharacters: AnimeCharacter[] = [];
  private cont = 1;
  private maxPage = 947;

  constructor(private http: HttpClient) { }

  retrieveAnimeCharacters(): void{
    this.http.get(this.BASE_URL + this.CHARACTERS_ENDPOINT+"?page="+this.cont).subscribe(
      (dchar : any) => {
        for( let i= 0; i< dchar.data.length; i++ ){
          let character: AnimeCharacter = {
            id: dchar.data[i].mal_id,
            name: dchar.data[i].title,
            image: dchar.data[i].images.jpg.image_url,
            type: dchar.data[i].type,
            episodis: dchar.data[i].episodes,
            direccio: dchar.data[i].url,
            any: dchar.data[i].year,
            synopsis: dchar.data[i].synopsis,
          };
          //console.log(character);
          if ( dchar.data[i].type == "TV" ) {
            this._animeCharactersTv.push(character);
            this._animeCharacters.push(character);
          }
          else if ( dchar.data[i].type == "Movie" ) {
            this._animeCharactersMovie.push(character);
            this._animeCharacters.push(character);
          }
        }
        this.cont ++;
        this.retrieveAnimeCharacters();
        console.log(this.cont);
      } 
    );
    //console.log(this.animeCharacters);
  }
  get animeCharactersTv(): AnimeCharacter[]{
    return this._animeCharactersTv;
  }

  get animeCharactersMovie(): AnimeCharacter[]{
    return this._animeCharactersMovie;
  }
  get animeCharacters(): AnimeCharacter[]{
    return this._animeCharacters;
  }

  anotherPage():void{
    
  } 

  maxPages(){
    if ( this.maxPage == this.cont+1 ){
      return true;
    }
    else return false;
  }
}

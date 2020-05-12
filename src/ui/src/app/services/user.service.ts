import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { HttpHeaders } from '@angular/common/http';
import { environment } from './../../environments/environment';

import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

import { User } from '../classes/user';
import { Profile } from '../classes/profile';

// import { HttpErrorHandler, HandleError } from '../http-error-handler.service';


const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
  })
};

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private httpClient: HttpClient) { }

  userUrl = environment.apiUrl;

  //////// Save methods //////////

  /** POST: add a new hero to the database */
  // addHero (hero: Hero): Observable<Hero> {
  //   return this.http.post<Hero>(this.heroesUrl, hero, httpOptions)
  //     .pipe(
  //       catchError(this.handleError('addHero', hero))
  //     );
  // }
  loginUser(user: User): Observable<User> {
    return this.httpClient.post<User>(`${this.userUrl}/login/login.php`, user, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }

  createUser(user: User): Observable<User> {
    console.log("createUser: ", user);
    return this.httpClient.post<User>(`${this.userUrl}/register/create.php`, user, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }
  updateProfile(profile: Profile): Observable<Profile> {
    // console.log("updateProfile: ", profile);
    return this.httpClient.post<Profile>(`${this.userUrl}/profile/update.php`, profile, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }

  showProfile(): Observable<Profile> {

    console.log('email auth:', localStorage.getItem("emailAuth"));
    let email = localStorage.getItem("emailAuth");
    let options = email ?
      { params: new HttpParams().set('email', email) } : {};

    return this.httpClient.get<Profile>(`${this.userUrl}/profile/read.php`, options)
      .pipe(
        catchError(this.handleError)
      );
  }


  private handleError(error: HttpErrorResponse) {
    if (error.error instanceof ErrorEvent) {
      console.error("An error has ocurred: ", error.error.message);
    }
    else {
      //branch of the status 401 and display user or password invalid
      console.error('Status: ', error.status);
      console.error('Body was: ', error.error);
    }
    return throwError(error);
    // return throwError(" Something bad happened; try again later!");
  }
}

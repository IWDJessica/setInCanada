import { Injectable } from '@angular/core';
import { HttpHeaders, HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { ServiceProvider } from '../classes/service-provider';
import { catchError } from 'rxjs/operators';
import { environment } from './../../environments/environment';


const httpOptions = {
  headers: new HttpHeaders({
    'Content-Type': 'application/json',
  })
};

@Injectable({
  providedIn: 'root'
})
export class ServiceProviderService {


  constructor(private httClient: HttpClient) { }
  private apiUrl = environment.apiUrl;

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
  
  createServiceProvider(serviceProvider: ServiceProvider): Observable<ServiceProvider> {
    return this.httClient.post<ServiceProvider>(`${this.apiUrl}/providers/create.php`, serviceProvider, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }

  //TODO: retrieve serviceProvider by id (only one), could be found in user.service.ts method showProfile()
  //TODO: retrieve serviceProvider array by service type (multiples), could be found in user.service.ts method showProfile()
}

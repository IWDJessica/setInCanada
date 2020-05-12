//File for app routing module
import { Routes, RouterModule } from '@angular/router';

import { HomeComponent } from './home';
import { LoginComponent } from './login';
import { AboutComponent } from './about';
import { RegisterComponent } from './register/register.component';
import { InfoPagesComponent } from './info-pages/info-pages.component';
import { SettleHomeComponent } from './settleHome';
import { SettlementnavComponent } from './settlementnav';
import { AutomobileComponent } from './automobile';
import { AccomodationComponent } from './accomodation/accomodation.component';
import { InsuranceComponent } from './insurance';
import { PickupServiceComponent } from './pickup-service';
import { ProfileComponent } from './profile/profile.component';
import { Component } from '@angular/core';
import { VendorRegistrationComponent } from './vendor-registration/vendor-registration.component';

//Routing for the Angular app is configured as an arrayy of Routes
//each component is mapped to a path so the Angular Router knows which component to
//display based on the URL
const routes: Routes = [
    { path: '', component: HomeComponent },
    { path: 'login', component: LoginComponent},
    { path: 'about', component: AboutComponent},
    { path: 'register', component: RegisterComponent},
    { path: 'info-pages', component: InfoPagesComponent},
    { path: 'settlement', component: SettleHomeComponent},
    { path: 'settlementnav', component: SettlementnavComponent},
    { path: 'settlement/automobile', component:AutomobileComponent },
    
    { path: 'settlement/accomodation', component: AccomodationComponent},
    { path: 'settlement/insurance', component: InsuranceComponent},
    { path: 'settlement/pickup', component: PickupServiceComponent},
    
    { path: 'profile', component: ProfileComponent},
    { path: 'vendor-registration', component:VendorRegistrationComponent},
    

    //otherwise redirect to home
    { path: '**', redirectTo: '' }
];

//Routes array is passed to the RoutherModule.forRoot() method;
//which creates a routing module with all of the app routes configured
//also includes all of the Angular Router providers and directives such as
//<router-outlet></router-outlet>
export const appRoutingModule = RouterModule.forRoot(routes);

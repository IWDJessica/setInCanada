import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms';
import { HomeComponent } from './home';
import { NavComponent } from './nav-bar/nav-bar.component';

// This will make the Angular Router providers and directives available to the other components in the App Module
import { appRoutingModule } from './app.routing';
import { AppComponent } from './app.component';
import { LoginComponent } from './login';
import { AboutComponent } from './about';
import { RegisterComponent } from './register/register.component';
import { FooterComponent } from './footer';
import { AlertComponent } from './alert';
import { InfoPagesComponent } from './info-pages/info-pages.component';
import { SettleHomeComponent } from './settleHome';
import { SettlementnavComponent } from './settlementnav';
import { AutomobileComponent } from './automobile';
import { AccomodationComponent } from './accomodation/accomodation.component';
import { BannerComponent } from './banner/banner.component';
import { InsuranceComponent } from './insurance';
import { PickupServiceComponent } from './pickup-service';
import { FooterActionComponent } from './footer-action/footer-action.component';
import { ProfileComponent } from './profile/profile.component';
import { VendorRegistrationComponent } from './vendor-registration/vendor-registration.component';

@NgModule({
   // declarationsaretomakedirectives(includingcomponentsandpipes)fromthecurrentmoduleavailabletootherdirectivesinthecurrentmodule.\n
   declarations: [
      AppComponent,
      HomeComponent,
      LoginComponent,
      AboutComponent,
      RegisterComponent,
      NavComponent,
      FooterComponent,
      AlertComponent,
      InfoPagesComponent,
      SettleHomeComponent,
      SettlementnavComponent,
      AutomobileComponent,
      AccomodationComponent,
      BannerComponent,
      InsuranceComponent,
      PickupServiceComponent,
      FooterActionComponent,
      ProfileComponent,
      VendorRegistrationComponent,
      ],
   // importsmakestheexporteddeclarationsofothermodulesavailableinthecurrentmodule.\n
   imports: [
      BrowserModule,
      ReactiveFormsModule,
      HttpClientModule,
      appRoutingModule,
      BrowserAnimationsModule,
      NgbModule,
      FormsModule,
   ],
   providers: [],
   bootstrap: [
      AppComponent
   ],
})
export class AppModule { }

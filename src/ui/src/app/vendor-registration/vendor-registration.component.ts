import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, Validators, FormGroup } from '@angular/forms';

import { Details } from '../classes/details';
import { UserService } from '../services/user.service';
import { ServiceProviderService } from '../services/service-provider.service';
import { ServiceProvider } from '../classes/service-provider';


@Component({
  selector: 'app-vendor-registration',
  templateUrl: './vendor-registration.component.html',
  providers: [UserService],
  styleUrls: ['./vendor-registration.component.css']
})
export class VendorRegistrationComponent implements OnInit {

  serviceProviderForm: FormGroup;

  serviceProviderModel = new ServiceProvider();
  detailModel = new Details();


  constructor(private userService: UserService,
    private formBuilder: FormBuilder,
    private serviceProviderService: ServiceProviderService) {

  }

  ngOnInit() {

    this.serviceProviderForm = this.formBuilder.group({
      // form names here as key: 'value',
      firstName: new FormControl(this.serviceProviderModel.firstName, [Validators.required]),
      lastName: new FormControl(this.serviceProviderModel.lastName, [Validators.required]),
      email: new FormControl(this.serviceProviderModel.email, [Validators.required, Validators.email]),
      contactNumber: new FormControl(this.serviceProviderModel.contactNumber),
      businessName: new FormControl(this.serviceProviderModel.businessName),
      serviceType: new FormControl(this.serviceProviderModel.serviceType),
      serviceName: new FormControl(this.serviceProviderModel.serviceName),
      street: new FormControl(this.detailModel.street),
      city: new FormControl(this.detailModel.city),
      province: new FormControl(this.detailModel.province),
      postalCode: new FormControl(this.detailModel.postalCode),
      price: new FormControl(this.detailModel.price),
      serviceHours: new FormControl(this.detailModel.serviceHours),
      comment: new FormControl(this.detailModel.comment),
      acceptTerms: new FormControl(this.detailModel.comment),
    });
    /**
     * contactNumber  --changing name /done
     * businessName / done
     * image ?? / N/A
     * acceptTerms  (0 false, 1 true)
     * acceptEmail  (0 false, 1 true)
     * service->name -- "name":"Temporaty Accomodation" ->
     * servicePrice -> map to  price (rename) /done
     * attributes ??? /N/A
     * imageService ??? /N/A
     */

  }

  onItemSelect(item: any) {
    console.log('onItemSelect', item);
  }

  onSelectAll(item: any) {
    console.log('onSelectAll', item);

  }

  get firstName() { return this.serviceProviderForm.get('firstName'); }
  get lastName() { return this.serviceProviderForm.get('lastName'); }
  get email() { return this.serviceProviderForm.get('email'); }
  get contactNumber() { return this.serviceProviderForm.get('contactNumber'); }
  get businessName() { return this.serviceProviderForm.get('businessName'); }
  get serviceType() { return this.serviceProviderForm.get('serviceType'); }
  get serviceName() { return this.serviceProviderForm.get('serviceName'); }

  get street() { return this.serviceProviderForm.get('street'); }
  get city() { return this.serviceProviderForm.get('city'); }
  get province() { return this.serviceProviderForm.get('province'); }
  get postalCode() { return this.serviceProviderForm.get('postalCode'); }
  get price() { return this.serviceProviderForm.get('price'); }
  get serviceHours() { return this.serviceProviderForm.get('serviceHours'); }
  get comment() { return this.serviceProviderForm.get('comment'); }
  get acceptTerms() { return this.serviceProviderForm.get('acceptTerms'); }

  onSubmit(serviceProviderData: any) {
    console.log('vendor-registration serviceProviderData:', serviceProviderData);
    serviceProviderData.acceptTerms = serviceProviderData.acceptTerms ? "1" : "0";


    this.serviceProviderService.createServiceProvider(serviceProviderData)
      .subscribe(() => {// succeeded
        // TODO: evaluate what to do when it succeed
        /**
         * clean form and redirect to some page? // 
         */
        this.serviceProviderForm.reset();
        console.log('vendor-registration success');
      }, error => {
        if (error.status === 409) {
          // TODO add alert service ? login.component.ts uses the alertService
          console.log('Vendor already exists');
        } else {
          console.log('bad data, something wrong happened');
        }
      });


  }
}



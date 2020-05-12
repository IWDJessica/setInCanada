import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, Validators, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

import { User } from '../classes/user';
import { UserService } from '../services/user.service';
import { AlertService } from '../services/alert.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  providers: [UserService],
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  //sucessMessage = "User registred with success! Now you are able to login."

  userForm: FormGroup;
  registerSucess: boolean = false;
  userModel = new User();

  constructor(private userService: UserService, private formBuilder: FormBuilder, private alertService:AlertService, private router: Router) {
    
  }

  ngOnInit() {
    this.userForm = this.formBuilder.group({
      //form names here as key: 'value',
      firstName: new FormControl(this.userModel.firstName, [Validators.required]),
      lastName: new FormControl(this.userModel.lastName, [Validators.required]),
      email: new FormControl(this.userModel.email, [Validators.required, Validators.email]),
      password: new FormControl(this.userModel.password, [Validators.required]),
      rePassword: new FormControl(this.userModel.rePassword, [Validators.required]),
      phoneNumber: new FormControl(this.userModel.phoneNumber),
      country: new FormControl(this.userModel.country),

    });
  }

  get firstName() { return this.userForm.get('firstName'); }
  get lastName() { return this.userForm.get('lastName'); }
  get email() { return this.userForm.get('email'); }
  get password() { return this.userForm.get('password'); }
  get rePassword() { return this.userForm.get('rePassword'); }

  onSubmit(userData: User) {
    console.log('userData:', userData);
    // process user creation
    this.userService.createUser(userData)
    .subscribe(() => {
      this.registerSucess = true;
      this.alertService.success('User registred with success! Now you are able to login', true);
      setTimeout(() => {
        this.router.navigate(['/login']);
    }, 1500);  // 5s
      // this.router.navigate(['']);
    },
    error => {
      this.alertService.error('Registeration Failed', true);
    });

    this.userForm.reset();
  }

}

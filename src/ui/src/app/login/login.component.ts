import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { User } from '../classes/user';
import { UserService } from '../services/user.service';

import { AlertService } from '../services/alert.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
  providers: [UserService]
})
export class LoginComponent implements OnInit {
  loginSuccess: boolean = false;
  successMessage: "Login success";

  loginForm;
  userModel = new User();
  constructor(private userService: UserService, private formBuilder: FormBuilder, private router: Router, private alertService: AlertService) {

  }

  ngOnInit() {
    this.loginForm = this.formBuilder.group({
      email: new FormControl(this.userModel.email, [Validators.required, Validators.email]),
      password: new FormControl(this.userModel.password, [Validators.required])
    });
  }

  get email() { return this.loginForm.get('email'); }
  get password() { return this.loginForm.get('password'); }

  onLogin(userData: User) {
    //print test   
    // console.log("user login:", userData);
    this.userService.loginUser(userData)
      .subscribe(() => {
        this.loginSuccess = true;
        //save to localstorage
        localStorage.setItem("emailAuth", userData.email);

        this.router.navigate(['/profile'])
      },
        error => {
          if (error.status === 401) {
            this.alertService.error("Invalid credentials", false);
          } else {
            this.alertService.error("Sorry, something went wrong. Try again later", false);
          }
        });

    this.loginForm.reset();
  }

}

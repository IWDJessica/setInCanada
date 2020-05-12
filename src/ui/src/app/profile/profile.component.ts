import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl } from '@angular/forms';
import { Router } from '@angular/router';


import { Profile } from '../classes/profile';
import { UserService } from '../services/user.service';
import { AlertService } from '../services/alert.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  providers: [UserService],
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  profile: Profile = new Profile();

  profileForm;
  registerSuccess: boolean = false;

  constructor(public userService: UserService, private formBuilder: FormBuilder, private alertService: AlertService, private router: Router) {

  }


  ngOnInit() {
    this.showProfile();

    this.profileForm = this.formBuilder.group({
      firstName: new FormControl(this.profile.firstName),
      lastName: new FormControl(this.profile.lastName),
      email: new FormControl(this.profile.email),
      phoneNumber: new FormControl(this.profile.phoneNumber),
      country: new FormControl(this.profile.country),
    })
  }

  onSubmit(profData: Profile) {
    // console.log("Profile.edit: ", profData);
    console.log("profile form", this.profileForm);
    this.userService.updateProfile(profData)
      .subscribe(() => {
        this.registerSuccess = true;
        window.location.reload();
      });
  }


  showProfile() {
    this.userService.showProfile().subscribe(profile => {
      this.profile = profile;
      localStorage.setItem("firstName", profile.firstName);
      console.log("Profiles: ", this.profile);
    });
  }

}

import { Component, OnInit } from '@angular/core';

@Component({
	selector: 'nav-bar',
	templateUrl: 'nav-bar.component.html',
	styleUrls: ['./nav-bar.component.css'],

})

export class NavComponent implements OnInit {
	// public isCollapsed = true;
	public displayName: string;

	// public isMenuCollapsed = true;
	ngOnInit() { }

	isLoggedUser(){
		let email = localStorage.getItem("emailAuth");
		this.displayName = localStorage.getItem("firstName");
		return email !== null;		
	}


}
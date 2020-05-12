import { Component, OnInit } from '@angular/core';
import { PickupService } from '../classes/pickup-service';
import { FormControl } from '@angular/forms';


@Component({
	selector: 'pickup-sesrvice',
	templateUrl: 'pickup-service.component.html',
	styleUrls: ['./pickup-service.component.css']
})

export class PickupServiceComponent implements OnInit {
	counter: number;
	pickupservice =  new FormControl();
	pickuplocation = ['London Airport', 'Toronto International Airport', 'Hamilton', 'Windsor', 'Toronto downtown', 'Kithchener'];

	submitted = false;

	//time = { hour: 1, minute: 30};

	onSubmit(){
		this.submitted = true;
	}
	
	ngOnInit() { }

	update() {}
}
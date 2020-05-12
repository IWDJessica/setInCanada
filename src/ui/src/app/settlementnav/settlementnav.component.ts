import { Component, OnInit } from '@angular/core';
import { NgbCarouselConfig } from '@ng-bootstrap/ng-bootstrap';
import { Router } from '@angular/router';

@Component({
	selector: 'settlementnav',
	templateUrl: 'settlementnav.component.html',
	styleUrls: ['./settlementnav.component.css'],
})

export class SettlementnavComponent implements OnInit {
	showNavigationArrows = false;
	showNavigationIndicators = false;
	img1 = '../../assets/settleback.png';
	img2 = '../../assets/accomodation.jpg';
	img3 = '../../assets/automobile.jpg';
	img4 = '../../assets/insurance.jpeg';
	img5 = '../../assets/pickup.png';
	
	images = [this.img1, this.img2, this.img3, this.img4, this.img5];
	
	constructor(private router: Router){

	}
	ngOnInit() { 
		
	}

	isSettleHomeRoute() {
		return this.router.url === '/settlement';
	  }
	
	isAccomodtaionRoute(){
		return this.router.url === '/settlement/accomodation';
	}

	isAutomobileRoute(){
		return this.router.url === '/settlement/automobile';
	}

	isInsuranceRoute(){
		return this.router.url === '/settlement/insurance';
	}

	isPickupRoute(){
		return this.router.url === '/settlement/pickup';
	}
}
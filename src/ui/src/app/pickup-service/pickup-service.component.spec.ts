import { TestBed, inject } from '@angular/core/testing';

import { PickupServiceComponent } from './pickup-service.component';

describe('a pickup-service component', () => {
	let component: PickupServiceComponent;

	// register all needed dependencies
	beforeEach(() => {
		TestBed.configureTestingModule({
			providers: [
				PickupServiceComponent
			]
		});
	});

	// instantiation through framework injection
	beforeEach(inject([PickupServiceComponent], (PickupServiceComponent) => {
		component = PickupServiceComponent;
	}));

	it('should have an instance', () => {
		expect(component).toBeDefined();
	});
});
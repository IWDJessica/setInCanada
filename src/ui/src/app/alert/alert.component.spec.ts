import { TestBed, inject } from '@angular/core/testing';

import { AlertComponent } from './alert.component';

describe('a alert component', () => {
	let component: AlertComponent;

	// register all needed dependencies
	beforeEach(() => {
		TestBed.configureTestingModule({
			providers: [
				AlertComponent
			]
		});
	});

	// instantiation through framework injection
	beforeEach(inject([AlertComponent], (AlertComponent) => {
		component = AlertComponent;
	}));

	it('should have an instance', () => {
		expect(component).toBeDefined();
	});
});
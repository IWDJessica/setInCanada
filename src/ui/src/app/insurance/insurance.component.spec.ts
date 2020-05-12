import { TestBed, inject } from '@angular/core/testing';

import { InsuranceComponent } from './insurance.component';

describe('a insurance component', () => {
	let component: InsuranceComponent;

	// register all needed dependencies
	beforeEach(() => {
		TestBed.configureTestingModule({
			providers: [
				InsuranceComponent
			]
		});
	});

	// instantiation through framework injection
	beforeEach(inject([InsuranceComponent], (InsuranceComponent) => {
		component = InsuranceComponent;
	}));

	it('should have an instance', () => {
		expect(component).toBeDefined();
	});
});
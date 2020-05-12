import { TestBed, inject } from '@angular/core/testing';

import { AutomobileComponent } from './automobile.component';

describe('a automobile component', () => {
	let component: AutomobileComponent;

	// register all needed dependencies
	beforeEach(() => {
		TestBed.configureTestingModule({
			providers: [
				AutomobileComponent
			]
		});
	});

	// instantiation through framework injection
	beforeEach(inject([AutomobileComponent], (AutomobileComponent) => {
		component = AutomobileComponent;
	}));

	it('should have an instance', () => {
		expect(component).toBeDefined();
	});
});
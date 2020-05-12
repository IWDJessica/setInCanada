import { Component, OnInit, Input } from '@angular/core';
import { FooterAction } from '../classes/footer-action';

@Component({
  selector: 'app-footer-action',
  templateUrl: './footer-action.component.html',
  styleUrls: ['./footer-action.component.css']
})
export class FooterActionComponent implements OnInit {
  @Input() type: string;
  footerContent: FooterAction;

  constructor() { }

  ngOnInit() {
    this.getContent();
  }

  getContent() {
    this.footerContent = new FooterAction();
    this.footerContent.content = new Array<string>();

    switch (this.type) {
      case "insurance":
        this.footerContent.service = "Insurance";
        this.footerContent.content.push(`Are you a company offering the ${this.footerContent.service}?`);

        break;
      case "accomodation":
        this.footerContent.service = "Accomodations";
        this.footerContent.content.push(`Are you a Business Owner regards ${this.footerContent.service}?`);
        break;

      case "pickupservice":
        this.footerContent.service = "pickup service";

        this.footerContent.content.push(`Are you individul or the company offering ${this.footerContent.service}?`);
        break;
      case "automobile":
        this.footerContent.service = "Dealers";

        this.footerContent.content.push(`Are you ${this.footerContent.service}?`);
        break;
    }

    return this.footerContent;
  }

}

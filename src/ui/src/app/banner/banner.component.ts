import { Component, OnInit, Input } from '@angular/core';
import { Banner } from '../classes/banner';


const red = "#F33C3C";
const petrol = "#303E3E";


@Component({
  selector: 'app-banner',
  templateUrl: './banner.component.html',
  styleUrls: ['./banner.component.css']
})
export class BannerComponent implements OnInit {
  @Input() type: string;
  bannerContent: Banner;

  constructor() { }

  ngOnInit() {
    this.getContent();
  }

  getBgColor() {
    switch (this.type) {
      case "insurance":
      case "accomodation": return petrol;

      case "pickupservice":return red;
      case "automobile": return red;

      default: return "white";
    }
  }

  getContent() {
    this.bannerContent = new Banner();
    this.bannerContent.content = new Array<string>();

    switch (this.type) {
      case "insurance":
        this.bannerContent.service = "insurance";
        this.bannerContent.content.push(`The decision to get insurance depends on your circumstances and your stage in life. 
        Insurance can protect you and your loved ones from financial loss or hardship.
        Insurance can help cover costs if something unexpected happens to:`);

        this.bannerContent.content.push(`
        You or your family, your vehicle, your home, your belongings, your job. There are many insurance products that cover different types of risks
        `);

        break;
      case "accomodation":
        this.bannerContent.service = "accomodation";
        this.bannerContent.content.push(`To ensure you’re making the right choice,
        consider your budget, how much space you’ll need,
        how long you’ll stay in a home and how much savings
        you have to put toward things like repairs and maintenance.`);

        this.bannerContent.content.push(`Visit open houses and search online
          listings to see what’s on the market in your
          price range. Consider working with a real
          estate agent to help you narrow your choices
          and do in-depth research so you go into the
          home-buying process with a solid
          understanding of what you want.`);
        break;

      case "pickupservice":
        this.bannerContent.service = "pickup service";
        this.bannerContent.content.push(`We know that when you arrive at Airport or other city after a long trip, 
        you‘re anxious to get to your destination. If you’ve just stepped off a plane, tired and aching from a long trip, there can be no better antidote to your 
        ailments than getting pick up service direct to your destination.`);

        this.bannerContent.content.push(`The necessary steps are simple: just provide the pickup and destination data and select your companies. 
        After you’ve confirmed the calculated fare and payment details, you will receive an email of confirmation shortly afterwards.`);
        break;
      case "automobile":
        this.bannerContent.service = "automobile";
        this.bannerContent.content.push(`If you are a new immigrant to Canada, one of your 
        first things you need to do is get a vehicle. Having a car (or truck, or van, or SUV) is very convenient, 
        as it makes trips to work, school, the grocery store, and home again a lot easier.`);

        this.bannerContent.content.push(`Buying a car in Canada isn’t as difficult or intimidating as it might seem at first. 
        At least, it will seem a lot simpler thanks to this handy guide we’ve written. In the next five minutes, we’re going to tell you everything you need to know 
        about buying a car in Canada as a New to Canada immigrant..`);

        break;
    }

    return this.bannerContent;
  }

}

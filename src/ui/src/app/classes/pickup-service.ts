export class PickupService {
    constructor(
        public id: number,
        public date: string,
        public time: string,
        public pickuplocation: string,
        public destination: string,
        public members: string,
        public luggages: number

    ){}
}


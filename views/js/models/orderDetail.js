export class OrderDetail {
    constructor(orderID, commodityNane, orderCommodityPrice, orderCommodityQuantity, commodityID) {
        this._orderID = orderID;
        this._commodityNane = commodityNane;
        this._orderCommodityPrice = orderCommodityPrice;
        this._orderCommodityQuantity = orderCommodityQuantity;
        this._commodityID = commodityID;
    }

    get orderID() {
        return this._orderID;
    }
    set orderID(orderID) {
        this._orderID = orderID;
    }

    get commodityNane() {
        return this._commodityNane;
    }
    set commodityNane(commodityNane) {
        this._commodityNane = commodityNane;
    }

    get orderCommodityPrice() {
        return this._orderCommodityPrice;
    }
    set orderCommodityPrice(orderCommodityPrice) {
        this._orderCommodityPrice = orderCommodityPrice;
    }

    get orderCommodityQuantity() {
        return this._orderCommodityQuantity;
    }
    set orderCommodityQuantity(orderCommodityQuantity) {
        this._orderCommodityQuantity = orderCommodityQuantity;
    }

    get commodityID() {
        return this._commodityID;
    }
    set commodityID(commodityID) {
        this._commodityID = commodityID;
    }
}
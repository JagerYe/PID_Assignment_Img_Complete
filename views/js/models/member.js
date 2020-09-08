export class Member {
    
    constructor(
        userID,
        userName,
        userEmail,
        userPhone,
        userStatus,
        creationDate = null,
        changeDate = null,
        userPassword = ""
    ) {
        this._userID = userID;
        this._userPassword = userPassword;
        this._userName = userName;
        this._userEmail = userEmail;
        this._userPhone = userPhone;
        this._userStatus = userStatus;
        this._creationDate = creationDate;
        this._changeDate = changeDate;
    }

    get creationDate() {
        return this._creationDate
    }
    set creationDate(creationDate) {
        this._creationDate = creationDate;
    }

    get changeDate() {
        return this._changeDate
    }
    set changeDate(changeDate) {
        this._changeDate = changeDate;
    }

    get userID() {
        return this._userID
    }
    set userID(userID) {
        this._userID = userID;
    }

    get userPassword() {
        return this._userPassword
    }
    set userPassword(userPassword) {
        this._userPassword = userPassword;
    }

    get userName() {
        return this._userName
    }
    set userName(userName) {
        this._userName = userName;
    }

    get userEmail() {
        return this._userEmail
    }
    set userEmail(userEmail) {
        this._userEmail = userEmail;
    }

    get userPhone() {
        return this._userPhone
    }
    set userPhone(userPhone) {
        this._userPhone = userPhone;
    }

    get userStatus() {
        return this._userStatus
    }
    set userStatus(userStatus) {
        this._userStatus = userStatus;
    }
}
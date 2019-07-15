export default class Gate {
    constructor(auth) {
        this.auth = auth;
    }
    isAdmin() {
        return this.auth.rule === 1;
    }
    isAdminCompany() {
        return this.auth.rule === 2;
    }
    isUser() {
        return this.auth.rule === 0;
    }
    authData() {
        return this.auth;
    }
}

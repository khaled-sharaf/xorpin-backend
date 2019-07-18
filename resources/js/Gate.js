export default class Gate {
    constructor() {
        this.auth = window.auth
        this.authCompany = window.authCompany
    }
    isAdmin() {
        return this.auth.rule === 1;
    }
    isAdminCompany() {
        return (this.auth.rule === 2 && this.authCompany.active === 1)
    }
    isUser() {
        return this.auth.rule === 0;
    }
    authData() {
        return this.auth;
    }
    authCompanyData() {
        return this.authCompany;
    }
}

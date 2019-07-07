export default class Gate {
    constructor(user) {
        this.user = user;
    }
    isAdmin() {
        return this.user.rule == 1;
    }
    isUser() {
        return this.user.rule == 0;
    }
}
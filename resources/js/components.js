import Vue from 'vue'
import moment from 'moment'
Vue.prototype.moment = moment

Vue.component("relative-date", {
    props: ["date"],
    template: "<span>{{ timestamp }} </span>",
    created() {
        let self = this;
        setInterval(() => {
            self.$data.dateNow = Date.now();
        }, 1000 * 15);
    },
    data() {
        return {
            dateNow: Date.now()
        };
    },
    computed: {
        timestamp() {
            return moment(this.date)
                .startOf("second")
                .from(this.$data.dateNow);
        }
    }
})
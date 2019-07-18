import Vue from 'vue'
import moment from 'moment'
Vue.prototype.moment = moment

Vue.component("relative-date", {
    props: ["date"],
    template: "<span :style='styling' @dblclick='toggleDate'>{{ timestamp }} </span>",
    created() {
        let self = this;
        setInterval(() => {
            self.$data.dateNow = Date.now();
        }, 1000 * 15);
    },
    data() {
        return {
            dateNow: Date.now(),
            styling: {
                cursor: 'pointer',
                userSelect: 'none'
            },
            showRelativeDate: true
        };
    },
    methods: {
        toggleDate() {
            this.showRelativeDate = !this.showRelativeDate;
        }
    },
    computed: {
        timestamp() {
            if (this.date !== null) {
                if (this.showRelativeDate) {
                    return moment(this.date)
                        .startOf("second")
                        .from(this.$data.dateNow);
                } else {
                    return this.date;
                }
            } else {
                return null;
            }
        }
    }
})


Vue.component("rates-stars", {
    props: {
        'rates-count': Number
    },
    template: `<div class="wrapper-stars-rating">
        <i class="stars-rating">
            <i class="regular" :style="{backgroundImage: 'url(' + $domain + '/admin/images/5-stars-regular.png)'}"></i>
            <i class="solid" :style="{width: ratesCount + '%', backgroundImage: 'url(' + $domain + '/admin/images/5-stars-solid.png)'}"></i>
        </i>
    </div>`, //  v-html="countStarRate"
    data() {
        return {
            // countStarDefault: 5,
        }
    },
    computed: {
        // countStarRate() {
        //     let htmlStars = '';
        //     for(let i = 0; i < this.ratesCount; i++) {
        //         htmlStars += `<span class="star"><i class="fas fa-star"></i></span>`;
        //     }
        //     for(let x = 0; x < (this.countStarDefault - this.ratesCount); x++) {
        //         htmlStars += `<span class="star"><i class="far fa-star"></i></span>`;
        //     }
        //     return htmlStars;
        // }
    }

})

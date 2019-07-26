

export default {
    data() {
        return {
            delete_msg: " ",
            delete_success_msg: " ",
            delete_failed_msg: " ",
            delete_title: " ",
            deleted_title: " ",
            delete_it_title: " ",
            failed_title: " ",
            cancel_title: " ",


            sell_product_msg: " ",
            sell_product_success_msg: " ",
            sell_product_failed_msg: " ",

            sell_product_title: '',
            sold_product_title: '',
            add_salse_product_title: '',
        }
    },
    methods: {
        setLocaleMessages() {
            this.delete_msg =           this.$t(this.idPage + '_table.delete_msg')
            this.delete_success_msg =   this.$t(this.idPage + '_table.delete_success_msg')
            this.delete_failed_msg =    this.$t(this.idPage + '_table.delete_failed_msg')

            this.delete_title =         this.$t('global.delete')
            this.deleted_title =        this.$t('global.deleted')
            this.delete_it_title =      this.$t('global.yes_delete_it')

            this.failed_title =         this.$t('global.failed')
            this.cancel_title =         this.$t('global.cancel')


            if (this.idPage == 'products') {
                this.sell_product_msg =                   this.$t(this.idPage + '_table.sell_product_msg')
                this.sell_product_success_msg =           this.$t(this.idPage + '_table.sell_product_success_msg')
                this.sell_product_failed_msg =            this.$t(this.idPage + '_table.sell_product_failed_msg')

                this.sell_product_title =           this.$t(this.idPage + '_table.sell_product_title')
                this.sold_product_title =           this.$t(this.idPage + '_table.sold_product_title')
                this.add_salse_product_title =        this.$t(this.idPage + '_table.add_salse_product_title')
            }
        }
    },
    watch: {
        "$i18n.locale"(val) {
            this.setLocaleMessages()
        },
    },
    mounted() {
        this.setLocaleMessages()
    },
}

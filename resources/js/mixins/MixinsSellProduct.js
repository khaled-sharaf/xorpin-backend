export default {
    methods: {
        sellProduct(product) {
            Swal.fire({
                title: this.sell_product_title, // selling product
                text: this.sell_product_msg + product.count_selling,  // count of selling old is : 50
                inputValue: '1',
                inputValidator: (value) => {
                    if (!value) {
                        return this.msg_empty_count_selling
                    }
                },
                input: 'number',
                type: "info",
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.add_salse_product_title + "!",
                cancelButtonText: this.cancel_title,

            }).then(result => {
                if (result.value) {
                    loadReq(this.$Progress);
                    const data = {
                        id: product.id,
                        count: parseInt(result.value)
                    }
                    axios.post(this.urlSellProduct, data).then(response => {
                        if (response.status === 200) {
                            ToastReq.fire({
                                text: this.sell_product_success_msg
                            });
                            if (this.typePage == 'profile') {
                                let product = response.data.product
                                if (product.gallery !== null && product.gallery != '') {
                                    let gallery = product.gallery.split(',')
                                    let galleryArr = []
                                    gallery.forEach(image => {
                                        galleryArr.push({id:  Math.floor(Math.random() * 10000), url: image})
                                    })
                                    product.gallery = galleryArr
                                } else {
                                    product.gallery = []
                                }
                                this.productProfile = product
                            } else {
                                this.getData();
                            }
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.failed_title + "!",
                            text: this.sell_product_failed_msg,
                        })
                        this.$Progress.fail();
                    });
                }
            });
        },
    }
}

export default {
    methods: {
        destroyRow(id) {
            Swal.fire({
                title: this.delete_title,
                text: this.delete_msg,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e74c3c",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.delete_it_title + "!",
                cancelButtonText: this.cancel_title
            }).then(result => {
                if (result.value) {
                    loadReq(this.$Progress);
                    axios.post(this.urlDeleteRow, {id: id}).then(response => {
                        if (response.status === 200) {
                            ToastReq.fire({
                                text: this.delete_success_msg
                            });
                            this.getData();
                        }
                    })
                    .catch(error => {
                        ToastFailed.fire({
                            title: this.failed_title + "!",
                            text: this.delete_failed_msg,
                        })
                        this.$Progress.fail();
                    });
                }
            });
        },
    }
}

<style lang='scss'>

    #location_map_company {
        width: 100%;
        height: 400px;
    }

</style>


<template>
    <!-- Modal -->
    <div class="modal fade" id="modal_location_company" tabindex="-1" role="dialog" aria-labelledby="locationTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationTitle"> {{ $t('companies_table.location_map') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="my-map" id="my_map_modal">
                    <div id="location_map_company"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> {{ $t('global.close') }} </button>
            </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {

}
</script>

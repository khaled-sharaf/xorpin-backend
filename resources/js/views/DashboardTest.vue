<style>


</style>

<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">Dashboard Test</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header">
                            </div>
                            <!-- ./card-header -->


                            <!-- card-body -->
                            <div class="card-body">
                            </div>
                            <!-- ./card-body -->


                            <!-- card-footer -->
                            <div class="card-footer">
                            </div>
                            <!-- ./card-footer -->
                        </div>
                    </div><!-- /.col-12 -->
                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
    export default {
        mounted() {
            console.log(this.$route.query)
        }
    }
</script>


<script>
//     function myMap() {
//         var mapCanvas = document.getElementById("map");
//         var btnSubmit = document.getElementById('submit');
//         var myCenter = new google.maps.LatLng(lat, lng);
//         var mapOptions = {center: myCenter, zoom: 12};
//         var map = new google.maps.Map(mapCanvas,mapOptions);
//         var marker = new google.maps.Marker({
//             position: myCenter,
//             draggable: true,
//         });
//         var geocoder = new google.maps.Geocoder();
//         var eleLat = document.getElementById('bu_latitude'),
//             eleLng = document.getElementById('bu_longitude');
//         btnSubmit.addEventListener('click', function() {
//             geocodeAddress(geocoder, map);
//         });
//         function geocodeAddress(geocoder, resultsMap) {
//             var address = document.getElementById('address').value;
//             geocoder.geocode({'address': address}, function(results, status) {
//                 if (status === 'OK') {
//                     resultsMap.setCenter(results[0].geometry.location);
//                     resultsMap.setZoom(16);
//                     eleLat.value = results[0].geometry.location.lat();
//                     eleLng.value = results[0].geometry.location.lng();
//                     var marker = new google.maps.Marker({
//                         map: resultsMap,
//                         position: results[0].geometry.location,
//                         draggable: true,
//                     });
//                     marker.addListener('dragend', function (event) {
//                         eleLat.value = event.latLng.lat();
//                         eleLng.value = event.latLng.lng();
//                     });
//                 } else {
//                     alert('مكان غير موجود، ابحث بكلمات أخرى عن منطقة عقارك');
//                 }
//             });
//         }
//         marker.setMap(map);
//         marker.addListener('dragend', function (event) {
//             eleLat.value = event.latLng.lat();
//             eleLng.value = event.latLng.lng();
//         });
//     }
</script>

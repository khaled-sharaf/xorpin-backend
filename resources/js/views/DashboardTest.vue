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
                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" preserveAspectRatio="none" width="73px" height="15.41px" viewBox="0 0 72 13.983" enable-background="new 0 0 72 13.983" xml:space="preserve"> <path fill="#BC8200" d="M72.045,5.368l-5.048-0.737l-2.26-4.54l-2.25,4.54l-4.899,0.707l-4.889-0.707l-2.26-4.54l-2.26,4.54 l-5.028,0.727l-5.028-0.727l-2.26-4.54l-2.25,4.54l-4.899,0.707l-4.889-0.707l-2.26-4.54l-2.26,4.54l-4.889,0.707L9.514,4.631 l-2.25-4.54l-2.26,4.54l-5.048,0.737l3.654,3.525l-0.866,4.999l4.521-2.36l4.511,2.36l-0.866-4.999l3.505-3.385l3.495,3.385 l-0.856,4.999l4.511-2.36l4.511,2.36l-0.856-4.999l3.495-3.385l3.505,3.385l-0.866,4.999l4.511-2.36l4.521,2.36l-0.866-4.999 l3.634-3.515l3.634,3.515l-0.856,4.999l4.511-2.36l4.511,2.36l-0.856-4.999l3.495-3.385l3.505,3.385l-0.866,4.999l4.511-2.36 l4.521,2.36l-0.866-4.999L72.045,5.368z M10.261,8.684l0.707,4.112l-3.704-1.942L3.55,12.796l0.707-4.112L1.259,5.786l4.142-0.597 l1.862-3.744l1.852,3.744l4.142,0.597L10.261,8.684z M24.569,8.684l0.707,4.112l-3.714-1.942l-3.714,1.942l0.707-4.112l-2.997-2.898 L19.7,5.189l1.862-3.744l1.862,3.744l4.142,0.597L24.569,8.684z M38.868,8.684l0.707,4.112l-3.714-1.942l-3.704,1.942l0.707-4.112 l-2.997-2.898l4.142-0.597l1.852-3.744l1.862,3.744l4.142,0.597L38.868,8.684z M53.445,8.684l0.707,4.112l-3.714-1.942l-3.714,1.942 l0.707-4.112l-2.997-2.898l4.142-0.597l1.862-3.744L52.3,5.189l4.142,0.597L53.445,8.684z M68.45,12.796l-3.714-1.942l-3.704,1.942 l0.707-4.112l-2.997-2.898l4.142-0.597l1.852-3.744l1.862,3.744l4.142,0.597l-2.997,2.898L68.45,12.796z"/> </svg> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" preserveAspectRatio="none" width="73px" height="15.41px" viewBox="0 0 72 13.983" enable-background="new 0 0 72 13.983" xml:space="preserve"> <g> <g> <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="64.9138" y1="0.5004" x2="64.9138" y2="13.6954"> <stop offset="0" style="stop-color:#FFC830"/> <stop offset="0.0169" style="stop-color:#FFCD1E"/> <stop offset="0.0385" style="stop-color:#FFD400"/> <stop offset="0.6162" style="stop-color:#FEBF01"/> <stop offset="1" style="stop-color:#FEAE02"/> </linearGradient> <polygon fill="url(#SVGID_1_)" points="68.355,8.889 69.164,13.593 64.929,11.386 60.564,13.663 61.403,8.829 57.868,5.413 62.752,4.704 64.699,0.789 64.869,0.439 66.956,4.634 67.086,4.654 71.96,5.403 "/> </g> <g> <g> <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="50.6451" y1="0.5004" x2="50.6451" y2="13.6954"> <stop offset="0" style="stop-color:#FFC830"/> <stop offset="0.0169" style="stop-color:#FFCD1E"/> <stop offset="0.0385" style="stop-color:#FFD400"/> <stop offset="0.6162" style="stop-color:#FEBF01"/> <stop offset="1" style="stop-color:#FEAE02"/> </linearGradient> <polygon fill="url(#SVGID_2_)" points="54.086,8.889 54.895,13.593 50.66,11.386 46.296,13.663 47.134,8.829 43.599,5.413 48.483,4.704 50.43,0.789 50.6,0.439 52.687,4.634 52.817,4.654 57.691,5.403 "/> </g> <g> <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="35.7159" y1="0.5004" x2="35.7159" y2="13.6954"> <stop offset="0" style="stop-color:#FFC830"/> <stop offset="0.0169" style="stop-color:#FFCD1E"/> <stop offset="0.0385" style="stop-color:#FFD400"/> <stop offset="0.6162" style="stop-color:#FEBF01"/> <stop offset="1" style="stop-color:#FEAE02"/> </linearGradient> <polygon fill="url(#SVGID_3_)" points="39.157,8.889 39.966,13.593 35.731,11.386 31.366,13.663 32.205,8.829 28.67,5.413 33.554,4.704 35.501,0.789 35.671,0.439 37.758,4.634 37.888,4.654 42.762,5.403 "/> </g> <g> <linearGradient id="SVGID_4_" gradientUnits="userSpaceOnUse" x1="21.4472" y1="0.5004" x2="21.4472" y2="13.6954"> <stop offset="0" style="stop-color:#FFC830"/> <stop offset="0.0169" style="stop-color:#FFCD1E"/> <stop offset="0.0385" style="stop-color:#FFD400"/> <stop offset="0.6162" style="stop-color:#FEBF01"/> <stop offset="1" style="stop-color:#FEAE02"/> </linearGradient> <polygon fill="url(#SVGID_4_)" points="24.888,8.889 25.697,13.593 21.462,11.386 17.098,13.663 17.937,8.829 14.401,5.413 19.285,4.704 21.232,0.789 21.402,0.439 23.49,4.634 23.619,4.654 28.493,5.403 "/> </g> <g> <linearGradient id="SVGID_5_" gradientUnits="userSpaceOnUse" x1="7.2776" y1="0.5004" x2="7.2776" y2="13.6954"> <stop offset="0" style="stop-color:#FFC830"/> <stop offset="0.0169" style="stop-color:#FFCD1E"/> <stop offset="0.0385" style="stop-color:#FFD400"/> <stop offset="0.6162" style="stop-color:#FEBF01"/> <stop offset="1" style="stop-color:#FEAE02"/> </linearGradient> <polygon fill="url(#SVGID_5_)" points="10.718,8.889 11.527,13.593 7.293,11.386 2.928,13.663 3.767,8.829 0.231,5.413 5.115,4.704 7.063,0.789 7.233,0.439 9.32,4.634 9.45,4.654 14.324,5.403 "/> </g> <path fill="#BC8200" d="M67.086,4.654l-0.13-0.02l-2.087-4.195l-0.17-0.34l-2.247,4.534l-4.894,0.709l-4.874-0.709L50.427,0.1 L48.17,4.634l-5.024,0.729l-5.024-0.729L35.865,0.1l-2.247,4.534l-4.894,0.709L23.84,4.634L21.583,0.1l-2.257,4.534l-4.884,0.709 L9.548,4.634L7.301,0.1L5.044,4.634L0,5.373l3.655,3.516l-0.869,4.994l4.514-2.357l4.504,2.357l-0.859-4.994l3.496-3.376 l3.496,3.376l-0.859,4.994l4.504-2.357l4.504,2.357l-0.859-4.994l3.496-3.376l3.496,3.376l-0.859,4.994l4.504-2.357l4.514,2.357 l-0.869-4.994l3.635-3.506l3.625,3.506l-0.859,4.994l4.514-2.357l4.504,2.357l-0.859-4.994l3.486-3.376l3.506,3.376l-0.869,4.994 l4.504-2.357l4.514,2.357l-0.05-0.29l-0.809-4.704l3.605-3.486h0.01L72,5.373L67.086,4.654z M10.297,8.679l0.709,4.105 l-3.705-1.938l-3.705,1.938l0.699-4.105L1.308,5.793l4.135-0.599l1.858-3.745l1.848,3.745l4.145,0.599L10.297,8.679z M24.589,8.679l0.699,4.105l-3.705-1.938l-3.705,1.938l0.699-4.105L15.59,5.793l4.135-0.599l1.858-3.745l1.858,3.745l4.135,0.599 L24.589,8.679z M38.871,8.679l0.699,4.105l-3.705-1.938l-3.705,1.938l0.709-4.105l-2.996-2.886l4.145-0.599l1.848-3.745 l1.858,3.745l4.135,0.599L38.871,8.679z M53.423,8.679l0.709,4.105l-3.705-1.938l-3.715,1.938l0.709-4.105l-2.996-2.886 l4.135-0.599l1.868-3.745l1.858,3.745l4.135,0.599L53.423,8.679z M67.705,8.679l0.709,4.105l-3.715-1.938l-3.695,1.938 l0.709-4.105l-2.996-2.886l4.135-0.599l1.848-3.745l1.868,3.745l4.135,0.599L67.705,8.679z"/> </g> </g> </svg> -->
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
            document.title = 'Dashboard Test'
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

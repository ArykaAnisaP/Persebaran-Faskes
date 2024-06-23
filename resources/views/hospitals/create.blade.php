@extends ('adminlte::page')

@section('title', 'Data Hospital')

@section('content_header')
<h1 class="m-0 text-dark">Data Hospital</h1>
@stop

@section('content')
<form action="{{route('hospitals.store')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="overflow: auto">

                    <table style="width: 100%">
                        <tr>
                            <td><label for="LabelNama">Nama Hospital</label></td>
                            <td><input type="text" size="70" id="InputNama" placeholder="Nama Hospital" name="namahospital"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelAlamat">Alamat Hospital</label></td>
                            <td><input type="text" size="70" id="InputAlamat" placeholder="Alamat" name="alamat"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelLatitude">Latitude</label></td>
                            <td><input type="text" size="70" id="InputLatitude" placeholder="Latitude" name="latitude"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelLongitude">Longitude</label></td>
                            <td><input type="text" size="70" id="InputLongitude" placeholder="Longitude" name="longitude"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelJamBuka">Jam Buka</label></td>
                            <td><input type="text" size="70" id="InputJamBuka" placeholder="JamBuka" name="jambuka"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelJamTutup">Jam Tutup</label></td>
                            <td><input type="text" size="70" id="InputJamTutup" placeholder="JamTutup" name="jamtutup"></td>
                        </tr>
                        <tr>
                            <td><label for="LabelLayanan">Layanan</label></td>
                            <td><input type="text" size="70" id="InputLayanan" placeholder="Layanan" name="layanan"></td>
                        </tr>
                    </table>

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

                    <!-- Make sure you put this AFTER Leaflet's CSS -->
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

                    <style>
                        #map {
                            width: 900px;
                            height: 400px;
                        }
                    </style>

                    <div id="map"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('hospitals.index')}}" class="btn btn-default">Batal</a>
                </div>

            </div>
        </div>
    </div>
</form>
@stop

@push('js')
<script>
    // instalasi map
    var map = L.map('map').setView([-6.9762229918622904, 107.7746321684855], 19);

    
    //-- google tiles ----
    // jenis-jenis peta yaang disediakan olah google map
    // Hybrid: s, h;
    // Satellite: s;
    // Streets: m;
    // Terrain: p;
    
    // menambahkan layer peta dari Google Maps ke dalam peta yang ditampilkan menggunakan LeafletJS 
    L.tileLayer('https://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    }).addTo(map);
    
//  // // MEMBUAT MARKER
// // Variabel untuk menyimpan marker
    var marker;
//  Fungsi yang dipanggil saat klik pada peta
function onMapClick(e) {
    document.getElementById('InputLatitude').value = e.latlng.lat;
    document.getElementById('InputLongitude').value = e.latlng.lng;

//   Menghapus marker jika sudah ada
    if (marker) {
        map.removeLayer(marker);
    }

//  Menambahkan marker baru di lokasi yang diklik pada peta
    marker = L.marker(e.latlng).addTo(map)
        .bindPopup("Koordinat: " + e.latlng.toString()) // Menampilkan popup dengan koordinat pada marker
        .openPopup(); // // Membuka popup secara otomatis

}
//  Menjalankan fungsi onMapClick saat peta menerima event klik
map.on('click', onMapClick);


// // // MEMBUAT POLILYNE
//     var marker; // // Variabel untuk menyimpan marker
//     var linearray = []; //  Array yang akan berisi koordinat-koordinat titik
//     var polyline; // Variabel untuk menyimpan polyline

// // // Beberapa koordinat yang disimpan dalam array
// var latlngs = [
//     // [45.51, -122.68],
//     // [37,77, -122.43],
//     // [37.77, -122.43],
//     // [34.04, -118.2]
// ];

// // Menentukan warna garis polyline dan menambahkannya ke peta
// var polyline = L.polyline(latlngs, {color: 'red'}).addTo(map);

// //  // Event listener untuk saat peta diklik
// map.on('click', function onMapClick(e){

// // Mengambil latitude dan longitude dari lokasi yang diklik pada peta
//     latitude = e.latlng.lat;
//     longitude = e.latlng.lng;

// // Menampilkan latitude dan longitude pada elemen HTML dengan ID 'InputLatitude' dan 'InputLongitude'
//        // // if (!marker) {
//        // //     document.getElementById('InputLatitude').value = latitude;
//        // //     document.getElementById('InputLongitude').value = longitude;
//        // // }

//         document.getElementById('InputLatitude').value = latitude;
//         document.getElementById('InputLongitude').value = longitude;

// // Menambahkan koordinat yang baru diklik ke dalam array linearray
//     linearray.push([latitude, longitude]);

//     if (marker != null){
//         map.removeLayer(marker);
//     }

//  // Menambahkan marker ke lokasi yang diklik pada peta
//     marker = L.marker([latitude, longitude]).addTo(map);

// // Membuat polyline berdasarkan koordinat yang telah dikumpulkan dalam array linearray, memberikan warna merah, dan menampilkannya pada peta
//     polyline = L.polyline(linearray, {color: 'red'}).addTo(map);
// });


// // // MEMBUAT POLYGON
// // // Variabel untuk menyimpan marker
//     var marker;
// // Array yang akan berisi koordinat-koordinat titik
//     var linearray = [];
// // Variabel untuk menyimpan poligon
//     var polygon;

// // Event listener untuk saat peta diklik
// map.on('click', function onMapClick(e){
// // Mengambil latitude dan longitude dari lokasi yang diklik pada peta
//     latitude = e.latlng.lat;
//     longitude = e.latlng.lng;
// // Menampilkan latitude dan longitude pada elemen HTML dengan ID 'InputLatitude' dan 'InputLongitude'
//        // if (!marker) {
//        //     document.getElementById('InputLatitude').value = latitude;
//        //     document.getElementById('InputLongitude').value = longitude;
//        // }

//         // if (marker != null){
//         //    map.removeLayer(marker);
//         // }

//             document.getElementById('InputLatitude').value = latitude;
//             document.getElementById('InputLongitude').value = longitude;
// // Menambahkan koordinat yang baru diklik ke dalam array linearray
//     linearray.push([latitude, longitude]);

// // Menambahkan marker ke lokasi yang diklik pada peta
//     marker = L.marker([latitude, longitude]).addTo(map);
// // Membuat dan menampilkan poligon berdasarkan koordinat yang telah dikumpulkan dalam array linearray, memberikan warna merah, dan menampilkannya pada peta
//     polygon = L.polygon(linearray, {color: 'red'}).addTo(map);
// });


// // // MEMBUAT CIRCLE
// // Variabel untuk menyimpan lingkaran
//     var circle;
// // Variabel untuk menyimpan marker
//     var marker;

// // Event listener untuk saat peta diklik
// map.on('click', function onMapClick(e){
// // Mengambil latitude dan longitude dari lokasi yang diklik pada peta
//     latitude = e.latlng.lat;
//     longitude = e.latlng.lng;
// // Menampilkan latitude dan longitude pada elemen HTML dengan ID 'InputLatitude' dan 'InputLongitude'
//     document.getElementById('InputLatitude').value = latitude;
//     document.getElementById('InputLongitude').value = longitude;

//     if (marker) {
//           map.removeLayer(marker);
//     }

// // Menghapus lingkaran jika sudah ada sebelumnya
//     if (circle) {
//     map.removeLayer(circle);
//     }

// // Menambahkan marker ke lokasi yang diklik pada peta
//     marker = L.marker([latitude, longitude]).addTo(map);
// // Membuat dan menampilkan lingkaran berdasarkan koordinat yang diklik, memberikan warna hijau, dan menentukan radius 100 (dalam unit yang digunakan, misalnya meter)
//     circle = L.circle([latitude, longitude], {color: 'green', radius: 150}).addTo(map);
// });


</script>
@endpush
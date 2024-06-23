@extends('adminlte::page')

@section('title', 'Data Hospital')

@section('content_header')
    <h1 class="m-0 text-dark">Data Hospital</h1>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $hospital->namahospital }}</h3>
                    <p>Alamat: {{ $hospital->alamat }}</p>
                    <p dataLongitude="{{ $hospital->longitude }}">Longitude: {{ $hospital->longitude }}</p>
                    <p dataLatitude="{{ $hospital->latitude }}">Latitude: {{ $hospital->latitude }}</p>
                    <p dataJamBuka="{{ $hospital->jambuka }}">jambuka: {{ $hospital->jambuka }}</p>
                    <p dataJamTutup="{{ $hospital->jamtutup }}">jamtutup: {{ $hospital->jamtutup }}</p>
                    <p dataLayanan="{{ $hospital->layanan }}">layanan: {{ $hospital->layanan }}</p>
                    <a href="{{ route('hospitals.index') }}" class="btn btn-primary" style="margin-bottom: 20px;">Kembali</a>

                    <div style="height: 200px;" id="map"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        var latitude = document.querySelector('p[dataLatitude]').getAttribute('dataLatitude');
        var longitude = document.querySelector('p[dataLongitude]').getAttribute('dataLongitude');

        var map = L.map('map').setView([latitude,longitude], 17);

        var marker = L.marker([latitude,longitude]).addTo(map);
        L.tileLayer('https://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
    </script>
@endpush

<script>
        // Inisialisasi peta menggunakan Leaflet
        var map = L.map('map').setView([-6.9174163433540725, 107.61568633823215], 10); // Set initial view to a default location (e.g., Jakarta)
    
        // Menambahkan layer peta dari Google Maps menggunakan Leaflet
        L.tileLayer('https://{s}.google.com/vt?/lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 19,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);
    
        // Menambahkan marker untuk setiap hospital di dalam database
        @foreach ($hospital as $hospitals)
            var marker = L.marker([{{ $hospital->latitude }}, {{ $hospital->longitude }}]).addTo(map);
            marker.bindPopup("<b>{{ $hospital->namahospital }}</b><br>Alamat : {{ $hospital->alamat }}<br>latitude : {{ $hospital->latitude }}<br>Longitude : {{ $hospital->longitude }}<br>Jam Buka : {{ $hospital->jam_buka }}<br>Jam Tutup : {{ $hospital->jam_tutup }}<br>Layanan : {{ $hospital->layanan }}").openPopup();
        @endforeach
    
        // Menangkap event klik pada peta
        map.on('click', function onMapClick(e) {
            // Mendapatkan koordinat dari event klik
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
    
            // Mengisi nilai input latitude dan longitude
            document.getElementById('InputLatitude').value = lat;
            document.getElementById('InputLongitude').value = lng;
        });
    </script>

</body>


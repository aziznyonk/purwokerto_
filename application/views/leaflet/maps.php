<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <style>
        body {
            display: flex;
            align-content: center;
            justify-content: center;
        }

        #map {
            width: 50vw;
            height: 512px;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        let pos = [51.505, -0.09]
        // const mymap = L.map('map').setView(pos, 13)

        // L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        //     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        //     maxZoom: 18,
        //     id: 'mapbox/streets-v11',
        //     tileSize: 512,
        //     zoomOffset: -1,
        //     accessToken: 'pk.eyJ1IjoiazNudG9lcyIsImEiOiJja3ZocnRyc3oyM202Mm9ueXp4dG9yNXJwIn0.QzQvA39HCC_zN9X5ESQ5MA'
        // }).addTo(mymap);

        // const marker = L.marker(pos).addTo(mymap)

        // const circle = L.circle(pos, {
        //     color: 'red',
        //     fillColor: '#f03',
        //     fillOpacity: 0.5,
        //     radius: 500
        // }).addTo(mymap)

        // const polygon = L.polygon([
        //     [51.509, -0.08],
        //     [51.503, -0.06],
        //     [51.51, -0.047]
        // ]).addTo(mymap);

        // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
        // circle.bindPopup("I am a circle.");
        // polygon.bindPopup("I am a polygon.");

        // function onMapClick(e) {
        //     const ll = e.latlng
        //     console.log(`${ll.lat} == ${ll.lng}`)
        // }

        // click Event
        // mymap.on('click', onMapClick);

        const corner1 = L.latLng(51.509, -0.08)
        const corner2 = L.latLng(51.51, -0.047)
        const bounds = L.latLngBounds(corner1, corner2)
        const mymap = L.map('map', {
            maxZoom: 18,
            minZoom: 16,
            maxBounds: [
                //south west
                [40.712, -74.227],
                //north east
                [40.774, -74.125]
            ],
        }).setView(pos, 17)

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiazNudG9lcyIsImEiOiJja3ZocnRyc3oyM202Mm9ueXp4dG9yNXJwIn0.QzQvA39HCC_zN9X5ESQ5MA'
        }).addTo(mymap);

        L.marker([40.743, -74.176]).addTo(map);
    </script>
</body>

</html>
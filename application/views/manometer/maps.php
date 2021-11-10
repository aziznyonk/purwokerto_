<!DOCTYPE html>
<html>

<head>
    <title>Simple Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style>
        #map {
            width: 50vw;
            height: 512px;
        }

        body {
            display: flex;
            content-aligment: center;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script>
        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: <?= $lat ?>,
                    lng: <?= $long ?>
                },
                zoom: 8,
            });
        }
    </script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhp3-zMM6Z1-NM8FBefecBjnRQBIv08_8&callback=initMap&v=weekly" async></script>
</body>

</html>
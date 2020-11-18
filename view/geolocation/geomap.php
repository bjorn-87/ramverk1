<?php

namespace Anax\view;

?>

<div id="osm-map"></div>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/>

<?php if ($location && $location["latitude"] && $location["longitude"]) : ?>
    <script type="text/javascript">
        let lat = <?= $location["latitude"] ?>;
        let long = <?= $location["longitude"] ?>;

        function showMap(lat, long) {
            var element = document.getElementById('osm-map');

            element.style = 'height:300px;';

            var map = L.map(element);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var target = L.latLng(lat, long);

            map.setView(target, 14);

            L.marker(target).addTo(map);
        }
        showMap(lat, long);
    </script>
<?php endif; ?>

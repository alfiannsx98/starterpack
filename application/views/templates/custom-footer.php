

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	<script src="<?= base_url() ?>assets/leaflet-locatecontrol/src/L.Control.Locate.js"></script>

    <!-- AkhiranLeaflet JS -->
    

    <!-- page script -->


<!-- MyMap Leaflet -->

<script>
var curLocation=[0,0];
if (curLocation[0]==0 && curLocation[1]==0) {
	curLocation =[-8.157619, 113.722875];	
}

var mymap1 = L.map('mapid2').setView([-8.157619, 113.722875], 14);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11'
}).addTo(mymap1);

mymap1.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
	draggable:'true'
});

marker.on('dragend', function(event) {
var position = marker.getLatLng();
marker.setLatLng(position,{
	draggable : 'true'
	}).bindPopup(position).update();
	$("#Latitude").val(position.lat);
	$("#Longitude").val(position.lng).keyup();
});

$("#Latitude, #Longitude").change(function(){
	var position =[parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
	marker.setLatLng(position, {
	draggable : 'true'
	}).bindPopup(position).update();
	mymap1.panTo(position);
});

$('#location-button').click(function(){
	if(navigator.geolocation)
		navigator.geolocation.getCurrentPosition(function(location){
			$("#Latitude").val(location.coords.latitude);
			$("#Longitude").val(location.coords.longitude);

			var position =[parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
			marker.setLatLng(position, {
				draggable : 'true'
			}).bindPopup(position).update()
			mymap1.panTo(position);
		});
	else
		console.log("Geolocation is not supported");
})

mymap1.addLayer(marker);
</script>
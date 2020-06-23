<?php include 'include/head1.php';?>
  <title>Dashboard Admin - Covid-19 di Bali</title>
<?php include 'include/head2.php'; ?>
  <style>
    #mapid {
      height: 50em;
    }
  </style>

<?php include 'include/navbar.php';?>

<!-- CONTENT START HERE -->

  <div class="section no-pad-bot" id="index-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col s12 m10 offset-m2">
          <h2>Dashboard</h2>
          <div class="card">
          <div class="card-content">
          <span class="card-title">Sebaran Kasus Covid-19 Tingkat Kelurahan di Bali</span><br>
            <div id="mapid"></div>
          </div>
          <div class="card-action">
            <a href="#">This is a link</a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT END HERE -->

  <!--  Scripts-->
<?php include 'include/js.php'; ?>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
  <script>
    var mymap = L.map('mapid').setView([-8.45, 115.1], 9);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicmFuZG9taXplNzIxIiwiYSI6ImNrNnVlamNjODA4ZWwzcm54NHl0enEybnAifQ.RyV0WnA6uom_aCtR3zQR2w'
    }).addTo(mymap);
  </script>

  </body>
</html>
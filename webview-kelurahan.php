<?php
  require_once 'connection.php';

  $sql = "SELECT *, (ppln+ppdn+tl+lainnya) AS 'jumlah_positif'
  FROM tb_persebaran a 
  INNER JOIN tb_kelurahan b ON a.id_kelurahan=b.id
  WHERE tgl IN(SELECT MAX(tgl) FROM tb_persebaran)";

  $execute = mysqli_query($mysqli, $sql);
  $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);

  $data_kelurahan = array();

  foreach($results as $row){
      if($row['jumlah_positif'] == 0){
          $row['color'] = 'lightgreen';
      }
      elseif($row['jumlah_positif'] > 0 && $row['perawatan'] == 0 ){
          $row['color'] = 'green'; 
      }
      elseif($row['ppln'] == 1 || $row['ppdn'] == 1  && $row['perawatan'] > 0){
          $row['color'] = 'yellow'; 
      }
      elseif($row['tl'] >= 1  && $row['perawatan'] > 0){
          $row['color'] = 'darkred'; 
      }
      
      elseif($row['ppln'] > 1 || $row['ppdn'] > 1  && $row['perawatan'] > 0){
          $row['color'] = 'pink'; 
      }

      $data_kelurahan[$row['nama']] = $row;
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KMZ File Loader - 1705551054</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
    <style>
        body {
            padding: 0;
            margin: 0;
        }
        html, body, #mapid {
            height: 100%;
            width: 100vw;
        }
    </style>
</head>

<body>
    <div id="mapid">

    </div>
</body>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    <script src="https://unpkg.com/leaflet-pointable@0.0.3/leaflet-pointable.js"></script>
<script>
    var mymap = L.map('mapid').setView([-8.4, 115.2], 10);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoicmFuZG9taXplNzIxIiwiYSI6ImNrNnVlamNjODA4ZWwzcm54NHl0enEybnAifQ.RyV0WnA6uom_aCtR3zQR2w'
    }).addTo(mymap);

    var data_kelurahan = <?php echo json_encode($data_kelurahan) ?>;

    var kmzParser = new L.KMZParser({
        onKMZLoaded: function(layer, name) {
            control.addOverlay(layer, name);
            var layers = layer.getLayers()[0].getLayers();

            layers.forEach(function(layer,index){
                var kelurahan  = layer.feature.properties.NAME_4;

                kelurahan = kelurahan.replace(/\s+/g, " ");

                if(data_kelurahan[kelurahan] !== undefined){
                  layer.setStyle({fillOpacity:'0.75',fillColor:data_kelurahan[kelurahan]['color'],color:'black',weight:0.5,opacity:1});
                }

                layer.bindPopup("<b>"+data_kelurahan[kelurahan]['nama']+
                "</b> <table><tr><td>Positif </td><td>: "+data_kelurahan[kelurahan]['jumlah_positif']+
                "</td></tr><tr><td> Level</td><td> : "+data_kelurahan[kelurahan]['level']+
                "</td></tr><tr><td> PP-LN</td><td> : "+data_kelurahan[kelurahan]['ppln']+
                "</td></tr><tr><td> PP-DN</td><td> : "+data_kelurahan[kelurahan]['ppdn']+
                "</td></tr><tr><td> TL</td><td> : "+data_kelurahan[kelurahan]['tl']+
                "</td></tr><tr><td> Lainnya</td><td> : "+data_kelurahan[kelurahan]['lainnya']+
                "</td></tr><tr><td> Perawatan</td><td> : "+data_kelurahan[kelurahan]['perawatan']+
                "</td></tr><tr><td> Sembuh</td><td> : "+data_kelurahan[kelurahan]['sembuh']+
                "</td></tr><tr><td> Meninggal</td><td> : "+data_kelurahan[kelurahan]['meninggal']+"</td></tr></table>")
        
            })
            layer.addTo(mymap);
            
          }
        });
    
    kmzParser.load('admin-page/assets/bali-kelurahan.kmz');

    var control = L.control.layers(null, null, { collapsed:true }).addTo(mymap);
</script>


</html>
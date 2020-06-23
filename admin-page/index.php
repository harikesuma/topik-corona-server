<?php 
  require_once '../connection.php';

  if (isset($_POST['tgl']) && isset($_POST['selected-date'])){
      $tgl = $_POST['tgl'];
      $sql = "SELECT *, (ppln+ppdn+tl+lainnya) AS 'jumlah_positif'
          FROM tb_persebaran a 
          INNER JOIN tb_kelurahan b ON a.id_kelurahan=b.id
          WHERE tgl = '$tgl'";
      $sql2 = "SELECT SUM(ppln+ppdn+tl+lainnya) AS 'total' FROM tb_persebaran WHERE tgl = '$tgl' GROUP BY tgl";
  }
  else {
      $sql = "SELECT *, (ppln+ppdn+tl+lainnya) AS 'jumlah_positif'
      FROM tb_persebaran a 
      INNER JOIN tb_kelurahan b ON a.id_kelurahan=b.id
      WHERE tgl IN(SELECT MAX(tgl) FROM tb_persebaran)";
      $sql2 = "SELECT SUM(ppln+ppdn+tl+lainnya) AS 'total' FROM tb_persebaran WHERE tgl IN(SELECT MAX(tgl) FROM tb_persebaran)";
  }

  $execute = mysqli_query($mysqli, $sql);
  $cek = mysqli_num_rows($execute);
      if($cek == 0){
          echo '
              <script>
              alert("Tidak ada data pada tanggal tersebut!");
              window.location.href="index.php";
              </script>
          ';
      }
  $execute2 = mysqli_query($mysqli, $sql2);
  $cek = mysqli_num_rows($execute2);
      if($cek == 0){
          echo '
              <script>
              alert("Tidak ada data pada tanggal tersebut!");
              window.location.href="index.php";
              </script>
          ';
      }
  $results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
  $total_positif = mysqli_fetch_assoc($execute2);
  

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
  // echo "<pre>";
  // print_r($data_kelurahan);
  // echo "</pre>";
?>
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
          <h4>Sebaran Kasus Covid-19 Tingkat Kelurahan di Bali</h4>
          <span class="card-title">Menampilkan Data Tanggal : <?php echo $data_kelurahan['Abiansemal']['tgl'];?></span><br>
            <div id="mapid"></div>
          </div>
          <div class="card-action">
          <form action="#" method="post">
          <div class="row">
            <div class="col s6">
            <div class="input-field">
                <input id="tgl" type="date" class="validate" name="tgl">
                <label for="tgl">Pilih Tanggal</label>
            </div>
            </div>
            <div class="col s6">
              <div class="row">
                <div class="col s6">
                  <button type="submit" name="selected-date" style="width:100%" class="btn btn-large cyan darken-1">Submit</button>
                </div>
                <div class="col s6">
                  <button type="submit" name="lates-data" class="btn btn-large orange darken-2" style="width:100%">Tampilkan Data Terbaru</button>
                </div>
              </div>
            </div>
          </div>    
          </form>
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
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
  <script>
    var mymap = L.map('mapid').setView([-8.45, 115.1], 9);
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
    
    kmzParser.load('assets/bali-kelurahan.kmz');

    var control = L.control.layers(null, null, { collapsed:true }).addTo(mymap);
  </script>

  </body>
</html>
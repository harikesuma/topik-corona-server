<?php
    require_once '../connection.php';
    if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) {
        $tgl       = $_COOKIE['tgl'];
        $kelurahan = $_COOKIE['kelurahan'];
        $sql = $mysqli->query("SELECT nama FROM tb_kelurahan WHERE id = '$kelurahan'") or die(mysqli_error($mysqli));
        $nama_kelurahan = mysqli_fetch_array($sql);
        $sql = "SELECT * FROM tb_persebaran WHERE tgl = '$tgl' AND id_kelurahan = '$kelurahan'";
        $execute = mysqli_query($mysqli, $sql);
        $result = mysqli_fetch_assoc($execute);
    }
    $sql = $mysqli->query("SELECT * FROM tb_kelurahan") or die(mysqli_error($mysqli));
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
          <h2>Covid-19 Data Bali</h2>
          <div class="card">
          <div class="card-content">
          <span class="card-title"><?php if (isset($_COOKIE['tgl'])) { echo 'Edit Data Tanggal '.$tgl.' di Kelurahan '.$nama_kelurahan[0]; } else { echo 'Tambah Data'; }?></span><br>
          <form action="#" method="post">
          <?php
            if (!isset($_COOKIE['tgl'])) {?>
            <div class="input-field">
                <input id="tgl" type="date" class="validate" name="tgl" required>
                <label for="tgl">Pilih Tanggal</label>
            </div>
            <?php
                }
                    
                if(!isset($_COOKIE['kelurahan'])){
            ?>
            <div class="input-field">
            <select name="kelurahan" id="kelurahan">
                    <option value="" disabled selected>Choose your option</option>
                    <?php
                        while($kelurahan = mysqli_fetch_assoc($sql)){?>
                            <option value="<?php echo $kelurahan['id']; ?>"><?php echo $kelurahan['nama']; ?></option>';
                        <?php
                        }
                    ?>
                </select>
                <label for="kelurahan">Pilih Kelurahan</label>
            </div>
            <?php
                }
            ?>
            <div class="input-field">
                <input id="level" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['level'];} ?>" class="validate" name="level" min=0 required>
                <label for="level">Level</label>
            </div>
            <div class="input-field">
                <input id="ppln" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['ppln'];} ?>" class="validate" name="ppln" min=0 required>
                <label for="ppln">Pelaku Perjalanan Luar Negeri (PP-LN)</label>
            </div>
            <div class="input-field">
                <input id="ppdn" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['ppdn'];} ?>" class="validate" name="ppdn" min=0 required>
                <label for="ppdn">Pelaku Perjalanan Dalam negeri (PP-DN)</label>
            </div>
            <div class="input-field">
            <input id="tl" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['tl'];} ?>" class="validate" name="tl" min=0 required>
                <label for="tl">Transmisi Lokal (TL)</label>
            </div>
            <div class="input-field">
                <input id="lainnya" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['lainnya'];} ?>" class="validate" name="lainnya" min=0 required>
                <label for="lainnya">Lainnya</label>
            </div>
            <div class="input-field">
                <input id="perawatan" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['perawatan'];} ?>" class="validate" name="perawatan" min=0 required>
                <label for="perawatan">Perawatan</label>
            </div>
            <div class="input-field">
                <input id="sembuh" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['sembuh'];} ?>" class="validate" name="sembuh" min=0 required>
                <label for="sembuh">Sembuh</label>
            </div>
            <div class="input-field">
                <input id="meninggal" type="number" value="<?php if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])) { echo $result['meninggal'];} ?>" class="validate" name="meninggal" min=0 required>
                <label for="meninggal">Meninggal</label>
            </div>
            <br>
            <div class="input-field">
            <center>
                <button type="submit" name="simpan" class="btn btn-large cyan darken-1">Simpan</button></a>
                <a href="covid.php"><button type="button" class="btn btn-large red">Kembali</button></a>
            </center>
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
<script>
  $(document).ready(function(){
    $('select').formSelect();
  });
        
</script>

  </body>
</html>

<?php
    if (isset($_POST['simpan'])) {
        $level           = $_POST['level'];
        $ppln            = $_POST['ppln'];
        $ppdn            = $_POST['ppdn'];
        $tl              = $_POST['tl'];
        $lainnya         = $_POST['lainnya'];
        $perawatan       = $_POST['perawatan'];
        $sembuh          = $_POST['sembuh'];
        $meninggal       = $_POST['meninggal'];

        if (isset($_COOKIE['tgl']) && isset($_COOKIE['kelurahan'])){
            $edit = $mysqli->query("UPDATE tb_persebaran SET
                level       = '$level',
                ppln        = '$ppln',
                ppdn        = '$ppdn',
                tl          = '$tl',
                lainnya     = '$lainnya',
                perawatan   = '$perawatan',
                sembuh      = '$sembuh',
                meninggal   = '$meninggal'
                WHERE tgl = '$tgl' AND id_kelurahan = '$kelurahan'") or die(mysqli_error($mysqli));

            if($edit){
                setcookie('tgl', '', time() - 3600, "/");
                setcookie('kelurahan', '', time() - 3600, "/");
                echo '
                    <script>
                    alert("Data berhasil disimpan!");
                    window.location.href="covid.php";
                    </script>
                ';
            }
        }
        else {
            $tgl       = $_POST['tgl'];
            $kelurahan = $_POST['kelurahan'];
            $cek = $mysqli->query("SELECT * FROM tb_persebaran WHERE tgl = '$tgl' AND id_kelurahan = '$kelurahan'") or die(mysqli_error($mysqli));
            $cek = mysqli_num_rows($cek);
            if ($cek > 0) {
                echo '
                    <script>
                    alert("Data tanggal di kelurahan tersebut sudah ada! Silahkan kembali dan gunakan menu edit.");
                    </script>
                ';
            }
            else{
                $sql = $mysqli->query("SELECT b.id AS 'kecamatan', c.id AS 'kabupaten' FROM tb_kelurahan a  
                    INNER JOIN tb_kecamatan b ON a.id_kecamatan = b.id
                    INNER JOIN tb_kabupaten c ON b.id_kabupaten = c.id
                    WHERE a.id = '$kelurahan'") or die(mysqli_error($mysqli));
                $umum = mysqli_fetch_assoc($sql);
                $kabupaten = $umum['kabupaten'];
                $kecamatan = $umum['kecamatan'];
                echo $kabupaten, $kecamatan;
                $tambah = $mysqli->query("INSERT INTO tb_persebaran VALUES(null, '$kabupaten','$kecamatan','$kelurahan','$tgl','$level','$ppln','$ppdn', '$tl', '$lainnya', '$perawatan', '$sembuh', '$meninggal')") or die(mysqli_error($mysqli));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disimpan!");
                        window.location.href="covid.php";
                        </script>
                    ';
                }
            }
        }
    }
?>
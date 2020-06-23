<?php
    ob_start();
    require_once '../connection.php';
    setcookie("kukis", "kukis", time() + (86400 * 30), "/");
    if($_COOKIE['kukis'] == "kukis") {
        setcookie('tgl', '', time() - 3600, "/");
        setcookie('kelurahan', '', time() - 3600, "/");
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
          <span class="card-title">Manage Data Covid-19</span><br>
          <form action="" method="post">
            <div class="input-field">
                <input id="tgl" type="date" class="validate" name="tgl" required>
                <label for="tgl">Pilih Tanggal</label>
            </div>
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
            </div><br>
            <div class="input-field">
            <center>
                <a href="covid-form.php"><button type="button" class="btn btn-large cyan darken-1">Tambah Data</button></a>
                <button type="submit" name="edit" class="btn btn-large cyan darken-1 orange lighten-2">Lihat/Ubah</button>
                <button type="submit" name="hapus" class="btn btn-large red" onclick="return confirm('Yakin ingin menghapus data? Data yang dihapus adalah seluruh data pada tanggal tersebut.')">Hapus Data Tanggal Tersebut</button>
                <button type="submit" name="salin" class="btn btn-large green darken-1">Salin Data H-1 dari Tanggal Tersebut</button>
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
    if (isset($_POST['edit'])) {
        $tgl       = $_POST['tgl'];
        $kelurahan = $_POST['kelurahan'];
        $cek = $mysqli->query("SELECT * FROM tb_persebaran WHERE tgl = '$tgl' AND id_kelurahan = '$kelurahan'") or die(mysqli_error($mysqli));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal di kelurahan tersebut tidak ada! Silahkan kembali dan gunakan menu tambah data.");
                </script>
            ';
        }
        else{
            setcookie('tgl', $_POST['tgl'], time() + (86400 * 30), "/");
            setcookie('kelurahan', $_POST['kelurahan'], time() + (86400 * 30), "/");
            header("Location: covid-form.php");
        }
    }
    else if (isset($_POST['hapus'])) {
        $tgl = $_POST['tgl'];
        $kelurahan = $_POST['kelurahan'];
        $cek = $mysqli->query("SELECT * FROM tb_persebaran WHERE tgl = '$tgl'") or die(mysqli_error($mysqli));
        $cek = mysqli_num_rows($cek);
        if ($cek == 0) {
            echo '
                <script>
                alert("Data tanggal tersebut tidak ada!");
                </script>
            ';
        }
        else{
            $hapus = $mysqli->query("DELETE FROM tb_persebaran WHERE tgl = '$tgl'") or die(mysqli_error($mysqli));

            if($hapus){
                echo '
                    <script>
                    alert("Data berhasil dihapus!");
                    window.location.href="covid.php";
                    </script>
                ';
            }
        }
    }
    else if (isset($_POST['salin'])) {
        $tgl = $_POST['tgl'];
        $cek = $mysqli->query("SELECT * FROM tb_persebaran WHERE tgl = '$tgl'") or die(mysqli_error($mysqli));
        $cek = mysqli_num_rows($cek);
        if ($cek > 0) {
            echo '
                <script>
                alert("Data tanggal tersebut sudah ada!");
                </script>
            ';
        }
        else{
            $pilih = $mysqli->query("SELECT * FROM tb_persebaran WHERE tgl = DATE_SUB('$tgl', INTERVAL 1 DAY)") or die(mysqli_error($mysqli));
            $cek = mysqli_num_rows($pilih);
            if ($cek == 0) {
                echo '
                    <script>
                    alert("Data H-1 tanggal tersebut tidak ada!");
                    </script>
                ';
            }
            else{

                $tambah = $mysqli->query("INSERT INTO tb_persebaran SELECT NULL, id_kabupaten, id_kecamatan, id_kelurahan, '$tgl', level, ppln, ppdn, tl, lainnya, perawatan, sembuh, meninggal FROM tb_persebaran WHERE tgl = DATE_SUB('$tgl', INTERVAL 1 DAY)") or die(mysqli_error($mysqli));

                if($tambah){
                    echo '
                        <script>
                        alert("Data berhasil disalin!");
                        window.location.href="covid.php";
                        </script>
                    ';
                }
            }
        }
    }
?>
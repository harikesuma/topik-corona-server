<?php include 'include/head1.php';?>

  <title>Tambah Berita - Covid-19 di Bali</title>

<?php include 'include/head2.php'; ?>

<?php include 'include/navbar.php';?>

<?php
    require_once '../connection.php';

    $query  = "SELECT judul, deskripsi, foto, tanggal FROM tb_news WHERE id = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s',$_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $berita = $result->fetch_assoc();
    $stmt->close();
?>

<!-- CONTENT START HERE -->

  <div class="section no-pad-bot" id="index-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col s12 m10 offset-m2">
          <h2>Berita</h2>
          <div class="card">
          <div class="card-content">
          <span class="card-title">Edit Berita Baru</span><br>
            <form action="action/berita_update.php" method="post" enctype="multipart/form-data">
                <input id="id" type="hidden" class="validate" name="id" value="<?php echo $_GET['id'] ?>" required>
                <input id="old-foto" type="hidden" class="validate" name="old-foto" value="<?php echo $berita['foto'] ?>" required>
                <div class="input-field">
                    <input id="tanggal" type="date" class="validate" name="tanggal" value="<?php echo $berita['tanggal'] ?>" required>
                    <label for="judul">Tanggal Berita</label>
                </div>
                <div class="input-field">
                    <input id="judul" type="text" class="validate" name="judul" value="<?php echo $berita['judul'] ?>" required>
                    <label for="judul">Judul Berita</label>
                </div>
                <div class="input-field">
                    <textarea name="deskripsi" class="materialize-textarea" id="deskripsi" required><?php echo $berita['deskripsi'] ?></textarea>
                    <label for="deskripsi">Deskripsi</label>
                </div>
                <div class="input-field">
                    <h5>Gambar Lama</h5>
                    <img src="<?php echo $berita['foto'] ?>" alt="">
                </div>
                <div class="file-field input-field">
                <div class="btn cyan darken-1">
                    <span>File</span>
                    <input type="file" name="foto">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Pilih File Gambar Baru Jika Ingin Mengubah Gambar">
                </div>
                </div>
                <div class="input-field">
                    <button class="btn waves-effect waves-light btn-large cyan darken-1" type="submit" name="update_berita"><i class="material-icons right">send</i>Submit</button>
                    <a href="berita.php" class="btn waves-effect waves-light btn-large red darken-1" type="button" name="cancel"><i class="material-icons right">cancel</i>Batal</a>
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
        $('.fixed-action-btn').floatingActionButton();
    });
</script>
  </body>
</html>
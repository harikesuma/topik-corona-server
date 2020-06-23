<?php include 'include/head1.php';?>

  <title>Tambah Berita - Covid-19 di Bali</title>

<?php include 'include/head2.php'; ?>

<?php include 'include/navbar.php';?>

<!-- CONTENT START HERE -->

  <div class="section no-pad-bot" id="index-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col s12 m10 offset-m2">
          <h2>Berita</h2>
          <div class="card">
          <div class="card-content">
          <span class="card-title">Tambah Berita Baru</span><br>
            <form action="action/berita_insert.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="tanggal" name="tanggal" value="">
                <div class="input-field">
                    <input id="judul" type="text" class="validate" name="judul" required>
                    <label for="judul">Judul Berita</label>
                </div>
                <div class="input-field">
                    <textarea name="deskripsi" class="materialize-textarea" id="deskripsi" required></textarea>
                    <label for="deskripsi">Deskripsi</label>
                </div>
                <div class="file-field input-field">
                <div class="btn cyan darken-1">
                    <span>File</span>
                    <input type="file" name="foto" required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Pilih File Gambar">
                </div>
                </div>
                <div class="input-field">
                    <button class="btn waves-effect waves-light btn-large cyan darken-1" type="submit" name="insert_berita"><i class="material-icons right">send</i>Submit</button>
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

    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

     var date = [year, month, day].join('-');

    document.getElementById("tanggal").value = date;
</script>
  </body>
</html>
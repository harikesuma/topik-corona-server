<?php include 'include/head1.php';?>

  <title>Berita - Covid-19 di Bali</title>

<?php include 'include/head2.php'; ?>

<style>
    th {text-align:center};
</style>

<?php include 'include/navbar.php';?>

<!-- CONTENT START HERE -->

  <div class="section no-pad-bot" id="index-banner">
    <div class="container-fluid">
      <div class="row">
        <div class="col s12 m10 offset-m2">
          <h2>Berita</h2>
          <div class="card">
          <div class="card-content">
          <span class="card-title">List Berita Aplikasi Covid-19 Bali</span><br>
            <table class="highlight responsive-table">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Link Foto</th>
                    <th>Jumlah Pengunjung</th>
                    <th>Dipost Oleh</th>
                    <th colspan="2" style="width: 10%;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  require 'action/berita_select.php';

                  $i = 1;
                  foreach ($beritas as $berita) {
                    echo '<tr>';
                    echo '<td style="text-align:center">'.$i.'</td>';
                    echo '<td style="text-align:center">'.$berita['tanggal'].'</td>';
                    echo '<td style="text-align:center">'.$berita['judul'].'</td>';
                    echo '<td style="text-align:center">'.$berita['deskripsi'].'</td>';
                    echo '<td style="text-align:center"><a href="'.$berita['foto'].'" class="waves-effect waves-light btn cyan darken-1" target="_blank"><i class="material-icons left">image</i>Lihat</a></td>';
                    echo '<td style="text-align:center">'.$berita['click'].'</td>';
                    echo '<td style="text-align:center">'.$berita['nama'].'</td>';
                    echo '<td style="text-align:center"><a href="berita-edit.php?id='.$berita['id'].'" class="waves-effect waves-light btn orange lighten-2"><i class="material-icons">edit</i></a></td>';
                    echo '<td style="text-align:center"><a href="action/berita_delete.php?id='.$berita['id'].'" class="waves-effect waves-light btn red" onclick="return confirm(\'Apakah anda yakin untuk menghapus item ini?\');"><i class="material-icons">delete</i></a></td>';
                    echo '</tr>';
                    $i++;
                  } 
                ?>
                </tbody>
            </table>
          </div>
        </div>
        <div class="fixed-action-btn horizontal" style="right:3em; bottom:3em;">
            <a href="berita-tambah.php" class="btn-floating btn-large red">
                <i class="large material-icons">add</i>
            </a>
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
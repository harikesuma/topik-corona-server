<?php
    require_once('../../connection.php');
    require_once('../cloudinary/Cloudinary_Setup.php');

    if(isset($_POST['insert_berita'])){

        $temp_dir       = "../temp/";
        $temp_file      = $temp_dir . basename($_FILES["foto"]["name"]);
        $imageFileType  = strtolower(pathinfo($temp_file,PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $temp_file)) {
            $uploaded = \Cloudinary\Uploader::upload($temp_file);
            if ($uploaded){

                $response = array();

                $admin_id       = $_COOKIE['id'];
                $judul          = $_POST['judul'];
                $deskripsi      = $_POST['deskripsi'];
                $foto           = $uploaded['secure_url'];
                $tanggal        = $_POST['tanggal'];

                $query  = "INSERT INTO tb_news VALUES(null,?,?,?,?,0,?)";

                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('sssss', $admin_id, $judul, $deskripsi, $foto, $tanggal);

                if ($stmt->execute()) {

                    unlink($temp_file);

                    $response["status_code"] = 200;
                    $response["message"] = "Upload Berhasil";
                    $response["data"] = [
                        "admin_id"  => $admin_id,
                        "judul"     => $judul,
                        "deskripsi" => $deskripsi,
                        "foto"      => $foto,
                        "tanggal"   => $tanggal
                    ];

                    $stmt->close();
                    echo json_encode($response);
                    echo"
                    <script>
                        alert('Berita berhasil ditambahkan!');
                    </script>
                    ";
                    header("Location: ../berita.php");
                }
                else {
                    $response["status_code"] = 400;
                    $response["message"] = $mysqli->error;
                    $response["data"] = null;

                    $stmt->close();
                    echo json_encode($response);
                    echo"
                    <script>
                        alert('Berita gagal ditambahkan!');
                    </script>
                    ";
                    header("Location: ../berita.php");
                }
            }
            else {
                echo "upload to cloud error";
            }
        }
        else {
            echo "move file error";
        }
    }
    else{
        echo "Post Data Null";
    }
?>
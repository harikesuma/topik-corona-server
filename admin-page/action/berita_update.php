<?php
    require_once('../../connection.php');
    require_once('../cloudinary/Cloudinary_Setup.php');

    if(isset($_POST['update_berita'])){

        if (!empty($_FILES['foto']['name'])) {

            $delete_image = substr($_POST['old-foto'], 65, -4);
    
            $temp_dir       = "../temp/";
            $temp_file      = $temp_dir . basename($_FILES["foto"]["name"]);
            $imageFileType  = strtolower(pathinfo($temp_file,PATHINFO_EXTENSION));
    
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $temp_file)) {
                $uploaded = \Cloudinary\Uploader::upload($temp_file);
                if ($uploaded){
    
                    \Cloudinary\Uploader::destroy($delete_image);
                    $response = array();
    
                    $id             = $_POST['id'];
                    $judul          = $_POST['judul'];
                    $deskripsi      = $_POST['deskripsi'];
                    $foto           = $uploaded['secure_url'];
                    $tanggal        = $_POST['tanggal'];
    
                    $query  = "UPDATE tb_news SET judul = ?, deskripsi = ?, foto = ?, tanggal = ? WHERE id = ?";
    
                    $stmt = $mysqli->prepare($query);
                    $stmt->bind_param('sssss', $judul, $deskripsi, $foto, $tanggal, $id);
    
                    if ($stmt->execute()) {
    
                        unlink($temp_file);
    
                        $response["status_code"] = 200;
                        $response["message"] = "Upload Berhasil";
                        $response["data"] = [
                            "judul"     => $judul,
                            "deskripsi" => $deskripsi,
                            "foto"      => $foto,
                            "tanggal"   => $tanggal
                        ];
    
                        $stmt->close();
                        echo json_encode($response);
                        echo"
                        <script>
                            alert('Berita berhasil diedit!');
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
                            alert('Berita gagal diedit!');
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
        else {
            $id             = $_POST['id'];
            $judul          = $_POST['judul'];
            $deskripsi      = $_POST['deskripsi'];
            $tanggal        = $_POST['tanggal'];

            $query  = "UPDATE tb_news SET judul = ?, deskripsi = ?, tanggal = ? WHERE id = ?";

            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssss', $judul, $deskripsi, $tanggal, $id);

            if ($stmt->execute()) {

                unlink($temp_file);

                $response["status_code"] = 200;
                $response["message"] = "Upload Berhasil";
                $response["data"] = [
                    "judul"     => $judul,
                    "deskripsi" => $deskripsi,
                    "tanggal"   => $tanggal
                ];

                $stmt->close();
                echo json_encode($response);
                echo"
                <script>
                    alert('Berita berhasil diedit!');
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
                    alert('Berita gagal diedit!');
                </script>
                ";
                header("Location: ../berita.php");
            }
        }
    }
    else{
        echo "Post Data Null";
    }
?>
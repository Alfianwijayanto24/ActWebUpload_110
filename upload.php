<?php

$target_dir = "uploads/";

// buat folder uploads jika belum ada
if(!is_dir($target_dir)){
    mkdir($target_dir, 0777, true);
}

// cek file dipilih
if(isset($_FILES["fileToUpload"])){

    // ambil nama file
    $file_name = $_FILES["fileToUpload"]["name"];

    // hilangkan spasi
    $file_name = str_replace(" ", "_", $file_name);

    // buat nama unik
    $file_name = time() . "_" . $file_name;

    // lokasi tujuan
    $target_file = $target_dir . $file_name;

    // upload file
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){

        // kembali ke halaman utama
        header("Location: index.html");
        exit;

    } else {

        echo "Upload gagal.";

    }

} else {

    echo "Tidak ada file dipilih.";

}

?>
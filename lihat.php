<?php

$folder = "uploads/";

if(!is_dir($folder)){
    mkdir($folder,0777,true);
}

/* =========================
   DELETE FILE
========================= */

if(isset($_GET['hapus'])){

    $file = $folder . $_GET['hapus'];

    if(file_exists($file)){
        unlink($file);
    }

    header("Location: lihat.php");
    exit;
}

/* =========================
   DOWNLOAD FILE
========================= */

if(isset($_GET['download'])){

    $file = $folder . $_GET['download'];

    if(file_exists($file)){

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Content-Length: ' . filesize($file));

        readfile($file);
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<style>

body{
    font-family:Arial;
    padding:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#4a90e2;
    color:white;
    padding:15px;
}

table td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tr:hover{
    background:#f9f9f9;
}

img{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:10px;
}

.btn{
    padding:10px 15px;
    text-decoration:none;
    color:white;
    border-radius:8px;
}

.download{
    background:green;
}

.delete{
    background:red;
}

.empty{
    color:gray;
    padding:20px;
}

</style>

</head>
<body>

<h2>Daftar File</h2>

<table>

<tr>
    <th>No</th>
    <th>Nama File</th>
    <th>Preview</th>
    <th>Download</th>
    <th>Delete</th>
</tr>

<?php

$files = array_diff(scandir($folder), array('.', '..'));

$no = 1;

if(count($files) > 0){

    foreach($files as $file){

        echo "<tr>";

        echo "<td>$no</td>";

        echo "<td>$file</td>";

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "gif"){

            echo "<td>
                    <img src='uploads/$file'>
                  </td>";

        } else {

            echo "<td>Tidak ada preview</td>";

        }

        // DOWNLOAD
        echo "<td>
                <a class='btn download'
                href='lihat.php?download=$file'>
                Download
                </a>
              </td>";

        // DELETE
        echo "<td>
                <a class='btn delete'
                href='lihat.php?hapus=$file'
                onclick=\"return confirm('Yakin ingin hapus?')\">
                Delete
                </a>
              </td>";

        echo "</tr>";

        $no++;
    }

} else {

    echo "<tr>";
    echo "<td colspan='5' class='empty'>Belum ada file</td>";
    echo "</tr>";

}

?>

</table>

</body>
</html>
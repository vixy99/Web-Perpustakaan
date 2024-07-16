<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];

    // Periksa apakah file yang diunggah adalah file gambar
    $foto = $_FILES['file_foto'];
    $nama_file = $foto['name'];
    $lokasi_file = $foto['tmp_name'];

    $folder = "Foto/"; // Folder tujuan penyimpanan file
    $path_file = $folder . $nama_file; // Path lengkap file

    $uploadOk = true;

    // Check if file is an actual image
    $check = getimagesize($lokasi_file);
    if($check !== false) {
        // File is an image
        $uploadOk = true;
    } else {
        // File is not an image
        $uploadOk = false;
    }

    // Check if file already exists
    if (file_exists($path_file)) {
        // File already exists
        $uploadOk = false;
    }

    // Check file size
    if ($_FILES["file_foto"]["size"] > 500000) {
        // File size is too large
        $uploadOk = false;
    }

    // Allow only certain file formats
    $imageFileType = strtolower(pathinfo($path_file,PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        // Only specific file formats are allowed
        $uploadOk = false;
    }

    // Check if $uploadOk is set to false by an error
    if ($uploadOk == false) {
        // Can't upload the file
        // Handle the error accordingly
    } else {
        // Everything is fine, proceed with uploading the file and saving the path to the database
        if (move_uploaded_file($lokasi_file, $path_file)) {
            // File successfully uploaded, save the file path to the database
            $query = mysqli_prepare($koneksi, "INSERT INTO buku (judul, foto) VALUES (?, ?)");
            mysqli_stmt_bind_param($query, "ss", $judul, $path_file);
            mysqli_stmt_execute($query);
            mysqli_stmt_close($query);
            // Proceed with any other operations or actions required after saving the photo
        } else {
            // Failed to upload the file
        }
    }
}
?>

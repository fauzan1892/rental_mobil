<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  |
  | @package   : rental_mobil
  | @file	   : proses.php
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html
  |
  |
  |
  |
 */
require '../../koneksi/koneksi.php';
$title_web = 'Tambah Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

if ($_GET['aksi'] == 'tambah') {

    $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/webp');
    $filepath = $_FILES['gambar']['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);
    $allowedTypes = [
        'image/png'   => 'png',
        'image/jpeg'  => 'jpg',
        'image/gif'   => 'gif',
        'image/jpg'   => 'jpeg',
        'image/webp'  => 'webp'
    ];
    if(!in_array($filetype, array_keys($allowedTypes))) {
        echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
        exit();
    }else if ($_FILES['gambar']["error"] > 0) {
        echo '<script>alert("Error file");history.go(-1)</script>';
        exit();
    } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
        echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
        exit();
    } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
        echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");window.location="tambah.php"</script>';
        exit();
    } else {
        $dir = '../../assets/image/';
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_path = $dir . basename($newfilename);
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['no_plat'];
            $data[] = $_POST['merk'];
            $data[] = $_POST['harga'];
            $data[] = $_POST['deskripsi'];
            $data[] = $_POST['status'];
            $data[] = $newfilename;

            $sql = "INSERT INTO `mobil`(`no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`) 
                VALUES (?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);
            echo '<script>alert("sukses");window.location="mobil.php"</script>';
        } else {
            echo '<script>alert("Harap Upload Gambar !");window.location="tambah.php"</script>';
        }
    }
}

if ($_GET['aksi'] == 'edit') {

    $gambar = $_POST['gambar_cek'];

    $id = $_GET['id'];

    $data[] = $_POST['no_plat'];
    $data[] = $_POST['merk'];
    $data[] = $_POST['harga'];
    $data[] = $_POST['deskripsi'];
    $data[] = $_POST['status'];
    $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/webp');
    $filepath = $_FILES['gambar']['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);
    $allowedTypes = [
        'image/png'   => 'png',
        'image/jpeg'  => 'jpg',
        'image/gif'   => 'gif',
        'image/jpg'   => 'jpeg',
        'image/webp'  => 'webp'
    ];
    if(!in_array($filetype, array_keys($allowedTypes))) {
        echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
        exit();
    }else if ($_FILES['gambar']["size"] > 0) {
        if ($_FILES['gambar']["error"] > 0) {
            echo '<script>alert("Error file");history.go(-1)</script>';
            exit();
        } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");history.go(-1)</script>';
            exit();
        } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");history.go(-1)</script>';
            exit();
        } else {
            $dir = '../../assets/image/';
            $tmp_name = $_FILES['gambar']['tmp_name'];
            $temp = explode(".", $_FILES["gambar"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_path = $dir . basename($newfilename);
            if (move_uploaded_file($tmp_name, $target_path)) {
                if (file_exists('../../assets/image/'.$gambar)) {
                    unlink('../../assets/image/'.$gambar);
                }
                $data[] = $newfilename;
            } else {
                echo '<script>alert("Error file");history.go(-1)</script>';
                exit();
            }
        }
    } else {
        $data[] = $_POST['gambar_cek'];
    }
    $data[] = $id;
    $sql = "UPDATE mobil SET no_plat= ?, merk=?, harga=?, deskripsi=?, status=?, gambar=?
        WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>alert("sukses");window.location="mobil.php"</script>';
}


if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/'.$gambar);

    $sql = "DELETE FROM mobil WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>alert("sukses hapus");window.location="mobil.php"</script>';
}

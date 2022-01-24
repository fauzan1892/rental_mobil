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
    if(empty($_SESSION['USER']))
    {
        session_start();
    }

    if($_GET['aksi'] == 'tambah')
    {
     
        $dir = '../../assets/image/';
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $name = time().basename($_FILES['gambar']['name']);
        $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );
		
		if ($_FILES['gambar']["error"] > 0) {
			$output['error']= "Error in File";
		} elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
		}elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");window.location="tambah.php"</script>';
		}else{
            if(move_uploaded_file($tmp_name, $dir.$name))
            {

                $data[] = $_POST['no_plat'];
                $data[] = $_POST['merk'];
                $data[] = $_POST['harga'];
                $data[] = $_POST['deskripsi'];
                $data[] = $_POST['status'];
                $data[] = $name;

                $sql = "INSERT INTO `mobil`(`no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`) 
                VALUES (?,?,?,?,?,?)";
                $row = $koneksi->prepare($sql);
                $row->execute($data);
                echo '<script>alert("sukses");window.location="mobil.php"</script>';
            }else{
                echo '<script>alert("Harap Upload Gambar !");window.location="tambah.php"</script>';
            }
        }
    }

    if($_GET['aksi'] == 'edit')
    {

        $dir = '../../assets/image/';
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $name = time().basename($_FILES['gambar']['name']);

        $gambar = $_GET['gambar'];

        unlink('../../assets/image/'.$gambar);
        
        $id = $_GET['id'];

		if ($_FILES['gambar']["error"] > 0) {
			$output['error']= "Error in File";
		} elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
		}elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");window.location="tambah.php"</script>';
		}else{
            if(move_uploaded_file($tmp_name, $dir.$name))
            {
                $data[] = $_POST['no_plat'];
                $data[] = $_POST['merk'];
                $data[] = $_POST['harga'];
                $data[] = $_POST['deskripsi'];
                $data[] = $_POST['status'];
                $data[] = $name;
                $data[] = $id;

                $sql = "UPDATE mobil SET no_plat= ?, merk=?, harga=?, deskripsi=?, status=?, gambar=?
                WHERE id_mobil = ?";
                $row = $koneksi->prepare($sql);
                $row->execute($data);

                echo '<script>alert("sukses");window.location="mobil.php"</script>';

            }else{

                $data[] = $_POST['no_plat'];
                $data[] = $_POST['merk'];
                $data[] = $_POST['harga'];
                $data[] = $_POST['deskripsi'];
                $data[] = $_POST['status'];
                $data[] = $id;

                $sql = "UPDATE mobil SET no_plat=?, merk=?, harga=?, deskripsi=?, status = ?
                WHERE id_mobil = ?";
                $row = $koneksi->prepare($sql);
                $row->execute($data);

                echo '<script>alert("sukses");window.location="mobil.php"</script>';

            }
        }
    }


    if(!empty($_GET['aksi'] == 'hapus'))
    {
        $id = $_GET['id'];
        $gambar = $_GET['gambar'];

        unlink('../../assets/image/'.$gambar);

        $sql = "DELETE FROM mobil WHERE id_mobil = ?";
        $row = $koneksi->prepare($sql);
        $row->execute(array($id));

        echo '<script>alert("sukses hapus");window.location="mobil.php"</script>';

    }




?>
<?php
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
        $name = basename($_FILES['gambar']['name']);
        

        $data[] = $_POST['no_plat'];
        $data[] = $_POST['merk'];
        $data[] = $_POST['harga'];
        $data[] = $_POST['deskripsi'];
        $data[] = $_POST['status'];
        $data[] = $name;

        if(move_uploaded_file($tmp_name, $dir.$name))
        {

            $sql = "INSERT INTO `mobil`(`no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`) 
            VALUES (?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);

            echo '<script>alert("sukses");window.location="mobil.php"</script>';

        }
    }

    if($_GET['aksi'] == 'edit')
    {

     
        $dir = '../../assets/image/';
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $name = basename($_FILES['gambar']['name']);

        $gambar = $_GET['gambar'];

        unlink('../../assets/image/'.$gambar);
        
        $id = $_GET['id'];


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
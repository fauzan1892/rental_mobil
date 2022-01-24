<?php
 require '../../koneksi/koneksi.php';

if($_GET['id'] == 'konfirmasi')
{
    $data2[] = $_POST['status'];
    $data2[] = $_POST['id_mobil'];
    $sql2 = "UPDATE `mobil` SET `status`= ? WHERE id_mobil= ?";
    $row2 = $koneksi->prepare($sql2);
    $row2->execute($data2);

    echo '<script>alert("Status Mobil di pinjam");history.go(-1);</script>'; 
}
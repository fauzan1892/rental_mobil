<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rental_mobil
  | @file	   : detail.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/products/source-code-aplikasi-rental-mobil-php-mysql-7.html 
  | 
  | 
  | 
  | 
 */
    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    $id = strip_tags($_GET['id']);
    $hasil = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<div class="container mt-5">
<div class="row">
    <div class="col-sm-6">
        <img class="card-img-top w-100" 
            style="object-fit:cover;" 
            src="assets/image/<?php echo $hasil['gambar'];?>" alt="">
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $hasil['merk'];?></h4>
                <p class="card-text">
                    Deskripsi :
                    <?php echo $hasil['deskripsi'];?>
                </p>
                <ul class="list-group list-group-flush">
                    <?php if($hasil['status'] == 'Tersedia'){?>
                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> Available
                    </li>
                    <?php }else{?>
                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Not Available
                    </li>
                    <?php }?>
                    <li class="list-group-item bg-info text-white"><i class="fa fa-check"></i> Free E-toll 50k</li>
                    <li class="list-group-item bg-dark text-white">
                        <i class="fa fa-money"></i> Rp. <?php echo number_format($hasil['harga']);?>/ day
                    </li>
                </ul>
                <hr/>
                <center>
                    <a href="booking.php?id=<?php echo $hasil['id_mobil'];?>" class="btn btn-success">Booking now!</a>
                    <a href="index.php" class="btn btn-info">Back</a>
                </center>
            </div>
         </div> 
    </div>
</div>
</div>


<?php include 'footer.php';?>
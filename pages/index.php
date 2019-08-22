<?php
    session_start();
    if(isset($_SESSION['login']))
    {
    
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
<html>
    <head>
        <style type="text/css">
           td { font-size: 13px; }
        </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>Aplikasi RAT 2.1 v5.6</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../assets/css/sb-admin.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/icon.png">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Aplikasi RAT 2.1 v5.6</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> 
                        Login sebagai, <b><?php echo $_SESSION['nama']; ?></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                            <li><a href="?id=25"><i class="fa fa-info fa-fw"></i> Tutorial</a>
                            </li>
                            
                            <?php

                            if ($_SESSION['level']=='admin')
                            {

                            ?>
                            <li><a href="?id=101"><i class="fa fa-plus fa-fw"></i> Input Uang</a>
                            </li>
                            <li><a href="?id=16"><i class="fa fa-plus fa-fw"></i> Tambah Bendahara</a>
                            </li>
                            <li><a href="?id=26"><i class="fa fa-plus fa-fw"></i> Tambah User</a>
                            </li>
                             <li><a href="?id=29"><i class="fa fa-plus fa-fw"></i> Tambah Anggota</a>
                            </li>
                            <li><a href="?id=100"><i class="fa fa-minus-circle fa-fw"></i> Hapus Semua Data</a>
                            </li>

                            <?php
                            }
                            else
                            {}
                            ?>

                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
                            </li>
                        </ul>
                </li>
            </ul>

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?id=1"><i class="fa fa-plus fa-fw"></i><b> Input Absensi</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=18"><i class="fa fa-plus fa-fw"></i><b> Input Kuasa yang Hadir</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=3"><i class="fa fa-book fa-fw"></i><b> Lihat Data Anggota</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=8"><i class="fa fa-upload fa-fw"></i><b> Upload Data Anggota</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=7"><i class="fa fa-file fa-fw"></i><b> Laporan Kehadiran</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=12"><i class="fa fa-print fa-fw"></i><b> Cetak Bukti Pembayaran</b></a>
                        </li>
                        <li>
                            <a href="index.php?id=21"><i class="fa fa-print fa-fw"></i><b> Cetak Kupon (Khusus Kuasa yang Hadir)</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <?php
            include 'switch.php';
            ?>
        </div>

    </div>

    <script src="../assets/js/jquery-1.10.2.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="../assets/js/sb-admin.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-data').dataTable();
        });
    </script>
</body>

</html>
<?php
    }
    else
    {
        include "login.html";   
    }
?>
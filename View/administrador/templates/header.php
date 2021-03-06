<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Dashboard</title>
  
  <link rel="shortcut icon" href="/corretora/View/visual/favicon2.ico" />
  <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>
<style>
.bg-dark {
    background-color: #ef7f1b !important;
}
.sidebar.navbar-nav{
  background-color: #363636 !important;
}
body {
  font-family: 'Nunito', sans-serif;
}
</style>


<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Visão Geral</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="badge badge-danger">!</span>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Barra Lateral -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/corretora/index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Painel Administrativo</span>
        </a>
      </li>

      <!-- Cadastro de Banners -->
      <li class="nav-item">
        <a class="nav-link" href="banners.php">
          <i class="fas fa-fw fa-file-image"></i>
          <span>Banners</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="anuncios.php">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Anúncios p/ Aprovação</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="anunciosTotais.php">
          <i class="fas fa-fw fa-bullhorn"></i>
          <span>Anúncios Totais</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Usuários</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="matches.php">
          <i class="fas fa-fw fa-check-double"></i>
          <span>Matches</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="\corretora\View\login\user\logout.php">
         
          <i class="fas fa-sign-out-alt"></i>
          <span>Sair</span></a>
      </li>
    </ul>
    <div id="content-wrapper">

      <div class="container-fluid">

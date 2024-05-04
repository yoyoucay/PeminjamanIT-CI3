<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand flex items-center justify-center" href="index.html">
    <div class="sidebar-brand-icon bg-white w-full rounded flex items-center justify-center">
      <img class="my-2 w-14" src="<?= base_url('public/'); ?>images/logo.png">
      <!-- Adjust max-width as needed -->
    </div>
  </a>


  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Peminjaman
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>List Peminjaman</span>
    </a>
    <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">List Peminjaman :</h6>
        <a class="collapse-item" href="buttons.html">Ajukan Peminjaman</a>
        <a class="collapse-item" href="cards.html">Data Peminjaman</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Admin
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-clipboard"></i>
      <span>Menu Admin</span>
    </a>
    <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Menu admin :</h6>
        <a class="collapse-item" href="<?= base_url('request'); ?> ">Persetujuan Peminjaman</a>
        <a class="collapse-item" href="<?= base_url('account'); ?>">Akun</a>
      </div>
    </div>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Heading -->
  <div class="sidebar-heading">
    Account
  </div>

  <!-- Nav Item - Tables -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('logout'); ?>">
      <i class="fas fa-fw fa-power-off"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
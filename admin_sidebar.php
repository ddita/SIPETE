<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <li class="nav-item">
    <a href="../admin_dashboard" class="nav-link <?php if($konstruktor=='admin_dashboard'){echo 'active';}?>">
      <i class="nav-icon fas fa-home"></i>
      <p>Dashboard</p>
    </a>
  </li>
  <li class="nav-item <?php if($konstruktor=='admin_master_data_bank'){echo 'menu-open';} if($konstruktor=='admin_master_administrator'){echo 'menu-open';} if($konstruktor=='admin_master_operator'){echo 'menu-open';}?> <?php if($konstruktor=='admin_master_biaya'){echo 'menu-open';}?>"> 
    <a href="#" class="nav-link <?php if($konstruktor=='admin_master_data_bank'){echo 'active';}if($konstruktor=='admin_master_administrator'){echo 'active';}if($konstruktor=='admin_master_operator'){echo 'active';}?> " <?php if($konstruktor=='admin_master_biaya'){echo 'active';}?>>
      <i class="nav-icon fas fa-database"></i>
      <p>
        Master Data
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="../admin_master_data_bank" class="nav-link <?php if($konstruktor=='admin_master_data_bank'){echo 'active';}?>">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Bank</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_master_administrator" class="nav-link <?php if($konstruktor=='admin_master_administrator'){echo 'active';}?>">
          <i class="far fa-circle nav-icon"></i>
          <p>Administrator</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_master_operator" class="nav-link <?php if($konstruktor=='admin_master_operator'){echo 'active';}?>">
          <i class="far fa-circle nav-icon"></i>
          <p>Operator</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="../admin_master_biaya" class="nav-link <?php if($konstruktor=='admin_master_biaya'){echo 'active';}?>">
          <i class="far fa-circle nav-icon"></i>
          <p>Biaya Admin</p>
        </a>
      </li>
    </ul>
  </li>
  
   <!-- TRANSAKSI -->
  
  <li class="nav-item">
    <a href="../admin_nota_transaksi" class="nav-link <?php if($konstruktor=='admin_nota_transaksi'){echo 'active';}?>">
      <i class="fas fa-credit-card nav-icon"></i>
      <p>Nota Transaksi</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../laporan_laba" class="nav-link <?php if($konstruktor=='laporan_laba'){echo 'active';}?>">
      <i class="fas fa-clipboard-list nav-icon"></i>
      <p>Laporan Laba</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../admin_gantipw" class="nav-link <?php if($konstruktor=='admin_gantipw'){echo 'active';}?>">
      <i class="fas fa-lock nav-icon"></i>
      <p>Ganti Password</p>
    </a>
  </li>
  <li class="nav-item">
    <a href="../login/logout.php" class="nav-link">
      <i class="fas fa-sign-out-alt nav-icon"></i>
      <p>Keluar</p>
    </a>
  </li>
</ul>
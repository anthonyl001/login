<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fa fa-car"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Website Asal2an <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider ">

<?php 
  $role_id=$this->session->userdata('role_id');
  
  $queryMenu2= "
    SELECT user_menu.id,menu
    FROM user_menu JOIN user_access_menu
    on user_menu.id=user_access_menu.menu_id 
    WHERE user_access_menu.role_id=$role_id
    ORDER BY user_access_menu.menu_id
  ";
  $menu=$this->db->query($queryMenu2)->result_array();
?>

<?php foreach ($menu as $m): ?>
  <!-- Heading -->
  <div class="sidebar-heading">
    <?= $m['menu']?>
    
  </div>
  <hr class="sidebar-divider d-none d-md-block bt-3">
  <?php
  $menuId=$m['id']; 
    $querySubmenu="
      SELECT *
      FROM user_sub_menu join user_menu
      ON user_sub_menu.menu_id=user_menu.id
      WHERE user_sub_menu.menu_id=$menuId
      and user_sub_menu.is_active=1
    ";

  $subMenu=$this->db->query($querySubmenu)->result_array();

  ?>

    <?php foreach ($subMenu as $sm ) : ?>
      
      <!-- Nav Item - Dashboard -->
      <?php if($title==$sm['title']) : ?>
      <li class="nav-item active">
        <?php else: ?>
          <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link" href="<?= base_url($sm['url']);?>">
          <i class="<?= $sm['icon']?>"></i>
          <span><?= $sm['title']?></span></a>
          
      </li>
    <?php endforeach; ?>
    
<?php endforeach; ?>


<!-- Nav Item - Charts -->
<li class="nav-item">
  <a class="nav-link" href="<?= base_url('auth/logout')?>">
    <i class="fas fa-fw fa-chart-area"></i>
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
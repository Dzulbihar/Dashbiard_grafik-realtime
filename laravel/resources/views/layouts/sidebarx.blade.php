  
<?php 
$koneksi=oci_connect ('TRUKING','truking2022','10.130.0.238:1521/dbtes');
?>

  <aside class="main-sidebar sidebar-light-dark ">
    <!-- Brand Logo -
    <a href="{{url('/home')}}" class="brand-link">
      <img src="{{asset('logo/pelindo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle " style="opacity: .8">
      <span class="brand-text font-weight-light"> EIS TPSM </span>
    </a>-->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('logo/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/home')}}" class="d-block"> {{ Auth::user()->name }}  </a>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php
        $query = oci_parse($koneksi," SELECT * FROM EIS_V_ROLE_MENU where role_id=".Auth::user()->role_id);
        oci_execute($query);
        $main_menu= oci_fetch_array($query, OCI_BOTH);
        
        foreach ($main_menu as $main) {
          // Query untuk mencari data sub menu
          $query1 = oci_parse($koneksi," SELECT * FROM EIS_M_MENU where menu_parent=".$main->{MENU_ID[]});
          oci_execute($query1);
          $sub_menu= oci_fetch_array($query1, OCI_BOTH);

          if ($sub_menu->num_rows() > 0) {
            echo " <li class='nav-item has-treeview'>";
            echo " <a href='#' class='nav-link'>";
            echo "<i class='nav-icon fas " . $main->MENU_ICON . "'></i>";
            echo "<p>" . $main->MENU_LABEL . "<i class='right fas fa-angle-left'></i></p></a>";
            echo "<ul class='nav nav-treeview'>";
            foreach ($sub_menu as $sub) {
              // Query untuk mencari data sub menu2
              $query2 = oci_parse($koneksi," SELECT * FROM EIS_M_MENU where menu_id=".$sub->{MENU_ID[]});
              oci_execute($query2);
              $sub_menu2= oci_fetch_array($query2, OCI_BOTH);

              if ($sub_menu2->num_rows() > 0) {
                echo " <li class='nav-item has-treeview'>";
                echo " <a href='#' class='nav-link'>";
                echo "<i class='far fa-circle nav-icon text-warning'></i>";
                echo "<p>" . $sub->MENU_LABEL . "<i class='right fas fa-angle-left'></i></p></a>";
                echo "<ul class='nav nav-treeview'>";
                foreach ($sub_menu2 as $sub2) {
                  echo "<li class='nav-item'>";
                  echo "<a href='{{url(".$sub2->MENU_URL.")}}' class='nav-link'>";
                  echo "<i class='far fa-dot-circle nav-icon text-danger'></i>";
                  echo "<p>" . $sub2->MENU_LABEL . "</p> </a> </li>";
                }
                echo "</ul>";
              } else {
                echo "<li class='nav-item'>";
                echo "<a href='{{url(".$sub->MENU_URL.")}}' class='nav-link'>";
                echo "<i class='far fa-circle nav-icon text-warning'></i>";
                echo "<p>" . $sub->MENU_LABEL . "</p> </a> </li>";
              }

              echo "</li>";
            }
            echo "</ul>";
            echo "</li>";
          } else {
            echo "<li class='nav-item'>";
            echo "<a href='{{url(".$main->MENU_URL.")}}' class='nav-link'>";
            echo "<i class='nav-icon fas " . $main->MENU_ICON . "'></i>";
            echo "<p>" . $main->MENU_LABEL . "<i class='right fas fa-angle-left'></i></p></a>";
          }
        } ?>

      </ul>
    </nav>
   
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
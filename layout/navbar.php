 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="" class="img-circle" alt="">
        </div>
        <div class="">
                  <p class = "session-font"> Welcome <?php echo ucfirst($_SESSION['username']);?></p>
         
        </div>
      </div> <br> 
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> DashBoard</a></li>
        <!--<li><a href="category.php"><i class="fa fa-list-alt"></i> Categories </a></li>
        <li><a href="addproduct.php"><i class="fa fa-product-hunt"></i> Add Product </a></li>
        <li><a href="productlist.php"><i class="fa fa-th-list"></i> Product List </a></li>
        <li><a href="createorder.php"><i class="fa fa-th-list"></i> Create Order </a></li>
        <li><a href="orderlist.php"><i class="fa fa-th-list"></i> Order List</a></li>-->
        <li><a href="registration.php"><i class="fa fa-registered"></i> Admin Registration </a></li>
        <li><a href="customer.php"><i class="fa fa-user"></i> Customer </a></li>
        <li><a href="search_customer.php"><i class="fa fa-search"></i> Search Customer </a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out </a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
   
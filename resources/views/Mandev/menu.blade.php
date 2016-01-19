<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
  <div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="{{$menu['ul']}}" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

      <li class="start active ">
        <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/home">
          <i class="icon-home"></i>
          <span class="title">Anasayfa</span>
          <span class="selected"></span>
        </a>
      </li>
      <li>
        <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/users">
          <i class="fa fa-user"></i>
          <span class="title">{{$user_capter_menu}}</span>
          <span class="arrow "></span>
        </a>
        <!--<ul class="sub-menu">
          <li>
            <a href="ecommerce_index.html">
              <i class="icon-home"></i>
              Dashboard</a>
          </li>
          <li>
            <a href="ecommerce_orders.html">
              <i class="icon-basket"></i>
              Orders</a>
          </li>
          <li>
            <a href="ecommerce_orders_view.html">
              <i class="icon-tag"></i>
              Order View</a>
          </li>
          <li>
            <a href="ecommerce_products.html">
              <i class="icon-handbag"></i>
              Products</a>
          </li>
          <li>
            <a href="ecommerce_products_edit.html">
              <i class="icon-pencil"></i>
              Product Edit</a>
          </li>
        </ul>-->
      </li>
      <li>
        <a href="{{$baseUrl}}/{{strtolower(config("app.admin_dirname"))}}/api">
          <i class="icon-rocket"></i>
          <span class="title">Api Merkezi</span>
          <span class="arrow "></span>
        </a>
      </li>


    </ul>
    <!-- END SIDEBAR MENU -->
  </div>
</div>
<!-- END SIDEBAR -->
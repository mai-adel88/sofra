  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>سفره</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                <p>
                  {{auth()->user()->name}}
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  {!! Form::open(['method' => 'post', 'url' => url(route('logout'))]) !!}
                  <button  class="btn btn-default btn-flat">Sign out</button>
                  {!! Form::close() !!}
                  
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview ">
            <a href="#">
              <i class="fa fa-users"></i><span>المستخدمين</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('admin\users')}}"><i class="fa fa-users"></i> <span>عرض المستخدمين</span></a></li>
              <li><a href="{{url('admin\roles')}}"><i class="fa fa-list"></i> <span>رتب المستخدمين</span></a></li>
              <li><a href="{{url('admin\change-password')}}"><i class="fa fa-key"></i> <span>تغيير كلمة المرور</span></a></li>
            </ul>
        </li>  
     
        <li><a href="{{url('admin\clients')}}"><i class="fa fa-users"></i> <span>عملاء المطعم</span></a></li>
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-building"></i><span>المطاعم</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin\restaurant')}}"><i class="fa fa-circle-o"></i> <span>المطاعم</span></a></li>
            <li><a href="{{url('admin\categories')}}"><i class="fa fa-circle-o"></i> <span>تصنيفات المطاعم</span></a></li>
          </ul>
        </li>

        <li class="treeview ">
          <a href="#">
            <i class="fa fa-map-marker"></i><span>المناطق</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin\cities')}}"><i class="fa fa-city"></i> <span>المدن</span></a></li>
        <li><a href="{{url('admin\regions')}}"><i class="fa fa-map-marker"></i> <span>المناطق</span></a></li>
          </ul>
        </li>
        <li><a href="{{url('admin\offers')}}"><i class="fa fa-phone"></i> <span>العروض</span></a></li>
        <li><a href="{{url('admin\orders')}}"><i class="fa fa-sticky-note"></i> <span>الطلبات</span></a></li>
        <li><a href="{{url('admin\payments')}}"><i class="fa fa-phone"></i> <span>العمليات الماليه</span></a></li>
        <li><a href="{{url('admin\contacts')}}"><i class="fa fa-phone"></i> <span>تواصل معنا</span></a></li>
        
        <li><a href="{{url('admin\settings')}}"><i class="fa fa-cogs"></i> <span>الاعدادات</span></a></li>

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
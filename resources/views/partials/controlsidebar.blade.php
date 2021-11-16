<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVEGACION</li>
        <li class="treeview {{ (request()->is('home')) ? 'active' : '' }}">
          <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
          
        </li>
       
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Almacen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu ">
            <li class="treeview {{ ! Route:: is('categoria.index') ?: 'active' }} " ><a href="{{ route('categoria.index') }}"><i class="fa fa-circle-o"></i> Categorias</a></li>
            <li class="treeview {{ ! Route:: is('articulo.index') ?: 'active' }} "><a href="{{ route('articulo.index') }}"><i class="fa fa-circle-o"></i> Articulos</a></li>
          </ul>
        </li>
       
        <li class="treeview {{ ! Route:: is('cliente.index') ?: 'active' }} "><a href="{{ route('cliente.index') }}"><i class="fa fa-user"></i> <span>Clientes</span></a></li>
        <li class="treeview {{ ! Route:: is('proveedor.index') ?: 'active' }} "><a href="{{ route('proveedor.index') }}"><i class="fa fa-users"></i> <span>Proveedores</span></a></li>
        <li class="treeview {{ ! Route:: is('ingreso.index') ?: 'active' }} "><a href="{{ route('ingreso.index') }}"><i class="fa fa-inbox"></i> <span>Ingresos</span></a></li>
        <li class="treeview {{ ! Route:: is('venta.index') ?: 'active' }} "><a href="{{ route('venta.index') }}"><i class="fa fa-cart-plus"></i> <span>Ventas</span></a></li>

        <li class="header">Administracion</li>
        <li class="treeview {{ ! Route:: is('user.index') ?: 'active' }}"><a href="{{ route('user.index') }}"><i class="fa fa-circle-o text-red"></i> <span>Usuarios</span></a></li>
        <li class="treeview {{ ! Route:: is('datos.index') ?: 'active' }}"><a  href="{{ route('datos.index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Datos</span></a></li>
        <li class="treeview {{ ! Route:: is('info.index') ?: 'active' }} "><a  href="{{ route('info.index') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Informacion</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src=<?=$_SESSION['url_avatar'] ?> alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['nombre_trabajador']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['rol_usuario'];?> </p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?= base_url();?>dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li class="treeview"> 
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-users"></i>
              <span class="app-menu__label">Usuarios</span>
              <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" href="<?= base_url();?>usuario/gestionar_usuarios" target="" rel="noopener">
              <i class="icon fa fa-circle-o"></i> Gestionar Usuarios</a>
            </li>
          </ul>
        </li>

        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-gift"></i>
              <span class="app-menu__label">Productos</span>
              <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" href="<?= base_url();?>categoria/gestionar_categorias" target="" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Gestionar Categorias
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url();?>producto/gestionar_productos" target="" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Gestionar Productos
              </a>
            </li>
            <li>
              <a class="treeview-item" href="<?= base_url();?>combo/gestionar_combo" target="" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Gestionar Combos
              </a>
            </li>
          </ul>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-usd"></i>
          <span class="app-menu__label">Ventas</span></a>
        </li>
        <li><a class="app-menu__item" href="<?= base_url();?>cliente/gestionar_clientes"><i class="app-menu__icon fa fa-user-circle-o"></i>
          <span class="app-menu__label">Clientes</span></a>
        </li>
        <li><a class="app-menu__item" href="<?= base_url();?>proveedor/gestionar_proveedores"><i class="app-menu__icon fa fa-truck"></i>
          <span class="app-menu__label">Proveedores</span></a>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-shopping-cart"></i>
          <span class="app-menu__label">Compras</span></a>
        </li>
        <li><a class="app-menu__item" href="docs.html"><i class="app-menu__icon fa fa-sign-out"></i>
          <span class="app-menu__label">Cerrar Sesión</span></a>
        </li>
      </ul>
    </aside>
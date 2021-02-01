    <?php 
        $bandera = $_SESSION['rol_usuario'] == "ADMINISTRADOR" ? true:false;
    ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src=<?=$_SESSION['url_avatar'] ?>
                alt="User Image">
            <div>
                <p class="app-sidebar__user-name"><?= $_SESSION['nombre_trabajador']; ?></p>
                <p class="app-sidebar__user-designation"><?= $_SESSION['rol_usuario'];?> </p>
            </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item" href="<?= base_url();?>dashboard"><i
                        class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>
            <?php if($bandera){ ?>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-users"></i>
                    <span class="app-menu__label">Usuarios</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>usuario/gestionar_usuarios" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Gestionar Usuarios</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-gift"></i>
                    <span class="app-menu__label">Productos</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>categoria/gestionar_categorias" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Gestionar Categorías
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>producto/gestionar_productos" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Gestionar Productos
                        </a>
                    </li>
                    <!-- <li>
              <a class="treeview-item" href=" base_url();combo/gestionar_combo" target="" rel="noopener">
                <i class="icon fa fa-circle-o"></i> Gestionar Combos
              </a>
            </li> -->
                </ul>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-usd"></i>
                    <span class="app-menu__label">Ventas</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/realizar_venta" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Realizar una venta
                        </a>
                    </li>
                
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/listar_ventas_general" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Ver ventas
                        </a>
                    </li>

                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/reporte_ventas" target=""
                            rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Reporte ventas
                        </a>
                    </li>
                </ul>
            </li>
            <li><a class="app-menu__item" href="<?= base_url();?>cliente/gestionar_clientes"><i
                        class="app-menu__icon fa fa-user-circle-o"></i>
                    <span class="app-menu__label">Clientes</span></a>
            </li>
            <?php if($bandera){ ?>
            <li><a class="app-menu__item" href="<?= base_url();?>proveedor/gestionar_proveedores"><i
                        class="app-menu__icon fa fa-truck"></i>
                    <span class="app-menu__label">Proveedores</span></a>
            </li>


            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-shopping-cart"></i>
                    <span class="app-menu__label">Compras</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>compra/agregar_compra" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Añadir una compra
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>compra/ver_compras" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Ver compras realizadas
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-history"></i>
                    <span class="app-menu__label">Historial</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/ventas_realizadas" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Lista de ventas realizadas
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/ventas_eliminadas" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Lista de ventas eliminadas
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-history"></i>
                    <span class="app-menu__label">Reportes</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/ventas_realizadas" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Lista de ventas realizadas
                        </a>
                    </li>
                    <li>
                        <a class="treeview-item" href="<?= base_url();?>venta/ventas_eliminadas" target="" rel="noopener">
                            <i class="icon fa fa-circle-o"></i> Lista de ventas eliminadas
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>
            <li><a class="app-menu__item" href="<?= base_url();?>logout"><i class="app-menu__icon fa fa-sign-out"></i>
                    <span class="app-menu__label">Cerrar Sesión</span></a>
            </li>
        </ul>
    </aside>
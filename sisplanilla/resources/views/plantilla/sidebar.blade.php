<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">

                    <li @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-home"></i>Home</a>
                    </li>

                    <li class="nav-title">
                        Mantenimiento
                    </li>

                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-user"></i>Usuarios</a>   
                    </li>                 

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-lock"></i>Permisos de acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=2" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-wallet"></i>Roles</a>
                            </li>
                            <li @click="menu=3" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-notebook"></i>Privilegios</a>
                            </li>
                        </ul>
                    </li>

                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-grid"></i>Menus</a>
                    </li>

                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i>Empresa</a>
                    </li>

                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
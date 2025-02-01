<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link <?= $active_menu == 'dashboard' ? 'active' : ''; ?>" href="<?= site_url('admin');?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link <?= $active_menu == 'pengguna' ? 'active' : ''; ?>" href="<?= site_url('pengguna'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Users
                            </a>    
                            
                            <div class="sb-sidenav-menu-heading">Master Data</div>
                            <a class="nav-link <?= $active_menu == 'task' ? 'active' : ''; ?>" href="<?= site_url('datatask'); ?>" href="<?= site_url('datatask'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Data Tasks
                            </a>
                           
                            <div class="sb-sidenav-menu-heading">Akses Login</div>
                            <a class="nav-link" href="<?= site_url('adminlogout'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as : <span class="label label-success badge-pill"><?php echo 'MrX'; ?></span> </div>
                        
                    </div>
                </nav>
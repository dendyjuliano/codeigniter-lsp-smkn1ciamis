<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('assets/img/logo.png') ?>" width="50" alt="">
            </div>
            <div class="sidebar-brand-text mx-2"><?= $this->session->userdata('nama_asesor') ?></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu =    "SELECT  `tb_user_menu`.`id`,`menu` from `tb_user_menu` 
            join `tb_user_access_menu` on `tb_user_menu`.`id`= `tb_user_access_menu`.`menu_id` 
            where `tb_user_access_menu`.`role_id` = $role_id 
            order by `tb_user_access_menu`.`menu_id` asc";
        $menu = $this->db->query($queryMenu)->result_array();
        ?>

        <!-- Nav Item - Dashboard -->
        <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- Sub menu yang di tampikan -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT * from `tb_user_sub_menu` join `tb_user_menu`
                    on `tb_user_sub_menu`.`menu_id` = `tb_user_menu`.`id`
                    where `tb_user_sub_menu`.`menu_id` = $menuId";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
                <?php if ($title == $sm['title']) : ?>
                    <li class="nav-item active">
                    <?php else : ?>
                    <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="<?= base_url($sm['url']) ?>">
                        <i class="<?= $sm['icon'] ?>"></i>
                        <span><?= $sm['title'] ?></span></a>
                    </li>
                <?php endforeach; ?>
                <hr class="sidebar-divider">
            <?php endforeach; ?>



            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

    </ul>
    <!-- End of Sidebar -->
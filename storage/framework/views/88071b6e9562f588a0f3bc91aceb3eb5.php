<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('profile.index')); ?>" key="t-default">Profile</a></li>
                    </ul>
                </li>

                <li class="menu-title" key="t-backend">Pengaturan</li>
                <li>
                    <a href="<?php echo e(route('paket.index')); ?>" class="waves-effect">
                        <i class="bx bx-package"></i>
                        <span key="t-paket"><?php echo app('translator')->get('translation.paket-sidebar'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('customer.index')); ?>" class="waves-effect">
                        <i class="bx bx-package"></i>
                        <span key="t-paket"><?php echo app('translator')->get('translation.user_p'); ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH /Users/apple/rey/semester4/DUMMY/kurir/DONE/Skote_Html_Laravel_v4.2.3/Laravel/Admin/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>
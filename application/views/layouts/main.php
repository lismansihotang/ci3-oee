<?php
$current_url = uri_string(); // misal: 'users/index/2'
$menu_active = function ($url) {
    return strpos(uri_string(), $url) === 0 ? 'c-active active' : '';
};
$url_img = base_url() . 'assets/coreui-template-main/dist';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <?= load_css() ?>
</head>

<body>

    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <h4 class="text-white p-3">My App</h4>
        </div>
        <?= generate_menu($menu); ?>
    </div>

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <header class="header header-sticky mb-4">
            <div class="container-fluid">
                <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                    ☰
                </button>
                <?= breadcrumb($breadcrumb_custom ?? null); ?>
                <ul class="header-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#"><?php echo html_escape($this->session->userdata('username')); ?></a></li>
                </ul>
                <ul class="header-nav">
                    <li class="nav-item py-1">
                        <div class="vr h-100 mx-2 text-body text-opacity-75"></div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-md"><img class="avatar-img" src="<?= $url_img; ?>/assets/img/avatars/8.jpg" alt="user@email.com"></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pt-0" style="">
                            <div class="dropdown-header bg-body-tertiary text-body-secondary fw-semibold my-2">
                                <div class="fw-semibold">Account</div>
                            </div><a class="dropdown-item" href="#">
                                <svg class="icon me-2">
                                    <use xlink:href="<?= $url_img; ?>/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                </svg> Profile</a><a class="dropdown-item" href="#">
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                                    <svg class="icon me-2">
                                        <use xlink:href="<?= $url_img; ?>/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                    </svg> Lock Account</a><a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">
                                    <svg class="icon me-2">
                                        <use xlink:href="<?= $url_img; ?>/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                                    </svg> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <?php echo $content; ?>
            </div>
        </div>
    </div>

    <?= load_js() ?>
</body>

</html>
<!-- Layout wrapper -->
<div class="layout-wrapper">

    <!-- Header -->
    <div class="header d-print-none">
        <div class="header-container">
            <div class="header-left">
                <div class="navigation-toggler">
                    <a href="#" data-action="navigation-toggler">
                        <i data-feather="menu"></i>
                    </a>
                </div>

                <div class="header-logo">
                    <a href="<?= $site_link ?>index.php">
                        <p class="h6" style="color:white"><?= $site_name; ?></p>
                    </a>
                </div>
            </div>

            <div class="header-body">
                <div class="header-body-left">
                    <ul class="navbar-nav">
                        <li class="nav-item mr-3">
                            <div class="header-search-form">
                                <form>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn header-search-close-btn">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- <li class="nav-item dropdown d-none d-md-block">
                                <a href="#" class="nav-link" title="Apps" data-toggle="dropdown">Apps</a>
                                <div class="dropdown-menu dropdown-menu-big">
                                    <div class="border-bottom px-4 py-3 text-center d-flex justify-content-between">
                                        <h5 class="mb-0">Apps</h5>
                                    </div>
                                    <div class="p-3">
                                        <div class="row row-xs">
                                            <div class="col-6">
                                                <a href="chat.html">
                                                    <div class="border-radius-1 text-center mb-3">
                                                        <figure class="avatar avatar-lg border-0">
                                                            <span class="avatar-title bg-primary text-white rounded-circle">
                                                                <i class="width-30 height-30" data-feather="message-circle"></i>
                                                            </span>
                                                        </figure>
                                                        <div class="mt-2">Chat</div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="mail.html">
                                                    <div class="border-radius-1 text-center mb-3">
                                                        <figure class="avatar avatar-lg border-0">
                                                            <span class="avatar-title bg-secondary text-white rounded-circle">
                                                                <i class="width-30 height-30" data-feather="mail"></i>
                                                            </span>
                                                        </figure>
                                                        <div class="mt-2">Mail</div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="todo-list.html">
                                                    <div class="border-radius-1 text-center">
                                                        <figure class="avatar avatar-lg border-0">
                                                            <span class="avatar-title bg-info text-white rounded-circle">
                                                                <i class="width-30 height-30" data-feather="check-circle"></i>
                                                            </span>
                                                        </figure>
                                                        <div class="mt-2">Todo List</div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="file-manager.html">
                                                    <div class="border-radius-1 text-center">
                                                        <figure class="avatar avatar-lg border-0">
                                                            <span class="avatar-title bg-warning text-white rounded-circle">
                                                                <i class="width-30 height-30" data-feather="file"></i>
                                                            </span>
                                                        </figure>
                                                        <div class="mt-2">File Manager</div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Actions" data-toggle="dropdown">Oluştur</a>
                            <div class="dropdown-menu">
                                <a href="newClient.php" class="dropdown-item">Yeni Müşteri</a>
                                <a href="newOffer.php" class="dropdown-item">Yeni Teklif</a>
                                <a href="newItem.php" class="dropdown-item">Yeni Ürün Fiyatı</a>
                                <!-- <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Reports</a>
                                    <a href="#" class="dropdown-item">Customers</a> -->
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="header-body-right">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                <i data-feather="search"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown d-none d-md-block">
                            <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                <i class="maximize" data-feather="maximize"></i>
                                <i class="minimize" data-feather="minimize"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">

                                <span class="ml-2 d-sm-inline d-none"><?= $_SESSION['user'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                <div class="text-center py-4">
                                    <h5 class="text-center"><?= $_SESSION['user'] ?></h5>
                                    <div class="mb-3 small text-center text-muted">
                                        <?php
                                        if ($_SESSION['role'] == 1) {
                                            echo "Kullancı";
                                        } else {
                                            echo "Admin";
                                        }
                                        ?>
                                    </div>
                                    <a href="users.php<?php echo $_SESSION['role'] == 1 ? '?url='.$_SESSION['admin_id'] : NULL ?>" class="btn btn-outline-light btn-rounded">
                                        <?php
                                        if ($_SESSION['role'] == 1) {
                                            echo "Hesabımı Yönet";
                                        } else {
                                            echo "Hesapları Yönet";
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="list-group">
                                    <a href="logout.php" class="list-group-item text-danger">Çıkış Yap</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item header-toggler">
                    <a href="#" class="nav-link">
                        <i data-feather="arrow-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ./ Header -->
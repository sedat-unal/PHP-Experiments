<?php
include("inc/head.php");
include("inc/sidebar.php");
?>

<body class="scrollable-layout">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Yükleniyor...</span>
    </div>
    <!-- ./ Preloader -->

    <?php include("inc/menu.php"); ?>
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Kullanıcılar</h3>
                    <nav aria-label="breadcrumb" class="d-flex align-items-start">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href=index.php>Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="#">Kullanıcılar</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- <div class="mt-2 mt-md-0">
                    <div class="dropdown">
                        <a href="#" class="btn btn-success dropdown-toggle" title="Filter" data-toggle="dropdown">Filtrele</a>
                        <div class="dropdown-menu dropdown-menu-big p-4 dropdown-menu-right">
                            <form>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control">
                                        <option value="">Select</option>
                                        <option value="">User</option>
                                        <option value="">Staff</option>
                                        <option value="">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control">
                                        <option value="">Select</option>
                                        <option value="">Active</option>
                                        <option value="">Blocked</option>
                                        <option value="">Admin</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary">Get Results</button>
                                <button class="btn btn-link ml-2">Save Filter</button>
                            </form>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php
            if ($_SESSION['role'] == 0 && !isset($_GET['url'])) {
            ?>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>İsim</th>
                                                <th>Kullanıcı Adı</th>
                                                <th>Email</th>
                                                <th>Rol</th>
                                                <th>Durum</th>
                                                <th class="text-right">İŞLEM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $getUser = $conn->prepare("SELECT * FROM admins ORDER BY admin_id ASC");
                                            $getUser->execute();

                                            while ($row = $getUser->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['admin_id'] ?></td>
                                                    <td>
                                                        <a href="#">
                                                            <?= $row['admin_name'] ?>
                                                        </a>
                                                    </td>
                                                    <td><?= $row['admin_kadi'] ?></td>
                                                    <td><?= $row['admin_user'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['admin_role'] == 1) {
                                                            echo "Kullanıcı";
                                                        } else {
                                                            echo "Admin";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['admin_status'] == 0) {
                                                            echo "<span class='badge bg-success-bright text-success'>Aktif</span>";
                                                        } else {
                                                            echo "<span class='badge bg-success-bright text-danger'>Pasif</span>";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                                                <i class="ti-more-alt"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="users.php?url=<?= $row['admin_id']; ?>" class="dropdown-item">Düzenle</a>
                                                                <?php
                                                                if ($row['admin_status'] == 0) {
                                                                    echo "<a href='' class='dropdown-item text-danger'>Pasif Yap</a>";
                                                                } else {
                                                                    echo "<a href='' class='dropdown-item text-success'>Aktif Et</a>";
                                                                }

                                                                ?>
                                                                <hr>
                                                                <a href="#" class="dropdown-item text-danger">Kullanıcıyı Sil</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($_SESSION['role'] == 1 || isset($_GET['url'])) {

                $getData = $conn->prepare("SELECT * FROM admins WHERE admin_id = :id");
                $getData->execute([":id" => $_GET["url"]]);
                if ($getData->rowCount() < 1) {
                    echo "<div class='alert alert-danger'>Herhangi bir veri bulunamadı. Lütfen tekrar deneyin.. <a href=javascript:history.back(-1)>Geri Don</a></div>";
                }
                $dRow = $getData->fetch(PDO::FETCH_ASSOC);
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav nav-pills flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-item nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profil Bilgileri</a>
                                    <a class="nav-item nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Şifre İşlemleri</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Profilim</h6>
                                                <?php
                                                if (isset($_POST['profile'])) {
                                                    $adminName = $_POST['adminName'];
                                                    $kullaniciAdi = $_POST['kullaniciAdi'];
                                                    $adminEmail = $_POST['adminEmail'];
                                                    $role = $_POST['role'];
                                                    $status = $_POST['status'];

                                                    $guncelle = $conn->prepare("UPDATE admins SET
                                                        admin_name = :admin_name,
                                                        admin_user = :admin_user,
                                                        admin_kadi = :admin_kadi,
                                                        admin_role = :admin_role,
                                                        admin_status = :admin_status
                                                        WHERE admin_id = :id");
                                                    $guncelle->execute(array(
                                                        ":admin_name" => $adminName,
                                                        ":admin_user" => $adminEmail,
                                                        ":admin_kadi" => $kullaniciAdi,
                                                        ":admin_role" => $role,
                                                        ":admin_status" => $status,
                                                        ":id" => $_GET['url']
                                                    ));
                                                    if ($guncelle) {
                                                        echo "<div class='alert alert-success'>Güncelleme işlemi başarılı.. Yönlendiriliyorsunuz..</div>";
                                                        header("Refresh:3; url=users.php");
                                                    }
                                                }
                                                ?>
                                                <form method="POST">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="profile" value="1">
                                                            <div class="form-group">
                                                                <label>İsim</label>
                                                                <input type="text" class="form-control" name="adminName" value="<?= $dRow['admin_name']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kullanıcı Adı</label>
                                                                <input type="text" class="form-control" name="kullaniciAdi" value="<?= $dRow['admin_kadi'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="adminEmail" value="<?= $dRow['admin_user'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Rol</label>
                                                                <select class="form-control" name="role">
                                                                    <?php
                                                                    if ($dRow['admin_role'] == 1) {
                                                                        echo "
                                                                    <option selected value='1'>Kullanıcı</option>
                                                                    <option value='0'>Admin</option>
                                                                    ";
                                                                    } else {
                                                                        echo "
                                                                    <option selected value='0'>Admin</option>
                                                                    <option value='1'>Kullanıcı</option>
                                                                    ";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Durum</label>
                                                                <select class="form-control" name="status">
                                                                    <?php
                                                                    if ($dRow['admin_status'] == 0) {
                                                                        echo "
                                                                    <option selected value='0'>Aktif</option>
                                                                    <option value='-1'>Pasif</option>
                                                                    ";
                                                                    } else {
                                                                        echo "
                                                                    <option selected value='-1'>Pasif</option>
                                                                    <option value='0'>Aktif</option>
                                                                    ";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary" type="submit">Kaydet</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title">Şifre Değiştir</h6>
                                                <?php 
                                                if(isset($_POST['pass'])){
                                                    $oldPass  = $_POST['oldPass'];
                                                    $newPass  = $_POST['newPass'];
                                                    $newPass2 = $_POST['newPass2'];

                                                    if($dRow['admin_pass'] == $oldPass){
                                                        if($newPass == $newPass2){

                                                            $uptPass = $conn->prepare("UPDATE admins SET 
                                                                admin_pass = :admin_pass WHERE admin_id = :id");
                                                            $uptPass->execute(array(
                                                                ":admin_pass" => $newPass,
                                                                ":id" => $_GET['url']
                                                            ));
                                                            if($uptPass){
                                                                echo '<div class="alert alert-success">Yeni şifreniz başarıyla değiştirildi. Yönlendiriliyorsunuz..</div>';
                                                                header("Refresh:3; url=users.php");
                                                            }

                                                        }else{
                                                            echo '<div class="alert alert-danger">Yeni şifreniz birbiri ile aynı değil.</div>';
                                                        }
                                                    }else{
                                                        echo '<div class="alert alert-danger">Eski şifreniz doğru değil</div>';
                                                    }
                                                }
                                                ?>
                                                <form method="POST">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="pass" value="2">
                                                            <div class="form-group">
                                                                <label>Şimdiki Şifre</label>
                                                                <input type="password" class="form-control" name="oldPass">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Yeni Şifre</label>
                                                                <input type="password" class="form-control" name="newPass">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Yeni Şifre Tekrar</label>
                                                                <input type="password" class="form-control" name="newPass2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

        </div>
        <!-- ./ Content -->

        <!-- Footer -->
        <footer class="content-footer">
            <div>© 2020 Gogi - <a href="http://laborasyon.com" target="_blank">Laborasyon</a></div>
            <div>
                <nav class="nav">
                    <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                    <a href="#" class="nav-link">Change Log</a>
                    <a href="#" class="nav-link">Get Help</a>
                </nav>
            </div>
        </footer>
        <!-- ./ Footer -->
    </div>
    <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
    </div>
    <!-- ./ Layout wrapper -->

    <!-- Main scripts -->
    <script src="./vendors/bundle.js"></script>

    <!-- Datatable -->
    <script src="./vendors/dataTable/datatables.min.js"></script>

    <script src="./assets/js/examples/pages/user-list.js"></script>

    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
</body>

</html>
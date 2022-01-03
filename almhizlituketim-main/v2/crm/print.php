<?php
include "inc/head.php";
include "inc/sidebar.php";
include "inc/menu.php";

$id = $_GET["id"];
if (!$id) {
    header("location:clients.php");
}

?>
<!-- Content body -->
<div class="content-body" onloadeddata="window.print()">
    <!-- Content -->
    <div class="content ">

        <div class="page-header">
            <div>
                <h3>Müşteri Güncelle</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $site_link ?>index.php">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= $site_link ?>bilgiGuncelle.php">Müşteri Güncelle</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Müşteri Bilgileri</h6>
                                <?php
                                $getVeri = $conn->prepare("SELECT * FROM clients WHERE client_id = :id");
                                $getVeri->execute([":id" => $id]);
                                $vRow = $getVeri->fetch(PDO::FETCH_ASSOC);

                                if ($_POST) {
                                    $firmaAdi           = $_POST['firmaAdi'];
                                    $yetkiliKisi        = $_POST['yetkiliKisi'];
                                    $yetkiliEposta      = $_POST['yetkiliEposta'];
                                    $yetkiliTelefon     = $_POST['yetkiliTelefon'];
                                    $hedefUrun          = $_POST['hedefUrun'];
                                    $sektor             = $_POST['sektor'];
                                    $firmaCity          = $_POST['firmaCity'];
                                    $acikAdres          = $_POST['acikAdres'];
                                    $postCode           = $_POST['postCode'];
                                    $vkn                = $_POST['vkn'];
                                    $status             = $_POST['status'];

                                    $update = $conn->prepare("UPDATE clients SET
                                        client_firm     = :firmaAdi,
                                        client_person   = :yetkiliKisi,
                                        client_email    = :yetkiliEposta,
                                        client_phone    = :yetkiliTelefon,
                                        client_status   = :durum,
                                        client_groups   = :hedefUrun,
                                        client_sektor   = :sektor,
                                        client_city     = :firmaCity,
                                        client_adres    = :acikAdres,
                                        client_postCode = :postCode,
                                        client_vkn      = :vkn WHERE client_id = :id");
                                    $veri = $update->execute(array(
                                        "firmaAdi"          => $firmaAdi,
                                        "yetkiliKisi"       => $yetkiliKisi,
                                        "yetkiliEposta"     => $yetkiliEposta,
                                        "yetkiliTelefon"    => $yetkiliTelefon,
                                        "durum"             => $status,
                                        "hedefUrun"         => $hedefUrun,
                                        "sektor"            => $sektor,
                                        "firmaCity"         => $firmaCity,
                                        "acikAdres"         => $acikAdres,
                                        "postCode"          => $postCode,
                                        "vkn"               => $vkn,
                                        "id"                => $id
                                    ));

                                    if ($veri) {
                                        echo '
                                        <div class="alert alert-success d-flex align-items-center" role="alert">
                                            <i class="ti-check mr-2"></i> Kayıt Başarılı. Yönlendiriliyorsunuz..
                                        </div>';
                                        header("refresh:2;url=clients.php");
                                    } else {
                                        echo '
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="ti-check mr-2"></i> Kayıt Başarısız. Lütfen Tekrar Deneyiniz..
                                        </div>';
                                    }
                                }

                                ?>
                                <form class="needs-validation" method="POST" novalidate="">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom01">Firma Adı</label>
                                            <input type="text" name="firmaAdi" class="form-control" id="validationCustom01" value="<?= $vRow['client_firm'] ?>" required="">
                                            <div class="valid-feedback">
                                                Onaylandı
                                            </div>
                                            <div class="invalid-feedback">
                                                Lütfen Firma Adı Giriniz
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom02">*Yetkili Kişi</label>
                                            <input type="text" name="yetkiliKisi" class="form-control" id="validationCustom02" value="<?= $vRow['client_person'] ?>" required="">
                                            <div class="valid-feedback">
                                                Onaylandı
                                            </div>
                                            <div class="invalid-feedback">
                                                Lütfen Yetkili Kişi Bilgisi Giriniz
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustomUsername">Yetkili e-Posta</label>
                                            <div class="input-group">
                                                <input type="text" name="yetkiliEposta" class="form-control" id="validationCustomUsername" value="<?= $vRow['client_email'] ?>" aria-describedby="inputGroupPrepend">

                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Yetkili Telefon Numarası</label>
                                            <input type="number" name="yetkiliTelefon" class="form-control" id="validationCustom03" value="<?= $vRow['client_phone'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Lütfen Telefon Bilgisi Giriniz.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Hedef Ürün Grubu</label>
                                            <input type="text" name="hedefUrun" class="form-control" id="validationCustom04" value="<?= $vRow['client_groups'] ?>" required="">
                                            <div class="invalid-feedback">
                                                Lütfen Hedef Ürün Grubu Belirtiniz.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Firma Sektörü</label>
                                            <input type="text" name="sektor" class="form-control" id="validationCustom05" value="<?= $vRow['client_sektor'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Firma İli / İlçesi</label>
                                            <input type="text" name="firmaCity" class="form-control" id="validationCustom04" value="<?= $vRow['client_city'] ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Firma Açık Adresi</label>
                                            <br>
                                            <textarea type="text" name="acikAdres" class="form-control" id="validationCustom05"><?= $vRow['client_adres'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Firma Posta Kodu</label>
                                            <input type="text" name="postCode" class="form-control" id="validationCustom04" value="<?= $vRow['client_postCode'] ?>">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Firma VKN</label>
                                            <input type="text" name="vkn" class="form-control" id="validationCustom05" value="<?= $vRow['client_vkn'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="exampleFormControlSelect1">Müşteri Durumu</label>
                                            <select name="status" class="form-control" id="exampleFormControlSelect1">
                                                <option <?php echo $vRow["client_status"] == 1 ? "selected" : null;  ?> value="1">Aktif</option>
                                                <option <?php echo $vRow["client_status"] == 0 ? "selected" : null;  ?> value="0">Pasif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Kaydet</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <!-- Footer -->
    <?php include "inc/footer.php"; ?>
    <!-- ./ Footer -->
</div>
<!-- ./ Content body -->
</div>
<!-- ./ Content wrapper -->
</div>
<!-- ./ Layout wrapper -->

<!-- Main scripts -->
<script src="./vendors/bundle.js"></script>

<!-- Form validation example -->
<script src="./assets/js/examples/form-validation.js"></script>

<!-- Prism -->
<script src="./vendors/prism/prism.js"></script>

<!-- App scripts -->
<script src="./assets/js/app.min.js"></script>
</body>

</html>
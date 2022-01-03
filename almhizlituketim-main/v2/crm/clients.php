<?php
include "inc/head.php";
include "inc/sidebar.php";
?>

<body class="scrollable-layout">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Yükleniyor...</span>
    </div>
    <!-- ./ Preloader -->
    <?php include "inc/menu.php"; ?>


    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Müşteri Listesi</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= $site_link ?>index.php">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="<?= $site_link ?>clients.php">Müşteriler</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='newClient.php'">Yeni Müşteri Ekle</button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="clientTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Firma Adı</th>
                                        <th>Sorumlu Kişi</th>
                                        <th>E-Posta Adresi</th>
                                        <th>Telefon No</th>
                                        <th>Durum</th>
                                        <th>Hedef Ürün Grubu</th>
                                        <th>Oluşturulma Tarihi</th>
                                        <th>Firma Sektörü</th>
                                        <th>İl / İlçe</th>
                                        <th>Açık Adres</th>
                                        <th>Posta Kodu</th>
                                        <th>Vergi Kimlik No</th>
                                        <th>Bilgileri Düzenle</th>
                                        <th>Yazdır</th>
                                        <th>Sil</th>
                                    </tr>
                                </thead>
                            </table>
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
    <!--  -->
    <!-- Modal 1 Ret -->
    <div class="modal fade" id="musteriSil" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal1Label">Müşteri Siliniyor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır, Silme</button>
                    <button type="button" class="btn btn-primary" id='remove_onay' data-dismiss="modal">Evet, Müşteriyi Sil</button>
                    <button type="button" class="btn btn-warning" id='hepsini_sil' data-dismiss="modal">Evet, Tamamen Sil</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Main scripts -->
    <script src="./vendors/bundle.js"></script>

    <!-- Prism -->
    <script src="./vendors/prism/prism.js"></script>
    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
    <!-- DataTable -->
    <script src="./vendors/dataTable/datatables.min.js"></script>


    <script>
        $(document).ready(function() {

            $('#clientTable').DataTable({
                responsive: true,
                'searching': true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "data/getClient.php",
                    "dataType": "jsonp",
                },
                // "ajax": "data/getClient.php",
                dom: 'lBfrtip',
                "buttons": [
                    'excel',
                    {
                        extend: 'print',
                        title: 'Toplu Müşteri Listesi',
                        messageTop: 'ALM Hızlı Tüketim CRM | İstek üzerine hazırlanmıştır.',
                    },
                    'pdf'
                ],
                order : [[3, "ASC"]],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Hepsi"]
                ],
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json',
                }
            });
        });
    </script>

    <script>
        function printExternal(url) {
            var printWindow = window.open(url, 'Print', 'left=200, top=100, width=950, height=500, toolbar=0, resizable=0');
            printWindow.addEventListener('load', function() {
                printWindow.print();
            }, true);
        }

        function delete_person(id) {

            $('#musteriSil').modal();
            document.getElementById("remove_onay").onclick = function() {

                const form = {
                    islem: 1,
                    id: id
                }

                $.ajax({
                    'async': false,
                    url: '<?= $site_link . "data/operations.php" ?>',
                    type: 'POST',
                    dataType: 'html',
                    data: form,
                    success: function(msg) {

                        $('#clientTable').DataTable().ajax.reload();
                    }
                });
            }

            document.getElementById("hepsini_sil").onclick = function() {

                const form = {
                    islem: 3,
                    id: id
                }

                $.ajax({
                    'async': false,
                    url: '<?= $site_link . "data/operations.php" ?>',
                    type: 'POST',
                    dataType: 'html',
                    data: form,
                    success: function(msg) {

                        $('#clientTable').DataTable().ajax.reload();
                    }
                });
            }

            $('#clientTable').DataTable().ajax.reload();
        };
    </script>

</body>

</html>
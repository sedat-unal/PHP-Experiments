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
                    <h3>Teklif Ürünleri</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= $site_link ?>index.php">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="<?= $site_link ?>offerItems.php">Ürünler</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='newOfferItems.php'">Yeni Ürün Ekle</button>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <table id="clientTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ürün Adı</th>
                                        <th>Bilgileri Düzenle</th>
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
    <div class="modal fade" id="urunSil" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal1Label">Ürün Siliniyor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır, Silme</button>
                    <button type="button" class="btn btn-primary" id='remove_onay' data-dismiss="modal">Evet, Ürünü Sil</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
                    "url": "data/getOfferItems.php",
                    "dataType": "jsonp",
                },
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
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Hepsi"]
                ],
                "language": {
                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json',
                }
            });
        });

        function urunSil(id) {

            $('#urunSil').modal();
            document.getElementById("remove_onay").onclick = function() {

                const form = {
                    islem: 5,
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
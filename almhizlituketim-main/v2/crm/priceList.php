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

                    <h3>Fiyat Listesi</h3>

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="<?= $site_link ?>index.php">Anasayfa</a>

                            </li>

                            <li class="breadcrumb-item active" aria-current="page">

                                <a href="<?= $site_link ?>offers.php">Fiyat Listesi</a>

                            </li>

                        </ol>

                    </nav>

                </div>

            </div>



            <div class="row">

                <div class="col-md-12">



                    <div class="col-md-4">

                        <button type="button" class="btn btn-secondary" onclick="window.location.href='newItem.php'">Yeni Ürün Ekle</button>

                    </div>

                    <div class="card">

                        <div class="card-body">

                            <table id="priceList" class="table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>ÜRÜN ADI</th>

                                        <th>AÇIKLAMA</th>

                                        <th>İÇERİK</th>

                                        <th>MİNİMUM SİPARİŞ</th>

                                        <th>BİRİM FİYAT</th>

                                        <th>DÜZENLE</th>

                                        <th>SİL</th>

                                    </tr>

                                </thead>

                                <tfoot>

                                    <tr>

                                        <th>ÜRÜN ADI</th>

                                        <th>AÇIKLAMA</th>

                                        <th>İÇERİK</th>

                                        <th>MİNİMUM SİPARİŞ</th>

                                        <th>BİRİM FİYAT</th>

                                        <th>DÜZENLE</th>

                                        <th>SİL</th>

                                    </tr>

                                </tfoot>

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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Main scripts -->

    <script src="./vendors/bundle.js"></script>

    <!-- DataTable -->

    <script src="./vendors/dataTable/datatables.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#priceList').DataTable({

                "responsive": true,

                "processing": true,

                "serverSide": true,

                "ajax": {

                    "url": "data/getpriceList.php",

                    "dataType": "jsonp"

                },

                // "ajax": "./data/getOffer.php",

                dom: 'lBfrtip',

                "buttons": [
                    {
                        extend: 'excel',
                        exportOptions: {
                            orthogonal: 'sort'
                        },
                        customizeData: function(data) {
                            for (var i = 0; i < data.body.length; i++) {
                                for (var j = 0; j < data.body[i].length; j++) {
                                    data.body[i][j] = '\u200C' + data.body[i][j];
                                }
                            }
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        title: 'ALM Hızlı Tüketim | Güncel Fiyat Listesi',
                        orientation: 'landscape',
                        pageSize: 'FOLIO',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4],
                        },
                    }
                ],

                lengthMenu: [

                    [10, 25, 50, -1],

                    [10, 25, 50, "Hepsi"]

                ],

                language: {

                    url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json'

                }

            });

        });
    </script>

    <script>
        function delete_price(id) {

            const form = {
                islem: 4,
                id: id
            }

            $.ajax({

                'async': false,

                url: './data/operations.php',

                type: 'POST',

                dataType: 'html',

                data: form,

                success: function(msg) {

                    $('#priceList').DataTable().ajax.reload();

                }

            });

            $('#priceList').DataTable().ajax.reload();

        };
    </script>



    <!-- Prism -->

    <script src="./vendors/prism/prism.js"></script>

    <!-- App scripts -->

    <script src="./assets/js/app.min.js"></script>

</body>



</html>
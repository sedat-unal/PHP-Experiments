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

                    <h3>Teklif Listesi</h3>

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="<?= $site_link ?>index.php">Anasayfa</a>

                            </li>

                            <li class="breadcrumb-item active" aria-current="page">

                                <a href="<?= $site_link ?>offers.php">Teklifler</a>

                            </li>

                        </ol>

                    </nav>

                </div>

            </div>



            <div class="row">

                <div class="col-md-12">



                    <div class="col-md-4">

                        <button type="button" class="btn btn-secondary" onclick="window.location.href='newOffer.php'">Yeni Teklif Ekle</button>

                    </div>

                    <div class="card">

                        <div class="card-body">

                            <table id="example1" class="table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>Firma Adı</th>

                                        <th>Teklifin Konusu</th>

                                        <th>Teklifin Son Tarihi</th>

                                        <th>İletişim</th>

                                        <th>Durum</th>

                                        <th>Gönder</th>

                                        <th>Teklifi Görüntüle</th>

                                        <th>Yazdır</th>

                                        <th>Sil</th>

                                    </tr>

                                </thead>

                                <tfoot>

                                    <tr>

                                        <th>Firma Adı</th>

                                        <th>Teklifin Konusu</th>

                                        <th>Teklifin Son Tarihi</th>

                                        <th>İletişim</th>

                                        <th>Durum</th>

                                        <th>Gönder</th>

                                        <th>Teklifi Görüntüle</th>

                                        <th>Yazdır</th>

                                        <th>Sil</th>

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



    <div class="modal fade slide-up disable-scroll" id="form_gonder" tabindex="-1" role="dialog" aria-hidden="false">

        <div class="modal-dialog ">

            <div class="modal-content-wrapper">

                <div class="modal-content">

                    <div class="modal-header clearfix text-left">

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>

                        </button>

                        <h5><span class="semi-bold">Form Gönder</span></h5>

                    </div>

                    <div class="modal-body" style="margin-left:30%">

                        <label>

                            <h5> Mail </h5>

                            <input type="checkbox" id="mail" data-init-plugin="switchery" data-size="small" checked="checked" />

                        </label>

                        &emsp;

                        <label>

                            <h5> Whatsapp </h5>

                            <a href='#' id="annewp" target='_blank'> &emsp; <i class='fa fa-whatsapp' style='font-size:18px;color:green'></i> </a>

                        </label>

                        <br><br>

                    </div>

                    <div class="modal-footer">

                        <button type="button" id="form_gonder_onay" class="btn btn-primary btn-cons  pull-left inline" data-dismiss="modal">Gönder</button>

                        <button type="button" class="btn btn-default btn-cons no-margin pull-left inline" data-dismiss="modal">İptal</button>

                    </div>

                </div>

            </div>

            <!-- /.modal-content -->

        </div>

    </div>







    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Main scripts -->

    <script src="./vendors/bundle.js"></script>

    <script>

        function form_gonder(ClientID) {

            $('#form_gonder').modal();

            var encodedclid = btoa(ClientID);

            var ClientPhone;



            form = {

                clientid: ClientID

            }

            $.ajax({

                'async': false,

                url: 'data/return_tel.php',

                type: 'POST',

                dataType: 'html',

                data: form,

                success: function(msg) {

                    ClientPhone = msg;

                }

            });



            document.getElementById("annewp").href = 'https://wa.me/90' + ClientPhone + '?text= Merhaba, size özel hazırladığımız teklifimiz linkte mevcuttur. Teklifi görmek için lütfen linke tıklayınız. => <?php echo $site_link ?>client_viewOffer.php?id=' + encodedclid;



            var Text = ' Merhaba, size özel hazırladığımız teklifimiz linkte mevcuttur. Teklifi görmek için lütfen linke tıklayınız. => <?= $site_link ?>client_viewOffer.php?id=' + encodedclid;





            document.getElementById("form_gonder_onay").onclick = function() {

                mesaj_mail_send(ClientID, ClientPhone, Text);

            }

        }





        function mesaj_mail_send(ClientID, ClientPhone, Text) {



            var mail = document.getElementById("mail").checked;



            var clientid = ClientID;

            var mail = "";

            const frm = {

                clientid: ClientID

            }

            $.ajax({

                'async': false,

                url: 'data/return_mail.php',

                type: 'POST',

                dataType: 'html',

                data: frm,

                success: function(msg) {



                    mail = msg.toString();

                }



            });

            const form = {

                alici: mail,

                mesaj: Text



            }



            $.ajax({

                url: 'data/send_mail.php',

                type: 'POST',

                data: form,

                success: function(msg, status, jqXHR) {



                    console.log(msg);

                }

            });

        }

    </script>

    <!-- DataTable -->

    <script src="./vendors/dataTable/datatables.min.js"></script>

    <script>

        $(document).ready(function() {

            $('#example1').DataTable({

                "responsive": true,

                "processing": true,

                "serverSide": true,

                "ajax": {

                    "url": "data/getOffer.php",

                    "dataType": "jsonp"

                },

                // "ajax": "./data/getOffer.php",

                dom: 'lBfrtip',

                buttons: [

                    'excel',

                    {

                        extend: 'print',

                        title: 'Toplu Müşteri Listesi',

                        messageTop: 'ALM Hızlı Tüketim CRM | İstek üzerine hazırlanmıştır.',

                    },

                    'pdf'

                ],

                order : [[5, "ASC"]],

                lengthMenu: [

                    [10, 25, 50, -1],

                    [10, 25, 50, "Hepsi"]

                ],

                language: {

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

            const form = {

                islem: 2,

                id: id

            }



            $.ajax({

                'async': false,

                url: './data/operations.php',

                type: 'POST',

                dataType: 'html',

                data: form,

                success: function(msg) {

                    $('#example1').DataTable().ajax.reload();

                }

            });

            $('#example1').DataTable().ajax.reload();

        };

    </script>



    <!-- Prism -->

    <script src="./vendors/prism/prism.js"></script>

    <!-- App scripts -->

    <script src="./assets/js/app.min.js"></script>

</body>



</html>
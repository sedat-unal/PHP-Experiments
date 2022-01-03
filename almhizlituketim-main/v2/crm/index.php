<?php
include "inc/head.php";
if ($_SESSION['login'] == false) {
    header("Location:login.php");
}
include "inc/sidebar.php"; ?>

<body class="scrollable-layout">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Yükleniyor...</span>
    </div>
    <!-- ./ Preloader -->

    <?php
    include "inc/menu.php";
    ?>



    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">
            <div class="page-header d-md-flex justify-content-between">
                <div>
                    <h3>Tekrar Hoşgeldin, <?= $_SESSION['user'] ?></h3>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="card-title mb-2">Aylık Teklif Durumu</h6>
                                <div class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-floating">
                                        <i class="ti-reload"></i>
                                    </a>
                                    <div class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-more-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <canvas id="chartjs_one"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Kayıtlı Müşteriler</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <div class="avatar">
                                                <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                                                    <i class="ti-user"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold ml-1 font-size-30 ml-3"><?php echo say("clients"); ?></div>
                                    </div>
                                    <p class="mb-0"><a href="clients.php" class="link-1">Kaydedilen müşteriler</a> sayfasına gitmek için tıklatın.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Oluşturulan Teklifler</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <div class="avatar">
                                                <span class="avatar-title bg-info-bright text-info rounded-pill">
                                                    <i class="ti-pencil-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold ml-1 font-size-30 ml-3"><?php echo say("offers"); ?></div>
                                    </div>
                                    <p class="mb-0"><a class="link-1" href="offers.php">Oluşturulan teklifler</a> sayfasına gitmek için tıklatın.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Reddedilen Teklifler</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <div class="avatar">
                                                <span class="avatar-title bg-secondary-bright text-secondary rounded-pill">
                                                    <i class="ti-close"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold ml-1 font-size-30 ml-3"><?php echo say("offers", "offer_status", "1") ?></div>
                                    </div>
                                    <p class="mb-0"><a class="link-1" href="offers.php">Reddedilen teklifleri</a> görmek için tıklatın.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Kabul Edilen Teklifler</h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <div class="avatar">
                                                <span class="avatar-title bg-warning-bright text-warning rounded-pill">
                                                    <i class="ti-check"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold ml-1 font-size-30 ml-3"><?php echo say("offers", "offer_status", "2") ?></div>
                                    </div>
                                    <p class="mb-0"><a class="link-1" href="offers.php">Kabul edilen</a> teklifleri görmek için tıklatın.<p>
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

    <!-- Chartjs -->
    <script src="./vendors/charts/chartjs/chart.min.js"></script>
    <script>
        $(document).ready(function() {

            var colors = {
                primary: $('.colors .bg-primary').css('background-color'),
                primaryLight: $('.colors .bg-primary-bright').css('background-color'),
                secondary: $('.colors .bg-secondary').css('background-color'),
                secondaryLight: $('.colors .bg-secondary-bright').css('background-color'),
                info: $('.colors .bg-info').css('background-color'),
                infoLight: $('.colors .bg-info-bright').css('background-color'),
                success: $('.colors .bg-success').css('background-color'),
                successLight: $('.colors .bg-success-bright').css('background-color'),
                danger: $('.colors .bg-danger').css('background-color'),
                dangerLight: $('.colors .bg-danger-bright').css('background-color'),
                warning: $('.colors .bg-warning').css('background-color'),
                warningLight: $('.colors .bg-warning-bright').css('background-color'),
            };

            chartjs_one();

            function chartjs_one() {
                var element = document.getElementById("chartjs_one");
                element.width = 300;
                new Chart(element, {
                    type: 'bar',
                    data: {
                        labels: ["Ağustos","Eylül", "Ekim"],
                        datasets: [{
                            label: "Oluşturulan Teklif",
                            backgroundColor: [
                                colors.primary,
                                colors.secondary,
                                colors.success,
                                colors.warning,
                                colors.info
                            ],
                            data: 
                            [0,
                                <?php
                                    $run = $conn->prepare("SELECT * FROM offers WHERE MONTH(offer_created) = 8");
                                    $run->execute();
                                    echo $run->rowCount();
                                ?>, 
                                <?php
                                    $run = $conn->prepare("SELECT * FROM offers WHERE MONTH(offer_created) = 9");
                                    $run->execute();
                                    echo $run->rowCount();
                                ?>
                            ]
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Aylık Gönderilen Teklif Durumu'
                        }
                    }
                });
            }
        });
    </script>
    <div class="colors">
        <!-- To use theme colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-bright"></div>
        <div class="bg-secondary"></div>
        <div class="bg-secondary-bright"></div>
        <div class="bg-info"></div>
        <div class="bg-info-bright"></div>
        <div class="bg-success"></div>
        <div class="bg-success-bright"></div>
        <div class="bg-danger"></div>
        <div class="bg-danger-bright"></div>
        <div class="bg-warning"></div>
        <div class="bg-warning-bright"></div>
    </div>

    <!-- Daterangepicker -->
    <script src="./vendors/datepicker/daterangepicker.js"></script>

    <!-- DataTable -->
    <script src="./vendors/dataTable/datatables.min.js"></script>

    <!-- Dashboard scripts -->
    <script src="./assets/js/examples/pages/dashboard.js"></script>

    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>

</body>

</html>
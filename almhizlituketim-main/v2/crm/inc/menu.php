<?php include("functions.php"); ?>

<!-- Content wrapper -->

<div class="content-wrapper">

    <!-- begin::navigation -->

    <div class="navigation">

        <div class="navigation-header">

            <span>Menü</span>

            <a href="#">

                <i class="ti-close"></i>

            </a>

        </div>

        <div class="navigation-menu-body">

            <ul>

                <li>

                    <a href=index.php>

                        <span class="nav-link-icon">

                            <i data-feather="pie-chart"></i>

                        </span>

                        <span>Anasayfa</span>

                    </a>

                </li>

                <li>

                    <a href="priceList.php">

                        <span class="nav-link-icon">

                            <i data-feather="file-plus"></i>

                        </span>

                        <span>Fiyat Listesi</span>

                    </a>

                </li>

                <li>

                    <a href="#">

                        <span class="nav-link-icon">

                            <i data-feather="user"></i>

                        </span>
                        
                        <span>Müşteriler</span>
                    </a>
                    <ul>
                        <li>
                            <a href="clients.php">Müşteriler <span class="badge badge-warning"><?php echo say("clients") ?></span></a>
                        </li>
                        <li>
                            <a href="newClient.php">Yeni Müşteri Ekle</a>
                        </li>
                    </ul>

                    

                </li>
                <li>

                    <a href="#">

                        <span class="nav-link-icon">

                            <i data-feather="check-square"></i>

                        </span>
                        
                        <span>Teklifler</span>
                    </a>
                    <ul>
                        <li>
                            <a href="offers.php">Teklifler <span class="badge badge-warning"><?php echo say("offers") ?></span></a>
                        </li>
                        <li>
                            <a href="newOffer.php">Yeni Teklif Ekle</a>
                        </li>
                    </ul>

                </li>
                <?php 
                if($_SESSION["role"] == 0){
                    echo '
                    <li>
                        <a href="#">

                            <span class="nav-link-icon">

                                <i data-feather="tool"></i>

                            </span>
                            
                            <span>Ayarlar</span>
                        </a>
                        <ul>
                            <li>
                                <a href="#">Teklif Ürünleri</a>
                                <ul>
                                    <li>
                                        <a href="offerItems.php">Ürünler</a>
                                    </li>
                                    <li>
                                        <a href="newOfferItems.php">Yeni Ürün Ekle</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>';
                }
                
                ?>

            </ul>

        </div>

    </div>

    <!-- end::navigation -->
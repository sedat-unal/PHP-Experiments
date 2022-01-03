<?php include "inc/header.php"; ?>

    <!-- Page Content -->
    <div class="container">
    <?php
    $url = $_GET["product"];
    if($url == NULL)
    {
      echo "Something went wrong. You are being redirected..";
      header("location:index.php");
    }
    switch ($url) {
      case "hygiene":
        ?>
          <!-- Page Heading/Breadcrumbs -->
          <h1 class="mt-5 mb-3">
            Antibacterial
            <small>Group</small>
          </h1>

          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Antibacterial Group</li>
          </ol>
          <div class="row">
            <?php 
            $getHygieneItems = $conn->query("SELECT * FROM hygiene_group",PDO::FETCH_ASSOC);
            if($getHygieneItems->rowCount())
            {
              foreach($getHygieneItems as $hygieneItems)
              {
                ?>
               <div class="col-lg-6 portfolio-item">
                  <div class="card h-100">
                    <?=
                    $hygieneItems["hygiene_href"] == "#" ||
                    $hygieneItems["hygiene_href"] == NULL ||
                    empty($hygieneItems["hygiene_href"]) ? "" :
                    "<a href='productDetails.php?product=" . $hygieneItems["hygiene_href"] ."'>";
                    
                    $id = $hygieneItems["hygiene_id"];
                    $getProductSlider = $conn->query("SELECT * FROM hygiene_group_images WHERE hygiene_group_images_root_id = $id");
                    if($getProductSlider->rowCount())
                    {
                      $i = 0;
                      ?>
                      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"  <?=$i == 0 ? 'class="active"' : ""?>></li>
                          </ol>
                          <div class="carousel-inner">
                      <?php
                      foreach($getProductSlider as $productSliderItem)
                      {
                        ?>
                          
                            <div class="carousel-item <?=$i == 0 ? "active" : ""?>">
                              <img class="d-block w-100" src="../images/hygiene/slider/<?=$productSliderItem["hygiene_group_images_src"]?>" alt="First slide">
                            </div>
                            
                            <?php
                          ++$i;
                        }
                        ?>
                        </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                      <img class="card-img-top" src="../images/hygiene/<?=$hygieneItems["hygiene_img"]?>" alt="<?=$hygieneItems["hygiene_title"]?>">

                      <?php
                    }                    
                    ?>
                    </a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="
                        <?=
                        $hygieneItems["hygiene_href"] == "#" ||
                        $hygieneItems["hygiene_href"] == NULL ||
                        empty($hygieneItems["hygiene_href"]) ? "#" :
                        "productDetails.php?product=" .$hygieneItems["hygiene_href"].""?>">
                        <?=$hygieneItems["hygiene_title_en"]?></a>
                      </h4>
                      <p class="card-text"><?=$hygieneItems["hygiene_text_en"]?></p>
                    </div>
                    <?=
                    $hygieneItems["hygiene_href"] == "#" ||
                    $hygieneItems["hygiene_href"] == NULL ||
                    empty($hygieneItems["hygiene_href"]) ? "" :
                    "
                    <div class='card-footer'>
                      <a href='productDetails.php?product= " .$hygieneItems["hygiene_href"] ."' class='btn btn-primary'>
                        Details
                      </a>
                    </div>
                    ";
                    ?>
                  </div>
                </div>
                <?php
              }
            }
            ?>

          </div>
        <?php 
        break;
            
      case "food":
        ?>
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-5 mb-3">
          Food
          <small>Group</small>
        </h1>

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Home</a>
          </li>
          <li class="breadcrumb-item active">Food Group</li>
        </ol>
        <div class="row">
          <?php 
          $getFoodItems = $conn->query("SELECT * FROM food_group",PDO::FETCH_ASSOC);
          if($getFoodItems->rowCount())
          {
            foreach($getFoodItems as $foodItems)
            {
              ?>
             <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                  <?=
                  $foodItems["food_href"] == "#" ||
                  $foodItems["food_href"] == NULL ||
                  empty($foodItems["food_href"]) ? "" :
                  "<a href='productDetails.php?product=" . $foodItems["food_href"] ."'>";
                  $id = $foodItems["food_id"];
                  $getProductSlider = $conn->query("SELECT * FROM food_group_images WHERE food_group_images_id = $id");
                  if($getProductSlider->rowCount())
                  {
                    $i = 0;
                    ?>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"  <?=$i == 0 ? 'class="active"' : ""?>></li>
                        </ol>
                        <div class="carousel-inner">
                    <?php
                    foreach($getProductSlider as $productSliderItem)
                    {
                      ?>
                        
                          <div class="carousel-item <?=$i == 0 ? "active" : ""?>">
                            <img class="d-block w-100" src="../images/food/slider/<?=$productSliderItem["food_group_images_src"]?>" alt="First slide">
                          </div>
                          
                          <?php
                        ++$i;
                      }
                      ?>
                      </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    <?php
                  }
                  else
                  {
                    ?>
                    <img class="card-img-top" src="../images/food/<?=$foodItems["food_img"]?>" alt="<?=$foodItems["food_title"]?>">

                    <?php
                  }                 
                  ?>
                  </a>
                  
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="
                      <?=
                       $foodItems["food_href"] == "#" ||
                       $foodItems["food_href"] == NULL ||
                       empty($foodItems["food_href"]) ? "#" :
                       "productDetails.php?product=".$foodItems["food_href"] .""?>">
                         <?=$foodItems["food_title_en"]?>
                      </a>  
                    </h4>
                    <p class="card-text"><?=$foodItems["food_text_en"]?></p>
                  </div>
                  <?=
                  $foodItems["food_href"] == "#" ||
                  $foodItems["food_href"] == NULL ||
                  empty($foodItems["food_href"]) ? "" :
                  "
                  <div class='card-footer'>
                    <a href='productDetails.php?product=" . $foodItems["food_href"] . "' class='btn btn-primary'>
                      Details
                    </a>
                  </div>
                  "
                  ?>
                </div>
              </div>
              <?php
            }
          }
          ?>

        </div>
        <?php 
        break;
      case "printing":
        ?>
        <div class="container">
          <h1 class="mt-5 mb-3">Flexo Printing <small>Group</small>
          </h1>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Flexo Printing Group</li>
          </ol>
          <img class="img-fluid rounded mb-4" src="../images/flekso-print.png" alt="ALM Baskı Grubu">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="card h-100 bg-success">
                <h4 class="card-header">Ultraviolet Flexo Print</h4>
                <div class="card-body">
                  <p class="card-text" style="color:black;font-weight:500;">Continuous printing from coil to coil in the desired weight and quantity without color limit.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="card h-100 bg-warning">
                <h4 class="card-header">Offset</h4>
                <div class="card-body">
                  <p class="card-text" style="color:black;font-weight:500;">We can print your magazines, brochures, business cards in the size you want, in the number of colors you want.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="card h-100 bg-info">
                <h4 class="card-header">Digital Print</h4>
                <div class="card-body">
                  <p class="card-text" style="color:black;font-weight:500;">We put a design in a computer environment directly into print. And with no color limit.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        break;

      case "paper-packaking":
        ?>
          <!-- Page Heading/Breadcrumbs -->
          <h1 class="mt-5 mb-3">
            Paper Packaking
            <small>Group</small>
          </h1>

          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Paper Packaking Group</li>
          </ol>
          <div class="row">
            <?php 
            $getPaperItems = $conn->query("SELECT * FROM paper_packaking_group",PDO::FETCH_ASSOC);
            if($getPaperItems->rowCount())
            {
              foreach($getPaperItems as $paperItems)
              {
                ?>
               <div class="col-lg-6 portfolio-item">
                  <div class="card h-100">
                    <?=
                    $paperItems["paper_packaking_group_href"] == "#" ||
                    $paperItems["paper_packaking_group_href"] == NULL ||
                    empty($paperItems["paper_packaking_group_href"]) ? "" :
                    "<a href='productDetails.php?product=" . $paperItems["paper_packaking_group_href"] ."'>";
                    $id = $paperItems["paper_packaking_group_id"];
                    $getProductSlider = $conn->query("SELECT * FROM paper_packaking_group_images WHERE paper_packaking_group_images_id = $id");
                    if($getProductSlider->rowCount())
                    {
                      $i = 0;
                      ?>
                      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"  <?=$i == 0 ? 'class="active"' : ""?>></li>
                          </ol>
                          <div class="carousel-inner">
                      <?php
                      foreach($getProductSlider as $productSliderItem)
                      {
                        ?>
                          
                            <div class="carousel-item <?=$i == 0 ? "active" : ""?>">
                              <img class="d-block w-100" src="../images/paper/slider/<?=$productSliderItem["paper_packaking_group_images_src"]?>" alt="First slide">
                            </div>
                            
                            <?php
                          ++$i;
                        }
                        ?>
                        </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      <?php
                    }
                    else
                    {
                      ?>
                      <img class="card-img-top" src="../images/paper/<?=$paperItems["paper_packaking_group_img"]?>" alt="<?=$paperItems["paper_packaking_group_title"]?>">

                      <?php
                    }                    
                    ?>
                    </a>
                    <div class="card-body">
                    <h4 class="card-title">
                          <a href="
                          <?=
                          $paperItems["paper_packaking_group_href"] == "#" ||
                          empty($paperItems["paper_packaking_group_href"]) ||
                          $paperItems["paper_packaking_group_href"] == NULL ? "#" : 
                          "productDetails.php?product=".$paperItems["paper_packaking_group_href"]?>"><?=$paperItems["paper_packaking_group_title_en"]?></a>
                        </h4>
                      <p class="card-text"><?=$paperItems["paper_packaking_group_text_en"]?></p>
                    </div>
                      <?=
                        $paperItems["paper_packaking_group_href"] == "#" ||
                        empty($paperItems["paper_packaking_group_href"]) ||
                        $paperItems["paper_packaking_group_href"] == NULL ? "" :
                        "
                        <div class='card-footer'>
                          <a href='productDetails.php?product=".$paperItems["paper_packaking_group_href"] ."' class='btn btn-primary'>
                            Details
                          </a>
                        </div>
                        " 
                      ?>
                  </div>
                </div>
                <?php
              }
            }
            ?>

          </div>
        <?php 
        break;
      case "advertisement":
          ?>
            <!-- Page Heading/Breadcrumbs -->
            <h1 class="mt-5 mb-3">
              Advertising Brochure and Magnet
              <small>Group</small>
            </h1>
  
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Anasayfa</a>
              </li>
              <li class="breadcrumb-item active">Advertising Brochure and Magnet Group</li>
            </ol>
            <div class="row">
              <?php 
              $getAdvirtesementItems = $conn->query("SELECT * FROM advirtisement_group",PDO::FETCH_ASSOC);
              if($getAdvirtesementItems->rowCount())
              {
                foreach($getAdvirtesementItems as $advirtesementItems)
                {
                  ?>
                 <div class="col-lg-6 portfolio-item">
                    <div class="card h-100">
                      <?=
                        $advirtesementItems["advirtisement_href"] == '#' ||
                        $advirtesementItems["advirtisement_href"] == NULL ||
                        empty($advirtesementItems["advirtisement_href"]) ? "" :
                        "<a href='productDetails.php?product=" . $advirtesementItems["advirtisement_href"] . "'>"
                      
                      ?>
                      
                      <?php 
                      $id = $advirtesementItems["advirtisement_id"];
                      $getProductSlider = $conn->query("SELECT * FROM advirtisement_group_images WHERE advirtisement_group_images_id = $id");
                      if($getProductSlider->rowCount())
                      {
                        $i = 0;
                        ?>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>"  <?=$i == 0 ? 'class="active"' : ""?>></li>
                            </ol>
                            <div class="carousel-inner">
                        <?php
                        foreach($getProductSlider as $productSliderItem)
                        {
                          ?>
                            
                              <div class="carousel-item <?=$i == 0 ? "active" : ""?>">
                                <img class="d-block w-100" src="../images/paper/slider/<?=$productSliderItem["advirtisement_group_images_src"]?>" alt="First slide">
                              </div>
                              
                              <?php
                            ++$i;
                        }
                        ?>
                          </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        <?php
                      }
                      else
                      {
                        ?>
                        <img class="card-img-top" src="../images/advirtesement/<?=$advirtesementItems["advirtisement_img"]?>" alt="<?=$advirtesementItems["advirtisement_title_en"]?>">
  
                        <?php
                      }                    
                      ?>
                      </a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="
                          <?=
                          $advirtesementItems["advirtisement_href"] == "#" ||
                          empty($advirtesementItems["advirtisement_href"]) ||
                          $advirtesementItems["advirtisement_href"] == NULL ? "#" : 
                          "productDetails.php?product=".$advirtesementItems["advirtisement_href"]?>"><?=$advirtesementItems["advirtisement_title_en"]?></a>
                        </h4>
                        <p class="card-text"><?=$advirtesementItems["advirtisement_text_en"]?></p>
                      </div>
                      <?=
                      $advirtesementItems["advirtisement_href"] == "#" ||
                      empty($advirtesementItems["advirtisement_href"]) ||
                      $advirtesementItems["advirtisement_href"] == NULL ? "" :
                      "<div class='card-footer'>
                          <a href='productDetails.php?product=" . $advirtesementItems["advirtisement_href"] . "' class='btn btn-primary'>
                            Details
                          </a>
                        </div>
                      "                      
                      ?>
                    </div>
                  </div>
                  <?php
                }
              }
              ?>
  
            </div>
          <?php
        break;

      case "carrier-bag":
            ?>
              <!-- Page Heading/Breadcrumbs -->
              <h1 class="mt-5 mb-3">
                Nylon Bag
                <small>Group</small>
              </h1>
    
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Nylon Bag Group</li>
              </ol>
              <div class="row">
                <?php 
                $getCarrierBagGroup = $conn->query("SELECT * FROM carrier_bag_group",PDO::FETCH_ASSOC);
                if($getCarrierBagGroup->rowCount())
                {
                  foreach($getCarrierBagGroup as $carrierBagItems)
                  {
                    ?>
                   <div class="col-lg-6 portfolio-item">
                      <div class="card h-100">
                      <?= $carrierBagItems["carrier_bag_group_href"] == "#" || 
                          empty($carrierBagItems["carrier_bag_group_href"]) || 
                          $carrierBagItems["carrier_bag_group_href"] == NULL ? "" :
                          "<a href='productDetails.php?product=". $carrierBagItems["carrier_bag_group_href"] ."'>"
                      ?>
                          <img class="card-img-top" src="../images/carrier-bag/<?=$carrierBagItems["carrier_bag_group_img"]?>" alt="<?=$carrierBagItems["carrier_bag_group_title_en"]?>">
                        </a>
                        <div class="card-body">
                          <h4 class="card-title">
                            <a href="
                              <?= $carrierBagItems["carrier_bag_group_href"] == "#" || 
                                  empty($carrierBagItems["carrier_bag_group_href"]) || 
                                  $carrierBagItems["carrier_bag_group_href"] == NULL ? "#" : "productDetails.php?product=".$carrierBagItems["carrier_bag_group_href"]
                                  ?>"><?=$carrierBagItems["carrier_bag_group_title_en"]?>
                            </a>
                          </h4>
                          <p class="card-text"><?=$carrierBagItems["carrier_bag_group_text_en"]?></p>
                        </div>
                          <?= $carrierBagItems["carrier_bag_group_href"] == "#" || 
                              empty($carrierBagItems["carrier_bag_group_href"]) || 
                              $carrierBagItems["carrier_bag_group_href"] == NULL ? "" :
                              " <div class='card-footer'>
                                  <a href='productDetails.php?product=".$carrierBagItems['carrier_bag_group_href']."' class='btn btn-primary'>
                                    Details
                                  </a>
                                </div>
                              "
                          ?>
                         
                      </div>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
            <?php
            break;
    }
    ?>  
    </div>
    <!-- /.container -->
<?php include "inc/footer.php"; ?>
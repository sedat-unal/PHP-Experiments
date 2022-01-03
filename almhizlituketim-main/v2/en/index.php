<?php 
include "inc/header.php"; ?>
  <header>
      
      <div class="super_container">
        <div class="home">
          <div class="home_slider_container">
            <div class="owl-carousel owl-theme home_slider">
            <?php 
            $getSlider = $conn->query("SELECT * FROM slider WHERE slider_status = 1",PDO::FETCH_ASSOC);
            if($getSlider->rowCount()) 
            {
              foreach($getSlider as $sliderItem)
              {
                ?>
                <div class="owl-item">
                  <div class="home_slider_background" style="background-image:url(images/slider/<?=$sliderItem["slider_picture_en"]?>)"></div>
                    <div class="home_slider_content_container">
                      <div class="container">
                        <div class="row">
                          <div class="col">
                            <div class="home_slider_content">
                              <div class="home_slider_item_title">
                                <a href="<?=$sliderItem["slider_href_en"]?>" class="carosel_baslik"><?=$sliderItem["slider_title_en"]?></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <?php
              }
            }
            ?>
            </div>
          </div>
        </div>	
      </div>
        
  </header>

    <div class="content">

        <div class="container">
            <h1 class="text-center">Product Categories</h1>
        </div>

        <div class="site-section bg-left-half mb-5">
            <div class="container owl-2-style">
                <h2 class="text-primary py-5 "></h2>
                <div class="owl-carousel owl-2">  
                  <?php 
                  $getProduct = $conn->query("SELECT * FROM product_slider WHERE product_slider_status = 1", PDO::FETCH_ASSOC);
                  if($getProduct->rowCount())
                  {
                    foreach($getProduct as $productItem)
                    {
                      ?>
                      <div class="media-29101">
                          <a href="<?=$productItem["product_slider_href_en"]?>"><img src="../images/product-slider/<?=$productItem["product_slider_img_en"]?>" alt="<?=$productItem["product_slider_title_en"]?>" class="img-fluid"></a>
                          <h3><a href="<?=$productItem["product_slider_href_en"]?>"><?=$productItem["product_slider_title_en"]?></a></h3>
                      </div>
                      <?php
                    }
                  }
                  
                  
                  ?>
                  
                    
                </div>
            </div>
        </div>
    </div>

<?php 
include "inc/footer.php";
?>
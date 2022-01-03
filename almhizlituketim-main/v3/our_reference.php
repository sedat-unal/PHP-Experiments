<?php include "inc/header.php"; ?>

    <!-- Page Content -->
   <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-5 mb-3">İş Ortaklarımız</h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Anasayfa</a>
        </li>
        <li class="breadcrumb-item active">Referanslarımız</li>
      </ol>

      <div class="row">
      <?php 
         $getReference = $conn->query("SELECT * FROM refferences WHERE refference_status = 1", PDO::FETCH_ASSOC);
         if($getReference->rowCount())
         {
            foreach($getReference as $referenceItem)
            {
               ?>
               <div class="col-lg-3 portfolio-item">
                  <div class="logo">
                     <img class="resim" src="images/refference/<?=$referenceItem["refference_img"]?>" alt="<?=$referenceItem["refference_title"]?>">  
                  </div>
               </div>

               <?php
            }
         }   
      ?>
      </div>
        

   </div>
    <!-- /.container -->

   <?php include "inc/footer.php"; ?>
<?php include "inc/header.php"; ?>

<!-- Page Content -->
<div class="container">

  <!-- Page Heading/Breadcrumbs -->
  <h1 class="mt-5 mb-3">Who is Almila Packaking ?</h1>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.html">Home</a>
    </li>
    <li class="breadcrumb-item active">About Us</li>
  </ol>

  <?php 
  $getAbout = $conn->query("SELECT * FROM about_us", PDO::FETCH_ASSOC);
  if($getAbout->rowCount() < 1) {
    echo "Something went wrong. You are bein redirected";
    header("location:index.php");
  }
  foreach($getAbout as $aboutItem)
  {
    ?>
    <!-- Intro Content -->
    <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="images/logo.png" alt="">
        </div>
        <div class="col-lg-6">
          <p><?=$aboutItem["about_paragraph_en"]?></p>
          <h6>Our Mission</h6>
          <p><?=$aboutItem["about_mission_en"]?></p>
          <h6>Our Vision</h6>
          <p><?=$aboutItem["about_vision_en"]?></p>
        </div>
    </div>
    <?php
  }
  
  $getAboutDocs = $conn->query("SELECT about_doc1,about_doc2,about_doc3 FROM about_us WHERE about_doc1 IS NOT NULL or about_doc2 IS NOT NULL or about_doc3 IS NOT NULL");
  if($getAboutDocs->rowCount())
  {
  ?>
  

  <h2>Our Official Documents</h2>
  <div class="row">
    <?php 
   
      foreach($getAboutDocs as $aboutDocsItem)
      {
        ?>
        <div class="col-lg-2 col-sm-4 mb-4">
          <a href="files/<?=$aboutDocsItem["about_doc1"]?>" download="<?=$aboutDocsItem["about_doc1_title"]?>">
            <img class="img-fluid" src="files/<?=$aboutDocsItem["about_doc1_img"]?>" alt="<?=$aboutDocsItem["about_doc1_title"]?>">
          </a>
        </div>
        <?php
      }
    ?>
  </div>
  <?php
  }
  ?>

</div>
<?php include "inc/footer.php"; ?>
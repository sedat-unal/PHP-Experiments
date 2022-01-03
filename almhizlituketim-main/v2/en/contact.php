<?php include "inc/header.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-5 mb-3">Contact
        <small>Us</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Contact Us</li>
      </ol>

      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d376.22850262603663!2d29.049482716195584!3d41.02901834855152!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac81e54f63a81%3A0x6ba93df07f55dcad!2sAlmila+Islak+Mendil!5e0!3m2!1str!2str!4v1540320086364"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Contact Details</h3>
          <address>
            Burhaniye District<br>
            Gulerce Street No:22<br>
            Uskudar / Istanbul
          </address>
          <a href="tel:+902163210319"><abbr>P </abbr>: +90 216 321 0319</a>
          <br>
          <a href="mailto:info@almhizlituketim.com"><abbr>@ </abbr>: info@almhizlituketim.com</a>
          <p>
            Monday - Friday: 8:30am/06:00pm<br>Saturday: 8:30pm/03:00am
          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Send a Message</h3>
          <form name="sentMessage" id="contactForm" novalidate>
            <div class="control-group form-group">
              <div class="controls">
                <label>Name - Surname:</label>
                <input type="text" class="form-control" id="name" required data-validation-required-message="Please type your name.">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Contact Number:</label>
                <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please type your number.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <input type="email" class="form-control" id="email" required data-validation-required-message="Please type your email address.">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please type your message." maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
          </form>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
<?php include "inc/footer.php"; ?>

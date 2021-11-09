<?php
?>
<!--header-->
<header id="site-header" class="fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark stroke">
            <h1>
                <a class="navbar-brand" href="<?=$site_href ?>">
                    <img src="assets/images/logo.png" width="50px" height="50px">
                    ALMİLA AMBALAJ
                </a>
            </h1>
            <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-lg-auto">
                    <span class="sr-only">(current)</span>
                    <?php
                    $nav = $db->query("SELECT * FROM navbar WHERE nav_parent = 0");
                    if($nav->rowCount())
                    {
                        foreach ($nav as $navRow)
                        {
                            echo '
                            <li class="nav-item">
                                <a class="nav-link" href="'. $navRow['nav_href'] .'">' . $navRow['nav_title'] . '</a>
                            </li>';
                        }
                    }

                    ?>
                    <!--
                    <li class="top-quote ml-lg-4 mt-lg-0 mt-3">
                        <a href="contact.html" class="btn btn-style btn-primary">Get a Quote</a>
                    </li>
                    -->
                </ul>
            </div>
            <!-- toggle switch for light and dark theme -->

            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container py-1">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>
            <!-- //toggle switch for light and dark theme -->
        </nav>
    </div>
</header>
<!--/header-->

@include('layouts.header')
<body>
    <!-- READING POSITION INDICATOR -->
    <progress value="0" id="eskimo-progress-bar">
        <span class="eskimo-progress-container">
            <span class="eskimo-progress-bar"></span>
        </span>
    </progress>
    <!-- SITE WRAPPER -->
    <div id="eskimo-site-wrapper">
        <!-- MAIN CONTAINER -->
        <main id="eskimo-main-container">
            <div class="container">
                <!-- SIDEBAR -->
                <div id="eskimo-sidebar">
                    <div id="eskimo-sidebar-wrapper" class="d-flex align-items-start flex-column h-100 w-100">
                        <!-- LOGO -->
                        <div id="eskimo-logo-cell" class="w-100">
                            <a class="eskimo-logo-link" href="index-2.html">
                                <img src="assets/images/logo.png" class="eskimo-logo" alt="eskimo" />
                            </a>
                        </div>
                        <!-- MENU CONTAINER -->
                        @yield('menu')
                        <!-- SOCIAL MEDIA ICONS -->
                        @yield('socialMedia')
                    </div>
                </div>
                <!-- TOP ICONS -->
                <ul class="eskimo-top-icons">
                    <li id="eskimo-panel-icon">
                        <a href="#eskimo-panel" class="eskimo-panel-open"><i class="fa fa-bars"></i></a>
                    </li>
                    <li id="eskimo-search-icon">
                        <a id="eskimo-open-search" href="#"><i class="fa fa-search"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
                <!-- SLIDER -->
                <div class="eskimo-carousel-container eskimo-bg-loader">
                    <div id="eskimo-post-slider" class="eskimo-slider">
                        @yield('slider')
                    </div>
                </div>
                <!-- BLOG POSTS -->
                @yield('texts')
                <!-- VIEW ALL BUTTON -->
                <div class="eskimo-view-more">
                    <a class="btn btn-default" href="blog.html">VIEW ALL POSTS</a>
                </div>
                
                <!-- DIVIDER -->
                <hr class="section-divider" />

                <!-- CAROUSEL -->
                <div class="eskimo-widget-title">
                    <h3 class="eskimo-carousel-title"><span>POPULAR POSTS</span></h3>
                </div>

                <div class="eskimo-carousel-container">
                    <div class="eskimo-carousel-view-more">
                        <a href="blog.html">VIEW ALL</a>
                    </div>

                    <div id="eskimo-post-carousel" class="eskimo-carousel">
                        <!-- CAROUSEL ITEM 1 -->
                        @yield('popularTexts')
                        
                    </div>
                </div>
            </div>
        </main>
        <!-- FOOTER -->
        <footer id="eskimo-footer">
            <div class="container">
                <div class="row eskimo-footer-wrapper">
                    <!-- FOOTER WIDGET 1 -->
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <h5 class="eskimo-title-with-border"><span>About Me</span></h5>
                        <p>Trusted by thousands of customers, my unique themes and plugins help you make beautiful responsive web sites with ease.</p>
                        <p><a href="about.html" class="btn btn-default">Read More</a></p>
                    </div>
                    <!-- FOOTER WIDGET 2 -->
                    <div class="col-12 col-lg-6">
                        <h5 class="eskimo-title-with-border"><span>Newsletter</span></h5>
                        <form method="post" action="http://www.eskimo.egemenerd.com/html/index.html">
                            <label>Subscribe to our mailing list!</label>
                            <div class="input-group">
                                <input type="email" class="form-control" name="EMAIL" placeholder="Your email address" required />
                                <div class="input-group-append"> 
                                    <input type="submit" value="Sign up"  class="btn btn-default" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CREDITS -->
                <div class="eskimo-footer-credits">
                    <p>
                        Made with love by <a href="https://themeforest.net/user/egemenerd" target="_blank">Egemenerd</a>
                    </p>
                </div>
            </div>
        </footer>
    </div>
    <!-- GO TO TOP BUTTON -->
    <a id="eskimo-gototop" href="#"><i class="fa fa-chevron-up"></i></a>
    <!-- SLIDE PANEL OVERLAY -->
    <div id="eskimo-overlay"></div>
    <!-- SLIDE PANEL -->
    <div id="eskimo-panels">
        <aside id="eskimo-panel" class="eskimo-panel">
            <div class="eskimo-panel-inner">
                <!-- CLOSE SLIDE PANEL BUTTON -->
                <a href="#" class="eskimo-panel-close"><i class="fa fa-times"></i></a>
                <!-- AUTHOR BOX -->
                <div class="eskimo-author-box eskimo-widget">
                    <div class="eskimo-author-img">
                        <img src="assets/images/img.jpg" alt="JOHN DOE" />
                    </div>
                    <h3><span>JOHN DOE</span></h3>
                    <p class="eskimo-author-subtitle">WEB DESIGNER &amp; DEVELOPER</p>
                    <p class="eskimo-author-description">I'm a Web Developer and Designer with a strong passion for UX/UI design. I have experience building websites, web applications, and brand assets. Contact me if you have any questions!</p>
                    <div class="eskimo-author-box-btn">
                        <a class="btn btn-default" href="about.html">CONTACT ME</a>
                    </div>
                </div>
                <!-- RECENT POSTS -->
                <div class="eskimo-recent-entries eskimo-widget">
                    <h5 class="eskimo-title-with-border"><span>Recent Posts</span></h5>
                    <ul>
                        <li>
                            <a href="#">Ketchup Flavored Ice Cream!</a>
                            <span class="post-date">May 28, 2018</span>
                        </li>
                        <li>
                            <a href="#">Hair You've Always Dreamed Of</a>
                            <span class="post-date">May 27, 2018</span>
                        </li>
                        <li>
                            <a href="#">15 Of The World's Best Carnivals</a>
                            <span class="post-date">May 25, 2018</span>
                        </li>
                        <li>
                            <a href="#">5 Ways to a Healthy Lifestyle</a>
                            <span class="post-date">May 25, 2018</span>
                        </li>
                        <li>
                            <a href="#">Best Breakfast In The World</a>
                            <span class="post-date">May 23, 2018</span>
                        </li>
                    </ul>
                </div>
                <!-- CATEGORIES -->
                <div class="eskimo-categories eskimo-widget">
                    <h5 class="eskimo-title-with-border"><span>Categories</span></h5>
                    <ul>
                        <li>
                            <a href="#" title="The best restaurants, cafes, bars and shops in town.">Food &amp; Drink</a> <span class="badge badge-pill badge-default">5</span>
                        </li>
                        <li>
                            <a href="#" title="An up-to-date, personal urban guide.">Lifestyle</a> <span class="badge badge-pill badge-default">5</span>
                        </li>
                        <li>
                            <a href="#" title="Latest technology news and updates.">Technology</a> <span class="badge badge-pill badge-default">4</span>
                        </li>
                        <li>
                            <a href="#" title="Travel advice, information and inspiration.">Travel</a> <span class="badge badge-pill badge-default">5</span>
                        </li>
                        <li>
                            <a href="#" title="The latest news about movies and TV shows.">TV &amp; Movies</a> <span class="badge badge-pill badge-default">4</span>
                        </li>
                    </ul>
                </div>
                <!-- TAGS -->
                <div class="eskimo-widget">
                    <h5 class="eskimo-title-with-border"><span>Tags</span></h5>
                    <div class="eskimo-tag-cloud">
                        <a href="#">aute<span>7</span></a>
                        <a href="#">enim<span>7</span></a>
                        <a href="#">commodo<span>7</span></a>
                        <a href="#">voluptatibus<span>7</span></a>
                        <a href="#">culpa<span>7</span></a>
                        <a href="#">offendit<span>7</span></a>
                        <a href="#">magna<span>7</span></a>
                        <a href="#">quorum<span>7</span></a>
                        <a href="#">mandaremus<span>7</span></a>
                        <a href="#">ingeniis<span>7</span></a>
                        <a href="#">tempor<span>7</span></a>
                        <a href="#">summis<span>7</span></a>
                        <a href="#">consequat<span>6</span></a>
                        <a href="#">iudicem<span>6</span></a>
                        <a href="#">expetendis<span>6</span></a>
                        <a href="#">deserunt<span>6</span></a>
                    </div>
                </div>
            </div>
        </aside>
    </div>
    <!-- FULLSCREEN SEARCH -->
    <div id="eskimo-fullscreen-search">
        <div id="eskimo-fullscreen-search-content">
            <a href="#" id="eskimo-close-search"><i class="fa fa-times"></i></a>
            <form role="search" method="get" action="http://www.eskimo.egemenerd.com/html/search.html" class="eskimo-lg-form">
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Enter a keyword..." name="s" />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('layouts.footer')    
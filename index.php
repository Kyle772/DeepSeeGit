<!DOCTYPE html>

<html>

<head>
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png"> 
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>DeepSee.io</title>
    <!-- detect viewport  -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!-- font awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet" type="text/css">

    <!-- js -->
    <script type="text/javascript" src="app/smooth-scroll.js"></script>
    <script type="text/javascript" src="app/app.js"></script>
    <!-- moment -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
</head>

<body>    

    <?php if(isset($_COOKIE['message'])): ?>
        
        <div id="message-popup" class="panel">
            <?php echo $_COOKIE['message']?>
        </div>

        <script>
            $("#message-popup").delay(5000).fadeOut();
        </script>

    <?php setcookie("message","expired",time()-1); endif; ?>

    <div class="frontpage-splash">

        <img src="assets/img/hero-image-sea.jpg" class="frontpage-splash-img"></img>

        <nav class="navbar navbar-default collapse navbar-collapse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">      
                    <a class="navbar-brand" href="/#">
                        <img alt="header-logo" src="assets/img/deepsee-header-logo.png" style="height: 40px; width: 144px"/>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div>

                    <ul class="nav navbar-nav navbar-right social-nav">
                        <li>
                            <a href="https://www.facebook.com/Deepseeio/"><i class="fa fa-lg fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/deepseeio?lang=en"><i class="fa fa-lg fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://medium.com/@deepseeio"><i class="fa fa-lg fa-medium"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UCfEP4kVI-ezfwDInPHk70vg"><i class="fa fa-lg fa-youtube-play"></i></a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right link-nav">
                        <li><a href="/#about">ABOUT</a></li>
                        <li><a href="/#contact">CONTACT</a></li>   
                        <li><a href="assets/pdf/whitepaper.pdf">WHITEPAPER</a></li>   
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>

    <div class="text-center">
        <img id="hero-logo-image" src="assets/img/DeepSee-banner-logo.png" />        

                    
        <div id="countdown">
            <div id="countdown-announcement"> TOKEN <span class="bold">PRE-SALE</span></div>
            <div class="timer">
                <div id="dayElement" class="timer-time"> 00 </div> <span class="timer-title">
                    DAYS
                </span> 
            </div>
            <div class="timer">
                <div id="hourElement" class="timer-time"> 00 </div> <span class="timer-title">
                    HOURS
                </span> 
            </div>
            <div class="timer">
                <div id="minuteElement" class="timer-time"> 00 </div> <span class="timer-title">
                    MINUTES
                </span> 
            </div>
            <div class="timer">
                <div id="secondElement" class="timer-time"> 00 </div> <span class="timer-title">
                    SECONDS
                </span> </div>
            </div>

            <div id="datePrettyElement"> (November 14th, 2017 00:00:01 UTC) </div>

            <div id="signup" class="feature signup">
                <div class="container">
                    <div class="text-center signup-title">Sign up for our newsletter &amp; updates</div>
                    <div class="center-block signup-form">

                        <form method="post" action="mail.php" class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input name="email" class="email" type="email"
                                placeholder="Enter Email"/>
                            </div>
                            <button class="btn btn-success">SIGN UP</button>                                
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>



    <!-- about -->
    <div name="about" id="about" class="feature">

        <h1 class="center-block text-center">What is DeepSee?</h1> 
        <br/>
        <div class="center-block text-center default-text">
            DeepSee is an all-in-one media platform that is revolutionizing content aggregation, distribution, verification, and monetization. DeepSee makes use of artificial intelligence, decentralized communities, and the blockchain to create the most powerful yet flexible platform of it's kind. The goal of DeepSee is the build a global village of the highest value and integrity.
        </div>

        <div class="about-content"> 

            <div>
                <img src="/assets/img/what-is-deepsee.png" alt="What is DeepSee?"
                style="width:100%"/>
            </div>
            <br/>
            <div class="about-content-additional container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <img src="/assets/img/artificial-intelligence.png" 
                        alt="artificial-intelligence"/>
                        <h3>Artificial Intelligence</h3>
                        <p>DeepSee uses machine learning and a variety of
                            neural networks to create powerful search, recommmendations, 
                            and content analysis functionality within the platform.
                            It also uses reinforcement learning to detect bots, growth
                        marketers, and vote manipulators.</p>
                    </div>

                    <div class="col-md-4">
                        <img src="/assets/img/verification.png" 
                        alt="verification"/>
                        <h3>Verification</h3>
                        <p>Users have many different verification options: from completely
                            anonymous to 3rd-party vetting with skill/profession certification.  Users can use their credentials to 
                            maximize their "voice" when it comes to content creation,
                        commenting, and even voting.</p>
                    </div>

                    <div class="col-md-4">
                        <img src="/assets/img/blockchain.png" 
                        alt="blockchain"/>
                        <h3>Blockchain</h3>
                        <p>Several areas of the platform utilize the blockchain's
                            verification model to support decentralized and transparent
                            business practices.  Most importantly: DeepSee's cryptocurrecy
                            <b>CurrentSee</b>.</p>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- currentsee -->
        <div id="currentsee" name="currentsee" class="feature">

            <h1 class="text-center"> What is CurrentSee? </h1>

            <div class="center-block default-text">
                CurrentSee isn't just some junk coin.  It's a digital asset directly backed by services on the platform.  Advertising is a high demand/large volume service that, given the appropriate metrics, can be traded much like a commodity.  The value of CurrentSee is directly tied to the size of the 
                DeepSee community--thus ALL holders of CurrentSee have huge incentives to participate in the community and recruit others to the platform.
            </div>

            <div>
                <img class="currentsee-img center-block" src="/assets/img/ds-infrastructure.png">
            </div>
        </div>

        <div id="timeline" name="timeline" class="feature">
            <h1 class="text-center"> Our TimeLine</h1>

            <img class="timeline-img" src="/assets/img/timeline.png"/>

        </div>

        <!-- team -->    
        <div id="team" name="team" class="feature">
            <h1 class="text-center">Our Team</h1>

            <div class="persons">

                <div class="person">
                    <img src="assets/img/travis-garland.png">
                    <h3>Travis Garland</h3>
                    <h4>Chief Executive Officer</h4>
                    <p>3+ years at machine learning startups, 3+ years growth marketing. 
                        <br/>Prev: Researcher + Growth @PhotoKharma Inc</p>
                    </div>
                    <div class="person">
                        <img src="assets/img/kazi-shezan.png">
                        <h3>Kazi Shezan</h3>
                        <h4>Data Scientist</h4>
                        <p>5+ years Software Development Experience
                            <br/>Prev: Data Scientist @Infolytx @DataRobin</p>
                        </div>
                        <div class="person">
                            <img src="assets/img/travis-wright.png">
                            <h3>Travis Wright</h3>
                            <h4>Chief Marketing Officer</h4>
                            <p>Host @VentureBeat podcast, columnist for @Inc @VentureBeat
                                <br> CMO @CCPDigital Prev: SMO @Norton</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/matt-hrushka.png">
                                <h3>Matt Hrushka</h3>
                                <h4>Chief Technology Officer</h4>
                                <p>Award winning technologist and author of  “The Ad War(2014)”. Back-end developer of the Myspace team and negotiated a 900m deal with the company</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/tom-siebert.png">
                                <h3>Tom Siebert</h3>
                                <h4>Head of Public Relations</h4>
                                <p>10+ years experience as award winning journalist, PR &amp; marcomm specialist, TV's "Shark Week" creator.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/peter-vu.png">
                                <h3>Peter Vu</h3>
                                <h4>UX/UI Architect</h4>
                                <p>4+ years of UI/UX design experience working at AT&amp;T &amp; Tail Light</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/joel-comm.png">
                                <h3>Joel Comm</h3>
                                <h4>Chief Evangelist</h4>
                                <p>NY Times best-selling author, speaker, marketing strategist, technologist, futurist and @BadCrypto co-host</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/adryenn-ashley.png">
                                <h3>Adryenn Ashley</h3>
                                <h4>Chief of Disruption</h4>
                                <p>Award winning actress, author and film makers with a passion for all areas and media formats. Founder of Loly LLC as well as being a successful social influencer with a 100m+ reach. </p>
                            </div>
                            <div class="person">
                                <img src="assets/img/bill-saxton.png">
                                <h3>Bill Saxton</h3>
                                <h4>Full-stack Developer</h4>
                                <p>18+ years of software development and leading teams, working with a multitude of program languages, at Sun Microsystems and Oracle Corporation.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/andrew-bart.png">
                                <h3>Andrew Bart</h3>
                                <h4>Chief Growth Officer</h4>
                                <p>Early growth stage venture capital investor, advisor, and C-Suite executive. Initiated startup team at iCrossing which ultimately exited to Hearst Corporation for $325 million.  Founded, bootstrapped, and successfully exited a supply chain management and lead generation technology platform to a global pet product manufacturer.
                                </div>
                            </div>
                        </div>

                        <div class="text-center feature-title" style="padding-top:20px">Our Advisors</div>
                        <div class="persons">
                            <div class="person">
                                <img src="assets/img/matt-mckibbin.png">
                                <h3>Matt Mckibbin</h3>
                                <h4>Advisor</h4>
                                <p>Decentralization and blockchain entrepreneur. Co-founder of Ubitquity LLC. VP of Business Development at Family Office.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/tony-simonovsky.png">
                                <h3>Tony Simonovsky</h3>
                                <h4>Advisor</h4>
                                <p>Serial entrepreneur and a growth hacker with a focus on ICOs. In 2017 he joined KickICO to help platform increase exposure of its upcoming ICO to crypto-investors around the world by means of growth marketing.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/nick-haase.png">
                                <h3>Nick Haase</h3>
                                <h4>Advisor</h4>
                                <p>Founder and CEO of Loot--a startup paving the way for the future of marketing and co-founder of StartupDrugz.
                                Rich background in consulting, speaking, VR/AR, and medical devices.</p>
                            </div>

                            <div class="person">
                                <img src="assets/img/brent-csutoras.png">
                                <h3>Brent Csutoras</h3>
                                <h4>Advisor</h4>
                                <p>Founder &amp; CEO of Pixel Road Designs.  Managing Partner at Search Engine Journal.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/trent-lapinski.png">
                                <h3>Trent Lapinski</h3>
                                <h4>Advisor</h4>
                                <p>Built and sold various tech companies throughout his twenties.
                                    Experienced technology executive.  Former CEO and startup founder.
                                    Experience in product marketing, product development, business
                                development, and venture capital.</p>
                            </div>
                            <div class="person">
                                <img src="assets/img/greg-kerr.png">
                                <h3>Greg Kerr</h3>
                                <h4>Advisor</h4>
                                <p>Multi-lingual and seasoned Pentagon analyst, advising on
                                    stabilization and de-escalation in conflicts around the world.  Currently creating renewably-fueled, off-the-grid energy grids 
                                    and partnering with USAID in the implementation of green 
                                    energy solutions.
                                </div>
                            </div>
                        </div>

                        <!-- contact -->
                        <div id="contact" name="contact" class="feature"> 
                            <div class="container">
                                <h1 class="text-center feature-title">Contact Us</h1>
                                <form class="center-block" method="post" action="mail.php">
                                    <div class="form-group">
                                        <input name="name" type="text" placeholder="Enter Full Name"/>
                                    </div>
                                    <div class="form-group">
                                        <input name="email" type="email" placeholder="Enter Email"/>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" rows="4" placeholder="Your Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">SEND MESSAGE</button>
                                    </div>
                                </form>
                                <!-- </div> -->
                            </div>
                        </div>

                        <div id="signup2" class="feature signup">
                            <div class="text-center container">
                                <div class="signup-title">Sign up for our newsletter &amp; updates</div>
                                <div class="center-block signup-form">

                                    <form method="post" action="mail.php" class="form-inline">
                                        <div class="form-group">
                                            <input name="email" class="email" type="email"
                                            placeholder="Enter Email"/>
                                        </div>
                                        <button class="btn btn-success">SIGN UP</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <footer>

                                <nav class="navbar navbar-default collapse navbar-collapse">
            <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">      
                <a class="navbar-brand" href="/#">
                    <img alt="header-logo" src="assets/img/deepsee-header-logo.png" style="height: 40px; width: 144px"/>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div>

                <ul class="nav navbar-nav navbar-right social-nav">
                    <li>
                        <a href="https://www.facebook.com/Deepseeio/"><i class="fa fa-lg fa-facebook"></i></a>
                    </li>
                    <li>
                        <a href="https://twitter.com/deepseeio?lang=en"><i class="fa fa-lg fa-twitter"></i></a>
                    </li>
                    <li>
                        <a href="https://medium.com/@deepseeio"><i class="fa fa-lg fa-medium"></i></a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/channel/UCfEP4kVI-ezfwDInPHk70vg"><i class="fa fa-lg fa-youtube-play"></i></a>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right link-nav">
                    <li><a href="/#about">ABOUT</a></li>
                    <li><a href="/#contact">CONTACT</a></li>   
                    <li><a href="assets/pdf/whitepaper.pdf">WHITEPAPER</a></li>   
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
        <div class="copyright text-center">
            &copy; 2017 Deepsee.io. - All Rights Reserved
        </div>


    </footer>    

</body>

</html>
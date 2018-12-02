<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

frontend\assets\LandingAsset::register($this);
$this->title = Yii::$app->name;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta name="Keywords" content="wakili,m-lawyer,michael mutinda,free law system , law management software,file management system,m-lawyer management software">
        <meta name="Description" content="m-lawyer is development company for law management software in Nairobi. Provide Enterprise solution and quality services.">
        <meta property="og:locale" content="en_US" />
        <meta property="og:title" content="M-lawyer - Provide Enterprise Solution | Development on law management system" />
        <meta property="og:description" content="Core functions like file management, contacts management, expense management, client notification" />

        <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/assets/icons/favicon.png" type="image/x-icon" />
       <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
       <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="login-page" style="font-family: 'Montserrat', sans-serif !important">
        <!-- Navigation -->
        <nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" style="font-family: 'Gloria Hallelujah', cursive;" href="#"><?= Yii::$app->name;?></a>
                <i class="text-danger  fa fa-phone"><a href="tel:+254 716630770"> +254 716630770</a></i> 
            </div>
        </nav>

        <!-- Masthead -->
        <header class="masthead text-white text-center">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h1 class="mb-5" style="font-family: 'Montserrat', sans-serif">The most efficient way to manage your law firm!</h1>
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <form>
                            <div class="form-row">

                                <div class="col-12 col-md-12">
                                    <a class="btn btn-block btn-lg btn-success" href="<?=Yii::$app->urlManager->createUrl('auth/login')?>">GET STARTED!</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Icons Grid -->
        <section class="features-icons bg-light text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-globe m-auto text-primary"></i>
                            </div>
                            <h3>Easy Access</h3>
                            <p class="lead mb-0">Securely access client and case information in real-time, from anywhere!</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-call-in m-auto text-primary"></i>
                            </div>
                            <h3>Realtime Support </h3>
                            <p class="lead mb-0">Offers quick response time to ensure your business uptime is 100%</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-check m-auto text-primary"></i>
                            </div>
                            <h3>Easy to Use</h3>
                            <p class="lead mb-0">Reduce clerical errors!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-envelope-open m-auto text-primary"></i>
                            </div>
                            <h3>Easy Communication</h3>
                            <p class="lead mb-0">Send single or bulk email and SMS notifications to your Clients</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-doc m-auto text-primary"></i>
                            </div>
                            <h3>Contract Management </h3>
                            <p class="lead mb-0">Manage your contracts.Add due dates and statuses</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex">
                                <i class="icon-user m-auto text-primary"></i>
                            </div>
                            <h3>Clients</h3>
                            <p class="lead mb-0">Manage clients information such as contacts details,identification etc</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Image Showcases -->
        <section class="showcase">
            <div class="container-fluid p-0">
                <div class="row no-gutters">

                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('css/landing/img/documents.jpg');"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Document Management</h2>
                        <p class="lead mb-0">Upload ,categorize ,manage and download your firms documents</p>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('css/landing/img/tasks.jpg');"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>Tasks Management</h2>
                        <p class="lead mb-0">Share your calender with your colleagues and receive notifications to enable you achieve your targets</p>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('css/landing/img/reports.jpg');"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>Report Generations and Finance Management</h2>
                        <p class="lead mb-0">Get graphical reports on the state of your business and generate financial documents such as Invoices, receipts ,...</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials
        <section class="testimonials text-center bg-light">
          <div class="container">
            <h2 class="mb-5">What people are saying...</h2>
            <div class="row">
              <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                  <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
                  <h5>Margaret E.</h5>
                  <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                  <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
                  <h5>Fred S.</h5>
                  <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                  <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
                  <h5>Sarah	W.</h5>
                  <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                </div>
              </div>
            </div>
          </div>
        </section> -->

        <!-- Call to Action -->
        <section class="call-to-action text-white text-center">
            <!--<div class="overlay"></div>-->
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h2 class="mb-4">SCHEDULE A DEMO</h2>
                    </div>
                    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                        <form id="demo-form" action="<?= Yii::$app->urlManager->createUrl('site/demorequest')?>" method="POST">
                            <div class="form-row">
                                <div class="col-12 col-md-9 mb-2 mb-md-0">
                                    <input id="demoemail" type="email" class="form-control form-control-lg" placeholder="Enter your email...">
                                </div>
                                <div class="col-12 col-md-3">
                                    <button type="submit" class="btn btn-block btn-lg btn-primary">REQUEST!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
                        <ul class="list-inline mb-2">

                            <li class="list-inline-item">
                                <a href="#">Contacts</a>
                            </li>
                            <li class="list-inline-item">&sdot;</li>
                            <li class="list-inline-item">Phone: 0716630770</li>
                            <li class="list-inline-item">&sdot;</li>
                            <li class="list-inline-item">Email : tesstechsolutions@gmail.com</li>

                        </ul>
                        <p class="text-muted small mb-4 mb-lg-0">&copy; <strong>Copyright &copy; <?= date('Y'); ?>  <?= Yii::$app->name; ?>.</strong> All rights
                            reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mr-3">
                                <a href="#">
                                    <i class="fa fa-facebook fa-2x fa-fw"></i>
                                </a>
                            </li>
                            <li class="list-inline-item mr-3">
                                <a href="#">
                                    <i class="fa fa-twitter fa-2x fa-fw"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-instagram fa-2x fa-fw"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <?php $this->beginBody() ?>

        

        <?php
        $sweeturl = Yii::$app->urlManager->createUrl('js/customstuff/sweetstuff.js');
        ?>
        <?php $this->endBody() ?>
        <script src="<?= $sweeturl; ?>"></script>
        <?php $js = "
   $(function(){
    
         var form = $('form#demo-form');
         form.on('submit', function(event) {
         
              event.preventDefault();
              var email = $('#demoemail').val(); 
              
            if(email== undefined || email == ''){
                 swal(
                            'Oops...',
                            'You forgot to enter an email address',
                            'error'
                        );
                        
                        return;
                        
            }

              var form = $(this); 
              console.log(form.attr('action'));
              console.log(email);
            
                swal({
                  title: 'Request for a demo?',                
                  confirmButtonText: 'OK',
                  showLoaderOnConfirm: true,
                  preConfirm: () => {
                    return new Promise((resolve) => {
                  
                          $.ajax({
                            type: 'post',
                            url: form.attr('action')+'?email='+email,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (result) {                   
                                if (result == 'success') {
                                    resolve(true);                        
                                } else {
                                    resolve(false);                       
                                }
                            }
                            ,
                            error: function () {
                                return 'An Error Occured!';
                            }
                        });
                       
                      
                      
                    })
                  },
                  allowOutsideClick: false
                }).then((result) => {
//                    console.log('result');
//                    console.log(result);
//                    console.log(result.value);
                  if (result.value) {
                      form.trigger('reset');

                  swal(
                            {
                                title: 'Sent!',
                                type: 'success',
                                showConfirmButton: false,
                                html:
                                'Your demo request has been successfully sent '
                            }
                        )
                  }else{
                       swal(
                            'Oops...',
                            result,
                            'error'
                        )
                  }
                })
        });
       
    });
    

" ?>
        <?php $this->registerJs($js) ?>

    </body>
</html>
<?php $this->endPage() ?>

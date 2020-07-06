<?php
date_default_timezone_set("America/Sao_Paulo");
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sr. Menu</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="img/favicon.png">	

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,400i,700,900" rel="stylesheet"> 
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/icons/style.css?<?= date('Y-m-d H:i:s'); ?>" rel="stylesheet" type="text/css">

        <!-- Core CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css?<?= date('Y-m-d H:i:s'); ?>">
        <link rel="stylesheet" href="js/slick/slick.css?<?= date('Y-m-d H:i:s'); ?>">

        <!-- Theme CSS -->
        <link href="css/style.css?<?= date('Y-m-d H:i:s'); ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="js/jquery.js"></script>
        <?php include_once("analyticstracking.php") ?>


    </head>
    <body>

        <!-- CODE WRAP -->
        <div class="outer-wrapper" id="top">

            <!-- NAVIGATION -->
            <nav class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- LOGO -->
                        <a class="navbar-brand" href="#top" style="padding: 0;"><img src="img/icone.png" /></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">                            
                            <li><a class="page-scroll"href="#top">Home</a></li>
                            <li><a class="page-scroll" href="#oquefazemos">O que fazemos?</a></li>
                            <li><a class="page-scroll" href="#funcionalidades">Funcionalidades</a></li>
                            <li><a class="page-scroll" href="#diferenciais">Diferenciais</a></li>
                            <li><a class="page-scroll" href="#oferece">Oferece</a></li>
                            <li><a class="page-scroll" href="#precos">Investimento</a></li>                            
                            <li><a class="page-scroll" href="#contato">Contato</a></li>
                            <li><a class="page-scroll" href="web-app/">Login</a></li>
                           
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- NAVIGATION END -->

            <!-- HERO -->
            <div id="top" class="intro7 intro1 overlay jarallax">
                <div class="container">
                    <div class="row center-flex">
                        <div class="col-md-6">
                            <h3 style="text-transform: none"><b>Sr. Menu</b> <br></h3>
                            <p>Unidade de atendimento inteligente: <b>um novo conceito de gerenciamento.</b></p>
                            <div class="clearfix"></div>
                            <div class="gap40"></div>                            
                            <div class="app-btns">
                                <a href="#">
                                    <i class="cu cu-smartphone-1"></i>
                                    Em breve no
                                    <span>App Store</span>
                                </a>
                                <a href="#">
                                    <i class="fa fa-google-plus"></i>
                                    Em breve no
                                    <span>Googleplay</span>
                                </a>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mockup">
                                <div class="screen">
                                    <div class="slider">
                                        <div class="slide" style="background-image:url(img/slider/1.png)"></div>
                                        <div class="slide" style="background-image:url(img/slider/2.png)"></div>
                                        <div class="slide" style="background-image:url(img/slider/3.png)"></div>
                                        <div class="slide" style="background-image:url(img/slider/4.png)"></div>
                                    </div>
                                </div>
                                <img src="img/iphone.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HERO END -->



            <!-- INFO -->
            <div id="oquefazemos" class="info-content info-content2" style="text-align: justify;text-justify: inter-word; background-color: #ededed;">
                <div class="container">
                    <div class="row center-flex">
                        <div class="col-md-6 col-md-push-6">
                            <h2>O que fazemos?</h2>
                            <p><b>Sr. Menu</b> é um sistema que possibilita o gerenciamento automatizado de bares e restaurantes. 
                                Nosso sistema, conta com o suporte de uma equipe qualificada, que visa o crescimento de todos os parceiros. 
                                Através de um cardápio digital, somos a única empresa do mercado que oferece liberdade para os usuários das nossas parceiras, 
                                possibilitando o uso de smartphone ou tablet para realização dos pedidos em geral e pagamentos com um clique, 
                                tornando seu dia muito mais prático e agradável.</p>


                        </div>
                        <div class="col-md-6 col-md-pull-6 embed-responsive embed-responsive-16by9" style="padding-bottom: 311px;" >
                            <iframe class="embed-responsive-item"  width="553" height="311" src="https://www.youtube.com/embed/v18Krvc-6dI?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INFO END -->	

            <!-- APP FEATURES -->
            <div id="funcionalidades" class="app-features border-top border-bottom">
                <div class="container">
                    <div class="row center-flex">
                        <div class="col-md-4">
                            <div class="features-left">
                                <i class="cu cu-dinner"></i>
                                <h4>CARDÁPIO DIGITAL</h4>
                                <p>Menu de fácil manuseio e totalmente digital</p>
                            </div>
                            <div class="features-left">
                                <i class="cu cu-clock2"></i>
                                <h4>GERENCIAMENTO EM TEMPO REAL</h4>
                                <p>O sistema permite a análise e gerenciamento integrado entre os pedidos, o caixa, a cozinha e o estoque.</p>
                            </div>
                            <div class="features-left">
                                <i class="cu cu-user"></i>
                                <h4>ESPAÇO PARA PROPAGANDAS</h4>
                                <p>Ganhe dinheiro anunciando as propagandas de seus parceiros no <br/><b>Sr. Menu</b>.</p>
                            </div>
                        </div>
                        <div class="col-md-4">	
                            <img src="img/4.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-md-4">
                            <div class="features-right">
                                <i class="cu cu-paper"></i>
                                <h4>RELATÓRIO DE PEDIDOS</h4>
                                <p>Pedidos separados por usuários e apresentados em tempo real no caixa.</p>
                            </div>
                            <div class="features-right">
                                <i class="cu cu-pie-chart"></i>
                                <h4>RELATORIO DE RECEITAS</h4>
                                <p>Acompanhe tudo que entrar e sair do seu estabelecimento.</p>
                            </div>
                            <div class="features-right">
                                <i class="cu cu cu-folder"></i>
                                <h4>EMISSÃO DE NOTA FISCAL</h4>
                                <p>Emissão mensal de nota fiscal.</p>
                            </div>
                            <div class="features-right">
                                <i class="glyphicon glyphicon-qrcode"></i>                                
                                <h4>LOGIN POR QR CODE</h4>
                                <p>Login a partir de códigos distribuídos nas mesas e balcões.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- APP FEATURES END -->


            <!-- SERVICE -->
            <div class="services" id="diferenciais">
                <div class="container">
                    <div class="row">
                        <div class="section-heading text-center col-sm-8 col-sm-offset-2">
                            <h2>Primeira plataforma do mercado que atua em tempo real entre todas as instâncias dos estabelecimentos: <b> menu, caixa, cozinha e estoque.</b></h2>
                        </div>
                        <div class="col-sm-3 service-item text-center">
                            <span class="cu cu-laptop-phone"></span><i class="far fa-qrcode"></i>
                            <h3>Totalmente Adaptável</h3>
                            <p>Aplicativo desenvolvido para se adaptar em todas as plataformas.</p>
                        </div>
                        <div class="col-sm-3 service-item text-center">
                            <span class="cu cu-tap-2"></span>
                            <h3>Pagamento em um clique</h3>
                            <p>Usuários dos estabelecimentos possuem liberdade para pagar pelo <b>Sr. Menu</b>, evitando filas e economizando tempo.</p>
                        </div>
                        <div class="col-sm-3 service-item text-center">
                            <span class="cu cu-earth"></span>
                            <h3>Gerenciamento em qualquer lugar</h3>
                            <p>Análise e gerenciamento do sistema em todos os lugares.</p>
                        </div>
                        <div class="col-sm-3 service-item text-center">
                            <span class="cu cu-clock2"></span>
                            <h3>Acompanhamento em tempo real</h3>
                            <p>Análise do fluxo de pedidos e de pessoas em tempo real.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- SERVICE END -->



            <!-- INFO -->
            <div id="oferece" class="info-content" style="background: url(img/intro/bg/bg-madeira.jpg) no-repeat top center;">
                <div class="container">
                    <div class="row center-flex">
                        <div class="col-md-6 col-md-push-6">
                            <img src="img/1.png" class="img-responsive" alt=""/>
                        </div>
                        <div class="col-md-5 col-md-pull-6" style="color: white;">
                            <h2 style="color: white;">O <b>Sr. Menu</b> oferece também:</h2>

                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list">
                                        <li><i class="cu cu-check"></i> Instalação e acompanhamento técnico especializado.</li>
                                        <li><i class="cu cu-check"></i> Reorganização e consultoria de marketing nos produtos catalogados.</li>
                                        <li><i class="cu cu-check"></i> Otimização de tempo e serviço, garantindo uma economia para o associado.</li>
                                        <li><i class="cu cu-check"></i> Exposição da marca do associado nas plataformas do Sr. Menu.</li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- INFO END -->

            <!-- SERVICE FEATURES -->
            <div class="service-features" id="precos">
                <div class="container">
                    <div class="section-heading text-center col-sm-8 col-sm-offset-2">
                        <h2><b>Investimento</b></h2>
                        <p>O Sr. Menu possui um sistema de pagamento diferente dos concorrentes pois não cobra mensalidades fixas.</p>
                        <p>As mensalidades são geradas de acordo com o seu rendimento, ou seja, se adequando com a sua realidade.</p>
                        <p>Precisamos conhecer o funcionamento do seu estabelecimento para atendê-los melhor, procure um de nossos senhores de vendas e conheça nossos planos:</p>
                    </div>
                    <div class="row">
                        <!-- PLAN 1 -->
                        <div class="col-sm-6 text-center">
                            <div class="plan">
                                <div class="plan-title">Frederico Martins</div>
                                <div class="plan-title"><small><i class="fa fa-phone"></i></small>(34)9-9876-9972 <span></span></div>                                
                            </div>
                        </div>
                        <!-- PLAN 1 -->
                        <div class="col-sm-6 text-center">
                            <div class="plan">
                                <div class="plan-title">Marcus Paulo</div>
                                <div class="plan-title"><small><i class="fa fa-phone"></i></small>(34)9-9876-9986 <span></span></div>                                
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="plan">
                                <div class="plan-title">Email</div>
                                <div class="plan-title"><small><i class="fa fa-envelope"></i></small>contato@srmenu.com.br <span></span></div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SERVICE FEATURES END -->


            <!-- NEWSLETTER -->
            <div class="newsletter" id="contato">
                <div class="container">
                    <h2 class="text-center"><b>Contato</b></h2>
                    <div class="clearfix"></div>
                    <div class="gap20"></div>
                    <div id="emailEnviado"></div>

                    <form id="idForm" class="contact-form" action="php/contato.php" method="post">
                        <input name="nomeremetente" id="Nome" type="text" placeholder="Nome" required>
                        <input name="emailremetente" id="Email" type="email" placeholder="Email" required>
                        <input name="assunto" id="Assunto" type="text" placeholder="Assunto" required>
                        <textarea name="mensagem" id="Mensagem" placeholder="Mensagem" style="border: 2px solid #ddd;" required></textarea>

                        <button type="submit" class="btn btn-dark" name="Submit">Enviar</button>
                    </form>

                    <span id="response"></span>
                    <div class="gap40"></div>

                </div>
            </div>
            <!-- NEWSLETTER END -->

            <!-- FOOTER -->
            <footer id="footer">
                <div class="container">
                    <div class="row">

                        <!-- FOOTER LOGO -->
                        <div class="col-sm-4 widget">
                            <div class="f-logo"><img src="img/icone.png" /></div>
                            <div class="cinfo">
                                <p><i class="fa fa-phone"></i> (34) 3334 0585</p>
                                <p><i class="fa fa-phone"></i> (34) 9 9876 9972</p>
                                <p><i class="fa fa-phone"></i> (34) 9 9876 9986</p>
                                <p><i class="fa fa-envelope"></i> contato@srmenu.com.br</p>
                            </div>
                        </div>

                        <!-- FOOTER LOGO -->
                        <div class="col-sm-4 widget">

                        </div>

                        <!-- FOOTER LOGO -->
                        <div class="col-sm-4 widget">
                            <h4>Redes Sociais</h4>
                            <ul class="footer-links">
                                <li><a href="https://www.facebook.com/srmenuapp/"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <li><a href="https://www.instagram.com/srmenuapp/"><i class="fa fa-instagram"></i> Instagram</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </footer>
            <!-- FOOTER END -->	

            <!-- COPYRIGHT -->
            <div class="copyright text-center">
                <div class="container">
                    <div class="col-md-12">
                        <p>&copy; 2018. Sr. Menu</p>
                    </div>
                </div>
            </div>
            <!-- COPYRIGHT END -->
        </div>
        <!-- CODE WRAP END -->

        <a href="#top" class="back-to-top page-scroll"><i class="fa fa-angle-up"></i></a>	

        <!-- jQuery -->

        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.placeholder.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/jarallax/jarallax.js"></script>
        <script src="js/slick/slick.min.js"></script>
        <script src="js/theme.js"></script>
        <script src="js/contact.js"></script>

        <!-- Mailchimp -->
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script>
                // this is the id of the form
                $("#idForm").submit(function (e) {

                    var url = "php/contato.php"; // the script where you handle the form input.

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#idForm").serialize(), // serializes the form's elements.
                        success: function (data)
                        {
                            //alert(data); // show response from the php script.
                            document.getElementById("emailEnviado").innerHTML = data;
                        }
                    });

                    e.preventDefault(); // avoid to execute the actual submit of the form.
                });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
                // jQuery Validation
                $("#signup").validate({
                    // if valid, post data via AJAX
                    submitHandler: function (form) {
                        $.post("php/subscribe.php", {fname: $("#fname").val(), lname: $("#lname").val(), email: $("#email").val()}, function (data) {
                            $('#response').html(data);
                        });
                    },
                    // all fields are required
                    rules: {
                        fname: {
                            required: true
                        },
                        lname: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        }
                    }
                });
            });
        </script>

    </body>
</html>
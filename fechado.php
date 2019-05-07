<?php
$key = uniqid(md5(rand()));
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pede Fácil - Manda Pizza</title>
    <!--         CSS -->
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
          rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
          type='text/css'>
    <link href="css/base.css" rel="stylesheet">
    <link href="css/fonts.css" rel="stylesheet">
    <link href="css/bootstrap-3.3.0.css" rel="stylesheet">
    <link href="css/gerente.css?key=<?php echo $key; ?>" rel="stylesheet">
    <!--         JAVASCRIPT -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/base.js"></script>
    <script src="js/bootstrap-3.3.0/bootstrap-3.3.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

        });
    </script>

    <!--         META TAGS -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta charset="utf-8">
</head>
<body>
<!--header-section-starts-->
<div class="header">
    <div class="container">
        <div class="top-header">
            <div class="logo">
                <a href="index.php"><img src="images/logo-pincelada.png" style="width: 210px; height:70px;"
                                         class="img-responsive" alt=""/></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="menu-bar">
        <div class="container">
            <div class="top-menu">
                <ul>
                    <li class="active"><a href="#">Pedidos</a></li>
                    |
                    <li><a href="#">Editar</a></li>
                    |
                    <li><img id="menu-logo" src="images/logo-manda-pizza.png" style="width:60px; height: 60px;"></li>
                    |
                    <li><a href="sobre.php">Sobre nós</a></li>
                    |
                    <li><a href="sair.php">Sair</a></li>
                    <div class="clearfix"></div>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--header-section-ends-->
<!--content-section-starts-->

<div class="special-offers-section">
    <div class="container">
        <h2>Estabelecimento fechado</h2>
    </div>
</div>
<div class="clearfix"></div>

</div>
<!--content-section-ends-->
<!--footer-section-starts-->
<div class="footer">
    <div class="container">
        <p class="wow fadeInLeft" data-wow-delay="0.2s">&copy; 2019 Todos os direitos reservados | &nbsp;<a
                href="https://contatostreamline.wixsite.com/pedefacil2" target="target_blank">Streamline
            Technologies</a></p>
    </div>
</div>
<!--footer-section-ends-->
<script type="text/javascript">
    $(document).ready(function () {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */

        $().UItoTop({easingType: 'easeOutQuart'});

    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
</html>
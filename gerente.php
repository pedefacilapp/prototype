<?php
$key = uniqid(md5(rand()));
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Pede Fácil - Gerente</title>
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
            var controlePedidos = new Array();
            /* CHAMADA NO BOTÃO "ENCERRAR CONTA" PARA ENVIAR A REQUISIÇÃO DE ENCERRAR PEDIDO */
            $("#tbody_pedidos").on('click', '.btn_encerrar', function () {
                var id_usuario = $(this).closest('tr').find('.id_usuario').text();
                Swal({
                    title: "Deseja encerrar este pedido?",
                    html: "<h2>ID: "+id_usuario+"</h2>",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, encerrar pedido!'
                }).then((result) => {
                    if(result.value){
                        $.ajax({
                            url: 'pedidos.php',
                            type: 'POST',
                            data: 'id_usuario=' + id_usuario + '&&opc=4',
                            dataType: 'json',
                            success: function (result) {

                            }
                        });
                        Swal("Pedido encerrado com sucesso!", "success");
                        location.reload();
                    }
                });
            });
            /* CHAMADA NO BOTÃO "VISUALIZAR PEDIDO" PARA ENVIAR A REQUISIÇÃO DE VISUALIZAR O PEDIDO DO USUÁRIO */
            $("#tbody_pedidos").on('click', '.visualizar_pedido', function () {
                var id_usuario = $(this).closest('tr').find('.id_usuario').text();
                $.ajax({
                    url: 'pedidos.php',
                    type: 'POST',
                    data: 'id_usuario=' + id_usuario + '&&opc=2',
                    dataType: 'json',
                    beforeSend: function () {
                        $(".modalLoading").modal('show');
                    },
                    success: function (result) {
                        $("#tabelaProdutos").html("");
                        $.each(result, function (key, value) {
                            var id_produto = parseInt(value.cod);
                            $("#tabelaProdutos").append("<tr> <td>" + value.nome_produto + "</td> <td>" + value.quantidade + "</td> <td>" + value.observacao + "</td> </tr>");
                        });
                        $("#pedido").modal('show');
                        $(".modalLoading").modal('hide');
                    }
                });
            });

            atualizar();

            function atualizar() {
                $.ajax({
                    url: 'pedidos.php',
                    type: 'POST',
                    data: 'opc=3',
                    dataType: 'json',
                    success: function (result) {
                        if (!controlePedidos.includes(result.controle_pedido)) {
                            $.each(result, function (key, value) {
                                $("#tbody_pedidos").append("<tr> <td>" + value.id_pedido + "</td> <td class='id_usuario'>" + value.id_usuario + "</td> <td>" + value.valor_conta + "</td> <td>" + value.status_pedido + "</td> <td> <button class='visualizar_pedido'>Visualizar pedido</button> </td> <td> <button class='btn_encerrar'>Encerrar conta</button> </td></tr>");
                            });
                            controlePedidos.push(result.controle_pedido);
                        }
                    }
                });
            }

            setInterval(atualizar, 1000);

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
        <div class="lista_pedidos">
            <h3>Pedidos</h3>
            <div id="tabela_pedidos" class="table-responsive">
                <table id="pedidos_em_aberto" class="table">
                    <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Usuário</th>
                        <th>Valor conta</th>
                        <th>Status pedido</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbody_pedidos">
                    <!--                                Conteúdo adicionado dinamicamente-->

                    </tbody>
                </table>
            </div>
        </div>
        <!--                <div class="lista_pedidos">
                            <h3>Pedidos encerrados</h3>
                        </div>-->
    </div>
</div>
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


<!--The Modal-->
<div class="modal fade" id="pedido">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!--Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title">Pedido</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!--Modal body-->
            <div class="modal-body" id="modal-body-carrinho">
                <div class="container table-responsive-sm">
                    <table class="table" style="max-width: 940px;">
                        <thead class="thead-dark">
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Observação</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="tabelaProdutos" style="text-align: left;">

                        </tbody>
                    </table>
                </div>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
<div class="modalLoading"><!-- Place at bottom of page --></div>
</body>
</html>
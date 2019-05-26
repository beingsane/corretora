<?php include 'View/Templates/header.php'; 

    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImovelModel.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/ImagensImovelModel.php";
    
    $imovelModel = new ImovelModel();
    $imoveis = $imovelModel->getAllImovel();

    $imagensImovelModel = new ImagensImovelModel();
    $imagens = $imagensImovelModel->getAllImagens();

?>
    <h1>Gabriela Guimarães Imóveis</h1>
    <br>

    <div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="http://www.verdemarimoveis.com/smart2/modulos/casas/imagens/grande/acapulco_1181-154-57208.jpg"  alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Primeiro Slide</h5>
            <p>Casa com Piscina.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="https://s01.video.glbimg.com/x720/6166808.jpg" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Segunda Slide</h5>
            <p>Casa Luxuosa.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100 img-fluid" style="width:500px;height:600px;" src="https://thumbs.jusbr.com/filters:format(webp)/imgs.jusbr.com/publications/artigos/451460204/images/condominio11493087337.jpg"  alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5>Terceiro Slide</h5>
            <p>Condominio.</p>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Voltar</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Proximo</span>
        </a>


                <!-- Page Content -->
                <div class="container">

                <!-- Page Heading -->
                <h1 class="my-4">Anúncios</h1>
                    
                <!-- Project One -->
                <?php $count = 0; ?>
                <?php foreach($imoveis as $imovel){?>

                <div class="row">
                <div class="col-md-7">
                    <a href="#">
                    <!-- TESTE TESTE TESTE TESTE -->
                    <?php foreach($imagens as $imagem){?>
                        <img class="img-fluid" style="width:750px;height:300px;" src="Files/<?php echo $imagem;?>"  >
                    <?php } ?> 
                    <!-- TESTE TESTE TESTE TESTE -->
                    </a>
                </div>
                <div class="col-md-5">
                        <p><b>Transação:</b>      
                        <?php echo $imovel['descricaoTransacao'];?>
                        
                        <b>um(a)</b>
                        <?php echo $imovel['descricaoTipoImovel'];?></p>

                        <p><b>Preço: R$</b>        
                        <?php echo $imovel['precoImovel'];?></p>

                        <p><b>Área útil:</b>
                        <?php echo $imovel['areaUtil'];?> M² ;

                        <b>Área total:</b>
                        <?php echo $imovel['areaTotal'];?> M² ;</p>

                        <p><img src="https://img.icons8.com/windows/32/000000/bed.png" title="Quantidade de Quartos:">:
                        <?php echo $imovel['quantQuarto'];?> quartos </p>

                        <p><img src="https://img.icons8.com/metro/32/000000/shower-and-tub.png" title="Quantidade de Suítes:">:
                        <?php echo $imovel['quantSuite'];?> suítes </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/car.png" title="Quantidade de Vagas na Garagem:">
                        <?php echo $imovel['quantVagaGaragem'];?> vagas </p>

                        <p><img src="https://img.icons8.com/ios/32/000000/shower.png" title="Quantidade de Banheiros:">
                        <?php echo $imovel['quantBanheiro'];?> banheiros </p>

                        <!-- Modal --> 

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo<?php echo $count; ?>">
                            Detalhes
                        </button>

                        <div class="modal fade" id="modalExemplo<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalhes e Localização</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <p><b>Estado:</b>
                                <?php echo $imovel['descricaoEstado'];?>.</p>

                                <p><b>Cidade:</b>
                                <?php echo $imovel['nomeCidade'];?>.</p>

                                <p><b>Bairro:</b>
                                <?php echo $imovel['nomeBairro'];?>.</p>

                                <p><b>Rua:</b>
                                <?php echo $imovel['logradouro'];?>.</p>

                                <p><b>Número:</b>
                                <?php echo $imovel['numero'];?>.</p>                              
                               
                                <p><b>Descrição do Imovel:</b>
                                <?php echo $imovel['descricaoImovel'];?>.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                            </div>
                        </div>
                        </div>

                </div>
                </div>
                <!-- /.row -->
                <hr>
                <?php $count++; ?>
                <?php } ?> <!-- foreach fecha aki --> 

                <!-- Pagination -->

                <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                    </a>
                </li>
                </ul>

                </div>
                <!-- /.container -->
    </div>
    </div>

<?php include "View/Templates/footer.php"; ?>
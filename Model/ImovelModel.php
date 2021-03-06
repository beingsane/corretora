<?php
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Config/DataBase/dbConfig.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/EnderecoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TipoImovelModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/TransacaoModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/BairroModel.php";
	require_once $_SERVER["DOCUMENT_ROOT"] . "/corretora/Model/CidadeModel.php";

	class ImovelModel{

		private $bd;
		private $endereco;
		private $bairro;
		private $cidade;

		 function __construct(){
			 $this->bd = BancoDados::obterConexao();
			 $this->endereco = new EnderecoModel();
			 $this->bairro = new BairroModel();
			 $this->cidade = new CidadeModel();
		 }

		 public function inserir($idTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
		 						 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, 
								 $idTransacao, $areaUtil, $areaTotal, $precoImovel, $descricaoImovel){
			try {
				
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);

			if($idEndereco == null){
				$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
			}

			$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
			$nomeCidade, $idEstado);

		 	    $insImovel = $this->bd->prepare("INSERT INTO imovel(idEndereco, idTransacao, idTipoImovel, areaUtil, areaTotal, 
				 		precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro) 
			    VALUES (:idEndereco, :idTransacao, :idTipoImovel, :areaUtil, :areaTotal, :precoImovel, :descricaoImovel, 
						:quantQuarto, :quantSuite, :quantVagaGaragem, :quantBanheiro)");

				$insImovel->bindParam(":idEndereco", intval($idEndereco[0]), PDO::PARAM_INT);
				$insImovel->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
				$insImovel->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);

			    $insImovel->bindParam(":areaUtil", $areaUtil, PDO::PARAM_INT);
			    $insImovel->bindParam(":areaTotal", $areaTotal, PDO::PARAM_INT);
				$insImovel->bindParam(":precoImovel", $precoImovel, PDO::PARAM_INT);
				$insImovel->bindParam(":descricaoImovel", $descricaoImovel);
				$insImovel->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
				$insImovel->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
				$insImovel->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
				$insImovel->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

				$insImovel->execute();
				return $teste = $this->bd->lastInsertId();
				
			  } catch(Exception $e){
				  throw $e;
			  }

		 }

		 public function getAllImovel(){
			try{
				$resImovel = $this->bd->query("SELECT imovel.idImovel, nomeBairro, nomeCidade, descricaoEstado, numero, logradouro,
				areaUtil, areaTotal, precoImovel, descricaoImovel, quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro,
				descricaoTipoImovel, descricaoTransacao from imovel 
				inner join transacao on imovel.idTransacao = transacao.idTransacao
				inner join tipoimovel on imovel.idTipoImovel = tipoimovel.idTipoImovel
				inner join endereco on imovel.idEndereco = endereco.idEndereco
				inner join bairro on endereco.idBairro = bairro.idBairro
				inner join cidade on endereco.idCidade = cidade.idCidade
				inner join estado on endereco.idEstado = estado.idEstado
				inner join anuncio on imovel.idImovel = anuncio.idImovel
				where anuncio.verificado = 1 and (imovel.negociacao = 0 or imovel.negociacao is null)
				ORDER BY anuncio.idprioridade ASC");
				$resImovel->execute();
				return $imoveis = $resImovel->fetchAll();
			} catch(Exception $e){
				throw $e;
			}
		}

		public function getIdImovel($idTipoImovel, $areaUtil, $areaTotal, $precoImovel, $idTransacao, $descricaoImovel,
									$quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro){

			$getID = $this->bd->prepare("SELECT idImovel FROM imovel where 
			idTipoImovel = :idTipoImovel and areaUtil = :areaUtil and areaTotal = :areaTotal and precoImovel = :precoImovel
			and idTransacao = :idTransacao and descricaoImovel = :descricaoImovel and quantQuarto = :quantQuarto
			and quantSuite = :quantSuite and quantVagaGaragem = :quantVagaGaragem and quantBanheiro = :quantBanheiro");
							$getID->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
							$getID->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);
			
							$getID->bindParam(":areaUtil", $areaUtil, PDO::PARAM_INT);
							$getID->bindParam(":areaTotal", $areaTotal, PDO::PARAM_INT);
							$getID->bindParam(":precoImovel", $precoImovel, PDO::PARAM_INT);
							$getID->bindParam(":descricaoImovel", $descricaoImovel);
							$getID->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
							$getID->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
							$getID->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
							$getID->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);
			$getID->execute();
			return $idImovel = $getID->fetch();

		}

		public function deleteImovel($idImovel){
			$delete = $this->bd->prepare("DELETE FROM imovel WHERE idImovel = :idImovel");
            $delete->bindParam(":idImovel", $idImovel);
            $delete->execute();
		}

		public function getImovelById($idImovel){
			$select = $this->bd->prepare("SELECT
			ti.descricaoTipoImovel, i.precoImovel, i.quantBanheiro, i.quantQuarto, i.quantSuite, i.quantVagaGaragem, i.areaTotal, i.areaUtil,
			a.idAnuncio, i.idimovel, u.usuario, t.descricaoTransacao, p.nome, est.descricaoEstado, est.siglaEstado, p.idpessoa,
			e.logradouro, e.numero, cep.descricaoCep, b.nomeBairro, c.nomecidade, i.descricaoImovel, e.complemento, ti.idTipoImovel, est.idestado
		from anuncio as a
			inner join imovel as i
				on i.idimovel = a.idImovel 
			inner join endereco as e
				on i.idEndereco = e.idEndereco
			inner join cidade as c
				on e.idCidade = c.idCidade
			inner join estado as est
				on est.idestado = e.idestado
			inner join bairro as b
				on e.idBairro = b.idBairro
			inner join usuario as u
				on u.idusuario = a.idusuario
			inner join pessoa  as p
				on p.idpessoa = u.idusuario
			inner join transacao as t
				on t.idtransacao = i.idtransacao
			inner join cep
				on cep.idcep = e.idcep
			inner join tipoimovel ti
				on ti.idtipoimovel = i.idtipoimovel
			where i.idImovel = :idImovel");
			$select->bindParam(":idImovel", $idImovel);
			$select->execute();
			return $select->fetch(PDO::FETCH_ASSOC);
		}

		public function cadastraPedido($idUsuario, $idTipoImovel, $idTransacao, $nomeBairro, $nomeCidade, $idEstado, 
			$quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, $precoMin, $precoMax){
				try {
					$verBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
					$idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
	
					if($verBairro[0] == null){
						$this->bairro->inserir($nomeBairro); 
					}
					$idBairro = $this->bairro->ListarIdPorBairro($nomeBairro);
		 
					if($idCidade == 0){
						$this->cidade->inserir($nomeCidade);
					}
					$idCidade = $this->cidade->ListarIdPorCidade($nomeCidade);
	
					$insert = $this->bd->prepare("INSERT INTO pedidos 
						(idUsuario, idTipoImovel, idTransacao, idBairro, idCidade, idEstado, 
						quantQuarto, quantSuite, quantVagaGaragem, quantBanheiro, precoMin, precoMax)
						VALUES (:idUsuario, :idTipoImovel, :idTransacao, :idBairro, :idCidade, :idEstado, 
						:quantQuarto, :quantSuite, :quantVagaGaragem, :quantBanheiro, :precoMin, :precoMax)");
	
					$insert->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
					$insert->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);
					$insert->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
	
					$insert->bindParam(":idBairro", intval($idBairro[0]), PDO::PARAM_INT);
					$insert->bindParam(":idCidade", intval($idCidade[0]), PDO::PARAM_INT);
					$insert->bindParam(":idEstado", $idEstado, PDO::PARAM_INT);
	
					$insert->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
					$insert->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
					$insert->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
					$insert->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

					$insert->bindParam(":precoMin", $precoMin, PDO::PARAM_INT);
					$insert->bindParam(":precoMax", $precoMax, PDO::PARAM_INT);
					$insert->execute();

				} catch(Exception $e){
					throw $e;
				}	
		}

		public function editar($idTipoImovel, $cep, $idEstado, $nomeCidade, $nomeBairro, $logradouro, $numero,
		 						 $complemento, $quantQuarto, $quantSuite, $quantVagaGaragem, $quantBanheiro, 
								 $idTransacao, $areaUtil, $areaTotal, $precoImovel, $descricaoImovel, $idImovel){
			try {
				
				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro,
															 $nomeCidade, $idEstado);

				if($idEndereco == null){
					$this->endereco->inserir($logradouro, $numero, $complemento, $cep, $nomeBairro, $nomeCidade, $idEstado);
				}

				$idEndereco = $this->endereco->getIdEndereco($logradouro, $numero, $complemento, $cep, $nomeBairro, 
					$nomeCidade, $idEstado);

		 	    $updateImovel = $this->bd->prepare("UPDATE imovel 
					SET idTipoImovel = :idTipoImovel, 
						areaUtil = :areaUtil,
						areaTotal = :areaTotal,
						precoImovel = :precoImovel,
						idEndereco = :idEndereco,
						idTransacao = :idTransacao,
						descricaoImovel = :descricaoImovel,
						quantQuarto = :quantQuarto,
						quantSuite = :quantSuite,
						quantVagaGaragem = :quantVagaGaragem,
						quantBanheiro = :quantBanheiro
					WHERE idImovel = :idImovel
					 ");

				$updateImovel->bindParam(":idEndereco", intval($idEndereco[0]), PDO::PARAM_INT);
				$updateImovel->bindParam(":idTransacao", $idTransacao, PDO::PARAM_INT);
				$updateImovel->bindParam(":idTipoImovel", $idTipoImovel, PDO::PARAM_INT);

			    $updateImovel->bindParam(":areaUtil", $areaUtil, PDO::PARAM_INT);
			    $updateImovel->bindParam(":areaTotal", $areaTotal, PDO::PARAM_INT);
				$updateImovel->bindParam(":precoImovel", $precoImovel, PDO::PARAM_INT);
				$updateImovel->bindParam(":descricaoImovel", $descricaoImovel);
				$updateImovel->bindParam(":quantQuarto", $quantQuarto, PDO::PARAM_INT);
				$updateImovel->bindParam(":quantSuite", $quantSuite, PDO::PARAM_INT);
				$updateImovel->bindParam(":quantVagaGaragem", $quantVagaGaragem, PDO::PARAM_INT);
				$updateImovel->bindParam(":quantBanheiro", $quantBanheiro, PDO::PARAM_INT);

				$updateImovel->bindParam(":idImovel", $idImovel, PDO::PARAM_INT);

				$updateImovel->execute();
				
			  } catch(Exception $e){
				  throw $e;
			  }

		 }	

		public function getAllPedidos($idUsuario){
			$getPedidos = $this->bd->prepare("SELECT  
				p.idpedido, p.idusuario, p.quantQuarto, p.quantSuite, p.quantVagaGaragem, p.quantBanheiro, p.precoMin, p.precoMax,
				ti.descricaoTipoImovel, t.descricaoTransacao, c.nomeCidade, b.nomeBairro, e.descricaoEstado
			FROM pedidos as p
				inner join tipoimovel as ti
					on ti.idtipoimovel = p.idtipoimovel
				inner join transacao as t
					on t.idtransacao = p.idtransacao
				inner join cidade as c
					on c.idcidade = p.idcidade
				inner join bairro as b
					on b.idbairro = p.idbairro
				inner join estado as e
					on e.idestado = p.idestado
			WHERE p.idUsuario = :idUsuario");
			$getPedidos->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
			$getPedidos->execute();
			return $getPedidos->fetchAll(PDO::FETCH_ASSOC);
		}

		public function deletePedido($idPedido){
			$deletePedido = $this->bd->prepare("DELETE FROM pedidos where idPedido = :idPedido");
			$deletePedido->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);
			$deletePedido->execute();
		}

		public function updateNegociacao($idImovel){
			$update = $this->bd->prepare("UPDATE imovel SET negociacao = 1 WHERE idimovel = :idImovel");
			$update->bindParam(":idImovel", $idImovel, PDO::PARAM_INT);
			$update->execute();
		}

		public function updateAnuncio($idImovel){
			$update = $this->bd->prepare("UPDATE imovel SET negociacao = 0 WHERE idimovel = :idImovel");
			$update->bindParam(":idImovel", $idImovel, PDO::PARAM_INT);
			$update->execute();
		}

		public function getImovelAltoRamdom(){
			try{
				$resImovelRamdom = $this->bd->query("SELECT imovel.idImovel, tipoimovel.descricaoTipoImovel, 
				transacao.descricaoTransacao from imovel 
				inner join transacao on imovel.idTransacao = transacao.idTransacao
				inner join tipoimovel on imovel.idTipoImovel = tipoimovel.idTipoImovel
				inner join anuncio on imovel.idImovel = anuncio.idImovel
				where anuncio.verificado = 1 
                and anuncio.idprioridade = 1 
                and (imovel.negociacao = 0 or imovel.negociacao is null)
				ORDER BY RAND() LIMIT 4");
				$resImovelRamdom->execute();
				return $imoveisRamdom = $resImovelRamdom->fetchAll();
			} catch(Exception $e){
				throw $e;
			}
		}
		public function getImovelAltoRamdomUno(){
			try{
				$resImovelRamdom = $this->bd->query("SELECT imovel.idImovel, tipoimovel.descricaoTipoImovel, 
				transacao.descricaoTransacao from imovel 
				inner join transacao on imovel.idTransacao = transacao.idTransacao
				inner join tipoimovel on imovel.idTipoImovel = tipoimovel.idTipoImovel
				inner join anuncio on imovel.idImovel = anuncio.idImovel
				where anuncio.verificado = 1 
                and anuncio.idprioridade = 1 
                and (imovel.negociacao = 0 or imovel.negociacao is null)
				ORDER BY RAND() LIMIT 1");
				$resImovelRamdom->execute();
				return $imoveisRamdom = $resImovelRamdom->fetchAll();
			} catch(Exception $e){
				throw $e;
			}
		}
	}
?>
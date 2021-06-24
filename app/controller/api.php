<?php 

namespace resources\controller;

if(!defined("protecao_url")){
	die ("Conteudo Protegido");
}

require_once __DIR__ .'/../../vendor/autoload.php';

use resources\controller\trataDados;
use resources\model\recolheDados;

class api{

	private $dados_array;
	private $method_req;

	public function __construct($method, $dados){
		$this->method_req = $method;
		$this->executadados($dados);
	}

	public function executadados($dados){
		switch($this->method_req){
		case "GET":
		$this->dados_array = new trataDados($dados);
		if (isset($_GET['td']) and !isset($_GET['pesq'])):
			header('Content-Type: application/json');
			http_response_code(200);
			echo json_encode($this->dados_array->dados_tratados); 
		else: 
			if (isset($this->dados_array->dados_tratados[$_GET['pesq']]) and in_array($_GET['pesq'], $this->dados_array->dados_tratados[$_GET['pesq']])):
				header('Content-Type: application/json');
				http_response_code(200);
				echo json_encode($this->dados_array->dados_tratados[$_GET['pesq']]);
			else:
				header('Content-Type: application/json');
				http_response_code(404);
				switch($dados){
					case "encomendas":
						$texto_dados = "Encomenda nao encontrada";
					break;
					case "produtos":
						$texto_dados = "Produto nao encontrado";
					break;
				}
				die("Erro: $texto_dados");
			endif; 
		endif;
		break;
		case "POST":
			$jsonStr = file_get_contents("php://input");
			$json = json_decode($jsonStr, true);
			//print_r($json);
			if (isset($_GET['td'])):
				if($_GET['td'] == "produtos"):
					if (array_key_exists("id",$json) and array_key_exists("name",$json) and array_key_exists("price",$json)):
					$dados_ins = $json["id"]."___".$json["name"]."___".$json["price"];
					else:
						die("Erro: Parametros invalidos");
					endif;
					$texto_1 = "";
				endif;
				if($_GET['td'] == "encomendas"):
					if (array_key_exists("id",$json) and array_key_exists("payment",$json) and array_key_exists("price",$json)):
						if(strtolower($json["payment"]) === "paypal"):
							$json["price"] = $json["price"] * 0.9;
						endif;
					$dados_ins = $json["id"]."___".$json["payment"]."___".$json["price"];
						
					else:
						die("Erro: Parametros invalidos");
					endif;
					if(strtolower($json["payment"]) == "multibanco"):
				$texto_1="Foi enviado e-mail com a ref. de multibanco e a ";
			elseif((strtolower($json["payment"]) == "paypal")):
				$texto_1="Obteve um desconto de 10% por ter pago com o Paypal e a ";
			else:
				$texto_1 = "";
			endif;
				endif;
			
			header('Content-Type: application/json');
			http_response_code(200);
			$ficheiro = recolheDados::ficheiro($_GET['td']);
			$fp = fopen($ficheiro, 'a');//opens file in append mode  
			fwrite($fp, PHP_EOL.$dados_ins);  
			fclose($fp);
			if($_GET['td'] == "produtos"): 
				$texto = "Produto foi criado";
			else: 
			$texto = "Encomenda foi criada";
		endif;
			echo $texto_1.$texto." com sucesso!"; 
		else: 
				header('Content-Type: application/json');
				http_response_code(404);
				die("Erro: Deve passar o valor produto ou encomenda");
			endif; 
		break;
		case "DELETE":
			$jsonStr = file_get_contents("php://input");
			$json = json_decode($jsonStr, true);
			if (array_key_exists("id",$json)):
				if($_GET['td'] == "produtos"): 
					$texto = "Foi apagado o produto com o ID ";
				else: 
					$texto = "Foi apagada a encomenda com o ID" ;
				endif;
				header('Content-Type: application/json');
				http_response_code(200);
				echo $texto.$json["id"];
			else:
				header('Content-Type: application/json');
				http_response_code(404);
				die("Erro: Deve passar o id do produto ou da encomenda");	
			endif;
		break;
		case "PUT":
			$jsonStr = file_get_contents("php://input");
			$json = json_decode($jsonStr, true);
			if (array_key_exists("id",$json) and array_key_exists("name",$json) or array_key_exists("payment",$json) or array_key_exists("price",$json)):
				if($_GET['td'] == "produtos"): 
					$texto = "Foi atualizado o produto com o ID ";
				else: 
					$texto = "Foi atualizada a encomenda com o ID ";
				endif;
				header('Content-Type: application/json');
				http_response_code(200);
				echo $texto.$json["id"];
			else:
				header('Content-Type: application/json');
				http_response_code(404);
				die("Erro: Deve passar o id do produto ou da encomenda");	
			endif;
		break;
		}
	}	
}
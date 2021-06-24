<?php

namespace resources\controller;

if(!defined("protecao_url")){
	die ("Conteudo Protegido");
}

require_once __DIR__ .'/../../vendor/autoload.php';

use resources\model\recolheDados;

class trataDados{

	public $ntotalregistos;
	public $registo;
	public $chaves;
	public $dados_tratados;

	public function __construct($tipo_dados){
		$dados = recolheDados::recolhedados($tipo_dados);
		$separar_dados = explode("\r\n", $dados);
		$this -> ntotalregistos = count($separar_dados);
		for($a=0;$a<$this -> ntotalregistos;$a++){
			$this -> registo[$a] = explode("___", $separar_dados[$a]);
				switch($tipo_dados){
					case "produtos":
						$this -> chaves = array ("id", "name","price");
					break;
					case "encomendas":
						$this -> chaves = array ("id", "payment","price");
					break;
				}
				$this -> dados_tratados[$a] = array ($this -> chaves[0] => $this -> registo[$a][0], $this -> chaves[1] => $this -> registo[$a][1], $this -> chaves[2] => $this -> registo[$a][2]);	
		}
	}

}	

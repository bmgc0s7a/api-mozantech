<?php

namespace resources\model;

if(!defined("protecao_url")){
	die ("Conteudo Protegido");
}

class recolheDados{

	public static function recolhedados($filename){
		$url_file = "app/view/".$filename.".txt";
		if(file_exists($url_file)){
			return(file_get_contents($url_file));
		} else { 
			die("Erro: O Ficheiro nao existe");
		}
	}
	public static function ficheiro($filename){
		return("app/view/".$filename.".txt");
	}
}
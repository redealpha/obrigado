<?php  
	
    require_once("inc/Url.php");
    ini_set('display_errors','Off');
    ini_set('error_reporting', E_ALL );
    date_default_timezone_set('America/Sao_Paulo');

	$pagina = Url::getURL( 0 );
    if($pagina == NULL ){
    	$pagina = 'tks';
    }
    /* Adicionando o head do sistema */
    require_once("paginas/header.php");
    if($pagina == 'tks' || $pagina == 'cerato' || $pagina == 'sportage' || $pagina == 'sorento' || $pagina == 'kia-rio' || $pagina == 'bongo' || $pagina == 'soul' || $pagina == 'carnival' || $pagina == 'stinger'){
    	require "paginas/home.php";
    } 
    else if($pagina == "404"){
        require "paginas/404.php";
    }else {
        header("Location: /obrigado/404");
    }
    require_once("paginas/footer.php");

	

?>
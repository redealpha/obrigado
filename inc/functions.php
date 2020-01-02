<?php
/* 
	Autor: Douglas de Sousa Lisboa
	Email: lisboadouglas.rp@gmail.com

*/
	$agora = date("d/m/Y H:i:s");

	
	//Gerando o Token
	function GeraToken($user){
		$token = time() . rand(10, 5000) . sha1(rand(10, 5000)) . md5(__FILE__);
		$licensekey = "KIABRISA";
		$token = str_shuffle($token);
		$token = sha1($token) . md5(microtime()) . md5($user);
		return $token;
	}
	//Gerando senha automaticamente
	function GeraNovaSenha($tamanho = 17, $maiusculas = true, $numeros = true, $simbolos = true){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-{}[]()';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
	function preco($carro,$modelo){
	if($carro == "cerato"){
		$valor = 94990.00;
		return $valor;
	} else if($carro == "sportage"){
		if(modelo == "" || modelo == "ex" ){
			$valor = 117990.00;
		} else {
			$valor = 129990.00;
		}
		return $valor;
	}else if($carro == "soul"){
		$valor = 79990.00;
		return $valor;
	}else if($carro == "sorento"){
		$valor = 178990.00;
		return $valor;
	}else if($carro == "carnival"){
		$valor = 288990.00;
		return $valor;
	}else if($carro == "stinger"){
		$valor = 339900.00;
		return $valor;
	}
}
	//Função para gerar nome aleatório para as imagens carregadas para o site
	function GeraNomeIMG () {
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;
		$caracteres .= $lmai;
		$caracteres .= $num;
		$len = strlen($caracteres);
		for($n = 1; $n <= 8; $n++){
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];	
		}
		return $retorno;
	}
	//Gerando a Senha para ser lida pelo Interspire
	function GeraSenha($token, $senha){
		$novasenha =  md5(md5($token) . md5($senha));
		return $novasenha;
	}
	
	function MontaCampos($dados){
		foreach ($dados as $key => $value){
			$fields[] = "{$key} = '{$value}'";
			
		}
		$fields = implode(', ', $fields);
		return $fields;
	}
	function MontaDados($dados){
		foreach ($dados as $key => $value){
			$fields[] = "{$value}";
		}
		$fields = implode(', ', $fields);
		return $fields;
	}
	// Formato data  BR
	function DataBr($data){
		return date("d/m/Y", strtotime($data));
	}
	function DataBr2($data){
		return date("d/m/Y H:i:s", strtotime($data));
	}
	function Hora($hora){
		return date("H:i:s", strtotime($hora));
	}
	function DataeHora($data){
		return date("d/m/Y H:i", strtotime($data));
	}
	function PegacampoData($data, $campo){
		if($campo == 1){
			$i = explode("/", $data);
			return $i[0];
		} else if($campo == 2){
			$i = explode("/", $data);
			return $i[1];
		} else if($campo == 3){
			$i = explode("/", $data);
			return $i[2];
		}
	}

	function alteraTexto($busca, $dados, $mensagem){
		$novamensagem = str_replace($busca, $dados, $mensagem);
		return $novamensagem;
	}
	
	function Verifica($dados){
		$email = $dados['email'];
		$senha = $dados['senha'];
		$result = $db->get_row("SELECT * FROM usuarios WHERE email='{$email}'");
		if( count($result) > 0 ){
			// Verifica se a senha digitada é igual
			$cp = GeraSenha($result->token,$senha);
			if($result->senha == $cp){
				$sessao = array(
					'id'  => $result->id,
					'nome' => $result->nome,
					'email' => $result->email,
				);
			} else {
				$sessao = false;
			}
		} else {
			$sessao = false;
		}
	}
	function backs($carro){
		if($carro == "cerato"){
			return "assets/images/backs/novocerato.png";
		} else if($carro == "carnival"){
			return "assets/images/backs/carnival.png";
		} else if($carro == "sorento"){
			return "assets/images/backs/sorento.png";
		} else if($carro == "soul"){
			return "assets/images/backs/soul.png";
		} else if($carro == "sportage"){
			return "assets/images/backs/sportage.png";
		} else if($carro == "stinger"){
			return "assets/images/backs/stinger.png";
		}
	}
	function backsMenu($carro){
		if($carro == "cerato"){
			return "assets/images/menu/cerato.png";
		} else if($carro == "carnival"){
			return "assets/images/menu/carnival.png";
		} else if($carro == "sorento"){
			return "assets/images/menu/sorento.png";
		} else if($carro == "soul"){
			return "assets/images/menu/soul.png";
		} else if($carro == "sportage"){
			return "assets/images/menu/sportage.png";
		} else if($carro == "stinger"){
			return "assets/images/menu/stinger.png";
		}
	}
	

	function EnviarEmail($dados){
		require_once("phpmailer/class.phpmailer.php");
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		
		$mail->Host 	= "mail.kiabrisa.com.br";
		$mail->SMTPAuth = true;
		//$mail->SMTPSecure = 'tls';
		$mail->port 	= 25;
		$mail->Username = 'naoresponda@kiabrisa.com.br';
		$mail->Password = '@kiaW@Y2019';

		$mail->SetFrom($dados['from'],$dados['from_name']);

		$mail->Subject 	= utf8_decode($dados['assunto']);

		$mail->AddAddress($dados['to'],$dados['to_name']);

		if(isset($dados['bcc'])){
			$mail->AddBCC($dados['bcc'],$dados['bcc_name']);
		}
		if(isset($dados['anexo'])){
			$mail->AddAttachment($dados['anexo']);
		}
		
		$mail->IsHTML(true);
		//$mail->CharSet = 'iso-8859-1';
		$mail->MsgHTML(utf8_decode($dados['mensagem']));

		$envia = $mail->Send();
		if($envia){
			$msg = true;
		} else {
			$msg = $mail->ErrorInfo;
		}
		return $msg;
	}
	function Dias($dtini,$dtfin){
		$diferenca = strtotime($dtfin) - strtotime($dtini);
		$dias = floor($diferenca / (60 * 60 * 24));
		return $dias;
	}
	
	
	function UrlAtual(){
	 $dominio= $_SERVER['HTTPS_HOST'];
	 $url = "https://" . $dominio. $_SERVER['REQUEST_URI'];
	 return $url;
	}
	function moeda($dados){
		return "R$ ".number_format($dados, 2,',','.');
	}
	
	


	$MES['01'] = "Janeiro";
	$MES['02'] = "Fevereiro";
	$MES['03'] = "Março";
	$MES['04'] = "Abril";
	$MES['05'] = "Maio";
	$MES['06'] = "Junho";
	$MES['07'] = "Julho";
	$MES['08'] = "Agosto";
	$MES['09'] = "Setembro";
	$MES['10'] = "Outubro";
	$MES['11'] = "Novembro";
	$MES['12'] = "Dezembro";


	$PATH_HOST = $_SERVER['DOCUMENT_ROOT'];

	$EMAIL = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Email!</title>
    </head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;background-color: #dee0e2;height: 100%;width: 100%;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;padding: 0;background-color: #dee0e2;border-collapse: collapse;height: 100%;width: 100%;">
                <tr>
                    <td align="center" valign="top" id="bodyCell" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;margin: 0;padding: 20px;border-top: 4px solid #bbb;height: 100%;width: 100%;">
                        <!-- BEGIN TEMPLATE // -->
                        <table border="0" cellpadding="0" cellspacing="0" id="templateContainer" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;width: 600px;border: 1px solid #bbb;border-collapse: collapse;">
                            <tr>
                                <td align="center" valign="top" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templatePreheader" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;background-color: #bb162b;color: #FFF;border-left: 6px solid #37b241;border-collapse: collapse;">
                                        <tr>
                                            <td valign="top" class="preheaderContent" style="padding-top: 10px;padding-right: 20px;padding-bottom: 10px;padding-left: 20px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: #FFF;font-family: Helvetica;font-size: 10px;line-height: 125%;text-align: left;" mc:edit="preheader_content00">
                                                Kia Rio - KIA Brisa
                                            </td>
                                            <td valign="top" width="180" class="preheaderContent" style="padding-top: 10px;padding-right: 20px;padding-bottom: 10px;padding-left: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: #FFF;font-family: Helvetica;font-size: 10px;line-height: 125%;text-align: left;" mc:edit="preheader_content01">
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateHeader" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;background-color: #FFF;border-left: 6px solid #37b241;padding: 20px;border-collapse: collapse;">
                                        <tr>
                                            <td valign="top" class="headerContent" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: #505050;font-family: Helvetica;font-size: 20px;font-weight: bold;line-height: 100%;padding: 20px;text-align: left;vertical-align: middle; background-color: #fff">
                                                <img src="https://kiabrisa.com.br/wp-content/uploads/2019/05/logo-kiabrisa-numero-1.png" style="max-width: 600px;-ms-interpolation-mode: bicubic;border: 0;height: auto;line-height: 100%;outline: 0;text-decoration: none;" id="headerImage" mc:label="header_image" mc:edit="header_image" mc:allowdesigner mc:allowtext>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" valign="top" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;background-color: #FFF;border-bottom: 1px solid #ccc;border-collapse: collapse;">
                                        <tr>
                                            <td style="webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: #505050;font-family: Helvetica;font-size: 14px;line-height: 150%;padding-top: 20px;padding-right: 20px;padding-bottom: 20px;padding-left: 20px;text-align: left; background-color: #fff;border-left: 6px solid #37b241">
                                                 <h1 style="display: block;font-family: Helvetica;font-size: 26px;font-style: normal;font-weight: bold;line-height: 100%;letter-spacing: normal;margin-top: 0;margin-right: 0;margin-bottom: 10px;margin-left: 0;text-align: left;color: #bb162b;">Lan&ccedil;amento do KIA RIO - Kia Brisa</h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" class="bodyContent" mc:edit="body_content" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: #505050;font-family: Helvetica;font-size: 14px;line-height: 150%;padding-top: 20px;padding-right: 20px;padding-bottom: 20px;padding-left: 20px;text-align: left;">
                                               
                                                <h3 style="display: block;font-family: Helvetica;font-size: 16px;font-style: italic;font-weight: normal;line-height: 100%;letter-spacing: normal;margin-top: 0;margin-right: 0;margin-bottom: 10px;margin-left: 0;text-align: left;color: #606060;">Olá %NOME%, tudo bem?</h3><br><br>
                                                Este é um e-mail de confirmação da sua solicitação de proposta realizada em nosso site. <br><br>
                                                Em breve um de nossos consultores entrará em contato para dar continuidade ao seu atendimento.<br><br>
												
												<strong>Nome: </strong>%NOME% <br>
												<strong>Email: </strong>%EMAIL% <br>
												<strong>Telefone: </strong>%TELEFONE% <br>
												<strong>CLIENTE KIA: </strong>%MODO% <br>
												<strong>DATA: </strong>%DATA% <br>

                                                
                                                <strong>Importante:</strong> Este e-mail foi gerado automaticamente pelo nosso sistema. Por favor, não responda!
                                               
                                                <br>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="center" valign="top" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;background-color: #2f2f2f;border-top: 1px solid #fff;border-collapse: collapse;">
                                        <tr>
                                            <td valign="top" class="footerContent" mc:edit="footer_content00" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: gray;font-family: Helvetica;font-size: 10px;line-height: 150%;padding-top: 20px;padding-right: 20px;padding-bottom: 20px;padding-left: 20px;text-align: center;">
                                                <a href="http://kiabrisa.com.br" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #606060;font-weight: normal;text-decoration: underline;">Site KIA Brisa</a>&nbsp;&nbsp;&nbsp;
                                                <a href="http://instagram.com/kiabrisa" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #606060;font-weight: normal;text-decoration: underline;">Instagram</a>&nbsp;&nbsp;&nbsp;
                                                <a href="http://facebook.com/kiabrisa" style="-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #606060;font-weight: normal;text-decoration: underline;">Facebook</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" class="footerContent" style="padding-top: 20px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;mso-table-lspace: 0;mso-table-rspace: 0;color: gray;font-family: Helvetica;font-size: 10px;line-height: 150%;padding-right: 20px;padding-bottom: 20px;padding-left: 20px;text-align: center;" mc:edit="footer_content01">
                                                <em>KIABRISA - A número 1 em KIA &copy; - %ANO% - Todos os Direitos Reservados</em>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>';
	

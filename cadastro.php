<?php 
//Funções de validação-------------------------------------------------------------------------------------

//função para validar que o nome tenha mais de 10 carateres e que não tenha numeros nele
function valiNome($nome){ 
	return strlen($nome)>=10 and !preg_match('/[0-9]/', $nome);
}
//função para validar que a idade seja um valor numerico, não seja negativo e seja minor ou igual a 200
function valiIdade($idade){ 
	return is_numeric($idade) and $idade>0 and $idade<=200;
}
//função para validar que o UF só tenha 2 caracteres maiúsculos sem numeros nele
function valiUF($UF){ 
	return strlen($UF)==2 and ctype_upper($UF) and !preg_match('/[0-9]/', $UF);
}
//---------------------------------------------------------------------------------------------------------

if(isset($_POST['nome']) and isset($_POST['idade']) and isset($_POST['UF'])) { //verifica se os 3 dados requeridos foram postados
	
	$nome=trim($_POST['nome']);		//limpa os strings de espaços  
	$idade=trim($_POST['idade']);	//vazios no incio e final
	$UF=trim($_POST['UF']);			//dos mesmos

	if(valiNome($nome) and valiIdade($idade) and valiUF($UF)) { //verifica se os três dados cumprem com a estrutura requerida

		$servidor = "localhost";	//
		$usuario = "root";			//Variabeis de conexão com o
		$senha = "DATABASE";		//servidor MySQL
		$bancodedados="atento";		//

		$conex = new mysqli($servidor, $usuario, $senha, $bancodedados); //realiza a conexão com o banco de dados usando os parametros preenchidos anteriormente

		if ($conex->connect_error) { //caso exista algum erro na conexão com o banco de dados
		    $mensagem='Falha de conexão com o banco de dados';

		}else{
			$sql="INSERT INTO usuarios(nome,idade,UF) VALUES(?,?,?)"; //query para inserir os dados na tabela
			$prep=$conex->prepare($sql);				//prepara o query para receber os valores nos signos "?"
			$prep->bind_param("sss",$nome,$idade,$UF);	//substitui os '?' do query por as 3 variáveis inseridas
			$prep->execute();							//executa o query

			$prep->close();	 //fecha e execução de query
			$conex->close(); //fecha a conexão com o banco de dados

			$mensagem='Cadastro exitoso';
		}

	}else{ //caso os dados não cumpram com a estrutura requerida
		$mensagem='Os dados postados não possuem o formato correto';
	}

}else{ //caso os dados requeridos não foram postados
	$mensagem='não foram postados os dados requeridos';
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
<h1><?php echo $mensagem; ?></h1>
<a href="index.html"><button class="botao">Voltar</button></a>
</body>
</html>
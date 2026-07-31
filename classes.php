<?php
  // Efetua conex�o com o banco mysql
  class Conexao
      {  private
		 $mensagem,
		 $sucesso;
       function conexao() {
        $mensagem = "<FONT SIZE='14' COLOR='#CC0066'><B>Opera��o Cancelada</B></FONT>";
        $sucesso = "<FONT SIZE='14' COLOR='#CC0066'><B>Opera��o Efetuada com sucesso</B></FONT>";
	    $con = mysql_connect("db","root","root_password") or die ("PROBLEMA NA CONEX�O");
	    $db = mysql_select_db("loto_facil",$con)  or die("BANCO DE DADOS N�O ENCONTRADO");
	    //$db = mysql_select_db("teste",$con)  or die("BANCO DE DADOS N�O ENCONTRADO");
	   
	    return $db;
        }
	  }

  // Executa tr�s m�todos de forma gen�rica com sql : EXCLUS�O - SELE��O
  class Operacao extends Conexao
  {   private
	  $tabela=null,
	  $campo=null,
	  $valor=null;
   function excluir($tabela,$campo,$valor)
		 {$sql_excl = " delete from $tabela where $campo = $valor ";
		  mysql_query($sql_excl) or die($mensagem);
		  
		  return $sucesso=true;
		 }
		 
	// Consulta SQL com um LIKE para pesquisar parte do nome
   function localizar($tabela,$campo,$valor,$order)
		 {$sql_loc = " select * from $tabela where $campo like '%$valor%' ";
 	       if(($order != null)) {
             $sql_loc.= " ORDER BY $order DESC";
            // $sql_loc.= " ORDER BY $order ASC";
           }
		  // print $sql_loc;
      	  $result_loc = mysql_query($sql_loc) or die($mensagem='Erro consulta da fun��o localizar');
      	  
          return $result_loc;
      }

   function listar($tabela,$order)
		 {$sql_list = " select * from $tabela ";
		 if(($order != null)) {
             $sql_list.= " ORDER BY $order DESC";
            // $sql_list.= " ORDER BY $order ASC";
           }
		  $result_list = mysql_query($sql_list) or die($mensagem);
		  return $result_list;
     	 }
  }

  // Classe verifica se a aposta gerada j� foi sorteada em concursos anteriores
  class Aposta extends Operacao
   {
    function Cons_aposta_ant($aposta)
    {

    $sql = " SELECT * FROM conc_ant WHERE dez_01=$aposta[0] and dez_02=$aposta[1] and dez_03=$aposta[2] and dez_04=$aposta[3]
    and dez_05=$aposta[4] and dez_06=$aposta[5] and dez_07=$aposta[6] and dez_08=$aposta[7] and dez_09=$aposta[8]
    and dez_10=$aposta[9] and dez_11=$aposta[10] and dez_12=$aposta[11] and dez_13=$aposta[12] and dez_14=$aposta[13]
    and dez_15=$aposta[14] ";
  //print $sql;
 // print "<br>";

     $result_concant = mysql_query($sql) or die($mensagem="CONSULTA CONCURSOS ANTERIORES FALHOU: Verifique BANCO DE DADOS (Loto F�cil)
      - TECLE VOLTAR do Navegador");
      
	 return $result_concant;
	}
   }  // Fim classe Aposta

  // Cadastro de Concursos Anteriores
  class CadConc extends Operacao
   {
    function cadConc_1($nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,$dez_09,
    $dez_10,$dez_11,$dez_12,$dez_13,$dez_14,$dez_15)
    {
    $sql = " insert into conc_ant (nr_concurso,dez_01,dez_02,dez_03,dez_04,dez_05,dez_06,dez_07,dez_08,dez_09,
    dez_10,dez_11,dez_12,dez_13,dez_14,dez_15)
    values ($nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,$dez_09,$dez_10,
    $dez_11,$dez_12,$dez_13,$dez_14,$dez_15); ";
//print $sql;
     mysql_query($sql) or die($mensagem="CONCURSO J� CADASTRADO ou outro erro: Verifique dados entrada - TECLE VOLTAR do Navegador");
	 return $sucesso=true;
	}
    function atualizarConc($cod,$nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,$dez_09,
    $dez_10,$dez_11,$dez_12,$dez_13,$dez_14,$dez_15)
	{
     $sql = " update conc_ant set nr_concurso='$nr_concurso',dez_01='$dez_01',
              dez_02='$dez_02',dez_03='$dez_03',dez_04='$dez_04',dez_05='$dez_05',dez_06='$dez_06',dez_07='$dez_07',
              dez_08='$dez_08',dez_09='$dez_09',dez_10='$dez_10',dez_11='$dez_11',dez_12='$dez_12',dez_13='$dez_13',
              dez_14='$dez_14',dez_15='$dez_15'
			  where cod_conc='$cod' ";
     mysql_query($sql) or die($mensagem);
	 return $sucesso=true;
	}
   }

  // Ler arquivo txt com todos os concursos
  // Classe criada so para carregar todos os concursos anteriores
  class Cadconc_Ant extends Operacao
   {

    function Ler_arquivo_txt($arquivo_rec)
    {

     $dados = file($arquivo_rec);
    //var_dump($dados);
    
    
    foreach($dados as $linha){

	//Retirar os espa�os em branco no inicio e no final da string
	$linha = trim($linha);

	//Colocar em um array cada item separado pela virgula na string
	$valor = explode(',', $linha);
//	var_dump($valor);

    $nr_concurso = $valor[0];
    $dez_01 = $valor[1];
    $dez_02 = $valor[2];
    $dez_03 = $valor[3];
    $dez_04 = $valor[4];
    $dez_05 = $valor[5];
    $dez_06 = $valor[6];
    $dez_07 = $valor[7];
    $dez_08 = $valor[8];
    $dez_09 = $valor[9];
    $dez_10 = $valor[10];
    $dez_11 = $valor[11];
    $dez_12 = $valor[12];
    $dez_13 = $valor[13];
    $dez_14 = $valor[14];
    $dez_15 = $valor[15];

    $sql = " insert into conc_ant (nr_concurso,dez_01,dez_02,dez_03,dez_04,dez_05,dez_06,dez_07,dez_08,dez_09,
    dez_10,dez_11,dez_12,dez_13,dez_14,dez_15)
    values ($nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,$dez_09,$dez_10,
    $dez_11,$dez_12,$dez_13,$dez_14,$dez_15); ";
//print $sql;
     mysql_query($sql) or die($mensagem="ERRO NA LEITURA DO ARQUIVO TXT OU BANCO DE DADOS - TECLE VOLTAR do Navegador");
     }
   //   $_SESSION['msg'] = "<p style='color: green;'>$Ok_sucesso</p>";
    //  header("Location: lendo_texto.php");
	 return $sucesso="DADOS INSERIDO COM SUCESSO !!!!!";
	}
   }

   //  Cadastro de Usu�rios do Sistema
  class CadUsuario extends Operacao
   {
    function cadUsuario_1($nome_usuario,$senha)
    {$sql = " insert into usuario (usuario,senha) values ('$nome_usuario','$senha'); ";
    // print $sql;
     mysql_query($sql) or die($mensagem="USU�RIO J� CADASTRADO ou outro erro: Verifique dados entrada - TECLE VOLTAR do Navegador");

     return $sucesso=true;
	}
 function atualizarUsuario($cod,$nome_usuario,$senha)
	{$sql = " update usuario set usuario='$nome_usuario',senha='$senha'
              where cod_usuario='$cod' ";
     mysql_query($sql) or die($mensagem);

	 return $sucesso=true;
	}
   }

  class Quadro_loto extends Operacao
  {
   function ler_ult_conc()
    {
         $sql_loc = " SELECT * FROM conc_ant
                       WHERE nr_concurso = (SELECT MAX(nr_concurso) FROM conc_ant); ";
//	       if(($order != null)) {
//             $sql_loc.= " ORDER BY $order DESC";
//          }
		  // print $sql_loc;
      	  $result_loc = mysql_query($sql_loc) or die($mensagem='Erro consulta da fun��o localizar');

          return $result_loc;
    }

   function gravar_resultado($result_loc)
    {

    $linha = mysql_fetch_array($result_loc);
    $cod_conc = $linha["cod_conc"];
    $nr_concurso = $linha["nr_concurso"];
    $dez[1] = $linha["dez_01"];
    $dez[2] = $linha["dez_02"];
    $dez[3] = $linha["dez_03"];
    $dez[4] = $linha["dez_04"];
    $dez[5] = $linha["dez_05"];
    $dez[6] = $linha["dez_06"];
    $dez[7] = $linha["dez_07"];
    $dez[8] = $linha["dez_08"];
    $dez[9] = $linha["dez_09"];
    $dez[10] = $linha["dez_10"];
    $dez[11] = $linha["dez_11"];
    $dez[12] = $linha["dez_12"];
    $dez[13] = $linha["dez_13"];
    $dez[14] = $linha["dez_14"];
    $dez[15] = $linha["dez_15"];

    // GERANDO MATRIZ 25 n�meros do cart�o de apostas da LOTOF�CIL
    // Valor da segunda coluna com 0, indicando dezena n�o sorteada
    $x=0;
    for ($z=1; $z<=25; $z++) {
      $quadro_loto[$z][1] = ($x = $x+1);
      }
    for ($z=1; $z<=25; $z++) {
      $quadro_loto[$z][2] = 0;
      }

    // GRAVANDO RESULTADO DO �LTIMO CONCURSO na Matriz Cart�o de Apostas
    // Valor da segunda coluna com 1, indicando dezena sorteada
    for ($e=1; $e<=15; $e++) {
       for ($z=1; $z<=25; $z++) {
         if($dez[$e]==$quadro_loto[$z][1]) {
             $quadro_loto[$z][2]=1;
         }
       }
     }
        
     return $quadro_loto;

    }
   }

  class Vetor_tupla extends Quadro_loto
  {

   function marcar_tupla($result_e)
    {

//  GERANDO  PRIMEIRA_TUPLA ONDE SER� GRAVADO O RESULTADO �LTIMO CONCURSO
     $x=0;
     for ($z=0; $z<=16; $z++) {
      $tupla[$z] = ($x = $x+1);
     }
// FIM GERA��O

//   GRAVANDO RESULTADO DO �LTMO CONCURSO NA PRIMERIA_TUPLA
 
     if ($result_e[1][2]==0) {
       $tupla[0] = $result_e[1][1];
    } else $tupla[0]=0;

     if ($result_e[2][2]==0) {
        $tupla[1] = $result_e[2][1];
    } else $tupla[1]=0;

     if ($result_e[3][2]==0) {
       $tupla[2] = $result_e[3][1];
    } else $tupla[2]=0;

     if ($result_e[5][2]==0) {
       $tupla[3] = $result_e[5][1];
    } else $tupla[3]=0;

     if ($result_e[6][2]==0) {
       $tupla[4] = $result_e[6][1];
    } else $tupla[4]=0;

     if ($result_e[8][2]==0) {
       $tupla[5] = $result_e[8][1];
    } else $tupla[5]=0;

     if ($result_e[9][2]==0) {
       $tupla[6] = $result_e[9][1];
    } else $tupla[6]=0;

     if ($result_e[11][2]==0) {
       $tupla[7] = $result_e[11][1];
    } else $tupla[7]=0;

     if ($result_e[12][2]==0) {
       $tupla[8] = $result_e[12][1];
    } else $tupla[8]=0;

     if ($result_e[14][2]==0) {
       $tupla[9] = $result_e[14][1];
    } else $tupla[9]=0;

     if ($result_e[15][2]==0) {
       $tupla[10] = $result_e[15][1];
    } else $tupla[10]=0;

     if ($result_e[17][2]==0) {
       $tupla[11] = $result_e[17][1];
    } else $tupla[11]=0;

     if ($result_e[18][2]==0) {
       $tupla[12] = $result_e[18][1];
    } else $tupla[12]=0;

     if ($result_e[20][2]==0) {
       $tupla[13] = $result_e[20][1];
    } else $tupla[13]=0;

     if ($result_e[21][2]==0) {
       $tupla[14] = $result_e[21][1];
    } else $tupla[14]=0;

     if ($result_e[23][2]==0) {
       $tupla[15] = $result_e[23][1];
    } else $tupla[15]=0;

     if ($result_e[24][2]==0) {
       $tupla[16] = $result_e[24][1];
    } else $tupla[16]=0;
// FIM GRAVA��O PRIMEIRA_TUPLA

  return $tupla;
  
  }  // Fim fun��o Marcar_tupla
  
   function random_tupla($tupla_rec, $tipo_aposta_rec)
   {
//   GERANDO VETOR ONDE SER� GRAVADO OS N�MEROS SORTEADOS PARA APOSTA DE 15 ou 16 N�MEROS

    for ($z=0; $z<=14; $z++) {
      $sorteio[$z] = null;
      }
// FIM GERA��O VETOR SORTEIO

    // ALTERA��O QUANTIDADE SORTEADA CONFORME TIPO DE APOSTA: 15 ou 16 dezenas
    if ($tipo_aposta_rec==1) {
   //Aposta de 15 dezenas
     $quant_ap=4;
    }
    if ($tipo_aposta_rec==2) {
    //Aposta de 16 dezenas
     $quant_ap=5;
    }

    $t=0;
    while ($t<$quant_ap){
     for ($e=0; $e<=16; $e++) {
      $gera[$e] = rand(1,24);
     }
    $unico_gera = array_unique($gera);
    $indice_gera = array_keys($unico_gera);
    $x = count($indice_gera);
    for ($y=0; $y<$x; $y++) {
     $gera_final[$y]= $unico_gera[$indice_gera[$y]];
     } //  FIM for
     
    $i=0;
    for ($y=0; $y<$x; $y++)  {
     for ($e=0; $e<=16; $e++) {
        if ($gera_final[$y]== $tupla_rec[$e]) {
         $sort_prov[$i]=$tupla_rec[$e];
         $sorteio[$i]=$tupla_rec[$e];
         $i=$i+1;
        }
      } // Fim for
    } // Fim for
    $t=count($sort_prov);
  }  // FIM while
 
// ALTERA��O QUANTIDADE SORTEADA CONFORME TIPO DE APOSTA: 15 ou 16 dezenas
  if ($tipo_aposta_rec==1) {
 // Aposta de 15 dezenas
   $q_tupla_sort=3;
  }
  if ($tipo_aposta_rec==2) {
 // Aposta de 16 dezenas
   $q_tupla_sort=4;
  }

  for ($y=0; $y<=14; $y++) {
     if ($y>$q_tupla_sort) {
        $sorteio[$y]=null ;
        }
     }

     return $sorteio;
     
    } // Fim func�o random_tupla
   }  //Fim Classe Vetor_tupla
   

  class Vetor_nrsorteados extends Quadro_loto
  {
   function gerar_vetsort($result_e)
    {

   //  GERANDO  VETOR NRS SORTEADOS DO RESULTADO DO �LTIMO CONCURSO
    $x=0;
    for ($z=0; $z<=14; $z++) {
      $vetsort[$z] = ($x = $x+1);
      }
   // FIM GERA��O

   //   GRAVANDO RESULTADO DO �LTMO CONCURSO NO VETOR DE NRS SORTEADOS
   $i=0;
   for ($y=1; $y<=25; $y++)  {
     if ($result_e[$y][2]== 1) {
       $vetsort[$i]=$result_e[$y][1];
       $i=$i+1;
    }
   } // Fim for

  return $vetsort;
  
  }  // Fim fun��o gerar_vetsort
  
  function random_vetsort($vetsort_rec, $tipo_aposta_rec, $sorteio)
   {

//   GERANDO VETOR ONDE SER� GRAVADO OS N�MEROS SORTEADOS PARA APOSTA DE 15 ou 16 N�MEROS
// ALTERA��O QUANTIDADE SORTEADA CONFORME TIPO DE APOSTA: 15 ou 16 dezenas
// Preservando o sorteio da tupla_1 com 4 ou 5 dezenas respectivamente
   if ($tipo_aposta_rec==1) {
//Aposta de 15 dezenas
    $tipo_ap=4;
    $quant_ap=5;
   }
   if ($tipo_aposta_rec==2) {
//Aposta de 16 dezenas
    $tipo_ap=5;
    $quant_ap=6;
   }

 $t=0;
 while ($t<$quant_ap){
  for ($e=0; $e<=14; $e++) {
  $gera[$e] = rand(1,25);
    }
  $unico_gera = array_unique($gera);
  $indice_gera = array_keys($unico_gera);
  $x = count($indice_gera);
  for ($y=0; $y<$x; $y++) {
   $gera_final[$y]= $unico_gera[$indice_gera[$y]];

     } //  FIM for

  $i=0;
  for ($y=0; $y<$x; $y++)  {
    for ($e=0; $e<=14; $e++) {
      if ($gera_final[$y] == $vetsort_rec[$e] && $gera_final[$y] != $sorteio[$e]) {
        $sort_prov[$i]=$vetsort_rec[$e];
        $sorteio[$i+$tipo_ap]=$vetsort_rec[$e];  // Aqui foi aplicada ($tipo_ap) a preserva��o do sorteio da tupla_1
        $i=$i+1;
    }
    } // Fim for
  } // Fim for

   $t=count($sort_prov);
 }  // FIM while
 
// ALTERA��O QUANTIDADE SORTEADA CONFORME TIPO DE APOSTA: 15 ou 16 dezenas
 if ($tipo_aposta_rec==1) {
 // Aposta de 15 dezenas
  $q_tupla_sort=8;
  }
   if ($tipo_aposta_rec==2) {
 // Aposta de 16 dezenas
  $q_tupla_sort=10;
  }
 //Limpando o vetor sorteio dos sorteios das dezenas excedidas
 // O vertor $sorteio vai para a sub_classe agregada "Vetor_N�o_sorteados"
 for ($y=0; $y<=14; $y++) {
     if ($y>$q_tupla_sort) {
        $sorteio[$y]=null ;
        }
     }
     
       return $sorteio;
       
    } // Fim func�o random_vetsort
   }  //Fim Classe Vetor_nrsorteados

  class Vetor_NAO_sorteados extends Quadro_loto
  {
   function gerar_vet_N_sort($result_e)
    {
   //  GERANDO  VETOR NRS ***N�O*** SORTEADOS DO RESULTADO DO �LTIMO CONCURSO
     $x=0;
     for ($z=0; $z<=9; $z++) {
       $vet_N_sort[$z] = ($x = $x+1);
     }
   // FIM GERA��O

   //   GRAVANDO RESULTADO DO �LTMO CONCURSO NO VETOR DE NRS ***N�O*** SORTEADOS
   $i=0;
   for ($y=1; $y<=25; $y++)  {
    if ($result_e[$y][2]== 0) {
       $vet_N_sort[$i]=$result_e[$y][1];
       $i=$i+1;
    }
   } // Fim for

    return $vet_N_sort;

  }  // Fim fun��o gerar_vet_N_sort


  function random_vetNsort($vetsort_rec, $tipo_aposta_rec, $sorteio)
   {

  if ($tipo_aposta_rec==1) {
 // Aposta de 15 dezenas
   $quant_final=3;
   $sort_final=9;
   $imp_sort=14;
  }
   if ($tipo_aposta_rec==2) {
 // Aposta de 16 dezenas
   $quant_final=4;
   $sort_final=11;
   $imp_sort=15;
  }

  for ($s=0; $s<=$quant_final; $s++){
    for ($y=0; $y<=9; $y++) {
     if ($sorteio[$s] == $vetsort_rec[$y]){
      $vetsort_rec[$y] = 0;
     }
    }
  }

  $n=0;
  for ($y=0; $y<=9; $y++) {
   if ($vetsort_rec[$y]!=0){
      $vetsort_novo[$n] = $vetsort_rec[$y];
      $n=$n+1;
      }
   }

  $x=count($vetsort_novo );
  $i=0;
  for ($e=0; $e<$x; $e++) {
       $sort_prov[$i]=$vetsort_novo[$e];
        $sorteio[$i+$sort_final]=$vetsort_novo[$e];  // Aqui foi aplicada ($tipo_ap) a preserva��o do sorteio da tupla_1
       $i=$i+1;
  } // Fim for

    // ORDENA��O DO RESULTADO NUM�RICO EM ORDEM CRESCENTE
     $i=0;
     natsort($sorteio);
     foreach ($sorteio as $sort) {
     $sorteio_ord[$i] = $sort;
     $i=$i+1;
     }
      return $sorteio_ord;
    } // Fim func�o random_vetNsort
   }  //Fim Classe Vetor_NAO_sorteados


 // SELECIONA USUARIO
 class Login extends Conexao
 {    //private

	   function login2()
	   {
	   $usuario = $_POST['usuario'];
       $senha = $_POST['senha'];

	   $sql_usuario = " select * from usuario where usuario = '$usuario'
             		    and senha = '$senha' ";
		   $result_usuario = mysql_query($sql_usuario) or die($mensagem='ERRO !!!!');

           while($linha_usuario = mysql_fetch_array($result_usuario)) {

		    if ($linha_usuario["usuario"] != "")
		   {    $usuario = $linha_usuario["usuario"];
		        header("location:sistema_lotofacil.php?usuario=$usuario");
              exit;
		   }
            }
 		  return $sucesso='ERRO !!! Senha e/ou Usuario errados, TECLE VOLTAR DO NAVEGADOR  !!!';
       }
 }

// TELAS - Monta as telas necess�rias para a aplica��o
 class Tela
 {    private
	 $acao,
     $titulo;
 
  function abreHtml($titulo)
  {
    $resultado="
     <HTML>
       <HEAD>
        <TITLE>$titulo</TITLE>
        <META HTTP-EQUIV='Content-Type' CONTENT='text/html; charset=iso-8859-1'>
  	   </HEAD>
       <BODY BGCOLOR='#FFDEAD' TEXT='#000000'> ";
     return $resultado;
  }
  
   function fechaHtml()
   {$resultado="
     </BODY>
     </HTML>  ";
    return $resultado;
   }
 
   function abreFormulario($acao)
   { $resultado="<FORM METHOD=POST ACTION='$acao'>"; 
     return $resultado;   
   }
   function fechaFormulario()
   { $resultado="</FORM>";
     return $resultado;
   }
   function abreTabela()
   {  $resultado="<TABLE align='center'>";
     return $resultado;
   }
  function fechaTabela()
  {  $resultado="</TABLE>";
     return $resultado;
  }
  function botaoOkLimpar()
   { $resultado="
     <tr>
     <td colspan='2'>
     <INPUT TYPE='submit' NAME='ENVIAR' VALUE='ENVIAR'><INPUT TYPE='reset'>
     </td>
     </tr>
   ";
     return $resultado;
   }

  function botaoExcluir()
   { $resultado="
     <tr>
     <td colspan='2'>
     <INPUT TYPE='submit' NAME='EXCLUIR' VALUE='EXCLUIR'>
     </td>
     </tr>
    ";
     return $resultado;
   }

   // TELA/Fun��o criada somente para importar o arquivo TXT com
   // resultados de todos os concursos anteriores - LOTO F�CIL
   function Ler_TXT() {

    $resultado="
    <HTML lang='pt-br'>
	  <head>
		<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
		<meta http-equiv='content-type' content='text/html; charset=UTF-8'/>
		<title>Importar TXT</title>
	  </head>
	  <body>
		<!--Titulo do Formul�rio-->
		<h1>Importar dados do arquivo TXT</h1>
		<!--Formul�rio com PHP para fazer upload de arquivo com PHP-->
		<form method='POST' action='processa.php' enctype='multipart/form-data'>
			<label>Arquivo</label>
			<!--Campo para fazer o upload do arquivo com PHP-->
			<input type='file' name='arquivo'><br><br>
			<input type='submit' value='Importar'>
		</form>
	  </body>
   </HTML>
";
    return $resultado;

   }

  function linha_Menu($usuario)
   { $resultado="
     <TABLE align='center'>
     <tr>
     <td  align='center'><font color='#CC0033'>
     <A HREF='sistema_lotofacil.php?usuario=$usuario'>Voltar para MENU PRINCIPAL</A>
     </font>
     </td>
     </tr>
     </table>
    ";
     return $resultado;
   }
   
  function linha_Menu_apostador($usuario)
   { $resultado="
     <TABLE align='left'>
     <tr>
     <td  align='left'><font color='#CC0033'>
     <A HREF='sistema_lotofacil.php?usuario=$usuario'>Voltar para MENU PRINCIPAL</A>
     </font>
     </td>
     </tr>
     </table>
    ";
     return $resultado;
   }
   
  function linha_Sair()
   { $resultado="
     <TABLE align='center'>
     <tr>
     <td  align='center'><font color='#CC0033'>
     <A HREF='index.php'>SAIR</A>
     </font>
     </td>
     </tr>
     </table>
    ";
     return $resultado;
   }

  function tela_formulario($result_loc,$tabela,$nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,
   $dez_08,$dez_09,$dez_10,$dez_11,$dez_12,$dez_13,$dez_14,$dez_15,$usuario)
   {
     if ($tabela=="conc_ant") {
	    $titulo="CADASTRO CONCURSO ANTERIORES";
     }

   if (!($result_loc=="")) {
   
    $linha = mysql_fetch_array($result_loc);
    $cod_conc = $linha["cod_conc"];
    $nr_concurso = $linha["nr_concurso"];
    $dez_01 = $linha["dez_01"];
    $dez_02 = $linha["dez_02"];
    $dez_03 = $linha["dez_03"];
    $dez_04 = $linha["dez_04"];
    $dez_05 = $linha["dez_05"];
    $dez_06 = $linha["dez_06"];
    $dez_07 = $linha["dez_07"];
    $dez_08 = $linha["dez_08"];
    $dez_09 = $linha["dez_09"];
    $dez_10 = $linha["dez_10"];
    $dez_11 = $linha["dez_11"];
    $dez_12 = $linha["dez_12"];
    $dez_13 = $linha["dez_13"];
    $dez_14 = $linha["dez_14"];
    $dez_15 = $linha["dez_15"];

    $tabtela=$tabela;

    } else {

    $cod_conc = null;
    $nr_concurso = null;
    $dez_01 = null;
    $dez_02 = null;
    $dez_03 = null;
    $dez_04 = null;
    $dez_05 = null;
    $dez_06 = null;
    $dez_07 = null;
    $dez_08 = null;
    $dez_09 = null;
    $dez_10 = null;
    $dez_11 = null;
    $dez_12 = null;
    $dez_13 = null;
    $dez_14 = null;
    $dez_15 = null;

    }
	  $resultado="
	   <TR>
	    <TD colspan='2'>$titulo</TD>
	    <INPUT TYPE='hidden'  NAME='cod_conc' VALUE='$cod_conc'>
	    <INPUT TYPE='hidden'  NAME='usuario' VALUE='$usuario'>
	   </TR>
	   <TR>
	    <TD>Apostador :</TD>
	  	<TD>$usuario</TD>
	   </TR>
	   <TR>
	 	<TD>Nr Conc</TD>
	 	<TD><INPUT TYPE='text' NAME='nr_concurso' VALUE='$nr_concurso'></TD>
	   </TR>
  	   <TR>
        <TD>&nbsp</TD>
	   </TR>
	   <TR>
	 	<TD>Dez 01</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_01' VALUE='$dez_01'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 02</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_02' VALUE='$dez_02'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 03</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_03' VALUE='$dez_03'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 04</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_04' VALUE='$dez_04'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 05</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_05' VALUE='$dez_05'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 06</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_06' VALUE='$dez_06'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 07</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_07' VALUE='$dez_07'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 08</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_08' VALUE='$dez_08'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 09</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_09' VALUE='$dez_09'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 10</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_10' VALUE='$dez_10'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 11</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_11' VALUE='$dez_11'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 12</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_12' VALUE='$dez_12'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 13</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_13' VALUE='$dez_13'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 14</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_14' VALUE='$dez_14'></TD>
	   </TR>
	   <TR>
	 	<TD>Dez 15</TD>
	 	<TD><INPUT TYPE='text' NAME='dez_15' VALUE='$dez_15'></TD>
	   </TR>
             ";
        
      return $resultado;
    }

  function tela_form_usuario($result_loc,$tabela,$nome_usuario,$senha,$usuario)
   {
    if ($tabela=="usuario"){
	    $titulo="CADASTRO USUÁRIO APOSTADOR";
     }
   if (!($result_loc=="")) {
    $linha = mysql_fetch_array($result_loc);
    //$cod_conc=null;
    $cod_usuario = $linha["cod_usuario"];
    $nome_usuario = $linha["usuario"];
    $senha = $linha["senha"];

    } else {

    $cod_usuario = null;
    $nome_usuario = null;
    $senha = null;

    }
	  $resultado="
	  <TR>
	 	<TD colspan='2'><font color='#003399'>$titulo</font></TD>
	  <INPUT TYPE='hidden'  NAME='cod_usuario' VALUE='$cod_usuario'>
	  <INPUT TYPE='hidden'  NAME='usuario' VALUE='$usuario'>
	  <TR>
	 	<TD>Login</TD>
	 	<TD><INPUT TYPE='text' NAME='nome_usuario' VALUE='$nome_usuario'></TD>
	  </TR>
	  <TR>
	 	<TD>Senha</TD>
	 	<TD><INPUT TYPE='text' NAME='senha' VALUE='$senha'></TD>
	  </TR>
             ";

	if ($tabela=="medico") {
     $resultado.="
       <TR>
	 	<TD>Crm</TD>
	 	<TD><INPUT TYPE='text' NAME='crm' VALUE='$crm'></TD>
	  </TR> ";
	  }
      return $resultado;
	}

    function tela_lista_concurso($r_result,$tabela,$arq_php_conc,$arq_php_mov,$usuario)
	{
    if ($tabela=="conc_ant"){
	    $titulo="Concursos Anteriores - LOTOFACIL";
	  }
        
    $retornotela="<p class='titulo'><font color='#003399' size='5'><b>$titulo &nbsp Apostador: $usuario</b></font></p>";

//    <td width='20' align='center'><font color='#CC0033'>#</font></td>

    $retornotela.="
        <table width='100%' border='1'>
        <tr>
          <td width='20' align='center'><font color='#CC0033'>conc</font></td>
          <td width='20' align='center'><font color='#CC0033'>01</font></td>
          <td width='20' align='center'><font color='#CC0033'>02</font></td>
          <td width='20' align='center'><font color='#CC0033'>03</font></td>
          <td width='20' align='center'><font color='#CC0033'>04</font></td>
          <td width='20' align='center'><font color='#CC0033'>05</font></td>
          <td width='20' align='center'><font color='#CC0033'>06</font></td>
          <td width='20' align='center'><font color='#CC0033'>07</font></td>
          <td width='20' align='center'><font color='#CC0033'>08</font></td>
          <td width='20' align='center'><font color='#CC0033'>09</font></td>
          <td width='20' align='center'><font color='#CC0033'>10</font></td>
          <td width='20' align='center'><font color='#CC0033'>11</font></td>
          <td width='20' align='center'><font color='#CC0033'>12</font></td>
          <td width='20' align='center'><font color='#CC0033'>13</font></td>
          <td width='20' align='center'><font color='#CC0033'>14</font></td>
          <td width='20' align='center'><font color='#CC0033'>15</font></td>
                                                                                     ";
	if ($tabela=="conc_ant") {
	 $retornotela.="
     	  <td width='25' valign='top'><font color='#CC0033'>Novo</font></td>
		  <td width='32' valign='top'><font color='#CC0033'>Alterar</font></td>
		  <td width='31' valign='top'><font color='#CC0033'>Excluir</font></td>    ";
		  }
	$retornotela.="
        </tr>
      </table>
    ";

   while ($linha = mysql_fetch_array($r_result)) {

    $cortabela="#ADFF2F";
    

    if ($tabela=="conc_ant") {
     $cod_conc = $linha["cod_conc"];
     $nr_concurso = $linha["nr_concurso"];
     $dez_01 = $linha["dez_01"];
     $dez_02 = $linha["dez_02"];
     $dez_03 = $linha["dez_03"];
     $dez_04 = $linha["dez_04"];
     $dez_05 = $linha["dez_05"];
     $dez_06 = $linha["dez_06"];
     $dez_07 = $linha["dez_07"];
     $dez_08 = $linha["dez_08"];
     $dez_09 = $linha["dez_09"];
     $dez_10 = $linha["dez_10"];
     $dez_11 = $linha["dez_11"];
     $dez_12 = $linha["dez_12"];
     $dez_13 = $linha["dez_13"];
     $dez_14 = $linha["dez_14"];
     $dez_15 = $linha["dez_15"];
   }
  // if($nr_concurso == 2794) {
  //   $cortabela="#FFFF00";
  // }

// <td width='20' valign='top' align='center'>$cod_conc</td>
   $retornotela.="
        <table width='100%' border='1' bgcolor='$cortabela'>
          <tr>
            <td width='20' valign='top' align='center'>$nr_concurso</td>
            <td width='20' valign='top' align='center'>$dez_01</td>
            <td width='20' valign='top' align='center'>$dez_02</td>
            <td width='20' valign='top' align='center'>$dez_03</td>
            <td width='20' valign='top' align='center'>$dez_04</td>
            <td width='20' valign='top' align='center'>$dez_05</td>
            <td width='20' valign='top' align='center'>$dez_06</td>
            <td width='20' valign='top' align='center'>$dez_07</td>
            <td width='20' valign='top' align='center'>$dez_08</td>
            <td width='20' valign='top' align='center'>$dez_09</td>
            <td width='20' valign='top' align='center'>$dez_10</td>
            <td width='20' valign='top' align='center'>$dez_11</td>
            <td width='20' valign='top' align='center'>$dez_12</td>
            <td width='20' valign='top' align='center'>$dez_13</td>
            <td width='20' valign='top' align='center'>$dez_14</td>
            <td width='20' valign='top' align='center'>$dez_15</td>
                                                                     ";
        if ($tabela=="conc_ant") {
           $retornotela.="
            <td width='25' valign='top'><a href='$arq_php_conc?usuario=$usuario'>Novo</a></td>
            <td width='32' valign='top'><a href='$arq_php_mov?cod=$cod_conc&usuario=$usuario&ALTERAR=true'>Alterar</a></td>
            <td width='31' valign='top'><a href='$arq_php_mov?cod=$cod_conc&usuario=$usuario&EXCLUIR=true'>Excluir</a></td>  ";
            }
   }
     return $retornotela;
 }



    function tela_aposta_concant($r_result)
	{
	
	  $retorno_linhas  = mysql_num_rows($r_result);
	
     if ($retorno_linhas==0){
	    $titulo="Sorteio acima <font color='#CC0033'>ATÉ HOJE NÃO FOI REPETIDO</font>  -
       Vefique ÚLTIMO CONCURSO cadastrado no sistema. '<font color='#CC0033'>APOSTA ÚNICA GERADA - APOSTA BOA !!!</font>'";
	 }  else {
   	    $titulo="Sorteio <font color='#CC0033'>REPETIDO</font> pelo concurso abaixo -
        Anote o resultado ou faça outro jogo clicando no link '<font color='#CC0033'>Voltar para MENU PRINCIPAL</font>'";
     }

     $retornotela="<p class='titulo'><font color='#003399' size='5'><b>$titulo</b></font></p>";
     if ($retorno_linhas>0){
     $retornotela.="
        <table width='100%' border='1'>
        <tr>
          <td width='20' align='center'><font color='#CC0033'>#</font></td>
          <td width='20' align='center'><font color='#CC0033'>conc</font></td>
          <td width='20' align='center'><font color='#CC0033'>01</font></td>
          <td width='20' align='center'><font color='#CC0033'>02</font></td>
          <td width='20' align='center'><font color='#CC0033'>03</font></td>
          <td width='20' align='center'><font color='#CC0033'>04</font></td>
          <td width='20' align='center'><font color='#CC0033'>05</font></td>
          <td width='20' align='center'><font color='#CC0033'>06</font></td>
          <td width='20' align='center'><font color='#CC0033'>07</font></td>
          <td width='20' align='center'><font color='#CC0033'>08</font></td>
          <td width='20' align='center'><font color='#CC0033'>09</font></td>
          <td width='20' align='center'><font color='#CC0033'>10</font></td>
          <td width='20' align='center'><font color='#CC0033'>11</font></td>
          <td width='20' align='center'><font color='#CC0033'>12</font></td>
          <td width='20' align='center'><font color='#CC0033'>13</font></td>
          <td width='20' align='center'><font color='#CC0033'>14</font></td>
          <td width='20' align='center'><font color='#CC0033'>15</font></td>
                                                                                     ";
	$retornotela.="
        </tr>
      </table>
    ";
     }

   while ($linha = mysql_fetch_array($r_result)) {

    $cortabela="#ADFF2F";

     $cod_conc = $linha["cod_conc"];
     $nr_concurso = $linha["nr_concurso"];
     $dez_01 = $linha["dez_01"];
     $dez_02 = $linha["dez_02"];
     $dez_03 = $linha["dez_03"];
     $dez_04 = $linha["dez_04"];
     $dez_05 = $linha["dez_05"];
     $dez_06 = $linha["dez_06"];
     $dez_07 = $linha["dez_07"];
     $dez_08 = $linha["dez_08"];
     $dez_09 = $linha["dez_09"];
     $dez_10 = $linha["dez_10"];
     $dez_11 = $linha["dez_11"];
     $dez_12 = $linha["dez_12"];
     $dez_13 = $linha["dez_13"];
     $dez_14 = $linha["dez_14"];
     $dez_15 = $linha["dez_15"];

   $retornotela.="
        <table width='100%' border='1' bgcolor='$cortabela'>
          <tr>
            <td width='20' valign='top' align='center'>$cod_conc</td>
            <td width='20' valign='top' align='center'>$nr_concurso</td>
            <td width='20' valign='top' align='center'>$dez_01</td>
            <td width='20' valign='top' align='center'>$dez_02</td>
            <td width='20' valign='top' align='center'>$dez_03</td>
            <td width='20' valign='top' align='center'>$dez_04</td>
            <td width='20' valign='top' align='center'>$dez_05</td>
            <td width='20' valign='top' align='center'>$dez_06</td>
            <td width='20' valign='top' align='center'>$dez_07</td>
            <td width='20' valign='top' align='center'>$dez_08</td>
            <td width='20' valign='top' align='center'>$dez_09</td>
            <td width='20' valign='top' align='center'>$dez_10</td>
            <td width='20' valign='top' align='center'>$dez_11</td>
            <td width='20' valign='top' align='center'>$dez_12</td>
            <td width='20' valign='top' align='center'>$dez_13</td>
            <td width='20' valign='top' align='center'>$dez_14</td>
            <td width='20' valign='top' align='center'>$dez_15</td>
                                                                     ";
   }
     return $retornotela;
 }




  function tela_lista_usuario($r_result,$tabela,$arq_php_conc,$arq_php_mov,$usuario)
	{
    if ($tabela=="usuario"){
	    $titulo="Usuário(s) Apostador(es) - SISTEMA LOTOFACIL";
	  }

    $retornotela="<p class='titulo'><font color='#003399' size='5'><b>$titulo &nbsp Apostador: $usuario</b></font></p>";

    $retornotela.="
        <table width='50%' border='1'>
        <tr>
          <td width='100' align='center'><font color='#CC0033'>#</font></td>
          <td width='200' align='center'><font color='#CC0033'>Nome</font></td>
          <td width='200' align='center'><font color='#CC0033'>Senha</font></td>
                       ";
	if ($tabela=="usuario") {
	 $retornotela.="
     	  <td width='100' align='top'><font color='#CC0033'>Novo</font></td>
		  <td width='100' align='top'><font color='#CC0033'>Alterar</font></td>
		  <td width='100' align='top'><font color='#CC0033'>Excluir</font></td>
                       ";
		  }
	 $retornotela.="
         </tr>
         </table>
                       ";
   while ($linha = mysql_fetch_array($r_result)) {

    $cortabela="#ADFF2F";

    if ($tabela=="usuario") {
     $cod_usuario = $linha["cod_usuario"];
     $nome_usuario = $linha["usuario"];
     $senha = $linha["senha"];
   }

   $retornotela.="
        <table width='50%' border='1' bgcolor='$cortabela'>
          <tr>
            <td width='100' valign='top' align='center'>$cod_usuario</td>
            <td width='200' valign='top' align='center'>$nome_usuario</td>
            <td width='200' valign='top' align='center'>$senha</td>
                                                                     ";
        if ($tabela=="usuario") {
           $retornotela.="
            <td width='100' valign='top'><a href='$arq_php_conc?usuario=$usuario'>Novo</a></td>
            <td width='100' valign='top'><a href='$arq_php_mov?cod=$cod_usuario&usuario=$usuario&ALTERAR=true'>Alterar</a></td>
            <td width='100' valign='top'><a href='$arq_php_mov?cod=$cod_usuario&usuario=$usuario&EXCLUIR=true'>Excluir</a></td>  ";
            }
    }
     return $retornotela;
 }


    function tela_resultado($r_result,$tipo_aposta_rec,$usuario)
	{
      if ($tipo_aposta_rec==1){
	    $titulo="Aposta de 15 dezenas - LOTOFACIL";
	  }
      if ($tipo_aposta_rec==2){
	    $titulo="Aposta de 16 dezenas - LOTOFACIL";
	  }

    $retornotela="<p class='titulo'><font color='#003399' size='5'><b>$titulo &nbsp Apostador: $usuario</b></font></p>";

    $retornotela.="
        <table width='100%' border='1'>
        <tr>
          <td width='20' align='center'><font color='#CC0033'>01</font></td>
          <td width='20' align='center'><font color='#CC0033'>02</font></td>
          <td width='20' align='center'><font color='#CC0033'>03</font></td>
          <td width='20' align='center'><font color='#CC0033'>04</font></td>
          <td width='20' align='center'><font color='#CC0033'>05</font></td>
          <td width='20' align='center'><font color='#CC0033'>06</font></td>
          <td width='20' align='center'><font color='#CC0033'>07</font></td>
          <td width='20' align='center'><font color='#CC0033'>08</font></td>
          <td width='20' align='center'><font color='#CC0033'>09</font></td>
          <td width='20' align='center'><font color='#CC0033'>10</font></td>
          <td width='20' align='center'><font color='#CC0033'>11</font></td>
          <td width='20' align='center'><font color='#CC0033'>12</font></td>
          <td width='20' align='center'><font color='#CC0033'>13</font></td>
          <td width='20' align='center'><font color='#CC0033'>14</font></td>
          <td width='20' align='center'><font color='#CC0033'>15</font></td>
                                                                                     ";
 if ($tipo_aposta_rec==2){
	 $retornotela.="
	      <td width='20' align='center'><font color='#CC0033'>16</font></td> ";
		  }
	$retornotela.="
        </tr>
      </table>
    ";

    $cortabela="#ADFF2F";

   if ($tipo_aposta_rec==2){
     $dez_16 = $r_result[15];
     }
     $dez_01 = $r_result[0];
     $dez_02 = $r_result[1];
     $dez_03 = $r_result[2];
     $dez_04 = $r_result[3];
     $dez_05 = $r_result[4];
     $dez_06 = $r_result[5];
     $dez_07 = $r_result[6];
     $dez_08 = $r_result[7];
     $dez_09 = $r_result[8];
     $dez_10 = $r_result[9];
     $dez_11 = $r_result[10];
     $dez_12 = $r_result[11];
     $dez_13 = $r_result[12];
     $dez_14 = $r_result[13];
     $dez_15 = $r_result[14];


   $retornotela.="
        <table width='100%' border='1' bgcolor='$cortabela'>
          <tr>
            <td width='20' valign='top' align='center'>$dez_01</td>
            <td width='20' valign='top' align='center'>$dez_02</td>
            <td width='20' valign='top' align='center'>$dez_03</td>
            <td width='20' valign='top' align='center'>$dez_04</td>
            <td width='20' valign='top' align='center'>$dez_05</td>
            <td width='20' valign='top' align='center'>$dez_06</td>
            <td width='20' valign='top' align='center'>$dez_07</td>
            <td width='20' valign='top' align='center'>$dez_08</td>
            <td width='20' valign='top' align='center'>$dez_09</td>
            <td width='20' valign='top' align='center'>$dez_10</td>
            <td width='20' valign='top' align='center'>$dez_11</td>
            <td width='20' valign='top' align='center'>$dez_12</td>
            <td width='20' valign='top' align='center'>$dez_13</td>
            <td width='20' valign='top' align='center'>$dez_14</td>
            <td width='20' valign='top' align='center'>$dez_15</td>
                                                                     ";
        if ($tipo_aposta_rec==2){
           $retornotela.="
            <td width='20' valign='top' align='center'>$dez_16</td> ";
            }
            
     return $retornotela;
 }


  // tela para localiza��o do usu�rio  ou cadastro de concursos anteriores
  function telaLocalizacao($tabela,$nr_concurso,$usuario)
   {
      if ($tabela=="Lotofacil"){
	    $titulo="SISTEMA - LOTOFACIL";
	  } elseif ($tabela=="Apostador") {
	    $titulo="CADASTRO APOSTADOR";
	  }

     $resultado="
	 <TR>
	 <TD colspan='2'><font color='#003399'><b>$titulo</b></font></TD>
	 </TR>
	 <TR>
	 <TD colspan='2'><font color='#003399'>Apostador: $usuario</font></TD>
	 </TR>
	 <TR>
	 <TD colspan='2'>&nbsp;</TD>
	 </TR>
            ";
    if ($tabela=="Lotofacil") {
     $resultado.="
      <TR>
	  <TD>Digite nr concurso abaixo .</TD>
	  </TR>
           ";
     }
    if ($tabela=="Apostador") {
     $resultado.="
      <TR>
	  <TD>Digite nome Apostador abaixo .</TD>
	  </TR>
           ";
     }
     $resultado.="
 	 <TR>
	 <TD>Não preencher campo para listar TODOS :</TD>
   	 </TR>
   	 <TR>
	 <TD><INPUT TYPE='text' NAME='nr_concurso' VALUE=''></TD>
	 </TR>  ";
     if ($tabela=="Lotofacil") {
      $resultado.="
  	  <TR>
	  <TD>Ex: 2800 ou deixar vazio para todos</TD>
  	  </TR>
	  <INPUT TYPE='hidden' NAME='usuario' VALUE='$usuario'>
            ";
	 }
	 if ($tabela=="Apostador") {
      $resultado.="
  	  <TR>
	  <TD>Ex: jose ou deixar vazio</TD>
  	  </TR>
	  <INPUT TYPE='hidden' NAME='usuario' VALUE='$usuario'>
	        ";
	 }
     return $resultado;
	}

  function telaTipo_aposta($usuario)
 	{
     $titulo="TELA APOSTA - SISTEMA LOTOFACIL";

	 $resultado="
     <TR>
	 <TD colspan='2'><font color='#003399'><b>$titulo</b></font></TD>
	 </TR>
	 <TR>
	 <TD colspan='2'><font color='#003399'>Apostador: $usuario</font></TD>
	 </TR>
  	 <TR>
	 <TD>Escolher o tipo aposta (15 ou 16 Dezenas) :</TD>
   	 </TR>
	 <TR>
	 <TD colspan='2'>
     <SELECT name='tipo_aposta'>
     <OPTION value=1 selected>15 dezenas</OPTION>
     <OPTION value=2>16 dezenas</OPTION>
  ";
	 $resultado.="
     </SELECT>
     </TD>
     </TR>
     <INPUT TYPE='hidden' NAME='usuario' VALUE='$usuario'>
	 ";
     return $resultado;

	}

// TELA LOGIN
  function telaLogin($usuario,$senha)
 	{
     $titulo="TELA LOGIN - SISTEMA LOTOFACIL";
     
	 $resultado="
	 <TR>
	 <TD colspan='2'><font color='#003399'><b>$titulo</b></font></TD>
	 </TR>
	 <TR>
	 <TD>USUARIO</TD>
	 <TD><INPUT TYPE='text' NAME='usuario' VALUE='$usuario'></TD>
	 </TR>
	 <TR>
	 <TD>SENHA</TD>
	 <TD><INPUT TYPE='password' NAME='senha' VALUE='$senha'></TD>
	 </TR>
     <TR>
	 ";
     return $resultado;
	}

 }
 
 ?>

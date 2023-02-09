
<HTML>
<HEAD>
    <style>
.botoes {
    background: none repeat scroll 0 0 #909090;
    border: 1px solid #303030;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 70px;
    text-decoration: none;
}
.botoes:hover, .botoes:focus {
    background: none repeat scroll 0 0 #ffff00;
}        
.bd {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #909090;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: auto;
    text-decoration: none;
}
.bd:hover, .bd:focus {
    background: none repeat scroll 0 0 #ffff00;
}        
.btimagemvermelho {
    background: none repeat scroll 0 0 #600000;
    border: 1px solid #fff;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #fff;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 100px;
    text-decoration: none;
}
.btimagemvermelho:hover, .btimagemvermelho:focus {
    background: none repeat scroll 0 0 #ffff00;
    color: #000;
}        
.btimagemverde {
    background: none repeat scroll 0 0 #006000;
    border: 1px solid #000;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 100px;
    text-decoration: none;
}
.btimagemverde:hover, .btimagemverde:focus {
    background: none repeat scroll 0 0 #ffff00;
}        

#wrapper table tr td {
    background-color: white;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    font-size: 10px;
    color: black;
    padding: 1px;
    vertical-align: top;
}
#wrapper table tr th.finalsemana {
    background-color: #800000;
    border-bottom: 1px solid #000000;
    border-left: 1px solid #000000;
    border-right: 0 none;
    color: white;
    font-size: 11px;
    font-weight: bold;
    text-decoration: none;
    vertical-align: top;
}
#wrapper table tr th.diasemana {
    background-color: #d0e0f0;
    border-bottom: 1px solid #000000;
    border-left: 1px solid #000000;
    border-right: 0 none;
    color: black;
    font-size: 11px;
    font-weight: bold;
    text-decoration: none;
    vertical-align: top;
}
#wrapper table tr td.diavalido {
    background-color: #efFFef;
    border-bottom: 1px solid #000000;
    border-left: 1px solid #000000;
    border-right: 0 none;
    color: black;
    font-size: 11px;
    font-weight: bold;
    text-decoration: none;
    vertical-align: top;
}

</style>
<script type="text/javascript">
//<![CDATA[
	function obterDados(data, tipo, divisao) {
		window.open('<?php echo $this->webroot; ?>chamadas/indexPdf/'+data+'/'+tipo+'/'+divisao);
    }
		
		//]]>

</script>
</HEAD>
<BODY link=black vlink=black alink=black>
<?php
//gera calendario
 $raiz = $this->webroot.'chamadas/externocalendario';
 $imagem = $this->webroot.'webroot/img/';
 
function dia_pascoa($a){
    //fabioissamu@yahoo.com Fabio Issamu Oshiro
    //retorna a páscoa
    if ($a<1900){$a+=1900;}
    $c = floor($a/100);
    $n = $a - (19*floor($a/19));
    $k = floor(($c - 17)/25);
    $i = $c - $c/4 - floor(($c-$k)/3) +(19*$n) + 15;
    $i = $i - (30*floor($i/30));
    $i = $i - (floor($i/28)*(1-floor($i/28))*floor(29/($i+1))*floor((21-$n)/11));
    $j = $a + floor($a/4) + $i + 2 -c + floor($c/4);
    $j = $j - (7* floor($j/7));
    $l = $i - $j;
    $m = 3 + floor(($l+40)/44);
    $d = $l + 28 - (31*floor($m/4));
    $retorno=mktime(0, 0, 0, $m, $d-1, $a);
    return $retorno;
}

function calendario($raiz, $imagem, $dados){
    //Variável de retorno do código em HTML
    $retorno="";

    //Primeira linha do calendário
    $arr_dias=Array("Dom","Seg","Ter","Qua","Qui","Sex","Sáb");

    //Deseja iniciar pelo sábado?
    $ini_sabado=false;

    //Feriados comuns
    $feriados["1-1"]="Confraternização Universal";
    $feriados["21-4"]="Tiradentes";
    $feriados["15-11"]="Proclamação da República";
    $feriados["2-11"]="Finados";
    $feriados["1-5"]="Dia do Trabalho";
    $feriados["7-9"]="Dia da Independência";
    $feriados["12-10"]="N.S. Aparecida";
    //$feriados["15-10"]="Dia dos Professores";
    $feriados["25-12"]="Natal";

    //mes e ano do calendario a ser montado
    If($_GET['mes'] and $_GET['ano'])
    {
       $mes = $_GET['mes'];
      
       $ano = $_GET['ano'];
    }
    Else
    {
       $mes = date("m");
       $ano = date("Y");
    }

    //Feriados com data mutante
    $pascoa=dia_pascoa($ano);
    $feriados[date("j-n", $pascoa)]="Páscoa";
    $feriados[date("j-n", $pascoa-86400*2)]="Paixão";
    $feriados[date("j-n", $pascoa-86400*46)]="Cinzas";
    $feriados[date("j-n", $pascoa-86400*47)]="Carnaval";
    $feriados[date("j-n", $pascoa+86400*60)]="Corpus Christi";

    $cont_mes = 1; 
    if ($ini_sabado){
        $dia_semana = converte_dia(date("w", mktime(0, 0, 0, $mes, 1, $ano))); //dia da semana do primeiro dia do mes
    }else{
        //Comum
        $dia_semana = date("w", mktime(0, 0, 0, $mes, 1, $ano)); 
    }
    $t_mes = date("t", mktime(0, 0, 0, $mes, 1, $ano)); //no. total de dias no mes

    //dados do mes passado
    $dia_semana_ant = ((date("d", mktime(0, 0, 0, $mes, 0, $ano))+1)-$dia_semana); 
    $mes_ant = date("m", mktime(0, 0, 0, $mes, 0, $ano));
    $ano_ant = date("Y", mktime(0, 0, 0, $mes, 0, $ano));

    //dados do mes seguinte
    $dia_semana_post = 1;
    $mes_post = date("m", mktime(0, 0, 0, $mes, $t_mes+1, $ano));  
    $ano_post = date("Y", mktime(0, 0, 0, $mes, $t_mes+1, $ano));  

    $retorno.="<center>";

    //titulo do calendario
    $retorno .= "<font style=\"font-family:verdana,arial,serif;font-size:16\"><b>Calendário para controle de chamadas: ".converte_mes($mes)."/".$ano."</b></font><br>";

    //montagem do calendario
    $retorno.= "<table><tr><td> </td><td>";

    $retorno.= "<table border=1 width=580 cellpadding=5 cellspacing=5 style='border-collapse: collapse'  id=AutoNumber1 bordercolor=#333333><thead>";
    //primeira linha do calendario
    $retorno.= "<tr>";
    for($i=0;$i<7;$i++){
        if ($i==0 || $i==6){
            //é domingo ou sábado
            $retorno.= "<th class='finalsemana'>$arr_dias[$i]</th>";
        }else{
            $retorno.= "<th class='diasemana'>$arr_dias[$i]</th>";
        }
    }
    $cont_cor = 0;
    While ($t_mes >= $cont_mes)
    {
       $cont_semana = 0;
       $retorno.= "<tr></thead>";
       If ($dia_semana == 7)
       {
          $dia_semana = 0;
       }
       If(($cont_cor%2)!=0) //alterna cor das linhas
       {
          $cor = "#F0F0F0";
       }
       Else
       {
          $cor = "#F8F8F8";
       }
       
       While ($dia_semana < 7)
       {
          If ($cont_mes <= $t_mes)
          {
             If ($dia_semana == $cont_semana) //celulas de dias do mes
             {
                $retorno.= "<td class='diavalido' valign=top bgcolor=".$cor." width=110 height=70>";
                $retorno.= "<font face=verdana,arial,serif size=2><b>".$cont_mes."</b><br>";

                /************************************************************/
                /******** Conteudo do calendario, se tiver, aqui!!!! ********/ 
                /************************************************************/
                $nome_feriado=$feriados[$cont_mes."-".((int)$mes)];
                if ($nome_feriado!=""){
                    $retorno.=  $nome_feriado;
                }else{
                	if($dados[strtotime($ano.'-'.$mes.'-'.$cont_mes)]['divisao']=='OPERACIONAL'){
                		$divisaotemp = 'DO';
                	}else{
                		$divisaotemp = 'OUTROS';
                	}
                    if(!empty($dados[strtotime($ano.'-'.$mes.'-'.$cont_mes)])){
                        $retorno .= "<a href='#' class='bd' onclick=\"obterDados('{$ano}-{$mes}-{$cont_mes}','{$dados[strtotime($ano.'-'.$mes.'-'.$cont_mes)]['nome_chamada']}','{$dados[strtotime($ano.'-'.$mes.'-'.$cont_mes)]['divisao']}');\">{$divisaotemp}[{$dados[strtotime($ano.'-'.$mes.'-'.$cont_mes)]['nome_chamada']}]</a><br>";
                    }else{
                       // $retorno .= "<a href='#' class='botoes' onclick=\"for(i=0;i<=10;i++){var inicio='inicio'+i;var termino='termino'+i;if(\$(inicio)!=null){\$(inicio).value='';\$(termino).value='';}}ShowContent('faltasinsere');\$('textodatai').innerHTML='{$cont_mes}-{$mes}-{$ano}';\$('datai').value='{$ano}-{$mes}-{$cont_mes}';\">EXPEDIENTE</a><br>";
                        
                    }
                }
                
                $retorno.= "</font></td>";
                $cont_mes++;
                $dia_semana++;
                $cont_semana++;
             }
             Else //celulas vazias no inicio (mes anterior)
             {
                $retorno.= "<td valign=top bgcolor=".$cor.">";
                $retorno.= "<font color=#AAAAAA face=verdana,arial,serif size=2>".$dia_semana_ant."</font>";
                $retorno.= "</td>";
                $cont_semana++;    
                $dia_semana_ant++;
             }
          }
          Else
          {
                While ($cont_semana < 7) //celulas vazias no fim (mes posterior)
                {
                    $retorno.= "<td valign=top bgcolor=".$cor.">";
                    $retorno.= "<font color=#AAAAAA face=verdana,arial,serif size=2>".$dia_semana_post."</font>";
                    $retorno.= "</td>";
                    $cont_semana++;    
                    $dia_semana_post++;
                }
         break 2;   
          }
       }
       $retorno.= "</tr>";
       $cont_cor++;
    }

    $retorno.= "</table>";
    $retorno.= "</td></tr></table>";
    $retorno.= "<br>";
    

    //links para mes anterior e mes posterior
    $retorno.= "<table width=40%><tr><th width=50% class='diasemana'>";
    $retorno.= "<center><a href=".$raiz."?mes=".$mes_ant."&ano=".$ano_ant." class=estilo1>".converte_mes($mes_ant)."/".$ano_ant."</a></center></th>";
    $retorno.= "<th> | </th><th width=50%  class='diasemana'>";
    $retorno.= "<center><a href=".$raiz."?mes=".$mes_post."&ano=".$ano_post." class=estilo1>".converte_mes($mes_post)."/".$ano_post."</a></center>";
    $retorno.= "</th></tr></table>";

    //formulario para escolha de uma data
    $retorno.= "<form method=get action=".$raiz.">";
    $retorno.= "<font style=\"font-family:verdana,arial,serif;font-size:12\">Mês: </font><select name='mes' >";
    $retorno.= "<option></option>";

    For($cont=1;$cont<=12;$cont++)
    {
       $retorno.= "<option value=".$cont.">".converte_mes($cont)."</option>";
    }
    $retorno.= "</select>";

    $retorno.= "<font style=\"font-family:verdana,arial,serif;font-size:12\">  Ano: </font><select name='ano'>";
    $retorno.= "<option></option>";

    For($cont=date("Y")-5;$cont<=date("Y")+5;$cont++)
    {
       $retorno.= "<option value=".$cont.">".$cont."</option>";
    }
    $retorno.= "</select>";

    //Variaveis login na pagina apolo
    $retorno.= "<input type=hidden name=usuario value='".$_GET['usuario']."' />";
    $retorno.= "<input type=hidden name=senha value='".$_GET['senha']."' />";

    $retorno.= "  <input type=submit value=OK>";
    $retorno.= "</form>";

    $retorno.= "</center>";
    return $retorno;
}

Function converte_dia($dia_semana) //funcao para comecar a montar o calendario pela quarta-feira
{
   If($dia_semana == 0)
   {
      $dia_semana = 1;
   }
   ElseIf ($dia_semana == 1)
   {
      $dia_semana = 2;
   }
   ElseIf ($dia_semana == 2)
   {
      $dia_semana = 3;
   }
   ElseIf ($dia_semana == 3)
   {
      $dia_semana = 4;
   }
   ElseIf ($dia_semana == 4)
   {
      $dia_semana = 5;
   }
   ElseIf ($dia_semana == 5)
   {
      $dia_semana = 6;
   }
   ElseIf ($dia_semana == 6)
   {
      $dia_semana = 0;
   }
   return $dia_semana; 
}

Function converte_mes($mes)
{
         If($mes == 1)
         {
          $mes = "Janeiro";
         }
         ElseIf($mes == 2)
         {
          $mes = "Fevereiro";
         }
         ElseIf($mes == 3)
         {
          $mes = "Março";
         }
         ElseIf($mes == 4)
         {
          $mes = "Abril";
         }
         ElseIf($mes == 5)
         {
          $mes = "Maio";
         }
         ElseIf($mes == 6)
         {
          $mes = "Junho";
         }
         ElseIf($mes == 7)
         {
          $mes = "Julho";
         }
         ElseIf($mes == 8)
         {
          $mes = "Agosto";
         }
         ElseIf($mes == 9)
         {
          $mes = "Setembro";
         }
         ElseIf($mes == 10)
         {
          $mes = "Outubro";
         }
         ElseIf($mes == 11)
         {
          $mes = "Novembro";
         }
         ElseIf($mes == 12)
         {
          $mes = "Dezembro";
         }
         return $mes;
}
echo calendario($raiz, $imagem, $dados);

?>

</BODY>
</HTML>

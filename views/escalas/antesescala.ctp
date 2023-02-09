
<script type="text/javascript" language="JavaScript">

var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = "300px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
</script>
<script type="text/javascript">

			//<![CDATA[
function foco(cumprimentoid){
	var nomeSelect = 'cumprimentoid'+cumprimentoid;
 	$('anterior').value=$(nomeSelect).options[$(nomeSelect).options.selectedIndex].value;
	var c = $(nomeSelect);
	if(c.options.length==1){
	 	preencheSelect(cumprimentoid);
    }
}
function mudanca(cumprimentoid){
			var nomeSelect = 'cumprimentoid'+cumprimentoid;
			var raiz = '<?php echo $this->webroot;?>';
			var url = raiz+'escalas/update/'+cumprimentoid+'/'+$(nomeSelect).options[$(nomeSelect).options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value;

			new Ajax.Request(url, {
			method: 'get',
			onSuccess: function(transport) {

			var antes = $('anterior').value;
			var resultado = transport.responseText.evalJSON(true);
			
				if (resultado.ok==0){
					if(resultado.mensagem.length>0){
					    var st01 = 'Registro não atualizado! \<br>'+resultado.mensagem;
					    var str01= decodeURIComponent(st01.replace(/[ ]/g,'&nbsp;'));
						new Dialog({
							        handle:'#dialog_01',
							        title:'Relatório',
							        content:str01,
							        afterClose:function(){
								}
							});
						clickElement('dialog_01');		
					}
					$(nomeSelect).style.backgroundColor = '#a04040';
					var c = $(nomeSelect), i=0;
					for (; i<c.options.length; i++){
						if (c.options[i].value == antes){
						c.options[i].selected = true;
						break;
						}
				    }
				}
				
				if ((resultado.ok==1)||(resultado.ok==2)){
					$('EscalasmonthMediaHora').value = resultado.mediaHoras;
					if(resultado.mensagem.length>0){
					    var st02 = 'Caso o item tenha ficado verde, ele foi atualizado! Fique ciente que: \<br>'+resultado.mensagem;
					    var str02= decodeURIComponent(st02.replace(/[ ]/g,'&nbsp;'));
						new Dialog({
							        handle:'#dialog_02',
							        title:'Relatório',
							        content:str02,
							        afterClose:function(){
								}
							});
						clickElement('dialog_02');		
					}
					$(nomeSelect).style.backgroundColor = '#40a040';
				
				}
			
			if (resultado.ok==5){
				motivo = window.prompt(resultado.mensagem);
				var expressao = /[\,\/\?\:\@\&\=\+\$\#\.\"\']/gi;
				motivo = motivo.replace(expressao,'-');
			
				while(motivo.length<=5){
					motivo = window.prompt(resultado.mensagem);
					motivo = motivo.replace(expressao,'-');
				
				}
			}
			
			if(motivo.length>0){
			
				new Ajax.Request(url + '/' + encodeURIComponent(motivo), {
					method: 'get',
					onSuccess: function(jason) {
					resposta = jason.responseText.evalJSON(true);
					var expressao = /[\+]/gi;
					
					resposta.alteracao = decodeURIComponent(resposta.alteracao);
					resposta.alteracao = resposta.alteracao.replace(expressao,' ');
					$('naoconformidades').value = resposta.alteracao;
				    var st03 = 'Assinatura do escalante removida com sucesso! \<br>'+resposta.mensagem;
				    var str03= decodeURIComponent(st03.replace(/[ ]/g,'&nbsp;'));
					new Dialog({
						        handle:'#dialog_03',
						        title:'Relatório',
						        content:str03,
						        afterClose:function(){
							}
						});
					clickElement('dialog_03');		
					}
				});		
							
				}else{
					var c = $(nomeSelect), i=0;
					for (; i<c.options.length; i++){
						if (c.options[i].value == antes){
						c.options[i].selected = true;
						break;
						}
					}
			 	 }
			 	 
				if (resultado.ok==0){
				    var st04 = 'Registro não atualizado! \<br>'+resultado.mensagem;
				    var str04= decodeURIComponent(st04.replace(/[ ]/g,'&nbsp;'));
					new Dialog({
						        handle:'#dialog_04',
						        title:'Relatório',
						        content:str04,
						        afterClose:function(){
							}
						});
					clickElement('dialog_04');		
					var c = $(nomeSelect), i=0;
					for (; i<c.options.length; i++){
						if (c.options[i].value == antes){
						c.options[i].selected = true;
						break;
						}
				    }
				}else{
					var i = $A($(nomeSelect).options).find(function(option) { return option.selected; } );
					//$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').style.backgroundColor = cor[i.value];
					$('EscalasmonthMediaHora').value = resultado.mediaHoras;
					if (resultado.ok==2){
					    var st05 = 'Registro atualizado! \<br>'+resultado.mensagem;
					    var str05= decodeURIComponent(st05.replace(/[ ]/g,'&nbsp;'));
						new Dialog({
							        handle:'#dialog_05',
							        title:'Relatório',
							        content:str05,
							        afterClose:function(){
								}
							});
						clickElement('dialog_05');		
					}
				
				}
			
		}});

}		

		
		//]]>
</script>

<?php
//echo $u[0]['Usuario']['militar_id'];
//echo $u[0]['Usuario']['privilegio_id'];
$anos = array();
$meses = array('01'=>'JAN','02'=>'FEV','03'=>'MAR','04'=>'ABR','05'=>'MAI','06'=>'JUN','07'=>'JUL','08'=>'AGO','09'=>'SET','10'=>'OUT','11'=>'NOV','12'=>'DEZ');
$messel[$dtm] = $meses[$dtm];

$ano = $dta;
for ($inicio=$dta; $inicio<=$dta;$inicio++){
	$anos[$inicio]=$inicio;
}

$escrita = 0;


//print_r($escala['Escalasmonth']);

foreach($escala['Escalasmonth'] as $nomes){
	if($nomes['mes']==$dta.$dtm){
		if($selprev=='p'){
			$escalante = $nomes['nm_escalantep'];
			$chefe = $nomes['nm_chefe_orgaop'];
			$comandante = $nomes['nm_comandantep'];

		}else{
			$escalante = $nomes['nm_escalantec'];
			$chefe = $nomes['nm_chefe_orgaoc'];
			$comandante = $nomes['nm_comandantec'];

		}
		$okchefeorgaop = $nomes['ok_chefeorgaop'];
		$okchefeorgaoc = $nomes['ok_chefeorgaoc'];
		$horainstrucao = $nomes['hora_instrucao'];
		$okescalantep =  $nomes['ok_escalantep'];
		$okescalantec =  $nomes['ok_escalantec'];
		$okchefep =  $nomes['ok_chefep'];
		$okchefec =  $nomes['ok_chefec'];
		$destravap =  $nomes['destrava_prevista'];
		$destravac =  $nomes['destrava_cumprida'];
		$data2 = strtotime("now");

		$destravap = strtotime($destravap) - $data2;
		if($destravap>=0){
			$destravap = 1;
		}else{
			$destravap = 0;
		}
		$destravac = strtotime($destravac) - $data2;
		if($destravac>=0){
			$destravac = 1;
		}else{
			$destravac = 0;
		}

		break;
	}

}

$completa = '';
$tamanho = strlen($escala['Escalasmonth'][0]['id']);
if($tamanho<6){
	$diferenca = 6-$tamanho;
	for($i=0;$i<$diferenca;$i++){
		$completa .= '0';
	}
	$auxilio = $completa.$escala['Escalasmonth'][0]['id'];
}

$absoluto = substr(__FILE__, 0, strrpos(__FILE__, '/'));
$absoluto = str_replace('views/escalas','',$absoluto);
$absoluto = $absoluto.'webroot/pdf/'.$dta.$dtm.$auxilio.$selprev.'.pdf';

//echo $absoluto;

$caminho = $this->webroot.'escalas/indexPdf/'.$escala['Escala']['id'].'/'.$dtm.'/'.$dta.'/'.$selprev;


if(($selprev=='p')&&($escala['Escalasmonth'][0]['ok_chefep']>0)&&(empty($escala['Escalasmonth'][0]['destrava_prevista']))&&(file_exists($absoluto))){

	$caminho = $this->webroot.'webroot/pdf/'.$dta.$dtm.$auxilio.$selprev.'.pdf';

}

if(($selprev=='c')&&($escala['Escalasmonth'][0]['ok_chefec']>0)&&(empty($escala['Escalasmonth'][0]['destrava_cumprida']))&&(file_exists($absoluto))){

	$caminho = $this->webroot.'webroot/pdf/'.$dta.$dtm.$auxilio.$selprev.'.pdf';

}

//---------------------------------------------
if(empty($escala['mes'])){
	$escala['mes'] = $dtm;
}
	if(($escala['mes']<=12)&&($escala['mes']>1)){
		$data1 = mktime(23,59,59,($dtm-1),$escala['Escala']['dt_limite_previsao'],$dta);
	}

	if(($escala['mes']<=11)){
		$data3 = mktime(23,59,59,($dtm+1),$escala['Escala']['dt_limite_cumprida'],$dta);
	}
	if(($escala['mes']==12)){
		$data3 = mktime(23,59,59,1,$escala['Escala']['dt_limite_cumprida'],($dta+1));
	}
	
	if(($escala['mes']==1)){
		$data1 = mktime(23,59,59,12,$escala['Escala']['dt_limite_previsao'],($dta-1));
	}
	


$data2 = strtotime("now");
$dif1 = $data1-$data2;
$dif2 = $data3-$data2;


//echo $data1.'  '.$data2.'  '.$data3.' '.$destravap.' '.$destravac.'..'.$dtm.$escala['Escala']['dt_limite_previsao'].'<br>';
//print_r($escala['Escalasmonth']);
//echo '<pre>';
//print_r($escala);
//echo '</pre>';
$assinaescalante = 0;
$assinachefe = 0;
$trava=1;

$limpaAssinaturaEscalante = 0;
$limpaAssinaturaChefe = 0;
//print_r($u);

if($selprev=='p'){
	$gif='pdf2p.gif';

	if(($u[0]['Usuario']['privilegio_id']==5)){
		if($okescalantep>0){
			$trava = 1;
			$assinaescalante = 0;
			if($dif1>=0){
				if(empty($okchefep)||($okchefep==0)){
					$limpaAssinaturaEscalante = 1;
				}
			}
				
		}else{
			if($dif1>=0){
				$trava = 0;
				$assinaescalante = 1;
				if(empty($okchefep)||($okchefep==0)){
					$limpaAssinaturaEscalante = 1;
				}
			}else{
				$trava = 1;
				$assinaescalante = 0;
			}
		}
		if(($destravap)){
			$assinaescalante = 1;
			$trava=0;
			if(empty($okchefep)||($okchefep==0)){
				$limpaAssinaturaEscalante = 1;
			}
				
		}

	}
	if(($u[0]['Usuario']['privilegio_id']==6)){
		if($okchefep>0){
			$trava = 1;
			$assinachefe = 0;
			if($dif1>=0){
				$limpaAssinaturaChefe = 1;
			}
		}else{
			if($dif1>=0){
				$trava = 0;
				$assinachefe = 1;
				if(empty($okchefeorgaop)||($okchefeorgaop==0)){
					$limpaAssinaturaChefe = 1;
				}

			}else{
				$trava = 1;
				$assinachefe = 0;
			}
		}
		if(($destravap)){
			$assinachefe = 1;
			$limpaAssinaturaChefe = 1;
			$trava=0;
				
		}

	}
}else{
	$gif='pdf2c.gif';

	if(($u[0]['Usuario']['privilegio_id']==5)){
		if($okescalantec>0){
			$trava = 1;
			$assinaescalante = 0;

			if($dif2>=0){
				if(empty($okchefec)||($okchefec==0)){
					$limpaAssinaturaEscalante = 1;
				}

			}
		}else{
			if($dif2>=0){
				$trava = 0;
				$assinaescalante = 1;
				if(empty($okchefec)||($okchefec==0)){
					$limpaAssinaturaEscalante = 1;
				}

			}else{
				$trava = 1;
				$assinaescalante = 0;
			}
		}
		if(($destravac)){
			$assinaescalante = 1;
			$trava=0;
			if(empty($okchefec)||($okchefec==0)){
				$limpaAssinaturaEscalante = 1;
			}
				
		}

	}
	if(($u[0]['Usuario']['privilegio_id']==6)){
		if($okchefec>0){
			$trava = 1;
			$assinachefe = 0;
			if($dif2>=0){
				$limpaAssinaturaChefe = 1;
			}
		}else{
			if($dif2>=0){
				$trava = 0;
				$assinachefe = 1;
				//if(empty($okchefeorgaoc)||($okchefeorgaoc==0)){
				$limpaAssinaturaChefe = 0;
				//}

			}else{
				$trava = 1;
				$assinachefe = 0;
			}
		}
		if(($destravac)){
			$assinachefe = 1;
			$trava=0;
			$limpaAssinaturaChefe = 1;
				
		}

	}

}
$oaple = 0;

if(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4)){
	$assinaescalante = 1;
	$assinachefe = 1;
	$trava=0;
	$oaple = 1;
	$escrita = 1;
	$limpaAssinaturaChefe = 1;
	$limpaAssinaturaEscalante = 1;

}

//echo 'destravac = '.$destravac.' limpaAssinaturaChefe='.$limpaAssinaturaChefe.' dif2='.$dif2.' data1='.$data1.' data3='.$data3.' data2='.$data2;

?>
<?php

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function submitForm(form) {

var mes = $dtm;
var ano = $dta;
var prevista = $('EscalaPrevista').value;
var dados = Form.serialize($('EscalaVersoForm'));
new Ajax.Request('{$this->webroot}escalas/verso/{$escala['Escala']['id']}/'+mes+'/'+ano+'/'+prevista, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st06 = 'Registro não atualizado! \<br>'+resultado.mensagem;
			    var str06= decodeURIComponent(st06.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_06',
					        title:'Relatório',
					        content:str06,
					        afterClose:function(){
						}
					});
				clickElement('dialog_06');		
			}else{
			    var st07 = 'Registro atualizado! \<br>'+resultado.mensagem;
			    var str07= decodeURIComponent(st07.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_07',
					        title:'Relatório',
					        content:str07,
					        afterClose:function(){
						}
					});
				clickElement('dialog_07');		
			
			}
			$('data[Verso][obscmt]').value = resultado.obscmt;
			 $('data[Verso][obs]').value = resultado.obs;
			 $('data[Verso][alteracoes]').value = resultado.alteracoes;
		}
				})
        
        
        return false;
    }
		
		
		//]]>

</script>
SCRIPT;

echo $jscript;

?>
<div
	style="z-index: 2; width: 100%; height: 100%; position: fixed; top: 0%; left: 0%; padding: 0px; float: center;" 	id="conflitos">
<table cellspacing="0" cellpadding="0" id="login">
	<tbody>
		<tr>
			<td>
			<table cellspacing="0" cellpadding="0" border="0" id="login" >

				<tbody>
					<tr>
						<th width="10%" class="td_esq"><a href="#"		onclick="$('conflitos').hide();"><img 	src="<?php echo $this->webroot.'img/btsair.gif'; ?>"></a></th>
						<th width="90%" class="td_dir"><b>Não foi assinado devido ao fato de alguns militares estarem afastados,<br>porém constam como escalados</b></th>
					</tr>
					<tr>
						<td colspan="2"><b>CONFLITOS:</b></td>
					</tr>
					<tr>
						<td colspan="2"><textarea id="conflitantes" cols="120" rows="6"
							class="formulario"></textarea></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
</div>
<div 	style="z-index: 2; width: 100%; height: 100%; position: relative; top: 0%; left: 0%; padding: 0px; float: center;" 	id="verso">
<div align="center">
<?php 
 if($trava==0){echo $form->create('Escala', array('action'=>'verso','onsubmit'=>'submitForm(this); return false;','type'=>'file'));}
?>

<table width="80%" border="0" cellpadding="0" cellspacing="0" 	align="center">
	<tr>
		<th width="10%" class="td_esq"><a href="#" 		onclick="$('verso').hide();"><img		src="<?php echo $this->webroot.'img/btsair.gif'; ?>"></a></th>
		<th width="90%" class="td_dir"><b>OBSERVAÇÕES ESCALA </b></th>
	</tr>
	<tr>
		<td width="10%" class="td_esq">1. Adjunto:</td>
		<td width="90%" class="td_dir"><?php
		echo '<div class="input select required"><select id="EscalaAdjunto" name="data[Verso][adjunto]" class="formulario">';
		$adj = 0;
		foreach ($adjunto as $dados){
			if($verso[0]['Versoescala']['adjunto']==$dados){
				echo '<option value="'.$dados.'" selected>'.$dados.'</option>';
				$adj =1;
			}else{
				echo '<option value="'.$dados.'">'.$dados.'</option>';
			}

		}
		if($adj==0){
			echo '<option value="NÃO POSSUI ADJUNTO." selected>NÃO POSSUI ADJUNTO.</option>';
		}else{
			echo '<option value="NÃO POSSUI ADJUNTO." >NÃO POSSUI ADJUNTO.</option>';
		}
		echo '</select></div>';


		?> 
		<textarea name="data[Verso][adjunto_obs]" id="adjuntoobs" cols="80" 	rows="1" class="formulario"><?php echo $verso[0]['Versoescala']['adjunto_obs']; ?></textarea></td>
	</tr>
	<tr>
		<td class="td_esq" colspan="2" style="background-color: #ff8080;">Os itens de 2 até 5 serão obtidos do cadastro de Afastamentos. Basta visualizar o PDF.</td>
	</tr>

	<tr>
		<td class="td_esq">6. Observações:</td>
		<td class="td_dir"><textarea name="data[Verso][obs]" id="obs"
			cols="80" rows="6" class="formulario"><?php if($this->data['Escala']['prevista']=='p'){echo $verso[0]['Versoescala']['item1'];}else{echo $verso[0]['Versoescala']['item4'];} ?></textarea>

		</td>
	</tr>
	<tr>
		<td width="10%" class="td_esq">Não conformidades:</td>
		<td width="90%" class="td_dir"><textarea
			name="data[Verso][naoconformidades]" id="naoconformidades" cols="80" rows="6" class="formulario" <?php if(!$escrita){echo "readonly=\"readonly\"";} ?>><?php echo $verso[0]['Versoescala']['naoconformidades']; ?></textarea></td>
	</tr>
	<tr>
		<td colspan="2" class="td_esq">Escalante:<?php echo $escalante;	?></td>
	</tr>
	<tr>
		<th colspan="2" class="td_esq"><b>ALTERAÇÕES NA ESCALA </b></th>
	</tr>
	<tr>
		<td colspan="2" class="td_esq"><textarea 	name="data[Verso][alteracoes]" id="alteracoes" cols="80" rows="6" class="formulario"><?php if($this->data['Escala']['prevista']=='p'){echo $verso[0]['Versoescala']['item2'];}else{echo $verso[0]['Versoescala']['item5'];} ?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="td_esq">Chefe Órgão:<?php echo $chefe; ?></td>
	</tr>
	<tr class="td_lados">
		<th colspan="2" class="td_esq"><b>
		<?php 
		if($escala['Escala']['tipo']=='RISAER'){
			echo 'OBSERVAÇÕES DO CHEFE DA DIVISÃO ADMINISTRATIVA';
		}
		if($escala['Escala']['tipo']=='OPERACIONAL'){
			echo 'OBSERVAÇÕES DO CHEFE DA DIVISÃO DE OPERAÇÕES';
		}
		if($escala['Escala']['tipo']=='TECNICA'){
			echo 'OBSERVAÇÕES DO CHEFE DA DIVISÃO TÉCNICA';
		}
		?>
		 </b></th>
	</tr>
	<tr>
		<td colspan="2" class="td_esq"><textarea name="data[Verso][obscmt]" id="obscmt" cols="80" rows="6" class="formulario"><?php if($this->data['Escala']['prevista']=='p'){echo $verso[0]['Versoescala']['item3'];}else{echo $verso[0]['Versoescala']['item6'];} ?></textarea>

		</td>
	</tr>
	<tr>
		<td colspan="2" height="1000"><?php
		echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>

</div>
</div>
<div
	style="z-index: 2; width: 100%; height: 100%; position: relative; top: 0%; left: 0%; padding: 0px; float: center;"
	id="mapas">

<table width="80%" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<th width="10%" class="td_esq"><a href="#"
			onclick="$('mapas').hide();"><img
			src="<?php echo $this->webroot.'img/btsair.gif'; ?>"></a></th>
		<th width="90%" class="td_dir"><b>MAPA AUXÍLIO PARA ELABORAÇÃO DA ESCALA</b></th>
	</tr>
	<tr><td  colspan="2">
<div id="conteudomapas" align="center">
</div>
</td></tr>
	<tr>
		<td colspan="2"><pre>
		</pre></td>
	</tr>
	<tr>
		<td colspan="2" height="1000">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
</div>
<script type="text/javascript">
        $('verso').hide();
        $('conflitos').hide();
        $('mapas').hide();
</script>
<div 	style="float: center; position: static; width: 100%; height: 100%;">
<?php 
   echo $form->create('Escala', array('controller'=> 'Escala', 'action'=>'zera'));
	echo $form->hidden('Escala.id', array('value'=>$escala['Escala']['id']));
?>

	<?php 
	echo $form->hidden('Escala.opcao', array('value'=>'VER'));
	echo $form->hidden('Escala.anterior', array('value'=>'0','id'=>'anterior'));?>
<a href="#" onclick="$('verso').show(); "><img 	src="<?php echo $this->webroot.'img/verso.gif'; ?>" id="clickverso"></a>
<a href="#" onclick="listaMapa();$('mapas').show(); "><img 	src="<?php echo $this->webroot.'img/mapa.png'; ?>" 	id="clickafastamento"></a>

<table width="100%" border="0" cellpadding="0" cellspacing="0  class="td_full">
	<tr>
		<td colspan="4" class="td_full" scope="col"><b>UNIDADE</b><br>
		<?php echo $unidade[0]['Unidade']['sigla_unidade']; ?></td>
		<td class="td_full" scope="col"><b>ESCALA</b><br>
		<?php echo $form->select('Escala.prevista', array('p'=>'PREVISTA','c'=>'CUMPRIDA'),$this->data['Escala']['prevista'],array('onChange'=>"$('EscalaOpcao').value = 'VER'; $('EscalaZeraForm').submit();",'class'=>'formulario'), false);?>
		</td>
		<td class="td_full" scope="col"><b>MÊS/ANO</b><br>

		<?
		$ano = $dta;
		echo $form->select('Escala.mes', $messel, $dtm ,array('onChange'=>"$('EscalaOpcao').value = 'VER'; $('EscalaZeraForm').submit();",'class'=>'formulario','readonly'=>'yes'), true);
		echo $form->select('Escala.ano', $anos ,$ano ,array('onChange'=>"$('EscalaOpcao').value = 'VER'; $('EscalaZeraForm').submit();",'class'=>'formulario','readonly'=>'yes'), true);
		//echo $meses[$dtm].'/'.$ano;

		?></td>

		<td colspan="4" class="td_full" scope="col"><b>ESCALANTE:</b>&nbsp;<?php
		echo $html->image($gif, array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Gerar PDF da escala atual', 'id'=>'pdf')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
		if($assinaescalante){ ?> <?php //if($this->data['Escala']['prevista']=='p'){echo $html->image('zerar.png', array('alt'=> __('ZERAR', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Gerar nova previsão', 'onClick'=>'var sn=confirm("Tem certeza que deseja gerar nova previsão da escala atual ?"); if(sn){if(confirm("Gerar baseado no mês anterior?")){$(\'EscalaOpcao\').value = \'ANTERIOR\';  $(\'EscalaZeraForm\').submit();}else{if(confirm("Gerar automaticamente?")){$(\'EscalaOpcao\').value = \'ATUAL\';  $(\'EscalaZeraForm\').submit();}}}'));} ?>
		<?php
		if($selprev=='c'){
			echo $html->image('desfazer.jpg', array('alt'=> __('DESFAZER', true), 'border'=> '0','style'=>'float:left;', 'title'=>'Desfazer alterações da escala cumprida', 'id'=>'desfazer')); 

		}
		echo $html->image('lapis.gif', array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Assinar Escala atual', 'id'=>'assinarescalante')); ?>

		<?php }
		if($limpaAssinaturaEscalante){
			echo $html->image('limpa.gif', array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:left;', 'title'=>'Limpa assinaturas', 'id'=>'limpaassinaturaescalante'));

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('limpaassinaturaescalante', 'click', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			if(window.confirm('Tem certeza que deseja remover a assinatura do escalante?')){
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/escalante/0/'+prevista+'/limpar/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st08 = 'Problemas ao remover a assinatura do escalante! \<br>'+resultado.mensagem;
			    var str08= decodeURIComponent(st08.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_08',
					        title:'Relatório',
					        content:str08,
					        afterClose:function(){
								location.reload(true);
						}
					});
				clickElement('dialog_08');		
			}else{
			    var st09 = 'Assinatura do escalante removida com sucesso! \<br>'+resultado.mensagem;
			    var str09= decodeURIComponent(st09.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_09',
					        title:'Relatório',
					        content:str09,
					        afterClose:function(){
								location.reload(true);
						}
					});
				clickElement('dialog_09');		
		}
		}
				})
        }
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}

		?> <br>
		<?php
		//if($this->data['Escala']['prevista']=='p'){ echo $html->image('zerar.png', array('alt'=> __('ZERAR', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Gerar nova previsão', 'onClick'=>'var sn=confirm("Tem certeza que deseja gerar nova previsão da escala atual ?"); if(sn){$(\'EscalaOpcao\').value = \'ATUAL\';  $(\'EscalaZeraForm\').submit();}'));}
		if($oaple){
			echo '<select id="EscalaNmEscalante" name="EscalaNmEscalante" class="formulario">';
			$sinalizador=0;
			foreach ($chefeID as $dados){
				if($escalante==$dados){
					$sinalizador=1;
					echo '<option value="'.$dados.'" selected>'.$dados.'</option>';
				}else{
					echo '<option value="'.$dados.'">'.$dados.'</option>';
				}
			}
		if((!$sinalizador)){
				echo '<option value="'.$escalante.'" selected>'.$escalante.'</option>';
		}
			echo '</select>';
			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('EscalaNmEscalante', 'change', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;


			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/0/0/'+prevista+'/mudarescalante/'+encodeURIComponent($('EscalaNmEscalante').options[$('EscalaNmEscalante').selectedIndex].value), {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st10 = 'Problemas ao mudar o escalante! \<br>'+resultado.mensagem;
			    var str10= decodeURIComponent(st10.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_10',
					        title:'Relatório',
					        content:str10,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_10');		
			}else{
			    var st11 = 'Mudança de escalante realizada com sucesso! \<br>'+resultado.mensagem;
			    var str11= decodeURIComponent(st11.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_11',
					        title:'Relatório',
					        content:str11,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_11');		
				
			}
		}
				})
        
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}else{
			echo $escalante;
		}

		if(($selprev=='p')&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4))){
			echo '<p><font size="1">ASSINOU:<font><b><font size="1" color="#800000">'.$escalanteprevista.'</font></b></p>';
		}
		if(($selprev=='c')&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4))){
			echo '<p><font size="1">ASSINOU:<font><b><font size="1"  color="#800000">'.$escalantecumprida.'</font></b></p>';
		}
		?></td>
	</tr>
	<tr>
		<td colspan="4" class="td_full"><b>LOCALIDADE:</b><br>
		<?php echo $unidade[0]['Cidade']['nome']; ?></td>
		<td class="td_full"><b>EFETIVO TOTAL:</b><br>
		<?php echo $escala['Escala']['efetivo_total']; ?></td>
		<td class="td_full"><b>EFETIVO DA ESCALA:</b><br>
		<?php echo $preenche[0]['EscalasMonth']['efetivo_total']; ?></td>
		<input type="hidden" id="EscalasmonthId" name="data[Escalasmonth][id]" value="<?php echo $escalasmonth;?>">
		<td colspan="4" class="td_full"><b>CHEFE DO &Oacute;RG&Atilde;O:</b><br>
		<?php
		if($oaple){
			echo '<select id="EscalaNmChefe" name="EscalaNmChefe" class="formulario">';
			$sinalizador=0;
			foreach ($chefeID as $dados){
				if($chefe==$dados){
					$sinalizador=1;
					echo '<option value="'.$dados.'" selected>'.$dados.'</option>';
				}else{
					echo '<option value="'.$dados.'">'.$dados.'</option>';
				}
			}
		if((!$sinalizador)){
				echo '<option value="'.$chefe.'" selected>'.$chefe.'</option>';
		}
			echo '</select>';
			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('EscalaNmChefe', 'change', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;


			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/0/0/'+prevista+'/mudarchefe/'+encodeURIComponent($('EscalaNmChefe').options[$('EscalaNmChefe').selectedIndex].value), {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st12 = 'Problemas ao modificar o nome do chefe! \<br>'+resultado.mensagem;
			    var str12= decodeURIComponent(st12.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_12',
					        title:'Relatório',
					        content:str12,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_12');		
			}else{
			    var st13 = 'Mudança de chefe realizada com sucesso! \<br>'+resultado.mensagem;
			    var str13= decodeURIComponent(st13.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_13',
					        title:'Relatório',
					        content:str13,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_13');		
			}
		}
				})
        
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}else{
			echo $chefe;
		}
		?>&nbsp;&nbsp;&nbsp;<?php echo $html->image($gif, array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Gerar PDF da escala atual', 'id'=>'pdfchf')); ?>
		<?php if($assinachefe){  ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $html->image('lapis.gif', array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Assinar Escala atual', 'id'=>'assinarchf')); ?>
		<?php }
		if($limpaAssinaturaChefe){
			echo $html->image('limpa.gif', array('alt'=> __('PDF', true), 'border'=> '0','style'=>'float:left;', 'title'=>'Limpa assinaturas', 'id'=>'limpaassinaturachefe'));

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('limpaassinaturachefe', 'click', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			if(window.confirm('Tem certeza que deseja remover a assinatura do chefe?')){
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/chefe/0/'+prevista+'/limpar/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st14 = 'Problemas ao remover a assinatura! \<br>'+resultado.mensagem;
			    var str14= decodeURIComponent(st14.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_14',
					        title:'Relatório',
					        content:str14,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_14');		
			}else{
			    var st15 = 'Assinatura removida com sucesso! \<br>'+resultado.mensagem;
			    var str15= decodeURIComponent(st15.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_15',
					        title:'Relatório',
					        content:str15,
					        afterClose:function(){
					           location.reload(true);
					        }
					});
				clickElement('dialog_15');		
		}
		}
				})
        }
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}

		if(($selprev=='p')&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4))){
			echo '<p><font size="1">ASSINOU:<font><b><font size="1"  color="#800000">'.$chefeprevista.'</font></b></p>';
		}
		if(($selprev=='c')&&(($u[0]['Usuario']['privilegio_id']==1)||($u[0]['Usuario']['privilegio_id']==4))){
			echo '<p><font size="1">ASSINOU:<font><b><font size="1"  color="#800000">'.$chefecumprida.'</font></b></p>';
		}

		?></td>
		<?php
		if($trava==0){

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			//<![CDATA[

			Event.observe('pdf', 'click', function(event) {
			var mes = $('EscalaMes').value;
			var ano = $('EscalaAno').value;
			var prevista = $('EscalaPrevista').value;
			var url = '{$caminho}';
			window.open(url,'','');
		});			

		//]]>

</script>
SCRIPT;

			echo $jscript;




			$jscript=<<<SCRIPT
			<script type="text/javascript">
			//<![CDATA[

			Event.observe('pdfchf', 'click', function(event) {
			var mes = $('EscalaMes').value;
			var ano = $('EscalaAno').value;
			var prevista = $('EscalaPrevista').value;
			var url = '{$caminho}';
			window.open(url,'','');
		});			

		//]]>

</script>
SCRIPT;

			echo $jscript;



			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('assinarescalante', 'click', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			if(window.confirm('Tem certeza que deseja assinar?')){
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/escalante/0/'+prevista+'/assinar/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
					var expressao = /[\+]/gi;
					
					resultado.conflitos = decodeURIComponent(resultado.conflitos);
					resultado.conflitos = resultado.conflitos.replace(expressao,' ');
			 
			    $('conflitantes').value = resultado.conflitos;
			    $('conflitos').show();
			    var st16 = 'Problemas com a assinatura! \<br>'+resultado.mensagem;
			    var str16= decodeURIComponent(st16.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_16',
					        title:'Relatório',
					        content:str16,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_16');		
			}else{
			    var st17 = 'Assinatura realizada com sucesso! \<br>'+resultado.mensagem;
			    var str17= decodeURIComponent(st17.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_17',
					        title:'Relatório',
					        content:str17,
					        afterClose:function(){
					           location.reload(true);
					        }
					});
				clickElement('dialog_17');		
		}
		}
				})
        }
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('desfazer', 'click', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			if(window.confirm('Tem certeza que desfazer todas as alterações da escala cumprida?')){
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/escalante/0/'+prevista+'/desfazer/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==10){
			    var st18 = 'Alterações desfeitas! \<br>'+resultado.mensagem;
			    var str18= decodeURIComponent(st18.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_18',
					        title:'Relatório',
					        content:str18,
					        afterClose:function(){
								location.reload(true);
						}
					});
				clickElement('dialog_18');		
			}else{
			    var st19 = 'Alterações não foram desfeitas! \<br>'+resultado.mensagem;
			    var str19= decodeURIComponent(st19.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_19',
					        title:'Relatório',
					        content:str19,
					        afterClose:function(){
						}
					});
				clickElement('dialog_19');		
			}
		}
				})
        }
        		}, false
		);

</script>
SCRIPT;
		if($selprev=='c'){
			echo $jscript;
		}



			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('assinarchf', 'click', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			if(window.confirm('Tem certeza que deseja assinar?')){
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/chefe/0/'+prevista+'/assinar/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
					var expressao = /[\+]/gi;
					
					resultado.conflitos = decodeURIComponent(resultado.conflitos);
					resultado.conflitos = resultado.conflitos.replace(expressao,' ');
			 
			    $('conflitantes').value = resultado.conflitos;
			    $('conflitos').show();
			    var st20 = 'Escala não assinada!';
			    var str20= decodeURIComponent(st20.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_20',
					        title:'Relatório',
					        content:str20,
					        afterClose:function(){
					        }
					});
				clickElement('dialog_20');		
			   }else{
			    var str= decodeURIComponent(resultado.turnos.replace(/[+]/g,'&nbsp;'));
			    //str.gsub(/ /g,'&nbsp;');
				//exibeMensagem(str);
					new Dialog({
					        handle:'#dialog_15',
					        title:'Relatório',
					        content:str,
					        afterClose:function(){
					           location.reload(true);
					        }
					});
				clickElement('dialog_15');		
					
			   //alert('Registro atualizado! \<br>'+resultado.mensagem);
				
				
			}
		}
				})
        }
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}
		?>
	</tr>
	<tr>
		<td colspan="4" class="td_full"><b>&Oacute;RG&Atilde;O:</b>
		<a id="dialog_01" href="javascript:;"></a>
		<a id="dialog_02" href="javascript:;"></a>
		<a id="dialog_03" href="javascript:;"></a>
		<a id="dialog_04" href="javascript:;"></a>
		<a id="dialog_05" href="javascript:;"></a>
		<a id="dialog_06" href="javascript:;"></a>
		<a id="dialog_07" href="javascript:;"></a>
		<a id="dialog_08" href="javascript:;"></a>
		<a id="dialog_09" href="javascript:;"></a>
		<a id="dialog_10" href="javascript:;"></a>
		<a id="dialog_11" href="javascript:;"></a>
		<a id="dialog_12" href="javascript:;"></a>
		<a id="dialog_13" href="javascript:;"></a>
		<a id="dialog_14" href="javascript:;"></a>
		<a id="dialog_15" href="javascript:;"></a>
		<a id="dialog_16" href="javascript:;"></a>
		<a id="dialog_17" href="javascript:;"></a>
		<a id="dialog_18" href="javascript:;"></a>
		<a id="dialog_19" href="javascript:;"></a>
		<a id="dialog_20" href="javascript:;"></a>
		<a id="dialog_21" href="javascript:;"></a>
		<a id="dialog_22" href="javascript:;"></a>
		<a id="dialog_23" href="javascript:;"></a>
		<a id="dialog_24" href="javascript:;"></a>
		<a id="dialog_25" href="javascript:;"></a>
		<a id="dialog_26" href="javascript:;"></a>
		<a id="dialog_27" href="javascript:;"></a>
		<a id="dialog_28" href="javascript:;"></a>
		<a id="dialog_29" href="javascript:;"></a>
		<a id="dialog_30" href="javascript:;"></a>
		<br>
		<?php echo $unidade[0]['Setor']['sigla_setor']; ?></td>
		<td id="td_full" style="background-color:#ff8080;vertical-align:top;text-align:top">
		<?php 
			$dtIni = strtotime("$dta/$dtm/1");
			$qtddias = date('t',$dtIni);
			for($d=1;$d<=$qtddias;$d++){
				$diasVetor[$d]=$d;
			}
		?>
		<?php echo '<div id="limiteDias" style="text-align:right;padding:0;vertical-align:top;border:0;"><img id="funcionando" border="0" alt="Exibir"	src="'.$this->webroot.'img/verde.gif" /><b>Do dia:'.$form->select('Escala.diaInicial', $diasVetor,$this->data['Escala']['diaInicial'],array('onChange'=>"$('EscalaOpcao').value = 'VER'; $('EscalaDiaFinal').options.selectedIndex = -1;$('funcionando').src = '".$this->webroot."img/vermelho.gif';",'class'=>'formulario'), false).'<br>';?>
		<?php echo 'até:'.$form->select('Escala.diaFinal', $diasVetor,$this->data['Escala']['diaFinal'],array('onChange'=>"$('EscalaOpcao').value = 'VER'; $('EscalaZeraForm').submit();",'class'=>'formulario','onFocus'=>"$('funcionando').src = '".$this->webroot."img/vermelho.gif';"), false).'</b></div>';?>
		
		
<!-- LIMITE DE DIAS -->		
		<div id='exibeMEdiaHoraMensal'>
		<b>M&Eacute;DIA HORA MENSAL:</b><br>
		<input type="text" id='EscalasmonthMediaHora'
			name='data[Escalasmonth][media_hora]'
			value="<?php if($this->data['Escala']['prevista']=='p'){echo $preenche[0]['EscalasMonth']['media_hora_prevista'];}else{echo $preenche[0]['EscalasMonth']['media_hora'];} ?>"
			class="formularios" readonly size="6">
		</div>
		<script>HideContent('exibeMEdiaHoraMensal');</script>	
<!-- LIMITE DE DIAS -->		
		</td>
		<td class="td_full"><b>HORA INSTRU&Ccedil;&Atilde;O:</b><br>
		<input type="text" id='EscalasmonthHoraInstrucao'
			name='data[Escalasmonth][hora_instrucao]'
			value="<?php echo $horainstrucao; ?>" class="formularios" size="3"></td>
		<td colspan="4" class="td_full"><b>
				<?php 
				
		if($escala['Escala']['tipo']=='RISAER'){
			echo 'CHEFE DA DIVISÃO ADMINISTRATIVA';
		}
		if($escala['Escala']['tipo']=='OPERACIONAL'){
			echo 'CHEFE DA DIVISÃO DE OPERAÇÕES';
		}
		if($escala['Escala']['tipo']=='TECNICA'){
			echo 'CHEFE DA DIVISÃO TÉCNICA';
		}
		
		?>
		</b><br>
		<?php

		if($oaple){
			echo '<input type="text" id="EscalaNmCmt" name="EscalaNmCmt" class="formulario" value="'.$comandante.'" size="60">';

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('EscalaNmCmt', 'change', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/0/0/'+prevista+'/mudarcmt/'+encodeURIComponent($('EscalaNmCmt').value), {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st21 = 'Problemas na atualização! <br>'+resultado.mensagem;
			    var str21= decodeURIComponent(st21.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_21',
					        title:'Relatório',
					        content:str21,
					        afterClose:function(){
						}
					});
				clickElement('dialog_21');		
			}else{
			    var st22 = 'Registro atualizado! <br>'+resultado.mensagem;
			    var str22= decodeURIComponent(st22.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_22',
					        title:'Relatório',
					        content:str22,
					        afterClose:function(){
						}
					});
				clickElement('dialog_22');		
			}
		}
				})
        
        		}, false
		);

</script>
SCRIPT;

			echo $jscript;

		}else{
			echo $comandante;
		}
	if(($u[0]['Usuario']['privilegio_id']==5)){
		if($okescalantep==0){
			if(($selprev=='p')&&($okescalantep==0)){
				echo $html->image('lixo__.gif', array('alt'=> __('LIMPAR', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Limpar dados ', 'onClick'=>'var sn=confirm("Tem certeza que deseja limpar dados atuais ?"); if(sn){$(\'EscalaOpcao\').value = \'ZERAR\';  $(\'EscalaZeraForm\').submit();}'));
			}
		}
	}
	if($oaple){
		if($selprev=='p'){
		echo $html->image('lixo__.gif', array('alt'=> __('LIMPAR', true), 'border'=> '0','style'=>'float:right;', 'title'=>'Limpar dados ', 'onClick'=>'var sn=confirm("Tem certeza que deseja limpar dados atuais ?"); if(sn){$(\'EscalaOpcao\').value = \'ZERAR\';  $(\'EscalaZeraForm\').submit();}'));
	}
	}
	 ?></td>
	</tr>
</table>
	 <?php

		if($trava==0){
			$jscript=<<<SCRIPT
			<script type="text/javascript">
			Event.observe('EscalasmonthHoraInstrucao', 'change', function(event) {

			var idescalasmonth = $escalasmonth;
			var idmilitar = {$u[0]['Usuario']['militar_id']};
			var prevista = $('EscalaPrevista').value;
			var motivo = '';
			var horainstrucao = Number($('EscalasmonthHoraInstrucao').value);
			if(isNaN(horainstrucao)){
			$('EscalasmonthHoraInstrucao').value = 0;
		}else{
		var expressao = /[\,\/\?\:\@\&\=\+\$\#\.\"\']/gi;
		motivo = window.prompt('Informe o motivo das horas de instrução:');
		motivo = motivo.replace(expressao,'-');
		while(motivo.length==0){
		motivo = window.prompt('Informe o motivo das horas de instrução:');
		motivo = motivo.replace(expressao,'-');
		}
		//alert('Aprovado');

		}
		new Ajax.Request('{$this->webroot}escalas/assinar/'+idescalasmonth+'/'+idmilitar+'/0/'+horainstrucao+'/'+prevista+'/instrucao/'+encodeURIComponent(motivo), {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			 if (resultado.ok==0){
			    var st23 = 'Problemas na assinatura! <br>'+resultado.mensagem;
			    var str23= decodeURIComponent(st23.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_23',
					        title:'Relatório',
					        content:str23,
					        afterClose:function(){
						}
					});
				clickElement('dialog_23');		
			}else{
			    var st24 = 'Registro atualizado! <br>'+resultado.mensagem;
			    var str24= decodeURIComponent(st24.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_24',
					        title:'Relatório',
					        content:str24,
					        afterClose:function(){
						}
					});
				clickElement('dialog_24');		
			}
		}
				})
        
        		}, false
		);

</script>
SCRIPT;

		echo $jscript;

		}
		?> <?php echo $form->end();?>

<table width="100%" border="0" cellpadding="0" cellspacing="0  class="
	td_full" border="1">
	<tr>
		<td class="td_full" width="4%"><b>DIA</b><br>
		</td>
		<td class="td_full" width="4%"><b>SEM</b><br>
		</td>
		<?php
		$contaTurnos = 1;
		foreach ($turnos as $turno){
			?>

		<td class="td_full" width="10%"><b><?php echo $turno['Turno']['rotulo']; ?></b><br>
		<?php echo substr($turno['Turno']['hora_inicio'],0,5).'/'.substr($turno['Turno']['hora_termino'],0,5); ?></td>
		<?php
		$contaTurnos++;
		}
		?>
		<td class="td_full" width=""><b>FOLGA</b><br>
		</td>
		<td class="td_full" width=""><b>OBSERVA&Ccedil;&Atilde;O</b><br>
		</td>
	</tr>
</table>
<div
	style="width: 100%; height: 300px; overflow-y: scroll; scrollbar-arrow-color: blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color: #888888">
<table width="100%" border="0" cellpadding="0" cellspacing="0"
	class="td_full">
	<?php
	//echo '<pre>';
	//print_r($preenche);
	//echo '</pre>';
	echo '<script  language=javascript> var cor = new Array(); ';
	//Mapear cores com os respectivos Militares
	$cor = hexdec('209cc2');
	$vetor = array('00','66','7f','cc', 'ff');
	$vetorcor = array();

	//for ($t=0; $t<=16; $t++){
	$MilitarCor = array();


	foreach ($legendas as $militar){

		$r = rand(0,4);
		$g = rand(0,4);
		$b = rand(0,4);


		$hexa = $vetor[$r].$vetor[$g].$vetor[$b];
		while (in_array($hexa, $vetorcor)){
			$r = rand(0,4);
			$g = raforeachnd(0,4);
			$b = rand(0,4);


			$hexa = $vetor[$r].$vetor[$g].$vetor[$b];

		}

		$MilitarCor[$militar['Militar']['id']] = $hexa;
		echo "cor[{$militar['Militar']['id']}]='#{$hexa}';";
	}
	echo '</script>';

	$dia_semana =date('N',strtotime('now'));

	$dtIni = strtotime("$dta/$dtm/1");

	$qtd_dias = date('t',$dtIni);


	$semana = array(1=>'SEG', 2=>'TER', 3=>'QUA', 4=>'QUI', 5=>'SEX', 6=>'SÁB', 7=>'DOM');



	foreach ($legendas as $militar){
		$codigos[$militar['Militar']['id']] = $militar['MilitarsEscala']['codigo'];
	}
	$codigos[0]='--';



	$conta = 0;
	$datasAfastados[0]['codigo'] = '';
	$datasAfastados[0]['dt_inicio'] = 0;
	$datasAfastados[0]['dt_termino'] = 0;

	foreach($afastamento as $afastamentos){
		$datasAfastados[$conta]['codigo'] = $codigos[$afastamentos['Militar']['id']];
		$datasAfastados[$conta]['dt_inicio'] = strtotime($afastamentos['Afastamento']['dt_inicio']);
		$datasAfastados[$conta]['dt_termino'] = strtotime($afastamentos['Afastamento']['dt_termino']);
		$conta++;
	}


	$totalcodigos = count($codigos);
	$posicaoselected = $totalcodigos + 1;

	$cumprimento = 0;
	$obs = '';

//-----------------------LIMITAÇÃO DE DIAS-----------------------------	
	if((empty($this->data['Escala']['diaInicial'])||$this->data['Escala']['diaInicial']<=0)){
		$this->data['Escala']['diaInicial']=1;
	//	$qtd_dias = date('t',$dtIni);
		$qtd_dias = 0;
	}else{
		$qtd_dias=$this->data['Escala']['diaFinal'];
	}
	for ($c=$this->data['Escala']['diaInicial'];$c<=$qtd_dias;$c++){
//-----------------------LIMITAÇÃO DE DIAS-----------------------------	
		$dtIni = strtotime("$dta/$dtm/$c");
		$dia_semana =date('N',$dtIni);

		?>
	<tr class="td_lados">
		<td class="td_lados" width="4%"><?php echo $c; ?></td>
		<td class="td_lados" width="4%"><?php echo $semana[$dia_semana]; ?></td>

		<?php

		foreach ($turnos as $turno){


			?>

		<td class="td_lados" width="10%"><?php



		for ($l=1;$l<=$turno['Turno']['qtd'];$l++){

			if($selprev=='p'){
				$milesc = $preenche[$cumprimento]['CumprimentoEscala']['previsto'];
			}else{
				$milesc = $preenche[$cumprimento]['CumprimentoEscala']['cumprido'];
			}
			if($milesc==0){
				$selecionado[0] = '--';
			}else{
				$selecionado[$milesc] = $codigos[$milesc];
			}
			$selectC = '';
			$selectI = '';
/*
			if(!$trava){
				foreach($codigos as $chave=>$valor){
					$selectC .= "<option value='$chave'>$valor</option>";
				}
			}
*/
			foreach($selecionado as $chave=>$valor){
				$selectC .= "<option value='$chave' selected='yes' >$valor</option>";
			}
			$selectC .= '</select><br>';
			//$selectI = "<select id='cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}'  name='cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}' class='formulario' style='background-color:#{$MilitarCor[$milesc]};' onfocus=\"\$('anterior').value=\$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[\$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value;\">";
			$selectI = "<select id='cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}'  name='cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}' class='formulario' style='background-color:#ffffff;' onfocus=\"foco('{$preenche[$cumprimento]['CumprimentoEscala']['id']}');\"  onchange=\"mudanca('{$preenche[$cumprimento]['CumprimentoEscala']['id']}');\">";

			echo $selectI.$selectC;

			unset($selecionado);
			//echo $form->input('cumprimentoid'.$preenche[$cumprimento]['CumprimentoEscala']['id'], array('type'=>'select','options'=>array($codigos), 'selected'=>$selecionado,'name'=>'cumprimentoid'.$preenche[$cumprimento]['CumprimentoEscala']['id'],'label'=>'','class'=>'formulario'));
			// PTO VERIFICACAO
			/*


			var url = '{$this->webroot}escalas/update/{$preenche[$cumprimento]['CumprimentoEscala']['id']}/'+$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value;

			Event.observe('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}', 'change', function(event) {
			//	$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').style.backgroundColor = cor[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value];
			new Ajax.Request('{$this->webroot}escalas/update/{$preenche[$cumprimento]['CumprimentoEscala']['id']}/'+$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value, {
			method: 'get',
			onSuccess: function(transport) {

			var antes = \$('anterior').value;
			var resultado = transport.responseText.evalJSON(true);
			if (resultado.ok==5){
			motivo = window.prompt(resultado.mensagem);
			var expressao = /[\,\/\?\:\@\&\=\+\$\#\.\"\']/gi;
			motivo = motivo.replace(expressao,'-');
			while(motivo.length==0){
			motivo = window.prompt(resultado.mensagem);
			motivo = motivo.replace(expressao,'-');
			}
			if(motivo.length>0){
			new Ajax.Request('{$this->webroot}escalas/update/{$preenche[$cumprimento]['CumprimentoEscala']['id']}/'+$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value+'/'+encodeURIComponent(motivo),
			{
			method: 'get',
			onSuccess: function(jason) {
			resposta = jason.responseText.evalJSON(true);
			alert(resposta.mensagem);
			}

			});

			}else{
			var c = $('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}'), i=0;
			for (; i<c.options.length; i++){
			if (c.options[i].value == antes){
			c.options[i].selected = true;
			break;
			}
			}

			}
			}
			if (resultado.ok==0){
			alert('Registro não atualizado! \<br>'+resultado.mensagem);
			var c = $('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}'), i=0;
			for (; i<c.options.length; i++){
			if (c.options[i].value == antes){
			c.options[i].selected = true;
			break;
			}
			}
			}else{
			var i = \$A(\$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options).find(function(option) { return option.selected; } );
			//$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').style.backgroundColor = cor[i.value];
			$('EscalasmonthMediaHora').value = resultado.mediaHoras;
			if (resultado.ok==2){
			alert('Registro atualizado! \<br>'+resultado.mensagem);
			}

			}
			}
			});
			}, false
			);			 *
			*/

			$jscript=<<<SCRIPT
			<script type="text/javascript">
			//<![CDATA[
			dd{$preenche[$cumprimento]['CumprimentoEscala']['id']} = new YAHOO.util.DDTarget("cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}");
		//]]>
</script>
SCRIPT;

			if(!$trava){
				//echo $jscript;
			}


			//	array_shift($codigos);

			$cumprimento++;
		}


		}
		$obs = '';
		$dtReferencia = strtotime("$dta/$dtm/$c");
//print_r($escala);
		if($escala['Escala']['tipo']=='OPERACIONAL'){
		foreach($datasAfastados as $afastado){
			$dif1 = $afastado['dt_inicio'] - $dtReferencia;
			$dif2 = $afastado['dt_termino'] - $dtReferencia;
			if(($dif1<=0)&&($dif2>=0)){
				$obs.= $afastado['codigo'].' ';
			}
		}
		}
		//$obs = $preenche[$cumprimento][0]['obs'];

		//endforeach;
		?></td>
		<td class="td_lados">&nbsp;</td>
		<td class="td_lados">&nbsp;<?php if(trim($obs)!=''){echo '<span >Afastados:</span><span>'.$obs.'</span>';} ?></td>
	</tr>
	<?php

	}



	?>
</table>
</div>

<br>
<?php
$selectDinamico = '';

if(!$trava){
	foreach($codigos as $chave=>$valor){
		$selectDinamico .= '<option value="'.$chave.'">'.$valor.'</option>';
	}
}
//echo $selectDinamico.'Estou arurudsiudsui';

$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){
/******
* select_innerHTML - corrige o bug do InnerHTML em selects no IE
* Veja o problema em: http://support.microsoft.com/default.aspx?scid=kb;en-us;276228
* Versão: 2.1 - 04/09/2007
* Autor: Micox - Náiron José C. Guimarães - micoxjcg@yahoo.com.br
* @objeto(tipo HTMLobject): o select a ser alterado
* @innerHTML(tipo string): o novo valor do innerHTML
*******/
	objeto = $(objetoId);
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    //innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

function preencheSelect(idSelect) {
	var conteudo = '$selectDinamico';
	var filtro = 'cumprimentoid'+idSelect;
	if(!(conteudo.empty())){
	 antes = \$A($(filtro).options).find(function(option) { return option.selected; } );
	 //antes=$(filtro).value;
	// conteudos += '<option selected="selected" value="'+antesV+'">'+antesN+'</option>'
	select_innerHTML(filtro,conteudo);
	
					var c = $(filtro), i=0;
					for (; i<c.options.length; i++){
						if (c.options[i].value == antes.value){
						c.options[i].selected = true;
						break;
						}
				    }
	
	}
	
}
    
	
	
    
		//]]>

</script>
SCRIPT;
echo $jscript;


?>

<script type="text/javascript">
function obterNumero(stringNo)
{var parsedNo = "";
for(var n=0; n<stringNo.length; n++)
{var i = stringNo.substring(n,n+1);
if(i=="1"||i=="2"||i=="3"||i=="4"||i=="5"||i=="6"||i=="7"||i=="8"||i=="9"||i=="0")
parsedNo += i;
}
return parsedNo;
} 
</script> 
	
	<?php
$trava=1;
if(!$trava){

	//$cor = hexdec('ffe4c4');
	//$cor = hexdec('a09080');
	$cor = hexdec('209cc2');
	$vetor = array('00','66','7f','cc', 'ff');
	$vetorcor = array();

	//echo '<pre>'.print_r($legendas).'</pre>';
	//for ($t=0; $t<=16; $t++){
	foreach ($legendas as $militar):

	$t = $militar['Militar']['id'].'_'.$militar['Militar']['id'];



	echo $ajax->div('dv_'.$t,array('style'=>"width: 50px; height: 10px; cursor: move; background: #{$MilitarCor[$militar['Militar']['id']]}; border: 1px solid #000000; float:left;margin-left:2px; margin-top: 2px;"));
	//echo $ajax->div('dv_'.$t,array('style'=>"width: 50px; height: 10px; cursor: move; background: #ffffff; border: 1px solid #000000; float:left;margin-left:2px; margin-top: 2px;"));
	echo '<h6>'.$militar['MilitarsEscala']['codigo'].'</h6>';
	echo $ajax->divEnd('dv_'.$t);


	$script1=<<<DRAGDROP


	<script type="text/javascript">

	(function() {

	var ddc{$t}, startPosc{$t} ;
	YAHOO.util.Event.onDOMReady(function() {

	var elcodc{$t} = YAHOO.util.Dom.get("dv_{$t}");
	startPos{$t} = YAHOO.util.Dom.getXY(elcodc{$t});

	ddc{$t} = new YAHOO.util.DD("dv_{$t}");
	ddc{$t}.on('dragDropEvent',	function(ev) {


	var nome{$t} = obterNumero($(ev.info).name);
	var url = '$this->webroot'+'escalas/update/'+nome{$t}+'/{$militar['Militar']['id']}/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value;

	new Ajax.Request(url, {
	method: 'get',
	onSuccess: function(transport) {
	var resultado = transport.responseText.evalJSON(true);
	if (resultado.ok==5){
	motivo = window.prompt(resultado.mensagem);
	while(motivo.length==0){
	motivo = window.prompt(resultado.mensagem);
}
if(motivo.length>0){
new Ajax.Request('{$this->webroot}escalas/update/{$preenche[$cumprimento]['CumprimentoEscala']['id']}/'+$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options[$('cumprimentoid{$preenche[$cumprimento]['CumprimentoEscala']['id']}').options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value+'/'+encodeURIComponent(motivo),
{
method: 'get',
onSuccess: function(jason) {
resposta = jason.responseText.evalJSON(true);
			    var st25 = resposta.mensagem;
			    var str25= decodeURIComponent(st25.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_25',
					        title:'Relatório',
					        content:str25,
					        afterClose:function(){
						}
					});
				clickElement('dialog_25');		

}

});

}
}

if ((resultado.ok==0)){
			    var st26 = 'Registro não atualizado! <br>'+resultado.mensagem;
			    var str26= decodeURIComponent(st26.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_26',
					        title:'Relatório',
					        content:str26,
					        afterClose:function(){
						}
					});
				clickElement('dialog_26');		

}else{
if (resultado.ok!=5){

$(ev.info).style.backgroundColor = $('dv_{$t}').style.backgroundColor;
var c = $(ev.info), i=0;
for (; i<c.options.length; i++){
if (c.options[i].value == {$militar['Militar']['id']}){
c.options[i].selected = true;
break;
}
}
}
}
}
});

//	new Ajax.Updater('opcoes','{$this->webroot}escalas/update/'+nome{$t}+'/{$militar['Militar']['id']}/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value, {asynchronous:true, evalScripts:true, onLoading:function(request) {},onComplete:function(request) { $(ev.info).style.backgroundColor = $('dv_{$t}').style.backgroundColor;},  requestHeaders:['X-Update', 'militares']});

var myAnim{$t} = new YAHOO.util.Motion('dv_{$t}', {points:{ to: startPos{$t} } }, 0.1,YAHOO.util.Easing.easeOut);
myAnim{$t}.animate();


}, ddc{$t}, true);
});
})();

toolTip{$t} = new YAHOO.widget.Tooltip("nome{$t}", {context:"dv_{$t}", text:"{$militar[0]['nomecompleto']}", showDelay:500 });


</script>
	
DRAGDROP;

//new Ajax.Updater('opcoes','/operacional/escalas/update' +'/'+1281+'/'+$('cumprimentoid1281').options[$('cumprimentoid1281').options.selectedIndex].value+'/'+$('EscalaPrevista').options[$('EscalaPrevista').options.selectedIndex].value, {asynchronous:true, evalScripts:true, onLoading:function(request) {}, onComplete:function(request) {alert('completou');}, requestHeaders:['X-Update', 'militares']}); }, false);
//new Ajax.Updater(ev.info,'/operacional/escalas/update/'+ev.info+'/1/p', {asynchronous:true, evalScripts:true, onLoading:function(request) {Effect.BlindDown(ev.info)}, requestHeaders:['X-Update', ev.info]});
//Event.observe('linkcampo2', 'click', function(event) { new Ajax.Updater('campo4','/operacional/escalas/campo3', {asynchronous:true, evalScripts:true, onLoading:function(request) {Effect.BlindDown(campo5)}, requestHeaders:['X-Update', 'campo4']}) }, false);
// $ajax->linkEvaldo('campo1','campo2', 'campo3',array('update' => 'campo4', 'loading' => 'Effect.BlindDown(campo5)'));


if($trava==0){
	//echo $script1;
}

endforeach;

}

$cor = ' style="background-color:#808080;"';
?>


<table width="100%" border="0" cellpadding="0" cellspacing="0"
	class="td_full" id="legendas">
	<tr>
		<td colspan="9" class="td_full">
		<h4>LEGENDA
		<?php if($escala['Escala']['tipo']=='RISAER'){
		
		?><a href="#" onclick="listaQuadrinhos();$('quadrinhos').show(); "><img
	src="<?php echo $this->webroot.'img/quadrinhos.png'; ?>"
	id="clickafastamento" style="float:right;"></a>
	<?php } ?>
	</h4>
		
		</td>
	</tr>
	<tr>
		<td class="td_full" <?php echo $cor; ?>><b>CÓDIGO</b></td>
		<td class="td_full"><b>OPERADOR</b></td>
		<td class="td_full"><b>INDICATIVO</b></td>
		<td class="td_full" <?php echo $cor; ?>><b>CÓDIGO</b></td>
		<td class="td_full"><b>OPERADOR</b></td>
		<td class="td_full"><b>INDICATIVO</b></td>
		<td class="td_full" <?php echo $cor; ?>><b>CÓDIGO</b></td>
		<td class="td_full"><b>OPERADOR</b></td>
		<td class="td_full"><b>INDICATIVO</b></td>
	</tr>

	<?php

	$nq = count($escala['Militar']) / 3;
	$nr = count($escala['Militar']) % 3;
	$n = 0;

	//		$codigos[$militar['MilitarsEscala']['militar_id']] = $militar['MilitarsEscala']['codigo'];




	$linha = '';

	foreach ($legendas as $militar){

		$linha.='<td class="td_full" '.$cor.' >'.$militar['MilitarsEscala']['codigo'].'&nbsp;</td><td class="td_full" >'.$militar[0]['nome'].'&nbsp;</td><td class="td_full" >'.$militar['Militar']['indicativo'].'&nbsp;</td>';
		
		$n++;

		if($n==3){
			$n=0;
			echo '<tr>'.$linha.'</tr>';
			$linha = '';
		}

	}
	if($n>0){
		for($i=$n;$i<3;$i++){
			$linha.='<td class="td_full"'.$cor.' >&nbsp;</td><td class="td_full" >&nbsp;</td><td class="td_full" >&nbsp;</td>';
		}
		echo '<tr>'.$linha.'</tr>';
		$linha = '';

	}
	?>


</table>
</div>
<?php 
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function listaMapa() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
	var dados = Form.serialize($('EscalaZeraForm'));
	new Ajax.Request('{$this->webroot}escalas/externomapa/', {
				method: 'post',
				postBody: dados,
				onSuccess: function(transport) {

				var resultado = transport.responseText.evalJSON(true);
				
				 if (resultado.ok==0){
			    var st27 = 'Problemas na atualização! <br>'+resultado.mensagem;
			    var str27= decodeURIComponent(st27.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_27',
					        title:'Relatório',
					        content:str27,
					        afterClose:function(){
						}
					});
				clickElement('dialog_27');		

				}else{
				$('conteudomapas').innerHTML = resultado.mensagem;
				var st28 = 'Registros atualizados! <br>';
			    var str28= decodeURIComponent(st28.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_28',
					        title:'Relatório',
					        content:str28,
					        afterClose:function(){
								ShowContent('conteudomapas');
						}
					});
				clickElement('dialog_28');		
					//$('atuais').innerHTML = resultado.atual;
								
				}
			}
					})
	        
	        
	        return false;
	    }
function listaQuadrinhos() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
	var dados = 'escalasmonthmes={$dta}{$dtm}&setorid={$unidade[0]['Setor']['id']}';
	new Ajax.Request('{$this->webroot}escalas/externoquadrinhos', {
				method: 'post',
				postBody: dados,
				onSuccess: function(transport) {

				var resultado = transport.responseText.evalJSON(true);
				
				 if (resultado.ok==0){
			    var st29 = 'Quadrinho não atualizado! <br>';
			    var str29= decodeURIComponent(st29.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_29',
					        title:'Relatório',
					        content:str29,
					        afterClose:function(){
						}
					});
				clickElement('dialog_29');		
				}else{
				var st30 = 'Quadrinhos atualizados! <br>';
				$('conteudoquadrinhos').innerHTML = unescape(resultado.mensagem);
				var str30= decodeURIComponent(st30.replace(/[ ]/g,'&nbsp;'));
				new Dialog({
					        handle:'#dialog_30',
					        title:'Relatório',
					        content: str30,
					        afterClose:function(){
						    ShowContent('conteudoquadrinhos');
						}
					});
					Dialogs.setContent('Teste');
					//        
				clickElement('dialog_30');		
								
				}
			}
					})
	        
	        
	        return false;
	    }
	    
</script>
SCRIPT;
echo $jscript;



		
?>
<div
	style="z-index: 2; width: 40%; height: 100%; position: absolute; top: 0%; left: 60%; padding: 0px; float: right;"
	id="quadrinhos">

<table width="80%" border="0" cellpadding="0" cellspacing="0"
	align="center">
	<tr>
		<th width="10%" class="td_esq"><a href="#"
			onclick="$('quadrinhos').hide();"><img
			src="<?php echo $this->webroot.'img/btsair.gif'; ?>"></a></th>
		<th width="90%" class="td_dir"><b>QUADRINHOS</b></th>
	</tr>
	<tr><td  colspan="2">
<div id="conteudoquadrinhos" align="left">
</div>
</td></tr>
	<tr>
		<td colspan="2"><pre>
		</pre></td>
	</tr>
	<tr>
		<td colspan="2" height="1000">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	</tr>
</table>
</div>
<script type="text/javascript">
<!--
        $('quadrinhos').hide();
		new Draggable('quadrinhos');
//-->
</script>

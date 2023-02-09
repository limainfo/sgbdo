<div style="display: none; position: absolute;top:20px; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 2000" id="detalhes">
<p id="campo" style="padding:0px;height:40px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;"></p>
<p	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"><div id="detalhe"></div></p>
<script type="text/javascript">
<!--
new Draggable('detalhes');
$('wrapper').setStyle='#wrapper table tr:hover td {}';
$('wrapper').removeClassName('#wrapper table tr:hover td');
//-->
</script>
</div><div class="afastamentos form">
<?php echo $form->create('Afastamento');?>
	<fieldset>
 		<legend><?php __('Modificar dados de Afastamento');?>&nbsp;&nbsp;&nbsp;
 					<?php
 					if($u[0]['Usuario']['militar_id']==$this->data['Afastamento']['militar_responsavel']){
		echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$afastamento['Afastamento']['dt_inicio']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$this->data['Afastamento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false), null,false);
		
 					} 
		?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
 		</legend>
	
	<?php
		echo '<div id="setor_id"><label>Escala:</label>'.$form->select('setor_id', $escalasselect ,$this->data['Afastamento']['setor_id'] ,array('class'=>'formulario'), false).'</div>';
		echo $form->input('militar_id',array('class'=>'formulario'));
		
		echo $form->input('id',array('class'=>'formulario'));
$select1 = '<label for="AfastamentoMotivo">Motivo</label><select id="origemcomplete" name="origemcomplete" class="formulario">';
$select1 .= '<option value="COMISSIONAMENTO">COMISSIONAMENTO</option>';
$select1 .= '<option value="CURSO">CURSO</option>';
$select1 .= '<option value="DISPENSA COMO RECOMPENSA">DISPENSA COMO RECOMPENSA</option>';
$select1 .= '<option value="DISPENSA PARA DESCONTO EM FÉRIAS">DISPENSA PARA DESCONTO EM FÉRIAS</option>';
$select1 .= '<option value="DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA">DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA</option>';
$select1 .= '<option value="DESLIGADO">DESLIGADO</option>';
$select1 .= '<option value="EXPEDIENTE ADMINISTRATIVO">EXPEDIENTE ADMINISTRATIVO</option>';
$select1 .= '<option value="FÉRIAS">FÉRIAS</option>';
$select1 .= '<option value="LICENÇA ESPECIAL">LICENÇA ESPECIAL</option>';
$select1 .= '<option value="LICENÇA PARA TRATAR DE INTERESSE PARTICULAR">LICENÇA PARA TRATAR DE INTERESSE PARTICULAR</option>';
$select1 .= '<option value="LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA">LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA</option>';
$select1 .= '<option value="LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES">LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES</option>';
$select1 .= '<option value="LICENÇA-MATERNIDADE">LICENÇA-MATERNIDADE</option>';
$select1 .= '<option value="LICENÇA PATERNIDADE">LICENÇA PATERNIDADE</option>';
$select1 .= '<option value="LUTO">LUTO</option>';
$select1 .= '<option value="INSTALAÇÃO">INSTALAÇÃO</option>';
$select1 .= '<option value="MILITAR DE OUTRA OM PRESTANDO SERVIÇO">MILITAR DE OUTRA OM PRESTANDO SERVIÇO</option>';
$select1 .= '<option value="MUDANÇA">MUDANÇA DE ESCALA</option>';
$select1 .= '<option value="NÚPCIAS">NÚPCIAS</option>';
$select1 .= '<option value="SERVIÇO RISAER">SERVIÇO RISAER</option>';
$select1 .= '<option value="TRANSFERIDO">TRANSFERIDO</option>';
$select1 .= '<option value="TRÂNSITO">TRÂNSITO</option>';
$select1 .= '<option value="CUMPRIMENTO DE ORDEM DE SERVIÇO">CUMPRIMENTO DE ORDEM DE SERVIÇO</option>';
$select1 .= '<option value="SAÍDA ANTES DO TÉRMINO DO TURNO">SAÍDA ANTES DO TÉRMINO DO TURNO</option>';
$select1 .= '<option value="SAÍDA APÓS TÉRMINO DO TURNO">SAÍDA APÓS TÉRMINO DO TURNO</option>';
$select1 .= '<option value="'.$this->data['Afastamento']['motivo'].'" selected>'.$this->data['Afastamento']['motivo'].'</option>';
$select1 .= '</select>';

	if(($u[0]['Usuario']['privilegio_id']=1)||($u[0]['Usuario']['privilegio_id']=1)){
		//$oaple = '<OPTION value="INCLUSÃO" label="INCLUSÃO">INCLUSÃO EM ESCALA</OPTION>';
	}else{
		$oaple = '';
	}

$selectOption =<<<FIM
<label for="AfastamentoMotivo">Motivo</label><select id="origemcomplete" name="origemcomplete" size="5" class="formulario">
 <option value="{$this->data['Afastamento']['motivo']}" selected>{$this->data['Afastamento']['motivo']}</option>
<OPTGROUP LABEL="1. ADJUNTO">
    </OPTGROUP>
<OPTGROUP LABEL="2.SERVIÇOS INDIVIDUAIS RISAER">
      <OPTION value="OFICIAL DE DIA" label="OFICIAL DE DIA">
        2.1 OFICIAL DE DIA
      </OPTION>
      <OPTION value="ADJ OFICIAL DIA" label="ADJ OFICIAL DIA">
        2.2 ADJUNTO AO OFICIAL DE DIA
      </OPTION>
      <OPTION value="ADJ OFICIAL OPERAÇÕES" label="ADJ OFICIAL OPERAÇÕES">
        2.3 ADJUNTO AO OFICIAL DE OPERAÇÕES
      </OPTION>
       <OPTION value="SARGENTO DE DIA" label="SARGENTO DE DIA">
        2.4 SARGENTO DE DIA
      </OPTION>
       <OPTION value="COMANDANTE DA GUARDA" label="COMANDANTE DA GUARDA">
        2.5 COMANDANTE DA GUARDA
      </OPTION>
      </OPTGROUP>
    </OPTGROUP>
    <OPTGROUP label="4. AFASTAMENTOS TEMPORÁRIOS DA ESCALA">
      <OPTION value="FÉRIAS" label="FÉRIAS">4.1 FÉRIAS</OPTION>
      <OPTION value="LICENÇA ESPECIAL" label="LICENÇA ESPECIAL">4.2 LICENÇA ESPECIAL</OPTION>
      <OPTION value="LICENÇA PARA TRATAR DE INTERESSE PARTICULAR" label="LICENÇA PARA TRATAR DE INTERESSE PARTICULAR">4.3 LICENÇA PARA TRATAR DE INTERESSE PARTICULAR</OPTION>
      <OPTION value="LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA" label="LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA">4.4 LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA</OPTION>
      <OPTION value="LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES" label="LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES">4.5 LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES</OPTION>
      <OPTION value="LICENÇA PATERNIDADE" label="LICENÇA PATERNIDADE">4.6 LICENÇA PATERNIDADE</OPTION>
      <OPTION value="LICENÇA-MATERNIDADE" label="LICENÇA-MATERNIDADE">4.7 LICENÇA-MATERNIDADE</OPTION>
      <OPTION value="DISPENSA COMO RECOMPENSA" label="DISPENSA COMO RECOMPENSA">4.8 DISPENSA COMO RECOMPENSA</OPTION>
      <OPTION value="DISPENSA PARA DESCONTO EM FÉRIAS" label="DISPENSA PARA DESCONTO EM FÉRIAS">4.9 DISPENSA PARA DESCONTO EM FÉRIAS</OPTION>
      <OPTION value="DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA" label="DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA">4.10 DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA</OPTION>
      <OPTION value="NÚPCIAS" label="NÚPCIAS">4.11 NÚPCIAS</OPTION>
      <OPTION value="LUTO" label="LUTO">4.12 LUTO</OPTION>
      <OPTION value="INSTALAÇÃO" label="INSTALAÇÃO">4.13 INSTALAÇÃO</OPTION>
      <OPTION value="CURSO" label="CURSO">4.14 CURSO</OPTION>
      <OPTION value="INSPEÇÃO DE SAÚDE" label="INSPEÇÃO DE SAÚDE">4.15 INSPEÇÃO DE SAÚDE (FORA DA SEDE)</OPTION>
      <OPTION value="CUMPRIMENTO DE ORDEM DE SERVIÇO" label="CUMPRIMENTO DE ORDEM DE SERVIÇO">4.16 CUMPRIMENTO DE ORDEM DE SERVIÇO</OPTION>
      <OPTION value="DISPENSA POR MOTIVO DE FORÇA MAIOR" label="DISPENSA POR MOTIVO DE FORÇA MAIOR">4.17 DISPENSA POR MOTIVO DE FORÇA MAIOR</OPTION>
      <OPTION value="DISPENSA POR ORDEM SUPERIOR" label="DISPENSA POR ORDEM SUPERIOR">4.18 DISPENSA POR ORDEM SUPERIOR</OPTION>
      <OPTION value="MILITAR DE OUTRA OM PRESTANDO SERVIÇO" label="MILITAR DE OUTRA OM PRESTANDO SERVIÇO">4.19 MILITAR DE OUTRA OM PRESTANDO SERVIÇO</OPTION>
      <OPTION value="MUDANÇA" label="MUDANÇA">4.20 MUDANÇA DE ESCALA</OPTION>
      <OPTION value="TRANSFERIDO" label="TRANSFERIDO">4.21 TRANSFERIDO</OPTION>
      <OPTION value="JUNTAESPECIAL" label="JUNTAESPECIAL">4.22 JUNTA ESPECIAL DE SAÚDE</OPTION>
      <OPTION value="CONCURSO PÚBLICO" label="CONCURSO">4.23 CONCURSO PÚBLICO</OPTION>
      <OPTION value="SITUAÇÕES ESPECIAIS" label="SITUAÇÕES ESPECIAIS">4.24 SITUAÇÕES ESPECIAIS</OPTION>
      {$oaple}
      </OPTGROUP>
    <OPTGROUP label="5. EXPEDIENTE ADMINISTRATIVO">
      <OPTION value="EXPEDIENTE ADMINISTRATIVO" label="EXPEDIENTE ADMINISTRATIVO">
        EXPEDIENTE ADMINISTRATIVO
      </OPTION>
      <OPTION value="EXPEDIENTE OPERACIONAL" label="EXPEDIENTE ADMINISTRATIVO/OPERACIONAL">
        EXPEDIENTE ADMINISTRATIVO/OPERACIONAL
      </OPTION>
      </OPTGROUP>
    <OPTGROUP label="6. OBSERVAÇÕES">
      <OPTION value="SAÍDA ANTES DO TÉRMINO DO TURNO" label="SAÍDA ANTES DO TÉRMINO DO TURNO">SAÍDA ANTES DO TÉRMINO DO TURNO</OPTION>
      <OPTION value="SAÍDA APÓS O TÉRMINO DO TURNO" label="SAÍDA APÓS O TÉRMINO DO TURNO">SAÍDA APÓS O TÉRMINO DO TURNO</OPTION>
    </OPTGROUP>
    </SELECT>
 


FIM;
//      <OPTION value="INSPEÇÃO DE SAÚDE" label="INSPEÇÃO DE SAÚDE">4.15 INSPEÇÃO DE SAÚDE (SOMENTE CZ, GM, MQ, RB, SL, SN, TT, UA, BV(BCT) e PV(BCT))</OPTION>

//echo $selectOption;
//echo $form->hidden('motivo',array('class'=>'formulario')).$select1;
echo $form->hidden('motivo',array('class'=>'formulario')).$selectOption;


		echo $datePicker->picker('dt_inicio',array('readonly'=>'readonly','class'=>'formulario'));
		echo $datePicker->picker('dt_termino',array('readonly'=>'readonly','class'=>'formulario'));
		echo $form->input('obs',array('class'=>'formulario'));
		
$jscript=<<<SCRIPT
<script type="text/javascript">
$('setor_id').hide();
</script>
SCRIPT;

//echo $jscript;		

$jscript=<<<SCRIPT
<script type="text/javascript">
//$('ProgramadetrabalhoOrigem').hide();
//<![CDATA[

 
 
Event.observe('origemcomplete', 'change', function(event) { 
$('AfastamentoMotivo').value = $('origemcomplete').options[$('origemcomplete').options.selectedIndex].value;
var exibe = 0;
if($('AfastamentoMotivo').value=='FÉRIAS'||$('AfastamentoMotivo').value=='LICENÇA ESPECIAL'||$('AfastamentoMotivo').value=='LICENÇA PARA TRATAR DE INTERESSE PARTICULAR'||$('AfastamentoMotivo').value=='LICENÇA PARA TRATAMENTO DE SAÚDE DE DEPENDENTES'||$('AfastamentoMotivo').value=='LICENÇA PARA TRATAMENTO DE SAÚDE PRÓPRIA'||$('AfastamentoMotivo').value=='LICENÇA PATERNIDADE'||$('AfastamentoMotivo').value=='LICENÇA-MATERNIDADE'||$('AfastamentoMotivo').value=='DISPENSA COMO RECOMPENSA'||$('AfastamentoMotivo').value=='DISPENSA PARA DESCONTO EM FÉRIAS'||$('AfastamentoMotivo').value=='DISPENSA EM DECORRÊNCIA DE PRESCRIÇÃO MÉDICA'||$('AfastamentoMotivo').value=='NÚPCIAS'||$('AfastamentoMotivo').value=='LUTO'||$('AfastamentoMotivo').value=='INSTALAÇÃO'){
	$('detalhe').innerHTML = "<font size='3'><b>Os registros de afastamentos referentes a férias, licença especial, licença para tratar de interesse particular, licença para tratamento de saúde própria, licença para tratamento de saúde de dependentes, licença paternidade, licença maternidade, dispensa como recompensa, dispensa para desconto em férias, dispensa em decorrência de prescrição médica, núpcias, luto e instalação deverão obedecer aos critérios estabelecidos no RCA 34-1;</b></font>";
	exibe = 1;
}
if($('AfastamentoMotivo').value=='CURSO'){
	$('detalhe').innerHTML = "<font size='3'><b>No afastamento \“CURSO\”, deverão ser registrados os cursos a serem realizados em outras Organizações ou na própria OM, de acordo com o planejamento da Divisão de Operações, bem como aqueles eventualmente solicitados pelo DECEA, EEAR, ICEA ou por outros programas do COMAER;</b></font>";
	exibe = 1;
}
if($('AfastamentoMotivo').value=='SITUAÇÕES ESPECIAIS'){
	$('detalhe').innerHTML = "<font size='3'><b>Verificar o RMA 35-1 (Estatuto dos Militares) - Título IV e informar se é AGREGAÇÃO - REVERSÃO - EXDEDENTE - AUSENTE - DESERTOR - DESAPARECIDO - EXTRAVIADO - COMISSIONADO (Guerra)</b></font>";
	exibe = 1;
}


if($('AfastamentoMotivo').value=='INSPEÇÃO DE SAÚDE'){
	$('detalhe').innerHTML = "<font size='3'><b>No afastamento \“INSPEÇÃO DE SAÚDE (FORA DA SEDE)\”, deverão ser registrados somente os casos que demandem deslocamento para outra cidade. Quando não houver tal necessidade, as inspeções de saúde deverão ser realizadas durante as folgas das escalas.</b></font>";
	exibe = 1;
}
if($('AfastamentoMotivo').value=='CUMPRIMENTO DE ORDEM DE SERVIÇO'){
	$('detalhe').innerHTML = "<font size='3'><b>No afastamento \“CUMPRIMENTO DE ORDEM DE SERVIÇO\”, deverão ser registrados os afastamentos temporários não especificados nos demais itens, tais como, por exemplo: Comissionamento no DTCEA-BV para guarnecimento da escala da EMA, Intercâmbio operacional no CINDACTA, etc.</b></font>";
	exibe = 1;
}
if($('AfastamentoMotivo').value=='DISPENSA POR MOTIVO DE FORÇA MAIOR'||$('AfastamentoMotivo').value=='DISPENSA POR ORDEM SUPERIOR'){
	$('detalhe').innerHTML = "<font size='3'><b>Os afastamentos temporários não previstos no RCA 34-1 e que sejam enquadrados na situação de \“motivo de força maior\” ou \“ordem superior\” deverão ser registrados respectivamente nos itens \“DISPENSA POR MOTIVO DE FORÇA MAIOR\” e \“DISPENSA POR ORDEM SUPERIOR\”, acompanhados pela descrição sucinta do fato que levou à dispensa.<br> Por motivo de força maior entenda-se a incapacidade do oficial / graduado / praça / civil de prever a indisponibilidade para o serviço e os casos imprevistos de extrema gravidade, tais como: falecimento, acidentes com baixa hospitalar, mal súbito, assistência médica à família em caráter de urgência ou qualquer outro evento imprevisto que possua a mesma gravidade. Evidentemente tal enquadramento deverá ser utilizado imediatamente após o fato ocorrido, até que seja emitida e homologada a devida dispensa ou concedido qualquer outro afastamento cadastrado no SGBDO.<br>A dispensa por motivo de força maior será concedida única e exclusivamente pelos Comandantes de DTCEA, para os Destacamentos, e pelo Chefe do COI, para a Sede, igualmente ao procedimento para trocas de serviço, conforme item 3.3 dessa NPA.<br>Por ordem superior entenda-se aquela emitida única e exclusivamente pelo Exmo. Sr. Comandante do CINDACTA ou pelo Chefe da Divisão de Operações para afastamentos afins, não especificados nos itens anteriores;</b></font>";
	exibe = 1;
}

if(exibe==1){
 	var excluir = '<a style="float: right; margin: 0px;" href="javascript:HideContent(\'detalhes\');"	onclick="HideContent(\'detalhes\');" 	href="javascript:HideContent(\'detalhes\');"><img border="0" width="15"	height="15" title="Fechar" alt="Fechar" 	src="{$raiz}img/lixo.gif" /> </a>';
 	$('campo').innerHTML = $('AfastamentoMotivo').value+excluir;
	ShowContent('detalhes');
}

}, false);

//]]>

</script>
SCRIPT;
 //if($('AfastamentoMotivo').value=='MUDANÇA'){\$('escala_id').show();}else{\$('escala_id').hide();};

echo $jscript;		

	?>
	</fieldset>
<?php
echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));

echo $form->end(array('label'=>'Registrar','class'=>'botoes'));?>
</div>



<script type="text/javascript">
HideContent('detalhes');
</script>

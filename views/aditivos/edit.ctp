<div class="aditivos form">
<?php echo $form->create('Aditivo', array('action'=>'edit','onsubmit'=>'return false;','type'=>'file', 'inputDefaults' => array('label' => false,'div' => false)));?>
<?php 
		echo $ajax->div('opcoesTurnos');
		echo $ajax->divEnd('opcoesTurnos');
?>
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0>
	<COLGROUP><COL WIDTH=60><COL WIDTH=64><COL WIDTH=44><COL WIDTH=157><COL WIDTH=112><COL WIDTH=116><COL WIDTH=114><COL WIDTH=60></COLGROUP>
	<TBODY>
		<TR>
			<TD COLSPAN=8 WIDTH=728 HEIGHT=20 style="background-color:#f0f000;text-align:center;border: 3px solid #000;"><B><FONT SIZE=3>PLANILHA PARA CÁLCULO DO EFETIVO DE UM ORGÃO ATC</FONT></B></TD>
			</TR>
		<TR>
			<TD HEIGHT=15 ALIGN=LEFT colspan="8" style="background-color:#c0b000;text-align:center;">DE ACORDO COM O MMA 100-30 E O OFICIO CIRC Nº 331/SDOP-ATM/1554, DE 10/05/05</TD>
		</TR>
		<TR>
			<TD HEIGHT=16 ALIGN=LEFT>ORGÃO:</TD>
			<TD  style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('orgao',array('size'=>'10','style'=>'background-color:#ffcc99;', 'label' => false, 'value'=>'TWR MN'));
			?>
			</TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT>CLASSE</TD>
			<TD  style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('classe',array('size'=>'4','style'=>'background-color:#ffcc99;', 'label' => false, 'value'=>'C'));
			?>
			</TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT>CARGA HORARIA</TD>
			<TD style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('carga_minima',array('size'=>'6','style'=>'background-color:#ffcc99;', 'label' => false, 'value'=>'168'));
			?>
			</TD>
		</TR>
		<TR>
			<TD HEIGHT=16 ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT>C.RECOMENDADA</TD>
			<TD  style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('carga_maxima',array('size'=>'6','style'=>'background-color:#ffcc99;', 'label' => false, 'value'=>'168'));
			?>
			</TD>
		</TR>
		<TR>
			<TD  style="background-color:#ccffcc;text-align:left;border: 3px solid #000;font-style:weight;"  colspan="8"><b>1 - CALCULO DO EFETIVO DE ATCO/ASSISTENTES</b></TD>
		</TR>
<tr>
<td  colspan="8" style="align:center;">
<?php 

for($i=0;$i<=50;$i++){
	$qtd[$i]=$i;
}
echo '
<TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP>
<TBODY>
		<TR>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">INÍCIO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TÉRMINO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">HORAS</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">CONTROLE</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">ASSISTENTE</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TOTAL POSIÇÕES</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">EF.OPR.P/TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;"><BR></TD>
		</TR>
		<tr>
';
		echo '<td>'.$form->input('nr_turno',array('class'=>'formulario','name'=>'data[atcs][nr_turno]','id'=>'ControleNrTurno','type'=>'select','options'=>$qtd,'default'=>1)).'</td>';
		//echo '<td width="100">'.$datePicker->Timer('inicio_turno',array('name'=>'data[atcs][inicio_turno]','id'=>'ControleInicioTurno', 'readonly'=>'readonly','size'=>'6','label' => false,'div' => false,'default'=>'00:00'),'%H:%M').'</td>';
		//echo '<td width="100">'.$datePicker->Timer('fim_turno',array('name'=>'data[atcs][fim_turno]','id'=>'ControleFimTurno','readonly'=>'readonly','size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td width="100">'.$datePicker->Timer('inicio_turno',array('name'=>'data[atcs][inicio_turno]','id'=>'ControleInicioTurno', 'size'=>'6','label' => false,'div' => false,'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td width="100">'.$datePicker->Timer('fim_turno',array('name'=>'data[atcs][fim_turno]','id'=>'ControleFimTurno','size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td>'.$form->input('horas',array('class'=>'formulario','name'=>'data[atcs][horas]','id'=>'ControleHoras','size'=>'5','readonly'=>'readonly')).'</td>';
		echo '<td>'.$form->input('controle',array('class'=>'formulario','name'=>'data[atcs][controle]','id'=>'ControleControle','type'=>'select','options'=>$qtd,'default'=>0,'onchange'=>'soma("ControleControle","ControleAsssitente");')).'</td>';
		echo '<td>'.$form->input('assistente',array('class'=>'formulario','name'=>'data[atcs][assistente]','id'=>'ControleAsssitente','type'=>'select','options'=>$qtd,'default'=>0,'onchange'=>'soma("ControleControle","ControleAsssitente");')).'</td>';
		echo '<td>'.$form->input('total',array('class'=>'formulario','name'=>'data[atcs][total]','id'=>'ControleTotal','size'=>'5','readonly'=>'readonly','default'=>0)).'</td>';
		echo '<td>'.$form->input('efetivo_operacional',array('class'=>'formulario','id'=>'ControleEfetivoOperacional','name'=>'data[atcs][efetivo_operacional]','size'=>'10','readonly'=>'readonly')).'</td>';
		echo '<td>'.$form->button('+', array('id'=>'cadastraatcs', 'class'=>'botoes')).'</td>';
		echo '</tbody></table>';
?>
<div id='item01' style="float:center;">
		</div>
		</td></tr>
		<TR>
			<TD   style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;" colspan="8"><b>2 - CALCULO DO EFETIVO DE SUPERVISORES SETORIAIS</b></TD>
		</TR>
<tr><td  colspan="8" style="align:center;">
<?php 

echo '
<TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP>
<TBODY>
		<TR>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">INÍCIO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TÉRMINO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">HORAS</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;" colspan="2">SUPERVISOR SETORIAL</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TOTAL POSIÇÕES</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">EF.OPR.P/TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;"><BR></TD>
		</TR>
		<tr>
';
		echo '<td>'.$form->input('nr_turno',array('id'=>'SetorialNrTurno','class'=>'formulario','name'=>'data[setorial][nr_turno]','type'=>'select','options'=>$qtd,'default'=>1)).'</td>';
		echo '<td width="100">'.$datePicker->Timer('inicio_turno',array('id'=>'SetorialInicioTurno','name'=>'data[setorial][inicio_turno]','size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td width="100">'.$datePicker->Timer('fim_turno',array('id'=>'SetorialFimTurno', 'name'=>'data[setorial][fim_turno]','size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td>'.$form->input('horas',array('id'=>'SetorialHoras','class'=>'formulario','name'=>'data[setorial][horas]','size'=>'5','readonly'=>'readonly')).'</td>';
		echo '<td colspan="2">'.$form->input('sup_setorial',array('id'=>'SetorialSupSetorial','class'=>'formulario','name'=>'data[setorial][sup_setorial]','type'=>'select','options'=>$qtd,'default'=>0,'onchange'=>'$("SetorialTotal").value=$("SetorialSupSetorial").value;')).'</td>';
		echo '<td>'.$form->input('total',array('id'=>'SetorialTotal','class'=>'formulario','name'=>'data[setorial][total]','size'=>'5','readonly'=>'readonly','default'=>0)).'</td>';
		echo '<td>'.$form->input('efetivo_operacional',array('id'=>'SetorialEfetivoOperacional','class'=>'formulario','name'=>'data[setorial][efetivo_operacional]','size'=>'10','readonly'=>'readonly')).'</td>';
		echo '<td>'.$form->button('+', array('id'=>'cadastrasetorial', 'class'=>'botoes')).'</td>';
echo '</tbody></table>';




?>

<div id='item02' style="float:center;">
</div>
		<TR>
			<TD   style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;" colspan="8"><b>3 - CALCULO DO EFETIVO DE SUPERVISORES DE EQUIPE</b></TD>
		</TR>
<tr><td  colspan="8" style="align:center;">
<?php 

echo '
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP>
<TBODY>
		<TR>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">INÍCIO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TÉRMINO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">HORAS</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;" colspan="2">SUPERVISOR EQUIPE</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TOTAL POSIÇÕES</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">EF.OPR.P/TURNO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;"><BR></TD>
		</TR>
		<tr>
';
		echo '<td>'.$form->input('nr_turno',array('id'=>'EquipeNrTurno','class'=>'formulario','name'=>'data[equipe][nr_turno]','type'=>'select','options'=>$qtd,'default'=>1)).'</td>';
		echo '<td width="100">'.$datePicker->Timer('inicio_turno',array('id'=>'EquipeInicioTurno','name'=>'data[equipe][inicio_turno]', 'size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td width="100">'.$datePicker->Timer('fim_turno',array('id'=>'EquipeFimTurno','name'=>'data[equipe][fim_turno]', 'size'=>'6','label' => false,'div' => false, 'default'=>'00:00'),'%H:%M').'</td>';
		echo '<td>'.$form->input('horas',array('id'=>'EquipeHoras','name'=>'data[equipe][horas]','class'=>'formulario','size'=>'5','readonly'=>'readonly')).'</td>';
		echo '<td colspan="2">'.$form->input('sup_equipe',array('id'=>'EquipeSupEquipe','name'=>'data[equipe][sup_equipe]','class'=>'formulario','type'=>'select','options'=>$qtd,'default'=>0,'onchange'=>'$("EquipeTotal").value=$("EquipeSupEquipe").value;')).'</td>';
		echo '<td>'.$form->input('total',array('id'=>'EquipeTotal','name'=>'data[equipe][total]','class'=>'formulario','size'=>'5','readonly'=>'readonly','default'=>0)).'</td>';
		echo '<td>'.$form->input('efetivo_operacional',array('id'=>'EquipeEfetivoOperacional','name'=>'data[equipe][efetivo_operacional]','class'=>'formulario','size'=>'10','readonly'=>'readonly')).'</td>';
		echo '<td>'.$form->button('+', array('id'=>'cadastraequipe', 'class'=>'botoes')).'</td>';
		echo '</tbody></table>';

?>

<div id='item03' style="float:center;">
</div>
	
		<TR>
			<TD   style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;" colspan="6" ><b>4 - TOTAL DO EFETIVO OPERACIONAL</b> </TD>
			<TD style="background-color:#ccffcc;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('total_efetivo_operacional',array('size'=>'6','style'=>'background-color:#ccffcc;', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD  style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;" colspan="6" ><b>5 - TOTAL DO EFETIVO OPERACIONAL C/15% + 1 ADJ</b></TD>
			<TD style="background-color:#ccffcc;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('total_efetivo_operacional_15',array('size'=>'6','style'=>'background-color:#ccffcc;', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('arredondado',array('id'=>'total_inteiro','size'=>'6','style'=>'background-color:#ffcc99;', 'label' => false, 'default'=>'0'));
			?>
			</TD>
		</TR>
		<TR>
			<TD  style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;"  colspan="8"><b>6 - EFETIVO DE APOIO RECOMENDADO (AINDA EM ESTUDO DENTRO DA ICA 100-20)</b></TD>

		</TR>
<tr><td  colspan="8" style="align:center;">
<div id='item06' style="float:center;">
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=60><COL WIDTH=64><COL WIDTH=44><COL WIDTH=157><COL WIDTH=112><COL WIDTH=116><COL WIDTH=114><COL WIDTH=60></COLGROUP>
<TBODY>
		<TR>
			<TD STYLE="border-left: 3px solid #000000" HEIGHT=15 ALIGN=LEFT>S.INSTRUÇÃO</TD>
			<TD><BR></TD>
			<TD>
			<?php 
			echo $form->input('sinstrucao',array('id'=>'sinstrucao','size'=>'6','class'=>'formulario','readonly'=>'readonly', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-left: 3px solid #000000" HEIGHT=15 ALIGN=LEFT>S.INVESTIGAÇÃO</TD>
			<TD><BR></TD>
			<TD>
			<?php 
			echo $form->input('sinvestigacao',array('id'=>'sinvestigacao','size'=>'6','class'=>'formulario', 'label' => false, 'default'=>'0','onchange'=>'calculaTotal();'));
			?>
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-left: 3px solid #000000" HEIGHT=15 ALIGN=LEFT>FMC</TD>
			<TD><BR></TD>
			<TD>
			<?php 
			echo $form->input('fmc',array('id'=>'fmc','size'=>'6','class'=>'formulario', 'label' => false, 'default'=>'0','onchange'=>'calculaTotal();'));
			?>
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-left: 3px solid #000000" HEIGHT=16 ALIGN=LEFT>TOTAL</TD>
			<TD><BR></TD>
			<TD>
			<?php 
			echo $form->input('total01',array('id'=>'total01','size'=>'6','readonly'=>'readonly','class'=>'formulario', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD STYLE="border-right: 3px solid #000000" ALIGN=LEFT><BR></TD>
		</TR>
		<TR>
			<TD STYLE="border-bottom: 3px solid #000000; border-left: 3px solid #000000" HEIGHT=16 ALIGN=LEFT>T.C/15%</TD>
			<TD STYLE="border-bottom: 3px solid #000000;"><BR></TD>
			<TD STYLE="border-bottom: 3px solid #000000;">
			<?php 
			echo $form->input('total01_15',array('id'=>'total01_15','readonly'=>'readonly','size'=>'6','class'=>'formulario', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('total02',array('id'=>'total02','size'=>'6','class'=>'formulario', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD STYLE="border-bottom: 3px solid #000000;"><BR></TD>
			<TD STYLE="border-bottom: 3px solid #000000;"><BR></TD>
			<TD STYLE="border-bottom: 3px solid #000000;"><BR></TD>
			<TD STYLE="border-right: 3px solid #000000;border-bottom: 3px solid #000000;" ALIGN=LEFT><BR></TD>
		</TR>
</TBODY></TABLE></div>

		<TR>
			<TD HEIGHT=15 ALIGN=LEFT colspan="2">EFETIVO TOTAL</TD>
			<TD style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			echo $form->input('efetivoTotal',array('id'=>'efetivoTotal','size'=>'6','readonly'=>'readonly','class'=>'formulario', 'label' => false, 'default'=>'0'));
			?>
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
		</TR>
		<TR>
			<TD HEIGHT=15 ALIGN=LEFT colspan="2">EFETIVO EXISTENTE</TD>
			<TD style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			</TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
			<TD><BR></TD>
		</TR>
	</TBODY>
</TABLE>
<?php
echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));

echo $form->end();?>
</div>
<!-- ************************************************************************** -->
		
<script type="text/javascript">

function calculaTotal(){
	var quantidade=new Array();
	var form=$('AditivoEditForm');
	var q =form.getInputs('hidden','efetivooperacional[total][]');

	$('AditivoTotalEfetivoOperacional').value=0;
	q.each(function(z){quantidade.push(Number(z.value));$('AditivoTotalEfetivoOperacional').value=Number($('AditivoTotalEfetivoOperacional').value)+Number(z.value);});

	$('AditivoTotalEfetivoOperacional').value=((Math.round(Number($('AditivoTotalEfetivoOperacional').value)*100))/100);
	$('AditivoTotalEfetivoOperacional15').value=Math.round(((Number($('AditivoTotalEfetivoOperacional').value)+(((Number($('AditivoTotalEfetivoOperacional').value)*15)/100)+1))*100))/100;
	$('total_inteiro').value=Math.ceil(Number($('AditivoTotalEfetivoOperacional15').value));

	$('sinstrucao').value = Math.round((((((Number($('total_inteiro').value)*5)/100)))*100))/100;

	$('total01').value = Number($('sinstrucao').value)+Number($('sinvestigacao').value)+Number($('fmc').value);

	$('total01_15').value = Math.round(((Number($('total01').value)+(((Number($('total01').value)*15)/100)))*100))/100;
	$('total02').value = Math.ceil(Number($('total01_15').value));
	
	$('efetivoTotal').value=Math.ceil(Number($('total02').value)+Number($('total_inteiro').value));
	
	//efetivooperacional[total][]
}

function atsadd(){
			subtrai("ControleInicioTurno","ControleFimTurno", "ControleHoras");

			var n1 = new Number($('ControleHoras').value);
			var n2 = new Number($('ControleTotal').value);
			var n3 = new Number($('AditivoCargaMinima').value);
			var n4 = new Number();
			n4 = n1*n2*30/n3;
			n4 = ((Math.round(n4*100))/100);
			$('ControleEfetivoOperacional').value = n4.toString();
			
			var cabeca = '<TABLE CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center"><COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP><TBODY><TR>';
			var campo1 = '<td>'+$('ControleNrTurno').value+'&ordm;</td>';
			var campo2 = '<td>'+$('ControleInicioTurno').value+'</td>';
			var campo3 = '<td>'+$('ControleFimTurno').value+'</td>';
			var campo4 = '<td>'+$('ControleHoras').value+'</td>';
			var campo5 = '<td>'+$('ControleControle').value+'</td>';
			var campo6 = '<td>'+$('ControleAsssitente').value+'</td>';
			var campo7 = '<td>'+$('ControleTotal').value+'</td>';
			var campo8 = '<td>'+$('ControleEfetivoOperacional').value+'<input  id="ats_id'+$('ControleNrTurno').value+'"   name="efetivooperacional[total][]"  type="hidden" value="'+$('ControleEfetivoOperacional').value+'"></td>';
			var campo9 = '<td>'+"<a onClick=\"$('ats"+$('ControleNrTurno').value+"').remove();calculaTotal();\"><span><img border='0' alt='Excluir' src='<?php echo $this->webroot; ?>img/lixo.gif' /></span></a>"+'</td></tr></tbody></table>';
			$('item01').innerHTML = $('item01').innerHTML + '<div id=\'ats'+$('ControleNrTurno').value+'\' style=\'margin:0 auto;padding:0;\'>'+cabeca+campo1+campo2+campo3+campo4+campo5+campo6+campo7+campo8+campo9+'</div>';
			
			$('ControleNrTurno').value =$('ControleNrTurno').options[$('ControleNrTurno').options.selectedIndex+1].value;

			calculaTotal();
			
}

function setorialadd(){
			subtrai("SetorialInicioTurno","SetorialFimTurno", "SetorialHoras");

			var n1 = new Number($('SetorialHoras').value);
			var n2 = new Number($('SetorialTotal').value);
			var n3 = new Number($('AditivoCargaMinima').value);
			var n4 = new Number();
			n4 = n1*n2*30/n3;
			n4 = ((Math.round(n4*100))/100);
			$('SetorialEfetivoOperacional').value = n4.toString();
																						
			var cabeca = '<TABLE CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center"><COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP><TBODY><TR>';
			var campo1 = '<td>'+$('SetorialNrTurno').value+'&ordm;</td>';
			var campo2 = '<td>'+$('SetorialInicioTurno').value+'</td>';
			var campo3 = '<td>'+$('SetorialFimTurno').value+'</td>';
			var campo4 = '<td>'+$('SetorialHoras').value+'</td>';
			var campo5 = '<td colspan="2">'+$('SetorialSupSetorial').value+'</td>';
			var campo7 = '<td>'+$('SetorialTotal').value+'</td>';
			var campo8 = '<td>'+$('SetorialEfetivoOperacional').value+'<input  id="setorial_id'+$('SetorialNrTurno').value+'"   name="efetivooperacional[total][]"  type="hidden" value="'+$('SetorialEfetivoOperacional').value+'"></td>';
			var campo9 = '<td>'+"<a onClick=\"$('setorial"+$('SetorialNrTurno').value+"').remove();calculaTotal();\"><span><img border='0' alt='Excluir' src='<?php echo $this->webroot; ?>img/lixo.gif' /></span></a>"+'</td></tr></tbody></table>';
			$('item02').innerHTML = $('item02').innerHTML + '<div id=\'setorial'+$('SetorialNrTurno').value+'\' style=\'margin:0 auto;padding:0;\'>'+cabeca+campo1+campo2+campo3+campo4+campo5+campo7+campo8+campo9+'</div>';
			
			$('SetorialNrTurno').value =$('SetorialNrTurno').options[$('SetorialNrTurno').options.selectedIndex+1].value;

			calculaTotal();
			
}

function equipeadd(){
	subtrai("EquipeInicioTurno","EquipeFimTurno", "EquipeHoras");

	var n1 = new Number($('EquipeHoras').value);
	var n2 = new Number($('EquipeTotal').value);
	var n3 = new Number($('AditivoCargaMinima').value);
	var n4 = new Number();
	n4 = n1*n2*30/n3;
	n4 = ((Math.round(n4*100))/100);
	$('EquipeEfetivoOperacional').value = n4.toString();
																				
	var cabeca = '<TABLE CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center"><COLGROUP><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=60><COL WIDTH=100><COL WIDTH=100><COL WIDTH=120><COL WIDTH=120><COL WIDTH=20></COLGROUP><TBODY><TR>';
	var campo1 = '<td>'+$('EquipeNrTurno').value+'&ordm;</td>';
	var campo2 = '<td>'+$('EquipeInicioTurno').value+'</td>';
	var campo3 = '<td>'+$('EquipeFimTurno').value+'</td>';
	var campo4 = '<td>'+$('EquipeHoras').value+'</td>';
	var campo5 = '<td colspan="2">'+$('EquipeSupEquipe').value+'</td>';
	var campo7 = '<td>'+$('EquipeTotal').value+'</td>';
	var campo8 = '<td>'+$('EquipeEfetivoOperacional').value+'<input  id="equipe_id'+$('EquipeNrTurno').value+'"   name="efetivooperacional[total][]"  type="hidden" value="'+$('EquipeEfetivoOperacional').value+'"></td>';
	var campo9 = '<td>'+"<a onClick=\"$('equipe"+$('EquipeNrTurno').value+"').remove();calculaTotal();\"><span><img border='0' alt='Excluir' src='<?php echo $this->webroot; ?>img/lixo.gif' /></span></a>"+'</td></tr></tbody></table>';
	$('item03').innerHTML = $('item03').innerHTML + '<div id=\'equipe'+$('EquipeNrTurno').value+'\' style=\'margin:0 auto;padding:0;\'>'+cabeca+campo1+campo2+campo3+campo4+campo5+campo7+campo8+campo9+'</div>';
	
	$('EquipeNrTurno').value =$('EquipeNrTurno').options[$('EquipeNrTurno').options.selectedIndex+1].value;
	
	calculaTotal();
	
}
function subtrai(horaInicio, horaFim, destino){
	        temp = 0;
	        nova_h = 0;
	        novo_m = 0;
	        hora1 = $(horaFim).value.substr(0, 2);
	        hora2 = $(horaInicio).value.substr(0, 2);
	        minu1 = $(horaFim).value.substr(3, 2);
	        minu2 = $(horaInicio).value.substr(3, 2);
	        temp = minu1 - minu2;
	        while(temp < 0) {
	                nova_h++;
	                temp = temp + 60;
	        }
	        novo_m = temp/60;
	        temp = hora1 - hora2 - nova_h;
	        while(temp < 0) {
	                temp = temp + 24;
	        }
	        nova_h = temp;
		$(destino).value = nova_h  + novo_m;
}

function soma(campo1, campo2){
	$('ControleTotal').value = Math.abs($(campo1).value) + Math.abs($(campo2).value); 	
}
//$('trotulo'+id).insert({ after: "\&nbsp;\&nbsp;\&nbsp;<a onClick=\"$('contaTurnos').value--;$('turno"+$('ControleNrTurno').value+"').remove();\"><span><img border='0' alt='Excluir' src='{$this->webroot}img/lixo.gif' /></span></a>" });
$('cadastraatcs').observe('mousedown', function(event){
	atsadd();
});
$('cadastraatcs').observe('keydown', function(event){		
	atsadd();
});
$('cadastrasetorial').observe('mousedown', function(event){
	setorialadd();
});
$('cadastrasetorial').observe('keydown', function(event){		
	setorialadd();
});
$('cadastraequipe').observe('mousedown', function(event){
	equipeadd();
});
$('cadastraequipe').observe('keydown', function(event){		
	equipeadd();
});

</script>

<div class="aditivos form">
<?php echo $form->create('Aditivo', array('action'=>'add','onsubmit'=>'return false;','type'=>'file', 'inputDefaults' => array('label' => false,'div' => false)));?>
<?php 
		echo $ajax->div('opcoesTurnos');
		echo $ajax->divEnd('opcoesTurnos');
?>
<TABLE FRAME=VOID CELLSPACING=0 COLS=8 RULES=NONE BORDER=0>
	<COLGROUP><COL WIDTH=60><COL WIDTH=64><COL WIDTH=20><COL WIDTH=60><COL WIDTH=20><COL WIDTH=20><COL WIDTH=20><COL WIDTH=200></COLGROUP>
	<TBODY>
		<TR>
			<TD COLSPAN=8 WIDTH=728 HEIGHT=20 style="background-color:#f0f000;text-align:center;border: 3px solid #000;"><B><FONT SIZE=3>SINCRONISMO DAS BASES DE DADOS DECEA-UNIDADES SUBORDINADAS</FONT></B></TD>
			</TR>
		<TR>
			<TD HEIGHT=15 ALIGN=LEFT colspan="8" style="background-color:#c0b000;text-align:center;">OS DADOS SERÃO ATUALIZADOS EM TODAS AS UNIDADES SUBORDINADAS</TD>
		</TR>
		<TR>
			<TD HEIGHT=16 ALIGN=LEFT>ORGÃO:</TD>
			<TD  style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			$orgaos['dctp']='DCTP';
			$orgaos['formdctp']='formdctp';
			
			$orgaos['sigpes']='SIGPES';
			$orgaos['LPNA']='LPNA';
			//$orgaos['hidra']='HIDRA';
			//$orgaos['icea']='ICEA';
			//$orgaos['saeweb']='SAEWEB';
			echo $form->input('orgao',array('type'=>'select','class'=>'formulario','options'=>$orgaos, 'label' => false));
			?>
			</TD>
			<TD ALIGN=LEFT><BR></TD>
			<TD ALIGN=LEFT>ATIVIDADE</TD>
			<TD COLSPAN="3"  style="background-color:#ffcc99;text-align:left;border: 3px solid #000;">
			<?php 
			$atividades['obter']='OBTER ATUALIZAÇÕES DAS TABELAS';
			//$atividades['enviar']='ATUALIZAR AS TABELAS';
			echo $form->input('atividade',array('type'=>'select','class'=>'formulario','options'=>$atividades, 'label' => false));
			?>
			</TD>
			<TD ALIGN=LEFT>
<?php 
	echo $ajax->link($this->Html->image('network_transmit.png', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar', 'id'=>'sincronismo')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();if($(\'AditivoOrgao\').value==\'formdctp\'){window.clearInterval(tempodesessao);$(\'sincronismo\').click();}','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
	echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));
?>
			 
			<?php echo $form->end();?></TD>
		</TR>
		<TR>
			<TD  style="background-color:#ccffcc;text-align:left;border: 3px solid #000;font-style:weight;"  colspan="8"><b>1 - OBTENDO DADOS DAS UNIDADES</b></TD>
		</TR>
<tr>
<td  colspan="8" style="align:center;">

<div id='formularios'>
<?php
/*
						$consultasgbdo = $this->Aditivo->query('select cpf from militars ');
						$registros = count($consultasgbdo);
						$inicio = 0;
						$cpfdctp = substr($consultasgbdo[$inicio]['militars']['cpf'],0,3).'.'.substr($consultasgbdo[$inicio]['militars']['cpf'],3,3).'.'.substr($consultasgbdo[$inicio]['militars']['cpf'],6,3).'-'.substr($consultasgbdo[$inicio]['militars']['cpf'],9,2);
*/

						
						
//						die();											

		



?>

</div>
<div id='item01' style="float:center;">
		</div>
		</td></tr>
		<TR>
			<TD   style="background-color:#ccffcc;text-align:left;border: 3px solid #000;height:16;" colspan="8"><b>2 - TRANSMITINDO DADOS PARA AS UNIDADES</b></TD>
		</TR>
<tr><td  colspan="8" style="align:center;">

<TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=160><COL WIDTH=100><COL WIDTH=100><COL WIDTH=260></COLGROUP>
<TBODY>
		<TR>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TABELA</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">INÍCIO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TÉRMINO</TD>
			<TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">STATUS</TD>
		</TR>
</tr></TBODY></TABLE>

</td>	
		</TR>
	</TBODY>
</TABLE>



</div>
<!-- ************************************************************************** -->

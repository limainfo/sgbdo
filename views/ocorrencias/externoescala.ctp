
<?php


if(($ano ==null)||($mes ==null)||($dia ==null)){
	list ($ano, $mes, $dia) = split ('[/.-]', date('Y-m-d'));
}
if(!empty($this->data['Ocorrencia']['data'])){
	list ($dia, $mes, $ano ) = split ('[/.-]', $this->data['Ocorrencia']['data']);
}

$dataReferencia = $ano.'-'.$mes.'-'.$dia;



//print_r($turnos);
//echo $turnos[1]['Supervisorturno']['status'];

//echo $u[0]['Usuario']['militar_id'];
$militar_id = $u[0]['Usuario']['militar_id'];

$acesso = 0;
if(empty($turnos[0]['Supervisorturno']['status'])){
	$abertura = $turnos[1]['Supervisorturno']['status'];
}


if($abertura=='ABERTA'){
	$aberta = 1;
}else{
	$aberta = 0;
}

if(($privilegio=='EXECUTANTE')&&($aberta==1)){
	$acesso = 1;
}
if(($privilegio=='EXECUTANTE')&&($aberta==0)){
	$privilegio=='CONSULTA';
}
if(($privilegio=='GERLOCAL')){
	$acesso = 1;
}
if(($privilegio=='GERREGIONAL')){
	$acesso = 1;
}
if(($privilegio=='CONSULTA')){
	$acesso = 0;
}


echo $form->create('Ocorrencia',array('action'=>'externoescala'."/".$setorId."/0/".$privilegio,'id'=>'consultaDia'));
echo $datePicker->picker('data',array('readonly'=>'','class'=>'formulario','readonly'=>'readonly','value'=>$this->data['Ocorrencia']['data']));
//,'onchange'=>'$(\'consultaDia\').submit();'

//echo "<input type=\"submit\" value=\"Consultar dia\" class=\"botoes\"  />";
echo $form->end();


?>
<script type="text/javascript">
//<![CDATA[
	//Event.observe('OcorrenciaData', 'change', function(event) {alert($('OcorrenciaData').value);$('consultaDia').submit(); }, false);
//]]>
</script>
<table align="center" border="0" width="100%">
	<tbody>
		<tr>
			<td colspan="6" align="center" style="background-color: #000099;"
				width="100%"><b><font color="#ffff00" size="2">LIVRO DE REGISTRO DE	OCORRÊNCIAS</font></b></td>
		</tr>
	</tbody>
</table>
<p align="left"><font color="#0000ff" size="5"><b><?php echo $ocorrencias[0][0]['Setor']; ?></b></font>
<br>
<?php

//echo $libera;
//print_r($turnos);

if($libera<1){
	$i = 0;
	$conta = 0;


	echo "<table align=\"center\" border=\"1\" width=\"100%\"><tbody><tr><th>DATA</th><th>TURNO</th><th>STATUS</th><th>EXECUTANTE</th><th>GERENTE LOCAL</th><th>GERENTE REGIONAL</th><th>PDF</th></tr>";

	foreach($turnos as $turno){

		if ($i++ % 2 == 0) {
			$td = ' style="background-color:#E0E0F0;" ';
		}else{
			$td='';
		}


		if($turno['Supervisorturno']['status']=='ABERTA'){
			$cor = "#008000";
		}else{
			$cor = "#000080";
		}


		list($anolink, $meslink, $dialink) = split('-',$turno['Supervisorturno']['data']);
		$novolink = $this->webroot.'ocorrencias/'.$this->action."/".$setorId."/".$turno['Turno']['id']."/".$privilegio.'/'.$anolink.'/'.$meslink.'/'.$dialink;
		$link =$this->Html->link($this->Html->image('pdf.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'externopdf'."/".$setorId."/".$turno['Turno']['id']."/".$privilegio.'/'.$anolink.'/'.$meslink.'/'.$dialink, null),array('escape'=>false, 'escape'=>false), null,false);

		echo "<tr id='{$conta}'>";
		echo "<td {$td}>{$turno['Supervisorturno']['data']}</td>";
		echo "<td {$td}>".$turno['Turno']['rotulo']." -> ".$turno['Turno']['hora_inicio']." - ".$turno['Turno']['hora_termino']."</td>";

		if($turno['Supervisorturno']['status']==''){
			echo "<td {$td}>NÃO DISPONÍVEL</td>"; 
		}else{
			if($turno['Supervisorturno']['status']=='ABERTA'){
				echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/laranjap.gif\" /></a></td>";
			}
			if($turno['Supervisorturno']['status']=='FECHAMENTO AUTOMÁTICO'){
				echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/vermelhop.gif\" /></a></td>";
			}
			if($turno['Supervisorturno']['status']=='ASSINADO'){
				echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/verdep.gif\" /></a></td>";
			}
		}

		if($turno['Supervisorturno']['executante']>0){
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/verdep.gif\" /></a></td>";
		}else{
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/vermelhop.gif\" /></a></td>";
		}
		if($turno['Supervisorturno']['gerenteLocal']>0){
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/verdep.gif\" /></a></td>";
		}else{
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/vermelhop.gif\" /></a></td>";
		}
		if($turno['Supervisorturno']['gerenteRegional']>0){
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/verdep.gif\" /></a></td>";
		}else{
			echo "<td {$td}><a href=\"{$novolink}\"><img border=\"0\" title=\"Prevista\" alt=\"Exibir\"	src=\"{$this->webroot}img/vermelhop.gif\" /></a></td>";
		}
		echo "<td {$td}>{$link}</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?> <?php
if($libera>0){
	//style="display:none;"
	?></p>
<div id="conteudo">
<table border="0" bordercolor="#808080" cellpadding="0" cellspacing="0"
	height="30" width="100%">
	<tbody>
		<tr>
			<td width="20%" align="left" style="background-color: #6699ff"
				valign="middle"><font color="#FFFFFF" size="2"><b>CHEFE DE EQUIPE: </b></font></td>
			<td width="80%" align="left" style="background-color: #6699ff"
				valign="middle">
			<div id="chefeEquipe"><?php
			if($cumprindoescala[0]['Escala']['livro']=='ACCAZ'){
				$nomespvChf = $spvChefeEquipeMN[0]['Posto']['sigla_posto'].' '.$spvChefeEquipeMN[0]['Especialidade']['nm_especialidade'].'  '.$spvChefeEquipeMN[0]['Militar']['nm_completo'];
				$nomespvChf = str_replace($spvChefeEquipeMN[0]['Militar']['nm_guerra'], "<b>".$spvChefeEquipeMN[0]['Militar']['nm_guerra']."</b>", $nomespvChf);
				$nomespvChf = str_replace($spvChefeEquipeMN[0]['Posto']['sigla_posto'], "<b>".$spvChefeEquipeMN[0]['Posto']['sigla_posto']."</b>", $nomespvChf);
				$nomespvChf = '<div id="chefeEquipeAtual">'.$nomespvChf;
				$idChefeEquipe = $spvChefeEquipeMN[0]['MilitarsEscala']['militar_id'];
				$cumprimentoid = $spvChefeEquipeMN[0]['Cumprimentoescala']['id'];
			}else{
				$nomespvChf = $spvChefeEquipe[0]['Posto']['sigla_posto'].' '.$spvChefeEquipe[0]['Especialidade']['nm_especialidade'].'  '.$spvChefeEquipe[0]['Militar']['nm_completo'];
				$nomespvChf = str_replace($spvChefeEquipe[0]['Militar']['nm_guerra'], "<b>".$spvChefeEquipe[0]['Militar']['nm_guerra']."</b>", $nomespvChf);
				$nomespvChf = str_replace($spvChefeEquipe[0]['Posto']['sigla_posto'], "<b>".$spvChefeEquipe[0]['Posto']['sigla_posto']."</b>", $nomespvChf);
				$nomespvChf = '<div id="chefeEquipeAtual">'.$nomespvChf;
				$idChefeEquipe = $spvChefeEquipe[0]['MilitarsEscala']['militar_id'];
				$cumprimentoid = $spvChefeEquipeMN[0]['Cumprimentoescala']['id'];
			}
			if(empty($idChefeEquipe)){
				echo "NÃO HÁ.";		
			}else{
				echo $nomespvChf;
				echo "&nbsp;";
				if(($privilegio=='EXECUTANTE')&&($acesso==1)){
					echo "<a href=\"#\" onclick=\"\$('militarIdChefeEquipe').value={$idChefeEquipe};\$('cumprimentoEscalaIdChefeEquipe').value={$cumprimentoid};exibe('chefeequipe');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
				}
				echo "</div>";
			}
			?></div>
			</td>
			<td width="10%" align="left" style="background-color: #6699ff"
				valign="middle"><?php
				$link =$this->Html->link($this->Html->image('pdf.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar','style'=>'float:right;')), array('action'=>'externopdf', null),array('escape'=>false, 'escape'=>false), null,false);
				echo $link;
				?></td>
		</tr>
	</tbody>
</table>
<table border="0" cellpadding="2" cellspacing="4" height="30"
	width="100%">
	<tbody>
		<tr>
			<td rowspan="2" align="center" bgcolor="#c0c0c0" valign="top"
				width="20%"><font color="#000080" size="2"><b>DATA:<br>
			</b></font><font color="#0000ff" size="2"><?php echo $turnos[0]['Supervisorturno']['data'];   ?></font></td>
			<td rowspan="2" align="center" bgcolor="#c0c0c0" valign="top"
				width="25%"><font size="2"><b><font color="#000080">TURNO:</font><font
				color="#ffff00"><br>
			</font></b><font color="#0000ff"><?php echo $turnos[0]['Turno']['hora_inicio']." - ".$turnos[0]['Turno']['hora_termino']; ?></font></font></td>
			<td rowspan="2" align="center" bgcolor="#c0c0c0" valign="top"
				width="35%"><font color="#000080" size="2"> <?php
				if($cumprindoescala[0]['Escala']['livro']=='ACCAZ'){
					$idSupervisorGeral = $spvGeralMN[0]['MilitarsEscala']['militar_id'];
					$nomeSupervisorGeral = $spvGeralMN[0]['Posto']['sigla_posto'].' '.$spvGeralMN[0]['Especialidade']['nm_especialidade'].'  '.$spvGeralMN[0]['Militar']['nm_completo'];
					$nomeSupervisorGeral = str_replace($spvGeralMN[0]['Militar']['nm_guerra'], "<b>".$spvGeralMN[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorGeral);
					$nomeSupervisorGeral = str_replace($spvGeralMN[0]['Posto']['sigla_posto'], "<b>".$spvGeralMN[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorGeral);
					$cumprimentoid = $spvGeralMN[0]['Cumprimentoescala']['id'];

					if(empty($idSupervisorGeral)){
						echo "NÃO HÁ.";		
					}else{
						echo "SUPERVISOR GERAL:<font  size=\"1\"	color=\"#000000\"><br><div id=\"supervisorGeralAtual\">{$nomeSupervisorGeral}</font>";
						echo "&nbsp;";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							echo "<a href=\"#\" onclick=\"\$('militarIdSupervisorGeral').value={$idSupervisorGeral};\$('cumprimentoEscalaIdSupervisorGeral').value={$cumprimentoid};exibe('supervisorgeral');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						echo "</div>";
					}

				}else{
					$idSupervisorGeral = $spvGeral[0]['MilitarsEscala']['militar_id'];
					$nomeSupervisorGeral = $spvGeral[0]['Posto']['sigla_posto'].' '.$spvGeral[0]['Especialidade']['nm_especialidade'].'  '.$spvGeral[0]['Militar']['nm_completo'];
					$nomeSupervisorGeral = str_replace($spvGeral[0]['Militar']['nm_guerra'], "<b>".$spvGeral[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorGeral);
					$nomeSupervisorGeral = str_replace($spvGeral[0]['Posto']['sigla_posto'], "<b>".$spvGeral[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorGeral);
					$cumprimentoid = $spvGeral[0]['Cumprimentoescala']['id'];

					if(empty($idSupervisorGeral)){
						echo "NÃO HÁ.";		
					}else{
						echo "SUPERVISOR DE EQUIPE<font size=\"1\"	color=\"#000000\"><br><div id=\"supervisorGeralAtual\">{$nomeSupervisorGeral}</font>";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							echo "<a href=\"#\" onclick=\"\$('militarIdSupervisorGeral').value={$idSupervisorGeral};\$('cumprimentoEscalaIdSupervisorGeral').value={$cumprimentoid};exibe('supervisorgeral');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						echo "</div>";

					}

				}
				?> </font></td>
			<td align="center" bgcolor="#c0c0c0" valign="top" width="20%"><font
				color="#000080" size="2"><b>STATUS</b></font></td>
		</tr>
		<tr>
			<td align="center" bgcolor="#c0c0c0" valign="top" width="20%"><font
				color="#ff0000" size="2"><b><?php echo $turnos[0]['Supervisorturno']['status']; ?></b></font></td>
		</tr>
	</tbody>
</table>
<table border="2" bordercolor="#808080" cellpadding="0" cellspacing="0"
	width="100%">
	<tbody>
		<tr>
			<td valign="top">
			<table valign="top" border="0" bordercolor="#808080" cellpadding="0"
				cellspacing="0" width="100%">
				<tbody>
				<?php
				$nomeSupervisorRegional = $spvRegional[0]['Posto']['sigla_posto'].' '.$spvRegional[0]['Especialidade']['nm_especialidade'].'  '.$spvRegional[0]['Militar']['nm_completo'];
				$nomeSupervisorRegional = str_replace($spvRegional[0]['Militar']['nm_guerra'], "<b>".$spvRegional[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorRegional);
				$nomeSupervisorRegional = str_replace($spvRegional[0]['Posto']['sigla_posto'], "<b>".$spvRegional[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorRegional);
				$idSupervisorRegional = $spvRegional[0]['MilitarsEscala']['militar_id'];
				$cumprimentoid = $spvRegional[0]['Cumprimentoescala']['id'];

				$nomeSupervisorRegional =  '<div id="supervisorRegionalAtual">'.$nomeSupervisorRegional;
				//$nomespv2 =  '<div id="supervisorRegionalAtual'.'">'.$nomespv2;
				$link = "&nbsp;";
				if(($privilegio=='EXECUTANTE')&&($acesso==1)){
					$link = "<a href=\"#\" onclick=\"\$('militarIdSupervisorRegional').value={$idSupervisorRegional};\$('supervisorRegionalMilitarId').value={$idSupervisorRegional};exibe('supervisorregional');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
				}
				$link .= "</div>";


				//$link = "&nbsp;<a href=\"#\" onclick=\"\$('supervisorRegionalMilitarId').value={$idSupervisorRegional};exibe('supervisorregional');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a></div>";
				$nomeSupervisorRegional .= $link;

				if($cumprindoescala[0]['Escala']['livro']=='ACCAZ'){
					$nomeSupervisorRegionalMN = $spvRegionalMN[0]['Posto']['sigla_posto'].' '.$spvRegionalMN[0]['Especialidade']['nm_especialidade'].'  '.$spvRegionalMN[0]['Militar']['nm_completo'];
					$nomeSupervisorRegionalMN = str_replace($spvRegionalMN[0]['Militar']['nm_guerra'], "<b>".$spvRegionalMN[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorRegionalMN);
					$nomeSupervisorRegionalMN = str_replace($spvRegionalMN[0]['Posto']['sigla_posto'], "<b>".$spvRegionalMN[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorRegionalMN);
					$idSupervisorRegionalMN = $spvRegionalMN[0]['MilitarsEscala']['militar_id'];
					$nomeSupervisorRegionalMN =  '<div id="supervisorRegionalMU'.$idSupervisorRegionalMN.'">'.$nomeSupervisorRegionalMN;
					$cumprimentoid = $spvRegionalMN[0]['Cumprimentoescala']['id'];
					$linkMN = "&nbsp;";
					if(($privilegio=='EXECUTANTE')&&($acesso==1)){
						$linkMN = "<a href=\"#\" onclick=\"\$('militarIdSupervisorRegionalMU').value={$idSupervisorRegionalMN};\$('cumprimentoEscalaIdSupervisorRegionalMU').value={$cumprimentoid};exibe('supervisorRegionalMU');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
					}
					$linkMN .= "</div>";
					$nomeSupervisorRegionalMN .= $linkMN;

					$nomeSupervisorRegionalBL = $spvRegionalBL[0]['Posto']['sigla_posto'].' '.$spvRegionalBL[0]['Especialidade']['nm_especialidade'].'  '.$spvRegionalBL[0]['Militar']['nm_completo'];
					$nomeSupervisorRegionalBL = str_replace($spvRegionalBL[0]['Militar']['nm_guerra'], "<b>".$spvRegionalBL[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorRegionalBL);
					$nomeSupervisorRegionalBL = str_replace($spvRegionalBL[0]['Posto']['sigla_posto'], "<b>".$spvRegionalBL[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorRegionalBL);
					$idSupervisorRegionalBL = $spvRegionalBL[0]['MilitarsEscala']['militar_id'];
					$nomeSupervisorRegionalBL =  '<div id="supervisorRegionalBL'.$idSupervisorRegionalBL.'">'.$nomeSupervisorRegionalBL;
					$cumprimentoid = $spvRegionalBL[0]['Cumprimentoescala']['id'];
					$linkBL = "&nbsp;";
					if(($privilegio=='EXECUTANTE')&&($acesso==1)){
						$linkBL = "<a href=\"#\" onclick=\"\$('militarIdSupervisorRegionalBL').value={$idSupervisorRegionalBL};\$('cumprimentoEscalaIdSupervisorRegionalBL').value={$cumprimentoid};exibe('supervisorRegionalBL');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
					}
					$linkBL .= "</div>";
					$nomeSupervisorRegionalBL .= $linkBL;

					$nomeSupervisorRegionalPH = $spvRegionalPH[0]['Posto']['sigla_posto'].' '.$spvRegionalPH[0]['Especialidade']['nm_especialidade'].'  '.$spvRegionalPH[0]['Militar']['nm_completo'];
					$nomeSupervisorRegionalPH = str_replace($spvRegionalPH[0]['Militar']['nm_guerra'], "<b>".$spvRegionalPH[0]['Militar']['nm_guerra']."</b>", $nomeSupervisorRegionalPH);
					$nomeSupervisorRegionalPH = str_replace($spvRegionalPH[0]['Posto']['sigla_posto'], "<b>".$spvRegionalPH[0]['Posto']['sigla_posto']."</b>", $nomeSupervisorRegionalPH);
					$idSupervisorRegionalPH = $spvRegionalPH[0]['MilitarsEscala']['militar_id'];
					$nomeSupervisorRegionalPH =  '<div id="supervisorRegionalPH'.$idSupervisorRegionalPH.'">'.$nomeSupervisorRegionalPH;
					$cumprimentoid = $spvRegionalPH[0]['Cumprimentoescala']['id'];
					$linkPH = "&nbsp;";
					if(($privilegio=='EXECUTANTE')&&($acesso==1)){
						$linkPH = "<a href=\"#\" onclick=\"\$('militarIdSupervisorRegionalPH').value={$idSupervisorRegionalPH};\$('cumprimentoEscalaIdSupervisorRegionalPH').value={$cumprimentoid};exibe('supervisorRegionalPH');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
					}
					$linkPH .= "</div>";
					//$linkPH = "&nbsp;<a href=\"#\" onclick=\"\$('supervisorRegionalMilitarId').value={$idSupervisorRegionalPH};exibe('supervisorregional');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a></div>";
					$nomeSupervisorRegionalPH .= $linkPH;

					//	print_r($spvRegionalBL);
					?>

					<tr>
						<td align="center" style="background-color: #6699cc" width="33%"><b><font
							color="#ffffff" size="3">Supervisor Regional MU</font></b></td>
						<td align="center" style="background-color: #6699cc" width="33%"><b><font
							color="#ffffff" size="3">Supervisor Regional BE</font></b></td>
						<td align="center" style="background-color: #6699cc" width="33%"><b><font
							color="#ffffff" size="3">Supervisor Regional PH</font></b></td>
					</tr>
					<tr>
						<td align="center" bgcolor="#c0c0c0" valign="top" width="33%"><?php //echo $nomeSupervisorRegionalMN;
					if(empty($idSupervisorRegionalMN)){
						echo "NÃO REQUER<BR>";
					}else{
						echo $this->Html->link($nomeSupervisorRegionalMN.'<br>', array('action'=>'externoescala/192', null),array('id'=>'192', 'onclick'=>'return false;', 'escape'=>false), null,false);
					}

					?> <br>
						</td>
						<td align="center" bgcolor="#c0c0c0" valign="top" width="33%"><?php 
						if(empty($idSupervisorRegionalBL)){
							echo "NÃO REQUER<BR>";
						}else{
							echo $this->Html->link($nomeSupervisorRegionalBL.'<br>', array('action'=>'externoescala/2', null),array('id'=>'2', 'onclick'=>'return false;', 'escape'=>false), null,false);
						}
						?> <br>
						</td>
						<td align="center" bgcolor="#c0c0c0" valign="top" width="33%"><?php 
						if(empty($idSupervisorRegionalPH)){
							echo "NÃO REQUER<BR>";
						}else{
							echo $this->Html->link($nomeSupervisorRegionalPH.'<br>', array('action'=>'externoescala/193', null),array('id'=>'193', 'onclick'=>'return false;', 'escape'=>false), null,false);
						}
						?> <br>
						</td>
					</tr>

					<?php
				}else{
					if(empty($spvRegional)){
						$nomeSupervisorRegional = 'NÃO REQUER';	
					}
					?>
					<tr>
						<td align="center" style="background-color: #6699cc" colspan="3"><b><font
							color="#ffffff" size="3">SUPERVISOR REGIONAL</font></b></td>
					</tr>
					<tr>
						<td align="center" bgcolor="#c0c0c0" valign="top" colspan="3"><font
							size="1">
						<div class="input text"
							id="supervisorRegional<?php echo $idSupervisorRegional; ?>"><?php	echo "<font	color=\"#000000\"><br>{$nomeSupervisorRegional}</font>"; ?></div>
						<br>
						</font></td>
					</tr>

					<?php
				}

				if($cumprindoescala[0]['Escala']['livro']!='ACCAZ'){
					echo "<tr><td align=\"center\"  style=\"background-color: #6699cc\"  colspan=\"3\"><b><font color=\"#ffffff\" size=\"3\">CONTROLADOR</font></b></td></tr> ";
					foreach ($cumprindoescala as $escalado){
						$idcontrolador = $escalado['MilitarsEscala']['militar_id'];
						$nomeControlador = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
						$nomeControlador = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nomeControlador);
						$nomeControlador = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nomeControlador);
						$nomeControlador =  '<div id="controlador'.$idcontrolador.'">'.$nomeControlador.$escalado['Turno']['hora_inicio'];
						$cumprimentoid = $escalado['Cumprimentoescala']['id'];
						$link = "&nbsp;";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							$link = "<a href=\"#\" onclick=\"\$('militarIdControlador').value={$idcontrolador};\$('cumprimentoEscalaIdControlador').value={$cumprimentoid};exibe('controladores');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						$link .= "</div>";
							
						$nomeControlador .= $link;
							
							
						echo $this->Html->link($nomeControlador.'<br>', array('action'=>'externoescala/'.$ocorrencia['Setor']['id'], null),array('id'=>$ocorrencia['Setor']['id'], 'onclick'=>'return false;', 'escape'=>false), null,false);
						echo "</font>";

					}
					echo "</td></tr>";

				}else{
					echo "<tr>";
					echo "<td align=\"center\"  style=\"background-color: #6699cc\"  width=\"33%\"><b><font color=\"#ffffff\" size=\"3\">Controlador MU</font></b></td>
			<td align=\"center\"  style=\"background-color: #6699cc\"  width=\"33%\"><b><font color=\"#ffffff\" size=\"3\">Controlador BE</font></b></td>
			<td align=\"center\"  style=\"background-color: #6699cc\"  width=\"33%\"><b><font color=\"#ffffff\" size=\"3\">Controlador PH</font></b></td>
			</tr><tr> ";
					echo "<td align=\"center\"  width=\"33%\">";
					foreach ($cumprindoescala as $escalado){
						$idcontrolador = $escalado['MilitarsEscala']['militar_id'];
						$nomeControlador = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
						$nomeControlador = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nomeControlador);
						$nomeControlador = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nomeControlador);
						$nomeControlador =  '<div id="controladorMU'.$idcontrolador.'">'.$nomeControlador.$escalado['Turno']['hora_inicio'];
						$cumprimentoid = $escalado['Cumprimentoescala']['id'];
						$link = "&nbsp;";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							$link = "<a href=\"#\" onclick=\"\$('militarIdControladorMU').value={$idcontrolador};\$('cumprimentoEscalaIdControladorMU').value={$cumprimentoid};exibe('controladoresMU');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						$link .= "</div>";
						//$link = "&nbsp;<a href=\"#\" onclick=\"\$('controladorMilitarId').value={$idcontrolador};exibe('controladores');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a></div>";
						$nomeControlador .= $link;
						if($escalado['Escala']['setor_id']==192){
							echo $this->Html->link($nomeControlador.'<br>', array('action'=>'externoescala/'.$ocorrencia['Setor']['id'], null),array('id'=>$ocorrencia['Setor']['id'], 'onclick'=>'return false;', 'escape'=>false), null,false);
						}
					}
					echo "</td>";

					echo "<td align=\"center\"  width=\"33%\">";
					foreach ($cumprindoescala as $escalado){
						$idcontrolador = $escalado['MilitarsEscala']['militar_id'];
						$nomeControlador = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
						$nomeControlador = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nomeControlador);
						$nomeControlador = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nomeControlador);
						$nomeControlador =  '<div id="controladorBL'.$idcontrolador.'">'.$nomeControlador.$escalado['Turno']['hora_inicio'];
						$cumprimentoid = $escalado['Cumprimentoescala']['id'];
						$link = "&nbsp;";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							$link = "<a href=\"#\" onclick=\"\$('militarIdControladorBL').value={$idcontrolador};\$('cumprimentoEscalaIdControladorBL').value={$cumprimentoid};exibe('controladoresBL');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						$link .= "</div>";
						$nomeControlador .= $link;
						if($escalado['Escala']['setor_id']==2){
							echo $this->Html->link($nomeControlador.'<br>', array('action'=>'externoescala/'.$ocorrencia['Setor']['id'], null),array('id'=>$ocorrencia['Setor']['id'], 'onclick'=>'return false;', 'escape'=>false), null,false);
						}
					}
					echo "</td>";

					echo "<td align=\"center\"  width=\"33%\">";
					foreach ($cumprindoescala as $escalado){
						$idcontrolador = $escalado['MilitarsEscala']['militar_id'];
						$nomeControlador = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
						$nomeControlador = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nomeControlador);
						$nomeControlador = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nomeControlador);
						$nomeControlador =  '<div id="controladorPH'.$idcontrolador.'">'.$nomeControlador.$escalado['Turno']['hora_inicio'];
						$cumprimentoid = $escalado['Cumprimentoescala']['id'];
						$link = "&nbsp;";
						if(($privilegio=='EXECUTANTE')&&($acesso==1)){
							$link = "<a href=\"#\" onclick=\"\$('militarIdControladorPH').value={$idcontrolador};\$('cumprimentoEscalaIdControladorPH').value={$cumprimentoid};exibe('controladoresPH');\"><img border=\"0\" title=\"Cadastrar\" alt=\"Cadastrar\" height=\"10\" src=\"{$this->webroot}img/lapis.gif\"/></a>";
						}
						$link .= "</div>";
						$nomeControlador .= $link;
						if($escalado['Escala']['setor_id']==193){
							echo $this->Html->link($nomeControlador.'<br>', array('action'=>'externoescala/'.$ocorrencia['Setor']['id'], null),array('id'=>$ocorrencia['Setor']['id'], 'onclick'=>'return false;', 'escape'=>false), null,false);
						}
					}
					echo "</td>";

				}

				?>



				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
<script type="text/javascript">
function cienteNegativo(){
	v2 = $('DespachoRegionalCienteGerenteRegional').checked;
	v1 = $('DespachoLocalCienteGerenteLocal').checked;
	if(v1==false){
    	$('formDespachoLocal').reset();
  		$('despachoslocalform').hide();
	}
	if(v2==false){
    	$('formDespachoRegional').reset();
  		$('despachosregionalform').hide();
	}
}
function atualizaDestinatario() {
	var form = $('ldapForm');
	check = form.getInputs('checkbox');
	conteudo = '';
	i = 0;
	check.each(function(e){
		if(e.checked){
			if(i==0){
					conteudo = e.value; 
					i++;
			}else{
					conteudo = conteudo +' , '+e.value;
					
			}
		}
	
	});
	$('DespachoRegionalDestinatarios').value = conteudo;
	$('DespachoLocalDestinatarios').value = conteudo;
	$('mensagem').hide(); 

}
function setCheckedValue(formulario, valor) {
	var form = $(formulario);
	radios = form.getInputs('radio');
	radios.each(function(e){
	if(e.value==valor){
		e.checked = true; 
		}else{
		e.checked = false;
		}
	});

}

function esconde(){
    $('chefeequipe').hide();
    $('supervisorRegional').hide();
    $('supervisorgeral').hide();
    $('controladores').hide();
    $('supervisorRegionalMU').hide();
    $('supervisorRegionalBL').hide();
    $('supervisorRegionalPH').hide();
    $('controladoresMU').hide();
    $('controladoresBL').hide();
    $('controladoresPH').hide();
    
    for(i=0;i<100;i++){
	if(i<10){
	  nome = 'tabela00'+i;
	  d1 = 'despachosregional00'+i;
	  d2 = 'despachoregional00'+i;
	}else{
	  nome = 'tabela0'+i;
	  d1 = 'despachosregional0'+i;
	  d2 = 'despachoregional0'+i;
	}
    	if($(d1)!=null){
    		$(d1).hide();
		}    	
    	if($(d2)!=null){
    		$(d2).hide();
		}    	
    	if($(nome)!=null){
    		$(nome).hide();
    	}
    }
    $('despachoslocal').hide();
    $('despachosregional').hide();
 	$('mensagem').hide();
  	$('mensagem').hide();
}

function despacholocal(tabelaid, id, conteudo, dataDespacho){
    $('formDespachoLocal').reset();
    $('despachoslocalform').hide();
	$('DespachoLocalMotivo').value = decodeURIComponent(conteudo);
	$('DespachoLocalDataDespacho').value = dataDespacho;
	$('DespachoLocalId').value = id;
	$('DespachoLocalSupervisorturnoId').value = <?php echo $supervisorturnoid;  ?>;
	$('DespachoLocalTabelaid').value = tabelaid;
	//esconde();
    
    ShowContent('despachoslocal');
}

function despachoregional(tabelaid, id, conteudo, dataDespacho){

    $('formDespachoRegional').reset();
    $('despachosregionalform').hide();
	$('DespachoRegionalMotivo').value = decodeURIComponent(conteudo);
	$('DespachoRegionalDataDespacho').value = dataDespacho;
	$('DespachoRegionalId').value = id;
	$('DespachoRegionalSupervisorturnoId').value = <?php echo $supervisorturnoid;  ?>;
	var nome = '';
	if(tabelaid<10){
	  nome = 'tabela00'+tabelaid;
	}else{
		if(tabelaid<99){
	 		 nome = 'tabela0'+tabelaid;
	 	 }else{
		 	 nome = 'tabela'+tabelaid;
	 	 }
	}
	$('DespachoRegionalNomeTabela').value = nome;
	
    ShowContent('despachosregional');
}

function mostra(tabelaid){
	if(tabelaid<10){
	  nome = 'tabela00'+tabelaid;
	}else{
		if(tabelaid<99){
	 		 nome = 'tabela0'+tabelaid;
	 	 }else{
		 	 nome = 'tabela'+tabelaid;
	 	 }
	}
	  nomeDados = nome+'Dados';
	$(nome).show();
	$(nomeDados).show();
	  
	
}

function exibe(caixa){

	//esconde();

  if(caixa=='chefeequipe'){
    $('chefeEquipeEscalado').innerHTML = $('chefeEquipeAtual').innerHTML;
    ShowContent('chefeequipe');
  }
  if(caixa=='supervisorRegional'){
    $('supervisorRegionalEscalado').innerHTML = $('supervisorRegionalAtual').innerHTML;
    ShowContent('supervisorRegional');
  }
  if(caixa=='supervisorgeral'){
    $('supervisorGeralEscalado').innerHTML = $('supervisorGeralAtual').innerHTML;
    ShowContent('supervisorgeral');
  }
  
  if(caixa=='controladores'){
    ShowContent('controladores');
  }
  
  if(caixa=='controladoresPH'){
  	var nome = 'controladorPH'+$('militarIdControladorPH').value;
    $('controladorEscaladoPH').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresPH');
  }
  if(caixa=='controladoresBL'){
  	var nome = 'controladorBL'+$('militarIdControladorBL').value;
    $('controladorEscaladoBL').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresBL');
  }
  if(caixa=='controladoresMU'){
  	var nome = 'controladorMU'+$('militarIdControladorMU').value;
    $('controladorEscaladoMU').innerHTML = $(nome).innerHTML;
    ShowContent('controladoresMU');
  }
  if(caixa=='supervisorRegionalMU'){
  	var nome = 'supervisorRegionalMU'+$('militarIdSupervisorRegionalMU').value;
    ShowContent('supervisorRegionalMU');
    $('supervisorRegionalEscaladoMU').innerHTML = $(nome).innerHTML;
  }
  if(caixa=='supervisorRegionalBL'){
  	var nome = 'supervisorRegionalBL'+$('militarIdSupervisorRegionalBL').value;
    ShowContent('supervisorRegionalBL');
    $('supervisorRegionalEscaladoBL').innerHTML = $(nome).innerHTML;
  }
  if(caixa=='supervisorRegionalPH'){
  	var nome = 'supervisorRegionalPH'+$('militarIdSupervisorRegionalPH').value;
    ShowContent('supervisorRegionalPH');
    $('supervisorRegionalEscaladoPH').innerHTML = $(nome).innerHTML;
  }
  
  ShowContent('substitutos');


  

}



function submitForm(form, tabela, idatualizado) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externoacoes/'+tabela+<?php echo "'/{$privilegio}'"; ?>+<?php echo "'/{$acesso}'"; ?>, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			if(tabela<10){
				tabela = "tabela00"+tabela;
			}else{
				tabela = "tabela0"+tabela;
			}
			var naohouve = tabela + "naohouve";
			var houve = tabela + "houve";
			
			if(resultado.total>0){
				setCheckedValue(form,'HOUVE');
				$(naohouve).hide();
			}
			
			
			 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				//alert('Registro não atualizado!');
				$(idatualizado).innerHTML = resultado.mensagem;
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				//alert('Registro atualizado!');
				$(idatualizado).innerHTML = resultado.mensagem;
							
			}
		}
				})
    }

function despachaForm(form, tipo) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externodespacho/'+tipo, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
			 	$('alertaSistema').innerHTML = "<p>Registro atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
				location.reload(true);
			}
		}
	});
}

function listaLDAP() {
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externoldap/', {
			method: 'get',
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
		
    		 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = resultado.mensagem;
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
			 	$('alertaSistema').innerHTML = resultado.mensagem;
			 	ShowContent('mensagem');
				//location.reload(true);
			}
		}
	});
}

function enviaForm(form) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externosubstituicao/', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			var resultado = transport.responseText.evalJSON(true);
			
		
			 if (resultado.ok==0){
			 	$('alertaSistema').innerHTML = "<p>Registro não atualizado!"+resultado.mensagem+"</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
				location.reload(true);
//				alert('Registro atualizado!');
			}
		}
				});
}


function excluiRegistro(form, tabela, id, idatualizado) {
var dados = Form.serialize($(form));
new Ajax.Request('<?php echo $this->webroot; ?>ocorrencias/externodelete/'+tabela+'/'+id+<?php echo "'/{$privilegio}'"; ?>, {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {

			//esconde();

			var resultado = transport.responseText.evalJSON(true);
			if(tabela<10){
				tabela = "tabela00"+tabela;
			}else{
				tabela = "tabela0"+tabela;
			}
			var naohouve = tabela + "naohouve";
			var houve = tabela + "houve";
			
			if(resultado.total==0){
				setCheckedValue(form,'NÃO HOUVE');
				$(naohouve).show();
				$(tabela).hide();
			}
			
			 if (resultado.ok==0){
				$(idatualizado).innerHTML = resultado.mensagem;
			 	$('alertaSistema').innerHTML = "<p>Registro não excluído!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
			}else{
				$(idatualizado).innerHTML = resultado.mensagem;
			 	$('alertaSistema').innerHTML = "<p>Registro excluído!</p>";
			 	ShowContent('mensagem');
			 	//$('mensagem').show();
							
			}
		}
				})
        
       
    }

</script> 
<?php

$mtabela092 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela001 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela002 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela003 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela004 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela005 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela006 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela007 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela090 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);

$mtabela008 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela009 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela010 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
//$mtabela011 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela012 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela013 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela014 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela015 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela016 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela017 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela018 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela019 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela020 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela021 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela022 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela023 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela024 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela025 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela026 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela027 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela028 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela029 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela030 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela031 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela032 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela033 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela034 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela035 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela036 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela037 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela038 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela039 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela040 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela041 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela042 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela043 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela044 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela045 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela046 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela047 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela048 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela049 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela050 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela051 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela052 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela053 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela054 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela055 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela056 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela057 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela058 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela059 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela060 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela061 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela062 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela063 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela064 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela065 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela066 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela067 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela068 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela069 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela070 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela071 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela072 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela073 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela091 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);

$mtabela074 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela075 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela076 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela077 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela078 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela079 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela080 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela081 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela082 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela083 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela084 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>0, 'APP RADAR'=>0, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>0);
$mtabela085 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela086 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
$mtabela087 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);

$mtabela092 = array('ACC'=>1, 'ACCAZ'=>1, 'AFIS'=>0, 'AIS'=>0, 'AISI'=>0, 'APP NAO RADAR'=>1, 'APP RADAR'=>1, 'CCAM'=>0, 'CMV'=>0, 'EMA'=>0, 'EMS'=>0, 'RCC'=>0, 'TWR'=>1);
//print_r($mtabela001);
?>
<table width="100%">
	<tbody>
		<tr>
			<td>
			<table width="100%">
				<tbody>
					<tr>
						<td align="center" style="background-color: #4986c2" height="40"><b>
						<font color="#ffff00" size="4">OCORRÊNCIAS OPERACIONAIS</font></b>
						</td>
					</tr>
				</tbody>
			</table>
			<?php

function exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $dados, $nivel, $acesso){
	
			
			if($dados>0){
				$houve = 'checked="true"';
				$f = 1;
				$naohouve = '';
			}else{
				$houve = '';
				$naohouve = 'checked="true"';
				$f = 0;
			}
			if($nivel==1){
				$cornivel = 'ffcc99';
				$corfont = '000080';
				$sizefont = '4';
				$padding = '';
			}
			if($nivel==2){
				$cornivel = 'EEDDBB';
				$sizefont = '3';
				$corfont = '0000D0';
				$padding = 'padding-left: 10px;';
			}
			if($nivel==3){
				$cornivel = 'EEDDDD';
				$sizefont = '2';
				$corfont = '2020e0';
				$padding = 'padding-left: 20px;';
			}
			$html  = '<tr><td align="center" style="background-color: #'.$cornivel.';'.$padding.'" height="23" width="100%"><b><font color="#'.$corfont.'" size="'.$sizefont.'">'.$titulo.'</font></b></td>';
				$html .= '<td style="background-color: #'.$cornivel.';" height="23">';
				if($aberta==1){
				$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corhouve.';" id="tabela'.$numeracao.'houve">HOUVE<input '.$houve.' type="radio" name=\'tabela'.$numeracao.'r\'  onclick="$(\'tabela'.$numeracao.'\').show();return true;" ';
				$html .= ' href="javascript:$(\'tabela'.$numeracao.'\').show();"  value="HOUVE"></div>';
				}
				$html .= '</td>	<td style="background-color: #'.$cornivel.';" height="23">';
				
				if($aberta==1){
				$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$cornaohouve.';" id="tabela'.$numeracao.'naohouve">NÃO&nbsp;HOUVE<input ';
				$html .= $cornaohouve.' type="radio" name=\'tabela'.$numeracao.'r\'	onclick="$(\'tabela'.$numeracao.'\').hide();" value="NÃO HOUVE"></div>';
				}
				$html .= '</td><td style="background-color: #'.$cornivel.';" height="23">';
				$confirmaDespacho = 0;
				$confirmaCiente = 0;
				$dadosDespacho = array();
				foreach($despachos as $despacho){
					if($despacho['nome_tabela']==$tabela){
						if($despacho['ciente_gerente_regional']){
							$confirmaCiente = 1;
						}
						if($despacho['despacho_gerente_regional']){
							$confirmaDespacho = 1;
						}
						$dadosDespacho['id'] = $despacho['Lrodespacho']['id'];
						$dadosDespacho['destinatario'] = $despacho['Lrodespacho']['destinatario'];
						$dadosDespacho['assunto'] = $despacho['Lrodespacho']['assunto'];
						$dadosDespacho['despacho'] = $despacho['Lrodespacho']['despacho'];
						$dadosDespacho['data_despacho'] = $despacho['Lrodespacho']['data_despacho'];
						$dadosDespacho['despachante'] = $despacho['Lrodespacho']['despachante'];
					}
				}
				$ciente = 0;

				if($confirmaCiente){
					$ciente = 1;
					$imgRegional = $raiz.'img/visto_sem_despacho.png';
				}
				if($confirmaDespacho){
					$ciente = 1;
					$imgRegional = $raiz.'img/visto_com_despacho.png';
				}

				if(empty($dadosDespacho['id'])){
					$dadosDespacho['id'] = ' ';
					$dadosDespacho['destinatario'] = ' ';
					$dadosDespacho['assunto'] = ' ';
					$dadosDespacho['despacho'] = ' ';
					$dadosDespacho['data_despacho'] = ' ';
					$dadosDespacho['despachante'] = ' ';
				}

				if($ciente){
					$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corciente.';" id="tabela'.$numeracao.'ciente">Ciente ';
					$html .= '<a onclick="despachoregional(1, \''.$dadosDespacho['id'].'\', \''.rawurlencode($dadosDespacho['despacho']).'\', \''.rawurlencode($dadosDespacho['data_despacho']).'\');">';
					$html .= '<img border="0" title="Cadastrar" alt="Cadastrar"	src="'.$imgRegional.'" /></a></div>';
				}
				if($aberta==1 && $privilegio=='GERREGIONAL'){
					$html .= '<div  style="font-size:8px;font-weight:bold;background-color:'.$corciente.';" id="tabela'.$numeracao.'ciente">Ciente ';
					$html .= '<a onclick="despachoregional(1, \''.$dadosDespacho['id'].'\', \''.rawurlencode($dadosDespacho['despacho_gerente_regional']).'\', \''.rawurlencode($dadosDespacho['data_despacho']).'\');">';
					$html .= '<img border="0" title="Cadastrar" alt="Cadastrar"	src="'.$raiz.'img/despacho.gif" /></a></div>';

				}
					$html .= '</td></tr>';
					
					echo $html;
		

		} 
		
function exibeDados($campos, $nomeVetor, $tabela,	$privilegio, $idDiv, $numeracao, $raiz, $controller, $campoExcluir, $acesso){ 
	$html = '<div id="'.$idDiv.'">'; 
	$mensagem= "<table cellpadding='0' cellspacing='0'>	<tr>";
	
	foreach($campos as $chave=>$valor){
		$mensagem .= '<th>'.$valor.'</th>';
	}
	$mensagem .= '<th>Ações</th></tr>';

	$i = 0; 
    $tabelas = $tabela; 
    
	$tabelasql = $numeracao;
    
    
    foreach ($tabelas as $resultado){ 
    	$class = null; 
    	if ($i++ % 2 == 0) { 
    		$class = ' style="background-color:#e0e0f0;"'; 
    	} 
   // 	$excluir = '<a onclick=\'return false;\' onmousedown=\"dialogo('Deseja realmente excluir o registro #".$resultado[$nomeVetor][$campoExcluir].' ?" ,"javascript:var tabela=\"'.$idDiv.'\";var form=\"lrotabela'.$numeracao.'LroForm\";excluiRegistro(form,'.$numeracao.','.$resultado[$nomeVetor]['id'].',tabela);");\' href="'.$raiz.$controller.'"><img border="0" title="Excluir" alt="Excluir" src="'.$raiz.'img/lixo.gif" /></a>';
		$despacho = '<a href="javascript:despacholocal('.$tabelasql.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');" onclick="despacholocal('.$tabela.', '.$resultado[$nomeVetor]['id'].', \''.rawurlencode($resultado[$nomeVetor]['despacho_gerente_local']).'\', \''.rawurlencode($resultado[$nomeVetor]['data_despacho']).'\');"><img border="0" title="Despacho" alt="despacho" src="'.$raiz.'img/despacho.gif"/></a>';
    	
    	if(empty($resultado[$nomeVetor]['despacho_gerente_local'])){
    		if(!empty($resultado[$nomeVetor]['ciente_gerente_local'])){
    			$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_sem_despacho.png" />';
	    	}
    	}else{
    		$ciente = '<img border="0" title="Ciente" alt="ciente"	src="'.$raiz.'img/visto_com_despacho.png" />';
    	} 
    	$acao = ''; 
        if(($privilegio=='EXECUTANTE')&&($acesso == 1)){ $acao .= $excluir; }
		if($privilegio=='GERLOCAL'){ $acao .= $despacho; } 
		$acao .= $ciente;
		//$acao = $ciente.$despacho; 
		
		$mensagem .= '<tr>';
		foreach($campos as $chave=>$valor){
			$mensagem .= '<td'.$class.'>'.$resultado[$nomeVetor][$chave].'</td>';
		}
		$mensagem .= '<td'.$class.'>'.$acao.'</td></tr>';		
     } 
     $mensagem.="</table><br>";
     $html .= $mensagem.'</div></div><script language="javascript">';
						
						
	if($i){
		$html .= "\$('tabela".$numeracao."').show();";
		$html .= "\$('tabela".$numeracao."naohouve').hide();";
	}else{
		$html .= "\$('tabela".$numeracao."').hide();";
		$html .= "\$('tabela".$numeracao."naohouve').show();";
	}
	$html .= '</script>';
	
	echo $html; 
} 

		$privilegios = 1;

		if($privilegios){
			$permissaos = array('readonly'=>'readonly');
		}else{
			$permissao = '';
			$permissaos = array();
		}
		$corhouve = "#f00000";
		$cornaohouve = "#00f000";
		$corciente = "#00b000";


		?>

<?php
		if($mtabela092[$cumprindoescala[0]['Escala']['livro']]){

?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'PLANO DE VÔO REPETITIVO (RPL)';
					$tabela = 'lrotabela92s';
					$vetorTabela = 'Lrotabela92';
					$numeracao = "092";
					$numero = 92;
					$tabelaDados = $tabela92;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td>

					<div class="ocorrenciastecnicas form" id="tabela092" style="display: false;">
					<?php
						if($aberta==1 && $privilegio=='EXECUTANTE'){

							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('nome_rpl',array('class'=>'formulario','label'=>'Nome do PL',$permissaos));
							echo $form->input('relato_atco',array('class'=>'formulario','type'=>'textarea','label'=>'Relato ATCO',$permissaos));
							echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
							echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
							echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
							$campos = array('relato_atco'=>'Reporte ATC número','nome_rpl'=>'Nome do RPL');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';
						}

						$campos = array('nome_rpl'=>'Nome do RPL','relato_atco'=>'Reporte ATC');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>

					</td>
				</tr>
			</tbody>
		</table>

<?php
}
?>
<?php
		if($mtabela001[$cumprindoescala[0]['Escala']['livro']]){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
	
					<?php
					$titulo = 'REPORTE DE INCIDENTE/ACIDENTE AERONÁUTICO';
					$tabela = 'lrotabela01s';
					$vetorTabela = 'Lrotabela01';
					$numeracao = "001";
					$numero = 1;
					$tabelaDados = $tabela01;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
				</tr>
				<tr><td>

					<div class="ocorrenciastecnicas form" id="tabela001" style="display: false;">
					<?php
						if($aberta==1 && $privilegio=='EXECUTANTE'){

							echo '<fieldset>';
							echo $form->create('lrotabela'.$numeracao.'',array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
							echo $form->input('nome_atco',array('class'=>'formulario','label'=>'Nome do ATCO',$permissaos));
							echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
							echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
							echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
							echo $form->input('relato_atco_numero',array('class'=>'formulario','type'=>'textarea','label'=>'Relato ATCO número',$permissaos));
							$campos = array('relato_atco_numero'=>'Reporte ATC número','nome_atco'=>'Nome do ATCO');
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
							}
							foreach($campos as $campo=>$valor){
								echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
							}
							$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
							echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
							echo '</fieldset><br>';
						}

						$campos = array('nome_atco'=>'Nome do ATCO','relato_atco_numero'=>'Reporte ATC número');
						$campoExcluir = 'relato_atco_numero';
						exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
						?>

					</td>
				</tr>
			</tbody>
		</table>

<?php
}
?>
		
<?php
		//print_r($tabela01);
		if($mtabela002[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AVISO DE RESOLUÇÃO';
					$tabela = 'lrotabela02s';
					$vetorTabela = 'Lrotabela02';
					$numeracao = "002";
					$numero = 2;
					$tabelaDados = $tabela02;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela002"	style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('nome_atco',array('class'=>'formulario'));
					echo $form->input('relatorio_ocorrencia_acas',array('class'=>'formulario','type'=>'textarea','label'=>'RELATÓRIO OCORRÊNCIA ACAS'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('nome_atco'=>'Nome do ATCO','relatorio_ocorrencia_acas'=>'Relatório de ocorrência ACAS');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('nome_atco'=>'Nome do ATCO','relatorio_ocorrencia_acas'=>'Relatório de ocorrência ACAS');
					$campoExcluir = 'relatorio_ocorrencia_acas';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>


		<?php
		}

		if($mtabela003[$cumprindoescala[0]['Escala']['livro']]){


			?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'FICHA LHD';
					$tabela = 'lrotabela03s';
					$vetorTabela = 'Lrotabela03';
					$numeracao = "003";
					$numero = 3;
					$tabelaDados = $tabela03;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela003" 	style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('nome_atco',array('class'=>'formulario'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('nome_atco'=>'Nome do ATCO');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('nome_atco'=>'Nome do ATCO');
					$campoExcluir = 'nome_atco';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>


		<?php
		}
		if($mtabela004[$cumprindoescala[0]['Escala']['livro']]){
			?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'VÍDEO MAPA';
					$tabela = 'lrotabela04s';
					$vetorTabela = 'Lrotabela04';
					$numeracao = "004";
					$numero = 4;
					$tabelaDados = $tabela04;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela004" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('video_mapa',array('class'=>'formulario'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('video_mapa'=>'Vídeo MAPA');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('video_mapa'=>'Vídeo MAPA');
					$campoExcluir = 'video_mapa';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>



		<?php
		}

		if($mtabela005[$cumprindoescala[0]['Escala']['livro']]||$mtabela006[$cumprindoescala[0]['Escala']['livro']]||$mtabela007[$cumprindoescala[0]['Escala']['livro']]){

			?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4">
					OPERAÇÃO DOS ÓRGÃOS ATS DA FIR</font></b></td>
				</tr></tbody>
		</table>
		
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'APP';
					$tabela = 'lrotabela05s';
					$vetorTabela = 'Lrotabela05';
					$numeracao = "005";
					$numero = 5;
					$tabelaDados = $tabela05;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>

				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela005" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>

					<?php
					
		if($mtabela006[$cumprindoescala[0]['Escala']['livro']]){

			?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TWR';
					$tabela = 'lrotabela06s';
					$vetorTabela = 'Lrotabela06';
					$numeracao = "006";
					$numero = 6;
					$tabelaDados = $tabela06;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela006" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>

					<?php
		}
		if($mtabela007[$cumprindoescala[0]['Escala']['livro']]){

			?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AFIS';
					$tabela = 'lrotabela07s';
					$vetorTabela = 'Lrotabela07';
					$numeracao = "007";
					$numero = 7;
					$tabelaDados = $tabela07;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela007" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>

					<?php
		
		}
?>
<?php
	if($mtabela008[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ADJACENTE';
					$tabela = 'lrotabela90s';
					$vetorTabela = 'Lrotabela090';
					$numeracao = "090";
					$numero = 90;
					$tabelaDados = $tabela90;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela090" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
		}
?>

<?php
	if($mtabela008[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AIREP ESPECIAL';
					$tabela = 'lrotabela08s';
					$vetorTabela = 'Lrotabela08';
					$numeracao = "008";
					$numero = 8;
					$tabelaDados = $tabela08;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela008" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>



 <?php
		$condicao001 = 0; 
		$livro = $cumprindoescala[0]['Escala']['livro'];
		for($i=9;$i<22;$i++){
				$nome = 'mtabela0'.$i; 
				if($i<10){
					$nome = 'mtabela00'.$i;
				}
				$x = ${$nome}[$livro];
				$condicao001 = $condicao001  || $x;
			}		

		if($condicao001){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4">
					TRÁFEGO E ESPAÇO AÉREO ESPECIAIS</font></b></td>
				</tr>
			</tbody>
			</table>
					
<?php
	if($mtabela009[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE PRESIDENCIAL, INCLUSÍVE DE OUTROS PAÍSES';
					$tabela = 'lrotabela09s';
					$vetorTabela = 'Lrotabela09';
					$numeracao = "009";
					$numero = 9;
					$tabelaDados = $tabela09;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela009" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela010[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE EM OPERAÇÃO SAR, TREN, SUH, TRON';
					$tabela = 'lrotabela10s';
					$vetorTabela = 'Lrotabela10';
					$numeracao = "010";
					$numero = 10;
					$tabelaDados = $tabela10;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela010" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela012[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE DO GEIV';
					$tabela = 'lrotabela12s';
					$vetorTabela = 'Lrotabela12';
					$numeracao = "012";
					$numero = 12;
					$tabelaDados = $tabela12;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela012" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela013[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE NÃO IDENTIFICADA';
					$tabela = 'lrotabela13s';
					$vetorTabela = 'Lrotabela13';
					$numeracao = "013";
					$numero = 13;
					$tabelaDados = $tabela13;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela013" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela014[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE R99 QUE ESTEJA EMITINDO PULSO ELETROMAGNÉTICO DO RADAR EMBARCADO';
					$tabela = 'lrotabela14s';
					$vetorTabela = 'Lrotabela14';
					$numeracao = "014";
					$numero = 14;
					$tabelaDados = $tabela14;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela014" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela015[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE QUE PROSSEGUIR PARA A ALTERNATIVA POR QUALQUER MOTIVO';
					$tabela = 'lrotabela15s';
					$vetorTabela = 'Lrotabela15';
					$numeracao = "015";
					$numero = 15;
					$tabelaDados = $tabela15;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela015" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela016[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERONAVE QUE PERDER A CONDIÇÃO RVSM';
					$tabela = 'lrotabela16s';
					$vetorTabela = 'Lrotabela16';
					$numeracao = "016";
					$numero = 16;
					$tabelaDados = $tabela16;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela016" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela017[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'QUALQUER SOLICITAÇÃO DE RESERVA DE ESPAÇO AÉREO POR PARTE DO COPM4';
					$tabela = 'lrotabela17s';
					$vetorTabela = 'Lrotabela17';
					$numeracao = "017";
					$numero = 17;
					$tabelaDados = $tabela17;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela017" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela018[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AVOEM , AVODAC E AVOAR';
					$tabela = 'lrotabela18s';
					$vetorTabela = 'Lrotabela18';
					$numeracao = "018";
					$numero = 18;
					$tabelaDados = $tabela18;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela018" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição', 'descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
?>
<?php
   $condicao002 = $mtabela019[$cumprindoescala[0]['Escala']['livro']]||$mtabela020[$cumprindoescala[0]['Escala']['livro']]||$mtabela021[$cumprindoescala[0]['Escala']['livro']];
	if($condicao002){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4"> TESTE DE EQUIPAMENTOS DE EMERGÊNCIA</font></b></td>
				</tr>
			</tbody>
		</table>

<?php
	if($mtabela019[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = '121.5 MHZ';
					$tabela = 'lrotabela19s';
					$vetorTabela = 'Lrotabela19';
					$numeracao = "019";
					$numero = 19;
					$tabelaDados = $tabela19;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela019" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('numero_formulario_teste',array('class'=>'formulario'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('numero_formulario_teste'=>'Número do Formulario de teste');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('numero_formulario_teste'=>'Número do Formulario de teste');
					$campoExcluir = 'numero_formulario_teste';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
		


<?php
	if($mtabela020[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TF-1 E TF-2';
					$tabela = 'lrotabela20s';
					$vetorTabela = 'Lrotabela20';
					$numeracao = "020";
					$numero = 20;
					$tabelaDados = $tabela20;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela020" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					
					$campos = array('descricao'=>'Descrição');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>



<?php
	if($mtabela021[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'INFRAÇÃO DE TRÁFEGO AÉREO (CIRTRAF 100-4/2006)';
					$tabela = 'lrotabela21s';
					$vetorTabela = 'Lrotabela21';
					$numeracao = "021";
					$numero = 21;
					$tabelaDados = $tabela21;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela021" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao_sucinta',array('class'=>'formulario','label'=>'Descrição sucinta','type'=>'textarea'));
					echo $form->input('identificacao_aeronave',array('class'=>'formulario','label'=>'Identificacao Aeronave (Matrícula e/ou número de viagem)'));
					echo $form->input('tipo_aeronave',array('class'=>'formulario'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->picker('dia_ocorrencia',array('class'=>'formulario','value'=>date('Y-m-d')));
					echo $form->input('aerodromo_partida',array('class'=>'formulario'));
					echo $form->input('aerodromo_destino',array('class'=>'formulario'));
					echo $form->input('nivel_voo_rota',array('class'=>'formulario'));
					echo $form->input('informacao_complementar',array('class'=>'formulario','type'=>'textarea'));
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao_sucinta'=>'Descrição sucinta','identificacao_aeronave'=>'Identificação Aeronave','tipo_aeronave'=>'Tipo de Aeronave','dia_ocorrencia'=>'Dia do Ocorrência','aerodromo_partida'=>'Aeródromo de partida','aerodromo_destino'=>'Aeródromo de destino','nivel_voo_rota'=>'Nível de Vôo em Rota','informacao_complementar'=>'Informação Complementar');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('descricao_sucinta'=>'Descrição sucinta','identificacao_aeronave'=>'Identificação Aeronave','tipo_aeronave'=>'Tipo de Aeronave','dia_ocorrencia'=>'Dia do Ocorrência','aerodromo_partida'=>'Aeródromo de partida','aerodromo_destino'=>'Aeródromo de destino','nivel_voo_rota'=>'Nível de Vôo em Rota','informacao_complementar'=>'Informação Complementar');
					$campoExcluir = 'descricao_sucinta';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
?>

<?php
	if($mtabela022[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'REPORTE DE OVNI';
					$tabela = 'lrotabela22s';
					$vetorTabela = 'Lrotabela22';
					$numeracao = "022";
					$numero = 22;
					$tabelaDados = $tabela22;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela022" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('relato_copm4',array('class'=>'formulario','label'=>'Relato do COPM4','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('hora_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('hora_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');

					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('relato_copm4'=>'Relato do COPM4','hora_inicio'=>'Hora de início','hora_termino'=>'Hora de término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('relato_copm4'=>'Relato do COPM4','hora_inicio'=>'Hora de início','hora_termino'=>'Hora de término','descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'relato_copm4';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela023[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'DESAGRUPAMENTO DE SETOR';
					$tabela = 'lrotabela23s';
					$vetorTabela = 'Lrotabela23';
					$numeracao = "023";
					$numero = 23;
					$tabelaDados = $tabela23;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela023" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','label'=>'Descricao','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('hora_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('hora_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');

					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','hora_inicio'=>'Hora de início','hora_termino'=>'Hora de término');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('descricao'=>'Descrição','hora_inicio'=>'Hora de início','hora_termino'=>'Hora de término');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela024[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AGRUPAMENTO DE SETOR';
					$tabela = 'lrotabela24s';
					$vetorTabela = 'Lrotabela24';
					$numeracao = "024";
					$numero = 24;
					$tabelaDados = $tabela24;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela024" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('setores',array('class'=>'formulario','label'=>'Descricao','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('horario',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');

					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('setores'=>'Setores','horario'=>'Horário');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('setores'=>'Setores','horario'=>'Horário');
					$campoExcluir = 'setores';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela025[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CONTROLE DE FLUXO';
					$tabela = 'lrotabela25s';
					$vetorTabela = 'Lrotabela25';
					$numeracao = "025";
					$numero = 25;
					$tabelaDados = $tabela25;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela025" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('motivo',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('medidas_restritivas',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('aerodromos_envolvidos',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('setores_envolvidos',array('class'=>'formulario','type'=>'textarea'));
					echo $form->input('aerovias_envolvidas',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('motivo'=>'Motivo','medidas_restritivas'=>'Medidas Restritiva','aerodromos_envolvidos'=>'Aeródromos envolvidos','setores_envolvidos'=>'Setores envolvidos','aerovias_envolvidas'=>'Aerovias envolvidas','inicio'=>'Início','termino'=>'Término');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('motivo'=>'Motivo','medidas_restritivas'=>'Medidas Restritiva','aerodromos_envolvidos'=>'Aeródromos envolvidos','setores_envolvidos'=>'Setores envolvidos','aerovias_envolvidas'=>'Aerovias envolvidas','inicio'=>'Início','termino'=>'Término');
					$campoExcluir = 'motivo';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela026[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ESTÁGIO PRÁTICO';
					$tabela = 'lrotabela26s';
					$vetorTabela = 'Lrotabela26';
					$numeracao = "026";
					$numero = 26;
					$tabelaDados = $tabela26;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela026" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('descricao'=>'Descrição');
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela027[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'EMERGÊNCIA, FALHA DE COMUNICAÇÃO OU INTERFERÊNCIA ILÍCITA';
					$tabela = 'lrotabela27s';
					$vetorTabela = 'Lrotabela27';
					$numeracao = "027";
					$numero = 27;
					$tabelaDados = $tabela27;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela027" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('aerodromo',array('class'=>'formulario'));

					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('aerodromo'=>'Aeródromo','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('aerodromo'=>'Aeródromo','descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'aerodromo';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela028[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERÓDROMO COM OPERAÇÃO ABAIXO DOS MÍNIMOS IFR';
					$tabela = 'lrotabela28s';
					$vetorTabela = 'Lrotabela28';
					$numeracao = "028";
					$numero = 28;
					$tabelaDados = $tabela28;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela028" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('aerodromo',array('class'=>'formulario'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('hora_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('hora_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('aerodromo'=>'Aeródromo','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('aerodromo'=>'Aeródromo','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término','descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'aerodromo';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela029[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AERÓDROMO COM OPERAÇÃO IFR SUSPENSA';
					$tabela = 'lrotabela29s';
					$vetorTabela = 'Lrotabela29';
					$numeracao = "029";
					$numero = 29;
					$tabelaDados = $tabela29;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela029" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('aerodromo',array('class'=>'formulario'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('hora_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('hora_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('aerodromo'=>'Aeródromo','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('aerodromo'=>'Aeródromo','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término','descricao_impacto'=>'Descrição do Impacto');
					$campoExcluir = 'aerodromo';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela030[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'PRORROGAÇÃO DE FUNCIONAMENTO DE AFIS';
					$tabela = 'lrotabela30s';
					$vetorTabela = 'Lrotabela30';
					$numeracao = "030";
					$numero = 30;
					$tabelaDados = $tabela30;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela030" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('afis',array('class'=>'formulario'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('hora_inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('hora_termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('afis'=>'AFIS','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campos = array('afis'=>'AFIS','hora_inicio'=>'Hora de Início','hora_termino'=>'Hora de Término');
					$campoExcluir = 'afis';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela031[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'INTERFERÊNCIA NA FREQUÊNCIA';
					$tabela = 'lrotabela31s';
					$vetorTabela = 'Lrotabela31';
					$numeracao = "031";
					$numero = 31;
					$tabelaDados = $tabela31;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela031" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('preenchido_relatorio',array('class'=>'formulario'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('preenchido_relatorio'=>'Preenchido Relatório','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'preenchido_relatorio';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
	if($mtabela032[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'OUTRAS OCORRÊNCIA OPERACIONAIS';
					$tabela = 'lrotabela32s';
					$vetorTabela = 'Lrotabela32';
					$numeracao = "032";
					$numero = 32;
					$tabelaDados = $tabela32;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela032" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$combo['INTERFERÊNCIA'] = 'INTERFERÊNCIA';
					$combo['FREQUÊNCIA'] = 'FREQUÊNCIA';
					echo $form->input('pane_operacional',array('class'=>'formulario','options'=>$combo));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','pane_operacional'=>'Pane Operacional','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


		<table width="100%">
			<tbody>
				<tr>
					<td align="center" style="background-color: #4986c2" height="40"><b><font
						color="#ffff00" align="center" size="4">OCORRÊNCIAS TÉCNICAS</font></b></td>
				</tr>
			</tbody>
		</table>

<?php
	if($mtabela033[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'FREQUÊNCIAS';
					$tabela = 'lrotabela33s';
					$vetorTabela = 'Lrotabela33';
					$numeracao = "033";
					$numero = 33;
					$tabelaDados = $tabela33;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela033" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela034[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'RADAR';
					$tabela = 'lrotabela34s';
					$vetorTabela = 'Lrotabela34';
					$numeracao = "034";
					$numero = 34;
					$tabelaDados = $tabela34;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela034" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					$comboRadar['PRIMÁRIO'] = 'PRIMÁRIO';
					$comboRadar['SECUNDÁRIO'] = 'SECUNDÁRIO';
					$comboRadar['PRIMÁRIO/SECUNDÁRIO'] = 'PRIMÁRIO/SECUNDÁRIO';
					echo $form->input('radar',array('class'=>'formulario','options'=>$comboRadar));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('radar'=>'Radar','inicio'=>'Início','termino'=>'Término','descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'radar';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
   $condicao003 = $mtabela035[$cumprindoescala[0]['Escala']['livro']];
	if($condicao003){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELEFONIA, TF-1, TF-2, REDIG, TELEFONE EXTERNO';
					$tabela = 'lrotabela35s';
					$vetorTabela = 'Lrotabela35';
					$numeracao = "035";
					$numero = 35;
					$tabelaDados = $tabela35;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela035" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>




<?php
   $condicao003 = $mtabela035[$cumprindoescala[0]['Escala']['livro']]||$mtabela036[$cumprindoescala[0]['Escala']['livro']]||$mtabela037[$cumprindoescala[0]['Escala']['livro']]||$mtabela038[$cumprindoescala[0]['Escala']['livro']];
   /*
	if($condicao003){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4">TELEFONIA</font></b></td>
				</tr>
		</tbody></table>
		
<?php
	if($mtabela035[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TF1';
					$tabela = 'lrotabela35s';
					$vetorTabela = 'Lrotabela35';
					$numeracao = "035";
					$numero = 35;
					$tabelaDados = $tabela35;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela035" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela036[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TF2';
					$tabela = 'lrotabela36s';
					$vetorTabela = 'Lrotabela36';
					$numeracao = "036";
					$numero = 36;
					$tabelaDados = $tabela36;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela036" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela037[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'REDIG';
					$tabela = 'lrotabela37s';
					$vetorTabela = 'Lrotabela37';
					$numeracao = "037";
					$numero = 37;
					$tabelaDados = $tabela37;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela037" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela038[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CONCESSIONÁRIA';
					$tabela = 'lrotabela38s';
					$vetorTabela = 'Lrotabela38';
					$numeracao = "038";
					$numero = 38;
					$tabelaDados = $tabela38;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela038" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
*/
 ?>

<?php
	if($mtabela039[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'AUXÍLIOS NAVEGAÇÃO';
					$tabela = 'lrotabela39s';
					$vetorTabela = 'Lrotabela39';
					$numeracao = "039";
					$numero = 39;
					$tabelaDados = $tabela39;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela039" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>


<?php
   $condicao004 = $mtabela039[$cumprindoescala[0]['Escala']['livro']]||$mtabela040[$cumprindoescala[0]['Escala']['livro']];
   /**
	if($condicao004){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4">
					AUXÍLIOS NAVEGAÇÃO</font></b></td>
				</tr>
			</tbody>
		</<table>

<?php
	if($mtabela039[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'NDB';
					$tabela = 'lrotabela39s';
					$vetorTabela = 'Lrotabela39';
					$numeracao = "039";
					$numero = 39;
					$tabelaDados = $tabela39;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela039" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela040[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'VOR';
					$tabela = 'lrotabela40s';
					$vetorTabela = 'Lrotabela40';
					$numeracao = "040";
					$numero = 40;
					$tabelaDados = $tabela40;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela040" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
*/
?>					
<?php
	if($mtabela041[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CONSOLE (SITTI, MONITOR, CPU, IMPRESSORA E DEMAIS PERIFÉRICOS)';
					$tabela = 'lrotabela41s';
					$vetorTabela = 'Lrotabela41';
					$numeracao = "041";
					$numero = 41;
					$tabelaDados = $tabela41;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela041" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

	
	
<?php
		$condicao005 = 0; 
		$livro = $cumprindoescala[0]['Escala']['livro'];
		for($i=41;$i<67;$i++){
				$nome = 'mtabela0'.$i; 
				if($i<10){
					$nome = 'mtabela00'.$i;
				}
				$x = ${$nome}[$livro];
				$condicao005 = $condicao005 || $x;
			}		
/*
		if($condicao005){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99" height="40" width="100%"><b><font color="#000080" size="4">
					CONSOLE</font></b></td>
				</tr>
			</tbody>
		</table>
		
	<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
		<tbody>
		<tr>
			<td align="center" colspan="4"
				style="background-color: #EEDDBB; padding-left: 10px;"
				height="23" width="100%"><b><font color="#0000D0" size="3">
				SUPERVISOR REGIONAL</font></b></td>
			</tr>
		</tbody>
	</table>

<?php
	if($mtabela041[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CONSOLE (SITTI, MONITOR, CPU, IMPRESSORA E DEMAIS PERIFÉRICOS)';
					$tabela = 'lrotabela41s';
					$vetorTabela = 'Lrotabela41';
					$numeracao = "041";
					$numero = 41;
					$tabelaDados = $tabela41;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela041" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela042[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELA SITUAÇÃO AÉREA';
					$tabela = 'lrotabela42s';
					$vetorTabela = 'Lrotabela42';
					$numeracao = "042";
					$numero = 42;
					$tabelaDados = $tabela42;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela042" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela043[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELA DADOS STRIP ELETRÔNICA';
					$tabela = 'lrotabela43s';
					$vetorTabela = 'Lrotabela43';
					$numeracao = "043";
					$numero = 43;
					$tabelaDados = $tabela43;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela043" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela044[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELA DADOS STRIP ELETRÔNICA';
					$tabela = 'lrotabela44s';
					$vetorTabela = 'Lrotabela44';
					$numeracao = "044";
					$numero = 44;
					$tabelaDados = $tabela44;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela044" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela045[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'IMPRESSORA';
					$tabela = 'lrotabela45s';
					$vetorTabela = 'Lrotabela45';
					$numeracao = "045";
					$numero = 45;
					$tabelaDados = $tabela45;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela045" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela046[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MOUSE TRACK';
					$tabela = 'lrotabela46s';
					$vetorTabela = 'Lrotabela46';
					$numeracao = "046";
					$numero = 46;
					$tabelaDados = $tabela46;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela046" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela047[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MICROFONE';
					$tabela = 'lrotabela47s';
					$vetorTabela = 'Lrotabela47';
					$numeracao = "047";
					$numero = 47;
					$tabelaDados = $tabela47;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela047" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela048[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'PEDAL';
					$tabela = 'lrotabela48s';
					$vetorTabela = 'Lrotabela48';
					$numeracao = "048";
					$numero = 48;
					$tabelaDados = $tabela48;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela048" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela049[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CPU';
					$tabela = 'lrotabela49s';
					$vetorTabela = 'Lrotabela49';
					$numeracao = "049";
					$numero = 49;
					$tabelaDados = $tabela49;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela049" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

					<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
						cellspacing="10px" width="100%">
						<tbody>
							<tr>
								<td align="center" colspan="4"
									style="background-color: #EEDDBB; padding-left: 10px;"
									height="23" width="100%"><b><font color="#0000D0" size="3"> HF</font></b></td>
							</tr>
						</tbody>
					</table>
<?php
	if($mtabela050[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'RÁDIO TW 7000';
					$tabela = 'lrotabela50s';
					$vetorTabela = 'Lrotabela50';
					$numeracao = "050";
					$numero = 50;
					$tabelaDados = $tabela50;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela050" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela051[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'SITTI';
					$tabela = 'lrotabela51s';
					$vetorTabela = 'Lrotabela51';
					$numeracao = "051";
					$numero = 51;
					$tabelaDados = $tabela51;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela051" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela052[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELEFONE';
					$tabela = 'lrotabela52s';
					$vetorTabela = 'Lrotabela52';
					$numeracao = "052";
					$numero = 52;
					$tabelaDados = $tabela52;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela052" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela053[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MONITOR HF';
					$tabela = 'lrotabela53s';
					$vetorTabela = 'Lrotabela53';
					$numeracao = "053";
					$numero = 53;
					$tabelaDados = $tabela53;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela053" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela054[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'VISAR';
					$tabela = 'lrotabela54s';
					$vetorTabela = 'Lrotabela54';
					$numeracao = "054";
					$numero = 54;
					$tabelaDados = $tabela54;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela054" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela055[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'HEADSET';
					$tabela = 'lrotabela55s';
					$vetorTabela = 'Lrotabela55';
					$numeracao = "055";
					$numero = 55;
					$tabelaDados = $tabela55;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela055" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela056[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TF-2';
					$tabela = 'lrotabela56s';
					$vetorTabela = 'Lrotabela56';
					$numeracao = "056";
					$numero = 56;
					$tabelaDados = $tabela56;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela056" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela057[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TF-3';
					$tabela = 'lrotabela57s';
					$vetorTabela = 'Lrotabela57';
					$numeracao = "057";
					$numero = 57;
					$tabelaDados = $tabela57;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela057" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela058[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'FMC';
					$tabela = 'lrotabela58s';
					$vetorTabela = 'Lrotabela58';
					$numeracao = "058";
					$numero = 58;
					$tabelaDados = $tabela58;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela058" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela059[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CPU';
					$tabela = 'lrotabela59s';
					$vetorTabela = 'Lrotabela59';
					$numeracao = "059";
					$numero = 59;
					$tabelaDados = $tabela59;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela059" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela060[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MONITOR';
					$tabela = 'lrotabela60s';
					$vetorTabela = 'Lrotabela60';
					$numeracao = "060";
					$numero = 60;
					$tabelaDados = $tabela60;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela060" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela061[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TECLADO';
					$tabela = 'lrotabela61s';
					$vetorTabela = 'Lrotabela61';
					$numeracao = "061";
					$numero = 61;
					$tabelaDados = $tabela61;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela061" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela062[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MOUSE';
					$tabela = 'lrotabela62s';
					$vetorTabela = 'Lrotabela62';
					$numeracao = "062";
					$numero = 62;
					$tabelaDados = $tabela62;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela062" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>




		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"
			cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<td align="center" colspan="4"
						style="background-color: #EEDDBB; padding-left: 10px;" height="23"
						width="100%"><b><font color="#0000D0" size="3"> PLN</font></b></td>
				</tr>
			</tbody>
		</table>

<?php
	if($mtabela063[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELA DADOS PLANO DE VÔO';
					$tabela = 'lrotabela63s';
					$vetorTabela = 'Lrotabela63';
					$numeracao = "063";
					$numero = 63;
					$tabelaDados = $tabela63;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela063" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela064[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TECLADO';
					$tabela = 'lrotabela64s';
					$vetorTabela = 'Lrotabela64';
					$numeracao = "064";
					$numero = 64;
					$tabelaDados = $tabela64;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela064" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela065[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'IMPRESSORA';
					$tabela = 'lrotabela65s';
					$vetorTabela = 'Lrotabela65';
					$numeracao = "065";
					$numero = 65;
					$tabelaDados = $tabela65;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela065" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela066[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'SITTI';
					$tabela = 'lrotabela66s';
					$vetorTabela = 'Lrotabela66';
					$numeracao = "066";
					$numero = 66;
					$tabelaDados = $tabela66;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 3;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela066" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
*/
?>

<?php
	if($mtabela067[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TESTE DAS LÂMPADAS DO SISTEMA DE MONITORAÇÃO DE BATERIA UPS';
					$tabela = 'lrotabela67s';
					$vetorTabela = 'Lrotabela67';
					$numeracao = "067";
					$numero = 67;
					$tabelaDados = $tabela67;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela067" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('justificativa',array('label'=>'Resultado','class'=>'formulario','type'=>'textarea'));

					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('justificativa'=>'Resultado','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'justificativa';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela068[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CLIMATIZAÇÃO';
					$tabela = 'lrotabela68s';
					$vetorTabela = 'Lrotabela68';
					$numeracao = "068";
					$numero = 68;
					$tabelaDados = $tabela68;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela068" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('justificativa',array('label'=>'Ocorrência','class'=>'formulario','type'=>'textarea'));

					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('justificativa'=>'Ocorrência','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'justificativa';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela069[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'UPS, GRUGER, ENERGIA CONVENCIONAL, COMPONENTES DO SISTEMA ELÉTRICO E DEMAIS FONTES DE ENERGIA ELÉTRICA';
					$tabela = 'lrotabela69s';
					$vetorTabela = 'Lrotabela69';
					$numeracao = "069";
					$numero = 69;
					$tabelaDados = $tabela69;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela069" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início', 'termino'=>'Término', 'descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
		$condicao006 = 0; 
		$livro = $cumprindoescala[0]['Escala']['livro'];
		for($i=69;$i<72;$i++){
				$nome = 'mtabela0'.$i; 
				if($i<10){
					$nome = 'mtabela00'.$i;
				}
				$x = ${$nome}[$livro];
				$condicao006 = $condicao006 || $x;
			}		
/*
		if($condicao006){
?>

		<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
			<tbody>
				<tr>
					<td colspan="4" align="center" style="background-color: #ffcc99"
						height="40" width="100%"><b><font color="#000080" size="4">
					ENERGIA ELÉTRICA</font></b></td>
				</tr>
			</tbody>
		</table>

<?php
	if($mtabela069[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'UPS';
					$tabela = 'lrotabela69s';
					$vetorTabela = 'Lrotabela69';
					$numeracao = "069";
					$numero = 69;
					$tabelaDados = $tabela69;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela069" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela070[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'GRUGER';
					$tabela = 'lrotabela70s';
					$vetorTabela = 'Lrotabela70';
					$numeracao = "070";
					$numero = 70;
					$tabelaDados = $tabela70;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela070" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela071[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ENERGIA CONVENCIONAL';
					$tabela = 'lrotabela71s';
					$vetorTabela = 'Lrotabela71';
					$numeracao = "071";
					$numero = 71;
					$tabelaDados = $tabela71;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela071" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	}
*/
 ?>	
 
 <?php
		$condicao007 = 0; 
		$livro = $cumprindoescala[0]['Escala']['livro'];
		for($i=72;$i<74;$i++){
				$nome = 'mtabela0'.$i; 
				if($i<10){
					$nome = 'mtabela00'.$i;
				}
				$x = ${$nome}[$livro];
				$condicao007 = $condicao007  || $x;
			}		

		if($condicao007){
?>
 				
					<table border="1" bordercolor="#c0c0c0" cellpadding="0"
						cellspacing="0" height="64" width="100%">
						<tbody>
							<tr>
								<td colspan="4" align="center" style="background-color: #ffcc99"
									height="40" width="100%"><b><font color="#000080" size="4">
								CANALIZAÇÃO</font></b></td>
							</tr>
						</tbody>
					</table>
<?php
	if($mtabela072[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CONCESSIONÁRIA';
					$tabela = 'lrotabela72s';
					$vetorTabela = 'Lrotabela72';
					$numeracao = "072";
					$numero = 72;
					$tabelaDados = $tabela72;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela072" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela073[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'TELESAT';
					$tabela = 'lrotabela73s';
					$vetorTabela = 'Lrotabela73';
					$numeracao = "073";
					$numero = 73;
					$tabelaDados = $tabela73;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela073" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela091[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'OUTROS';
					$tabela = 'lrotabela91s';
					$vetorTabela = 'Lrotabela91';
					$numeracao = "091";
					$numero = 91;
					$tabelaDados = $tabela91;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela091" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	}
?>

<?php
	if($mtabela074[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'OUTRAS OCORRÊNCIA TÉCNICAS';
					$tabela = 'lrotabela74s';
					$vetorTabela = 'Lrotabela74';
					$numeracao = "074";
					$numero = 74;
					$tabelaDados = $tabela74;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela074" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					$datePicker->setaFormato('%Y-%m-%d');
					echo $datePicker->Timer('inicio',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					echo $datePicker->Timer('termino',array('readonly'=>'readonly','class'=>'formulario','value'=>date('Y-m-d h:i')),'%Y-%m-%d %H:%M');
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','inicio'=>'Início','termino'=>'Término','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>



		<table width="100%">
			<tbody>
				<tr>
					<td align="center" style="background-color: #4986c2" height="40"><b><font
						color="#ffff00" align="center" size="4">OCORRÊNCIAS
					ADMINISTRATIVAS</font></b></td>
				</tr>
			</tbody>
		</table>
<?php
	if($mtabela075[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ENTRADA/SAÍDA DE MATERIAL CARGA';
					$tabela = 'lrotabela75s';
					$vetorTabela = 'Lrotabela75';
					$numeracao = "075";
					$numero = 75;
					$tabelaDados = $tabela75;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela075" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

 <?php
		$condicao008 = 0; 
		$livro = $cumprindoescala[0]['Escala']['livro'];
		for($i=76;$i<81;$i++){
				$nome = 'mtabela0'.$i; 
				if($i<10){
					$nome = 'mtabela00'.$i;
				}
				$x = ${$nome}[$livro];
				$condicao008 = $condicao008  || $x;
			}		

		if($condicao008){
?>

	<table border="1" bordercolor="#c0c0c0" cellpadding="0"
			cellspacing="0" height="64" width="100%">
		<tbody>
		<tr>
		<td colspan="4" align="center" style="background-color: #ffcc99"
			height="40" width="100%"><b><font color="#000080" size="4">
		BRIEFING</font></b></td>
		</tr>
		</tbody>
	</table>
<?php
	if($mtabela076[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'FALTA OU ATRASO ATCO/ OPR HF/ OPR FMC /OPR PLN';
					$tabela = 'lrotabela76s';
					$vetorTabela = 'Lrotabela76';
					$numeracao = "076";
					$numero = 76;
					$tabelaDados = $tabela76;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela076" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela077[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CHT VENCIDA';
					$tabela = 'lrotabela77s';
					$vetorTabela = 'Lrotabela77';
					$numeracao = "077";
					$numero = 77;
					$tabelaDados = $tabela77;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela077" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela078[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'INSPEÇÃO DE SAÚDE VENCIDA';
					$tabela = 'lrotabela78s';
					$vetorTabela = 'Lrotabela78';
					$numeracao = "078";
					$numero = 78;
					$tabelaDados = $tabela78;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela078" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela079[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ESTADO DE SAÚDE/PSICOLÓGICO COMPROMETIDO';
					$tabela = 'lrotabela79s';
					$vetorTabela = 'Lrotabela79';
					$numeracao = "079";
					$numero = 79;
					$tabelaDados = $tabela79;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela079" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
/*
	if($mtabela080[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ESTADO PSICOLÓGICO COMPROMETIDO';
					$tabela = 'lrotabela80s';
					$vetorTabela = 'Lrotabela80';
					$numeracao = "080";
					$numero = 80;
					$tabelaDados = $tabela80;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 2;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela080" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->input('impacto',array('label'=>'Impacto Operacional','class'=>'','type'=>'checkbox','onclick'=>'var x=$(\'lrotabela'.$numeracao.'Impacto\').checked;if(x){$(\'lrotabelaImpacto'.$numeracao.'\').show();}else{$(\'lrotabelaImpacto'.$numeracao.'\').hide();}'));
					$conteudo = $form->input('descricao_impacto',array('class'=>'formulario','type'=>'textarea'));
					echo $this->Html->div(array('class'=>'input checkbox'),$conteudo,array('id'=>'lrotabelaImpacto'.$numeracao,'style'=>'display:none;'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição','descricao_impacto'=>'Descrição do Impacto');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabelaImpacto'.$numeracao.'\').hide();$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
*/
?>
<?php
	}

?>

<?php
	if($mtabela081[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'CLIMATIZAÇÃO (CONFORTO)';
					$tabela = 'lrotabela81s';
					$vetorTabela = 'Lrotabela81';
					$numeracao = "081";
					$numero = 81;
					$tabelaDados = $tabela81;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela081" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela082[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'LIMPEZA E ILUMINAÇÃO DO ACC AZ, PLN, HF E SALA DE ESTAR';
					$tabela = 'lrotabela82s';
					$vetorTabela = 'Lrotabela82';
					$numeracao = "082";
					$numero = 82;
					$tabelaDados = $tabela82;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela082" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela083[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'MENSAGEM CONFAC';
					$tabela = 'lrotabela83s';
					$vetorTabela = 'Lrotabela83';
					$numeracao = "083";
					$numero = 83;
					$tabelaDados = $tabela83;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela083" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela084[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'FPV DE SOBREVÔO ENTREGUE A SECRETARIA DO ACC';
					$tabela = 'lrotabela84s';
					$vetorTabela = 'Lrotabela84';
					$numeracao = "084";
					$numero = 84;
					$tabelaDados = $tabela84;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela084" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela085[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'ENERGIA ELÉTRICA (ILUMINAÇÃO E TOMADAS)';
					$tabela = 'lrotabela85s';
					$vetorTabela = 'Lrotabela85';
					$numeracao = "085";
					$numero = 85;
					$tabelaDados = $tabela85;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela085" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>
<?php
	if($mtabela086[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'OUTRAS OCORRÊNCIA ADMINISTRATIVAS';
					$tabela = 'lrotabela86s';
					$vetorTabela = 'Lrotabela86';
					$numeracao = "086";
					$numero = 86;
					$tabelaDados = $tabela86;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela086" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<?php
	if($mtabela087[$cumprindoescala[0]['Escala']['livro']]){
?>
		<table border="1" bordercolor="#c0c0c0" cellpadding="10px"	cellspacing="10px" width="100%">
			<tbody>
				<tr>
					<?php
					$titulo = 'SUGESTÕES';
					$tabela = 'lrotabela87s';
					$vetorTabela = 'Lrotabela87';
					$numeracao = "087";
					$numero = 87;
					$tabelaDados = $tabela87;
					$raiz = $this->webroot;
					$controller = $this->params['controller'];
					$quantidade = count($tabelaDados);
					$nivel = 1;
					exibeCabecalho($titulo, $numeracao, $tabela, $raiz, $despachos, $aberta, $privilegio, $corhouve, $cornaohouve, $corciente, $quantidade, $nivel,$acesso);
					?>
					</td>
				</tr>
				<tr>
					<td>
					<div class="ocorrenciastecnicas form" id="tabela087" style="display: false;">
					<?php
					if($aberta==1 && $privilegio=='EXECUTANTE'){
					echo '<fieldset>';
					echo $form->create('lrotabela'.$numeracao,array('onsubmit'=>'return false;', 'action'=>'lro', 'type'=>'file'));
					echo $form->input('descricao',array('class'=>'formulario','type'=>'textarea'));
					
					echo $form->hidden('militar_id',array('class'=>'formulario','value'=>$militar_id));
					echo $form->hidden('supervisorturno_id',array('class'=>'formulario','value'=>$supervisorturnoid));
					echo $form->hidden('data',array('class'=>'formulario','value'=>$data));
					$campos = array('descricao'=>'Descrição');
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$campo.'" name="data[exibir'.$numeracao.'][]"/>';
					}
					foreach($campos as $campo=>$valor){
						echo '<input type="hidden" value="'.$valor.'" name="data[cabecalho'.$numeracao.'][]"/>';
					}
					$EnviaForm = 'submitForm(\'lrotabela'.$numeracao.'LroForm\','.$numero.',\'tabela'.$numeracao.'Dados\');';
					echo $form->end(array('label'=>'Salvar','class'=>'botoes','onclick'=>$EnviaForm.'$(\'lrotabela'.$numeracao.'LroForm\').reset();return false;'));
					echo '</fieldset><br>';
					}
					$campoExcluir = 'descricao';
					exibeDados($campos,$vetorTabela,$tabelaDados, $privilegio, 'tabela'.$numeracao.'Dados', $numeracao, $raiz, $controller, $campoExcluir, $acesso);
					
					?>
					

</td></tr></tbody></table>
<?php
	}
?>

<table border="2" bordercolor="#808080" cellpadding="0"
		cellspacing="0" width="100%">
	<tbody>
	<tr>
		<td colspan="4" align="center"
			style="background-color: #6699ff"><b><font color="#ffffff"
			size="4">RECEBIMENTO DO SERVIÇO E ASSINATURA DO LIVRO</font></b></td>
	</tr>
	<tr>
		<th>Recebimento do Serviço</th>
	</tr>
	<tr>
		<td>Recebi o Serviço do <?php
			foreach($todosSpvChefeEquipe as $supervisor){
				$chfEquipeTodos[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
			}
			echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosrecebimento', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRecebimento'));
			echo $form->select('militar_id', $chfEquipeTodos ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
			?> Ciente das ordens em vigor <input type="checkbox"
			id="notam" name="data[Ocorrencia][notam]">, NOTAM <input
			type="checkbox"> e material carga <input type="checkbox">
			<?php
			echo $form->end(array('label'=>'Assinar Livro', 'class'=>'botoes','onclick'=>'enviaForm(\'formDespacho\');'));
		?></td>
	</tr>
</tbody>
</table>




										</tr>
									</tbody>
								</table>
								</td>
							</tr>
						</tbody>
					</table>
					</div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="mudamilitar">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('mudamilitar')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">


						<?php echo $form->create('Usuario',array('action'=>'login'));?><b>SUBSTITUTO:</b>
					
					</td>
					<select id='supervisor'>
					<?php
					$i = 0;
					foreach ($cumprindoescala as $escalado):
					?>

					<?php

					$nome = $escalado['Posto']['sigla_posto'].' '.$escalado['Especialidade']['nm_especialidade'].'  '.$escalado['Militar']['nm_completo'];
					$nome = str_replace($escalado['Militar']['nm_guerra'], "<b>".$escalado['Militar']['nm_guerra']."</b>", $nome);
					$nome = str_replace($escalado['Posto']['sigla_posto'], "<b>".$escalado['Posto']['sigla_posto']."</b>", $nome);
					$link =$this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false);
					$nome .= $link;


					echo '<option>'.$nome.'</option>';


					?>
					<?php endforeach;
					?>

					</select>
					<br>
					<b>MOTIVO DA SUBSTITUIÇÃO:</b>
					<input type="password" id="UsuarioSenha" class="formulario"
						value="" name="data[Usuario][senha]" />
					<div id='privilegio'></div>
					<?php echo $form->end(array('label'=>'Acessar','class'=>'botoes'));?>
					</div>
					<script type="text/javascript">
<!--
new Draggable('mudamilitar');
//-->
</script>
					</div>




					<script language="javascript">
/*
	var formulario = this;
	var x =formulario.getInputs('checkbox');
	for(i=0;i<x.size();i++){
		nome = x[i].id; 
		   if(x[i].checked){
		    x[i].checked = false;
		    }else{
		    x[i].checked = true;
		    }
	}
	*/

</script>
<?php
			}
			?>

					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="chefeequipe">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('chefeequipe')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="chfeqp"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formChefeEquipe'));
						foreach($todosSpvChefeEquipe as $supervisor){
							$supervisores3[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="chefeEquipeEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdChefeEquipe" value="0"
						name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdChefeEquipe" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataChefeEquipe" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores3 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formChefeEquipe\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('chefeequipe');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorgeral">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorgeral')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supger"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formSupervisorGeral'));
						if($cumprindoescala[0]['Escala']['livro']=='ACCAZ'){
							foreach($todosSpvGeralMN as $supervisor){
								$supervisores1[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
							}
						}else{
							foreach($todosSpvGeral as $supervisor){
								$supervisores1[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
							}
						}
						?> <b>ESCALADO:</b>
					<div id="supervisorGeralEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorGeral"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorGeral" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorGeral" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores1 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formSupervisorGeral\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorgeral');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorRegional">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorRegional')"><img
						border="0" width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supreg"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formSupervisorRegional'));
						foreach($todosSpvRegional as $supervisor){
							$supervisores2[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="supervisorRegionalEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorRegional"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorRegional" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorRegional" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $supervisores2 ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formSupervisorRegional\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorRegional');
//-->
</script></div>



					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladores">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladores')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="control"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControlador'));
						foreach($todosControladores as $supervisor){
							$controladoresTodos[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscalado">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControlador" value="0"
						name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControlador" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControlador" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladoresTodos ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'controladores\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
<script type="text/javascript">
<!--
new Draggable('controladores');
//-->
</script></div>

					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresMU">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresMU')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlmu"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorMU'));
						foreach($todosControladoresMU as $supervisor){
							$controladorMU[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscaladoMU">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorMU"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorMU" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorMU" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladorMU ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorMU\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresMU');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresBL">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresBL')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlbl"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
						<?php
						echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorBL'));
						foreach($todosControladoresBL as $supervisor){
							$controladorBL[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
						}
						?> <b>ESCALADO:</b>
					<div id="controladorEscaladoBL">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorBL"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorBL" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorBL" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
						<?php
						echo $form->select('substituto_id', $controladorBL ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
						echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
						echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorBL\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
						
						?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresBL');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="controladoresPH">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('controladoresPH')"><img border="0"
						width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="controlph"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
					<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formControladorPH'));
				foreach($todosControladoresPH as $supervisor){
					$controladorPH[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
					<div id="controladorEscaladoPH">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdControladorPH"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdControladorPH" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataControladorPH" value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
					<?php
					echo $form->select('substituto_id', $controladorPH ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
					echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
					echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formControladorPH\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
					
					?></div>
					<script type="text/javascript">
<!--
new Draggable('controladoresPH');
//-->
</script></div>


					<div
						style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
						id="supervisorRegionalMU">
					<p
						style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
					MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
						href="javascript:HideContent('supervisorRegionalMU')"><img
						border="0" width="15" height="15" title="Excluir" alt="Excluir"
						src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
					<div id="supregmn"
						style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
					<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalMU'));
				foreach($todosSpvRegionalMN as $supervisor){
					$regionalMU[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
					<div id="supervisorRegionalEscaladoMU">FULANO DE TAL</div>
					<br>
					<input type="hidden" id="cumprimentoEscalaIdSupervisorRegionalMU"
						value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
						type="hidden" id="militarIdSupervisorRegionalMU" value="0"
						name="data[Ocorrencia][militar_id]" /> <input type="hidden"
						id="dataSupervisorRegionalMU"
						value="<?php echo $dataReferencia; ?>"
						name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
					<?php
				echo $form->select('substituto_id', $regionalMU ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalMU\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
					<script type="text/javascript">
<!--
new Draggable('supervisorRegionalMU');
//-->
</script></div>




					</div>
					</div>
					</td>
				</tr>
			</tbody>
		</table>
		</td>
		</tr>
	</tbody>
</table>
</div>
<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="supervisorRegionalBL" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('supervisorRegionalBL')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="supregbl"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalBL'));
				foreach($todosSpvRegionalBL as $supervisor){
				   $regionalBL[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
<div id="supervisorRegionalEscaladoBL">FULANO DE TAL</div>
<br>
<input type="hidden" id="cumprimentoEscalaIdSupervisorRegionalBL"
	value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
	type="hidden" id="militarIdSupervisorRegionalBL" value="0"
	name="data[Ocorrencia][militar_id]" /> <input type="hidden"
	id="dataSupervisorRegionalBL" value="<?php echo $dataReferencia; ?>"
	name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
<?php
				echo $form->select('substituto_id', $regionalBL ,$this->data['Ocorrencia']['mes'] ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalBL\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
<script type="text/javascript">
<!--
new Draggable('supervisorRegionalBL');
//-->
</script></div>

<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="supervisorRegionalPH" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">SUBSTITUIR
MILITAR ESCALADO<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('supervisorRegionalPH')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="supregph"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;">
<?php
				echo $form->create('Ocorrencia',array('onsubmit'=>'return false;', 'action'=>'externosubstituto', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formRegionalPH'));
				foreach($todosSpvRegionalPH as $supervisor){
				   $regionalPH[$supervisor['MilitarsEscala']['militar_id']] = $supervisor['Posto']['sigla_posto'].' '.$supervisor['Especialidade']['nm_especialidade'].'  '.$supervisor['Militar']['nm_completo'];
				}
				?> <b>ESCALADO:</b>
<div id="supervisorRegionalEscaladoPH">FULANO DE TAL</div>
<br>
<input type="hidden" id=cumprimentoEscalaIdSupervisorRegionalPH
	value="0" name="data[Ocorrencia][cumprimentoescala_id]" /> <input
	type="hidden" id="militarIdSupervisorRegionalPH" value="0"
	name="data[Ocorrencia][militar_id]" /> <input type="hidden"
	id="dataSupervisorRegionalPH" value="<?php echo $dataReferencia; ?>"
	name="data[Ocorrencia][data]" /> <b>SUBSTITUTO:</b><br>
<?php
				echo $form->select('substituto_id', $regionalPH ,false ,array('onChange'=>"",'class'=>'formulario'), false);
				echo "<br><br><b>MOTIVO DA SUBSTITUIÇÃO:</b> ";
				echo $form->textarea('motivo',array('cols'=>'80'));
						if($privilegio=='EXECUTANTE'){
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>'enviaForm(\'formRegionalPH\');'));
						}else{
							echo $form->end(array('label'=>'Alterar Escala', 'class'=>'botoes','onclick'=>''));
						}
				?></div>
<script type="text/javascript">
<!--
new Draggable('supervisorRegionalPH');
//-->
</script></div>


<?php
				echo $form->create('variaveis',array('onsubmit'=>'return false;', 'action'=>'','controller'=>'', 'type'=>'file', 'onsubmit'=>'return false;'));
				echo $form->hidden('id');
				echo $form->end();
				
?>
<br>
<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="despachosregional">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">DESPACHO
DOS GERENTES<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('despachosregional')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="despachoregional"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;"><?php
				echo $form->create('DespachoRegional',array('onsubmit'=>'return false;', 'action'=>'externociente','controller'=>'ocorrencias', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formDespachoRegional'));
				?> <?php
				$conteudo = $form->label('ciente_gerente_regional','CIENTE').$form->checkbox('ciente_gerente_regional',array('class'=>'formulario','onclick'=>'cienteNegativo();'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				$conteudo = $form->label('despacho_gerente_regional','DESPACHO').$form->checkbox('despacho_gerente_regional',array('class'=>'formulario','onclick'=>'var x=$(\'DespachoRegionalDespachoGerenteRegional\').checked;if(x){$(\'despachosregionalform\').show();$(\'DespachoRegionalCienteGerenteRegional\').checked=true;}else{$(\'despachosregionalform\').hide();}'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				
				$link =$this->Html->link($this->Html->image('lupa.png', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'externoldap'),array('style'=>'float:left;','onclick'=>'listaLDAP();return false;', 'escape'=>false), null,false);
								
				$formulario  = $form->input('remetente',array('class'=>'formulario','style'=>'width:150px;'));
				$formulario .= $form->input('senha',array('class'=>'formulario','style'=>'width:150px;','type'=>'password'));
				$formulario .= $form->input('destinatarios',array('class'=>'formulario','size'=>'60','style'=>'float:left;')).$link;
				$formulario .= $form->input('assunto',array('class'=>'formulario','size'=>'60'));
				$formulario .= $form->input('motivo',array('cols'=>'60','class'=>'formulario'));
				$formulario .= $form->hidden('supervisorturno_id');
				$formulario .= $form->hidden('nome_tabela');
				$formulario .= $form->hidden('gerente_regional',array('value'=>$militar_id));
				$formulario .= $form->hidden('data_despacho');
				$formulario .= $form->hidden('id');
				echo $this->Html->div(array('class'=>'formulario'),$formulario,array('id'=>'despachosregionalform','style'=>'display:none;'));
				
				
				
				if($aberta==1 && $privilegio=='GERREGIONAL'){
					$despForm = 'despachaForm(\'formDespachoRegional\',\'Regional\');';
				}else{
					$despForm = 'esconde();$(\'alertaSistema\').innerHTML = "<p>Operação não autorizada!</p>";ShowContent(\'mensagem\');';
				}
				echo $form->end(array('label'=>'Despacho', 'class'=>'botoes','onclick'=>$despForm));
?></div>
<script type="text/javascript">
<!--
new Draggable('despachosregional');
//-->
</script></div>




<div
	style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 60%; border: 2px solid rgb(0, 0, 0);"
	id="despachoslocal" class="fixed">
<p
	style="background-color: #000080; color: #fff; height: 30px; margin: 0px; vertical-align: top; border: 2px; border-color: #000;">DESPACHO
DOS GERENTES<a style="float: right; margin: 0px;" id="fechar"
	href="javascript:HideContent('despachoslocal')"><img border="0"
	width="15" height="15" title="Excluir" alt="Excluir"
	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a></p>
<div id="despacholocal"
	style="margin: 0px; background-color: #77aaff; border: 2px; border-color: #000;"><?php
				echo $form->create('DespachoLocal',array('onsubmit'=>'return false;', 'action'=>'externociente','controller'=>'ocorrencias', 'type'=>'file', 'onsubmit'=>'return false;', 'id'=>'formDespachoLocal'));
				$conteudo = $form->label('ciente_gerente_local','CIENTE').$form->checkbox('ciente_gerente_local',array('class'=>'formulario','onclick'=>'cienteNegativo();'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				$conteudo = $form->label('despacho_gerente_local','DESPACHO').$form->checkbox('despacho_gerente_local',array('class'=>'formulario','onclick'=>'var x=$(\'DespachoLocalDespachoGerenteLocal\').checked;if(x){$(\'despachoslocalform\').show();$(\'DespachoLocalCienteGerenteLocal\').checked=true;}else{$(\'despachoslocalform\').hide();}'));
				echo $this->Html->div(array('class'=>'input checkbox'),$conteudo);
				
				$link =$this->Html->link($this->Html->image('lupa.png', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'externoldap'),array('style'=>'float:left;','onclick'=>'listaLDAP();return false;', 'escape'=>false), null,false);

				$formulario  = $form->input('remetente',array('class'=>'formulario','style'=>'width:150px;'));
				$formulario .= $form->input('senha',array('class'=>'formulario','style'=>'width:150px;','type'=>'password'));
				$formulario .= $form->input('destinatarios',array('class'=>'formulario','size'=>'60','style'=>'float:left;')).$link;
				$formulario .= $form->input('assunto',array('class'=>'formulario','size'=>'60'));
				$formulario .= $form->input('motivo',array('cols'=>'60','class'=>'formulario'));
				$formulario .= $form->hidden('supervisorturno_id');
				$formulario .= $form->hidden('tabelaid');
				$formulario .= $form->hidden('data_despacho');
				$formulario .= $form->hidden('id');
				echo $this->Html->div(array('class'=>'formulario'),$formulario,array('id'=>'despachoslocalform','style'=>'display:none;'));
				
				
				if($aberta==1 && $privilegio=='GERLOCAL'){
					$despForm = 'despachaForm(\'formDespachoLocal\',\'Local\');';
				}else{
					$despForm = 'esconde();$(\'alertaSistema\').innerHTML = "<p>Operação não autorizada!</p>";ShowContent(\'mensagem\');';
				}
							
				echo $form->end(array('label'=>'Despacho', 'class'=>'botoes','onclick'=>$despForm));
				
?></div>
<script type="text/javascript">
<!--
new Draggable('despachoslocal');
//-->
</script></div>



<script language="javascript">
	$('despachoslocal').hide();
	$('despachosregional').hide();
	$('mensagem').hide();
    $('chefeequipe').hide();
    $('supervisorRegional').hide();
    $('supervisorgeral').hide();
    $('controladores').hide();
    $('supervisorRegionalMU').hide();
    $('supervisorRegionalBL').hide();
    $('supervisorRegionalPH').hide();
    $('controladoresMU').hide();
    $('controladoresBL').hide();
    $('controladoresPH').hide();
    $('despachoslocal').hide();
 	$('mensagem').hide();

</script>


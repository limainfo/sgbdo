<!-- 
<style type="text/css">
<!--
.botao  {
position:absolute;
top:20px;
left:50px;
margin:0px;
padding:0px;
        }

.botao a, .botao a:visited {  
font: bold 12px/24px arial, helvetica, sans-aerif;	
padding:0px;
text-decoration: none;
text-align:center;	
color:#fff;
background: #202090 url('botao_link.gif') no-repeat 
center center;	
width:120px;  
height:24px;	
display:block;	
	}

.botao a:hover { 
background: #666 url('botao_hover.gif') no-repeat 
center center;
color:#999;
               }
-->

</style>

<p class="botao">
<a href="#" title="Meu Link">Botão CSS</a>
</p>
-->
<div class="periodicidades index" style='float:center;top:0px;position:relative;background-color:#fff;'>
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>
<h2><p align="center" style="font-weight:bold;font-family:arial;font-size:0.5em;">
MINISTÉRIO DA DEFESA<BR>
COMANDO DA AERONÁUTICA<BR>
CINDACTA IV<BR>
DIVISÃO DE OPERAÇÕES<BR>
<BR>
PEDIDO DE AQUISIÇÃO DE MATERIAIS<BR>
QUADRO DE ACOMPANHAMENTO DOS PEDIDOS DE AQUISIÇÃO DE MATERIAL<BR>
<a href="/operacional/img/processo_pam.png" target="_blank"><img border="0"  title="Orientações para confecçao do PAM"  src="/operacional/img/ajuda.png"></a>
</p></h2>
<?php 
//iconv('UTF-8','ISO-8859-1',
//print_r($pams);
$exibe=array('gestor'=>1,'pag'=>1,'classe'=>0,'numero'=>1,'descricao'=>1,'quantidade'=>1,'custo_unitario'=>1,'total'=>1,'referencia'=>0,'aplicacao'=>1,'status_atual'=>1,'observacoes'=>1,'pam'=>1,'acompanhamento'=>1,'data_gestor'=>1,'loggestor'=>1,'data_oaple'=>1,'logoaple'=>1,'data_pedido'=>1,'data_analise'=>1,'data_pam'=>1,'data_assinaturachfdo'=>1,'data_assinaturachfda'=>1,'data_assinaturachfcontrinterno'=>1,'data_assinaturachfdaconf'=>1,'data_assinaturachfcontrinternoconf'=>1,'data_finalizacao'=>1);
?>
<style>
caption, th, td{
 border-style:solid;
 border:1px solid;
 text-align:center;font-family:arial;font-size:0.9em;height:20px;
}
</style>
<table cellpadding="0" cellspacing="0">
<tr><th bgcolor="#608060" ><font color="#ffffff"><b>GESTORES</b></font></th><th bgcolor="#b0f0b0"><b>OAPLE</b></th></tr>
	<tr>
<td>
<?php 
$soma = 0;
$rodape='#c0b0a0';
$cabecalho='#f0fbfc';
$altura='<img border="0"  src="/operacional/img/altura.png">';

?>
<!-- Coluna Gestores -->
<table cellpadding="0" cellspacing="0" border="1">
	<tr  <?php echo "bgcolor=\"$cabecalho\""; ?>>
	<?php if($exibe['gestor']){?>
		<th><?php __('Gestor');?></th>
	<?php }	?>
	<?php if($exibe['classe']){?>
		<th><?php __('Classe');?></th>
	<?php }	?>
	<?php if($exibe['numero']){?>
		<th><?php __('No.');?></th>
	<?php }	?>
	<?php if($exibe['descricao']){?>
		<th><?php __('Descrição');?></th>
	<?php }	?>
	<?php if($exibe['quantidade']){?>
		<th><?php __('Qtd');?></th>
	<?php }	?>
	<?php if($exibe['custo_unitario']){?>
		<th><?php __('Custo Unitário em R$');?></th>
	<?php }	?>
	<?php if($exibe['total']){?>
		<th><?php __('Custo Total em R$');?></th>
	<?php }	?>
	<?php if($exibe['referencia']){?>
		<th><?php __('Referência');?></th>
	<?php }	?>
	<?php if($exibe['aplicacao']){?>
		<th><?php __('Aplicação');?></th>
	<?php }	?>
	</tr>
	<?php
	$i = 0;
	foreach ($pams as $pam):
	$class = null;
	//if(!strpos($pam['Pam']['status_atual'],' acao')===false){
	if(!strpos(iconv('ISO-8859-1','UTF-8',$pam['Pam']['status_atual']),' ação')===false){
		$class = ' style="background-color:#ff0000;" ';
	}else{
			if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
			
		}
	}
	if($pam['Pam']['numero']==17){
			$class = ' style="background-color:#ffff00;" ';
	}	
	?>
	<tr <?php echo $class;?>>
	<?php if($exibe['gestor']){?>
		<td><?php echo $altura.'&nbsp;';
				echo $pam['Pam']['gestor']; ?></td>
	<?php }	?>
	<?php if($exibe['classe']){?>
		<td><?php echo $altura.'&nbsp;';
		echo $pam['Pam']['classe']; ?></td>
	<?php }	?>
	<?php if($exibe['numero']){?>
		<td><?php echo $altura.'&nbsp;';
		echo $pam['Pam']['numero']; ?></td>
	<?php }	?>
	<?php if($exibe['descricao']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['descricao'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['descricao']).'\',\'Descrição\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		}
		?>
		</td>
	<?php }	?>
	<?php if($exibe['quantidade']){?>
		<td><?php echo $altura.'&nbsp;';
		echo $pam['Pam']['quantidade']; ?></td>
	<?php }	?>
	<?php if($exibe['custo_unitario']){?>
		<td><?php echo $altura.'&nbsp;';
		echo $pam['Pam']['custo_unitario']; ?></td>
	<?php }	?>
	<?php if($exibe['total']){?>
		<td><?php echo $altura.'&nbsp;';
		echo $pam['Pam']['total']; 
		$soma += $pam['Pam']['total'];
		?></td>
	<?php }	?>
	<?php if($exibe['referencia']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['referencia'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['referencia']).'\',\'Referência\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		}
		?>
				</td>
	<?php }	?>
	<?php if($exibe['aplicacao']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['aplicacao'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['aplicacao']).'\',\'Aplicação\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		}
		?>
				</td>
			<?php }	?>
	</tr>
	<?php endforeach; ?>
	
	
	<tr  <?php echo "bgcolor=\"$rodape\""; ?>>
	<?php if($exibe['gestor']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['classe']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['numero']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['descricao']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['quantidade']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['custo_unitario']||$exibe['total']){?>
		<td>&nbsp;<b>Total:</b></td>
	<?php }	?>
	<?php if($exibe['total']){?>
		<td bgcolor="#0000ff">&nbsp;<b><?php echo $soma; 
		?></b></td>
	<?php }	?>
	<?php if($exibe['referencia']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['aplicacao']){?>
		<td>&nbsp;</td>
	<?php }	?>
	</tr>
</table>
</td><td>
<!-- Coluna OAPLE -->
<table cellpadding="0" cellspacing="0">
	<tr <?php echo "bgcolor=\"$cabecalho\""; ?>>
	<?php if($exibe['observacoes']){?>
		<th><?php __('Observações');?></th>
	<?php }	?>
	<?php if($exibe['pam']){?>
		<th><?php __('PAM');?></th>
	<?php }	?>
	<?php if($exibe['acompanhamento']){?>
		<th><?php __('Acompanhamento');?></th>
	<?php }	?>
	<?php if($exibe['status_atual']){?>
		<th><?php __('Status');?></th>
	<?php }	?>
	<?php if($exibe['pag']){?>
		<th><?php __('PAG');?></th>
	<?php }	?>
	</tr>
	<?php
	$i = 0;
	foreach ($pams as $pam):
	$class = null;
	if(!strpos(iconv('ISO-8859-1','UTF-8',$pam['Pam']['status_atual']),' ação')===false){
			$class = ' style="background-color:#ff0000;" ';
	}else{
			if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
			
		}
	}
	if($pam['Pam']['numero']==17){
			$class = ' style="background-color:#ffff00;" ';
	}	
			?>
	<tr <?php echo $class;?>>
	<?php if($exibe['observacoes']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['observacoes'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['observacoes']).'\',\'Observações\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		} ?></td>
			<?php }	?>
	<?php if($exibe['pam']){?>
		<td><?php echo $altura.'&nbsp;'.$pam['Pam']['pam']; ?></td>
	<?php }	?>
	<?php if($exibe['acompanhamento']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['acompanhamento'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['acompanhamento']).'\',\'Acompanhamento\');" ><img border="0" style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		} ?></td>
			<?php }	?>
	<?php if($exibe['status_atual']){?>
		<td><?php 
			echo $altura.'&nbsp;';
		if(strlen($pam['Pam']['status_atual'])>0){
			echo '<a  onclick="exibeDetalhes(\''.iconv('ISO-8859-1','UTF-8',$pam['Pam']['status_atual']).'\',\'Status Atual\');" ><img border="0"  style="cursor:hand;cursor:pointer;" src="/operacional/img/despacho.gif"></a>';
		} ?></td>
			<?php }	?>
	<?php if($exibe['pag']){?>
		<td><?php 
			echo $altura.'&nbsp;';
			echo $pam['Pam']['pag'];
		 ?></td>
			<?php }	?>
	</tr>
	<?php endforeach; ?>

	<tr <?php echo "bgcolor=\"$rodape\""; ?>>
	<?php if($exibe['observacoes']){?>
		<td>&nbsp;</td>
			<?php }	?>
	<?php if($exibe['pam']){?>
		<td>&nbsp;</td>
	<?php }	?>
	<?php if($exibe['acompanhamento']){?>
		<td>&nbsp;</td>
			<?php }	?>
	<?php if($exibe['status_atual']){?>
		<td>&nbsp;</td>
			<?php }	?>
	<?php if($exibe['pag']){?>
		<td>&nbsp;</td>
			<?php }	?>
	</tr>
</table>
</td>
</tr>
</table>




</td></tr>
</table>
</div>
<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1000" id="detalhes">
<p id="campo" style="padding:0px;height:20px;background-color: #a0abbc; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;"></p>
<p	style="margin: 0px; background-color: #ffff00; border: 1px solid #000;"><div id="detalhe"></div></p>
<script type="text/javascript">
<!--
new Draggable('detalhes');
//-->
</script>
</div>

<script type="text/javascript">
$('detalhes').hide();
HideContent('detalhes');
</script>

<script type="text/javascript">
function exibeDetalhes(detalhes, campo) {
 	$('detalhe').innerHTML = unescape(detalhes);
 	var excluir = '<a style="float: right; margin: 0px;" href="javascript:HideContent(\'detalhes\');"	onclick="HideContent(\'detalhes\');" 	href="javascript:HideContent(\'detalhes\');"><img border="0" width="15"	height="15" title="Excluir" alt="Excluir" 	src="<?php echo $this->webroot; ?>img/lixo.gif" /> </a>';
 	$('campo').innerHTML = unescape(campo)+excluir;
 	ShowContent('detalhes');
}

</script>


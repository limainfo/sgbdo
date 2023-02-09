<?php 
			if ($ok) {
				echo '<p class="message" id="mensagens"><b>Os dados foram gravados.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');HideContent(\'edicao\');</script>';
			} else {
				echo '<p class="message" id="mensagens"><b>Os dados não foram gravados. Por favor, tente novamente.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});</script>';
			}

?>
<table cellpadding="0" cellspacing="0">
	<tr style="vertical-align: middle;">
		<th colspan="20"
			style="vertical-align: middle; border: 1px solid #000; background-color: #000060; color: #fff;"><center>LISTAGEM DAS CHAMADAS GERADAS&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	echo $ajax->link($this->Html->image('novo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoadd', null),array('escape'=>false, 'update'=>'formularios'), null,false);
	?>
</center></th>
	</tr>
	<tr>
		<th>Data</th>
		<th>Chamada</th>
		<th>Divisão</th>
		<th>Setor</th>
		<th>Nome</th>
		<th>Início</th>
		<th>Justificativa</th>
		<th>Término</th>
		<th>Justificativa</th>
		<th>Ações</th>
	</tr>
	<?php 
$i=0;
		$dados = $this->requestAction('chamadas/externolista/'.$nome_chamada.'/'.$dia);
		$presencas = array(''=>'','P'=>'P','F'=>'F');
		
		foreach($dados as $dado){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				echo "<tr {$class}><td>{$dado['Chamada']['dia']}</td>";
				echo "<td>{$dado['Chamada']['nome_chamada']}</td>";
				echo "<td>{$dado['Chamada']['divisao']}</td>";
				echo "<td><b>{$dado['Chamada']['setor']}</b></td>";
				$tmp = str_replace($dado['Chamada']['nome_guerra'],'<b>'.$dado['Chamada']['nome_guerra'].'</b>',$dado['Chamada']['nome_completo']);
				echo "<td>{$tmp}</td>";
				echo '<td>'.$form->input('presenca_inicio',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$dado['Chamada']['presenca_inicio'], 'label'=>false, 'onChange'=>'marcapresenca("'.$dado['Chamada']['id'].'","I");', 'id'=>'I'.$dado['Chamada']['id'])).'</td>';
				echo "<td>{$form->input('justificativa_inicio',array('class'=>'formulario','type' => 'textarea', 'rows' => '3', 'value'=>$dado['Chamada']['justificativa_inicio'], 'label'=>false, 'onChange'=>'alterajustificativa("'.$dado['Chamada']['id'].'","JI");', 'id'=>'JI'.$dado['Chamada']['id']))}</td>";

				echo '<td>'.$form->input('presenca_termino',array('class'=>'formulario','type' => 'select', 'options' => $presencas, 'default'=>$dado['Chamada']['presenca_termino'], 'label'=>false, 'onChange'=>'marcapresenca("'.$dado['Chamada']['id'].'","T");', 'id'=>'T'.$dado['Chamada']['id'])).'</td>';
				echo "<td>{$form->input('justificativa_termino',array('class'=>'formulario','type' => 'textarea', 'rows' => '3', 'value'=>$dado['Chamada']['justificativa_termino'], 'label'=>false, 'onChange'=>'alterajustificativa("'.$dado['Chamada']['id'].'","JT");', 'id'=>'JT'.$dado['Chamada']['id']))}</td>";
				echo "<td>";
				//echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'index', $testeopprova['Testeopprova']['id']),array('escape'=>false, 'update'=>'View'), null,false);
				echo $ajax->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'externoedit', $dado['Chamada']['id']),array('escape'=>false, 'update'=>'edicao','method'=>'post', 'with'=>'\'data[id]='.$dado['Chamada']['id'].'&value=help\'' ), null,false);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$dado['Chamada']['nome_completo']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$dado['Chamada']['id'].'/'.$nome_chamada.'/'.$dia."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false); 
				echo "<td></td></tr>";
			
		}
						
?>
</table>
<script type="text/javascript">
	HideContent('carregando');
	HideContent('formularios');
	HideContent('edicao');
</script>
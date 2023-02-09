<p class="message" id="atencao"><b><?php if($ok){echo "Registro excluído com sucesso!";}else{echo "Houve erro na exclusão do registro!";} ?></b></p><script language="javascript">new Effect.Fade('atencao',{delay: 5});</script>
		<h2>Atualmente cadastrados</h2><table cellpadding=\"0\" cellspacing=\"0\"><tr><th>Militar</th><th>Setor</th><th>Curso</th><th>Data Inicio</th><th>Data Fim</th><th>Local</th><th>Documento</th><th>Ações</th></tr>
<?php 
		
		//				print_r($militarscursos);

		$i = 0;
		foreach ($militarscursos as $militarscurso):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		//$acao = $this->Html->link($this->Html->image('lixo.gif', array('alt'=> 'Excluir', 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$especialidadesSetor['EspecialidadesSetor']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);
		$acao = "<a onclick='this.href=\"#\";return false;' onmousedown='dialogo(\"Deseja realmente excluir o registro #".$militarscurso['Curso']['codigo']." ?\" ,\"javascript:excluiRegistro(".$militarscurso['MilitarsCurso']['id'].");\");' href=\"".$this->webroot.$this->params['controller']."\"><img border=\"0\" title=\"Excluir\" alt=\"Excluir\" src=\"".$this->webroot."img/lixo.gif\"/></a>";

				echo "	<tr {$class}><td>{$militarscurso['Militar']['nm_completo']} - {$militarscurso['Posto']['sigla_posto']} {$militarscurso['Especialidade']['nm_especialidade']} </td><td>{$militarscurso['Setor']['sigla_setor']}</td><td>{$militarscurso['Curso']['codigo']}</td><td>{$militarscurso['MilitarsCurso']['dt_inicio_curso']}</td><td>{$militarscurso['MilitarsCurso']['dt_fim_curso']}</td><td>{$militarscurso['MilitarsCurso']['local_realizacao']}</td><td>{$militarscurso['MilitarsCurso']['documento']}</td><td>{$acao}</td></tr>";
		
		endforeach;
		

?>
</table>
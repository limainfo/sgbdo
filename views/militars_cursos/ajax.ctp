<div class="militarsCursos index">
<h1><?php __('Militares/Cursos');?>
&nbsp;<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
</h1>
<h3>Confirmar conclusão de curso</h3>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
	echo "<pre>";
	//print_r($colunas);
	echo "</pre>";
	
	$i = 0;
	foreach ($militarsCursos as $militarsCurso):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $militarsCurso['MilitarsCurso']['id']; ?></td>
		<td><?php echo $this->Html->link($militarsCurso['Militar']['identidade'], array('controller'=> 'militars', 'action'=>'view', $militarsCurso['Militar']['id'])); ?>
		</td>
		<td><?php echo $this->Html->link($militarsCurso['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $militarsCurso['Curso']['id'])); ?>
		</td>
		<td><?php echo $militarsCurso['MilitarsCurso']['periodo']; ?>
		</td>
		<td><?php echo $militarsCurso['MilitarsCurso']['dt_inicio_curso']; ?>
		</td>
		<td><?php echo $militarsCurso['MilitarsCurso']['dt_fim_curso']; ?></td>
		<td><?php echo $militarsCurso['MilitarsCurso']['local_realizacao']; ?>
		</td>
		<td><?php echo $militarsCurso['MilitarsCurso']['documento']; ?></td>
		<td class="actions"><?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $militarsCurso['MilitarsCurso']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('action'=>'edit', $militarsCurso['MilitarsCurso']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<br><hr>

<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $rotulo['Rotulo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$rotulo['Rotulo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$rotulo['Rotulo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="rotulos view">
<h2><?php  __('Rotulo');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $rotulo['Rotulo']['id']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Rotulo</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $rotulo['Rotulo']['rotulo']; ?></TD></TR><TABLE>
<?php
echo '<pre>';
//print_r($rotulo['EspecialidadesSetor']);
echo '</pre>';
?>
<div class="related">
	<h3><?php __(count($rotulo['EspecialidadesSetor']).' Especialidades Setors');?></h3>
	<?php if (!empty($rotulo['EspecialidadesSetor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Especialidade Id'); ?></th>
		<th><?php __('Setor Id'); ?></th>
		<th><?php __('Rotulo Id'); ?></th>
		<th><?php __('Necessario'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rotulo['EspecialidadesSetor'] as $especialidadesSetor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $especialidadesSetor['Especialidade']['nm_especialidade'];?></td>
			<td><?php echo $especialidadesSetor['Setor']['sigla_setor'];?></td>
			<td><?php echo $especialidadesSetor['rotulo_id'];?></td>
			<td><?php echo $especialidadesSetor['necessario'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'especialidades_setors', 'action'=>'view', $especialidadesSetor['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'especialidades_setors', 'action'=>'edit', $especialidadesSetor['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$especialidadesSetor['Especialidade']['nm_especialidade'].' '.$especialidadesSetor['Setor']['sigla_setor']." ?' ,'"."especialidades_setors".'/delete/'.$especialidadesSetor['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php __(count($rotulo['Curso']).' Cursos');?></h3>
	<?php if (!empty($rotulo['Curso'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Codigo'); ?></th>
		<th><?php __('Descricao'); ?></th>
		<th><?php __('Pre Requisito'); ?></th>
		<th><?php __('Objetivo'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($rotulo['Curso'] as $curso):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $curso['codigo'];?></td>
			<td><?php echo $curso['descricao'];?></td>
			<td><?php echo $curso['pre_requisito'];?></td>
			<td><?php echo $curso['objetivo'];?></td>
			<td class="actions">
			<?php echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('controller'=> 'cursos', 'action'=>'view', $curso['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Editar', true), 'border'=> '0', 'title'=>'Editar')), array('controller'=> 'cursos', 'action'=>'edit', $curso['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$curso['codigo']." ?' ,'"."cursos".'/delete/'.$curso['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>

				
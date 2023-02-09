<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $cursoativo['Cursoativo']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$cursoativo['Cursoativo']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$cursoativo['Cursoativo']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="cursoativos view">
<h2><?php  __('Cursoativo');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['id']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Curso</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $this->Html->link($cursoativo['Curso']['codigo'], array('controller'=> 'cursos', 'action'=>'view', $cursoativo['Curso']['id'])); ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Turma</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['turma']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Data Inicio</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['data_inicio']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Data Termino</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['data_termino']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Vagas</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['vagas']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Documento Ativacao</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['documento_ativacao']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Local Realizacao</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['local_realizacao']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Data Indicacao</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $cursoativo['Cursoativo']['data_indicacao']; ?></TD></TR><TABLE>
</div>

<div class="related">
	<h3><?php __('Related Indicadoscursos');?></h3>
	<?php if (!empty($cursoativo['Indicadoscurso'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Cursoativo Id'); ?></th>
		<th><?php __('Militar Id'); ?></th>
		<th><?php __('Prioridade'); ?></th>
		<th><?php __('Indicado'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Ações');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($cursoativo['Indicadoscurso'] as $indicadoscurso):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $indicadoscurso['id'];?></td>
			<td><?php echo $indicadoscurso['cursoativo_id'];?></td>
			<td><?php echo $indicadoscurso['militar_id'];?></td>
			<td><?php echo $indicadoscurso['prioridade'];?></td>
			<td><?php echo $indicadoscurso['indicado'];?></td>
			<td><?php echo $indicadoscurso['status'];?></td>
			<td><?php echo $indicadoscurso['updated'];?></td>
			<td><?php echo $indicadoscurso['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller'=> 'indicadoscursos', 'action'=>'view', $indicadoscurso['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller'=> 'indicadoscursos', 'action'=>'edit', $indicadoscurso['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller'=> 'indicadoscursos', 'action'=>'delete', $indicadoscurso['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $indicadoscurso['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>


</div>

				
<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="ocorrenciasoperacionais view">
<h2><?php  __('Ocorrenciasoperacionai');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Tabela</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['tabela']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Registroid</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['registroid']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Inicio</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['inicio']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Termino</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciasoperacionai['Ocorrenciasoperacionai']['termino']; ?></TD></TR><TABLE>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ocorrenciasoperacionai', true), array('action'=>'edit', $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ocorrenciasoperacionai', true), array('action'=>'delete', $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ocorrenciasoperacionai['Ocorrenciasoperacionai']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ocorrenciasoperacionais', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ocorrenciasoperacionai', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

				
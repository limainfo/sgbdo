<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $ocorrenciastecnica['Ocorrenciastecnica']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$ocorrenciastecnica['Ocorrenciastecnica']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$ocorrenciastecnica['Ocorrenciastecnica']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="ocorrenciastecnicas view">
<h2><?php  __('Ocorrenciastecnica');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciastecnica['Ocorrenciastecnica']['id']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Equipamento</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $this->Html->link($ocorrenciastecnica['Equipamento']['id'], array('controller'=> 'equipamentos', 'action'=>'view', $ocorrenciastecnica['Equipamento']['id'])); ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Inicio</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciastecnica['Ocorrenciastecnica']['inicio']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Termino</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciastecnica['Ocorrenciastecnica']['termino']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Nr Sci</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $ocorrenciastecnica['Ocorrenciastecnica']['nr_sci']; ?></TD></TR><TABLE>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ocorrenciastecnica', true), array('action'=>'edit', $ocorrenciastecnica['Ocorrenciastecnica']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ocorrenciastecnica', true), array('action'=>'delete', $ocorrenciastecnica['Ocorrenciastecnica']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ocorrenciastecnica['Ocorrenciastecnica']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ocorrenciastecnicas', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ocorrenciastecnica', true), array('action'=>'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Equipamentos', true), array('controller'=> 'equipamentos', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Equipamento', true), array('controller'=> 'equipamentos', 'action'=>'add')); ?> </li>
	</ul>
</div>

				
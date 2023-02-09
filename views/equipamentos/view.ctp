<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $equipamento['Equipamento']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$equipamento['Equipamento']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$equipamento['Equipamento']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="equipamentos view">
<h2><?php  __('Equipamento');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $equipamento['Equipamento']['id']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Nome</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $equipamento['Equipamento']['nome']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Tipo</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $equipamento['Equipamento']['tipo']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Descricao</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $equipamento['Equipamento']['descricao']; ?></TD></TR><TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Localidade Id</B></FONT></TD></TR><TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $equipamento['Equipamento']['localidade_id']; ?></TD></TR><TABLE>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Equipamento', true), array('action'=>'edit', $equipamento['Equipamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Equipamento', true), array('action'=>'delete', $equipamento['Equipamento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $equipamento['Equipamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Equipamentos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Equipamento', true), array('action'=>'add')); ?> </li>
	</ul>
</div>

				
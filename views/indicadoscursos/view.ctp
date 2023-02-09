<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $indicadoscurso['Indicadoscurso']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$indicadoscurso['Indicadoscurso']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$indicadoscurso['Indicadoscurso']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?><div class="indicadoscursos view">
<h2><?php  __('Indicadoscurso');?></h2>
<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Id</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['id']; ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Cursoativo</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $this->Html->link($indicadoscurso['Cursoativo']['curso_id'], array('controller'=> 'cursoativos', 'action'=>'view', $indicadoscurso['Cursoativo']['id'])); ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Militar</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $this->Html->link($indicadoscurso['Militar']['nm_completo'], array('controller'=> 'militars', 'action'=>'view', $indicadoscurso['Militar']['id'])); ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Prioridade</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['prioridade']; ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Indicado</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['indicado']; ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Status</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['status']; ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Updated</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['updated']; ?></TD></TR>
<TR VALIGN=TOP><TD STYLE="background: #b3b3b3"><FONT SIZE=1 STYLE="font-size: 8pt"><B>Created</B></FONT></TD></TR>
<TR VALIGN=TOP><TD  STYLE="background: #99ccff"><?php echo $indicadoscurso['Indicadoscurso']['created']; ?></TD></TR>
</TABLE>
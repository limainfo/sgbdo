			<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$inspecao['Inspecao']['origem']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$inspecao['Inspecao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		

<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>

	<TR VALIGN=TOP>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>N&Uacute;MERO</B></FONT>
	  </TD>
		<TD ROWSPAN=2 COLSPAN=3> </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>DATA</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD  STYLE="background: #99ccff">
		&nbsp;<?php echo $inspecao['Inspecao']['numero']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
		&nbsp;<?php echo $inspecao['Inspecao']['data']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP >
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>ORIGEM</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>TIPO</B></FONT>
	  </TD>
		<TD COLSPAN=2  STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>ORG&Atilde;O</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>ITEM</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD  STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['origem']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['tipo']; ?>
		</TD>
		<TD COLSPAN=2    STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['orgao']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['item']; ?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>DESCRI&Ccedil;&Atilde;O</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5  VALIGN=TOP  STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['descricao']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>GESTOR</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRAZO</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['gestor']; ?>
		</TD>
		<TD COLSPAN=2  STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['prazo']; ?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>A&Ccedil;&Atilde;O
			RECOMENDADA</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5 WIDTH=556 VALIGN=TOP STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['acao_recomendada']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>OBSERVAÇÃO DO CHEFE DA DIVISÃO OPERACIONAL</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['obs_chf_d_o']; ?>

		</TD>
	</TR>
	
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>PLANO DE A&Ccedil;&Atilde;O DO GESTOR</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5 WIDTH=556 VALIGN=TOP STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['plano_acao_gestor']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>EXECUTOR</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>CONTROLE OAPLE</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['executor']; ?>

		</TD>
		<TD COLSPAN=2 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['controle_oaple']; ?>

		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>A&Ccedil;&Otilde;ES EXECUTADAS</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['acoes_executadas']; ?>

		</TD>
	</TR>


	
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>STATUS DA META</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>STATUS GERAL</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['status_meta']; ?>

		</TD>
		<TD COLSPAN=2 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['status']; ?>

		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRÓXIMA AÇÃO</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRAZO PRÓXIMA AÇÃO</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['proxima_acao']; ?>

		</TD>
		<TD COLSPAN=2 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['prazo_proxima_acao']; ?>

		</TD>
	</TR>
	
</TABLE>


<br>



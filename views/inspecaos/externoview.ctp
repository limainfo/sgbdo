	&nbsp;&nbsp;&nbsp;
		<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'externoindex', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		

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
		<TD COLSPAN="2" STYLE="background: #b3b3b3">
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
		<TD COLSPAN="2" STYLE="background: #99ccff">
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
			&nbsp;<?php echo $inspecao['Inspecao']['obs_do']; ?>

		</TD>
	</TR>
	
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>PROVID&Ecirc;NCIA GESTOR</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5 WIDTH=556 VALIGN=TOP STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['providencia_gestor']; ?>
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
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>A&Ccedil;&Atilde;O EXECUTOR</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['acao_executor']; ?>

		</TD>
	</TR>

	
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>STATUS</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=5 STYLE="background: #99ccff">
			&nbsp;<?php echo $inspecao['Inspecao']['status']; ?>

		</TD>
	</TR>
	
</TABLE>


<br>



	<?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Modificar Dados')), array('action'=>'edit', $recomendacao['Recomendacao']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$recomendacao['Recomendacao']['id']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$recomendacao['Recomendacao']['id']."');",'onclick'=>"this.href='#';return false;",'escape'=>false, 'escape'=>false), null,false);	?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar')), array('action'=>'add', null),array('escape'=>false, 'escape'=>false), null,false); ?>
	&nbsp;&nbsp;&nbsp;
	<?php echo $this->Html->link($this->Html->image('setaesq.gif', array('alt'=> __('Índice', true), 'border'=> '0', 'title'=>'Índice')), array('action'=>'index', null),array('escape'=>false, 'escape'=>false), null,false); ?>
		

<TABLE WIDTH=100% BORDER=1 BORDERCOLOR="#000000" CELLPADDING=0 CELLSPACING=0>

	<TR VALIGN=TOP>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>DOCUMENTO</B></FONT>
	  </TD>
		<TD ROWSPAN=2 COLSPAN=3> </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>DATA</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD  STYLE="background: #99ccff">
<?php echo $recomendacao['Recomendacao']['documento']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
		<?php echo $recomendacao['Recomendacao']['data']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP >
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>DATA RECOMENDAÇÃO</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRAZO SIPACEA</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRAZO DO</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>LOCALIDADE</B></FONT>
	  </TD>
		<TD STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>SETOR</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['data_recomendacao']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['prazo_sipacea']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['prazo_do']; ?>
		</TD>
		<TD   STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['localidade']; ?>
		</TD>
		<TD  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['setor']; ?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>PERIGO IDENTIFICADO</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5  VALIGN=TOP  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['perigo_identificado']; ?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>DESCRI&Ccedil;&Atilde;O DO PERIGO</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5 WIDTH=556 VALIGN=TOP STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['descricao_perigo']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>DESCRIÇÃO DA RECOMENDAÇÃO</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>NÚMERO DA RECOMENDAÇÃO</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['descricao_recomendacao']; ?>
		</TD>
		<TD COLSPAN=2  STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['numero_recomendacao']; ?>
		</TD>
	</TR>
	<TR>
		<TD COLSPAN=5 VALIGN=TOP STYLE="background: #b3b3b3">
			<center><FONT SIZE=1 STYLE="font-size: 8pt"><B>PROVID&Ecirc;NCIA</B></FONT></center>
	  </TD>
	</TR>
	<TR>
		<TD COLSPAN=5 WIDTH=556 VALIGN=TOP STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['providencia']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>REGISTRO DE CUMPRIMENTO</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>STATUS</B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['registro_cumprimento']; ?>

		</TD>
		<TD COLSPAN=2 STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['status']; ?>
		</TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B>PRÓXIMA AÇÃO</B></FONT>
	  </TD>
		<TD COLSPAN=2 STYLE="background: #b3b3b3">
			<FONT SIZE=1 STYLE="font-size: 8pt"><B></B></FONT>
	  </TD>
	</TR>
	<TR VALIGN=TOP>
		<TD COLSPAN=3 STYLE="background: #99ccff">
			<?php echo $recomendacao['Recomendacao']['proxima_acao']; ?>

		</TD>
		<TD COLSPAN=2 STYLE="background: #99ccff">
		</TD>
	</TR>
</TABLE>


<br>



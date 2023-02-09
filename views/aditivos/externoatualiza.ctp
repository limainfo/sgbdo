<?php 
if ($ok) {
        echo '<p class="message" id="mensagens"><b>Tabelas sincronizadas.</b></p><script language="javascript">ShowContent(\'listagem\');new Effect.Fade(\'mensagens\',{delay: 5});HideContent(\'formularios\');</script>';
} else {
        echo '<p class="message" id="mensagens"><b>Tarefa concluída</b></p><script language="javascript">new Effect.Fade(\'mensagens\',{delay: 5});</script>';
}

?><TABLE FRAME=VOID CELLSPACING=0 COLS=9 RULES=NONE BORDER=0 align="center">
<COLGROUP><COL WIDTH=160><COL WIDTH=100><COL WIDTH=100><COL WIDTH=260></COLGROUP>

<TBODY>
    <TR>
            <TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TABELA</TD>
            <TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">INÍCIO</TD>
            <TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">TÉRMINO</TD>
            <TD style="background-color:#e0e0e0;text-align:center;border: 1px solid #000;">STATUS</TD>
    </TR>
    <?php 
    foreach($tabela as $dados){
    ?>
    <TR>
            <TD style="background-color:#ffffff;text-align:center;border: 1px solid #000;"><?php echo $dados['tabela']; ?></TD>
            <TD style="background-color:#ffffff;text-align:center;border: 1px solid #000;"><?php echo $dados['inicio']; ?></TD>
            <TD style="background-color:#ffffff;text-align:center;border: 1px solid #000;"><?php echo $dados['fim']; ?></TD>
            <TD style="background-color:#ffffff;text-align:left;border: 1px solid #000;"><?php echo $dados['status']; ?></TD>
    </TR>
    <?php 
    }
    ?>
</TBODY>
</TABLE>
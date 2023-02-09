<div class="aditivos form">
<?php echo $form->create('Aditivo', array('action'=>'add','onsubmit'=>'return false;','type'=>'file', 'inputDefaults' => array('label' => false,'div' => false)));?>
<?php 
        echo $ajax->div('opcoesTurnos');
        echo $ajax->divEnd('opcoesTurnos');
        
        $titulos = 'style="text-align:center;background-color:#E6E6FF;border: 1px solid #000000;"';
        $conteudos = 'style="border-top: 3px solid #000000; border: 1px solid #000000;"';
?>
<TABLE FRAME=VOID CELLSPACING=0 COLS=5 RULES=NONE BORDER=0 style="tabelalimpa" width="100%">
    <COLGROUP><COL WIDTH=85><COL WIDTH=87><COL WIDTH=108><COL WIDTH=88><COL WIDTH=98></COLGROUP>
    <TBODY>
        <TR>
            <TD STYLE="background-color:#2323DC;border-top: 3px solid #000000; border-bottom: 3px solid #000000; border-left: 3px solid #000000; border-right: 3px solid #000000;text-align:center;" COLSPAN=5 WIDTH=100%><B><FONT COLOR="#FFFFFF">FORMULÁRIO DE EFETIVO</FONT></B></TD>
            </TR>
        <TR>
            <TD <?php echo $titulos; ?> ><B>POSTO</B></TD>
            <TD <?php echo $titulos; ?>><B>QUADRO - ESPECIALIDADE</B></TD>
            <TD <?php echo $titulos; ?> ><B>NM GUERRA</B></TD>
            <TD <?php echo $titulos; ?>COLSPAN=2 ><B>NM COMPLETO</B></TD>
        </TR>
        <TR>
            <TD <?php echo $conteudos; ?> >
            <?php 
            echo $form->input('posto',array('type'=>'select','class'=>'formulario','options'=>$postos, 'label' => false));
            ?>            
            </TD>
            <TD <?php echo $conteudos; ?>><?php 
            echo $form->input('especialidade',array('type'=>'select','class'=>'formulario','options'=>$especialidades, 'label' => false));
            ?>            
</TD>
            <TD <?php echo $conteudos; ?> >            <?php 
            echo $form->input('nm_guerra',array('class'=>'formulario','size'=>'30', 'label' => false));
            ?>     </TD>
            <TD <?php echo $conteudos; ?> COLSPAN=2 >            <?php 
            echo $form->input('nm_completo',array('class'=>'formulario','size'=>'70', 'label' => false));
            ?>     </TD>
        </TR>
        <TR>
            <TD <?php echo $titulos; ?> ><B>SARAM</B></TD>
            <TD <?php echo $titulos; ?> COLSPAN=2 ><B>DATA PRAÇA</B></TD>
            <TD <?php echo $titulos; ?> ><B>UNIDADE</B></TD>
            <TD <?php echo $titulos; ?> ><B>SETOR</B></TD>
        </TR>
        <TR>
            <TD <?php echo $conteudos; ?>><?php 
            echo $form->input('saram',array('class'=>'formulario','size'=>'20', 'label' => false));
            ?></TD>
            <TD <?php echo $conteudos; ?> COLSPAN=2 ><?php 
            echo $datePicker->picker('dt_admissao',array('class'=>'formulario', 'label' => false));
            ?></TD>
            <TD <?php echo $conteudos; ?>><?php
             echo $form->input('unidade_id',array('class'=>'formulario','onchange'=>'javascript:tratamento(\'lista_setores\',\'MilitarUnidadeId\',\'MilitarSetorId\');','options'=>$unidades, 'default'=>0));
                  ?></TD>
            <TD <?php echo $conteudos; ?>><?php 
            echo $form->input('setor',array('class'=>'formulario', 'label' => false));
            ?></TD>
        </TR>
        <TR>
            <TD HEIGHT=16 ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
        </TR>
        <TR>
            <TD HEIGHT=16 ALIGN=LEFT><BR></TD>
            <TD STYLE="background-color:#FFFF99;border: 2px solid #000000; " colspan="3" >
            <table width="100%">
            <tr><td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><b>NOVO</b></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><b>EXCLUIR</b></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><b>LOCALIZAR</b></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><b>SALVAR</b></td></tr>
            <tr>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><?php 
    echo $ajax->link($this->Html->image('novodc.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
            ?></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><?php 
    echo $ajax->link($this->Html->image('lixo.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
            ?></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><?php 
    echo $ajax->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
            ?></td>
            <td style='background-color:#FFFAFA;text-align:center;border-right:2px solid #000000;'><?php 
    echo $ajax->link($this->Html->image('disk.png', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
            ?></td>
            </tr>
            </table>
            <?php 
    echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));
?>
</TD>
            <TD ALIGN=LEFT><BR></TD>
        </TR>
        <TR>
            <TD HEIGHT=16 ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
            <TD ALIGN=LEFT><BR></TD>
        </TR>
</TBODY></TABLE>
<?php 
  //  echo $ajax->link($this->Html->image('network_transmit.png', array('alt'=> __('Exibir', true), 'border'=> '0','float'=> 'right', 'title'=>'Visualizar')), array('action'=>'externoatualiza', null),array('escape'=>false, 'update'=>'formularios', 'create' => "var t=new Dialog({content:'<img alt=\"\" width=\"15\" height=\"15\" src=\"".$this->webroot."img/spinner.gif\"> Aguarde ...',title:'Atualizando tabelas', close:{link:false,overlay:false,esc:false}});t.open();", 'success' => 'Dialogs.close();','method'=>'post', 'with'=>"$('AditivoAddForm').serialize()"), null,false);
    echo $form->hidden('militar_responsavel',array('value'=>$u[0]['Usuario']['militar_id']));
?>
            
            <?php echo $form->end();?>
<div id='formularios'>


</div>
<div id='item01' style="float:center;">
  </div>
       



</div>
<!-- ************************************************************************** -->


<?php
echo $form->create('dados', array('url'=>array('controller'=>'aditivos', 'action'=>'externodownload'), 'type'=>'file', 'inputDefaults' => array('label' => false, 'div' => false)));
?>
 <table width="50%" border="0" align="center"><tr><td>
             
<?php
echo $form->input('ano',array('type'=>'select', 'options'=>array( 10=>'2010', 11=>'2011', 12=>'2012', 13=>'2013'),'class'=>'formulario')); 
echo $form->input('centro',array('type'=>'select', 'options'=>array( "BL"=>'BL',"MU"=>'MU',"PH"=>'PH'),'class'=>'formulario')); 
echo $form->input('tipo',array('type'=>'select', 'options'=>array( "atm"=>'atm',"set"=>'set',"rel1"=>'rel1',"rel2"=>'rel2',"rel3"=>'rel3',"rel4"=>'rel4',"rel5"=>'rel5',"rel6"=>'rel6'),'class'=>'formulario')); 
echo("</td><td>");
echo $form->button('Selecionar arquivos',array('class'=>''));

echo("</td></tr><table>");
echo $form->end(); 

 
function exibeDownload($ano, $centro, $tipo){
    $extensao = $ano.'_'.$centro.'.'.$tipo;
echo '<table width="50%" border="0" align="center">
   <tr><td colspan="3"  style="background-color:#44ffff;"><div align="center"><font size="3" face="Verdana, Arial, Helvetica, sans-serif">Arquivos com extensão '.$extensao.'</font></div></td></tr>
   <tr>
    <td  style="background-color:#669066;"width="60%"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Arquivo</font></strong></div></td>
    <td  style="background-color:#669066;"width="20%"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Data</font></strong></div></td>
    <td  style="background-color:#669066;"width="20%"><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tamanho</font></strong></div></td>
     </tr>
';
   if ($handle=opendir(Configure::read('caminhoestatistica'))) {                           
      $x=0;
      while (false!==($file=readdir($handle))) {
         if ($file!="." && $file!="..") {
             if(strpos($file,$extensao)>0){
                       $matrix[$x]=$file;                     
                       $x++;
             } 
         }
      }
      closedir($handle);
   } 
   $x=0;
   asort($matrix);
   while($matrix[$x]) {
      if($x%2==0) {
         echo '<tr bgcolor="#FFFFCC">';
      }
      else {
         echo '<tr bgcolor="#FFFF99">';
      }
      echo '   
            <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="/sgbdo/webroot/estatisticas/'.$matrix[$x].'">'.$matrix[$x].'</a></font></strong></div></td>
            <td align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">'.date ("d-m-y H:i:s.", filectime(Configure::read('caminhoestatistica').$matrix[$x])).'</font></strong></td>
            <td align="center"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">'.filesize(Configure::read('caminhoestatistica').$matrix[$x]).'</font></strong></td>
         </tr>
      ';
      $x++;
   } 
echo '</table>';
   
}

exibeDownload($this->data['dados']['ano'],$this->data['dados']['centro'], $this->data['dados']['tipo']);
?>
 

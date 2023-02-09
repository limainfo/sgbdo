<?php

//		header('Content-type: application/x-json');
	require('conn.inc');
        $sql= "select * from prosima_eventos";
				
//echo $sql;

$consulta = mysql_query($sql);
$quantidade = mysql_num_rows($consulta);
$saida='<table class="normal"><tr><td colspan="7" style="background-color:#FFFD70;">Quantidade atual:<b>'.$quantidade.'</b>  Especialidade:<b>'.$_POST['espec'].'</b></td></tr><tr><th rowspan="2">NOME</th><th colspan="2">INSTRUTOR</th><th  rowspan="2">COORD.</th><th rowspan="2">COMISS.</th><th rowspan="2">UNIDADE.</th><tr><th>EEAR</th><th>ICEA</th></tr></tr>';

$i=0;
?>


<form onsubmit=" return false;" id="TesteopprovaEditForm" enctype="multipart/form-data" method="post" action="/sgbdo/prosima/conteudo.php" accept-charset="utf-8">     
     <fieldset class="ui-fieldset ui-widget ui-widget-content ui-corner-all">
 
    <legend class="ui-fieldset-legend ui-corner-all ui-state-default">Cadastrar Eventos</legend>
    <div class="ui-fieldset-content">
        <table class="formulario" width="100%">
            <tbody>
                <tr>
                    <td>EVENTO</td>
                    <td><input type="text" class="ui-inputfield ui-widget ui-state-default ui-corner-all" size="40" maxlength="100" name="evento"  id="evento" >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div class="ui-fieldset-content">
        <input type="submit" id="submit1887420868"  onclick="event.returnValue = false; return false;"  name="Registrar" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="Registrar" >
    </div>

</fieldset>
 </form>
<script type="text/javascript">
//<![CDATA[
Event.observe("submit1887420868", 'click', function(event) { 
    new Ajax.Updater('listagem','/sgbdo/testeopprovas/externoeditgrava', {
        asynchronous:true, 
        evalScripts:true, 
        parameters:Form.serialize(Event.element(event).form),
        requestHeaders:['X-Update', 'listagem']}) }
, false);
//]]>
</script>



</div>


        <?php
exit();
?>

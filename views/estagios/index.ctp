    <style>
.botoes {
    background: none repeat scroll 0 0 #909090;
    border: 1px solid #303030;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 180px;
    text-decoration: none;
    position:1000;
}
.botoes:hover, .botoes:focus {
    background: none repeat scroll 0 0 #ffff00;
}        
.bd {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #909090;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 70px;
    text-decoration: none;
}
.bd:hover, .bd:focus {
    background: none repeat scroll 0 0 #ffff00;
}        
.btimagemvermelho {
    background: none repeat scroll 0 0 #600000;
    border: 1px solid #fff;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #fff;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 100px;
    text-decoration: none;
}
.btimagemvermelho:hover, .btimagemvermelho:focus {
    background: none repeat scroll 0 0 #ffff00;
    color: #000;
}        
.btimagemverde {
    background: none repeat scroll 0 0 #006000;
    border: 1px solid #000;
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 2px 1px 0 rgba(0, 0, 0, 0.2);
    color: #000;
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    margin: 0;
    padding: 4px;
    text-transform: uppercase;
    width: 100px;
    text-decoration: none;
}
.btimagemverde:hover, .btimagemverde:focus {
    background: none repeat scroll 0 0 #ffff00;
}        
    </style>
<?php

echo '<div class="input select required"><label for="OrgaoChefeOrgao">Estagiário --> </label><select id="OrgaoChefeOrgao" name="data[Orgao][chefe_orgao]">';
foreach ($chefe as $dados){
	echo '<option value="'.$dados.'">'.$dados.'</option>';

}
echo '</select></div>';

?>
<ul  class="">
    <li><a class="botoes" href="javascript:void(0);"
		onclick="$('fase1').show();$('fase2').hide();$('fase3').hide();$('fase4').hide();" ondblclick="$('fase1').hide();">Fase 1 - Preparatória</a>
    <a class="botoes" href="javascript:void(0);"	onclick="$('fase2').show();$('fase1').hide();$('fase3').hide();$('fase4').hide();" ondblclick="$('fase2').hide();">Fase 2 - 	Conscientização</a>
    <a class="botoes" href="javascript:void(0);"	onclick="$('fase3').show();$('fase2').hide();$('fase1').hide();$('fase4').hide();" ondblclick="$('fase3').hide();">Fase 3 - 	Consolidação</a>
<a class="botoes" href="javascript:void(0);"	onclick="$('fase4').show();$('fase2').hide();$('fase3').hide();$('fase1').hide();" ondblclick="$('fase4').hide();">Fase 4 - 	Finalização</a>
	</li>
        
        <ul id="fase1" style="display:false; float:center; position:static;">
		<li> <?php include ('fase1.php') ?>	</li>
        </ul>
        <ul id="fase2" style="display:false; float:center; position:static;">
		<li> <?php include ('fase2.php') ?>	</li>
	</ul>  
        <ul id="fase3" style="display:false; float:center; position:static;">
		<li> <?php include ('fase3.php') ?>	</li>
	</ul>    
        <ul id="fase4" style="display:false; float:center; position:static;">
		<li> <?php include ('fase4.php') ?>	</li>
	</ul>                
	</ul>
	<li class="qmclear">&nbsp;</li>
</ul>

<script language="javascript">
$('fase1').hide();
$('fase2').hide();
$('fase3').hide();
$('fase4').hide();
</script>

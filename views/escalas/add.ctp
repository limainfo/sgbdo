<?php
include('../views/funcoes_henrique.ctp');

?>
<br>
<div class="escalas form">
    <center>
        <?php

        $anos = array();
        $ano = date('Y') + 1;
        $anoa = date('Y') - 1;
        for ($inicio = $anoa; $inicio <= $ano; $inicio++) {
            $anos[$inicio] = $inicio;
        }

        if (empty($this->data['Escala']['mes'])) {
            $this->data['Escala']['mes'] = date('n');
            $this->data['Escala']['ano'] = date('Y');
        }
//$data['Escala']['mes']}
        echo $form->create('Escala', array('action' => 'geraescala'));
        if (!empty($data['Escala']['mes'])) {
            echo $form->select('mes', $mes, $data['Escala']['mes'], array('onChange' => "", 'class' => 'botoes'), false);
        } else {
            echo $form->select('mes', $mes, $this->data['Escala']['mes'], array('onChange' => "", 'class' => 'botoes'), false);
        }
//echo $u[0]['Usuario']['privilegio_id'];
        echo $form->select('ano', $anos, $this->data['Escala']['ano'], array('onChange' => "", 'class' => 'botoes'), false);
        echo "<input type=\"hidden\" id=\"EscalaMesAtual\" name=\"data[Escala][mesAtual]\" value=\"{$this->data['Escala']['mes']}\">";
        echo "<input type=\"hidden\" id=\"EscalaAnoAtual\" name=\"data[Escala][anoAtual]\" value=\"{$this->data['Escala']['ano']}\">";
        echo "<input type=\"submit\" value=\"Consultar mês e ano selecionados\" class=\"botoes\" onmousedown=\"$('EscalaGeraescalaForm').action='{$this->webroot}escalas/add';\" />";

        echo $form->end();
        ?>
    </center>
        <?php
        Menu_Barra('grupo15', 'relatorio15', 'CADASTRAR ESCALA', 0);
        echo $form->create('Escala', array('onsubmit' => 'return false;', 'inputDefaults' => array('div' => true)));
        ?>
    <table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio15" style="align:center;" width="100%" >
        <tbody>
            <tr><td width="100%">
<?php
echo $ajax->div('ocultos', array('style' => 'display:true;visible:false;'));
?> <input type="text" size="1" id="turno_del" name="turno_del_id"
                           value="0"> <input type="text" size="1" id="militars_del"
                    name="militars_del_id" value="0"> <script type="text/javascript">
                        function clickElement(elementid)
                        {
                            var e = document.getElementById(elementid);
                            if (typeof e == 'object')
                            {
                                //alert( "type object" );
                                if(document.createEventObject)
                                {
                                    //alert('createEventObject');
                                    e.fireEvent('onclick');
                                    return false;
                                }
                                else if(document.createEvent)
                                {
                                    //alert('createEvent');
                                    var evObj = document.createEvent('MouseEvents');
                                    evObj.initEvent('click',true,true);
                                    e.dispatchEvent(evObj);
                                    return false;
                                }else
                                {
                                    //alert('click');
                                    e.click();
                                    return false;
                                }
                            }
                            //else
                            //alert( "not type object" );
                        }</script> <?php
                    echo $ajax->divEnd('ocultos');
                    /*
                      echo '<pre>';
                      print_r($data);
                      echo '</pre>';
                     */

                    if (!empty($this->params['pass'][0])) {
                        $edit = true;
                    } else {
                        $edit = false;
                    }



                    if ($edit) {
                        echo $form->input('id', array('value' => $this->params['pass'][0]));
                        echo "<div class='input text required'><label>Ano</label><input type=\"text\" size=\"4\" name=\"data[Escala][ano]\" readonly	value=\"{$data['Escala']['ano']}\" class=\"formulario\"></div>";
                        echo "<div class='input text required'><label>Mês</label><input type=\"text\" size=\"4\" name=\"data[Escala][mes]\" readonly	value=\"{$data['Escala']['mes']}\" class=\"formulario\"></div>";
                        echo '<div class="input select"><label>Status</label><select id="EscalaAtiva" onchange="ativa();" name="data[Escala][ativa]" class="formulario">';
                        echo '<option value="1" >ATIVA</option>';
                        echo '<option value="0" >DESATIVADA</option>';
                        if ($data['Escala']['ativa'] == 1) {
                            echo '<option value="' . $data['Escala']['ativa'] . '" selected >ATIVA</option>';
                        } else {
                            echo '<option value="' . $data['Escala']['ativa'] . '" selected>DESATIVADA</option>';
                        }
                        echo '</select></div>';

                        $jscript = <<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function ativa() {
var id = $('EscalaId').value;
var status = $('EscalaAtiva').value;
new Ajax.Request('{$this->webroot}escalas/edit/'+id+'/'+status, {
method: 'get',
onSuccess: function(transport) {

var resultado = transport.responseText.evalJSON(true);

if (resultado.ok==0){
alert('Registro não atualizado!');
}else{
alert('Registro atualizado!');
location.reload(true);

}
}
})


return false;
}

//]]>

</script>
SCRIPT;
                        echo $jscript;
                    } else {
                        echo "<div class='input text required'><label>Ano</label><input type=\"text\" size=\"4\" name=\"data[Escala][ano]\" readonly	value=\"{$this->data['Escala']['ano']}\" class=\"formulario\"></div>";
                        echo "<div class='input text required'><label>Mês</label><input type=\"text\" size=\"4\" name=\"data[Escala][mes]\" readonly	value=\"{$this->data['Escala']['mes']}\" class=\"formulario\"></div>";


                        echo '<div class="input select"><label>Status</label><select id="EscalaAtiva" name="data[Escala][ativa]" class="formulario">';
                        echo '<option value="1" >ATIVA</option>';
                        echo '<option value="0" >DESATIVADA</option>';
                        echo '</select></div>';
                    }

                    if ($edit) {
                        echo '<div class="input select"><label>Tipo</label><select id="EscalaTipo"  name="data[Escala][tipo]" class="formulario">';
                        echo '<option value="OPERACIONAL" >OPERACIONAL</option>';
                        echo '<option value="RISAER" >RISAER</option>';
                        echo '<option value="TECNICA" >TECNICA</option>';
                        echo '<option value="' . $data['Escala']['tipo'] . '" selected>' . $data['Escala']['tipo'] . '</option>';
                        echo '</select></div>';
                    } else {
                        echo '<div class="input select"><label>Tipo</label><select id="EscalaTipo" name="data[Escala][tipo]" class="formulario">';
                        echo '<option value="OPERACIONAL" >OPERACIONAL</option>';
                        echo '<option value="RISAER" >RISAER</option>';
                        echo '<option value="TECNICA" >TECNICA</option>';
                        echo '</select></div>';
                    }
                    echo '<div class="input select"><label for="EscalaSetorId">Setor</label><select id="EscalaSetorId" name="data[Escala][setor_id]" class="formulario">';

                    foreach ($setors as $dados) {
                        if ($edit && ($data['Setor']['id'] == $dados['Setor']['id'])) {
                            echo '<option value="' . $dados['Setor']['id'] . '" selected>' . $dados[0]['setor'] . '</option>';
                        } else {
                            echo '<option value="' . $dados['Setor']['id'] . '" >' . $dados[0]['setor'] . '</option>';
                        }
                    }
                    echo '</select></div>';


                    echo '<div class="input select required"><label for="EscalaNmEscalante">Nome Escalante</label><select id="EscalaNmEscalante" name="data[Escala][nm_escalante]" class="formulario">';
                    echo '<option value="" selected></option>';
                    $sinalizador = 0;
                    foreach ($chefeID as $dados) {
                        if ($edit && ($data['Escala']['nm_escalante'] == $dados)) {
                            $sinalizador = 1;
                            echo '<option value="' . $dados . '" selected>' . $dados . '</option>';
                        } else {
                            echo '<option value="' . $dados . '">' . $dados . '</option>';
                        }
                    }
                    if ($edit && (!$sinalizador)) {
                        echo '<option value="' . $data['Escala']['nm_escalante'] . '" selected>' . $data['Escala']['nm_escalante'] . '</option>';
                    }
                    echo '</select></div>';

                    echo '<div class="input select required"><label for="EscalaNmChefeOrgao">Nome Chefe Órgão</label><select id="EscalaNmChefeOrgao" name="data[Escala][nm_chefe_orgao]" class="formulario">';
                    echo '<option value="" selected></option>';
                    $sinalizador = 0;
                    foreach ($chefe as $dados) {
                        if ($edit && ($data['Escala']['nm_chefe_orgao'] == $dados)) {
                            $sinalizador = 1;
                            echo '<option value="' . $dados . '" selected>' . $dados . '</option>';
                        } else {
                            echo '<option value="' . $dados . '">' . $dados . '</option>';
                        }
                    }
                    if ($edit && (!$sinalizador)) {
                        echo '<option value="' . $data['Escala']['nm_chefe_orgao'] . '" selected>' . $data['Escala']['nm_chefe_orgao'] . '</option>';
                    }
                    echo '</select></div>';



/*
                    if ($edit) {
                        $select1 = '<select id="EscalaNmComandanteComplete" name="EscalaNmComandanteComplete" class="formulario" onchange="$(\'EscalaNmComandante\').value = this.options[this.options.selectedIndex].value;">';
                        $select1 .= '<option value="ONILDO IVAN DE FREITAS MAJ QOEMET">ONILDO IVAN DE FREITAS MAJ QOEMET </option>';
                        $select1 .= '<option value="MARCUS VINICIUS RIBEIRO VIANA Ten Cel AV.">MARCUS VINICIUS RIBEIRO VIANA Ten Cel AV.</option>';
                        $select1 .= '<option value="DALMO JOSE BRAGA PAIM TCEL QOENG.">DALMO JOSE BRAGA PAIM TCEL QOENG.</option>';
                        $select1 .= '<option value="' . $data['Escala']['nm_comandante'] . '" selected>' . $data['Escala']['nm_comandante'] . '</option>';
                        $select1 .= '<option value="" selected="selected"></option></select>';
                    } else {
                        $select1 = '<select id="EscalaNmComandanteComplete" name="EscalaNmComandanteComplete" class="formulario" onchange="$(\'EscalaNmComandante\').value = $(\'EscalaNmComandanteComplete\').options[$(\'EscalaNmComandanteComplete\').options.selectedIndex].value;">';
                        $select1 .= '<option value="ONILDO IVAN DE FREITAS MAJ QOEMET">ONILDO IVAN DE FREITAS MAJ QOEMET </option>';
                        $select1 .= '<option value="MARCUS VINICIUS RIBEIRO VIANA Ten Cel AV.">MARCUS VINICIUS RIBEIRO VIANA Ten Cel AV.</option>';
                        $select1 .= '<option value="DALMO JOSE BRAGA PAIM TCEL QOENG.">DALMO JOSE BRAGA PAIM TCEL QOENG.</option>';
                        $select1 .= '<option value="" selected="selected"></option></select>';
                    }
*/
                    echo $form->input('nm_comandante', array('value' => $data['Escala']['nm_comandante'], 'class' => 'formulario', 'size' => 40, 'label' => 'Chf da Escala', 'inputDefaults' => array('div' => false))) ;
//. '&nbsp;&nbsp;' . $select1 

                    if ($edit) {
                        echo $form->hidden('efetivo_total', array('value' => $data['Escala']['efetivo_total'], 'class' => 'formulario'));
                    } else {
                        echo $form->hidden('efetivo_total', array('value' => 10, 'size' => 2, 'class' => 'formulario'));
                    }

                    for ($i = 1; $i <= 28; $i++) {
                        $qtds["$i"] = $i;
                    }

                    if ($edit) {
                        echo $form->input('dt_limite_cumprida', array('type' => 'select', 'options' => array('empty' => '', $qtds), 'selected' => $data['Escala']['dt_limite_cumprida'], 'class' => 'formulario'));
                        echo $form->input('dt_limite_previsao', array('type' => 'select', 'options' => array('empty' => '', $qtds), 'selected' => $data['Escala']['dt_limite_previsao'], 'class' => 'formulario'));
                        echo $form->hidden('created');
                    } else {
                        echo $form->input('dt_limite_cumprida', array('type' => 'select', 'options' => array($qtds), 'selected' => 10, 'class' => 'formulario'));
                        echo $form->input('dt_limite_previsao', array('type' => 'select', 'options' => array($qtds), 'selected' => 26, 'class' => 'formulario'));
                        $datacriacao = date('Y-m-d h:i:s');
                        echo $form->hidden('created', array('value' => $datacriacao));
                    }

                    $horas = '';
                    for ($i = 0; $i <= 23; $i++) {
                        if ($i > 9) {
                            $horas.='<option value="' . $i . '">' . $i . '</option>';
                        } else {
                            $horas.='<option value="' . $i . '">' . '0' . $i . '</option>';
                        }
                    }
                    $minutos = '';
                    for ($i = 0; $i <= 59; $i++) {
                        if ($i > 9) {
                            $minutos.='<option value="' . $i . '">' . $i . '</option>';
                        } else {
                            $minutos.='<option value="' . $i . '">' . '0' . $i . '</option>';
                        }
                    }



                    //echo '<div class="input time">';
                    echo '<hr><div class="input select required"><label for="EscalaQtdTurnos">Início do Turno</label><select id="turnoHoraI" name="turnoHorasI" class="formulario" onchange="$(\'turnoHoraF\').options.selectedIndex = $(\'turnoHoraI\').options.selectedIndex;">
<option selected="selected" value=""></option>
' . $horas . '
</select>:<select id="turnoMinutoI" name="turnoMinutosI" class="formulario" onchange="$(\'turnoMinutoF\').options.selectedIndex = $(\'turnoMinutoI\').options.selectedIndex;">
<option selected="selected" value=""></option>
' . $minutos . '
</select></div>';
//		echo '  Término->';
                    echo '<div class="input select required"><label for="EscalaQtdTurnos">Fim do Turno</label><select id="turnoHoraF" name="turnoHorasF" class="formulario">
<option selected="selected" value=""></option>
' . $horas . '
</select>:<select id="turnoMinutoF" name="turnoMinutosF" class="formulario">
<option selected="selected" value=""></option>
' . $minutos . '
</select></div><div class="input text required"><label>Militares por Turno</label><input type="text" size="3" id="turnoQtd" name="turnoQtds" class="formulario"><input type="hidden" value="0" id="total" name="total" size="3" readonly class="formulario" >';
                    //echo $this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar','onmousedown'=>$script));
                    echo "<input type=\"image\" id='imgturno' border=1 src=\"{$this->webroot}webroot/img/novo.gif\"  title=\"Cadastrar\"/>";
                    echo '</div>';

                    $script = <<<HARD
		<script>
		function cadastraTurnos(){
		var horas=new Array();
		var minutos=new Array();
		var quantidade=new Array();
		var form=$('EscalaAddForm');
		var h =form.getInputs('select','data[Escala][turno_inicio][hour][]');
		var m =form.getInputs('select','data[Escala][turno_inicio][min][]');
		var q =form.getInputs('text','data[Escala][turno_qtd][]');

		h.each(function(x){horas.push(Number(x.options[x.options.selectedIndex].value));});
		m.each(function(y){minutos.push(Number(y.options[y.options.selectedIndex].value));});

		$('total').value=0;
		q.each(function(z){quantidade.push(Number(z.value));$('total').value=Number($('total').value)+Number(z.value);});

		var v1=$('turnoHoraI').options[$('turnoHoraI').options.selectedIndex].value;
		var v2=$('turnoMinutoI').options[$('turnoMinutoI').options.selectedIndex].value;
		var v3=Number($('turnoQtd').value);
		var v1F=$('turnoHoraF').options[$('turnoHoraF').options.selectedIndex].value;
		var v2F=$('turnoMinutoF').options[$('turnoMinutoF').options.selectedIndex].value;

		var d= new Date();
		var id=d.getTime();



		var c1=0;
		if ((horas.indexOf(Number(v1))==-1)&&(v1!='')){c1=0;}else{c1=1;}
		var c2=0;
		if ((minutos.indexOf(Number(v2))==-1)&&(v2!='')){c2=0;}else{c2=1;}
		var c3=0;
		if (Object.isNumber(v3)){if ((v3>0)){c3=0;}else{c3=1;}}else{c3=1;}

		if ((c1==0)&&(c2==0)&&(c3==0)){
		$('total').value=Number($('total').value)+Number(v3);
		$('contaTurnos').value++;

		var campo1 = 'Início:\&nbsp;<input type=\'text\' size=\'9\' name=\'data[Escala][turno_inicio][]\' readonly value=\''+v1+'\:'+v2+':00\'  class=\'formulario\'>';
		var campo2 = '\&nbsp;\&nbsp;Término:\&nbsp;<input type=\'text\' size=\'9\' name=\'data[Escala][turno_termino][]\' readonly value=\''+v1F+'\:'+v2F+':00\'  class=\'formulario\'>';
		var campo3 = '\&nbsp;\&nbsp;qtd\&nbsp;<input type=\'text\' id=\'qtd'+id+'\' size=\'3\' name=\'data[Escala][turno_qtd][]\' 	onkeyup=\'if(isNaN(Number(this.value))){this.value=Number(1);}else{if(Number(this.value)==0){this.value= Number(1);}else{this.value= Number(this.value);}}\' value=\''+v3+'\'  class=\'formulario\'>';
		var campo4 = '\&nbsp;\&nbsp;Rótulo:\&nbsp;<input type=\'text\' id=\'trotulo'+id+'\' size=\'20\' name=\'data[Escala][turno_rotulo][]\'  value=\''+$('contaTurnos').value+'º Turno\'  class=\'formulario\'>';
	    var campo4 = campo4 + '	<input type="hidden"  name="data[Escala][turno_id][]" value="0">';
		$('turnos_teste').innerHTML = $('turnos_teste').innerHTML + '<div id=\'turno'+id+'\'  style=\'padding:0px;margin:0px;\'><pre>'+campo1+campo2+'&nbsp;&nbsp;'+campo3+campo4+'</pre></div>';

		$('trotulo'+id).insert({ after: "\&nbsp;\&nbsp;\&nbsp;<a onClick=\"$('contaTurnos').value--;$('turno"+id+"').remove();\"><span><img border='0' alt='Excluir' src='{$this->webroot}img/lixo.gif' /></span></a>" });
		
		$('turnoQtd').value='';
		
		$('turnoHoraI').options.selectedIndex = $('turnoHoraF').options.selectedIndex;
		$('turnoMinutoI').options.selectedIndex = $('turnoMinutoF').options.selectedIndex;
		
if ($('turnoHoraF').options.selectedIndex>21){ $('turnoHoraF').options.selectedIndex=1;}else{ $('turnoHoraF').options.selectedIndex+=2;}
}else{
alert('Observe atentamente se não há repetição de hora e a quantidade seja um valor numérico !!');
}
}

$('imgturno').observe('mousedown', function(event){		
cadastraTurnos();
});
$('imgturno').observe('keydown', function(event){		
cadastraTurnos();
});
</script>

HARD;
                    echo $script;
                    /*
                      for ($i=1;$i<=10;$i++){
                      echo $ajax->link('['.$i.']',array('action'=>'ajax/'.$i),array('update'=>'turnos_teste','loading'=>'Effect.BlindDown(\'turnos_teste\');'));
                      }
                     */
                    echo '<hr>';
                    echo $ajax->div('turnos_teste', array('style' => 'padding:0px;margin:0px;line-height:0px;text-align:center;'));
                    if ($edit) {
                        $contturnos = 0;
                        foreach ($turnos as $turno) {
                            $contturnos++;
        ?>
                            <div id="editturno<?php echo $turno['Turno']['id'] ?>" style="padding:0px;margin:0px;"><pre>Início:&nbsp;<input type="text" size="9"	name="data[Escala][turno_inicio][]"	value="<?php echo $turno['Turno']['hora_inicio'] ?>" class="formulario">&nbsp;&nbsp;Término:&nbsp;<input type="text" size="9"	name="data[Escala][turno_termino][]"	value="<?php echo $turno['Turno']['hora_termino'] ?>" class="formulario">&nbsp;&nbsp;qtd&nbsp;<input type="text" size="3"	name="data[Escala][turno_qtd][]"	id="qtd<?php echo $turno['Turno']['id'] ?>"	value="<?php echo $turno['Turno']['qtd'] ?>" class="formulario" 	onkeyup='if(isNaN(Number(this.value))){this.value=Number(1);}else{if(Number(this.value)==0){this.value= Number(1);}else{this.value= Number(this.value);}}'>&nbsp;&nbsp;Rótulo:&nbsp;<input
type="text" size="20" name="data[Escala][turno_rotulo][]"	value="<?php echo $turno['Turno']['rotulo'] ?>" class="formulario">	<input type="hidden" name="data[Escala][turno_id][]" id="id<?php echo $turno['Turno']['id'] ?>" value="<?php echo $turno['Turno']['id'] ?>">&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('lixo.gif', array('alt' => __('Excluir', true), 'border' => '0', 'title' => 'Excluir')), '#', array('onclick' => '$(\'turno_del\').value=\'' . $turno['Turno']['id'] . '\';if(confirm(\'Tem certeza que deseja excluir #' . $turno['Turno']['hora_inicio'] . '\')){clickElement(\'turno_del\');return false;}else{return false;}', 'escape' => false), false, false); ?><a	onclick="$('contaMilitares').value--;$('teste'+id).remove();"></a></pre></div>
                            <?php
                        }
                    }
                    echo $ajax->divEnd('turnos_teste');
                    //echo '<hr>';
                    echo $form->hidden('totMilitares', array('value' => '0'));

                    echo $ajax->div('opcoesTurnos');

                    if ($edit) {
                        echo "<input type=\"hidden\" id=\"contaTurnos\" name=\"data[Escala][contaTurnos]\" value=\"$contturnos\">";
                    } else {

                        echo "<input type=\"hidden\" id=\"contaTurnos\" name=\"data[Escala][contaTurnos]\" value=\"0\">";
                    }
                    echo $ajax->divEnd('opcoesTurnos');

                    //$script="\$('EscalaTotMilitares').value = Number(\$('EscalaTotMilitares').value)+1;\$('militares').innerHTML = \$('militares').innerHTML + '<div class=\"input select required\"><label for=\"EscalaMilitarId'+\$('EscalaTotMilitares').value+'\">'+\$('EscalaTotMilitares').value+'-> </label><select id=\"EscalaMilitarId'+\$('EscalaTotMilitares').value+'\" name=\"data[Escala][militarid'+\$('EscalaTotMilitares').value+']\">'+\$('opcoes').innerHTML+'</select></div>';";
                    //$script="\$('EscalaTotMilitares').value = Number(\$('EscalaTotMilitares').value)+1;\$('militares').innerHTML = \$('militares').innerHTML +'<label for=\"EscalaMilitarId'+\$('EscalaTotMilitares').value+'\">'+\$('EscalaTotMilitares').value+'-> </label>'+ \$('opcoes').innerHTML+'<br>';";
/*
                    echo '<hr><div class="input select required"><label for="EscalaSelectMilitares">Selecione o Militar</label>';

                    echo '<label for="Consultanomes">Nome</label><input class="formulario" type="text" name="nome" id="nomeparaconsulta"><input type="submit" value="Buscar" name="btnConsultaNome" onclick="consultanome();" class="botoes">';
                    echo '<select id="EscalaSelectMilitares"  class="formulario">';
                    foreach ($militaresid as $dados) {
                        echo '<option value="' . $dados['Militar']['id'] . '">' . $dados[0]['nome'] . '</option>';
                    }
                    echo '</select></div><div class="input select required"><label for="EscalaSelectMilitares">Informe a Legenda</label><input id="indicativo" type="text" size="3" name="legenda" onkeyup="$(\'indicativo\').value=$(\'indicativo\').value.toUpperCase();" class="formulario">&nbsp;&nbsp;&nbsp;';
                    //echo $this->Html->image('novo.gif', array('alt'=> __('Cadastrar', true), 'border'=> '0', 'title'=>'Cadastrar','onmousedown'=>$script));
                    echo "<input type=\"image\" id='img' border=1 src=\"{$this->webroot}webroot/img/novo.gif\"  title=\"Cadastrar\"/>";
                    echo '</div>';

                    $raiz = $this->webroot;
*/
                    $observaPosto = <<<SCRIPT
<script type="text/javascript">
//<![CDATA[


function consultanome() {
	/*
	usa método request() da classe Form da prototype, que serializa os campos
	do formulário e submete (por POST como default) para a action especificada no form
	*/
    	
	var dados = Form.serialize($('EscalaAddForm'));
	new Ajax.Request('{$this->webroot}escalas/externoconsultanomes', {
			method: 'post',
			postBody: dados,
			onSuccess: function(transport) {
			var resultado = transport.responseText;
			    	$('EscalaSelectMilitares').innerHTML = unescape(resultado);
			}
				})
        
    
    return false;
}

function tratamento(campoformulario, campomodificado){
var idP = $('EscalaPosto').value;
var idS = $('EscalaSetorId').value;
new Ajax.Updater(campomodificado,'{$raiz}escalas/externoposto/'+idS+'/'+idP, {asynchronous:true, evalScripts:true, parameters:Form.Element.serialize(campoformulario), requestHeaders:['X-Update', campomodificado]})
}

//new Form.Element.EventObserver('EscalaPosto', function(element, value){tratamento('EscalaPosto','EscalaSelectMilitares');})
//]]>
</script>
SCRIPT;
                    echo $observaPosto;


                    $script = <<<HARD
    <script>
    function cadastraMilitares(){
    var militares=new Array();
    var legendasp=new Array();
    var legendasc=new Array();

    var form=$('EscalaAddForm');
    var m =form.getInputs('hidden','data[Escala][militares_id][]');
    var lp =form.getInputs('text','data[Escala][legendasp][]');
    var lc =form.getInputs('text','data[Escala][legendasc][]');



    m.each(function(x){militares.push(Number(x.value));});
    lp.each(function(y){legendasp.push(y.value);});
    lc.each(function(y){legendasc.push(y.value);});

    var id=$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].value;
    var nome=$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].text;


    var contap = legendasp.size();
    var contac = legendasc.size();
    var contam = militares.size();

    if(contap==0){contap=-1;}
    if(contac==0){contac=-1;}
    if(contam==0){contam=-1;}

    legendasp = legendasp.compact();
    legendasp = legendasp.uniq();

    legendasc = legendasc.compact();
    legendasc = legendasc.uniq();

    militares = militares.compact();
    militares = militares.uniq();

    var c1=0;

    var mid = 0;

    if($('militarId'+id)!=null){
    mid = Number($('militarId'+id).value);
    }

    if (militares.indexOf(mid)==-1){c1=0;}else{c1=1;}

    var c2=0;
    var ind=$('indicativo').value;
    if (legendasp.indexOf(ind)==-1){c2=0;}else{c2=1;}

    var c3=0;
    if (legendasc.indexOf(ind)==-1){c3=0;}else{c3=1;}

    //alert('c1='+c1+' c2='+c2+' ind='+ind+' mid='+mid);
    //&&(contap==legendasp.size())&&(contac==legendasc.size())&&(contam==militares.size())

    if (($('indicativo').value!='')&&(c1==0)&&(c2==0)&&(c3==0)){
    $('contaMilitares').value++;
    var campo1 = '<input type=\'text\' size=\'40\' name=\'data[Escala][militares][]\' readonly value=\''+nome+'\' class=\'formulario\'>';


    var campo2 = '<input type=\'text\' size=\'3\' name=\'data[Escala][legendasp][]\'  value=\''+$('indicativo').value+'\' class=\'formulario\' id=\'p'+id+'\'  onkeyup=\'this.value=this.value.toUpperCase();\'  onchange="$(\'c'+id+'\').value = $(\'p'+id+'\').value" >';
    var campo21 = '<input type=\'text\' size=\'3\' name=\'data[Escala][legendasc][]\'  value=\''+$('indicativo').value+'\' class=\'formulario\'  id=\'c'+id+'\'   onkeyup=\'this.value=this.value.toUpperCase();\' >';
    var campo3 = 'Prev:'+campo2+'\&nbsp;<input type=\'checkbox\' id=\'chkp'+id+'\' size=\'3\' name=\'data[Escala][prevista][]\'   class=\'formulario\'  onclick="if(this.checked){\$(\'legendap'+id+'\').value=1;\$(\'p'+id+'\').readOnly=false;}else{\$(\'legendap'+id+'\').value=0;\$(\'p'+id+'\').readOnly=true;}" checked><input type=\'hidden\' id=\'legendap'+id+'\'  name=\'data[Escala][legendap][]\'  value=\'1\'>';
    var campo4 = 'Cump:'+campo21+'\&nbsp;<input type=\'checkbox\' id=\'chkc'+id+'\' size=\'3\' name=\'data[Escala][cumprida][]\'   class=\'formulario\'   onclick="if(this.checked){\$(\'legendac'+id+'\').value=1;\$(\'c'+id+'\').readOnly=false;}else{\$(\'legendac'+id+'\').value=0;\$(\'c'+id+'\').readOnly=true;}"  checked><input type=\'hidden\' id=\'legendac'+id+'\'  name=\'data[Escala][legendac][]\'  value=\'1\'>';
    var campo4 = campo4+'IgnAfast:&nbsp;<select id=\'chki'+id+'\'  name=\'data[Escala][ignoraafastamento][]\'   class=\'formulario\'><option value=\'N\' selected>N</option><option value=\'S\'>S</option></select>';
    var campo5 = '<input type=\'hidden\' id=\'militarId'+id+'\' size=\'6\' name=\'data[Escala][militares_id][]\'  value=\''+id+'\' class=\'formulario\' readonly>';
    var campo5 = campo5 + '<input type="hidden" name="data[Escala][militarsescala_id][]" value="0">';


    $('militares').innerHTML = $('militares').innerHTML + '<div id=\'teste'+id+'\' style=\'margin:0px;padding:0px;\'><pre><b>MILITAR:</b>'+campo1+campo3+campo4+campo5+'</pre></div>';;

    $('militarId'+id).insert({ after: "\&nbsp;\&nbsp;\&nbsp;<a  onClick=\"$('contaMilitares').value--;$('teste"+id+"').remove();\"><span><img border='0' alt='Excluir' src='{$this->webroot}img/lixo.gif' /></span></a>" });

    $('indicativo').value='';
}else{
alert('Observe atentamente se não há repetição de militare(s) e/ou legenda(s) !!');
}


}	
//$('img').observe('mousedown', function(event){	cadastraMilitares();});
//$('img').observe('keydown', function(event){		cadastraMilitares();});
</script>
HARD;
                    echo $script;
                    //echo $ajax->link('Cadastrar Militares',array('action'=>'ajaxMilitares/\'+$(\'EscalaTotMilitares\').value +\'/\'+$(\'EscalaSetorId\').options[$(\'EscalaSetorId\').options.selectedIndex].value+\''),array('update'=>'militares','loading'=>'Effect.BlindDown(\'militares\');'));

                    echo '<hr>';
                    echo "<a href='{$this->webroot}escalas/add/{$id}'><b>[Ordem de legenda]</b></a>&nbsp;&nbsp;&nbsp;<a href='{$this->webroot}escalas/add/{$id}/nome'><b>[Ordem de nome]</b></a>&nbsp;&nbsp;&nbsp;";
 echo $this->Html->link('<b>[Excluir legendas]</b>', '#', array('onclick' => 'if(confirm(\'Tem certeza que deseja excluir TODAS as legendas desta escala?\')){this.href=\''.$this->webroot.'escalas/add/'.$id.'/limpalegendas\';}else{return false;}', 'escape' => false), false, false).'<br>'."\n";                     
                    echo $ajax->div('militares', array('style' => 'padding:0px;margin:0px;line-height:0px;text-align:center;'));
                    if ($edit) {
                        $contmilitares = 0;
                        $fundo = 1;
                        foreach ($milescalas as $militars_escala) {
                            $contmilitares++;
                            $previstaatual =  '<b>'.$militars_escala['MilitarsEscala']['legenda_prevista'].'</b>';
                            $cumpridaatual =  '<b>'.$militars_escala['MilitarsEscala']['legenda_cumprida'].'</b>';
                            $zebrado = 'background:rgb(255,255,255) none repeat scroll;height:15px;padding:4px;';
                            ?>
    <?php if (!$militars_escala['MilitarsEscala']['prevista']) {$previstaatual='_';} ?>                        
    <?php if (!$militars_escala['MilitarsEscala']['cumprida']) {$cumpridaatual='_';} ?>                        
<?php if($fundo%2==0){$zebrado = 'background:rgb(246,246,246) none repeat scroll;height:15px;padding:4px;';} $fundo++; ?>
<div id="teste<?php echo $militars_escala['MilitarsEscala']['id']; ?>" style="margin:0px;padding:0px;text-align: left;<?php echo $zebrado; ?>"><pre><b><?php echo str_pad($militars_escala[0]['nome'],60,'-'); ?></b>&nbsp;&nbsp;&nbsp;&nbsp;PREV-><?php echo $previstaatual; ?>&nbsp;&nbsp;&nbsp;&nbsp;CUMP-><?php echo $cumpridaatual; ?>&nbsp;&nbsp;<input type="hidden" size="40" name="data[Escala][edicao][]"	value="<?php echo $militars_escala['Militar']['id']; ?>"><input	type='hidden'	id='militarId<?php echo $militars_escala['Militar']['id']; ?>' size='6'	name='data[Escala][militares_id][]'	value='<?php echo $militars_escala['Militar']['id']; ?>'
class='formulario' readonly><input type="hidden" name="data[Escala][militarsescala_id][]" value="<?php echo $militars_escala['MilitarsEscala']['id'] ?>">	</pre></div>
                            <?php
                            //echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array('controller'=> 'turnos', 'action'=>'delete', $turno['id']), array('escape'=>false), sprintf(__('Tem certeza que deseja excluir # %s?', true), $turno['id']),false);
                        }
                    }
                    if ($edit) {
                        echo "<input type=\"hidden\" id=\"contaMilitares\" name=\"data[Escala][contaMilitares]\" value=\"$contmilitares\">";
                    } else {
                        echo "<input type=\"hidden\" id=\"contaMilitares\" name=\"data[Escala][contaMilitares]\" value=\"0\">";
                    }

                    //echo '<div id="teste"><input type="text" size="40" name="data[Escala][militares][]" readonly><input type="text" size="6" name="data[Escala][legendas][]" readonly><a onclick="" href="#">&nbsp;&nbsp;&nbsp;<img border="0" alt="Excluir" src="../img/lixo.gif"/></a><br></div>';
                    //echo 'Teste';
                    echo $ajax->divEnd('militares');

                    echo $ajax->div('opcoes');

                    echo $ajax->divEnd('opcoes');
                    //print_r($militaresid);
                    //echo $form->input('Militar');
                    //echo '<script language="javascript">$(\'contaTurnos\').value=Number($(\'contaTurnos\').value)+Number(0);$(\'total\').value=0;$(\'contaMilitares\').value=Number($(\'contaMilitares\').value)+Number(0);</script>';
                    $jscript = <<<SCRIPT
		<script type="text/javascript">
		$('opcoes').hide();
		$('ocultos').hide();
		var nometurno='editturno'+$('turno_del').value;
		var nomemilitars='edit_milescala'+$('militars_del').value;
		//<![CDATA[
		//if($('opcoes').innerHTML=='1'){ $(nometurno).value).remove; }else{ alert('O Turno não foi excluído!'); }
		Event.observe('turno_del', 'click', function(event) { new Ajax.Updater('opcoes','{$this->webroot}escalas/ajaxdelete' +'/'+$('turno_del').value+'', {asynchronous:true, evalScripts:true, onLoading:function(request) {}, onComplete:function(request) {var nometurno='editturno'+$('turno_del').value;var x=$('opcoes').innerHTML; if(x.search('1')!=-1)$(nometurno).remove();}, requestHeaders:['X-Update', 'militares']}); }, false);
		Event.observe('militars_del', 'click', function(event) { new Ajax.Updater('opcoes','{$this->webroot}escalas/ajaxdelmil' +'/'+$('militars_del').value+'', {asynchronous:true, evalScripts:true, onLoading:function(request) {}, 
		onSuccess:function(request) {
			var nomemilitars='teste'+$('militars_del').value;
			var resultado = request.responseText.evalJSON(true);
			
			 if (resultado.ok==0){
				alert('Registro não removido!');
			}else{
			$('contaMilitares').value--;
			$(nomemilitars).remove();
			}
		}, requestHeaders:['X-Update', 'militares']}); }, false);
//Event.observe('turno_del', 'click', function(event) {alert('teste'); },false);
//]]>
</script>
SCRIPT;

                    echo $jscript;

                    $script = <<<HARD

var v1=Number($('EscalaDtLimiteCumprida').options[$('EscalaDtLimiteCumprida').options.selectedIndex].value);
var v2=Number($('EscalaDtLimitePrevisao').options[$('EscalaDtLimitePrevisao').options.selectedIndex].value);


var form=$('EscalaAddForm');


var cadastro = 1;

    var legendasp =form.getInputs('text','data[Escala][legendasp][]');
    var legendasc =form.getInputs('text','data[Escala][legendasc][]');
    var turno_rotulo =form.getInputs('text','data[Escala][turno_rotulo][]');

    var legp = new Array();
    var legc = new Array();
    var rot = new Array();

    legendasp.each(function(x){if((x.value).blank()){legp.push(null);}else{legp.push(x.value);}});
    legendasc.each(function(x){if((x.value).blank()){legc.push(null);}else{legc.push(x.value);}});
    turno_rotulo.each(function(x){if((x.value).blank()){rot.push(null);}else{rot.push(x.value);}});

    var contap = legp.size();
    var contac = legc.size();
    var contar = rot.size();

    if(contap==0){contap=-1;}
    if(contac==0){contac=-1;}
    if(contar==0){contar=-1;}

    legp = legp.compact();
    legp = legp.uniq();

    legc = legc.compact();
    legc = legc.uniq();

    rot = rot.compact();
    //rot = rot.uniq();

//	alert('contap='+contap+' legp.size='+legp.size()+' contac='+contac+' legc.size='+legc.size()+' contar='+contar+' rot.size='+rot.size());
//	$('EscalaAddForm').submit();

//if ((contap==legp.size())&&(contac==legc.size())&&(contar==rot.size())){
if ((contar==rot.size())){
	$('EscalaAddForm').submit();
}else{

	alert('Não esqueça de cadastrar turnos !!');
	return false;
}


HARD;



//echo $jscript;
                    ?></fieldset>
                    <!-- 
                    <script type="text/javascript">
                    $('militares').innerHTML = $('militares').innerHTML + '<div id=\"teste'+$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].value+'\"><input type=\"text\" size=\"40\" name=\"data[Escala][militares][]\" readonly value=\"'+$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].text+'\"><input type=\"text\" size=\"6\" name=\"data[Escala][legendas][]\" readonly value=\"'+$F('indicativo')+'\"><input type=\"hidden\" size=\"6\" name=\"data[Escala][militares_id][]\" readonly value=\"'+$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].value+'\"><a onclick=\"\$(\'teste'+$('EscalaSelectMilitares').options[$('EscalaSelectMilitares').options.selectedIndex].value+'\').remove();\" >&nbsp;&nbsp;&nbsp;<img
border=\"0\" alt=\"Excluir\" src=\"../img/lixo.gif\"/></a><br></div>';
                    </script>
                    --> <?php echo $form->end(array('onmousedown' => $script, 'label' => 'Cadastrar', 'class' => 'botoes')); ?>

                </td></tr>
        </tbody>
    </table>       
</div></div>
<?php
//print_r($data);

Menu_Barra('grupo40', 'relatorio41', 'CADASTRAR LEGENDAS', 0);

?>
<table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio41" style="align:center;" width="100%" ><tr><td>
<?php
//$data['Escala']['mes']}
//$tipo[0]='SELECIONE O TIPO';
echo $form->create('Escala', array('action' => 'externomilitarescala', 'type' => 'file', 'id' => 'EscalaChefes'));
echo "<input type=\"submit\" value=\"Cadastrar militares e respectivas legendas\" class=\"botoes\"  />";

echo $form->end();
?>
        </td></tr></table>
<?php
//print_r($data);

Menu_Barra('grupo40', 'relatorio40', 'ATUALIZAR CHEFES', 0);
?>
<table  cellpadding="0" class="tabelalimpa" cellspacing="0" id="relatorio40" style="align:center;" width="100%" ><tr><td>
<?php
//$data['Escala']['mes']}
//$tipo[0]='SELECIONE O TIPO';
$tipo['OPERACIONAL'] = 'OPERACIONAL';
$tipo['RISAER'] = 'RISAER';
$tipo['TECNICA'] = 'TECNICA';
echo $form->create('Escala', array('action' => '', 'onsubmit' => 'return false;', 'type' => 'file', 'id' => 'EscalaExternoChefes'));
echo $form->input('tipo_escala', array('type' => "select", 'class' => 'formulario', 'options' => $tipo, 'id' => 'EscalaChefesTipoEscala'), false);
echo $form->input('nome_chefe', array('onChange' => "", 'class' => 'formulario', 'size' => '100', 'id' => 'EscalaChefesNomeChefe','value'=>''), false);
echo "<input type=\"submit\" value=\"Ajustar nomes dos chefes\" class=\"botoes\" onclick=\"enviaChefe();\" />";

echo $form->end();
?>
        </td></tr></table>
<script>
    function enviaChefe() {
        if($('EscalaChefesNomeChefe').value==''){
            $('mensagemerro').innerHTML  = '<p style="background-color:#e0c000;margin:0px;color:#800000;text-align:center;">Campo não preenchido corretamente:<br></p><p style="background-color:#d0d0f0;padding:0px;color:#800000;text-align:center;margin:0px;">Deve ser informado o nome do Chefe!</p>';
            ShowContent('mensagemtela');
            return false;
        }

        new Ajax.Request('<?php echo $this->webroot; ?>escalas/externochefes', {
            method: 'post',
            parameters: $('EscalaExternoChefes').serialize(),
            onSuccess: function(transport) {
                var resultado = transport.responseText.evalJSON(true);
                if (resultado.ok==0){
                    $('mensagemerro').innerHTML = "<p>Registro não atualizado!</p>";
                    ShowContent('mensagemtela');
                }else{
                    // $(id).innerHTML = unescape(resultado.mensagem);
                    $('mensagemerro').innerHTML = "<p>Registros atualizados!</p>";
                    ShowContent('mensagemtela');
                }
            }})
        
        
        return false;
    }
    
    
    function atualizamilitarescala(militarescalaid, id) {
        new Ajax.Request('<?php echo $this->webroot; ?>escalas/externoatualizamilitarescala', {
            method: 'post',
            parameters: {legendap: $('p'+id).value, legendac: $('c'+id).value, ativalegendap: $('legendap'+id).value, ativalegendac: $('legendac'+id).value, militarescala: militarescalaid},
            onSuccess: function(transport) {
                var resultado = transport.responseText.evalJSON(true);
                if (resultado.ok==0){
                    $('mensagemerro').innerHTML = "<p>Registro não atualizado!</p>";
                    ShowContent('mensagemtela');
                }else{
                    // $(id).innerHTML = unescape(resultado.mensagem);
                    $('mensagemerro').innerHTML = "<p>Registros atualizados!</p>";
                    ShowContent('mensagemtela');
                }
            }})
        
        
        return false;
    }
    
    HideContent('relatorio40');
    
<?php
if (empty($temID)) {
    echo "HideContent('relatorio15');";
} else {
    echo "ShowContent('relatorio15');";
}
?>
</script>   
<BR>
<?php ?>
<div class="escalas index">
<?php
$caminhop = $this->webroot . 'escalas/externoPdf/' . $this->data['Escala']['ano'] . '/' . $this->data['Escala']['mes'];

//$this->data['Escala']['ano']
?>
    <div id="grupo16" style="background-color:#ffffff;margin:0 0 0 0;padding:0 0 0 0;">
        <p style="-moz-background-clip: border;-moz-background-origin: padding;-moz-background-size: auto auto;background-attachment: scroll;background-color: #7080b0;
           background-image: none;background-position: 0 0;background-repeat: repeat;border-left-color-ltr-source: solid;border-left-color-rtl-source: solid;
           border-left-color-value: #000000;border-left-width-ltr-source: physical;border-left-width-rtl-source: physical;visibility:visible;
           border-left-width-value: 6px;color: #000000;font-size: 1.0em;height: 1.8em;line-height: 1.8;
           margin:0 0 0 0;padding-top: 0px;padding-left: 10px;text-shadow: 1px 1px 1px #FFFFFF;text-align:left;margin-botton:0px;">
            ESCALAS CADASTRADAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Html->link($this->Html->image('broffice.png', array('alt' => __('BROffice', true), 'border' => '0', 'title' => 'Dados em planilha BROffice')), array('action' => 'indexExcel/' . $this->data['Escala']['ano'] . '/' . $this->data['Escala']['mes']), array('id' => 'broffice', 'escape' => false), null, false); ?>
            <a  onclick="window.open('<?php echo $caminhop; ?>','','');"><?php echo $this->Html->image('pdf2p.gif', array('alt' => __('PDF', true), 'border' => '0', 'title' => 'Gerar PDF das Escalas', 'id' => 'pdfp')); ?>
            </a>
        </p>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="50%">
<?php
//print_r($data);

$anos = array();
$ano = date('Y') + 1;
$anoa = date('Y') - 1;
for ($inicio = $anoa; $inicio <= $ano; $inicio++) {
    $anos[$inicio] = $inicio;
}

if (empty($this->data['Escala']['mes'])) {
    $this->data['Escala']['mes'] = date('n');
    $this->data['Escala']['ano'] = date('Y');
}
echo $form->create('Escala', array('action' => 'delete', 'onsubmit' => 'return false;', 'type' => 'file', 'id' => 'Exclusao'));
echo $form->hidden('mes', array('value' => $this->data['Escala']['mes']));
echo $form->hidden('ano', array('value' => $this->data['Escala']['ano']));
echo "<input type=\"hidden\" id=\"EscalaMesAtual\" name=\"data[Escala][mesAtual]\" value=\"{$this->data['Escala']['mes']}\">";
echo "<input type=\"hidden\" id=\"EscalaAnoAtual\" name=\"data[Escala][anoAtual]\" value=\"{$this->data['Escala']['ano']}\">";
echo "<input type=\"submit\" value=\"Excluir escalas selecionadas\" class=\"botoesalerta\"  onClick=\"submitForm('excluir');return false;\"  />";

echo $form->end();
?>
                    <script type="text/javascript">
                        function mensagem(texto){
                            Dialogs.confirm(
                            texto,
                            function(){
                                return true;
                                Dialogs.close();
                            },
                            function(){
                                return false;
                                Dialogs.close();
                            }
                        );
                        }    
    
                        function submitForm(acao) {
                            /*
                        usa método request() da classe Form da prototype, que serializa os campos
                        do formulário e submete (por POST como default) para a action especificada no form
                             */

                            if(acao=='excluir'){
                                Dialogs.confirm(
                                'TEM CERTEZA QUE DESEJA EXCLUIR AS ESCALAS SELECIONAS DE <?php echo $this->data['Escala']['mes'] . '/' . $this->data['Escala']['ano']; ?> ???',
                                function(){
                                    var formulario01= $('Exclusao');       
                                    var formulario02= $('EscalaAcoes');       
                                    var destino = 'delete';
                                    var dados01 = Form.serialize(formulario01);
                                    var dados02 = Form.serialize(formulario02);
                                    var dados = dados01+dados02.gsub('_method=POST','');
                                    new Ajax.Request('<?php echo $this->webroot; ?>escalas/'+destino, {
                                        method: 'post',
                                        postBody: dados,
                                        onSuccess: function(transport) {

                                            var resultado = transport.responseText.evalJSON(true);
                                            $('alertaSistema').innerHTML = resultado.mensagem;
                                            ShowContent('mensagem');

                                        }})
                                    Dialogs.close();
                                },
                                function(){
                                    return false;
                                    Dialogs.close();
                                }
                            );
                    
                            }
                            if(acao=='duplicar'){
                                Dialogs.confirm(
                                'QUER REALMENTE TENTAR DUPLICAR OS REGISTROS SELECIONADOS ?',
                                function(){        
                                    var formulario01= $('Duplicacao');       
                                    var formulario02= $('EscalaAcoes');       
                                    var destino = 'geraescala';
                                    var dados01 = Form.serialize(formulario01);
                                    var dados02 = Form.serialize(formulario02);
                                    var dados = dados01+dados02.gsub('_method=POST','');
                                    new Ajax.Request('<?php echo $this->webroot; ?>escalas/'+destino, {
                                        method: 'post',
                                        postBody: dados,
                                        onSuccess: function(transport) {

                                            var resultado = transport.responseText.evalJSON(true);
                                            $('alertaSistema').innerHTML = resultado.mensagem;
                                            ShowContent('mensagem');

                                        }})
                                    Dialogs.close();
                                },
                                function(){
                                    return false;
                                    Dialogs.close();
                                }
                            );
                            }
    
        
                            return false;
                        }

                        $('mensagem').observe('mensagem:fechada', function(event){
                            if(event.memo.mensagemId==0){
                                location.reload();
                            }
                        });

                    </script>
                </td>
                <td width="50%">
<?php
//print_r($data);

$anos = array();
$ano = date('Y') + 1;
$anoa = date('Y') - 1;
for ($inicio = $anoa; $inicio <= $ano; $inicio++) {
    $anos[$inicio] = $inicio;
}

if (empty($this->data['Escala']['mes'])) {
    $this->data['Escala']['mes'] = date('n');
    $this->data['Escala']['ano'] = date('Y');
}
echo $form->create('Escala', array('action' => 'geraescala', 'onsubmit' => 'return false;', 'type' => 'file', 'id' => 'Duplicacao'));
echo $form->hidden('mes', array('value' => $this->data['Escala']['mes']));
echo $form->hidden('ano', array('value' => $this->data['Escala']['ano']));
if ($u[0]['Usuario']['privilegio_id'] != 12) {
    echo "<input type=\"submit\" value=\"Duplicar escalas do mês selecionado para o mês ->\" class=\"botoes\"   onClick=\"submitForm('duplicar');return false;\"  style=\"float:none;\" />";
    echo $form->select('mesdestino', $mes, $this->data['Escala']['mes'], array('class' => 'botoes'), false);
    echo $form->select('anodestino', $anos, $this->data['Escala']['ano'], array('class' => 'botoes'), false);
}
echo $form->end();
?>

                </td>
            </tr>
        </table>

    </div>
                    <?php
                    echo $form->create('Escala', array('controller' => 'Escala', 'action' => 'null', 'id' => 'EscalaAcoes'));

//echo $paginator->counter(array('format' => __('Página %page%/%pages%, exibindo %current% registro(s) de %count% total, registros de %start%, até %end%', true)));
                    ?></h3>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php __('cidade_id'); ?></th>
        <th><?php __('unidade_id'); ?></th>
        <th><?php __('setor_id'); ?></th>
        <th><?php __('nm_escalante'); ?></th>
        <th><?php __('nm_chefe_orgao'); ?></th>
        <th><?php __('nm_chefe_escala'); ?></th>
        <th><?php __('mes'); ?></th>
        <!-- 	<th><?php __('dt_limite_cumprida'); ?></th>
        <th><?php __('dt_limite_previsao'); ?></th>
        -->
        <th class="actions">Modificar</th>
        <th>SELECIONAR<br><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos01" title="" alt="" src="<?php echo $this->webroot; ?>img/accepto.png"/></a><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos02" title="" alt="" src="<?php echo $this->webroot; ?>img/acceptr.png"/></a><a  style="padding: 1px; font-size: 0.8em;"><img border="0" id="todos03" title="" alt="" src="<?php echo $this->webroot; ?>img/acceptt.png"/></a></th>
    </tr>
    <?php
    $i = 0;
    //echo '<pre>';
    //print_r($setors);
    //echo '</pre>';

    foreach ($escalas as $escala):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        if ($escala['Escala']['ativa'] == 0) {
            $td = ' style="background-color:#F0D0D0;" ';
        } else {
            $td = '';
        }
        ?>
    <tr  <?php echo $class; ?> >
            <td <?php echo $td; ?>><?php echo $this->Html->link($escala['Cidade']['nome'], array('controller' => 'estados', 'action' => 'view', $escala['Estado']['id'])); ?>
            </td>
            <td <?php echo $td; ?>><?php echo $this->Html->link($escala['Unidade']['sigla_unidade'], array('controller' => 'unidades', 'action' => 'view', $escala['Unidade']['id'])); ?>
            </td>
            <td <?php echo $td; ?>><?php echo $this->Html->link($escala['Setor']['sigla_setor'], array('controller' => 'setors', 'action' => 'view', $escala['Setor']['id'])); ?>
            </td>
            <td <?php echo $td; ?>><?php echo $escala['Escala']['nm_escalante']; ?></td>
            <td <?php echo $td; ?>><?php echo $escala['Escala']['nm_chefe_orgao']; ?></td>
            <td <?php echo $td; ?>><?php echo $escala['Escala']['nm_comandante']; ?></td>
            <td <?php echo $td; ?>><?php echo $escala['Escala']['mes'] . '/' . $escala['Escala']['ano']; ?></td>
            <!-- 		
            <td><?php echo $escala['Escala']['dt_limite_previsao']; ?></td>
            <td><?php echo $escala['Escala']['dt_limite_cumprida']; ?></td>
            -->
            <td class="actions"><?php //echo $this->Html->link($this->Html->image('lupa.gif', array('alt'=> __('Exibir', true), 'border'=> '0', 'title'=>'Visualizar')), array('action'=>'view', $escala['Escala']['id']),array('escape'=>false, 'escape'=>false), null,false); ?>
        <?php echo $this->Html->link($this->Html->image('lapis.gif', array('alt' => __('Editar', true), 'border' => '0', 'title' => 'Editar')), array('action' => 'add', $escala['Escala']['id']), array('escape' => false, 'escape' => false), null, false); ?>
    <?php
    //	echo $this->Html->link($this->Html->image('lixo.gif', array('alt'=> __('Excluir', true), 'border'=> '0', 'title'=>'Excluir')), array(), array('onmousedown'=>"dialogo('Deseja realmente excluir o registro #".$escala['Setor']['sigla_setor']." ?' ,'".$this->webroot.$this->params['controller'].'/delete/'.$escala['Escala']['id']."');",'onclick'=>"return false;",'escape'=>false, 'escape'=>false), null,false); 
    ?><?php //echo "<input type=\"image\" id='imgturno' border=1 src=\"{$this->webroot}webroot/img/duplicar.gif\" onmousedown=\"$('idEscala').value=".$escala['Escala']['id'].";$('login').show();\"  onkeydown=\"$('idEscala').value=".$escala['Escala']['id'].";$('login').show();\" title=\"Duplicar\"/>";  ?>
            </td>
            <td><?php
            	$ttipo = ''; 
               if($escala['Escala']['tipo']=="OPERACIONAL"){
					$ttipo = 'idsop';
               }
               if($escala['Escala']['tipo']=="RISAER"){
					$ttipo = 'idsr';
               }
               if($escala['Escala']['tipo']=="TECNICA"){
					$ttipo = 'idst';
               }
                
            ?>
                <input type="checkbox" name="data[Escala][ids][]" id="<?php echo $ttipo.$escala['Escala']['id']; ?>" value="<?php echo $escala['Escala']['id']; ?>">
            </td>
        </tr>
<?php endforeach; ?>
</table>
<?php
echo $form->hidden('statusid', array('value' => '0', 'id' => 'statusid'));
echo $form->end();
?>
</div>
<!-- 
<div class="paging"><?php //echo $paginator->prev('<< '.__('Anterior', true), array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
| <?php //echo $paginator->numbers(array('modulus'=>200,'onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"));?> <?php //echo $paginator->next(__('Próxima', true).' >>', array('onmouseover'=>"\$('busca').action=this.href;",'onclick'=>"return false;",'onmousedown'=>"\$('busca').submit();"), null, array('class'=>'disabled'));?>
</div>
-->
<?php
/*
 * 
  echo '<hr><div class="input select required"><label for="EscalaSelectMilitares">Selecione a Escala</label><select id="EscalaSelectEscalas"  class="formulario">';
  foreach ($escalas as $escala){
  echo '<option value="'.$escala['Escala']['id'].'">'.$escala['Cidade']['nome'].'-'.$escala['Unidade']['sigla_unidade'].'-'.$escala['Setor']['sigla_setor'].'-'.$escala['Escala']['mes'].'/'.$escala['Escala']['ano'].'</option>';

  }
  echo '</select></div>';
 */
?>
<script type="text/javascript">
Event.observe('todos01', 'click', function(event) {
    var status = $('statusid').value;    
    var formulario = $('EscalaAcoes');
    var x =formulario.getInputs('checkbox');
    //alert('clicou na operacional');
    for(i=0;i<x.size();i++){
        nome = x[i].id; 
        if(nome.startsWith('idsop')){
            if(status==1){
                x[i].checked = false;
            }else{
                x[i].checked = true;
            }
        }
    }
    if(status==0){
        $('statusid').value = 1;
    }else{
        $('statusid').value = 0;
    }
}
);
Event.observe('todos02', 'click', function(event) {
    var status = $('statusid').value;    
    var formulario = $('EscalaAcoes');
    var x =formulario.getInputs('checkbox');
    //alert('clicou na risaer');
    for(i=0;i<x.size();i++){
        nome = x[i].id; 
        if(nome.startsWith('idsr')){
            if(status==1){
                x[i].checked = false;
            }else{
                x[i].checked = true;
            }
        }
    }
    if(status==0){
        $('statusid').value = 1;
    }else{
        $('statusid').value = 0;
    }
}
);
Event.observe('todos03', 'click', function(event) {
    var status = $('statusid').value;    
    var formulario = $('EscalaAcoes');
    var x =formulario.getInputs('checkbox');
    //alert('clicou na tecnica');
    for(i=0;i<x.size();i++){
        nome = x[i].id; 
        if(nome.startsWith('idst')){
            if(status==1){
                x[i].checked = false;
            }else{
                x[i].checked = true;
            }
        }
    }
    if(status==0){
        $('statusid').value = 1;
    }else{
        $('statusid').value = 0;
    }
}
);
//, false          

    //, false          
</script>
<div style="display: none; position: absolute; border-style: solid; background-color: white; padding: 0px; width: 20%; border: 2px solid rgb(0, 0, 0); z-index: 1010" id="mensagemtela">
    <p  style="padding:0px;height:20px;background-color: #800000; color: #fff; margin: 0px; vertical-align: top;text-align:center; border: 2px; border-color: #000;">MENSAGEM DO SISTEMA<a href="javascript:HideContent('mensagemtela');"  style="float:right;background-color:#ffffff;" id="msgfechar">X</a></p>
    <div id='mensagemerro'>
    </div>

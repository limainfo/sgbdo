<?php 
include($caminhoAditivos);
include('../views/funcoes_henrique.ctp');
echo $this->Html->script('jscalendar/calendar.js');
echo $this->Html->script('jscalendar/lang/calendar-br.js');
echo $this->Html->script('common.js');
echo $this->Html->css('../js/jscalendar/skins/aqua/theme');

echo("<div id='carregando'>".$this->Html->image('spinner.gif')."</div>");

$raiz = $this->webroot;

$conta = 0;




$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function select_innerHTML(objetoId,innerHTML){

	objeto = $(objetoId);
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){//se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    //innerHTML = innerHTML.toLowerCase().replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
      
    
    for(var i=0;i<selTemp.childNodes.length;i++){
  var spantemp = selTemp.childNodes[i];
  
        if(spantemp.tagName){     
            opt = document.createElement("OPTION")
    
   if(document.all){ //IE
    objeto.add(opt)
   }else{
    objeto.appendChild(opt)
   }       
    
   //getting attributes
   for(var j=0; j<spantemp.attributes.length ; j++){
    var attrName = spantemp.attributes[j].nodeName;
    var attrVal = spantemp.attributes[j].nodeValue;
    if(attrVal){
     try{
      opt.setAttribute(attrName,attrVal);
      opt.setAttributeNode(spantemp.attributes[j].cloneNode(true));
     }catch(e){}
    }
   }
   //getting styles
   if(spantemp.style){
    for(var y in spantemp.style){
     try{opt.style[y] = spantemp.style[y];}catch(e){}
    }
   }
   //value and text
   opt.value = spantemp.getAttribute("value")
   opt.text = spantemp.innerHTML
   //IE
   opt.selected = spantemp.getAttribute('selected');
   opt.className = spantemp.className;
  } 
 }    
 document.body.removeChild(selTemp)
 selTemp = null
}

function listasetores(CampoSetores,UnidadeID){
	new Ajax.Updater(CampoSetores,'{$this->webroot}setors/externosetores/'+UnidadeID, {asynchronous:false, evalScripts:false, requestHeaders:['X-Update', CampoSetores]})
}	

		
//]]>	
	
	    
		//]]>		
</script>
SCRIPT;
echo $jscript;

echo("<div class='Relatorios index'>");
//Menu_Barra('grupo16','relatorio16','CONSULTA PERSONALIZADA NO LPNA');
echo $form->create('R16', array('url'=>array('controller'=>'aditivos', 'action'=>'externolpnaconsulta'), 'type'=>'file', 'inputDefaults' => array('label' => false, 'div' => false)));

$campos['']='';
$campos['CIDADE']='Cidade';
$campos['NOME']='Nome';
$campos['IDENT']='Identidade';
$campos['GRAD']='Posto';
$campos['CPF']='CPF';
$campos['sexo']='Sexo';

$tipos['CIDADE']='literal';
$tipos['GRAD']='literal';
$tipos['CPF']='literal';
$tipos['sexo']='literal';
$tipos['IDENT']='literal';
$tipos['NOME']='literal';

$literal[0]='E - CONTENHA';
/*
$literal[1] ='E - NÃO CONTENHA';
$literal[2]='E - COMECE COM';
$literal[3]='E - TERMINE COM';
$literal[4]='OU - CONTENHA';
$literal[5] ='OU - NÃO CONTENHA';
$literal[6]='OU - COMECE COM';
$literal[7]='OU - TERMINE COM';
*/
$literais='';
foreach($literal as $dadoliteral){
	$literais .= "<option value=\"{$dadoliteral}\">{$dadoliteral}</option>";
}
$numerico[0]='E - IGUAL A';
$numerico[1] ='E - DIFERENTE DE';
$numerico[2]='E - MAIOR QUE';
$numerico[3]='E - MENOR QUE';
$numerico[4]='OU - IGUAL A';
$numerico[5] ='OU - DIFERENTE DE';
$numerico[6]='OU - MAIOR QUE';
$numerico[7]='OU - MENOR QUE';

$numericos='';
foreach($numerico as $dadonumerico){
	$numericos .= "<option value=\"{$dadonumerico}\">{$dadonumerico}</option>";
}          
echo("<table><tr><td colspan='6' style='background-color:#40ffff;'><center><b>CONSULTA AOS CADASTROS DO LPNA</b></center></th></tr>
<tr><th width='33%'>Campo</th><th width='33%'>Condição</th><th width='33%'>Valor</th></tr>");
$i=0;
$unidade['']='';
$unidade['4bd48fff-5804-11e1-b7b5-5254af733096']='CINDACTA I - 2/6 GAV';
$unidade['4bd534d7-5804-11e1-b7b5-5254af733096']='CINDACTA I - AFA';
$unidade['4bd66752-5804-11e1-b7b5-5254af733096']='CINDACTA I - BABR';
$unidade['4b9a1a0f-5804-11e1-b7b5-5254af733096']='CINDACTA I - CBCY';
$unidade['4bd70b4b-5804-11e1-b7b5-5254af733096']='CINDACTA I - CENIPA';
$unidade['4bd74305-5804-11e1-b7b5-5254af733096']='CINDACTA I - CIAAR';
$unidade['4bbf351c-5804-11e1-b7b5-5254af733096']='CINDACTA I - CINDACTA I';
$unidade['4bbf9025-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-AN';
$unidade['4bbfc67e-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-BQ';
$unidade['4bbffa54-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-BR';
$unidade['4bc02ea0-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-BW';
$unidade['4bc06670-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-CC';
$unidade['4bc09d15-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-CF';
$unidade['4bc0da55-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-CY';
$unidade['4bc11200-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-GA';
$unidade['4bc15f2b-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-GI';
$unidade['4bc194a1-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-LS';
$unidade['4bc1e09e-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-PCO';
$unidade['4bc22467-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-SRO';
$unidade['4bc25742-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-STA';
$unidade['4bc28d3f-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-TNB';
$unidade['4bc2eaf2-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-TRM';
$unidade['4bc329a9-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTCEA-YS';
$unidade['4bc36aed-5804-11e1-b7b5-5254af733096']='CINDACTA I - DTS';
$unidade['4bd7ceb8-5804-11e1-b7b5-5254af733096']='CINDACTA I - GABAER';
$unidade['4bd4c967-5804-11e1-b7b5-5254af733096']='CINDACTA I - III FAE';
$unidade['010624f4-ca72-102f-95e7-72567f175e3a']='CINDACTA I - INFRAERO-SEDE';
$unidade['4b9bd75f-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBBH';
$unidade['4b9c7c8a-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBBR';
$unidade['4b9e261e-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBCF';
$unidade['4ba2b508-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBGO';
$unidade['4bab291f-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBMK';
$unidade['4bae19c7-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBPC';
$unidade['4bae8c9b-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBPJ';
$unidade['4bafd358-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBPR';
$unidade['4bb1ecff-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBRP';
$unidade['4bb65192-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBUL';
$unidade['4bb6a34b-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBUR';
$unidade['4bb6f62c-5804-11e1-b7b5-5254af733096']='CINDACTA I - SBVT';
$unidade['4bb74cae-5804-11e1-b7b5-5254af733096']='CINDACTA I - SEDE';
$unidade['4bb809ed-5804-11e1-b7b5-5254af733096']='CINDACTA I - SRCO';
$unidade['4bba2031-5804-11e1-b7b5-5254af733096']='CINDACTA I - SRSE';
$unidade['4bbdbc0b-5804-11e1-b7b5-5254af733096']='CINDACTA II - 2º/1º GCC';
$unidade['4bbe7f19-5804-11e1-b7b5-5254af733096']='CINDACTA II - 4º/1º GCC';
$unidade['4b99c179-5804-11e1-b7b5-5254af733096']='CINDACTA II - CBCT';
$unidade['4bc3abd6-5804-11e1-b7b5-5254af733096']='CINDACTA II - CINDACTA II';
$unidade['4bc3e3e7-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-BI';
$unidade['4bc44905-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CG';
$unidade['4bc52910-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CGU';
$unidade['4bc417cd-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CO';
$unidade['4bc47f56-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CR';
$unidade['4bc4b59c-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CT';
$unidade['4bc4f1ef-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-CTD';
$unidade['4bc55e7b-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-FI';
$unidade['4bc59277-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-FL';
$unidade['4bc5c68b-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-JGI';
$unidade['4bc60031-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-MDI';
$unidade['4bc639db-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-PA';
$unidade['4bc670b6-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-SM';
$unidade['4bc6a625-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-STI';
$unidade['4bc6d992-5804-11e1-b7b5-5254af733096']='CINDACTA II - DTCEA-UG';
$unidade['4bc92f5e-5804-11e1-b7b5-5254af733096']='CINDACTA II - PACT';
$unidade['4b9b8402-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBBG';
$unidade['4b9c2bf5-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBBI';
$unidade['4b9ccd78-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBBU';
$unidade['4b9d80f6-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCB';
$unidade['4b9dd4eb-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCD';
$unidade['4b9e80ab-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCG';
$unidade['4b9f3753-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCM';
$unidade['4b9f952d-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCP';
$unidade['4b9feb7c-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBCR';
$unidade['4ba043a9-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBDN';
$unidade['4ba0f1be-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBFI';
$unidade['4ba14221-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBFL';
$unidade['ddca0ada-0524-1030-95e7-72567f175e3a']='CINDACTA II - SBFS';
$unidade['4ba26390-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBGL';
$unidade['4ba78f4e-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBJR';
$unidade['4ba85400-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBJV';
$unidade['4ba911cd-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBLO';
$unidade['4baad910-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBME';
$unidade['587bb5bc-fd0f-102f-95e7-72567f175e3a']='CINDACTA II - SBMG';
$unidade['4bac97af-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBNF';
$unidade['4bad47b0-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBPA';
$unidade['4baedc68-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBPK';
$unidade['4baf8070-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBPP';
$unidade['4bb19048-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBRJ';
$unidade['4bb5d76d-5804-11e1-b7b5-5254af733096']='CINDACTA II - SBUG';
$unidade['662b862c-ecc2-102f-95e7-72567f175e3a']='CINDACTA II - SBZM';
$unidade['4bb85f4b-5804-11e1-b7b5-5254af733096']='CINDACTA II - SRME';
$unidade['4bb9c718-5804-11e1-b7b5-5254af733096']='CINDACTA II - SRRJ';
$unidade['4bba7adb-5804-11e1-b7b5-5254af733096']='CINDACTA II - SRSP';
$unidade['4bbacfe6-5804-11e1-b7b5-5254af733096']='CINDACTA II - SRSU';
$unidade['4bd45661-5804-11e1-b7b5-5254af733096']='CINDACTA III - 1/5 GAV';
$unidade['4bbe2cd1-5804-11e1-b7b5-5254af733096']='CINDACTA III - 3º/1º GCC';
$unidade['4bbee0b9-5804-11e1-b7b5-5254af733096']='CINDACTA III - 5º/1º GCC';
$unidade['4bc9794d-5804-11e1-b7b5-5254af733096']='CINDACTA III - CINDACTA III';
$unidade['4bc9b431-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-AR';
$unidade['4bc9e499-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-FN';
$unidade['4bcb6710-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-FZ';
$unidade['4bcb2e69-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-LP';
$unidade['4bca18b5-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-MO';
$unidade['4bca4c4a-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-NT';
$unidade['4bcb98cf-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-PL';
$unidade['4bcafbf8-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-PS';
$unidade['4bca8211-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-RF';
$unidade['4bcac1e8-5804-11e1-b7b5-5254af733096']='CINDACTA III - DTCEA-SV';
$unidade['4b9ac83e-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBAR';
$unidade['4ba1b12e-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBFN';
$unidade['4ba20c1a-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBFZ';
$unidade['4ba63588-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBIL';
$unidade['4ba73bd8-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBJP';
$unidade['4ba80342-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBJU';
$unidade['9ef2968a-f8c0-102f-95e7-72567f175e3a']='CINDACTA III - SBKG';
$unidade['4ba967ab-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBLP';
$unidade['4bab8589-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBMO';
$unidade['4baceeea-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBNT';
$unidade['4badab4b-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBPB';
$unidade['4baf2e6e-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBPL';
$unidade['4bb13122-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBRF';
$unidade['4bb38ec2-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBSV';
$unidade['4bb40088-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBTE';
$unidade['4bb57a86-5804-11e1-b7b5-5254af733096']='CINDACTA III - SBUF';
$unidade['4bb8b9ad-5804-11e1-b7b5-5254af733096']='CINDACTA III - SRNE';
$unidade['4b9a6fb3-5804-11e1-b7b5-5254af733096']='CINDACTA IV - CBCZ';
$unidade['4bcbd2c2-5804-11e1-b7b5-5254af733096']='CINDACTA IV - CINDACTA IV';
$unidade['4bcc081b-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-AA';
$unidade['4bcc3a02-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-BE';
$unidade['4bcc6f7c-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-BV';
$unidade['4bccac7a-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-CZ';
$unidade['4bcce6bd-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-EG';
$unidade['4bcd26f3-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-EI';
$unidade['4bcd5a97-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-EK';
$unidade['4bcd91e3-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-EP';
$unidade['4bcdc401-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-FA';
$unidade['4bce0971-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-FX';
$unidade['4bce4574-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-GM';
$unidade['4bce8243-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-IZ';
$unidade['4bcec51c-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-MN';
$unidade['4bcef20e-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-MQ';
$unidade['4bcf28ac-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-MY';
$unidade['4bcf7eab-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-OI';
$unidade['4bcfb73f-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-PV';
$unidade['4bcff4da-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-RB';
$unidade['4bd02c77-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-SI';
$unidade['4bd093bf-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-SL';
$unidade['4bd05afb-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-SN';
$unidade['4bd0c72f-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-TF';
$unidade['4bd12999-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-TS';
$unidade['4bd16070-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-TT';
$unidade['4bd192a8-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-UA';
$unidade['4bd1c1c8-5804-11e1-b7b5-5254af733096']='CINDACTA IV - DTCEA-VH';
$unidade['4b9b2a5b-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBBE';
$unidade['4b9d290f-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBBV';
$unidade['4b9ed550-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBCJ';
$unidade['4ba09586-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBEG';
$unidade['4ba5dada-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBHT';
$unidade['4ba68692-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBIZ';
$unidade['4ba6df13-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBJC';
$unidade['4baa8765-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBMA';
$unidade['4babe789-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBMQ';
$unidade['4bb03021-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBPV';
$unidade['4bb08571-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBQI';
$unidade['4bb0d2aa-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBRB';
$unidade['4bb28fd9-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBSL';
$unidade['4bb2e94d-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBSN';
$unidade['4bb4548c-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBTF';
$unidade['4bb4ca09-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBTT';
$unidade['4bb51c75-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SBTU';
$unidade['4bb7a234-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SRCE';
$unidade['4bb917be-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SRNO';
$unidade['4bb9726c-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SRNR';
$unidade['4bbb301e-5804-11e1-b7b5-5254af733096']='CINDACTA IV - SWJI';
$unidade['4bbce223-5804-11e1-b7b5-5254af733096']='SRPV-SP - 1º GCC';
$unidade['4bbd655d-5804-11e1-b7b5-5254af733096']='SRPV-SP - 1º/1º GCC';
$unidade['4bd5010f-5804-11e1-b7b5-5254af733096']='SRPV-SP - 4 ETA';
$unidade['4bd42b41-5804-11e1-b7b5-5254af733096']='SRPV-SP - ASOCEA';
$unidade['4bd5e835-5804-11e1-b7b5-5254af733096']='SRPV-SP - BAAF';
$unidade['4bd6a6fe-5804-11e1-b7b5-5254af733096']='SRPV-SP - BAENSPA';
$unidade['4bd62b65-5804-11e1-b7b5-5254af733096']='SRPV-SP - BAGL';
$unidade['4bd6d336-5804-11e1-b7b5-5254af733096']='SRPV-SP - BAVEX';
$unidade['4bbbe089-5804-11e1-b7b5-5254af733096']='SRPV-SP - CGNA';
$unidade['4bbb88f9-5804-11e1-b7b5-5254af733096']='SRPV-SP - DECEA';
$unidade['4bd22f66-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-AF';
$unidade['4bd27006-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-GL';
$unidade['4bd2a623-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-GW';
$unidade['4bd2db88-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-MT';
$unidade['4bd3230f-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-SC';
$unidade['4bd38d3b-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-SJ';
$unidade['4bd35997-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-SP';
$unidade['4bd3c854-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEA-ST';
$unidade['4bd3f75b-5804-11e1-b7b5-5254af733096']='SRPV-SP - DTCEATM-RJ';
$unidade['4bd77ce2-5804-11e1-b7b5-5254af733096']='SRPV-SP - EEAR';
$unidade['4bbc3891-5804-11e1-b7b5-5254af733096']='SRPV-SP - ICA';
$unidade['4bbc90f0-5804-11e1-b7b5-5254af733096']='SRPV-SP - ICEA';
$unidade['4bdce5f6-5804-11e1-b7b5-5254af733096']='SRPV-SP - RAO-SBRP';
$unidade['4bd9cb29-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBAE';
$unidade['4bd8b966-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBAQ';
$unidade['4bd8ede5-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBAS';
$unidade['4bd87fd6-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBAU';
$unidade['4bda395c-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBBP';
$unidade['4bd95f70-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBBT';
$unidade['4bd996e1-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBBU';
$unidade['5458b7ba-079f-1030-95e7-72567f175e3a']='SRPV-SP - SBBZ';
$unidade['4bdca832-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBDN';
$unidade['4ba30eac-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBGP';
$unidade['4ba58169-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBGR';
$unidade['4bdb2935-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBJD';
$unidade['4ba8b863-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBKP';
$unidade['4bdb5d9a-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBLN';
$unidade['4bdb91f4-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBML';
$unidade['4bac3937-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBMT';
$unidade['4bb23ca5-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBSJ';
$unidade['4bb33c8d-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBSP';
$unidade['4bdd5e7f-5804-11e1-b7b5-5254af733096']='SRPV-SP - SBSR';
$unidade['4bd80f0f-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDAM';
$unidade['4bda01c3-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDBK';
$unidade['4bddcd73-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDCO';
$unidade['4bd84836-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDDN';
$unidade['4bda7cfd-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDDR';
$unidade['4bdc7615-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDEP';
$unidade['4bdaf325-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDIM';
$unidade['4bdd96a6-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDNO';
$unidade['8194a7ce-6978-11e1-b796-20cf306ee276']='SRPV-SP - SDOP';
$unidade['4bdbd858-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDOU';
$unidade['4bdc0cc4-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDPN';
$unidade['4bdc423e-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDPW';
$unidade['4bd92378-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDRR';
$unidade['4bdd283c-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDSC';
$unidade['4bde028b-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDTP';
$unidade['4bde36ae-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDUB';
$unidade['4bde66f9-5804-11e1-b7b5-5254af733096']='SRPV-SP - SDVG';
$unidade['4bdabafa-5804-11e1-b7b5-5254af733096']='SRPV-SP - SIMK';
$unidade['4bd1fc71-5804-11e1-b7b5-5254af733096']='SRPV-SP - SRPV-SP';
$unidade['e109d6e2-cd4a-102f-95e7-72567f175e3a']='SRPV-SP - ZZZZ (Não-Empregado)';



    echo("<tr><td width='33%'>");
	echo $form->hidden(null,array('name'=>'campo[]', 'label'=>false, 'id'=>'campo'.$i, 'value'=>'unidadeID' ));
	echo("</td><td width='33%'>");
	echo "<b>UNIDADE IGUAL A:</b>";
	echo $form->hidden(null,array('name'=>'condicao[]', 'label'=>false, 'id'=>'condicao'.$i, 'value'=>'unidadeID' ));
	echo("</td><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'select', 'options'=>$unidade, 'name'=>'valor[]', 'label'=>false, 'id'=>'valor'.$i ));
	echo("</td></tr>");

for($i=1;$i<4;$i++) {
    echo("<tr><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'select', 'options'=>$campos, 'name'=>'campo[]', 'label'=>false, 'id'=>'campo'.$i, 'onchange'=>'preencheFiltro('.$i.');' ));
	echo("</td><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'select', 'options'=>'', 'name'=>'condicao[]', 'label'=>false, 'id'=>'condicao'.$i ));
	echo("</td><td width='33%'>");
	echo $form->input(null,array('class'=>'', 'type'=>'text', 'size'=>'30', 'name'=>'valor[]', 'label'=>false, 'id'=>'valor'.$i ));
	echo("</td></tr>");
}
echo "<tr><td colspan='6'><center><div class=\"submit\"><input type=\"submit\" onclick=\"event.returnValue = false; return false;\" value=\"Consultar\" class=\"botoes\" url=\"\" id=\"listardados\"></div></td></tr>";
echo("</table>");
//echo("<tr><td colspan=3>");

echo $form->hidden('id',array('name'=>'data[id]', 'value'=>'R16'));
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes')).'</center>';
//echo '<center>'.$ajax->submit('Consultar', array('id'=>'listardados','url'=> array('controller'=>'aditivos', 'action'=>'externolpnaconsulta'), 'update' => 'consulta', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
//echo '<center>'.$ajax->submit('Consultar', array('id'=>'listardados','url'=> array('url'=>'http://localhost:8888/sdop/'), 'update' => 'consulta', 'create' => '$("carregando").show();', 'success' => 'HideContent("carregando");', 'class'=>'botoes')).'</center>';
?>
<script type="text/javascript">
//&lt;![CDATA[
Event.observe("listardados", 'click', function(event) { new Ajax.Updater('consulta','/sgbdo/aditivos/externoproxy', {asynchronous:true, evalScripts:true, onCreate:function(request, xhr) {$("carregando").show();}, onSuccess:function(request) {HideContent("carregando");}, parameters:Form.serialize(Event.element(event).form), requestHeaders:['X-Update', 'consulta']}) }, false);
//]]&gt;
</script></center>    
<?php
echo $form->end();
//echo '<center>'.$ajax->submit('Gerar Ajax', array('url'=> array('controller'=>'aditivos', 'action'=>'externocsv'), 'class'=>'botoes')).'</center>';
//echo $form->end(array('label'=>'Gerar Relatório','class'=>'botoes'));

//echo("</td></tr>");
echo("</table></div><div id='consulta'></div></div>\n");
$jscript=<<<SCRIPT
<script type="text/javascript">
//<![CDATA[
function preencheSelect(nomeSelect) {
    var conteudo = '<option selected="selected" value=""></option>'
    var filtro = nomeSelect;
    select_innerHTML(filtro,conteudo);
}
function preencheFiltro(ordem) {
    var numero = '$numericos';
    var literal = '$literais';
    var data = '$data';
    var filtro = 'condicao'+ordem;
    var obcampo = 'campo'+ordem;
    var valor = $(obcampo).value;
    var tipo = literal;    
    select_innerHTML(filtro,'');
    valor.scan(/365/, function(match){ tipo=numero;});
    valor.scan(/validade/, function(match){ tipo=numero;});
    select_innerHTML(filtro,tipo);
}
</script>
SCRIPT;
echo $jscript;

?>
<script>

HideContent('carregando');

</script>	

<div id="carregando" ><?php echo $this->Html->image('spinner.gif'); ?></div>
<div id='resultado'>MENSAGENS</div>
<script type="text/javascript">
//<![CDATA[
/*
Ajax.Responders.register({ 
  onCreate: function(response) { 
    if (response.request.isSameOrigin()) 
      return; 
    var t = response.transport; 
    t.setRequestHeader = t.setRequestHeader.wrap(function(original, k, v) { 
      if (/^(accept|accept-language|content-language)$/i.test(k)) 
        return original(k, v); 
      if (/^content-type$/i.test(k) && 
          /^(application\/x-www-form-urlencoded|multipart\/form-data|text\/plain)(;.+)?$/i.test(v)) 
        return original(k, v); 
      return; 
    }); 
  } 
});
*/

//]]>
</script>

<?php
$k=0;
foreach($cpfs as $dado){
    $cpf = $dado['Militar']['cpf'];
    $k++;
    #$url = "http://evaldoesl:evaldoesl#@servicos.decea.gov.br:3128/lpna/api/?api=escala&id={$cpf}&apiKey=f75d1c10-7904-11e1-b0c4-0800200c9a66";
    //$url = "http://servicos.decea.intraer/lpna/api/?api=escala&id={$cpf}&apiKey=f75d1c10-7904-11e1-b0c4-0800200c9a66";
    $url = "http://servicos.decea.intraer/lpna/api/?&id=$cpf&api=escala&apiKey=f75d1c10-7904-11e1-b0c4-0800200c9a66";
    #$url = "http://localhost:8888/servicos2/lpna/api/?api=escala&id={$cpf}&apiKey=f75d1c10-7904-11e1-b0c4-0800200c9a66"; 
    //$url = "http://localhost:8888/servicos2/lpna/api/obter.cfm";
    ///$url = "http://localhost/sgbdo/escalas/externoenviarelacao90dias/{$cpf}";
    //$funcao = "new Ajax.Request('$url', {method: 'get',onSuccess: function(transport) {var resultado = transport.responseText.evalJSON(true);alert(resultado.resp);$('resultado').innerHTML = resultado.resp;}});";
    
    
?>
<form accept-charset="iso-8859-1" action="" enctype="multipart/form-data" id="form<?php echo $k; ?>AddForm" onsubmit="return false;" method="GET">
<a href="<?php echo $url; ?>" id="link<?php echo $k; ?>" onclick=" event.returnValue = false; return false;"><?php echo $cpf; ?></a>

<script type="text/javascript">
//<![CDATA[


Event.observe(
'link<?php echo $k; ?>', 
'click', 
function(event) { 
    var dados = $('form<?php echo $k; ?>AddForm').serialize();
    var proxyUrl = '/proxy.php?url=' + escape("<?php echo $url; ?>");
    
    new Ajax.Request( proxyUrl , 
    {
        method:'GET', 
	parameters: dados,
        onSuccess:function(request) {
            Dialogs.close();
            var req = request.responseText; 
            var ob=req.evalJSON();
            $('formularios<?php echo $k; ?>').innerHTML=req + '<= SUCESSO =>' + ob.resp;
        },
        onFailure:function(){
            $('formularios<?php echo $k; ?>').innerHTML='FALHA'
        }

    })
    }, false);

//]]>
</script>
<?php echo $form->end();

/*
 *         crossSite: true,

 *         requestHeaders :["Access-Control-Allow-Origin","*","Access-Control-Allow-Methods","POST, GET, OPTIONS"],

 * onCreate:function(request) {var t=new Dialog({content:'<img alt="" width="15" height="15" src="<?php echo $this->webroot; ?>img/spinner.gif"> Aguarde ...',
                title:'Atualizando tabelas', 
                close:{
                    link:false,
                    overlay:false,
                    esc:false
                }
            }
        );
            t.open();
        },
 * 
 *     <input type="hidden" value="<?php echo $cpf; ?>" id="id" name="id">
    <input type="hidden" value="escala" id="api" name="api">
    <input type="hidden" value="f75d1c10-7904-11e1-b0c4-0800200c9a66" id="apiKey" name="apiKey">

 */
 ?>
<div id='formularios<?php echo $k; ?>'>
</div>    
<?php
    
}
?>
<script>
    HideContent('carregando');
</script>

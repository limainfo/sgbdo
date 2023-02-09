

<script type="text/javascript">
    function endMove() {
    $(this).removeClass('movable');
}

function startMove() {
    $('.movable').on('mousemove', function(event) {
        var thisX = event.pageX - $(this).width() / 2,
            thisY = event.pageY - $(this).height() / 2;

        $('.movable').offset({
            left: thisX,
            top: thisY
        });
    });
}
$(document).ready(function() {
    $("#mensagem").on('mousedown', function() {
        $(this).addClass('movable');
        startMove();
    }).on('mouseup', function() {
        $(this).removeClass('movable');
        endMove();
    });

});
		function save()
		{
			$("#assinatura").data("jqScribble").save(function(imageData)
			{
				if(confirm("Sua assinatura será registrada no sistema. Somente o seu usuário poderá modificá-la. Confirma o registro?"))
				{
					//$.post('<?php echo $this->webroot.$this->params['controller'].'/view'; ?>', {datasign: imageData}, function(response){//$('body').append(response);});	
                                        var parametros = {'datasign': imageData};
                                         var dados = parametros;
                                         $.ajax({
                                               type: 'POST',
                                                processData: true,
                                           url: '<?php echo $this->webroot.$this->params['controller'].'/view'; ?>',
                                           beforeSend: function(){
                                             $("#spinnerassinatura").css({'display':'block'});
                                               },
                                           success: function(data) {
                                             $("#spinnerassinatura").css({'display':'none'});
                                             if(data.assinatura=='0'){
                                                 $("#alertaSistema").html(data.mensagem);
                                                 $('#mensagem').show();
                                                //alert(data.mensagem);
                                            }
                                             if(data.assinatura!='0'){
                                                 $("#alertaSistema").html(data.mensagem);
                                                 $('#mensagem').show();
                                                //alert(data.mensagem);
                                            }
                                             var sujeira = Math.random(10000);
                                             $('#imagemteste').attr("src", '<?php echo $this->webroot.$this->params['controller'].'/externodownload/'; ?>'+data.assinatura+'/'+sujeira);

                                           },
                                           error: function() {},
                                           data: dados ,
                                           datatype: 'html',
                                           contentType: 'application/x-www-form-urlencoded'
                                         });                                        
				}
			});
		}
		function addImage()
		{
			var img = prompt("Enter the URL of the image.");
			if(img !== '')$("#assinatura").data("jqScribble").update({backgroundImage: img});
		}
		$(document).ready(function()
		{
                        $("#conteudoassinatura").css("cursor", "url(<?php echo $this->webroot.'img/_img/pencil.png'; ?>),auto");
			$("#assinatura").jqScribble();//{width:'600px', height:'200px'}
                        $("#tool").val("pen");
		});
		</script>
                <center>
                
                    <div style='width:600px;height:auto;background-color: green; color: #000; margin: 0px; vertical-align: top;padding:3px;border: #000 solid 3px;text-align: justify;font-weight: bolder;'>
                        Seu usuário foi direcionado para esta tela por não possuir assinatura cadastrada. É obrigatório o cadastro de uma assinatura que só poderá ser modificada pelo próprio usuário. Empregue as ferramentas <img src='<?php echo $this->webroot.'img/_img/pencil.png'; ?>' width='15px' height="15px"> para escrever, <img src='<?php echo $this->webroot.'img/_img/eraser.png'; ?>' width='15px' height="15px"> para apagar as falhas, <img src='<?php echo $this->webroot.'img/_img/clean.png'; ?>' width='15px' height="15px"> para limpar toda a assinatura e  <img src='<?php echo $this->webroot.'img/_img/save.png'; ?>' width='15px' height="15px"> para gravar. Após gravar observe as mensagens do sistema. Saia do sistema e se autentique novamente.
                        </div>
                    
                </center>                

<center>
		<div  style="margin-top: 5px;">
                    <br><br>
			<a href="#" onclick='$("#tool").val("pen");$("#conteudoassinatura").css("cursor", "url(<?php echo $this->webroot.'img/_img/pencil.png'; ?>),auto");$("#assinatura").data("jqScribble").update({brush: BasicBrush,brushColor: "rgb(0,0,0)", brushSize:2});'><img title="Lápis" width="24" height="24" src="<?php echo $this->webroot.'img/_img/pencil.png'; ?>"></a>&nbsp;&nbsp;
			<a href="#" onclick='$("#tool").val("erase");$("#conteudoassinatura").css("cursor", "url(<?php echo $this->webroot.'img/_img/eraser.png'; ?>),auto");$("#assinatura").data("jqScribble").update({brush: BasicBrush,brushColor: "rgba(255,255,255,1)", brushSize:20});'><img title="Borracha" width="24" height="24" src="<?php echo $this->webroot.'img/_img/eraser.png'; ?>"></a>&nbsp;&nbsp;
                        <a href="#" onclick='$("#assinatura").data("jqScribble").clear();'><img title="Limpar" width="24" height="24" src="<?php echo $this->webroot.'img/_img/clean.png'; ?>"></a>&nbsp;&nbsp;
                        <a href="#" onclick='save();'><img title="Gravar" width="24" height="24" src="<?php echo $this->webroot.'img/_img/save.png'; ?>"></a><br>
                <input type="hidden" name="tool" id="tool" value="pen">
				
		</div>
                        
<div id="conteudoassinatura"  style="border: 1px solid red;width:600px;height:200px;background-color: #fff;"><canvas id="assinatura" style="border: 1px solid red;width:100%;height:100%;"></canvas></div>    
</center>
<style>
<!--

#spinnerassinatura {
    height: 100px;
    left: 50%;
    margin: -25px 0 0 -25px;
    position: fixed;
    top: 50%;
    width: 100px;
    z-index: 1000;
    display:none;
}

-->
</style>

<div id="spinnerassinatura">
	<img src="<?php echo $this->webroot.'img/loading.gif'; ?>" alt="">
</div>
<center>
<img src='/sgbdo/assinaturas/externodownload/' alt='' id='imagemteste'/>
</center>
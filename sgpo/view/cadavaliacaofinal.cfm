			<div class="block">
			
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					
					<h2>Cadastrar Ficha de Indicação para a Avaliação Final </h2>
					
				</div>		<!-- .block_head ends -->
				
				
				
				<div class="block_content">
				
					<p class="breadcrumb"><a href="#">RN011</a> &raquo; <a href="#">Gerente</a> &raquo; <strong>Cadastrar Anexos</strong><a href="#" style="float:right;"><img src="images/voltar.png"></a></p>
				
<!--
					<div class="message errormsg" id="erro" style="display:none;"><p>Houve um erro aqui!</p>
					</div>
					
					<div class="message success" id="sucesso" style="display:none;"><p>Os dados foram cadastrados com sucesso!</p></div>
					
					<div class="message info" id="informacao" style="display:none;"><p>Mensagem informativa</p></div>
					
					<div class="message warning" id="cuidado" style="display:none;"><p>Cuidado! Os campos não devem estar em branco.</p></div>
					
-->
					
					<form accept-charset="utf-8" action="?i=pdf&nome=anexob" method="post" enctype="multipart/form-data" id="habilitacoesform" >


<p><h3>Estagiário:</h3>
<select name="AnexosAnexo" id="AnexosAnexo"  class="styled required"   width="100%">
							<option value="1S BET EVALDO DE SOUSA LIMA">1S BET EVALDO DE SOUSA LIMA</option>
</select></p>				
<p><h3>Habilitação:</h3>
<select name="AnexosAnexo" id="AnexosAnexo"  class="styled required"   width="100%">
							<option value="ACC VGL">ACC VGL</option>
</select></p>				
<p><h3>Instrutores:</h3>
<select name="AnexosAnexo" id="AnexosAnexo"  class="styled required" multiple="yes" style="height:30%;width:60%;"  >
							<option value="SO BCT JOTA LUIS">SO BCT JOTA LUIS</option>
							<option value="2S BCT VITA">2S BCT VITA</option>
</select></p>				
						<p>
							
							<label>Prazo:</label>
							<br />

							<input type="text" name="AnexosDocumento" id="AnexosDocumento" class="Datepicker"  /> 
						</p>
						

</head>
<body>
						<input type="hidden" name="action" id="action" value="fichaindicacaoinstrutor" />
						<input type="hidden" name="controller" id="action" value="instrucao" />
						<p>
							<input type="submit" class="submit small" id="AnexosCadastrar" value="Cadastrar" />
							<!--
							<input type="submit" class="submit mid" value="Long submit" />
							<input type="submit" class="submit long" value="Even longer submit" />
							-->
						</p>
					</form>

<script type="text/javascript">
//&lt;![CDATA[

function envia() {
  var dados = $("#habilitacoesform").serialize();
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller/habilitacaocontroller.cfm',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#anexoscadastrados").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados ,
    datatype: 'text',
    contentType: 'application/x-www-form-urlencoded'
  });
 }



//]]&gt;
</script>
<!-- Todas as operações Ajax básicas          -->
<div id="anexoscadastrados">
			
</div>
				</div>		<!-- .block_content ends -->
				
				<div class="bendl"></div>
				<div class="bendr"></div>
					
			</div>		<!-- .block ends -->

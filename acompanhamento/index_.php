<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DECEA ● Consulta de Passagem</title>
    <link rel="shortcut icon" href="http://www.decea.gov.br/wp-content/themes/decea/favicon.ico" />
    <style type="text/css" media="all">
	 @import url("../_lib/templates/admin/css/style.css");
	 @import url("../_lib/templates/admin/css/jquery.wysiwyg.css");
	 @import url("../_lib/templates/admin/css/facebox.css");
	 @import url("../_lib/templates/admin/css/visualize.css");
	 @import url("../_lib/templates/admin/css/date_input.css");
	</style>

    <!--[if lt IE 8]><style type="text/css" media="all">@import url("../_lib/templates/admin/css/ie.css");</style><![endif]-->
 	
 

    </head>

    <body>
<div id="hld">
      <div class="wrapper" id="login"> <!-- wrapper begins -->
    
    <div class="block small center login">
          <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        <h2>Consulta de Passagens Aéreas</h2>       
        
      </div>
          <!-- .block_head ends -->
          
        <div class="block_content">
        <cfparam name="url.msg" default="acesso">
		<cfif StructKeyExists(url,"msg")>
              <cfparam name="tp" default="info">
              <cfsilent>
          <cfswitch expression="#url.msg#">
          <cfcase value="senha">
          <cfset tp = "errormsg" >
          <cfset msg = "Login/Senha não conferem." >
          </cfcase>
              <cfcase value="captcha">
          <cfset tp = "errormsg" >
          <cfset msg = "O código verificador é inválido. Tente novamente." >
          </cfcase>
              <cfcase value="usu">
          <cfset tp = "errormsg" >
          <cfset msg = "Usuário não encontrado." >
          </cfcase>
          <cfcase value="logout">
          	<cfset tp = "success" >
          	<cfset msg = "Você saiu da aplicação de modo seguro. Obrigado e volte sempre!" >
          </cfcase>
          <cfcase value="acesso">
          	<cfset tp = "info" >
          	<cfset msg = "Esse serviço é destinado apenas ao efetivo Militar e Civil do DECEA." >
          </cfcase>
          </cfswitch>
          </cfsilent>
		  <cfinclude template="../_lib/cfm/aviso.cfm">
          </cfif>        <!---<h1><cfoutput>#session.passid#</cfoutput></h1>
        <cfquery datasource="sas" name="u">
        SELECT *
        FROM
        root_usuarios
        where passID = <cfqueryparam value="#session.passID#">
        </cfquery>
        
        <h1><cfoutput>#u.recordcount#</cfoutput></h1>--->

		<form id="passagem" action="rs.cfm" method="post">
        
        <p>Informe seus dados nos campos abaixo.</p>
        
        <p>
        	<label>Identidade</label><br />
			<input type="text" name="identidade" class="text required "  />
        </p>
        <p>
        	<label>Email</label> para receber o localizador<br />
            <input type="text" name="email" class="text required email"  /> 
        </p>
        <p>
        	<label>Celular</label> para receber SMS com localizador (em fase de teste) <br />
            <input type="text" name="celular" class="text celular"  /> 
        </p>
        <cfset Application.applicationname="Passagens">
        <cfinclude template="../_lib/cfm/captchaID.cfm">
        
        <p>
        	<input type="submit" class="submit" value="Consultar" />
        </p>
        
        <p>Dúvidas? <a href="http://servicos.decea.gov.br/sac/index.cfm?a=ascom&c=63">Entre em contato</a></p>
        
        </form>
      
      </div>
          <!-- .block_content ends -->
          
          <div class="bendl"></div>
          <div class="bendr"></div>
        </div>
    <!-- .login ends -->
    
    <div id="footer">
          <p class="left"><a href="http://www.decea.gov.br">www.decea.gov.br</a></p>
          <p class="right">Consulta desenvolvida pela <a title="Assessoria de Comunicação Social do Departamento de Controle do Espaço Aéreo">ASCOM</a>/DECEA em conjunto com o CINDACTA IV - O resultado apresentado é gerado pelo sistema CPA de responsabilidade da SRL/DECEA</p>
        </div>
  </div>
      <!-- wrapper ends --> 
      
    </div>
<!-- #hld ends --> 

<script type="text/javascript" src="../_lib/templates/admin/js/jquery.js"></script> 
<!--[if IE]><script type="text/javascript" src="../_lib/templates/admin/js/excanvas.js"></script><![endif]--> 
<!---	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.img.preload.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.filestyle.mini.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.date_input.pack.js"></script>
---> <script type="text/javascript" src="../_lib/templates/admin/js/facebox.js"></script> 
<!---<script type="text/javascript" src="../_lib/templates/admin/js/jquery.visualize.js"></script> 
<script type="text/javascript" src="../_lib/templates/admin/js/jquery.visualize.tooltip.js"></script> 
<script type="text/javascript" src="../_lib/templates/admin/js/jquery.select_skin.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/ajaxupload.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/jquery.pngfix.js"></script>
	<script type="text/javascript" src="../_lib/templates/admin/js/custom.js"></script>---> 
	<script src="../_lib/js/jquery-validate/jquery.validate.min.js"></script> 
    <script src="../_lib/js/jquery-validate/additional-methods-cpf.min.js"></script>
    <script src="../_lib/js/jquery-validate/localization/messages_ptbr.js"></script>
	<script type="text/javascript" src="../_lib/js/mask/jquery.maskedinput-1.3.min.js"></script>
    
	<script type="text/javascript" src="../_lib/js/qtip/jquery.qtip-1.0.0-rc3.min.js"></script>
    <script type="text/javascript">
	$('.qtip').qtip({ style: { tip: true, position: { corner: { tooltip: 'TopLeft' } } } })
	</script>

	<script>
	$(document).ready(function(){
	  $("#passagem").validate();
	});
	</script>
    
    <script>
    $(document).ready(function(){
      $(".dt").mask("99/99/9999");
      $(".cpf").mask("999.999.999-99");
      $(".celular").mask("(99)9999-9999");
     });
	
    </script>	
    
</body>
</html>

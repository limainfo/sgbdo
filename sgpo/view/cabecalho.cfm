<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		
	<title>SGPO &#9679; Sistema de Gerenciamento de Pessoal Operacional</title>
	
    <style type="text/css" media="all">
		@import url("css/style.css");
		@import url("css/jquery.wysiwyg.css");
		@import url("css/facebox.css");
		@import url("css/visualize.css");
		@import url("css/date_input.css");
    </style>
    
    

	<!--[if lt IE 8]><style type="text/css" media="all">@import url("css/ie.css");</style><![endif]-->
<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/jquery-1.8.2.js" type="text/javascript"></script>
<link rel="stylesheet" href="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/themes/base/jquery.ui.all.css">
<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/ui/jquery.ui.core.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/ui/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/ui/jquery.ui.datepicker.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/ui/js/jquery-ui-1.9.0.custom.min.js" type="text/javascript"></script>
<link href="<cfoutput>#caminho#</cfoutput>js/ui/css/smoothness/jquery-ui-1.9.0.custom.min.css" type="text/css" rel="stylesheet"></script>

<script src="<cfoutput>#caminho#</cfoutput>js/ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>

<script src="<cfoutput>#caminho#</cfoutput>js/jquery.img.preload.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.filestyle.mini.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.wysiwyg.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/facebox.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.visualize.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.visualize.tooltip.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.select_skin.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/ajaxupload.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery.pngfix.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/custom.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/jquery-timeout/timeout.js" type="text/javascript"></script>
<script src="<cfoutput>#caminho#</cfoutput>js/qtip/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>
<link href="<cfoutput>#caminho#</cfoutput>js/Jcrop/css/jquery.Jcrop.css" type="text/css" rel="stylesheet">
<script src="<cfoutput>#caminho#</cfoutput>js/Jcrop/js/jquery.Jcrop.min.js"></script>
<!--
-->


<!--

-->

<!--
-->


</head>



<body>		


	<div id="hld">
	
		<div class="wrapper">		
			
            <!--<div id="topo" style="margin:0px;width:100%;">-->
            <cfparam name="logo_gerencial" default="../../../../_img/logo-gerencial-sgpo.png">
            <cfparam name="sgpoacesso" default="">            
            
            <cfif CompareNoCase(appID,"35A62A8C-903E-86BA-C6D4-0F0DBC9325C7") eq 0 >
            	<div id="topo" style="height:69px;">
                <cfif sgpoacesso eq '' >
		    	<cfset logo_gerencial01 = "../../../../_img/logo-gerencial-ativo.png" >
		    	<cfset logo_gerencial02 = "../../../../_img/logo-gerencial-sgpo.png" >
		<cfelse>
		    	<cfset logo_gerencial01 = "../../../../_img/logo-gerencial.png" >
		    	<cfset logo_gerencial02 = "../../../../_img/logo-gerencial-sgpo-ativo.png" >
		</cfif>
	    </cfif>

		         <style>
				div#panel_logo { padding-left:8px;height:82px;padding-bottom:1px; }
				div#panel_logo a { display:block; float:left; }
			</style>
            
            <div id="panel_logo">
            <cfoutput>#CGI.PATH_INFO#</cfoutput>
            
            <cfif CompareNoCase(appID,"35A62A8C-903E-86BA-C6D4-0F0DBC9325C7") eq 0 >
            	<a href="../../../index.cfm"><img src="<cfoutput>#logo_gerencial01#</cfoutput>" /></a>
	    <cfif  StructKeyExists(u,"tipo")  >
	    	<a href="index.cfm"><img src="<cfoutput>#logo_gerencial02#</cfoutput>" /></a>
	    </cfif>
            </div>
            
            <cfelse>
            <div id="topo">
            
            <h1><a href="index.cfm"><img src="<cfoutput>#logo_gerencial#</cfoutput>" /></a></h1>
            
            </cfif>


	
			<div id="header">
<div class="hdrr"></div>
				<ul id="nav">
				<cfif ListGetAt(menu,1) eq 1 >
					<li><a href="#"><img src="images/menu_gerente01.png">&nbsp;Gerente</a>
						<ul>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Dadossistema&acao=list"><img src="images/menu_gerente02.png">&nbsp;Dados dos Sistemas</a></li>
							<li><a href="javascript:designarestagiario();"><img src="images/menu_gerente03.png">&nbsp;Designar</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Estagi??rio&acao=list"><img src="images/menu_gerente04.png">&nbsp;Estagi??rios</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Estagi??rio&acao=confer??ncia"><img src="images/menu_gerente05.png">&nbsp;Confer??ncia</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Habilita????o&acao=list"><img src="images/menu_gerente05.png">&nbsp;Habilita????es</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Cgna&acao=list"><img src="images/menu_gerente06.png">&nbsp;Proposta CGNA</a></li>
							<!--<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Estagi??rio&acao=list"><img src="images/menu_gerente06.png">&nbsp;Gerar item SIGPES</a></li> -->
						</ul>
					</li>
				</cfif>
				<cfif ListGetAt(menu,2) eq 1 >
					<li><a href="#"><img src="images/menu_instrucao01.png">&nbsp;Se????o de Instru????o</a>
						<ul>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Estagi??rio&acao=list"><img src="images/menu_instrucao03.png">&nbsp;Listar Estagi??rios</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Instrutorestagiario&acao=list"><img src="images/menu_instrucao04.png">&nbsp;Avalia????o final</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Ficha&acao=list&tipo=instru????o"><img src="images/menu_instrucao05.png">&nbsp;Assinar Fichas</a></li>
							<li><a href="#"><img src="images/menu_instrucao08.png">&nbsp;AnexoB-Conselho-ATA</a></li>
						</ul>
					</li>
				</cfif>
				<cfif ListGetAt(menu,3) eq 1 >
					<li><a href="#"><img src="images/menu_instrutor01.png">&nbsp;Instrutor</a>
						<ul>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Ficha&acao=list"><img src="images/menu_instrutor02.png">&nbsp;Avaliar Estagi??rios</a></li>
						</ul>
					</li>
				</cfif>
				<cfif ListGetAt(menu,4) eq 1 >
					<li><a href="#"><img src="images/menu_relatorio01.png">&nbsp;Relat??rios</a>
						<ul>
							<li><a href="#"><img src="images/menu_relatorio02.png">&nbsp;Processo</a>
								<ul>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=estagios3meses&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Acima de 3 meses</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=estagiosaguardaata&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Aguardando ATA</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=estagiosfalta60h&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Falta 60h</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=estagiosfalta10h&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Falta 10h</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=estagiosconcluidos&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Concluidos</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=fichasnaoassinadas&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Fichas n??o assinadas</a></li>
								</ul>
							</li>
							<li><a href="#"><img src="images/menu_relatorio02.png">&nbsp;BIRD</a>
								<ul>
								<li><a href="../../../?i=Relat??rios&d=<cfoutput>#appID#</cfoutput>&nome=bird&view=472361d0-84be-11e2-9e96-0800200c9a77"><img src="images/menu_relatorio02.png">&nbsp;Relat??rios</a></li>
								</ul>
							</li>


							<!--
							<li><a href="#"><img src="images/menu_relatorio02.png">&nbsp;Habilita????o</a>
								<ul>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=habilitacaovencida&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;A vencer</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=habilitacaovencer30dias&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;A vencer em 30 dias</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=habilitacaovencer60dias&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;A vencer em 60 dias</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=habilitacaoorgao&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Por ??rg??o</a></li>
									<li><a href="index.cfm?d=<cfoutput>#appID#</cfoutput>&i=pdf&nome=habilitacaolocalidade&pesquisa=<cfoutput>#urlencode(url.pesquisa)#</cfoutput>"><img src="images/menu_relatorio02.png">&nbsp;Por Localidade</a></li>
								</ul>
							</li>
							-->
							<li><a href="#"></a></li>
						</ul>
					</li>
					</cfif>
				<cfif ListGetAt(menu,5) eq 1 >
					<li><a href="#"><img src="images/menu_parametro01.png">&nbsp;Par??metros</a>
						<ul>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Setor&acao=list"><img src="images/menu_parametro02.png">&nbsp;Setores</a></li>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Anexo&acao=list"><img src="images/menu_parametro03.png">&nbsp;Anexos</a></li>
							<cfif len(u.unidadeResponsavel) lt 10 >
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Perfil&acao=list"><img src="images/menu_parametro04.png">&nbsp;Perfis</a></li>
							</cfif>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=Usu??rio&acao=list"><img src="images/menu_parametro05.png">&nbsp;Usu??rios</a></li>
<cfif u.cpf eq '02566472750'>
							<li><a href="?d=<cfoutput>#appID#</cfoutput>&i=SQL&acao=SQL"><img src="images/menu_parametro05.png">&nbsp;SQL</a></li>
</cfif>
						</ul>
					</li>
				</cfif>

				</ul>
				<p class="user">Seja Bem Vindo, <a href="#"><cfoutput>#REReplace(session.nome,"^(#RepeatString('[^ ]* ',1)#).*","\1")#</cfoutput></a> | <a href="../../../../../id/?i=logout&appID=<cfoutput>#app.appID#</cfoutput>">Sair</a></p>
			</div>		
		

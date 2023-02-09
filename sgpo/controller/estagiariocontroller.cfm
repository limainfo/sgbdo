<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/?i=logout&appID=#app.appID#">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='estagiario' >
<cfset controllernomeplural='estagiarios' >
<cfset controllernomecampo='Estagiarios' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Estagiário">
<cfset controllernomeid='estagiarioID' >
<cfparam name="nrprocesso" default="1000">
	
<cfparam name="sqlUnidadeID" default="">
<cfparam name="sqlRegionalID" default="">
<cfparam name="sqlHabilitacao" default="">
<cfparam name="sqlSetorID" default="">
<cfif len(contenhaUnidadeID) gt 10>
	<cfset sqlUnidadeID=replace(contenhaUnidadeID,'XXXXXXXXXX','ur.unidadeID') >
</cfif>
<cfif len(contenhaRegionalID) gt 10>
	<cfset sqlRegionalID=replace(contenhaRegionalID,'XXXXXXXXXX','ur.regionalID') >
</cfif>
<cfif len(contenhaHabilitacao) gt 10>
	<cfset sqlHabilitacao=replace(contenhaHabilitacao,'XXXXXXXXXX','hs.habilitacao') >
</cfif>
<cfif len(contenhaSetorID) gt 10>
	<cfset sqlSetorID=replace(contenhaSetorID,'XXXXXXXXXX','ss.setorID') >
</cfif>
<cfscript>
//<!-- -------------------------Estagiarios--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	 
	<cfinclude template="../view/listestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfif queryrecordcount(conteudoconsulta) gt 0>
		<cfset status='OK'>
		<cfset mensagemstatus=#conteudoconsulta.recordcount# & ' registro(s) encontrado(s) '>
	<cfelse>
		<cfset status='ERRO'>
		<cfset mensagemstatus='Nenhum registro(s) encontrado(s) '>
	</cfif>

	 
	<cfinclude template="../view/listestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Ver---------------------------->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				se.estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfinclude template="../view/verestagiario.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O estagiario ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluiestagiarios">
		update sgpo_estagiarios set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfscript>
			a=obtemSql(conteudoconsulta);
		</cfscript>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='A informação não pode ser excluída. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
		u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
	

	 
	<cfinclude template="../view/listestagiario.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='veredit' and evaluate('acoes.'& controllernomeplural & '["veredit"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
<cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and se.deleted is null;
	</cfquery>

<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
<cfinclude template="../view/editestagiario.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
		
	<cfinclude template="../view/cadestagiario.cfm">
</cfif>

	
<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='edit' and evaluate('acoes.'& controllernomeplural & '["edit"]')==1 >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset dados = StructNew() >
		
<cftry>	
<!-- ----------------------------------------------- -->

<cfscript>
	tmp = expandPath("../tmp");
	documentos = expandPath("../documentos");

	upload = StructNew();
	if (len(evaluate('Form.' & controllernomecampo & '.Ata')) gt 3 ){
	upload.tipo = GetPageContext().formScope().getUploadResource('#evaluate('Form.' & controllernomecampo & '.Ata')#').getContentType();
	upload.nome = GetPageContext().formScope().getUploadResource('#evaluate('Form.' & controllernomecampo & '.Ata')#').getName();
	}
	limite = 3145728;
	//dump(#upload#);	dump(#form#);
	
</cfscript>
	<cfset problema=0 >
	<cfset arq='' >
	<cfif (cgi.request_method Eq 'post') > 
		<cfset fileInfo = GetFileInfo(evaluate('Form.' & controllernomecampo & '.Ata')) >
		<cfif (fileInfo.size Gt limite) >
			<cfset 	status = 'ERRO'>
			<cfset mensagemstatus = 'O tamanho do arquivo é maior que 3MB. Nada foi registrado! '>
			<cfset problema=1 >
		<cfelse>
			<cfif len(evaluate('Form.' & controllernomecampo & '.Ata')) gt 3 >
			
				<cftry>
					<cffile action="upload" filefield="#evaluate('Form.' & controllernomecampo & '.Ata')#" destination="#documentos#" accept="image/*,application/pdf" nameconflict="Overwrite">
					<cfset arq = "#lcase(createUUID())#">
					<cfif upload.tipo eq "application/pdf" >
					<cffile action="move" source="#documentos#/#upload.nome#" destination="#documentos#/#arq#.pdf" attributes="NORMAL">
					<cfelse>
					<cfexecute name="/usr/bin/convert" timeout="60" arguments="""#documentos#/#upload.nome#"" ""#documentos#/#arq#.pdf""" variable="msgstatus"></cfexecute>
					</cfif>
					<cfpdf action="thumbnail" source="#documentos#/#arq#.pdf" overwrite="yes" pages="1" destination="#documentos#/" resolution="low"  format="jpg"> 					
					<cftry>
						<cfif upload.tipo neq "application/pdf" >
						<cffile action="delete" file="#documentos#/#upload.nome#" >
						</cfif>
					<cfcatch type="any">
						<cfset 	status = 'ERRO'>
						<cfset mensagemstatus = 'O arquivo antigo não pode ser excluído. Informe ao administrador! '>
						<cfset problema=1 >
					</cfcatch>
					</cftry>


				<cfcatch type="any">
						<cfset 	status = 'ERRO'>
						<cfset mensagemstatus = 'Somente são aceitos arquivos menores que 3MB e do tipo imagem ou pdf ! '>
						<cfset problema=1 >
				</cfcatch>
				</cftry>



			</cfif>
			<cfif problema eq 0 >
					
				<cfloop list="#evaluate('Form.' & controllernomecampo & '.estagiarioID')#" index="estagiarioID">
					
					<cfset id=createUUID() >
					<cfif len(arq) gt 4>
						<cfset arq = arq & '.pdf'>
						<cfparam name="editsetores" default="">
						<cfquery name="editsetores" datasource="#dsn#">
						update sgpo_estagiarios set  setorID=<cfqueryparam  value="#form.Estagiarios.SetorID#" cfsqltype="cf_sql_char">,  horasnecessarias=<cfqueryparam  value="#form.Estagiarios.Horasnecessarias#" cfsqltype="cf_sql_integer">,cargateorica=<cfqueryparam  value="#form.Estagiarios.Cargateorica#" cfsqltype="cf_sql_integer">,cargapratica=<cfqueryparam  value="#form.Estagiarios.Cargapratica#" cfsqltype="cf_sql_integer">, ata=<cfqueryparam  value="#arq#" cfsqltype="cf_sql_char">, fimestagio=now(),  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where estagiarioID=<cfqueryparam  value="#form.Estagiarios.EstagiarioID#" cfsqltype="cf_sql_char">
						</cfquery>	
					<cfelse>
						<cfparam name="editsetores" default="">
						<cfquery name="editsetores" datasource="#dsn#">
						update sgpo_estagiarios set  setorID=<cfqueryparam  value="#form.Estagiarios.SetorID#" cfsqltype="cf_sql_char">,  horasnecessarias=<cfqueryparam  value="#form.Estagiarios.Horasnecessarias#" cfsqltype="cf_sql_integer">,cargateorica=<cfqueryparam  value="#form.Estagiarios.Cargateorica#" cfsqltype="cf_sql_integer">,cargapratica=<cfqueryparam  value="#form.Estagiarios.Cargapratica#" cfsqltype="cf_sql_integer">, updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where estagiarioID=<cfqueryparam  value="#form.Estagiarios.EstagiarioID#" cfsqltype="cf_sql_char">
						</cfquery>	
					</cfif>
									

					<cfset status = 'OK'>
					<cfif len(evaluate('Form.' & controllernomecampo & '.Ata')) gt 3>
					<cfset mensagemstatus = 'Informações registradas com sucesso! #upload.nome# enviado com sucesso! '>
					</cfif>
										

		
				</cfloop>
			</cfif>

		</cfif>
		
		
	</cfif>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
				u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
				inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
				where
				(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
				and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
	</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listestagiario.cfm" ></cfsavecontent>
		<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	
<!-- ---------------------------------------------------------------------------------- -->
	
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	 
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfquery name="processo" datasource="#dsn#">
	select numeroprocesso from sgpo_estagiarios order by numeroprocesso desc limit 0,1;
	</cfquery>
	<cfif processo.numeroprocesso gte 1000>
	<cfset nrprocesso=processo.numeroprocesso +1 >
	</cfif> 
	<cfset dados = StructNew() >
		
<cftry>	
		<cfquery name="verifica" datasource="#dsn#">
		select * from sgpo_dadossistemas where nome like <cfqueryparam  value="%#form.Estagiarios.Nome#%" cfsqltype="cf_sql_char"> and cpf=<cfqueryparam  value="#form.Estagiarios.Cpf#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfset existe=queryrecordcount(verifica) >
		<cfif existe eq 1 >

		<cfquery name="insereestagiarios" datasource="#dsn#">
		insert into sgpo_estagiarios (estagiarioID, numeroprocesso,  setorID, dadossistemaID, tipocontrato, cpf, nome, horassimulador, horasnecessarias, obs, inicioestagio, habilitacaoID, funcao, created, usuariocriou, ipcriou, hostcriou) values ('#id#', #nrprocesso#, <cfqueryparam  value="#form.Estagiarios.setorID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.DadossistemaID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Tipocontrato#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Cpf#" cfsqltype="cf_sql_char">, upper(<cfqueryparam  value="#form.Estagiarios.Nome#" cfsqltype="cf_sql_char">), <cfqueryparam  value="#form.Estagiarios.Horassimulador#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Estagiarios.Horasnecessarias#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Estagiarios.Obs#" cfsqltype="cf_sql_char">, now(), <cfqueryparam  value="#form.Estagiarios.HabilitacaoID#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Estagiarios.Funcao#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		
		<cfquery name="atualiza" datasource="#dsn#">
		update sgpo_dadossistemas set designado='S' where dadossistemaID=<cfqueryparam  value="#form.Estagiarios.DadossistemaID#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfset mensagemstatus='#form.Estagiarios.Cpf# - #form.Estagiarios.Nome# designado com sucesso' >
		
		<cfscript>
		hoje=dateformat(now(),'yyyy-mm-dd');
		</cfscript>	
		<cfelse>
			<cfset status='ERRO'>
			<cfset mensagemstatus='Dados não registrados. Motivo: É necessário preencher o campo NOME e CPF com os dados sugeridos. O usuário tem que possuir cadastro no LPNA. '  >
			
		</cfif>		
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
			u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
			inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
			where
			(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
			and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
		<cfsavecontent variable="lista"><cfinclude template="../view/listestagiario.cfm" ></cfsavecontent>
		<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
		
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
	 
</cfif>

<cfscript>
//<!-- -------------------------verdesigna--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='vercaddesigna' and evaluate('acoes.'& controllernomeplural & '["verdesigna"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select * from sgpo_estagiarios where estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char"> and deleted is null and designado is null order by updated desc, created desc;
	</cfquery>
	<cfinclude template="../view/caddesignacao.cfm">
</cfif>


<cfscript>
//<!-- -------------------------caddesignacao--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='caddesignacao' and evaluate('acoes.'& controllernomeplural & '["caddesignacao"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cfset url.acao='list'>
		<cfquery name="processo" datasource="#dsn#">
		select numeroprocesso from sgpo_estagiarios order by numeroprocesso desc limit 0,1;
		</cfquery>
		<cfif processo.numeroprocesso gte 1000>
		<cfset nrprocesso=processo.numeroprocesso +1 >
		</cfif> 
<cftry>	
		<cfquery name="insereestagiarios" datasource="#dsn#">
		insert into sgpo_estagiarios (estagiarioID, regionalID, setorID, estagiarioID, tipocontrato, cpf, nome, horassimulador,horasnecessarias, obs, inicioestagio, numeroprocesso, habilitacaoID, funcao, created, usuariocriou, ipcriou, hostcriou) values ('#id#', <cfqueryparam  value="#form.Estagiarios.RegionalID#" cfsqltype="cf_sql_char">,  <cfqueryparam  value="#form.Estagiarios.SetorID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.EstagiarioID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Tipocontrato#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Cpf#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Nome#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Estagiarios.Horassimulador#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Estagiarios.Horasnecessarias#" cfsqltype="cf_sql_integer">,  <cfqueryparam  value="#form.Estagiarios.obs#" cfsqltype="cf_sql_char">, now(), '#nrprocesso#', <cfqueryparam  value="#form.Estagiarios.HabilitacaoID#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Estagiarios.Funcao#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		
		<cfquery name="atualiza" datasource="#dsn#">
		update sgpo_estagiarios set designado='S' where estagiarioID=<cfqueryparam  value="#form.Estagiarios.EstagiarioID#" cfsqltype="cf_sql_char">;
		</cfquery>
		
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
		u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
		where
		(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and ds.deleted is null and ds.designado is null order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;	</cfquery>
		<cfset mensagemstatus='#form.Estagiarios.Cpf# - #form.Estagiarios.Nome# designado com sucesso' >
	<cfscript>
		a=obtemSql(conteudoconsulta);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	 
<cfinclude template="../view/listestagiario.cfm">
</cfif>
<cfscript>
//<!-- -------------------------pdf--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='pdf' >
	<cfset status='OK'>
	<cfinclude template='../pdf/anexod.cfm' >		
</cfif>
<cfscript>
//<!-- -------------------------assinagerente--------------------------  -->
</cfscript>
<cfif Form.controller=='estagiarios' and Form.action=='assinagerente' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Estágio conferido!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfset dados = StructNew() >
		
<cftry>	

	<cfquery name="atualiza" datasource="#dsn#">
		update sgpo_estagiarios set assinaturagerente=<cfqueryparam  value="#u.usuarioID#" cfsqltype="cf_sql_char"> where estagiarioID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
	</cfquery>
		
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
				select se.*, concat(ur.jurisdicao,' ',ur.nome,' ',ss.nome,' ',ss.regiao) as regional,
			u.nome as unidade, ss.nome as nomesetor, hs.* from sgpo_estagiarios se
				left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
				left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
				left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)
			inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID #sqlHabilitacao#)
			where
				se.ata is not null and se.fimestagio is not null and se.assinaturagerente is null
			and se.deleted is null order by se.updated desc, se.created desc, regional asc, unidade asc, nomesetor asc, nome;
		</cfquery>
		<cfinclude template="../view/listestagiario.cfm" >
	 
</cfif>

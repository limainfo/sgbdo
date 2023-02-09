<cfif not StructKeyExists(session,"id") >
		<cfset status='ERRO'>
		<cfset mensagemstatus='O tempo da conexão terminou. <a href="../../../../../id/index.cfm?appID=35A62A8C-903E-86BA-C6D4-0F0DBC9325C7&bug=1&session=0">Log in novamente.</a>' >
		<cfinclude template="../view/fimsessao.cfm">
		<cfabort>		
</cfif>
<cfset id=CreateUUID()>
<cfparam name="Form.controller" default="">	
<cfparam name="conteudoconsulta" default="">	
<cfset controllernome='ficha' >
<cfset controllernomeplural='fichas' >
<cfset controllernomecampo='Fichas' >
<cfparam name="url.pesquisa" default="">
<cfset url.i="Ficha">
<cfset controllernomeid='fichaID' >
<cfparam name="nrprocesso" default="1000">

<cfscript>
//<!-- -------------------------Fichas--------------------------  -->
//<!-- -------------------------list--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='list' and evaluate('acoes.'& controllernomeplural & '["list"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfparam name="completasql" default="">
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf
		inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) 
		inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) 
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
		</cfquery>
	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
		</cfquery>
			<cfquery datasource="#dsn#" name="qtdestagiarios">
				select * from sgpo_estagiarios where fimestagio is null and ata is null and deleted is null order by nome asc;
			</cfquery>
			<cfparam name="totalestagiarios" default=0>
			<cfset totalestagiarios=queryrecordcount(qtdestagiarios) >
			<cfif totalestagiarios gt 0 >
				<cfset status='WARNING'>
				<cfset mensagemstatus='HÁ <b>' & totalestagiarios & '</b> ESTAGIÁRIO(S) AGUARDANDO AVALIAÇÃO! PROCURE REALIZAR AS AVALIAÇÕES! CADASTRE UMA FICHA DE AVALIAÇÃO!' >
				<cfloop query="qtdestagiarios">
				<cfset mensagemstatus = mensagemstatus & '<br>' & qtdestagiarios.nome >
				</cfloop>
			</cfif>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	

	<cfinclude template="../view/listficha.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Busca--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='busca' and evaluate('acoes.'& controllernomeplural & '["busca"]')==1 >
	<cfset url.acao="list">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.pesquisa=#Form.busca#>
	<cfset url.pagina='1' >
	
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(se.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#form.busca#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
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

	<cfinclude template="../view/listficha.cfm">
</cfif>

<cfscript>
//<!-- -------------------------Ver---------------------------->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='ver' and evaluate('acoes.'& controllernomeplural & '["ver"]')==1 >
	<cfset url.acao="ver">
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(sf.fichaID=<cfqueryparam  value="%#form.id#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
	<cfinclude template="../view/verficha.cfm">
</cfif>


<cfscript>
//<!-- -------------------------exclui--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='exclui' and evaluate('acoes.'& controllernomeplural & '["exclui"]')==1 >
	<cfset url.acao="exclui">
	<cfset status='OK'>
	<cfset mensagemstatus = 'O ficha ->' & #form.nome# & ' foi excluído com sucesso!'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="excluifichas">
		update sgpo_fichas set deleted=now(), usuariodeletou='#u.usuarioID#', ipdeletou='#cgi.remote_addr#', hostdeletou='#cgi.remote_host#' where fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
		</cfquery>
		<cfquery datasource="#dsn#" name="excluifichas">
		delete from sgpo_fichaanexos where fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">;
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
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
		</cfquery>
	

	<cfinclude template="../view/listficha.cfm">
</cfif>


<cfscript>
//<!-- -------------------------veredit--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='vereditdesativado'>
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cftry>	
		<cfquery datasource="#dsn#" name="conteudoconsulta">
			select sf.*,sds.*, se.*, hs.habilitacao as habilitacao, ur.*, ss.*, ss.nome as nomesetor, ur.nome as unidade from sgpo_fichas sf 
			inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) 
			inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) 
			inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
			inner join unidades_regionais ur on (ur.regionalID=se.regionalID)
			left join sgpo_setores ss on (ss.unidadeID=ur.unidadeID and ss.regionalID=ur.regionalID)
			where
			(sf.fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">) 
			and sf.deleted is null 
			group by sf.fichaID
			order by sf.updated desc, sf.created desc;
		</cfquery>
	<cfcatch type="any">
		<cfset status='ERRO'>
		<cfset mensagemstatus='Erro na consulta. Motivo:' & CFCATCH.Message >
		<cfset conteudo=''>
	</cfcatch>	
	</cftry>	
<cfinclude template="../view/editficha.cfm">
</cfif>

<cfscript>
//<!-- -------------------------vercad--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='vercad' and evaluate('acoes.'& controllernomeplural & '["vercad"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
		
	<cfinclude template="../view/cadficha.cfm">
</cfif>
	
<cfscript>
//<!-- -------------------------edit--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='editdesativado'>
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
<cftry>	
<cfparam name="editsetores" default="">
		<cfquery name="editsetores" datasource="#dsn#">
		update sgpo_fichas set  regionalID=<cfqueryparam  value="#form.Fichas.RegionalID#" cfsqltype="cf_sql_char">, setorID=<cfqueryparam  value="#form.Fichas.SetorID#" cfsqltype="cf_sql_char">,  horasnecessarias=<cfqueryparam  value="#form.Fichas.Horasnecessarias#" cfsqltype="cf_sql_integer">,cargateorica=<cfqueryparam  value="#form.Fichas.Cargateorica#" cfsqltype="cf_sql_integer">,cargapratica=<cfqueryparam  value="#form.Fichas.Cargapratica#" cfsqltype="cf_sql_integer">,  updated=now(), usuariomodificou='#u.usuarioID#', ipmodificou='#cgi.remote_addr#', hostmodificou='#cgi.remote_host#' where fichaID=<cfqueryparam  value="#form.Fichas.EstagiarioID#" cfsqltype="cf_sql_char">
		</cfquery>	
	<cfscript>
		a=obtemSql(editsetores);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null 
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
	</cfquery>
<cfinclude template="../view/listficha.cfm">
</cfif>

<cfscript>
//<!-- -------------------------cad--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='cad' and evaluate('acoes.'& controllernomeplural & '["cad"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.acao='list'>
	<cfset problema=0 >
	<cfscript>
	hoje=dateformat(now(),'yyyy-mm-dd');
	</cfscript>	

<cfscript>
	if(not isdate(evaluate('Form.' & controllernomecampo & '.Dtavaliacao'))){
		evaluate('Form.' & controllernomecampo & '.Dtavaliacao = hoje');
		mensagemstatus = 'Por não ter sido informada a data, o sistema utilizou a data de hoje:'& dateformat(hoje,'dd-mm-yyyy');
	}
	if(len(evaluate('Form.' & controllernomecampo & '.Documento')) lt 5 and len(evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')) lt 5  ){
		problema = 1;
		status = 'ERRO';
		mensagemstatus = 'Deve existir algum documento ou anexo!';
		
	}
	if(not structkeyexists(evaluate('Form.' & controllernomecampo),'EstagiarioID')){
		problema = 1;
		status = 'ERRO';
		mensagemstatus = 'É obrigatório informar o estagiário!';
		
	}
	tmp = expandPath("../tmp");
	documentos = expandPath("../documentos");

	upload = StructNew();
	if (len(evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')) gt 3 ){
	upload.tipo = GetPageContext().formScope().getUploadResource('#evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')#').getContentType();
	upload.nome = GetPageContext().formScope().getUploadResource('#evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')#').getName();
	}
	limite = 3145728;
	//dump(#upload#);	dump(#form#);
	
</cfscript>
	<cfset arq='' >
	<cfif (cgi.request_method Eq 'post') and problema eq 0 > 
		<cfset fileInfo = GetFileInfo(evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')) >
		<cfif (fileInfo.size Gt limite) >
			<cfset 	status = 'ERRO'>
			<cfset mensagemstatus = 'O tamanho do arquivo é maior que 3MB. Nada foi registrado! '>
			<cfset problema=1 >
		<cfelse>
			<cfif len(evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')) gt 3 and problema eq 0 >
			
				<cftry>
					<cffile action="upload" filefield="#evaluate('Form.' & controllernomecampo & '.Documentocomprobatorio')#" destination="#documentos#" accept="image/*,application/pdf" nameconflict="Overwrite">
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
					</cfif>

					<cfquery name="inseredadossistemas" datasource="#dsn#">insert into sgpo_fichas (fichaID, estagiarioID, dtavaliacao, documentocomprobatorio, documento, tipoavaliacao, obs, tempototal, created, usuariocriou, ipcriou, hostcriou) values ("#id#", <cfqueryparam  value="#estagiarioID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Dtavaliacao#" cfsqltype="cf_sql_date">, <cfqueryparam  value="#arq#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Documento#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Tipoavaliacao#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.obs#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Tempototal#" cfsqltype="cf_sql_integer">,  now(), "#u.usuarioID#", "#cgi.remote_addr#","#cgi.remote_host#")
					</cfquery>
					<cfquery name="atualizahoras" datasource="#dsn#">
					update sgpo_estagiarios set horasconcluidas=(select sum(tempototal) from sgpo_fichas where estagiarioID=<cfqueryparam  value="#estagiarioID#" cfsqltype="cf_sql_char"> group by estagiarioID) where estagiarioID=<cfqueryparam  value="#estagiarioID#" cfsqltype="cf_sql_char">;
					</cfquery>
					<cfif len(form.Fichas.Documento) gt 5 >
					<cfset fichaanexoid=createUUID() >
					<cfquery name="criaanexos" datasource="#dsn#">
					insert into sgpo_fichaanexos (fichaanexoID, fichaID, anexoID, created, usuariocriou, ipcriou, hostcriou)
					(select '#fichaanexoid#', '#id#', anexoID,  now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#' from sgpo_anexos where concat(documento,' - anexo ', anexo)=<cfqueryparam  value="#form.Fichas.Documento#" cfsqltype="cf_sql_char"> order by item asc, sequenciaitem asc)  
					</cfquery>
					
					<cfset status = 'OK'>
					<cfif len(form.Fichas.Documentocomprobatorio) gt 3>
					<cfset mensagemstatus = 'Informações registradas com sucesso! #upload.nome# enviado com sucesso! '>
					<cfelse>
					<cfset mensagemstatus = 'Informações registradas com sucesso! Anexo gerado com sucesso! '>
					</cfif>
										
					</cfif>

		
				</cfloop>
			</cfif>

		</cfif>
	</cfif>
	<cfset dados = StructNew() >
	<cfset StructInsert(dados, 'status', status, 'TRUE')>
	<cfset StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >
	<cfif problema eq 0 >
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao from sgpo_fichas
		sf inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) 
		inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID) 
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 
		where
		(se.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or se.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">  or sds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or hs.habilitacao like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and sf.deleted is null order by sf.updated desc, sf.created desc;
	</cfquery>
	<cfsavecontent variable="lista"><cfinclude template="../view/listficha.cfm" ></cfsavecontent>
	<cfset StructInsert(dados, 'conteudo', lista , 'TRUE') >
	</cfif>
		
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfabort>
	
</cfif>

<cfscript>
//<!-- -------------------------dicaficha--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='dicaficha' and evaluate('acoes.'& controllernomeplural & '["dicaficha"]')==1 >
	<cfset status='OK'>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select areaavaliada, dicaareaavaliada, #form.tipo# from sgpo_anexos where anexoID=<cfqueryparam cfsqltype="CF_SQL_VARCHAR" value="#form.id#">;
	</cfquery>
	<cfinclude template="../view/dicaficha.cfm">
</cfif>

<cfscript>
//<!-- -------------------------removeassinatura--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='removeassinatura' and evaluate('acoes.'& controllernomeplural & '["marcaficha"]')==1 >
	<cfset dados = StructNew() >
	<cftry>
	<cfquery datasource="#dsn#" name="atualiza">
		update sgpo_fichas set assinaturainstrucao=null, assinaturainstrutor=null where  fichaID=<cfqueryparam cfsqltype="CF_SQL_CHAR" value="#form.id#">;
	</cfquery>
	<cfset sucesso = StructInsert(dados, 'status', 'OK', 'TRUE')>
	<cfset sucesso = StructInsert(dados, 'mensagemstatus', 'Assinatura removida.', 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	<cfcatch type="any">
	<cfset sucesso = StructInsert(dados, 'status', 'ERRO', 'TRUE')>
	<cfset sucesso = StructInsert(dados, 'mensagemstatus', 'Assinatura não removida.', 'TRUE') >
	<cfcontent type="application/x-json"><cfoutput>#serializeJSON(dados, true)#</cfoutput></cfcontent>
	</cfcatch>
	</cftry>
	<cfabort>
</cfif>

<cfscript>
//<!-- -------------------------marcaficha--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='marcaficha' and evaluate('acoes.'& controllernomeplural & '["marcaficha"]')==1 >
	<cfset status='OK'>
	<cftry>
	<cfquery datasource="#dsn#" name="atualiza">
		update sgpo_fichaanexos set otimo=null, bom=null, regular=null, naosatisfatorio=null, naoatribuido=null
		where
		anexoID=<cfqueryparam cfsqltype="CF_SQL_CHAR" value="#form.anexoID#">
		and  fichaID=<cfqueryparam cfsqltype="CF_SQL_CHAR" value="#form.fichaID#">;
	</cfquery>
	<cfquery datasource="#dsn#" name="atualiza">
		update sgpo_fichaanexos set #form.tipo#=1
		where 
		anexoID=<cfqueryparam cfsqltype="CF_SQL_CHAR" value="#form.anexoID#">
		and  fichaID=<cfqueryparam cfsqltype="CF_SQL_CHAR" value="#form.fichaID#">;
	</cfquery>
		<cfoutput>{'status':'OK'}</cfoutput>
	<cfcatch type="any">
		<cfoutput>{'status':'ERRO','mensagem':'O item não foi marcado.'}</cfoutput>
	</cfcatch>
	</cftry>
	<cfabort>
</cfif>

<cfscript>
//<!-- -------------------------assinaficha--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='assinaficha' and evaluate('acoes.'& controllernomeplural & '["assinaficha"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='' >
	<cfset url.pagina='1'>
	<cfif len(form.Posicao) lt 4 >
	<cfset status = 'ERRO' >
	<cfset mensagemstatus='Preencha o campo posição. ' >
	</cfif>
	<cfif form.Tempototal eq 0 >
	<cfset status = 'ERRO' >
	<cfset mensagemstatus = mensagemstatus & 'O tempo total não pode ser zero. ' >
	</cfif>
	<cfif len(form.Setor) lt 2 >
	<cfset status = 'ERRO' >
	<cfset mensagemstatus = mensagemstatus & 'O setor deve ser informado. ' >
	</cfif>
	<cfif StructKeyExists(form,"rendimento") >
		<cfif form.rendimento gt 0 and form.rendimento gt 10 or form.rendimento eq ''>
		<cfset status = 'ERRO' >
		<cfset mensagemstatus = mensagemstatus & 'O valor do rendimento não pode ser vazio ou maior que 10. ' >
		</cfif>
	</cfif>
	<cfquery datasource="#dsn#" name="listaitens">
		select * from sgpo_fichas sf left join sgpo_fichaanexos sfa on (sfa.fichaID=sf.fichaID) where sf.fichaID=<cfqueryparam  value="#form.ficha#" cfsqltype="cf_sql_char">;
	</cfquery>
	<cfparam name="qtdotimo" default=0>			
	<cfparam name="qtdbom" default=0>			
	<cfparam name="qtdregular" default=0>			
	<cfparam name="qtdnaosatisfatorio" default=0>	
	<cfif len(listaitens.documentocomprobatorio)<10>
	<cfloop query="listaitens">
		<cfif otimo gt 0>
		<cfset qtdotimo =  qtdotimo+1 >
		</cfif>
		<cfif bom gt 0>
		<cfset qtdbom =  qtdbom+1 >
		</cfif>
		<cfif regular gt 0>
		<cfset qtdregular =  qtdregular+1 >
		</cfif>
		<cfif naosatisfatorio gt 0>
		<cfset qtdnaosatisfatorio =  qtdnaosatisfatorio+1 >
		</cfif>
	</cfloop>
	<cfif (qtdotimo + qtdbom + qtdregular + qtdnaosatisfatorio) eq 0 >
		<cfset status = 'ERRO' >
		<cfset mensagemstatus = mensagemstatus & 'Nenhum item de avaliação foi marcado. ' >
	</cfif>
	</cfif>
	
	<cfif status eq 'OK' >
	
			<cfquery datasource="#dsn#" name="atualizaficha">
				update sgpo_fichas set #form.tipo#=<cfqueryparam  value="#form.assinatura#" cfsqltype="cf_sql_char">, setor=<cfqueryparam  value="#form.setor#" cfsqltype="cf_sql_char">, posicao=<cfqueryparam  value="#form.posicao#" cfsqltype="cf_sql_char">, tempototal=<cfqueryparam  value="#form.tempototal#" cfsqltype="cf_sql_integer">, obs=<cfqueryparam  value="#form.obs#" cfsqltype="cf_sql_char"> where fichaID=<cfqueryparam  value="#form.ficha#" cfsqltype="cf_sql_char">
			</cfquery>
			<cfif StructKeyExists(form,"rendimento") >
				<cfset rendimento=form.rendimento>
				<cfelse>
				<cfset rendimento = (qtdotimo*4 + qtdbom*2 + qtdregular)/(qtdotimo + qtdbom + qtdregular + qtdnaosatisfatorio)+6 >
			</cfif>
			<cfset camporendimento = ''>
			<cfset camporendimentoletra = ''>
			<cfif rendimento lt 7 >
				<cfset camporendimentoletra = 'NS'>
			</cfif>
			<cfif rendimento gte 7 and rendimento lt 8 >
				<cfset camporendimentoletra = 'R'>
			</cfif>
			<cfif rendimento gte 8 and rendimento lt 9 >
				<cfset camporendimentoletra = 'B'>
			</cfif>
			<cfif rendimento gte 9 >
				<cfset camporendimentoletra = 'O'>
			</cfif>
			<cfset camporendimento = decimalformat(rendimento) >
			<cfquery datasource="#dsn#" name="atualizaficha">
				update sgpo_fichas set rendimento=<cfqueryparam  value="#camporendimento#" cfsqltype="cf_sql_char">, rendimentoletra=<cfqueryparam  value="#camporendimentoletra#" cfsqltype="cf_sql_char"> where fichaID=<cfqueryparam  value="#form.ficha#" cfsqltype="cf_sql_char">
			</cfquery>
			<cfquery datasource="#dsn#" name="atualizaficha">
				update sgpo_estagiarios set horasconcluidas=(select sum(tempototal) from sgpo_fichas where estagiarioID=<cfqueryparam  value="#listaitens.estagiarioID#" cfsqltype="cf_sql_char"> group by estagiarioID ) where estagiarioID=<cfqueryparam  value="#listaitens.estagiarioID#" cfsqltype="cf_sql_char">
			</cfquery>
			<cfset mensagemstatus='Ficha assinada! Rendimento calculado:' & camporendimento & ' - ' & camporendimentoletra >
		</cfif>
			<cfset dados = StructNew() >
			<cfset sucesso = StructInsert(dados, 'status', status, 'TRUE')>
			<cfset sucesso = StructInsert(dados, 'mensagemstatus', mensagemstatus, 'TRUE') >

			<cfcontent type="application/x-json">
			<cfoutput>#serializeJSON(dados, true)#</cfoutput>
			</cfcontent>
			<cfabort>
	<cfscript>
	//dump(#u#);
	</cfscript>
	<cfinclude template="../view/avaliaficha.cfm">
</cfif>



<cfscript>
//<!-- -------------------------avaliaficha--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='avaliaficha' and evaluate('acoes.'& controllernomeplural & '["avaliaficha"]')==1 >
	<cfset status='OK'>
	<cfset url.pagina=#Form.pagina#>
	<cfquery datasource="#dsn#" name="conteudoconsulta">
		select sf.*,sds.*, se.*, hs.habilitacao as habilitacao, ur.*, ss.*, c.licenca licenca, ss.nome nomesetor from sgpo_fichas sf 
		inner join sgpo_estagiarios se on (se.estagiarioID=sf.estagiarioID) 
		inner join sgpo_dadossistemas sds on (sds.dadossistemaID=se.dadossistemaID)
		inner join cadastros c on (c.cpf=sds.cpf) 
		inner join habilitacoes_select hs on (hs.habID=se.habilitacaoID) 

		left join sgpo_setores ss on (ss.setorID=se.setorID #sqlSetorID#)
		left join unidades_regionais ur on (ss.regionalID=ur.regionalID #sqlRegionalID#)
		left join unidades u on (ur.unidadeID=u.unidadeID #sqlUnidadeID#)

		where
		sf.fichaID=<cfqueryparam  value="#form.id#" cfsqltype="cf_sql_char">
		and sf.deleted is null
		group by sf.fichaID
		order by sf.updated desc, sf.created desc;
	</cfquery>
	<cfscript>
	//dump(#u#);
	</cfscript>
	<cfinclude template="../view/avaliaficha.cfm">
</cfif>


<cfscript>
//<!-- -------------------------caddesignacao--------------------------  -->
</cfscript>
<cfif Form.controller=='fichas' and Form.action=='caddesignacao' and evaluate('acoes.'& controllernomeplural & '["caddesignacao"]')==1 >
	<cfset status='OK'>
	<cfset mensagemstatus='Dados registrados com sucesso!' >
	<cfset url.pagina=#Form.pagina#>
	<cfset url.i='Estagiario'>
	<cfset url.pesquisa = urldecode(url.pesquisa) >
	<cfset url.acao='list'>
		<cfquery name="processo" datasource="#dsn#">
		select numeroprocesso from sgpo_fichas order by numeroprocesso desc limit 0,1;
		</cfquery>
		<cfif processo.numeroprocesso gte 1000>
		<cfset nrprocesso=processo.numeroprocesso +1 >
		</cfif> 
<cftry>	
		<cfquery name="inserefichas" datasource="#dsn#">
		insert into sgpo_fichas (fichaID, regionalID, setorID, fichaID, tipocontrato, cpf, nome, horassimulador,horasnecessarias, obs, inicioestagio, numeroprocesso, habilitacaoID, funcao, created, usuariocriou, ipcriou, hostcriou) values ('#id#', <cfqueryparam  value="#form.Fichas.RegionalID#" cfsqltype="cf_sql_char">,  <cfqueryparam  value="#form.Fichas.SetorID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.EstagiarioID#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Tipocontrato#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Cpf#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Nome#" cfsqltype="cf_sql_char">, <cfqueryparam  value="#form.Fichas.Horassimulador#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Fichas.Horasnecessarias#" cfsqltype="cf_sql_integer">,  <cfqueryparam  value="#form.Fichas.obs#" cfsqltype="cf_sql_char">, now(), '#nrprocesso#', <cfqueryparam  value="#form.Fichas.HabilitacaoID#" cfsqltype="cf_sql_integer">, <cfqueryparam  value="#form.Fichas.Funcao#" cfsqltype="cf_sql_char">, now(), '#u.usuarioID#', '#cgi.remote_addr#','#cgi.remote_host#')
		</cfquery>
		
		<cfquery name="atualiza" datasource="#dsn#">
		update sgpo_fichas set designado='S' where fichaID=<cfqueryparam  value="#form.Fichas.EstagiarioID#" cfsqltype="cf_sql_char">;
		</cfquery>
		
		<cfquery datasource="#dsn#" name="conteudoconsulta">
		select ds.nome, ds.sistema, ds.fichaID, ds.cpf, ds.identidade, ds.matricula, ds.dtmovimentacao,
		ds.dtdesligamento, ds.dtapresentacao, ds.tipocontrato, ds.designado, ur.jurisdicao as regional,
		u.nome as unidade, ss.nome as nomesetor from sgpo_fichas ds
		inner join unidades_regionais ur on (ds.regionalID=ur.regionalID)
		inner join unidades u on (ur.unidadeID=u.unidadeID)
		left join sgpo_setores ss on (ss.regionalID=ur.regionalID and ss.unidadeID=u.unidadeID)
		where
		(ds.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.cpf like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or ds.identidade like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or matricula like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char"> or u.nome like <cfqueryparam  value="%#url.pesquisa#%" cfsqltype="cf_sql_char">) 
		and ds.deleted is null and ds.designado is null order by ds.updated desc, ds.created desc, regional asc, unidade asc, nomesetor asc, nome;	</cfquery>
		<cfset mensagemstatus='#form.Fichas.Cpf# - #form.Fichas.Nome# designado com sucesso' >
	<cfscript>
		a=obtemSql(conteudoconsulta);
	</cfscript>
<cfcatch type="any">
	<cfset status='ERRO'>
	<cfset mensagemstatus='Dados não registrados. Motivo:' & CFCATCH.Message >
	<cfset conteudo=''>
</cfcatch>	
</cftry>	
<cfinclude template="../view/listficha.cfm">
</cfif>

<!--#INCLUDE FILE="util/connDB.asp"-->
<!--#INCLUDE FILE="adovbs.inc"-->
<!--#INCLUDE FILE="json.asp"-->
<!--#INCLUDE FILE="jsonutil.asp"-->
<%
Dim sql, rs
%>
<%response.ContentType="text/plain"%>

<%
'and ctpr.TRECHO_UTILIZADO='S'
ostratada = request("os")
fim = InStr(1,request("os"),"_")
if fim>2 then
ostratada = Mid(request("os"),1,fim-1)
end if

	    sql = " select sum(ctpr.valor) as valor, sum(ctpr.tarifa) as tarifa, sum(ctpr.valor_seguro) as seguro," & vbCrLf _
	    & " sum(ctpr.valor_excesso) as excesso, CPR.ID_PES_REQ as reqid, crp.NUM_REQUISICAO as numrequisicao,COR.NUMERO as numero, crp.SIGLA_ORGAO_SETOR_EMIS as sigla from cpa.CPA_PESSOAL_REQUISICAO cpr" & vbCrLf _
	    & " inner join CPA.CPA_ORDEM_REQUISICAO cor on (COR.ID_ORDEM_REQ=cpr.ID_ORDEM_REQ) " & vbCrLf _
	    & " inner join cpa.CPA_REQUISICAO_PASSAGEM crp on (crp.ID_REQUISICAO=cor.ID_REQUISICAO)" & vbCrLf _
	    & " inner join cpa.CPA_TRECHOS_PASSAGEM_REAL ctpr on (cpr.ID_PES_REQ=ctpr.ID_PES_REQ)" & vbCrLf _
	    & " where cor.NUMERO=" & ostratada & " and (cor.TIPO_DOC='OS'  OR cor.TIPO_DOC='SOBREAVISO') and (crp.SIGLA_ORGAO_SETOR_EMIS='DACTA4' or crp.SIGLA_ORGAO_SETOR_EMIS='P-DACTA4') " & vbCrLf _
	    & " and crp.ANO=" & request("ano") & " and crp.REQ_CONSOLIDADA='S' and ctpr.COD_LOCAL_INI<>'CNL' " & vbCrLf _
	    & " group by CPR.ID_PES_REQ,crp.NUM_REQUISICAO, cor.NUMERO, crp.SIGLA_ORGAO_SETOR_EMIS" 
	    %>

	    <%
 		 OpenConnDB()
	   
	    on error resume next
 		 QueryToJSON(Session("dataConn"), sql).Flush
 		 
			'response.write(sql)
			
 		 CloseConnDB()
 		 

%>      

 
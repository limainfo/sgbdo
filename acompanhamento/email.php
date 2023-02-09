<cftry>
     <cfmail bcc="ximenesjx@decea.gov.br" to="#form.email#" from="DECEA <web@decea.gov.br>" subject="Consulta de passagem" type="html">
        <p>Segue uma cópia do registro realizado em #lsdateformat(now(),"dd/mm/yyyy")# às #lstimeformat(DateAdd("h",-3,now()),"HH:mm")#:</p>
        #form.txt#
      </cfmail>
        		<cfset ok = '{"ok":1}'>
        		<cfcatch type="any">
        		<cfset ok = '{"ok":0}'>
        		</cfcatch>

</cftry>
<cfoutput>#ok#</cfoutput>
<cfabort>      
select subetapa.display, os.resumo_servico, os.os,
#concat_ws(' ', posto,especialidade, nome_completo) ,  
#concat(cidade.cidade,'/',cidade.uf) as cid, 
pernoite.saida_data, pernoite.regresso_data, 
evento.display, sum(diaria_qtd) diaria_qtd, (diaria_qtd * diaria_estimada) as valor, 
 passagem_valor
from 
pernoite
inner join os on ( os.id_os=pernoite.id_os and pernoite.id_nd=5  )
inner join evento on ( evento.id_evento=os.id_evento )
inner join subetapa on ( subetapa.id_subetapa=evento.id_subetapa )
#inner join etapa on ( etapa.id_etapa=subetapa.id_etapa and etapa.id_etapa=7318 and etapa.id_meta=2448 )
#inner join cidade on ( cidade.id_cidade=os.id_cidade )
inner join servidor on ( servidor.id=pernoite.id_servidor )
#left join posto on ( servidor.id_posto=posto.id_posto )
#left join especialidade on ( servidor.id_especialidade=especialidade.id_especialidade )
#inner join os_debito on ( os.id_os=os_debito.id_os  and os_debito.data_debito >= '2013-01-01' and  os_debito.data_debito <= '2013-05-14' )
inner join identificador on ( identificador.id_identificador=os.id_identificador )
inner join exercicio on ( exercicio.id_exercicio=identificador.id_exercicio and exercicio.id_exercicio=213 )

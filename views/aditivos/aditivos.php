<?php
//2011-07-13 Missão DECEA - SDAD - após reunião no PAME-RJ
//Os vetores abaixo foram criados para atender "Sistema PEL.xls" (1S MONTEIRO - DECEA)
//e tabelas do sht em http://10.52.152.14/sht/    usuario: adriano  senha: 123456
//Para usar os vetores inclua a linha abaixo no arquivo da view
//include $caminhoAditivos;

$tbl_documentos['CREA']='CREA';
$tbl_documentos['CERTIFICADO EEAR']='CERTIFICADO EEAR';
$tbl_documentos['CURSO ATM05']='CURSO ATM05';
$tbl_documentos['CURSO CNS005']='CURSO CNS005';
$tbl_documentos['CERTIFICADO RECONHECIDO PELO MEC']='CERTIFICADO RECONHECIDO PELO MEC';

$sexos['']='';
$sexos['M']='M';
$sexos['F']='F';

$categorias['1']='ESP-APP/TWR';
$categorias['2']='A (FIS/AFIS/ALERTA IFR)';
$categorias['3']='B (MSG)';
$categorias['4']='C (AUXÍLIOS)';
$categorias['5']='M (PLATAFORMA)';


$tipos_licencas['0']='Selecione';
$tipos_licencas['ATCO']='ATCO';
$tipos_licencas['OEA']='OEA';
//$tipos_licencas['OSAR']='OEA';
$tipos_licencas['TECNICO']='TECNICO';
$tipos_licencas['RPM']='RPM';
$tipos_licencas['OCOAM']='OCOAM';
$tipos_licencas['SMC']='SMC';
$tipos_licencas['CRCC']='CRCC';
$tipos_licencas['ORCC']='ORCC';

$situacaoMilitar['ATIVA']='ATIVA';
$situacaoMilitar['R/R']='R/R';
$situacaoMilitar['LICENCIADO']='LICENCIADO-CONCURSO PÚBLICO';
$situacaoMilitar['LICENCIADO']='LICENCIADO-DISCIPLINA';
$situacaoMilitar['LICENCIADO']='LICENCIADO-JES';
$situacaoMilitar['FALECIMENTO']='FALECIMENTO';
$situacaoMilitar['REFORMA']='REFORMA';
$situacaoMilitar['PTTC']='TAREFA POR TEMPO CERTO';
$situacaoMilitar['DSG']='DESIGNADO SVC ATIVO';
$situacaoMilitar['EXONERADO']='EXONERADO';
$situacaoMilitar['APOSENTADO']='APOSENTADO';
$situacaoMilitar['EXCLUÍDO']='EXCLUÍDO';


$controlehoras['CONTROLE HORAS - ACC-BS-BR']='CONTROLE HORAS - ACC-BS-BR';
$controlehoras['CONTROLE HORAS - ACC-BS-RJ']='CONTROLE HORAS - ACC-BS-RJ';
$controlehoras['CONTROLE HORAS - ACC-BS-SP']='CONTROLE HORAS - ACC-BS-SP';
$controlehoras['CONTROLE HORAS - ACC-BS-BR ESTAGIO']='CONTROLE HORAS - ACC-BS-BR ESTAGIO';
$controlehoras['CONTROLE HORAS - ACC-BS-RJ SUPERVISOR']='CONTROLE HORAS - ACC-BS-RJ SUPERVISOR';
$controlehoras['CONTROLE HORAS - ACC-BS-SP INSTRUTOR']='CONTROLE HORAS - ACC-BS-SP INSTRUTOR';

/*
$tbl_atividade[]='ATCO';
$tbl_atividade[]='OEA';
$tbl_atividade[]='OEA';
$tbl_atividade[]='SAR';
$tbl_atividade[]='PANS-OPS';

$tbl_atividade[]='AUXILIOS A NAVEGACAO';
$tbl_atividade[]='AUXILIOS METEOROLOGICOS';
$tbl_atividade[]='ENERGIA ELETRICA E AUXILIOS LUMINOSOS';
$tbl_atividade[]='MECANICA E CLIMATIZACAO';
$tbl_atividade[]='METROLOGIA';
$tbl_atividade[]='RADIODETERMINACAO';
$tbl_atividade[]='TECNOLOGIA DA INFORMACAO';
$tbl_atividade[]='TELECOMUNICACOES';


$tbl_qualificacao[] = 'TWR';
$tbl_qualificacao[] = 'APP';
$tbl_qualificacao[] = 'APP VGL';
$tbl_qualificacao[] = 'ACC VGL';
$tbl_qualificacao[] = 'ACC';
$tbl_qualificacao[] = 'COpM';
$tbl_qualificacao[] = 'PAR';
$tbl_qualificacao[] = 'SUPERVISOR';
$tbl_qualificacao[] = 'INSTRUTOR';
$tbl_qualificacao[] = 'EP PANS-OPS';
$tbl_qualificacao[] = 'IP PANS-OPS';
$tbl_qualificacao[] = 'IN PANS-OPS';
$tbl_qualificacao[] = 'OEA';
$tbl_qualificacao[] = 'RPM';
$tbl_qualificacao[] = 'AFTN';
$tbl_qualificacao[] = 'RACAM';
$tbl_qualificacao[] = 'ETM';
$tbl_qualificacao[] = 'RCC';
$tbl_qualificacao[] = 'MCC';

$tbl_qualificacao[] = 'TECNICO PLENO';
$tbl_qualificacao[] = 'TECNICO SUPERVISOR';
$tbl_qualificacao[] = 'TECNICO TREINANDO';



$tbl_motivo_suspensao_perda[] = 'LICENCA PARTICULAR';
$tbl_motivo_suspensao_perda[] = 'LICENCA ESPECIAL';
$tbl_motivo_suspensao_perda[] = 'LICENCA SAUDE';
$tbl_motivo_suspensao_perda[] = 'LICENCA MATERNIDADE';
$tbl_motivo_suspensao_perda[] = 'COMISSIONAMENTO';
$tbl_motivo_suspensao_perda[] = 'INTERVENCAO';
$tbl_motivo_suspensao_perda[] = 'DISPOSICAO ORGAO EXTERNO';
$tbl_motivo_suspensao_perda[] = 'DISCIPLINA';
$tbl_motivo_suspensao_perda[] = 'JUSTICA';
$tbl_motivo_suspensao_perda[] = 'ACIDENTE';
$tbl_motivo_suspensao_perda[] = 'INCIDENTE';
$tbl_motivo_suspensao_perda[] = 'DISPENSA MEDICA';
$tbl_motivo_suspensao_perda[] = 'NUPCIAS';
$tbl_motivo_suspensao_perda[] = 'LUTO';


$tbl_empresa[] = 'CINDACTA I';
$tbl_empresa[] = 'CINDACTA II';
$tbl_empresa[] = 'CINDACTA III';
$tbl_empresa[] = 'CINDACTA IV';
$tbl_empresa[] = 'SRPV-SP';
$tbl_empresa[] = '1 GCC';
$tbl_empresa[] = 'CGNA';
$tbl_empresa[] = 'DTCEA';
$tbl_empresa[] = 'INFRAERO';
$tbl_empresa[] = 'INFRAERO KP';


$tbl_cargo_conselho[] = 'MEMBRO CONSULTIVO';
$tbl_cargo_conselho[] = 'MEMBRO EFETIVO';
$tbl_cargo_conselho[] = 'MEMBRO SUPLENTE';
$tbl_cargo_conselho[] = 'PRESIDENTE';
$tbl_cargo_conselho[] = 'SECRETARIO';

$tbl_instituicao_ensino[] = 'CIND1-SIAT';
$tbl_instituicao_ensino[] = 'CIND2-SIAT';
$tbl_instituicao_ensino[] = 'CIND3-SIAT';
$tbl_instituicao_ensino[] = 'CIND4-SIAT';
$tbl_instituicao_ensino[] = 'SRSP-SIAT';
$tbl_instituicao_ensino[] = '1GCC-SIAT';
$tbl_instituicao_ensino[] = 'CGNA-SIAT';
$tbl_instituicao_ensino[] = 'ICEA';
$tbl_instituicao_ensino[] = 'EEAR';
$tbl_instituicao_ensino[] = 'CIAAR';
$tbl_instituicao_ensino[] = 'ICA';
*/

$modeloAtas = '<p>&nbsp;</p>
<p><img style="vertical-align: middle; display: block; margin-left: auto; margin-right: auto;" src="/operacional/img/brasaopb.jpg" alt="" width="100" height="100" /></p>
<p style="text-align: center;"><strong>MINIST&Eacute;RIO DA DEFESA</strong></p>
<p style="text-align: center;"><strong>COMANDO DA AERON&Aacute;UTICA</strong></p>
<p style="text-align: center;"><span style="text-decoration: underline;"><strong>QUARTO CENTRO INTEGRADO DE DEFA A&Eacute;REA E CONTROLE DO TR&Aacute;FEGO A&Eacute;REO</strong></span></p>
<p style="text-align: center;"><strong>ATA N&deg;&nbsp; /&Oacute;RGAO/ANO</strong></p>
<p style="text-align: justify;">Aos vinte e oito dias do m&ecirc;s de abril do ano de dois mil e dez, &agrave;s 09 h 15 min, na Sala de Reuni&otilde;es da DO/Audit&oacute;rio do DTCEA-XX/etc, reuniu-se o Conselho Operacional do ACC-XX, convocado pelo Memo n&deg; XXX/CMDO, de vinte e sete de abril do ano de dois mil e dez, para deliberar sobre a habilita&ccedil;&atilde;o do 3S BCT FULANO DE TAL e 3S BCT SICRANO DE TAL a Controlados/Supervisor/Instrutor do ACC-XX. Compareceram a esta Reuni&atilde;o o Cel Av ..., Presidente, Ten Cel Av ...., Membro Efetivo/Suplente, 1&ordm; Ten QOECTA ... , Membro Efetivo/Suplente, SO BCT ..., Membro Efetivo/Suplente, 1S BCT ...., Membro Efetivo/Suplente, , 1S BCT ...., Membro Efetivo/Suplente, Maj Av ..., Membro/Consultivo, 1&ordm; Ten QCOA PSC ..., Membro Consultivo, e 3S BCT ..., Secret&aacute;rio. Foram discutidas as seguintes delibera&ccedil;&otilde;es:</p>
<p style="text-align: justify;">1&ordf; Habilita&ccedil;&atilde;o do 3S BCT FULANO DE TAL a Controlador do ACC-XX</p>
<p style="text-align: justify;">O 1S ... relatou que o 3S BCT FULANO DE TAL (redigir sinteticamente as palavras de cada participante, na sequ&ecirc;ncia apresentada acima). Esgotadas as delibera&ccedil;&otilde;es, foi proposta a vota&ccedil;&atilde;o quanto &agrave; habilita&ccedil;&atilde;o do 3S FULANO DE TAL. O Mesmo obteve 4 votos favor&aacute;veis e 1 voto desfavor&aacute;vel, tendo sido o resultado da vota&ccedil;&atilde;o homologado pelo Presidente do Conselho.</p>
<p style="text-align: justify;">2&ordf; Habilita&ccedil;&atilde;o do 3S BCT SICRANO DE TAL a Instrutor do ACC-XX</p>
<p style="text-align: justify;">O 1S ... relatou que o 3S BCT SICRANO DE TAL (redigir sinteticamente as palavras de cada participante, na sequ&ecirc;ncia apresentada acima). Esgotadas as delibera&ccedil;&otilde;es, foi proposta a vota&ccedil;&atilde;o quanto &agrave; habilita&ccedil;&atilde;o do 3S BCT SICRANO DE TAL. O mesmo obteve 1 voto favor&aacute;vel e 4 votos desfavor&aacute;veis, tendo sido o resultado da vota&ccedil;&atilde;o homologado pelo Presidente do Conselho. Em consequ&ecirc;ncia, de acordo com os iten 4.5.1 e 4.5.3 da ICA 100-18, de 01 de OUT 2009, fica a quantidade m&iacute;nima de horas normais do Est&aacute;gio Operacional acrescida de 60 (sessenta) horas de instru&ccedil;&atilde;o pr&aacute;tica.</p>
<p style="text-align: justify;">E, nada mais havendo para tratar, o Sr. Presidente determinou que esta ATA seja encaminhada para publica&ccedil;&atilde;o em Boletim e deu por encerrada a Reuni&atilde;o, da qual eu, .... 3S BCT, Secret&aacute;rio, lavro a presente, que, ap&oacute;s lida e acordada, vai assinada por todos os membros presentes.</p>
<p>&nbsp;</p>
<p>_________________________________Cel Av&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; __________________________________ Ten Cel Av</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Presidente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Membro efetivo/suplente</p>
<p>&nbsp;</p>
<p>__________________________1&ordm;Ten QOECTA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; __________________________________ SO BCT</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Membro efetivo/suplente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Membro efetivo/suplente</p>
<p>&nbsp;</p>
<p>________________________________1S BCT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; __________________________________ 1S BCT</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Membro efetivo/suplente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Membro efetivo/suplente</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p style="text-align: center;">_______________________________________ 3S BCT</p>
<p style="text-align: center;">Secret&aacute;rio</p>
<p>&nbsp;</p>';

?>
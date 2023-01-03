<?php
$arrayStatusCaixa = array(
	'0' => array( 'cod' => 'NOVO', 'descricao' =>  'Novo'),
	'1' => array( 'cod' => 'ABERTO', 'descricao' =>  'Em Aberto'),
	'2' => array( 'cod' => 'FECHADO', 'descricao' =>  'Fechado Definitivo'),
	'3' => array( 'cod' => 'CANCELADO', 'descricao' =>  'Cancelado'),
);	

$arrayMotivo = array(

	'0' => array( 
		'cod' =>  '11',
		'desc' =>  'Insuficiência de fundos - 1ª apresentação',
	
	),
	'1' => array( 
		'cod' =>  '12',
		'desc' =>  'Insuficiência de fundos - 2º apresentação',
	
	),
	'2' => array( 
		'cod' =>  '13',
		'desc' =>  'Conta encerrada',
	),
	'3' => array( 
		'cod' =>  '14',
		'desc' =>  'Prática espária - compromisso pronto acolhimento',
	),
	'4' => array( 
		'cod' =>  '20',
		'desc' =>  'Folha de cheque cancelada por solicitação do correntista',
	),
	'5' => array( 
		'cod' =>  '21',
		'desc' =>  'Contra-ordem ou oposição ao pagamento',
	),
	'6' => array( 
		'cod' =>  '22',
		'desc' =>  'Divergência ou insuficiência de assinatura',
	),
	'7' => array( 
		'cod' =>  '23',
		'desc' =>  'Cheques de Órgãos da administração federal em desacordo com o decreto-lei 200',
	),
	'8' => array( 
		'cod' =>  '24',
		'desc' =>  'Bloqueio judicial ou determinação do bacen',
	),
	'9' => array( 
		'cod' =>  '25',
		'desc' =>  'Cancelamento de talonário pelo banco sacado',
	),
	'10' => array( 
		'cod' =>  '26',
		'desc' =>  'Inoperância temporária de transporte',
	),
	'11' => array( 
		'cod' =>  '27',
		'desc' =>  'Feriado municipal não previsto',
	),
	'12' => array( 
		'cod' =>  '28',
		'desc' =>  'Contra-ordem ou oposição ao pagamento motivada por furto ou roubo',
	),
	'13' => array( 
		'cod' =>  '29',
		'desc' =>  'Falta de confirmação do recebimento do talonário pelo correntista',
	),
	'14' => array( 
		'cod' =>  '30',
		'desc' =>  'Furto ou roubo de malotes',
	),
	'15' => array( 
		'cod' =>  '31',
		'desc' =>  'Erro formal de preenchimento',
	),
	'16' => array( 
		'cod' =>  '32',
		'desc' =>  'Ausência ou irregularidade na aplicação do carimbo de compensação',
	),
	'17' => array( 
		'cod' =>  '33',
		'desc' =>  'Divergência de endosso',
	),
	'18' => array( 
		'cod' =>  '34',
		'desc' =>  'Cheque apresentado por estabelecimento que não o indicado no cruzamento em preto, sem o endosso-mandato',
	),
	'19' => array( 
		'cod' =>  '35',
		'desc' =>  'Cheque fraudado(adulterado), emitido sem prévio controle ou responsabilidade do estabelecimento bancário ("cheque universal")',
	),
	'20' => array( 
		'cod' =>  '36',
		'desc' =>  'Cheque emitido com mais de um endosso',
	),
	'21' => array( 
		'cod' =>  '37',
		'desc' =>  'Registro inconsistente - CEL',
	),
	'22' => array( 
		'cod' =>  '40',
		'desc' =>  'Moeda inválida',
	
	),
	'23' => array( 
		'cod' =>  '41',
		'desc' =>  'Cheque apresentado a banco que não o sacado',
	
	),
	'25' => array( 
		'cod' =>  '42',
		'desc' =>  'Cheque não compensável na sessão ou sistema de compensação em que apresentado e o recibo bancário trocado em sessão indevida',
	),
	'26' => array( 
		'cod' =>  '43',
		'desc' =>  'Cheque devolvido anteriormente pelos motivos 21, 22, 23, 24, 31 e 34, persistindo o vetorMotivo de devolução',
	),
	'27' => array( 
		'cod' =>  '44',
		'desc' =>  'Cheque prescrito',
	),
	'28' => array( 
		'cod' =>  '45',
		'desc' =>  'Cheque emitido por entidade obrigada a emitir ordem bancária',
	),
	'29' => array( 
		'cod' =>  '46',
		'desc' =>  'CR - Comunicação de remessa cujo cheque correspondente não for entregue no prazo devido',
	),
	'30' => array( 
		'cod' =>  '47',
		'desc' =>  'CR - Comunicação de remessa com ausência ou inconsistância de dados obrigatórios',
	),
	'31' => array( 
		'cod' =>  '48',
		'desc' =>  'Cheque de valor superior a R$ 100,00 sem identificação do beneficiário',
	),
	'32' => array( 
		'cod' =>  '49',
		'desc' =>  'Remessa nula, caracterizada pela reapresentação de cheque devolvido pelos motivos 12, 13, 14, 20, 25, 35, 43, 44 e 45',
	),
	'33' => array( 
		'cod' =>  '71',
		'desc' =>  'Inadimplemento contratual da cooperativa de crédito no acordo de compensação',
	),
	'34' => array( 
		'cod' =>  '72',
		'desc' =>  'Contrato de compensação encerrado (Cooperativas de crédito)',
	)
);

$arrayBanco = array(
	'0' => array( 'cod' =>'1','desc' =>'Banco do Brasil S.A.'),
	'1' => array( 'cod' =>'3','desc' =>'Banco da Amazonia S.A. '),
	'2' => array( 'cod' =>'4','desc' =>'Banco do Nordeste do Brasil S.A. '),
	'3' => array( 'cod' =>'12','desc' =>'Banco Standard de Investimentos S.A. '),
	'4' => array( 'cod' =>'21','desc' =>'BANESTES S.A. Banco do Estado do Espirito Santo '),
	'5' => array( 'cod' =>'24','desc' =>'Banco de Pernambuco S.A. - BANDEPE '),
	'6' => array( 'cod' =>'25','desc' =>'Banco Alfa S.A. '),
	'7' => array( 'cod' =>'29','desc' =>'Banco Banerj S.A. '),
	'8' => array( 'cod' =>'31','desc' =>'Banco Beg S.A. '),
	'9' => array( 'cod' =>'33','desc' =>'Banco Santander (Brasil) S.A. '),
	'10' => array( 'cod' =>'36','desc' =>'Banco Bradesco BBI S.A. '),
	'11' => array( 'cod' =>'37','desc' =>'Banco do Estado do ParÃ¡ S.A. '),
	'12' => array( 'cod' =>'40','desc' =>'Banco Cargill S.A. '),
	'13' => array( 'cod' =>'41','desc' =>'Banco do Estado do Rio Grande do Sul S.A. '),
	'14' => array( 'cod' =>'45','desc' =>'Banco Opportunity S.A. '),
	'15' => array( 'cod' =>'47','desc' =>'Banco do Estado de Sergipe S.A. '),
	'16' => array( 'cod' =>'62','desc' =>'Hipercard Banco Multiplo S.A. '),
	'17' => array( 'cod' =>'63','desc' =>'Banco Ibi S.A. Banco Multiplo '),
	'18' => array( 'cod' =>'64','desc' =>'Goldman Sachs do Brasil Banco Multiplo S.A. '),
	'19' => array( 'cod' =>'65','desc' =>'Banco Bracce S.A. '),
	'20' => array( 'cod' =>'69','desc' =>'BPN Brasil Banco Multiplo S.A. '),
	'21' => array( 'cod' =>'70','desc' =>'BRB - Banco de Brasilia S.A. '),
	'22' => array( 'cod' =>'72','desc' =>'Banco Rural Mais S.A. '),
	'23' => array( 'cod' =>'73','desc' =>'BB Banco Popular do Brasil S.A. '),
	'24' => array( 'cod' =>'74','desc' =>'Banco J. Safra S.A. '),
	'25' => array( 'cod' =>'75','desc' =>'Banco ABN AMRO S.A. '),
	'26' => array( 'cod' =>'78','desc' =>'BES Investimento do Brasil S.A.-Banco de Investimento '),
	'27' => array( 'cod' =>'79','desc' =>'Banco Original do Agronegocio S.A. '),
	'28' => array( 'cod' =>'95','desc' =>'Banco Confidence de Cambio S.A. '),
	'29' => array( 'cod' =>'96','desc' =>'Banco BM&FBOVESPA de Serviços de LiquidaÃ§ao e Custodia S.A '),
	'30' => array( 'cod' =>'104','desc' =>'Caixa Economica Federal '),
	'31' => array( 'cod' =>'107','desc' =>'Banco BBM S.A. '),
	'32' => array( 'cod' =>'119','desc' =>'Banco Western Union do Brasil S.A. '),
	'33' => array( 'cod' =>'125','desc' =>'Brasil Plural S.A. - Banco Multiplo '),
	'34' => array( 'cod' =>'184','desc' =>'Banco Itau BBA S.A. '),
	'35' => array( 'cod' =>'204','desc' =>'Banco Bradesco Cartoes S.A. '),
	'36' => array( 'cod' =>'208','desc' =>'Banco BTG Pactual S.A. '),
	'37' => array( 'cod' =>'214','desc' =>'Banco Dibens S.A. '),
	'38' => array( 'cod' =>'215','desc' =>'Banco Comercial e de Investimento Sudameris S.A. '),
	'39' => array( 'cod' =>'217','desc' =>'Banco John Deere S.A. '),
	'40' => array( 'cod' =>'218','desc' =>'Banco Bonsucesso S.A. '),
	'41' => array( 'cod' =>'222','desc' =>'Banco Credit Agricole Brasil S.A. '),
	'42' => array( 'cod' =>'224','desc' =>'Banco Fibra S.A. '),
	'43' => array( 'cod' =>'230','desc' =>'Unicard Banco Multiplo S.A. '),
	'44' => array( 'cod' =>'233','desc' =>'Banco Cifra S.A. '),
	'45' => array( 'cod' =>'237','desc' =>'Banco Bradesco S.A. '),
	'46' => array( 'cod' =>'246','desc' =>'Banco ABC Brasil S.A. '),
	'47' => array( 'cod' =>'248','desc' =>'Banco Boavista Interatlantico S.A. '),
	'48' => array( 'cod' =>'249','desc' =>'Banco Investcred Unibanco S.A. '),
	'49' => array( 'cod' =>'250','desc' =>'BCV - Banco de Crédito e Varejo S.A. '),
	'50' => array( 'cod' =>'263','desc' =>'Banco Cacique S.A. '),
	'51' => array( 'cod' =>'265','desc' =>'Banco Fator S.A. '),
	'52' => array( 'cod' =>'318','desc' =>'Banco BMG S.A. '),
	'53' => array( 'cod' =>'320','desc' =>'Banco Industrial e Comercial S.A. '),
	'54' => array( 'cod' =>'341','desc' =>'Itaú Unibanco S.A. '),
	'55' => array( 'cod' =>'356','desc' =>'Banco Real S.A. '),
	'56' => array( 'cod' =>'366','desc' =>'Banco Society Genarale Brasil S.A. '),
	'57' => array( 'cod' =>'370','desc' =>'Banco Mizuho do Brasil S.A. '),
	'58' => array( 'cod' =>'376','desc' =>'Banco J. P. Morgan S.A. '),
	'59' => array( 'cod' =>'389','desc' =>'Banco Mercantil do Brasil S.A. '),
	'60' => array( 'cod' =>'394','desc' =>'Banco Bradesco Financiamentos S.A. '),
	'61' => array( 'cod' =>'394','desc' =>'Banco Finasa BMC S.A. '),
	'62' => array( 'cod' =>'399','desc' =>'HSBC Bank Brasil S.A. - Banco Múltiplo '),
	'63' => array( 'cod' =>'409','desc' =>'UNIBANCO - União de Bancos Brasileiros S.A. '),
	'64' => array( 'cod' =>'422','desc' =>'Banco Safra S.A. '),
	'65' => array( 'cod' =>'453','desc' =>'Banco Rural S.A. '),
	'66' => array( 'cod' =>'456','desc' =>'Banco de Tokyo-Mitsubishi UFJ Brasil S.A. '),
	'67' => array( 'cod' =>'464','desc' =>'Banco Sumitomo Mitsui Brasileiro S.A. '),
	'68' => array( 'cod' =>'473','desc' =>'Banco Caixa Geral - Brasil S.A. '),
	'69' => array( 'cod' =>'477','desc' =>'Citibank S.A. '),
	'70' => array( 'cod' =>'479','desc' =>'Banco Itaú Bank S.A '),
	'71' => array( 'cod' =>'487','desc' =>'Deutsche Bank S.A. - Banco Alemão '),
	'72' => array( 'cod' =>'488','desc' =>'JPMorgan Chase Bank '),
	'73' => array( 'cod' =>'492','desc' =>'ING Bank N.V. '),
	'74' => array( 'cod' =>'505','desc' =>'Banco Credit Suisse (Brasil) S.A. '),
	'75' => array( 'cod' =>'600','desc' =>'Banco Luso Brasileiro S.A. '),
	'76' => array( 'cod' =>'604','desc' =>'Banco Industrial do Brasil S.A. '),
	'77' => array( 'cod' =>'610','desc' =>'Banco VR S.A. '),
	'78' => array( 'cod' =>'611','desc' =>'Banco Paulista S.A. '),
	'79' => array( 'cod' =>'612','desc' =>'Banco Guanabara S.A. '),
	'80' => array( 'cod' =>'623','desc' =>'Banco Panamericano S.A. '),
	'81' => array( 'cod' =>'626','desc' =>'Banco Ficsa S.A. '),
	'82' => array( 'cod' =>'633','desc' =>'Banco Rendimento S.A. '),
	'83' => array( 'cod' =>'634','desc' =>'Banco Triângulo S.A. '),
	'84' => array( 'cod' =>'641','desc' =>'Banco Alvorada S.A. '),
	'85' => array( 'cod' =>'643','desc' =>'Banco Pine S.A. '),
	'86' => array( 'cod' =>'652','desc' =>'ItaÃº Unibanco Holding S.A. '),
	'87' => array( 'cod' =>'653','desc' =>'Banco Indusval S.A. '),
	'88' => array( 'cod' =>'655','desc' =>'Banco Votorantim S.A. '),
	'89' => array( 'cod' =>'707','desc' =>'Banco Daycoval S.A. '),
	'90' => array( 'cod' =>'719','desc' =>'Banif-Banco Internacional do Funchal (Brasil)S.A. '),
	'91' => array( 'cod' =>'739','desc' =>'Banco BGN S.A. '),
	'92' => array( 'cod' =>'740','desc' =>'Banco Barclays S.A. '),
	'93' => array( 'cod' =>'745','desc' =>'Banco Citibank S.A. '),
	'94' => array( 'cod' =>'746','desc' =>'Banco Modal S.A. '),
	'95' => array( 'cod' =>'747','desc' =>'Banco Rabobank International Brasil S.A. '),
	'96' => array( 'cod' =>'748','desc' =>'Banco Cooperativo Sicredi S.A. '),
	'97' => array( 'cod' =>'749','desc' =>'Banco Simples S.A. '),
	'98' => array( 'cod' =>'751','desc' =>'Scotiabank Brasil S.A. Banco Múltiplo '),
	'99' => array( 'cod' =>'752','desc' =>'Banco BNP Paribas Brasil S.A. '),
	'100' => array( 'cod' =>'755','desc' =>'Bank of America Merrill Lynch Banco Múltiplo S.A. '),
	'101' => array( 'cod' =>'756','desc' =>'Banco Cooperativo do Brasil S.A. - BANCOOB '),
	);
//MENU SELECT MOTIVOS


$vetorMotivo[11] = 'Insuficiência de fundos - 1ª apresentação';
$vetorMotivo[12] = 'Insuficiência de fundos - 2º apresentação';
$vetorMotivo[13] = 'Conta encerrada';
$vetorMotivo[14] = 'Prática espária - compromisso pronto acolhimento';
$vetorMotivo[20] = 'Folha de cheque cancelada por solicitação do correntista';
$vetorMotivo[21] = 'Contra-ordem ou oposição ao pagamento';
$vetorMotivo[22] = 'Divergência ou insuficiência de assinatura';
$vetorMotivo[23] = 'Cheques de Órgãos da administração federal em desacordo com o decreto-lei 200';
$vetorMotivo[24] = 'Bloqueio judicial ou determinação do bacen';
$vetorMotivo[25] = 'Cancelamento de talonário pelo banco sacado';
$vetorMotivo[26] = 'Inoperância temporária de transporte';
$vetorMotivo[27] = 'Feriado municipal não previsto';
$vetorMotivo[28] = 'Contra-ordem ou oposição ao pagamento motivada por furto ou roubo';
$vetorMotivo[29] = 'Falta de confirmação do recebimento do talonário pelo correntista';
$vetorMotivo[30] = 'Furto ou roubo de malotes';
$vetorMotivo[31] = 'Erro formal de preenchimento';
$vetorMotivo[32] = 'Ausência ou irregularidade na aplicação do carimbo de compensação';
$vetorMotivo[33] = 'Divergência de endosso';
$vetorMotivo[34] = 'Cheque apresentado por estabelecimento que não o indicado no cruzamento em preto, sem o endosso-mandato';
$vetorMotivo[35] = 'Cheque fraudado(adulterado), emitido sem prévio controle ou responsabilidade do estabelecimento bancário ("cheque universal")';
$vetorMotivo[36] = 'Cheque emitido com mais de um endosso -';
$vetorMotivo[37] = 'Registro inconsistente - CEL';
$vetorMotivo[40] = 'Moeda inválida';
$vetorMotivo[41] = 'Cheque apresentado a banco que não o sacado';
$vetorMotivo[42] = 'Cheque não compensável na sessão ou sistema de compensação em que apresentado e o recibo bancário trocado em sessão indevida';
$vetorMotivo[43] = 'Cheque devolvido anteriormente pelos motivos 21, 22, 23, 24, 31 e 34, persistindo o vetorMotivo de devolução';
$vetorMotivo[44] = 'Cheque prescrito';
$vetorMotivo[45] = 'Cheque emitido por entidade obrigada a emitir ordem bancária';
$vetorMotivo[46] = 'CR - Comunicação de remessa cujo cheque correspondente não for entregue no prazo devido';
$vetorMotivo[47] = 'CR - Comunicação de remessa com ausÃªncia ou inconsistÃªncia de dados obrigatórios';
$vetorMotivo[48] = 'Cheque de valor superior a R$ 100,00 sem identificação do beneficiário';
$vetorMotivo[49] = 'Remessa nula, caracterizada pela reapresentação de cheque devolvido pelos motivos 12, 13, 14, 20, 25, 35, 43, 44 e 45';
$vetorMotivo[71] = 'Inadimplemento contratual da cooperativa de crédito no acordo de compensação';
$vetorMotivo[72] = 'Contrato de compensação encerrado (Cooperativas de crédito)';

$vetorBanco[1] = 'Banco do Brasil S.A.';
$vetorBanco[3] = 'Banco da Amazonia S.A. ';
$vetorBanco[4] = 'Banco do Nordeste do Brasil S.A. ';
$vetorBanco[12] = 'Banco Standard de Investimentos S.A. ';
$vetorBanco[21] = 'BANESTES S.A. Banco do Estado do Espirito Santo ';
$vetorBanco[24] = 'Banco de Pernambuco S.A. - BANDEPE ';
$vetorBanco[25] = 'Banco Alfa S.A. ';
$vetorBanco[29] = 'Banco Banerj S.A. ';
$vetorBanco[31] = 'Banco Beg S.A. ';
$vetorBanco[33] = 'Banco Santander (Brasil) S.A. ';
$vetorBanco[36] = 'Banco Bradesco BBI S.A. ';
$vetorBanco[37] = 'Banco do Estado do ParÃ¡ S.A. ';
$vetorBanco[40] = 'Banco Cargill S.A. ';
$vetorBanco[41] = 'Banco do Estado do Rio Grande do Sul S.A. ';
$vetorBanco[45] = 'Banco Opportunity S.A. ';
$vetorBanco[47] = 'Banco do Estado de Sergipe S.A. ';
$vetorBanco[62] = 'Hipercard Banco Multiplo S.A. ';
$vetorBanco[63] = 'Banco Ibi S.A. Banco Multiplo ';
$vetorBanco[64] = 'Goldman Sachs do Brasil Banco Multiplo S.A. ';
$vetorBanco[65] = 'Banco Bracce S.A. ';
$vetorBanco[69] = 'BPN Brasil Banco Multiplo S.A. ';
$vetorBanco[70] = 'BRB - Banco de Brasilia S.A. ';
$vetorBanco[72] = 'Banco Rural Mais S.A. ';
$vetorBanco[73] = 'BB Banco Popular do Brasil S.A. ';
$vetorBanco[74] = 'Banco J. Safra S.A. ';
$vetorBanco[75] = 'Banco ABN AMRO S.A. ';
$vetorBanco[78] = 'BES Investimento do Brasil S.A.-Banco de Investimento ';
$vetorBanco[79] = 'Banco Original do Agronegocio S.A. ';
$vetorBanco[95] = 'Banco Confidence de Cambio S.A. ';
$vetorBanco[96] = 'Banco BM&FBOVESPA de Serviços de LiquidaÃ§ao e Custodia S.A ';
$vetorBanco[104] = 'Caixa Economica Federal ';
$vetorBanco[107] = 'Banco BBM S.A. ';
$vetorBanco[119] = 'Banco Western Union do Brasil S.A. ';
$vetorBanco[125] = 'Brasil Plural S.A. - Banco Multiplo ';
$vetorBanco[184] = 'Banco Itau BBA S.A. ';
$vetorBanco[204] = 'Banco Bradesco Cartoes S.A. ';
$vetorBanco[208] = 'Banco BTG Pactual S.A. ';
$vetorBanco[214] = 'Banco Dibens S.A. ';
$vetorBanco[215] = 'Banco Comercial e de Investimento Sudameris S.A. ';
$vetorBanco[217] = 'Banco John Deere S.A. ';
$vetorBanco[218] = 'Banco Bonsucesso S.A. ';
$vetorBanco[222] = 'Banco Credit Agricole Brasil S.A. ';
$vetorBanco[224] = 'Banco Fibra S.A. ';
$vetorBanco[230] = 'Unicard Banco Multiplo S.A. ';
$vetorBanco[233] = 'Banco Cifra S.A. ';
$vetorBanco[237] = 'Banco Bradesco S.A. ';
$vetorBanco[246] = 'Banco ABC Brasil S.A. ';
$vetorBanco[248] = 'Banco Boavista Interatlantico S.A. ';
$vetorBanco[249] = 'Banco Investcred Unibanco S.A. ';
$vetorBanco[250] = 'BCV - Banco de Crédito e Varejo S.A. ';
$vetorBanco[263] = 'Banco Cacique S.A. ';
$vetorBanco[265] = 'Banco Fator S.A. ';
$vetorBanco[318] = 'Banco BMG S.A. ';
$vetorBanco[320] = 'Banco Industrial e Comercial S.A. ';
$vetorBanco[341] = 'Itaú Unibanco S.A. ';
$vetorBanco[356] = 'Banco Real S.A. ';
$vetorBanco[366] = 'Banco Society Genarale Brasil S.A. ';
$vetorBanco[370] = 'Banco Mizuho do Brasil S.A. ';
$vetorBanco[376] = 'Banco J. P. Morgan S.A. ';
$vetorBanco[389] = 'Banco Mercantil do Brasil S.A. ';
$vetorBanco[394] = 'Banco Bradesco Financiamentos S.A. ';
$vetorBanco[394] = 'Banco Finasa BMC S.A. ';
$vetorBanco[399] = 'HSBC Bank Brasil S.A. - Banco Múltiplo ';
$vetorBanco[409] = 'UNIBANCO - União de Bancos Brasileiros S.A. ';
$vetorBanco[422] = 'Banco Safra S.A. ';
$vetorBanco[453] = 'Banco Rural S.A. ';
$vetorBanco[456] = 'Banco de Tokyo-Mitsubishi UFJ Brasil S.A. ';
$vetorBanco[464] = 'Banco Sumitomo Mitsui Brasileiro S.A. ';
$vetorBanco[473] = 'Banco Caixa Geral - Brasil S.A. ';
$vetorBanco[477] = 'Citibank S.A. ';
$vetorBanco[479] = 'Banco Itaú Bank S.A ';
$vetorBanco[487] = 'Deutsche Bank S.A. - Banco Alemão ';
$vetorBanco[488] = 'JPMorgan Chase Bank ';
$vetorBanco[492] = 'ING Bank N.V. ';
$vetorBanco[505] = 'Banco Credit Suisse (Brasil) S.A. ';
$vetorBanco[600] = 'Banco Luso Brasileiro S.A. ';
$vetorBanco[604] = 'Banco Industrial do Brasil S.A. ';
$vetorBanco[610] = 'Banco VR S.A. ';
$vetorBanco[611] = 'Banco Paulista S.A. ';
$vetorBanco[612] = 'Banco Guanabara S.A. ';
$vetorBanco[623] = 'Banco Panamericano S.A. ';
$vetorBanco[626] = 'Banco Ficsa S.A. ';
$vetorBanco[633] = 'Banco Rendimento S.A. ';
$vetorBanco[634] = 'Banco Triângulo S.A. ';
$vetorBanco[641] = 'Banco Alvorada S.A. ';
$vetorBanco[643] = 'Banco Pine S.A. ';
$vetorBanco[652] = 'ItaÃº Unibanco Holding S.A. ';
$vetorBanco[653] = 'Banco Indusval S.A. ';
$vetorBanco[655] = 'Banco Votorantim S.A. ';
$vetorBanco[707] = 'Banco Daycoval S.A. ';
$vetorBanco[719] = 'Banif-Banco Internacional do Funchal (Brasil)S.A. ';
$vetorBanco[739] = 'Banco BGN S.A. ';
$vetorBanco[740] = 'Banco Barclays S.A. ';
$vetorBanco[745] = 'Banco Citibank S.A. ';
$vetorBanco[746] = 'Banco Modal S.A. ';
$vetorBanco[747] = 'Banco Rabobank International Brasil S.A. ';
$vetorBanco[748] = 'Banco Cooperativo Sicredi S.A. ';
$vetorBanco[749] = 'Banco Simples S.A. ';
$vetorBanco[751] = 'Scotiabank Brasil S.A. Banco Múltiplo ';
$vetorBanco[752] = 'Banco BNP Paribas Brasil S.A. ';
$vetorBanco[755] = 'Bank of America Merrill Lynch Banco Múltiplo S.A. ';
$vetorBanco[756] = 'Banco Cooperativo do Brasil S.A. - BANCOOB ';

$vetorDiaSem[0] = 'Domingo';	
$vetorDiaSem[1] = 'Segunda-Feira';
$vetorDiaSem[2] = 'Terca-Feira';
$vetorDiaSem[3] = 'Quarta-Feira';
$vetorDiaSem[4] = 'Quinta-Feira';
$vetorDiaSem[5] = 'Sexta-Feira';
$vetorDiaSem[6] = 'Sabado';
$vetorDiaSem[7] = 'Domingo';
$vetorDiaSem[8] = 'Segunda-Feira';
$vetorDiaSem[9] = 'Terca-Feira';
$vetorDiaSem[10] = 'Quarta-Feira';
$vetorDiaSem[11] = 'Quinta-Feira';
$vetorDiaSem[12] = 'Sexta-Feira';
$vetorDiaSem[13] = 'Sabado';

$vetorDiaSemAbreviado[0] = 'DOM';
$vetorDiaSemAbreviado[1] = 'SEG';
$vetorDiaSemAbreviado[2] = 'TER';
$vetorDiaSemAbreviado[3] = 'QUA';
$vetorDiaSemAbreviado[4] = 'QUI';
$vetorDiaSemAbreviado[5] = 'SEX';
$vetorDiaSemAbreviado[6] = 'SAB';

$vetorMesAbreviado[1] = 'JAN';
$vetorMesAbreviado[2] = 'FEV';
$vetorMesAbreviado[3] = 'MAR';
$vetorMesAbreviado[4] = 'ABR';
$vetorMesAbreviado[5] = 'MAI';
$vetorMesAbreviado[6] = 'JUN';
$vetorMesAbreviado[7] = 'JUL';
$vetorMesAbreviado[8] = 'AGO';
$vetorMesAbreviado[9] = 'SET';
$vetorMesAbreviado[10] = 'OUT';
$vetorMesAbreviado[11] = 'NOV';
$vetorMesAbreviado[12] = 'DEZ';

include('comboBox.php');

?>    
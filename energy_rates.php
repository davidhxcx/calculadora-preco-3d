<?php
/**
 * Tarifas de Energia Elétrica do Brasil
 * Dados baseados nas distribuidoras regionais (valores médios 2024/2025)
 * Incluindo bandeiras tarifárias quando aplicável
 */

$ENERGY_RATES = [
    // REGIÃO SUL
    'SC' => [
        'state' => 'Santa Catarina',
        'distributor' => 'CELESC',
        'rate' => 0.6346,
        'flag' => 0.0446, // Bandeira Vermelha 1
        'total' => 0.6792,
        'cities' => ['Florianópolis', 'Joinville', 'Blumenau', 'Chapecó', 'Criciúma', 'Itajaí', 'Lages']
    ],
    'RS' => [
        'state' => 'Rio Grande do Sul',
        'distributor' => 'RGE/CEEE',
        'rate' => 0.5890,
        'flag' => 0.0446,
        'total' => 0.6336,
        'cities' => ['Porto Alegre', 'Caxias do Sul', 'Pelotas', 'Santa Maria', 'Gravataí', 'Viamão', 'Novo Hamburgo']
    ],
    'PR' => [
        'state' => 'Paraná',
        'distributor' => 'COPEL',
        'rate' => 0.5425,
        'flag' => 0.0446,
        'total' => 0.5871,
        'cities' => ['Curitiba', 'Londrina', 'Maringá', 'Ponta Grossa', 'Cascavel', 'São José dos Pinhais', 'Foz do Iguaçu']
    ],

    // REGIÃO SUDESTE
    'SP' => [
        'state' => 'São Paulo',
        'distributor' => 'ENEL/CPFL',
        'rate' => 0.6012,
        'flag' => 0.0446,
        'total' => 0.6458,
        'cities' => ['São Paulo', 'Guarulhos', 'Campinas', 'São Bernardo do Campo', 'Santo André', 'Osasco', 'Ribeirão Preto']
    ],
    'RJ' => [
        'state' => 'Rio de Janeiro',
        'distributor' => 'LIGHT/ENEL',
        'rate' => 0.7234,
        'flag' => 0.0446,
        'total' => 0.7680,
        'cities' => ['Rio de Janeiro', 'São Gonçalo', 'Duque de Caxias', 'Nova Iguaçu', 'Niterói', 'Belford Roxo', 'Campos dos Goytacazes']
    ],
    'MG' => [
        'state' => 'Minas Gerais',
        'distributor' => 'CEMIG',
        'rate' => 0.5892,
        'flag' => 0.0446,
        'total' => 0.6338,
        'cities' => ['Belo Horizonte', 'Uberlândia', 'Contagem', 'Juiz de Fora', 'Betim', 'Montes Claros', 'Ribeirão das Neves']
    ],
    'ES' => [
        'state' => 'Espírito Santo',
        'distributor' => 'EDP',
        'rate' => 0.5678,
        'flag' => 0.0446,
        'total' => 0.6124,
        'cities' => ['Vitória', 'Vila Velha', 'Cariacica', 'Serra', 'Cachoeiro de Itapemirim', 'Linhares', 'São Mateus']
    ],

    // REGIÃO NORDESTE
    'BA' => [
        'state' => 'Bahia',
        'distributor' => 'COELBA',
        'rate' => 0.6234,
        'flag' => 0.0446,
        'total' => 0.6680,
        'cities' => ['Salvador', 'Feira de Santana', 'Vitória da Conquista', 'Camaçari', 'Itabuna', 'Juazeiro', 'Lauro de Freitas']
    ],
    'PE' => [
        'state' => 'Pernambuco',
        'distributor' => 'NEOENERGIA',
        'rate' => 0.6123,
        'flag' => 0.0446,
        'total' => 0.6569,
        'cities' => ['Recife', 'Jaboatão dos Guararapes', 'Olinda', 'Caruaru', 'Petrolina', 'Paulista', 'Cabo de Santo Agostinho']
    ],
    'CE' => [
        'state' => 'Ceará',
        'distributor' => 'ENEL',
        'rate' => 0.5987,
        'flag' => 0.0446,
        'total' => 0.6433,
        'cities' => ['Fortaleza', 'Caucaia', 'Juazeiro do Norte', 'Maracanaú', 'Sobral', 'Crato', 'Itapipoca']
    ],
    'AL' => [
        'state' => 'Alagoas',
        'distributor' => 'CEAL',
        'rate' => 0.6345,
        'flag' => 0.0446,
        'total' => 0.6791,
        'cities' => ['Maceió', 'Arapiraca', 'Rio Largo', 'Palmeira dos Índios', 'União dos Palmares', 'Penedo', 'Delmiro Gouveia']
    ],
    'SE' => [
        'state' => 'Sergipe',
        'distributor' => 'ENERGISA',
        'rate' => 0.6178,
        'flag' => 0.0446,
        'total' => 0.6624,
        'cities' => ['Aracaju', 'Nossa Senhora do Socorro', 'Lagarto', 'Itabaiana', 'Estância', 'Tobias Barreto', 'Simão Dias']
    ],
    'PB' => [
        'state' => 'Paraíba',
        'distributor' => 'ENERGISA',
        'rate' => 0.6089,
        'flag' => 0.0446,
        'total' => 0.6535,
        'cities' => ['João Pessoa', 'Campina Grande', 'Santa Rita', 'Patos', 'Bayeux', 'Sousa', 'Cajazeiras']
    ],
    'RN' => [
        'state' => 'Rio Grande do Norte',
        'distributor' => 'COSERN',
        'rate' => 0.6234,
        'flag' => 0.0446,
        'total' => 0.6680,
        'cities' => ['Natal', 'Mossoró', 'Parnamirim', 'São Gonçalo do Amarante', 'Macaíba', 'Ceará-Mirim', 'Caicó']
    ],
    'PI' => [
        'state' => 'Piauí',
        'distributor' => 'CEPISA',
        'rate' => 0.5967,
        'flag' => 0.0446,
        'total' => 0.6413,
        'cities' => ['Teresina', 'Parnaíba', 'Picos', 'Piripiri', 'Floriano', 'Campo Maior', 'Barras']
    ],
    'MA' => [
        'state' => 'Maranhão',
        'distributor' => 'CEMAR',
        'rate' => 0.6156,
        'flag' => 0.0446,
        'total' => 0.6602,
        'cities' => ['São Luís', 'Imperatriz', 'São José de Ribamar', 'Timon', 'Caxias', 'Codó', 'Paço do Lumiar']
    ],

    // REGIÃO CENTRO-OESTE
    'MT' => [
        'state' => 'Mato Grosso',
        'distributor' => 'ENERGISA',
        'rate' => 0.5834,
        'flag' => 0.0446,
        'total' => 0.6280,
        'cities' => ['Cuiabá', 'Várzea Grande', 'Rondonópolis', 'Sinop', 'Tangará da Serra', 'Cáceres', 'Barra do Garças']
    ],
    'MS' => [
        'state' => 'Mato Grosso do Sul',
        'distributor' => 'ENERGISA',
        'rate' => 0.5923,
        'flag' => 0.0446,
        'total' => 0.6369,
        'cities' => ['Campo Grande', 'Dourados', 'Três Lagoas', 'Corumbá', 'Ponta Porã', 'Naviraí', 'Nova Andradina']
    ],
    'GO' => [
        'state' => 'Goiás',
        'distributor' => 'ENEL',
        'rate' => 0.5678,
        'flag' => 0.0446,
        'total' => 0.6124,
        'cities' => ['Goiânia', 'Aparecida de Goiânia', 'Anápolis', 'Rio Verde', 'Luziânia', 'Águas Lindas de Goiás', 'Valparaíso de Goiás']
    ],
    'DF' => [
        'state' => 'Distrito Federal',
        'distributor' => 'CEB',
        'rate' => 0.6234,
        'flag' => 0.0446,
        'total' => 0.6680,
        'cities' => ['Brasília', 'Taguatinga', 'Ceilândia', 'Samambaia', 'Planaltina', 'São Sebastião', 'Recanto das Emas']
    ],

    // REGIÃO NORTE
    'AM' => [
        'state' => 'Amazonas',
        'distributor' => 'AMAZONAS ENERGIA',
        'rate' => 0.6789,
        'flag' => 0.0446,
        'total' => 0.7235,
        'cities' => ['Manaus', 'Parintins', 'Itacoatiara', 'Manacapuru', 'Coari', 'Tefé', 'Tabatinga']
    ],
    'PA' => [
        'state' => 'Pará',
        'distributor' => 'EQUATORIAL',
        'rate' => 0.6456,
        'flag' => 0.0446,
        'total' => 0.6902,
        'cities' => ['Belém', 'Ananindeua', 'Santarém', 'Marabá', 'Parauapebas', 'Castanhal', 'Abaetetuba']
    ],
    'AC' => [
        'state' => 'Acre',
        'distributor' => 'ENERGISA',
        'rate' => 0.6923,
        'flag' => 0.0446,
        'total' => 0.7369,
        'cities' => ['Rio Branco', 'Cruzeiro do Sul', 'Sena Madureira', 'Tarauacá', 'Feijó', 'Brasileia', 'Xapuri']
    ],
    'RO' => [
        'state' => 'Rondônia',
        'distributor' => 'ENERGISA',
        'rate' => 0.6234,
        'flag' => 0.0446,
        'total' => 0.6680,
        'cities' => ['Porto Velho', 'Ji-Paraná', 'Ariquemes', 'Vilhena', 'Cacoal', 'Rolim de Moura', 'Guajará-Mirim']
    ],
    'RR' => [
        'state' => 'Roraima',
        'distributor' => 'RORAIMA ENERGIA',
        'rate' => 0.7234,
        'flag' => 0.0446,
        'total' => 0.7680,
        'cities' => ['Boa Vista', 'Rorainópolis', 'Caracaraí', 'Alto Alegre', 'Mucajaí', 'Cantá', 'Bonfim']
    ],
    'AP' => [
        'state' => 'Amapá',
        'distributor' => 'CEA',
        'rate' => 0.6890,
        'flag' => 0.0446,
        'total' => 0.7336,
        'cities' => ['Macapá', 'Santana', 'Laranjal do Jari', 'Oiapoque', 'Mazagão', 'Porto Grande', 'Vitória do Jari']
    ],
    'TO' => [
        'state' => 'Tocantins',
        'distributor' => 'ENERGISA',
        'rate' => 0.5834,
        'flag' => 0.0446,
        'total' => 0.6280,
        'cities' => ['Palmas', 'Araguaína', 'Gurupi', 'Porto Nacional', 'Paraíso do Tocantins', 'Colinas do Tocantins', 'Guaraí']
    ]
];

// Função para obter tarifa por estado
function getEnergyRateByState($state) {
    global $ENERGY_RATES;
    return isset($ENERGY_RATES[$state]) ? $ENERGY_RATES[$state] : null;
}

// Função para obter todas as regiões organizadas
function getRegionalizedRates() {
    global $ENERGY_RATES;
    
    $regions = [
        'Sul' => ['RS', 'SC', 'PR'],
        'Sudeste' => ['SP', 'RJ', 'MG', 'ES'],
        'Nordeste' => ['BA', 'PE', 'CE', 'AL', 'SE', 'PB', 'RN', 'PI', 'MA'],
        'Centro-Oeste' => ['MT', 'MS', 'GO', 'DF'],
        'Norte' => ['AM', 'PA', 'AC', 'RO', 'RR', 'AP', 'TO']
    ];
    
    $organized = [];
    foreach ($regions as $region => $states) {
        $organized[$region] = [];
        foreach ($states as $state) {
            if (isset($ENERGY_RATES[$state])) {
                $organized[$region][$state] = $ENERGY_RATES[$state];
            }
        }
    }
    
    return $organized;
}

// Função para buscar por cidade
function findStateByCity($cityName) {
    global $ENERGY_RATES;
    
    $cityName = strtolower(trim($cityName));
    foreach ($ENERGY_RATES as $stateCode => $data) {
        $cities = array_map('strtolower', $data['cities']);
        if (in_array($cityName, $cities)) {
            return $stateCode;
        }
    }
    
    return null;
}

?>

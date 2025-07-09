<?php
/**
 * Configurações da Calculadora de Preço 3D
 * Desenvolvido por: davidhxcx
 * Data: 2025
 * 
 * Este arquivo contém todas as configurações principais da aplicação,
 * incluindo definições de impressora, energia e validações.
 */

// =============================================================================
// CONFIGURAÇÕES DE IMPRESSORA PADRÃO
// =============================================================================

/**
 * Modelo padrão da impressora (pode ser sobrescrito pela seleção do usuário)
 */
define('PRINTER_MODEL', 'Creality CR-200B');

/**
 * Potência máxima da impressora em Watts
 */
define('PRINTER_MAX_POWER', 350);

/**
 * Potência média durante impressão em Watts
 */
define('PRINTER_AVG_POWER', 180);

/**
 * Consumo em kW (para cálculos de energia)
 */
define('PRINTER_POWER_KW', 0.18);

// =============================================================================
// CONFIGURAÇÕES DE ENERGIA ELÉTRICA
// =============================================================================

/**
 * Tarifa base de energia elétrica (Santa Catarina - Celesc)
 * Valor em R$/kWh sem bandeira tarifária
 */
define('BASE_ENERGY_RATE', 0.59);

/**
 * Taxa da bandeira tarifária vermelha 1
 * Valor adicional em R$/kWh
 */
define('FLAG_RATE', 0.0446);

/**
 * Tarifa total de energia (base + bandeira)
 * Valor final em R$/kWh
 */
define('TOTAL_ENERGY_RATE', BASE_ENERGY_RATE + FLAG_RATE);

// =============================================================================
// CONFIGURAÇÕES GERAIS DA APLICAÇÃO
// =============================================================================

/**
 * Margem de lucro padrão em porcentagem
 */
define('DEFAULT_PROFIT_MARGIN', 50);

/**
 * Número máximo de registros no histórico
 */
define('MAX_HISTORY_RECORDS', 1000);

/**
 * Limite padrão de registros exibidos no histórico
 */
define('DEFAULT_HISTORY_LIMIT', 10);

// =============================================================================
// CONFIGURAÇÕES DE VALIDAÇÃO
// =============================================================================

/**
 * Peso máximo permitido para filamento (em gramas)
 */
define('MAX_FILAMENT_WEIGHT', 10000);

/**
 * Tempo máximo de impressão permitido (em horas)
 */
define('MAX_PRINT_HOURS', 1000);

/**
 * Margem de lucro máxima permitida (em porcentagem)
 */
define('MAX_PROFIT_MARGIN', 1000);

// =============================================================================
// CONFIGURAÇÕES DE LOCALIZAÇÃO PADRÃO
// =============================================================================

/**
 * Estado padrão para cálculos de energia
 */
define('LOCATION_STATE', 'Santa Catarina');

/**
 * Distribuidora de energia padrão
 */
define('ENERGY_PROVIDER', 'Celesc');
define('CURRENCY', 'BRL');
define('LOCALE', 'pt-BR');

// Configurações de arquivos
define('DATA_DIR', 'data');
define('CALCULATIONS_FILE', DATA_DIR . '/calculations.json');

// Informações sobre tarifas
$ENERGY_INFO = [
    'base_rate' => BASE_ENERGY_RATE,
    'flag_rate' => FLAG_RATE,
    'total_rate' => TOTAL_ENERGY_RATE,
    'flag_type' => 'Bandeira Vermelha 1',
    'provider' => ENERGY_PROVIDER,
    'state' => LOCATION_STATE,
    'last_update' => '2024-08-01',
    'description' => 'Tarifa residencial atualizada em agosto/2024 com bandeira vermelha 1 aplicada'
];

// Informações da impressora
$PRINTER_INFO = [
    'model' => PRINTER_MODEL,
    'max_power' => PRINTER_MAX_POWER,
    'avg_power' => PRINTER_AVG_POWER,
    'chamber_type' => 'Fechada',
    'heated_bed' => true,
    'description' => 'Consumo médio durante impressão PETG com aquecedor de mesa + hotend'
];

// Configurações de margem recomendadas por tipo de peça
$PROFIT_MARGINS = [
    'simple' => ['min' => 30, 'max' => 50, 'desc' => 'Peças simples'],
    'complex' => ['min' => 50, 'max' => 80, 'desc' => 'Peças complexas'],
    'prototype' => ['min' => 80, 'max' => 150, 'desc' => 'Protótipos'],
    'unique' => ['min' => 100, 'max' => 300, 'desc' => 'Peças únicas/artísticas']
];

// Função para obter informações de energia
function getEnergyInfo() {
    global $ENERGY_INFO;
    return $ENERGY_INFO;
}

// Função para obter informações da impressora
function getPrinterInfo() {
    global $PRINTER_INFO;
    return $PRINTER_INFO;
}

// Função para obter margens recomendadas
function getProfitMargins() {
    global $PROFIT_MARGINS;
    return $PROFIT_MARGINS;
}

// Função para formatar moeda
function formatCurrency($value) {
    return number_format($value, 2, ',', '.');
}

// Função para validar entrada numérica
function validateNumeric($value, $min = 0, $max = null) {
    if (!is_numeric($value)) {
        return false;
    }
    
    $num = floatval($value);
    
    if ($num < $min) {
        return false;
    }
    
    if ($max !== null && $num > $max) {
        return false;
    }
    
    return true;
}

// Função para criar diretório se não existir
function ensureDataDirectory() {
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0755, true);
    }
}

// Configurações para JavaScript (exportar como JSON)
$JS_CONFIG = [
    'printer' => [
        'model' => PRINTER_MODEL,
        'powerConsumption' => PRINTER_POWER_KW,
        'maxPower' => PRINTER_MAX_POWER,
        'avgPower' => PRINTER_AVG_POWER
    ],
    'energy' => [
        'rate' => TOTAL_ENERGY_RATE,
        'baseRate' => BASE_ENERGY_RATE,
        'flagRate' => FLAG_RATE,
        'provider' => ENERGY_PROVIDER,
        'state' => LOCATION_STATE
    ],
    'defaults' => [
        'profitMargin' => DEFAULT_PROFIT_MARGIN
    ],
    'validation' => [
        'maxFilamentWeight' => MAX_FILAMENT_WEIGHT,
        'maxPrintHours' => MAX_PRINT_HOURS,
        'maxProfitMargin' => MAX_PROFIT_MARGIN
    ],
    'locale' => [
        'currency' => CURRENCY,
        'locale' => LOCALE
    ]
];

// Função para obter configurações JS
function getJSConfig() {
    global $JS_CONFIG;
    return json_encode($JS_CONFIG);
}
?>

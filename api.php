<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Configurações da impressora e energia
define('PRINTER_POWER_CONSUMPTION', 0.18); // kW (180W)
define('ENERGY_RATE', 0.6346); // R$/kWh (Celesc SC + bandeira vermelha)

class PriceCalculatorAPI {
    
    public function calculate($data) {
        try {
            // Validar dados de entrada
            $this->validateInput($data);
            
            // Extrair valores
            $filamentWeight = floatval($data['filament_weight']);
            $filamentPriceKg = floatval($data['filament_price_kg']);
            $printHours = floatval($data['print_hours']);
            $profitMargin = isset($data['profit_margin']) ? floatval($data['profit_margin']) : 50;
            
            // Realizar cálculos
            $calculations = $this->performCalculations(
                $filamentWeight,
                $filamentPriceKg,
                $printHours,
                $profitMargin
            );
            
            // Retornar resultado
            return [
                'success' => true,
                'data' => $calculations,
                'timestamp' => date('c')
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'timestamp' => date('c')
            ];
        }
    }
    
    private function validateInput($data) {
        $required = ['filament_weight', 'filament_price_kg', 'print_hours'];
        
        foreach ($required as $field) {
            if (!isset($data[$field]) || !is_numeric($data[$field]) || floatval($data[$field]) <= 0) {
                throw new Exception("Campo '{$field}' é obrigatório e deve ser um número positivo");
            }
        }
        
        // Validações adicionais
        if (floatval($data['filament_weight']) > 10000) {
            throw new Exception('Peso do filamento muito alto (máximo 10kg)');
        }
        
        if (floatval($data['print_hours']) > 1000) {
            throw new Exception('Tempo de impressão muito alto (máximo 1000 horas)');
        }
        
        if (isset($data['profit_margin'])) {
            $margin = floatval($data['profit_margin']);
            if ($margin < 0 || $margin > 1000) {
                throw new Exception('Margem de lucro deve estar entre 0% e 1000%');
            }
        }
    }
    
    private function performCalculations($filamentWeight, $filamentPriceKg, $printHours, $profitMargin) {
        // Custo do filamento (peso em gramas para kg)
        $filamentCost = ($filamentWeight / 1000) * $filamentPriceKg;
        
        // Custo de energia
        $energyCost = $printHours * PRINTER_POWER_CONSUMPTION * ENERGY_RATE;
        
        // Custo total
        $totalCost = $filamentCost + $energyCost;
        
        // Preço sugerido com margem de lucro
        $suggestedPrice = $totalCost * (1 + $profitMargin / 100);
        
        return [
            'input' => [
                'filament_weight' => $filamentWeight,
                'filament_price_kg' => $filamentPriceKg,
                'print_hours' => $printHours,
                'profit_margin' => $profitMargin
            ],
            'costs' => [
                'filament_cost' => round($filamentCost, 2),
                'energy_cost' => round($energyCost, 2),
                'total_cost' => round($totalCost, 2)
            ],
            'pricing' => [
                'suggested_price' => round($suggestedPrice, 2),
                'profit_amount' => round($suggestedPrice - $totalCost, 2),
                'profit_percentage' => $profitMargin
            ],
            'technical_info' => [
                'power_consumption_kw' => PRINTER_POWER_CONSUMPTION,
                'energy_rate_kwh' => ENERGY_RATE,
                'printer_model' => 'Creality CR-200B',
                'location' => 'Santa Catarina - Celesc',
                'tariff_flag' => 'Bandeira Vermelha 1'
            ]
        ];
    }
    
    public function getEnergyInfo() {
        return [
            'success' => true,
            'data' => [
                'base_rate' => 0.59,
                'flag_rate' => 0.0446,
                'total_rate' => ENERGY_RATE,
                'flag_type' => 'Bandeira Vermelha 1',
                'provider' => 'Celesc',
                'state' => 'Santa Catarina',
                'last_update' => '2024-08-01',
                'printer' => [
                    'model' => 'Creality CR-200B',
                    'max_power' => 350,
                    'avg_power' => 180,
                    'chamber_type' => 'Fechada'
                ]
            ],
            'timestamp' => date('c')
        ];
    }
    
    public function saveCalculation($data) {
        try {
            $calculation = $this->calculate($data);
            
            if (!$calculation['success']) {
                return $calculation;
            }
            
            // Salvar no arquivo JSON (banco de dados simples)
            $filename = 'data/calculations.json';
            $calculations = [];
            
            if (file_exists($filename)) {
                $existing = file_get_contents($filename);
                $calculations = json_decode($existing, true) ?: [];
            }
            
            // Adicionar novo cálculo
            $newCalculation = array_merge($calculation['data'], [
                'id' => uniqid(),
                'timestamp' => date('c'),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ]);
            
            array_unshift($calculations, $newCalculation);
            
            // Manter apenas os últimos 1000 registros
            if (count($calculations) > 1000) {
                $calculations = array_slice($calculations, 0, 1000);
            }
            
            // Criar diretório se não existir
            if (!is_dir('data')) {
                mkdir('data', 0755, true);
            }
            
            // Salvar arquivo
            file_put_contents($filename, json_encode($calculations, JSON_PRETTY_PRINT));
            
            return [
                'success' => true,
                'data' => $calculation['data'],
                'saved' => true,
                'timestamp' => date('c')
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Erro ao salvar cálculo: ' . $e->getMessage(),
                'timestamp' => date('c')
            ];
        }
    }
    
    public function getHistory($limit = 10) {
        try {
            $filename = 'data/calculations.json';
            
            if (!file_exists($filename)) {
                return [
                    'success' => true,
                    'data' => [],
                    'count' => 0,
                    'timestamp' => date('c')
                ];
            }
            
            $calculations = json_decode(file_get_contents($filename), true) ?: [];
            $limited = array_slice($calculations, 0, intval($limit));
            
            return [
                'success' => true,
                'data' => $limited,
                'count' => count($limited),
                'total' => count($calculations),
                'timestamp' => date('c')
            ];
            
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Erro ao carregar histórico: ' . $e->getMessage(),
                'timestamp' => date('c')
            ];
        }
    }
}

// Processar requisições
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $calculator = new PriceCalculatorAPI();
    
    $action = $input['action'] ?? 'calculate';
    
    switch ($action) {
        case 'calculate':
            echo json_encode($calculator->calculate($input));
            break;
            
        case 'save':
            echo json_encode($calculator->saveCalculation($input));
            break;
            
        case 'history':
            $limit = $input['limit'] ?? 10;
            echo json_encode($calculator->getHistory($limit));
            break;
            
        case 'energy_info':
            echo json_encode($calculator->getEnergyInfo());
            break;
            
        default:
            echo json_encode([
                'success' => false,
                'error' => 'Ação não reconhecida',
                'timestamp' => date('c')
            ]);
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $calculator = new PriceCalculatorAPI();
    
    $action = $_GET['action'] ?? 'energy_info';
    
    switch ($action) {
        case 'energy_info':
            echo json_encode($calculator->getEnergyInfo());
            break;
            
        case 'history':
            $limit = $_GET['limit'] ?? 10;
            echo json_encode($calculator->getHistory($limit));
            break;
            
        default:
            echo json_encode([
                'success' => false,
                'error' => 'Ação não reconhecida para GET',
                'timestamp' => date('c')
            ]);
    }
    
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Método não permitido',
        'timestamp' => date('c')
    ]);
}
?>

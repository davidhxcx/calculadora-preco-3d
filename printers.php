<?php
/**
 * Configurações das Impressoras 3D Creality
 * Base de dados com especificações técnicas de consumo energético
 */

$CREALITY_PRINTERS = [
    'cr-200b' => [
        'name' => 'Creality CR-200B',
        'category' => 'Fechada/Compacta',
        'max_power' => 350, // Watts
        'avg_power' => 180, // Watts durante impressão
        'power_consumption' => 0.18, // kW
        'bed_size' => '200 x 200 x 200mm',
        'heated_bed' => true,
        'chamber_type' => 'Fechada',
        'description' => 'Impressora compacta com câmara fechada, ideal para PETG e PLA'
    ],
    'ender-3' => [
        'name' => 'Creality Ender 3',
        'category' => 'Entry Level',
        'max_power' => 270,
        'avg_power' => 120,
        'power_consumption' => 0.12,
        'bed_size' => '220 x 220 x 250mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Impressora popular para iniciantes, excelente custo-benefício'
    ],
    'ender-3-v2' => [
        'name' => 'Creality Ender 3 V2',
        'category' => 'Entry Level',
        'max_power' => 350,
        'avg_power' => 150,
        'power_consumption' => 0.15,
        'bed_size' => '220 x 220 x 250mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Versão melhorada do Ender 3 com tela colorida e melhor qualidade'
    ],
    'ender-3-s1' => [
        'name' => 'Creality Ender 3 S1',
        'category' => 'Intermediária',
        'max_power' => 350,
        'avg_power' => 160,
        'power_consumption' => 0.16,
        'bed_size' => '220 x 220 x 270mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Auto-nivelamento e extrusor direct drive'
    ],
    'ender-3-s1-pro' => [
        'name' => 'Creality Ender 3 S1 Pro',
        'category' => 'Intermediária',
        'max_power' => 400,
        'avg_power' => 180,
        'power_consumption' => 0.18,
        'bed_size' => '220 x 220 x 270mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Versão premium com tela touch e melhor qualidade de impressão'
    ],
    'ender-5' => [
        'name' => 'Creality Ender 5',
        'category' => 'Intermediária',
        'max_power' => 350,
        'avg_power' => 170,
        'power_consumption' => 0.17,
        'bed_size' => '220 x 220 x 300mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Design cúbico estável com movimentação CoreXY'
    ],
    'ender-5-plus' => [
        'name' => 'Creality Ender 5 Plus',
        'category' => 'Grande Formato',
        'max_power' => 500,
        'avg_power' => 280,
        'power_consumption' => 0.28,
        'bed_size' => '350 x 350 x 400mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Impressora de grande formato para projetos maiores'
    ],
    'ender-5-s1' => [
        'name' => 'Creality Ender 5 S1',
        'category' => 'Intermediária',
        'max_power' => 400,
        'avg_power' => 190,
        'power_consumption' => 0.19,
        'bed_size' => '220 x 220 x 280mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Ender 5 com auto-nivelamento e tela touch'
    ],
    'cr-10' => [
        'name' => 'Creality CR-10',
        'category' => 'Grande Formato',
        'max_power' => 400,
        'avg_power' => 220,
        'power_consumption' => 0.22,
        'bed_size' => '300 x 300 x 400mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Impressora de grande formato, popular para projetos grandes'
    ],
    'cr-10-v2' => [
        'name' => 'Creality CR-10 V2',
        'category' => 'Grande Formato',
        'max_power' => 450,
        'avg_power' => 240,
        'power_consumption' => 0.24,
        'bed_size' => '300 x 300 x 400mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Versão melhorada da CR-10 com componentes de melhor qualidade'
    ],
    'cr-10-s' => [
        'name' => 'Creality CR-10S',
        'category' => 'Grande Formato',
        'max_power' => 450,
        'avg_power' => 250,
        'power_consumption' => 0.25,
        'bed_size' => '300 x 300 x 400mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'CR-10 com melhorias de qualidade e confiabilidade'
    ],
    'cr-10-smart' => [
        'name' => 'Creality CR-10 Smart',
        'category' => 'Smart/WiFi',
        'max_power' => 400,
        'avg_power' => 230,
        'power_consumption' => 0.23,
        'bed_size' => '300 x 300 x 400mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Versão inteligente com WiFi e auto-nivelamento'
    ],
    'cr-6-se' => [
        'name' => 'Creality CR-6 SE',
        'category' => 'Intermediária',
        'max_power' => 350,
        'avg_power' => 175,
        'power_consumption' => 0.175,
        'bed_size' => '235 x 235 x 250mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Auto-nivelamento true e montagem simplificada'
    ],
    'cr-30' => [
        'name' => 'Creality CR-30 (PrintMill)',
        'category' => 'Infinita',
        'max_power' => 400,
        'avg_power' => 200,
        'power_consumption' => 0.20,
        'bed_size' => '200 x ∞ x 170mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Impressora com esteira infinita para produção contínua'
    ],
    'ender-7' => [
        'name' => 'Creality Ender 7',
        'category' => 'Alta Velocidade',
        'max_power' => 400,
        'avg_power' => 200,
        'power_consumption' => 0.20,
        'bed_size' => '250 x 250 x 300mm',
        'heated_bed' => true,
        'chamber_type' => 'Aberta',
        'description' => 'Impressora de alta velocidade com design CoreXY'
    ],
    'sermoon-d1' => [
        'name' => 'Creality Sermoon D1',
        'category' => 'Fechada/Industrial',
        'max_power' => 500,
        'avg_power' => 300,
        'power_consumption' => 0.30,
        'bed_size' => '280 x 260 x 310mm',
        'heated_bed' => true,
        'chamber_type' => 'Fechada',
        'description' => 'Impressora fechada industrial com controle preciso de temperatura'
    ],
    'halot-one' => [
        'name' => 'Creality Halot-One (Resina)',
        'category' => 'Resina',
        'max_power' => 80,
        'avg_power' => 50,
        'power_consumption' => 0.05,
        'bed_size' => '127 x 80 x 160mm',
        'heated_bed' => false,
        'chamber_type' => 'Fechada',
        'description' => 'Impressora de resina com tela mono LCD'
    ],
    'halot-sky' => [
        'name' => 'Creality Halot-Sky (Resina)',
        'category' => 'Resina',
        'max_power' => 100,
        'avg_power' => 65,
        'power_consumption' => 0.065,
        'bed_size' => '192 x 120 x 200mm',
        'heated_bed' => false,
        'chamber_type' => 'Fechada',
        'description' => 'Impressora de resina de maior formato'
    ],
    'k1' => [
        'name' => 'Creality K1',
        'category' => 'Alta Velocidade',
        'max_power' => 400,
        'avg_power' => 220,
        'power_consumption' => 0.22,
        'bed_size' => '220 x 220 x 250mm',
        'heated_bed' => true,
        'chamber_type' => 'Fechada',
        'description' => 'Impressora de alta velocidade com AI e auto-calibração'
    ],
    'k1c' => [
        'name' => 'Creality K1C',
        'category' => 'Alta Velocidade',
        'max_power' => 450,
        'avg_power' => 240,
        'power_consumption' => 0.24,
        'bed_size' => '220 x 220 x 250mm',
        'heated_bed' => true,
        'chamber_type' => 'Fechada',
        'description' => 'Versão compacta da K1 com câmara fechada e controle de temperatura'
    ],
    'k1-max' => [
        'name' => 'Creality K1 Max',
        'category' => 'Alta Velocidade',
        'max_power' => 600,
        'avg_power' => 350,
        'power_consumption' => 0.35,
        'bed_size' => '300 x 300 x 300mm',
        'heated_bed' => true,
        'chamber_type' => 'Fechada',
        'description' => 'Versão grande da K1 para impressões de alta velocidade'
    ]
];

// Função para obter lista de impressoras por categoria
function getPrintersByCategory() {
    global $CREALITY_PRINTERS;
    $categories = [];
    
    foreach ($CREALITY_PRINTERS as $key => $printer) {
        $category = $printer['category'];
        if (!isset($categories[$category])) {
            $categories[$category] = [];
        }
        $categories[$category][$key] = $printer;
    }
    
    return $categories;
}

// Função para obter dados de uma impressora específica
function getPrinterData($printer_id) {
    global $CREALITY_PRINTERS;
    return isset($CREALITY_PRINTERS[$printer_id]) ? $CREALITY_PRINTERS[$printer_id] : null;
}

// Função para obter todas as impressoras
function getAllPrinters() {
    global $CREALITY_PRINTERS;
    return $CREALITY_PRINTERS;
}

// Função para exportar configurações para JavaScript
function getPrintersForJS() {
    global $CREALITY_PRINTERS;
    return json_encode($CREALITY_PRINTERS);
}
?>

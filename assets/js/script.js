/**
 * Calculadora de Preço para Impressão 3D
 * Desenvolvido por: davidhxcx
 * Data: 2025
 * 
 * Este script gerencia todos os cálculos de precificação para impressão 3D,
 * incluindo custos de filamento, energia e margem de lucro.
 */

// =============================================================================
// CONFIGURAÇÕES DE IMPRESSORAS CREALITY
// =============================================================================

/**
 * Base de dados com todas as impressoras Creality e seus respectivos consumos energéticos
 */
const CREALITY_PRINTERS = {
    // Entry Level
    'ender-3': { 
        name: 'Creality Ender 3', 
        powerConsumption: 0.12, 
        avgPower: 120, 
        category: 'Entry Level' 
    },
    'ender-3-v2': { 
        name: 'Creality Ender 3 V2', 
        powerConsumption: 0.15, 
        avgPower: 150, 
        category: 'Entry Level' 
    },
    
    // Intermediária
    'ender-3-s1': { 
        name: 'Creality Ender 3 S1', 
        powerConsumption: 0.16, 
        avgPower: 160, 
        category: 'Intermediária' 
    },
    'ender-3-s1-pro': { 
        name: 'Creality Ender 3 S1 Pro', 
        powerConsumption: 0.18, 
        avgPower: 180, 
        category: 'Intermediária' 
    },
    'ender-5': { 
        name: 'Creality Ender 5', 
        powerConsumption: 0.17, 
        avgPower: 170, 
        category: 'Intermediária' 
    },
    'ender-5-s1': { 
        name: 'Creality Ender 5 S1', 
        powerConsumption: 0.19, 
        avgPower: 190, 
        category: 'Intermediária' 
    },
    'cr-6-se': { 
        name: 'Creality CR-6 SE', 
        powerConsumption: 0.175, 
        avgPower: 175, 
        category: 'Intermediária' 
    },
    
    // Fechada/Compacta
    'cr-200b': { 
        name: 'Creality CR-200B', 
        powerConsumption: 0.18, 
        avgPower: 180, 
        category: 'Fechada/Compacta' 
    },
    
    // Grande Formato
    'ender-5-plus': { 
        name: 'Creality Ender 5 Plus', 
        powerConsumption: 0.28, 
        avgPower: 280, 
        category: 'Grande Formato' 
    },
    'cr-10': { 
        name: 'Creality CR-10', 
        powerConsumption: 0.22, 
        avgPower: 220, 
        category: 'Grande Formato' 
    },
    'cr-10-v2': { 
        name: 'Creality CR-10 V2', 
        powerConsumption: 0.24, 
        avgPower: 240, 
        category: 'Grande Formato' 
    },
    'cr-10-s': { 
        name: 'Creality CR-10S', 
        powerConsumption: 0.25, 
        avgPower: 250, 
        category: 'Grande Formato' 
    },
    
    // Smart/WiFi
    'cr-10-smart': { 
        name: 'Creality CR-10 Smart', 
        powerConsumption: 0.23, 
        avgPower: 230, 
        category: 'Smart/WiFi' 
    },
    
    // Alta Velocidade
    'ender-7': { 
        name: 'Creality Ender 7', 
        powerConsumption: 0.20, 
        avgPower: 200, 
        category: 'Alta Velocidade' 
    },
    'k1': { 
        name: 'Creality K1', 
        powerConsumption: 0.22, 
        avgPower: 220, 
        category: 'Alta Velocidade' 
    },
    'k1c': { 
        name: 'Creality K1C', 
        powerConsumption: 0.24, 
        avgPower: 240, 
        category: 'Alta Velocidade' 
    },
    'k1-max': { 
        name: 'Creality K1 Max', 
        powerConsumption: 0.35, 
        avgPower: 350, 
        category: 'Alta Velocidade' 
    },
    
    // Fechada/Industrial
    'sermoon-d1': { 
        name: 'Creality Sermoon D1', 
        powerConsumption: 0.30, 
        avgPower: 300, 
        category: 'Fechada/Industrial' 
    },
    
    // Especiais
    'cr-30': { 
        name: 'Creality CR-30 PrintMill', 
        powerConsumption: 0.20, 
        avgPower: 200, 
        category: 'Especiais' 
    },
    
    // Resina
    'halot-one': { 
        name: 'Creality Halot-One (Resina)', 
        powerConsumption: 0.05, 
        avgPower: 50, 
        category: 'Resina' 
    },
    'halot-sky': { 
        name: 'Creality Halot-Sky (Resina)', 
        powerConsumption: 0.065, 
        avgPower: 65, 
        category: 'Resina' 
    }
};

// =============================================================================
// TARIFAS DE ENERGIA POR ESTADO/REGIÃO
// =============================================================================

/**
 * Base de dados com tarifas de energia elétrica por estado brasileiro
 * Inclui tarifa base + bandeira tarifária atual
 */
const ENERGY_RATES = {
    // Região Sul
    'SC': { 
        state: 'Santa Catarina', 
        distributor: 'CELESC', 
        rate: 0.6346, 
        flag: 0.0446, 
        total: 0.6792 
    },
    'RS': { 
        state: 'Rio Grande do Sul', 
        distributor: 'RGE/CEEE', 
        rate: 0.5890, 
        flag: 0.0446, 
        total: 0.6336 
    },
    'PR': { 
        state: 'Paraná', 
        distributor: 'COPEL', 
        rate: 0.5425, 
        flag: 0.0446, 
        total: 0.5871 
    },
    
    // Região Sudeste
    'SP': { 
        state: 'São Paulo', 
        distributor: 'ENEL/CPFL', 
        rate: 0.6012, 
        flag: 0.0446, 
        total: 0.6458 
    },
    'RJ': { 
        state: 'Rio de Janeiro', 
        distributor: 'LIGHT/ENEL', 
        rate: 0.7234, 
        flag: 0.0446, 
        total: 0.7680 
    },
    'MG': { 
        state: 'Minas Gerais', 
        distributor: 'CEMIG', 
        rate: 0.5892, 
        flag: 0.0446, 
        total: 0.6338 
    },
    'ES': { 
        state: 'Espírito Santo', 
        distributor: 'EDP', 
        rate: 0.5678, 
        flag: 0.0446, 
        total: 0.6124 
    },
    
    // Região Nordeste
    'BA': { 
        state: 'Bahia', 
        distributor: 'COELBA', 
        rate: 0.6234, 
        flag: 0.0446, 
        total: 0.6680 
    },
    'PE': { 
        state: 'Pernambuco', 
        distributor: 'NEOENERGIA', 
        rate: 0.6123, 
        flag: 0.0446, 
        total: 0.6569 
    },
    'CE': { 
        state: 'Ceará', 
        distributor: 'ENEL', 
        rate: 0.5987, 
        flag: 0.0446, 
        total: 0.6433 
    },
    'AL': { 
        state: 'Alagoas', 
        distributor: 'CEAL', 
        rate: 0.6345, 
        flag: 0.0446, 
        total: 0.6791 
    },
    'SE': { 
        state: 'Sergipe', 
        distributor: 'ENERGISA', 
        rate: 0.6178, 
        flag: 0.0446, 
        total: 0.6624 
    },
    'PB': { 
        state: 'Paraíba', 
        distributor: 'ENERGISA', 
        rate: 0.6089, 
        flag: 0.0446, 
        total: 0.6535 
    },
    'RN': { 
        state: 'Rio Grande do Norte', 
        distributor: 'COSERN', 
        rate: 0.6234, 
        flag: 0.0446, 
        total: 0.6680 
    },
    'PI': { 
        state: 'Piauí', 
        distributor: 'CEPISA', 
        rate: 0.5967, 
        flag: 0.0446, 
        total: 0.6413 
    },
    'MA': { 
        state: 'Maranhão', 
        distributor: 'CEMAR', 
        rate: 0.6156, 
        flag: 0.0446, 
        total: 0.6602 
    },
    
    // Região Centro-Oeste
    'MT': { 
        state: 'Mato Grosso', 
        distributor: 'ENERGISA', 
        rate: 0.5834, 
        flag: 0.0446, 
        total: 0.6280 
    },
    'MS': { 
        state: 'Mato Grosso do Sul', 
        distributor: 'ENERGISA', 
        rate: 0.5923, 
        flag: 0.0446, 
        total: 0.6369 
    },
    'GO': { 
        state: 'Goiás', 
        distributor: 'ENEL', 
        rate: 0.5678, 
        flag: 0.0446, 
        total: 0.6124 
    },
    'DF': { 
        state: 'Distrito Federal', 
        distributor: 'CEB', 
        rate: 0.6234, 
        flag: 0.0446, 
        total: 0.6680 
    },
    
    // Região Norte
    'AM': { 
        state: 'Amazonas', 
        distributor: 'AMAZONAS ENERGIA', 
        rate: 0.6789, 
        flag: 0.0446, 
        total: 0.7235 
    },
    'PA': { 
        state: 'Pará', 
        distributor: 'EQUATORIAL', 
        rate: 0.6456, 
        flag: 0.0446, 
        total: 0.6902 
    },
    'AC': { 
        state: 'Acre', 
        distributor: 'ENERGISA', 
        rate: 0.6923, 
        flag: 0.0446, 
        total: 0.7369 
    },
    'RO': { 
        state: 'Rondônia', 
        distributor: 'ENERGISA', 
        rate: 0.6234, 
        flag: 0.0446, 
        total: 0.6680 
    },
    'RR': { 
        state: 'Roraima', 
        distributor: 'RORAIMA ENERGIA', 
        rate: 0.7234, 
        flag: 0.0446, 
        total: 0.7680 
    },
    'AP': { 
        state: 'Amapá', 
        distributor: 'CEA', 
        rate: 0.6890, 
        flag: 0.0446, 
        total: 0.7336 
    },
    'TO': { 
        state: 'Tocantins', 
        distributor: 'ENERGISA', 
        rate: 0.5834, 
        flag: 0.0446, 
        total: 0.6280 
    }
};

// =============================================================================
// CONFIGURAÇÕES GLOBAIS
// =============================================================================

/**
 * Configuração atual da impressora selecionada (padrão: CR-200B)
 */
let currentPrinter = CREALITY_PRINTERS['cr-200b'];

/**
 * Configuração atual da localização selecionada (padrão: Santa Catarina)
 */
let currentLocation = ENERGY_RATES['SC'];

/**
 * Configurações de energia (atualizada dinamicamente conforme localização)
 */
const ENERGY_CONFIG = {
    energyRate: 0.6792 // Padrão SC, será atualizado dinamicamente
};

// =============================================================================
// CLASSE PRINCIPAL - CALCULADORA DE PREÇOS
// =============================================================================

/**
 * Classe responsável por gerenciar todos os cálculos e interações da calculadora
 */
class PriceCalculator {
    /**
     * Construtor da classe - inicializa a calculadora
     */
    constructor() {
        this.init();
    }

    /**
     * Inicializa todos os componentes da calculadora
     */
    init() {
        // Capturar elementos do DOM
        this.form = document.getElementById('priceCalculatorForm');
        this.resultDiv = document.getElementById('result');
        this.printerSelect = document.getElementById('printer_model');
        this.locationSelect = document.getElementById('location');
        
        // Carregar configurações salvas
        this.loadSavedSettings();
        
        // Configurar event listeners
        this.bindEvents();
    }

    /**
     * Carrega configurações salvas do localStorage (impressora e localização)
     */
    loadSavedSettings() {
        // Carregar impressora salva
        const savedPrinter = localStorage.getItem('selectedPrinter');
        if (savedPrinter && CREALITY_PRINTERS[savedPrinter]) {
            this.printerSelect.value = savedPrinter;
            this.updatePrinterConfig(savedPrinter);
        }

        // Carregar localização salva
        const savedLocation = localStorage.getItem('selectedLocation');
        if (savedLocation && ENERGY_RATES[savedLocation]) {
            this.locationSelect.value = savedLocation;
            this.updateLocationConfig(savedLocation);
        }
    }

    /**
     * Configura todos os event listeners da aplicação
     */
    bindEvents() {
        // Event listener para submissão do formulário
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.calculatePrice();
        });

        // Event listener para mudança de impressora
        this.printerSelect.addEventListener('change', (e) => {
            this.updatePrinterConfig(e.target.value);
        });

        // Event listener para mudança de localização
        this.locationSelect.addEventListener('change', (e) => {
            this.updateLocationConfig(e.target.value);
        });

        // Esconder resultado quando campos forem editados
        const inputs = this.form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                this.hideResults();
            });
            input.addEventListener('change', () => {
                this.hideResults();
            });
        });
    }

    /**
     * Atualiza a configuração da impressora selecionada
     * @param {string} printerId - ID da impressora selecionada
     */
    updatePrinterConfig(printerId) {
        if (printerId && CREALITY_PRINTERS[printerId]) {
            currentPrinter = CREALITY_PRINTERS[printerId];
            this.updateTechnicalInfo();
            
            // Salvar preferência do usuário
            localStorage.setItem('selectedPrinter', printerId);
            
            console.log(`Impressora alterada para: ${currentPrinter.name} (${currentPrinter.avgPower}W)`);
        }
    }

    /**
     * Atualiza a configuração da localização/estado selecionado
     * @param {string} locationId - ID do estado selecionado
     */
    updateLocationConfig(locationId) {
        if (locationId && ENERGY_RATES[locationId]) {
            currentLocation = ENERGY_RATES[locationId];
            ENERGY_CONFIG.energyRate = currentLocation.total;
            this.updateTechnicalInfo();
            
            // Salvar preferência do usuário
            localStorage.setItem('selectedLocation', locationId);
            
            console.log(`Localização alterada para: ${currentLocation.state} - ${currentLocation.distributor} (R$ ${currentLocation.total}/kWh)`);
        }
    }

    /**
     * Atualiza as informações técnicas exibidas na interface
     */
    updateTechnicalInfo() {
        // Elementos da interface para atualização
        const powerInfo = document.getElementById('power-info');
        const printerInfo = document.getElementById('printer-info');
        const energyRateInfo = document.getElementById('energy-rate-info');
        const distributorInfo = document.getElementById('distributor-info');
        
        // Atualizar informações da impressora
        if (powerInfo) {
            powerInfo.textContent = ` ${currentPrinter.avgPower}W (${currentPrinter.powerConsumption} kW)`;
        }
        if (printerInfo) {
            printerInfo.textContent = ` ${currentPrinter.name}`;
        }
        
        // Atualizar informações de energia
        if (energyRateInfo) {
            energyRateInfo.textContent = ` R$ ${currentLocation.total.toFixed(4)}/kWh`;
        }
        if (distributorInfo) {
            distributorInfo.textContent = ` ${currentLocation.distributor} - ${currentLocation.state}`;
        }
    }

    /**
     * Valida se todos os campos obrigatórios estão preenchidos
     * @returns {boolean} - True se formulário válido, false caso contrário
     */
    isFormValid() {
        const requiredFields = ['printer_model', 'location', 'filament_weight', 'filament_price_kg', 'print_hours'];
        return requiredFields.every(field => {
            const input = document.getElementById(field);
            if (field === 'printer_model' || field === 'location') {
                return input.value && input.value !== '';
            }
            return input.value && parseFloat(input.value) >= 0;
        });
    }

    /**
     * Método principal para calcular o preço da impressão
     */
    calculatePrice() {
        try {
            // Adiciona estado de loading
            this.form.classList.add('loading');

            // Obter valores do formulário
            const printerModel = document.getElementById('printer_model').value;
            const location = document.getElementById('location').value;
            const filamentWeight = parseFloat(document.getElementById('filament_weight').value);
            const filamentPriceKg = parseFloat(document.getElementById('filament_price_kg').value);
            const printHours = parseFloat(document.getElementById('print_hours').value);
            const profitMargin = parseFloat(document.getElementById('profit_margin').value) || 50;

            // Validações de entrada
            this.validateInputs(printerModel, location, filamentWeight, filamentPriceKg, printHours);

            // Atualizar configurações se necessário
            if (printerModel !== this.getCurrentPrinterId()) {
                this.updatePrinterConfig(printerModel);
            }
            if (location !== this.getCurrentLocationId()) {
                this.updateLocationConfig(location);
            }

            // Realizar cálculos
            const calculations = this.performCalculations(
                filamentWeight, 
                filamentPriceKg, 
                printHours, 
                profitMargin
            );

            // Exibir resultados
            this.displayResults(calculations);

            // Log para debug
            console.log('Cálculos realizados:', calculations);

        } catch (error) {
            this.showError(error.message);
        } finally {
            // Remove estado de loading
            setTimeout(() => {
                this.form.classList.remove('loading');
            }, 500);
        }
    }

    /**
     * Valida todos os inputs do formulário
     * @param {string} printerModel - Modelo da impressora
     * @param {string} location - Localização selecionada
     * @param {number} filamentWeight - Peso do filamento
     * @param {number} filamentPriceKg - Preço do filamento por kg
     * @param {number} printHours - Tempo de impressão
     */
    validateInputs(printerModel, location, filamentWeight, filamentPriceKg, printHours) {
        if (!printerModel) {
            throw new Error('Selecione o modelo da impressora');
        }
        if (!location) {
            throw new Error('Selecione sua localização/estado');
        }
        if (isNaN(filamentWeight) || filamentWeight <= 0) {
            throw new Error('Peso do filamento deve ser um valor positivo');
        }
        if (isNaN(filamentPriceKg) || filamentPriceKg <= 0) {
            throw new Error('Preço do filamento deve ser um valor positivo');
        }
        if (isNaN(printHours) || printHours <= 0) {
            throw new Error('Tempo de impressão deve ser um valor positivo');
        }
    }

    getCurrentPrinterId() {
        return this.printerSelect.value;
    }

    getCurrentLocationId() {
        return this.locationSelect.value;
    }

    hideResults() {
        // Esconder seção de resultados quando campos forem editados
        if (this.resultDiv && this.resultDiv.style.display !== 'none') {
            this.resultDiv.style.display = 'none';
            
            // Adicionar uma animação suave de fade out
            this.resultDiv.style.opacity = '0.5';
            setTimeout(() => {
                this.resultDiv.style.opacity = '1';
            }, 200);
        }
    }

    performCalculations(filamentWeight, filamentPriceKg, printHours, profitMargin) {
        // Custo do filamento (peso em gramas para kg)
        const filamentCost = (filamentWeight / 1000) * filamentPriceKg;

        // Custo de energia usando a impressora selecionada
        const energyCost = printHours * currentPrinter.powerConsumption * ENERGY_CONFIG.energyRate;

        // Custo total
        const totalCost = filamentCost + energyCost;

        // Preço sugerido com margem de lucro
        const suggestedPrice = totalCost * (1 + profitMargin / 100);

        return {
            filamentWeight,
            filamentPriceKg,
            printHours,
            profitMargin,
            filamentCost,
            energyCost,
            totalCost,
            suggestedPrice,
            printerModel: currentPrinter.name,
            powerConsumption: currentPrinter.powerConsumption,
            energyRate: ENERGY_CONFIG.energyRate
        };
    }

    displayResults(calculations) {
        // Atualizar valores na interface
        document.getElementById('filament_cost').textContent = this.formatCurrency(calculations.filamentCost);
        document.getElementById('energy_cost').textContent = this.formatCurrency(calculations.energyCost);
        document.getElementById('total_cost').textContent = this.formatCurrency(calculations.totalCost);
        document.getElementById('suggested_price').textContent = this.formatCurrency(calculations.suggestedPrice);

        // Mostrar seção de resultados com animação
        this.resultDiv.style.display = 'block';
        this.resultDiv.scrollIntoView({ behavior: 'smooth' });

        // Salvar último cálculo no localStorage
        this.saveLastCalculation(calculations);
    }

    formatCurrency(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(value);
    }

    showError(message) {
        alert(`Erro: ${message}`);
        console.error('Erro no cálculo:', message);
    }

    saveLastCalculation(calculations) {
        try {
            localStorage.setItem('lastCalculation', JSON.stringify({
                ...calculations,
                timestamp: new Date().toISOString()
            }));
        } catch (error) {
            console.warn('Não foi possível salvar o cálculo:', error);
        }
    }

    loadLastCalculation() {
        try {
            const saved = localStorage.getItem('lastCalculation');
            if (saved) {
                const calculation = JSON.parse(saved);
                
                // Preencher formulário com último cálculo
                document.getElementById('filament_weight').value = calculation.filamentWeight;
                document.getElementById('filament_price_kg').value = calculation.filamentPriceKg;
                document.getElementById('print_hours').value = calculation.printHours;
                document.getElementById('profit_margin').value = calculation.profitMargin;

                return calculation;
            }
        } catch (error) {
            console.warn('Não foi possível carregar último cálculo:', error);
        }
        return null;
    }
}

// Utilitários para relatórios e histórico
class CalculationHistory {
    constructor() {
        this.history = this.loadHistory();
    }

    add(calculation) {
        const entry = {
            ...calculation,
            id: Date.now(),
            timestamp: new Date().toISOString()
        };
        
        this.history.unshift(entry);
        
        // Manter apenas os últimos 50 cálculos
        if (this.history.length > 50) {
            this.history = this.history.slice(0, 50);
        }
        
        this.saveHistory();
        return entry;
    }

    getHistory() {
        return this.history;
    }

    clear() {
        this.history = [];
        this.saveHistory();
    }

    loadHistory() {
        try {
            const saved = localStorage.getItem('calculationHistory');
            return saved ? JSON.parse(saved) : [];
        } catch (error) {
            console.warn('Erro ao carregar histórico:', error);
            return [];
        }
    }

    saveHistory() {
        try {
            localStorage.setItem('calculationHistory', JSON.stringify(this.history));
        } catch (error) {
            console.warn('Erro ao salvar histórico:', error);
        }
    }

    exportToCsv() {
        if (this.history.length === 0) {
            alert('Nenhum cálculo para exportar');
            return;
        }

        const headers = [
            'Data/Hora',
            'Peso Filamento (g)',
            'Preço Filamento (R$/kg)',
            'Tempo Impressão (h)',
            'Margem Lucro (%)',
            'Custo Filamento (R$)',
            'Custo Energia (R$)',
            'Custo Total (R$)',
            'Preço Sugerido (R$)'
        ];

        const csvContent = [
            headers.join(','),
            ...this.history.map(calc => [
                new Date(calc.timestamp).toLocaleString('pt-BR'),
                calc.filamentWeight,
                calc.filamentPriceKg.toFixed(2),
                calc.printHours,
                calc.profitMargin,
                calc.filamentCost.toFixed(2),
                calc.energyCost.toFixed(2),
                calc.totalCost.toFixed(2),
                calc.suggestedPrice.toFixed(2)
            ].join(','))
        ].join('\n');

        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `historico_calculos_3d_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();
    }
}

// Inicialização quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    console.log('Aplicação de Cálculo de Preço 3D carregada');
    
    // Inicializar calculadora
    const calculator = new PriceCalculator();
    
    // Inicializar histórico
    const history = new CalculationHistory();
    
    // Carregar último cálculo se existir
    const lastCalculation = calculator.loadLastCalculation();
    if (lastCalculation) {
        console.log('Último cálculo carregado:', lastCalculation);
    }

    // Adicionar funcionalidades extras
    addExtraFeatures(calculator, history);
});

function addExtraFeatures(calculator, history) {
    // Adicionar tooltips informativos
    addTooltips();
    
    // Adicionar atalhos de teclado
    addKeyboardShortcuts(calculator);
    
    // Adicionar validação em tempo real
    addRealTimeValidation();
}

function addTooltips() {
    const tooltips = {
        'filament_weight': 'Peso do filamento usado na impressão. Você pode obter este valor do seu software de fatiamento (slicer).',
        'filament_price_kg': 'Preço pago pelo quilo do filamento. Divida o preço total pelo peso da bobina.',
        'print_hours': 'Tempo total de impressão. Este valor é fornecido pelo seu software de fatiamento.',
        'profit_margin': 'Margem de lucro desejada. Valores típicos variam entre 30% a 80%.'
    };

    Object.keys(tooltips).forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.title = tooltips[id];
        }
    });
}

function addKeyboardShortcuts(calculator) {
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter para calcular
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            calculator.calculatePrice();
        }
    });
}

function addRealTimeValidation() {
    const inputs = document.querySelectorAll('input[type="number"]');
    
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateInput(this);
        });
        
        input.addEventListener('blur', function() {
            formatInput(this);
        });
    });
}

function validateInput(input) {
    const value = parseFloat(input.value);
    
    // Remove classe de erro anterior
    input.classList.remove('error');
    
    // Validação específica por campo
    if (input.id === 'filament_weight' && (isNaN(value) || value <= 0)) {
        input.classList.add('error');
    } else if (input.id === 'filament_price_kg' && (isNaN(value) || value <= 0)) {
        input.classList.add('error');
    } else if (input.id === 'print_hours' && (isNaN(value) || value <= 0)) {
        input.classList.add('error');
    } else if (input.id === 'profit_margin' && (isNaN(value) || value < 0)) {
        input.classList.add('error');
    }
}

function formatInput(input) {
    const value = parseFloat(input.value);
    
    if (!isNaN(value)) {
        if (input.id === 'filament_price_kg') {
            input.value = value.toFixed(2);
        } else if (input.id === 'filament_weight') {
            input.value = value.toFixed(1);
        } else if (input.id === 'print_hours') {
            input.value = value.toFixed(1);
        } else if (input.id === 'profit_margin') {
            input.value = Math.round(value);
        }
    }
}

// Exportar para uso global se necessário
window.PriceCalculator = PriceCalculator;

// =============================================================================
// INICIALIZAÇÃO DA APLICAÇÃO
// =============================================================================

/**
 * Inicializa a aplicação quando o DOM estiver carregado
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Calculadora de Preço 3D - Inicializando...');
    
    // Instanciar a calculadora
    const calculator = new PriceCalculator();
    
    // Adicionar funcionalidades extras
    addTooltips();
    addKeyboardShortcuts(calculator);
    addRealTimeValidation();
    
    console.log('✅ Calculadora inicializada com sucesso!');
    console.log('📝 Desenvolvido por: davidhxcx');
});

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Cálculos - Impressão 3D</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
    <link rel="icon" type="image/svg+xml" sizes="32x32" href="assets/images/favicon-32.svg">
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="assets/images/favicon-16.svg">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .history-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .history-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s ease;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .btn-export {
            background: #28a745;
        }
        
        .btn-export:hover {
            background: #218838;
        }
        
        .btn-clear {
            background: #dc3545;
        }
        
        .btn-clear:hover {
            background: #c82333;
        }
        
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .history-table th,
        .history-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .history-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        .history-table tr:hover {
            background: #f8f9fa;
        }
        
        .currency {
            color: #28a745;
            font-weight: 600;
        }
        
        .timestamp {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .loading-spinner {
            text-align: center;
            padding: 40px;
        }
        
        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @media (max-width: 768px) {
            .history-table {
                font-size: 0.9rem;
            }
            
            .history-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-secondary {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-history"></i> Histórico de Cálculos</h1>
            <p>Visualize e gerencie seus cálculos anteriores</p>
        </header>

        <div class="history-container">
            <div class="history-controls">
                <h3><i class="fas fa-list"></i> Cálculos Realizados</h3>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="index.php" class="btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                    <button id="exportBtn" class="btn-secondary btn-export">
                        <i class="fas fa-download"></i> Exportar CSV
                    </button>
                    <button id="clearBtn" class="btn-secondary btn-clear">
                        <i class="fas fa-trash"></i> Limpar Histórico
                    </button>
                </div>
            </div>

            <div id="loadingSpinner" class="loading-spinner">
                <div class="spinner"></div>
                <p>Carregando histórico...</p>
            </div>

            <div id="historyContent" style="display: none;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Peso (g)</th>
                            <th>Preço/kg</th>
                            <th>Tempo (h)</th>
                            <th>Margem (%)</th>
                            <th>Custo Total</th>
                            <th>Preço Sugerido</th>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody">
                    </tbody>
                </table>
            </div>

            <div id="noData" class="no-data" style="display: none;">
                <i class="fas fa-inbox" style="font-size: 3rem; color: #dee2e6; margin-bottom: 15px;"></i>
                <h4>Nenhum cálculo encontrado</h4>
                <p>Realize seu primeiro cálculo para começar a ver o histórico aqui.</p>
                <a href="index.php" class="btn-secondary" style="margin-top: 15px;">
                    <i class="fas fa-calculator"></i> Fazer Cálculo
                </a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Calculadora de Preço 3D - Histórico de Cálculos</p>
    </footer>

    <script>
        class HistoryManager {
            constructor() {
                this.init();
            }

            init() {
                this.loadHistory();
                this.bindEvents();
            }

            bindEvents() {
                document.getElementById('exportBtn').addEventListener('click', () => {
                    this.exportToCSV();
                });

                document.getElementById('clearBtn').addEventListener('click', () => {
                    this.clearHistory();
                });
            }

            async loadHistory() {
                try {
                    const response = await fetch('api.php?action=history&limit=50');
                    const result = await response.json();

                    if (result.success && result.data.length > 0) {
                        this.displayHistory(result.data);
                    } else {
                        this.showNoData();
                    }
                } catch (error) {
                    console.error('Erro ao carregar histórico:', error);
                    this.showError();
                }
            }

            displayHistory(calculations) {
                const tbody = document.getElementById('historyTableBody');
                tbody.innerHTML = '';

                calculations.forEach(calc => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="timestamp">${this.formatDate(calc.timestamp)}</td>
                        <td>${calc.input.filament_weight}g</td>
                        <td class="currency">${this.formatCurrency(calc.input.filament_price_kg)}</td>
                        <td>${calc.input.print_hours}h</td>
                        <td>${calc.input.profit_margin}%</td>
                        <td class="currency">${this.formatCurrency(calc.costs.total_cost)}</td>
                        <td class="currency">${this.formatCurrency(calc.pricing.suggested_price)}</td>
                    `;
                    tbody.appendChild(row);
                });

                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('historyContent').style.display = 'block';
            }

            showNoData() {
                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('noData').style.display = 'block';
            }

            showError() {
                document.getElementById('loadingSpinner').style.display = 'none';
                document.getElementById('noData').style.display = 'block';
                document.querySelector('#noData h4').textContent = 'Erro ao carregar histórico';
                document.querySelector('#noData p').textContent = 'Tente novamente mais tarde.';
            }

            formatDate(timestamp) {
                return new Date(timestamp).toLocaleString('pt-BR');
            }

            formatCurrency(value) {
                return new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }).format(value);
            }

            async exportToCSV() {
                try {
                    const response = await fetch('api.php?action=history&limit=1000');
                    const result = await response.json();

                    if (!result.success || result.data.length === 0) {
                        alert('Nenhum dado para exportar');
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
                        ...result.data.map(calc => [
                            this.formatDate(calc.timestamp),
                            calc.input.filament_weight,
                            calc.input.filament_price_kg.toFixed(2),
                            calc.input.print_hours,
                            calc.input.profit_margin,
                            calc.costs.filament_cost.toFixed(2),
                            calc.costs.energy_cost.toFixed(2),
                            calc.costs.total_cost.toFixed(2),
                            calc.pricing.suggested_price.toFixed(2)
                        ].join(','))
                    ].join('\n');

                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = `historico_calculos_3d_${new Date().toISOString().split('T')[0]}.csv`;
                    link.click();
                } catch (error) {
                    console.error('Erro ao exportar:', error);
                    alert('Erro ao exportar dados');
                }
            }

            clearHistory() {
                if (confirm('Tem certeza que deseja limpar todo o histórico? Esta ação não pode ser desfeita.')) {
                    // Como estamos usando localStorage no frontend, vamos limpar apenas do navegador
                    localStorage.removeItem('calculationHistory');
                    localStorage.removeItem('lastCalculation');
                    
                    alert('Histórico local limpo com sucesso!');
                    this.loadHistory();
                }
            }
        }

        // Inicializar quando o DOM estiver pronto
        document.addEventListener('DOMContentLoaded', function() {
            new HistoryManager();
        });
    </script>
</body>
</html>

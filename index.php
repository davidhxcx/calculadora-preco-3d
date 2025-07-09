<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Preço - Impressão 3D</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">
    <link rel="icon" type="image/svg+xml" sizes="32x32" href="assets/images/favicon-32.svg">
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="assets/images/favicon-16.svg">
    <link rel="shortcut icon" href="assets/images/favicon.svg">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#667eea">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Calc3D">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-cube"></i> Calculadora de Preço - Impressão 3D</h1>
            <p>Calcule o preço justo para suas peças impressas em 3D</p>
        </header>

        <div class="calculator-card">
            <form id="priceCalculatorForm">
                <div class="form-group">
                    <label for="printer_model">
                        <i class="fas fa-print"></i> Modelo da Impressora:
                    </label>
                    <select id="printer_model" name="printer_model" required>
                        <option value="">Selecione sua impressora Creality</option>
                        <optgroup label="Entry Level">
                            <option value="ender-3">Creality Ender 3 (120W)</option>
                            <option value="ender-3-v2">Creality Ender 3 V2 (150W)</option>
                        </optgroup>
                        <optgroup label="Intermediária">
                            <option value="ender-3-s1">Creality Ender 3 S1 (160W)</option>
                            <option value="ender-3-s1-pro">Creality Ender 3 S1 Pro (180W)</option>
                            <option value="ender-5">Creality Ender 5 (170W)</option>
                            <option value="ender-5-s1">Creality Ender 5 S1 (190W)</option>
                            <option value="cr-6-se">Creality CR-6 SE (175W)</option>
                        </optgroup>
                        <optgroup label="Fechada/Compacta">
                            <option value="cr-200b" selected>Creality CR-200B (180W)</option>
                        </optgroup>
                        <optgroup label="Grande Formato">
                            <option value="ender-5-plus">Creality Ender 5 Plus (280W)</option>
                            <option value="cr-10">Creality CR-10 (220W)</option>
                            <option value="cr-10-v2">Creality CR-10 V2 (240W)</option>
                            <option value="cr-10-s">Creality CR-10S (250W)</option>
                        </optgroup>
                        <optgroup label="Smart/WiFi">
                            <option value="cr-10-smart">Creality CR-10 Smart (230W)</option>
                        </optgroup>
                        <optgroup label="Alta Velocidade">
                            <option value="ender-7">Creality Ender 7 (200W)</option>
                            <option value="k1">Creality K1 (220W)</option>
                            <option value="k1c">Creality K1C (240W)</option>
                            <option value="k1-max">Creality K1 Max (350W)</option>
                        </optgroup>
                        <optgroup label="Fechada/Industrial">
                            <option value="sermoon-d1">Creality Sermoon D1 (300W)</option>
                        </optgroup>
                        <optgroup label="Especiais">
                            <option value="cr-30">Creality CR-30 PrintMill (200W)</option>
                        </optgroup>
                        <optgroup label="Resina">
                            <option value="halot-one">Creality Halot-One (50W)</option>
                            <option value="halot-sky">Creality Halot-Sky (65W)</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label for="location">
                        <i class="fas fa-map-marker-alt"></i> Localização (Estado/Cidade):
                    </label>
                    <select id="location" name="location" required>
                        <option value="">Selecione seu estado/cidade</option>
                        <optgroup label="Região Sul">
                            <option value="SC" selected>Santa Catarina - CELESC (R$ 0,6792/kWh)</option>
                            <option value="RS">Rio Grande do Sul - RGE/CEEE (R$ 0,6336/kWh)</option>
                            <option value="PR">Paraná - COPEL (R$ 0,5871/kWh)</option>
                        </optgroup>
                        <optgroup label="Região Sudeste">
                            <option value="SP">São Paulo - ENEL/CPFL (R$ 0,6458/kWh)</option>
                            <option value="RJ">Rio de Janeiro - LIGHT/ENEL (R$ 0,7680/kWh)</option>
                            <option value="MG">Minas Gerais - CEMIG (R$ 0,6338/kWh)</option>
                            <option value="ES">Espírito Santo - EDP (R$ 0,6124/kWh)</option>
                        </optgroup>
                        <optgroup label="Região Nordeste">
                            <option value="BA">Bahia - COELBA (R$ 0,6680/kWh)</option>
                            <option value="PE">Pernambuco - NEOENERGIA (R$ 0,6569/kWh)</option>
                            <option value="CE">Ceará - ENEL (R$ 0,6433/kWh)</option>
                            <option value="AL">Alagoas - CEAL (R$ 0,6791/kWh)</option>
                            <option value="SE">Sergipe - ENERGISA (R$ 0,6624/kWh)</option>
                            <option value="PB">Paraíba - ENERGISA (R$ 0,6535/kWh)</option>
                            <option value="RN">Rio Grande do Norte - COSERN (R$ 0,6680/kWh)</option>
                            <option value="PI">Piauí - CEPISA (R$ 0,6413/kWh)</option>
                            <option value="MA">Maranhão - CEMAR (R$ 0,6602/kWh)</option>
                        </optgroup>
                        <optgroup label="Região Centro-Oeste">
                            <option value="MT">Mato Grosso - ENERGISA (R$ 0,6280/kWh)</option>
                            <option value="MS">Mato Grosso do Sul - ENERGISA (R$ 0,6369/kWh)</option>
                            <option value="GO">Goiás - ENEL (R$ 0,6124/kWh)</option>
                            <option value="DF">Distrito Federal - CEB (R$ 0,6680/kWh)</option>
                        </optgroup>
                        <optgroup label="Região Norte">
                            <option value="AM">Amazonas - AMAZONAS ENERGIA (R$ 0,7235/kWh)</option>
                            <option value="PA">Pará - EQUATORIAL (R$ 0,6902/kWh)</option>
                            <option value="AC">Acre - ENERGISA (R$ 0,7369/kWh)</option>
                            <option value="RO">Rondônia - ENERGISA (R$ 0,6680/kWh)</option>
                            <option value="RR">Roraima - RORAIMA ENERGIA (R$ 0,7680/kWh)</option>
                            <option value="AP">Amapá - CEA (R$ 0,7336/kWh)</option>
                            <option value="TO">Tocantins - ENERGISA (R$ 0,6280/kWh)</option>
                        </optgroup>
                    </select>
                </div>

                <div class="form-group">
                    <label for="filament_weight">
                        <i class="fas fa-weight"></i> Peso do filamento usado (gramas):
                    </label>
                    <input type="number" id="filament_weight" name="filament_weight" 
                           step="0.1" min="0" required placeholder="Ex: 15.5">
                </div>

                <div class="form-group">
                    <label for="filament_price_kg">
                        <i class="fas fa-money-bill"></i> Preço do filamento (R$/kg):
                    </label>
                    <input type="number" id="filament_price_kg" name="filament_price_kg" 
                           step="0.01" min="0" required placeholder="Ex: 85.00">
                </div>

                <div class="form-group">
                    <label for="print_hours">
                        <i class="fas fa-clock"></i> Tempo de impressão (horas):
                    </label>
                    <input type="number" id="print_hours" name="print_hours" 
                           step="0.1" min="0" required placeholder="Ex: 3.5">
                </div>

                <div class="form-group">
                    <label for="profit_margin">
                        <i class="fas fa-percentage"></i> Margem de lucro (%):
                    </label>
                    <input type="number" id="profit_margin" name="profit_margin" 
                           step="1" min="0" value="50" placeholder="Ex: 50">
                </div>

                <button type="submit" class="btn-calculate">
                    <i class="fas fa-calculator"></i> Calcular Preço
                </button>
                
                <p style="text-align: center; color: #666; font-size: 0.9rem; margin-top: 10px;">
                    <i class="fas fa-info-circle"></i> Preencha todos os campos e clique em "Calcular Preço" para ver o resultado
                </p>

                <div style="text-align: center; margin-top: 15px;">
                    <a href="history.php" style="color: #667eea; text-decoration: none;">
                        <i class="fas fa-history"></i> Ver Histórico de Cálculos
                    </a>
                </div>
            </form>

            <div id="result" class="result-container" style="display: none;">
                <h3><i class="fas fa-chart-line"></i> Resultado do Cálculo</h3>
                <div class="result-grid">
                    <div class="result-item">
                        <span class="label">Custo do Filamento:</span>
                        <span class="value" id="filament_cost">R$ 0,00</span>
                    </div>
                    <div class="result-item">
                        <span class="label">Custo de Energia:</span>
                        <span class="value" id="energy_cost">R$ 0,00</span>
                    </div>
                    <div class="result-item">
                        <span class="label">Custo Total:</span>
                        <span class="value" id="total_cost">R$ 0,00</span>
                    </div>
                    <div class="result-item highlight">
                        <span class="label">Preço Sugerido:</span>
                        <span class="value" id="suggested_price">R$ 0,00</span>
                    </div>
                </div>
                
                <div class="info-section">
                    <h4><i class="fas fa-info-circle"></i> Informações Técnicas</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Consumo da Impressora:</strong><span id="power-info"> 180W (0,18 kW)</span>
                        </div>
                        <div class="info-item">
                            <strong>Tarifa de Energia:</strong><span id="energy-rate-info"> R$ 0,6792/kWh</span>
                        </div>
                        <div class="info-item">
                            <strong>Modelo da Impressora:</strong><span id="printer-info"> Creality CR-200B</span>
                        </div>
                        <div class="info-item">
                            <strong>Distribuidora:</strong><span id="distributor-info"> CELESC - Santa Catarina</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tips-section">
            <h3><i class="fas fa-lightbulb"></i> Dicas para Precificação</h3>
            <div class="tips-grid">
                <div class="tip-card">
                    <i class="fas fa-coins"></i>
                    <h4>Margem de Lucro</h4>
                    <p>Considere uma margem entre 30% a 80% dependendo da complexidade da peça e demanda do mercado.</p>
                </div>
                <div class="tip-card">
                    <i class="fas fa-tools"></i>
                    <h4>Custo de Manutenção</h4>
                    <p>Inclua custos de manutenção da impressora, desgaste de componentes e tempo de pós-processamento.</p>
                </div>
                <div class="tip-card">
                    <i class="fas fa-clock"></i>
                    <h4>Tempo de Trabalho</h4>
                    <p>Considere o tempo de preparação, monitoramento e acabamento além do tempo de impressão.</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Calculadora de Preço 3D - Desenvolvido por: davidhxcx</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>

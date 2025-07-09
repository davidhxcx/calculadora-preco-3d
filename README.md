# Calculadora de Preço - Impressão 3D

**Desenvolvido por:** davidhxcx  
**Versão:** 1.0  
**Ano:** 2025  
**Licença:** CC BY 4.0 (Atribuição obrigatória)

Uma aplicação web completa para calcular o preço justo de peças impressas em 3D, considerando múltiplos fatores como consumo energético, preço do filamento, tempo de impressão e margem de lucro.

## � Principais Características

- **25+ Modelos de Impressoras Creality**: Suporte completo com consumos específicos
- **Cobertura Nacional**: Tarifas de energia de todos os 27 estados brasileiros
- **Cálculo Preciso**: Considera filamento, energia e margem de lucro
- **Interface Moderna**: Design responsivo e profissional
- **PWA**: Funciona como aplicativo instalável
- **Persistência**: Salva configurações e histórico

## 📋 Funcionalidades Principais

### 🖨️ Seletor de Impressoras
- **Modelos suportados**: Ender 3, Ender 5, CR-10, K1, CR-200B e muitas outras
- **Categorias organizadas**: Entry Level, Intermediária, Grande Formato, Alta Velocidade
- **Consumo específico**: Cada modelo tem seu consumo energético real
- **Atualização automática**: Valores se ajustam conforme seleção

### 🗺️ Localização Nacional
- **Todos os estados**: 27 unidades federativas brasileiras
- **Distribuidoras específicas**: CELESC, COPEL, CEMIG, LIGHT, ENEL, etc.
- **Tarifas atualizadas**: Valores 2024/2025 com bandeiras tarifárias
- **Organização regional**: Sul, Sudeste, Nordeste, Centro-Oeste, Norte

### 🧮 Cálculo Detalhado
- **Custo do filamento**: Baseado no peso usado e preço por kg
- **Custo de energia**: Impressora específica × tempo × tarifa local
- **Margem de lucro**: Configurável pelo usuário
- **Resultado completo**: Custos separados e preço final sugerido
- Tooltips informativos
- Atalhos de teclado

## 🔧 Configuração Técnica

### Impressora: Creality CR-200B
- **Potência máxima**: 350W
- **Consumo médio**: 180W (0,18 kW)
- **Tipo**: Câmara fechada

### Energia Elétrica (SC - Celesc)
- **Tarifa base**: R$ 0,59/kWh
- **Bandeira vermelha 1**: +R$ 0,0446/kWh
- **Total**: R$ 0,6346/kWh

## 🚀 Instalação

### Requisitos
- Servidor web (Apache/Nginx)
- PHP 7.4+
- Navegador moderno

### Passos
1. Clone ou baixe os arquivos para seu servidor web
2. Certifique-se que o PHP está funcionando
3. Acesse `index.php` no navegador
4. Configure as permissões da pasta `data/` para gravação (se usar API)

## 🏗️ Estrutura do Projeto

```
price_calculator/
├── index.php                 # Página principal da aplicação
├── README.md                 # Documentação do projeto
├── assets/
│   ├── js/
│   │   └── script.js         # Lógica JavaScript (950+ linhas comentadas)
│   ├── css/
│   │   ├── style.css         # Estilos principais
│   │   └── responsive.css    # Estilos responsivos
│   └── images/
│       ├── favicon.svg       # Favicon principal
│       ├── favicon-32.svg    # Favicon 32x32
│       └── favicon-16.svg    # Favicon 16x16
├── energy_rates.php          # Base de dados de tarifas energéticas (27 estados)
├── printers.php              # Base de dados de impressoras Creality (25+ modelos)
├── history.php               # Sistema de histórico de cálculos
├── api.php                   # API REST para operações backend
├── config.php                # Configurações gerais da aplicação
├── manifest.json             # Configuração PWA (Progressive Web App)
├── .htaccess                 # Configurações do servidor Apache
├── composer.json             # Dependências e configurações PHP
└── package.json              # Dependências e scripts Node.js
```

## � Instalação

### Requisitos
- **Servidor web** (Apache/Nginx) com PHP habilitado
- **PHP 7.4+** 
- **Navegador moderno** com suporte a ES6+

### Passos
1. **Clone** ou baixe os arquivos para seu servidor web
2. **Configure** as permissões adequadas para o diretório
3. **Acesse** `index.php` no navegador
4. **Teste** a funcionalidade selecionando uma impressora e localização

## 💻 Como Usar

### 📋 Cálculo Passo a Passo
1. **Selecione sua impressora** Creality no dropdown (25+ modelos disponíveis)
2. **Escolha seu estado/região** para aplicar a tarifa energética correta
3. **Preencha os dados da impressão:**
   - Peso do filamento usado (gramas)
   - Preço do filamento (R$/kg)
   - Tempo de impressão (horas)
   - Margem de lucro desejada (%)
4. **Clique em "Calcular Preço"** para ver o resultado detalhado

### 📊 Interpretando os Resultados
- **Custo do Filamento**: Baseado no peso usado × preço por kg
- **Custo de Energia**: Consumo da impressora × tempo × tarifa local
- **Custo Total**: Soma de filamento + energia
- **Preço Sugerido**: Custo total + margem de lucro aplicada

### 📱 Funcionalidades Especiais
- **Salvamento automático**: Suas preferências de impressora e localização são salvas
- **Atualização dinâmica**: Informações técnicas se atualizam conforme seleção
- **Responsivo**: Funciona perfeitamente em mobile e desktop
- **PWA**: Pode ser instalado como aplicativo no dispositivo

### 💡 Exemplo Prático
**Configuração:**
- Impressora: Creality Ender 3 V2 (150W)
- Localização: São Paulo (R$ 0,6458/kWh)
- Peso: 25g de PLA
- Preço filamento: R$ 85,00/kg
- Tempo: 3 horas
- Margem: 50%

**Resultado:**
- Custo filamento: R$ 2,13
- Custo energia: R$ 0,29
- Custo total: R$ 2,42
- **Preço sugerido: R$ 3,63**
- Margem: 60%

**Resultado:**
- Custo filamento: R$ 2,00
- Custo energia: R$ 0,29
- Custo total: R$ 2,29
- **Preço sugerido: R$ 3,66**

## 🔌 API REST

### Endpoints Disponíveis

#### POST /api.php
```json
{
  "action": "calculate",
  "filament_weight": 25,
  "filament_price_kg": 80,
  "print_hours": 2.5,
  "profit_margin": 60
}
```

#### GET /api.php?action=energy_info
Retorna informações sobre tarifas e impressora

#### GET /api.php?action=history&limit=10
Lista últimos cálculos salvos

### Exemplo de Resposta
```json
{
  "success": true,
  "data": {
    "costs": {
      "filament_cost": 2.00,
      "energy_cost": 0.29,
      "total_cost": 2.29
    },
    "pricing": {
      "suggested_price": 3.66,
      "profit_amount": 1.37
    }
  }
}
```

## 📱 Recursos Móveis

- Design totalmente responsivo
- Interface otimizada para touch
- Funciona offline (cálculos locais)
- PWA-ready (pode ser instalado no celular)

## 📱 Aplicativo Mobile Android

### 🎯 **Nova Versão Mobile!**
Além da versão web, agora a calculadora está disponível como **aplicativo nativo Android**!

#### **📁 Localização:**
```
price_calculator/mobile-app/
```

#### **🚀 Recursos Exclusivos do App:**
- **Interface otimizada** para touch screen
- **Funcionamento offline** completo
- **Feedback tátil** (vibração)
- **Compartilhamento** de resultados
- **Histórico** de cálculos salvos
- **Design Material** adaptado para mobile

#### **📱 Como Fazer Build:**
```powershell
# Navegue até a pasta mobile
cd mobile-app

# Build para testes
.\build-debug.bat

# Build para produção (Play Store)
.\build-release.bat
```

#### **🏪 Publicação na Play Store:**
Consulte o guia completo em:
```
mobile-app/BUILD_AND_PUBLISH_GUIDE.md
```

## 🎯 Dicas de Precificação

### Margens Recomendadas
- **Peças simples**: 30-50%
- **Peças complexas**: 50-80%
- **Protótipos**: 80-150%
- **Peças únicas**: 100%+

### Fatores Adicionais
- Pós-processamento (lixamento, pintura)
- Complexidade do design
- Tempo de preparação
- Falhas e reprints
- Desgaste de equipamentos

## 🔧 Personalização e Configuração

### 🖨️ Adicionando Nova Impressora
Para adicionar um novo modelo, edite os arquivos:

**1. JavaScript** (`assets/js/script.js`):
```javascript
const CREALITY_PRINTERS = {
    // ...existing code...
    'nova-impressora': { 
        name: 'Nova Impressora', 
        powerConsumption: 0.20, 
        avgPower: 200, 
        category: 'Categoria' 
    }
};
```

**2. HTML** (`index.php`):
```html
<optgroup label="Categoria">
    <option value="nova-impressora">Nova Impressora (200W)</option>
</optgroup>
```

### ⚡ Atualizando Tarifas Energéticas
Para atualizar uma tarifa, modifique `energy_rates.php`:
```php
$ENERGY_RATES = [
    'UF' => [
        'state' => 'Nome do Estado',
        'distributor' => 'Distribuidora',
        'rate' => 0.xxxx,  // Tarifa base
        'flag' => 0.0446,  // Bandeira tarifária
        'total' => 0.xxxx  // Total (rate + flag)
    ]
];
```

### 🎨 Customização Visual
Principais arquivos de estilo:
- `assets/css/style.css` - Estilos principais
- `assets/css/responsive.css` - Responsividade
- Cores principais: `#667eea` e `#764ba2` (gradiente)

## 🐛 Resolução de Problemas

### Problemas Comuns

**❌ Cálculos não aparecem:**
- Verifique se JavaScript está habilitado no navegador
- Confirme que todos os campos obrigatórios estão preenchidos
- Selecione tanto a impressora quanto a localização

**❌ Valores incorretos:**
- Verifique se a impressora selecionada corresponde à sua
- Confirme se o estado selecionado está correto
- Use ponto (.) como separador decimal, não vírgula

**❌ Interface não responsiva:**
- Limpe o cache do navegador
- Verifique se os arquivos CSS estão carregando corretamente

### 💡 Dicas de Troubleshooting
- Use F12 para abrir o console e verificar erros JavaScript
- Teste em navegador diferente se houver problemas
- Verifique se o servidor web suporta PHP

## 📈 Roadmap de Melhorias

### Versões Futuras
- [ ] **Histórico expandido** com exportação PDF
- [ ] **Calculadora de tempo** de impressão automática
- [ ] **Suporte multi-material** (suportes, diferentes filamentos)
- [ ] **API pública** para integração com e-commerce
- [ ] **Dashboard analítico** com estatísticas de uso
- [ ] **Modo escuro** para interface
- [ ] **Calculadora de custos** de pós-processamento

## 📞 Suporte e Contribuição

**Desenvolvido por:** davidhxcx  
**Versão:** 1.0  
**Ano:** 2025  

### 🤝 Como Contribuir
1. Faça um fork do projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

### 📊 Estatísticas do Projeto
- **+950 linhas** de JavaScript comentado
- **25+ impressoras** Creality suportadas
- **27 estados** brasileiros com tarifas
- **100% responsivo** e PWA-ready

---

**© 2025 Calculadora de Preço 3D - Desenvolvido por: davidhxcx**
- Verifique permissões da pasta `data/`
- Confirme que o PHP pode criar arquivos

**Valores incorretos:**
- Verifique se as configurações de energia estão atualizadas
- Confirme o consumo real da sua impressora

## 📈 Melhorias Futuras

- [ ] Banco de dados MySQL
- [ ] Login/usuários múltiplos
- [ ] Comparação de filamentos
- [ ] Calculadora de tempo estimado
- [ ] Integração com slicers
- [ ] Relatórios detalhados
- [ ] App móvel nativo

## 📄 Licença

Este projeto está licenciado sob a **Creative Commons Attribution 4.0 International License (CC BY 4.0)**.

### 🔓 Você pode:
- ✅ **Usar** comercialmente
- ✅ **Modificar** e adaptar o código
- ✅ **Distribuir** livremente
- ✅ **Criar trabalhos derivados**

### 📝 Condições:
- 🏷️ **Atribuição obrigatória**: Deve dar crédito ao autor original (davidhxcx)
- 🔗 **Link da fonte**: Incluir link para o projeto original
- 📋 **Indicar mudanças**: Se modificar, deve indicar o que foi alterado

### 💡 Como dar crédito:
```
"Calculadora de Preço para Impressão 3D - Desenvolvido por davidhxcx"
"Fonte original: https://github.com/davidhxcx/calculadora-preco-3d"
```

**Licença completa**: Veja o arquivo `LICENSE` para detalhes completos.

## 🤝 Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Faça um fork do projeto
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📞 Suporte

Para dúvidas ou sugestões, abra uma issue no GitHub ou entre em contato.

---

**Desenvolvido com ❤️ para a comunidade de impressão 3D**

## 🌐 Deploy e Produção

### Deploy no Render.com

A aplicação está publicada em: **https://calculadora-preco-3d.onrender.com**

#### Configuração do Deploy

O deploy utiliza Docker com as seguintes configurações:

- **Container**: PHP 8.1 + Apache
- **Módulos Apache**: `rewrite`, `headers`, `deflate`, `expires`
- **Diretório Web**: `/var/www/html`
- **Configuração**: `.htaccess` ativo para segurança e cache

#### Arquivos de Configuração

- `Dockerfile` - Container PHP/Apache
- `render.yaml` - Configurações do serviço
- `.php-version` - Versão do PHP (8.1)
- `.user.ini` - Configurações PHP customizadas

### Estrutura de Deploy

```
├── Dockerfile              # Container Docker
├── render.yaml             # Configurações Render
├── .php-version            # Versão PHP
├── .user.ini              # Config PHP
├── .htaccess              # Configurações Apache
└── composer.json          # Dependências PHP
```

### Como Fazer Deploy

1. **Push para GitHub**:
   ```bash
   git add .
   git commit -m "Deploy changes"
   git push
   ```

2. **Deploy Automático**: O Render rebuilda automaticamente quando há commits no repositório.

3. **Verificar Status**: Acesse o painel do Render para monitorar o build.

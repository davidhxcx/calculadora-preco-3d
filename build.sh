#!/usr/bin/env bash
# Build script para Render

echo "🚀 Iniciando build da Calculadora 3D..."

# Instalar dependências PHP se houver
if [ -f "composer.json" ]; then
    echo "📦 Instalando dependências PHP..."
    composer install --no-dev --optimize-autoloader
fi

# Instalar dependências Node.js se houver
if [ -f "package.json" ]; then
    echo "📦 Instalando dependências Node.js..."
    npm install --production
fi

# Criar diretórios necessários
echo "📁 Criando diretórios..."
mkdir -p data logs cache

# Definir permissões
echo "🔧 Configurando permissões..."
chmod 755 data logs cache

echo "✅ Build concluído com sucesso!"

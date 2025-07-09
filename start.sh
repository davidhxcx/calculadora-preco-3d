#!/usr/bin/env bash
# Start script para Render - PHP Application

echo "🚀 Iniciando Calculadora de Preço 3D..."

# Configurar diretório de trabalho
cd /opt/render/project/src || cd .

# Configurar PHP
export PHP_INI_SCAN_DIR="/opt/render/project/src"

# Verificar porta do Render
if [ -z "$PORT" ]; then
    export PORT=10000
fi

echo "🌐 Porta configurada: $PORT"
echo "📂 Diretório atual: $(pwd)"
echo "📋 Arquivos disponíveis:"
ls -la

# Iniciar servidor PHP
echo "🚀 Iniciando servidor PHP na porta $PORT..."
exec php -S 0.0.0.0:$PORT -t . index.php

#!/usr/bin/env bash
# Start script para Render

echo "🚀 Iniciando Calculadora de Preço 3D..."

# Verificar se Apache está disponível
if command -v apache2-foreground &> /dev/null; then
    echo "🌐 Iniciando com Apache..."
    exec apache2-foreground
elif command -v php &> /dev/null; then
    echo "🌐 Iniciando servidor PHP built-in..."
    # Usar servidor built-in do PHP na porta do Render
    exec php -S 0.0.0.0:${PORT:-10000} -t .
else
    echo "❌ Erro: PHP não encontrado!"
    exit 1
fi

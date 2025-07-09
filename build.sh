#!/usr/bin/env bash
# Build script para Render - PHP Application

echo "🚀 Iniciando build da Calculadora 3D..."

# Verificar ambiente
echo "📋 Informações do ambiente:"
echo "- PWD: $(pwd)"
echo "- PHP version: $(php --version | head -n 1)"
echo "- Node version: $(node --version)"

# Criar diretórios necessários para logs e cache
echo "� Criando diretórios..."
mkdir -p logs cache tmp

# Verificar arquivos principais
echo "📋 Verificando arquivos principais..."
if [ -f "index.php" ]; then
    echo "✅ index.php encontrado"
else
    echo "❌ index.php não encontrado!"
    exit 1
fi

# Listar arquivos para debug
echo "� Estrutura do projeto:"
ls -la

# Configurar permissões
echo "🔧 Configurando permissões..."
chmod +x start.sh
chmod 755 logs cache tmp 2>/dev/null || true

echo "✅ Build concluído com sucesso!"

#!/usr/bin/env bash
# Export a Pivora demo kit manifest to dist/kits/{slug}.pivora-kit.json
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
KIT_SLUG="${1:-business}"
OUT_DIR="${ROOT}/dist/kits"
OUT_FILE="${OUT_DIR}/${KIT_SLUG}.pivora-kit.json"

mkdir -p "${OUT_DIR}"

if command -v wp >/dev/null 2>&1 && wp core is-installed >/dev/null 2>&1; then
	wp eval "file_put_contents( '${OUT_FILE}', pivora_core_export_kit_json( '${KIT_SLUG}' ) );"
else
	npx wp-env run cli wp eval "file_put_contents( '/var/www/html/wp-content/themes/pivora/dist/kits/${KIT_SLUG}.pivora-kit.json', pivora_core_export_kit_json( '${KIT_SLUG}' ) );"
fi

echo "Exported ${OUT_FILE}"

#!/usr/bin/env bash
#
# Creates a distributable plugin zip (pivora-core/pivora-core.zip with pivora-core/ root folder).
#
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
PLUGIN_DIR="${ROOT}/plugins/pivora-core"
PLUGIN_SLUG="pivora-core"
DIST="${ROOT}/dist"
STAGE="${DIST}/.stage-${PLUGIN_SLUG}"
ARCHIVE="${DIST}/${PLUGIN_SLUG}.zip"

if [[ ! -d "${PLUGIN_DIR}/build/blocks" ]]; then
	echo "Run npm run build before packaging the plugin." >&2
	exit 1
fi

mkdir -p "${DIST}"
rm -rf "${STAGE}"
mkdir -p "${STAGE}/${PLUGIN_SLUG}"

rsync -a --delete \
	--exclude '.git' \
	--exclude 'node_modules' \
	--exclude 'src' \
	--exclude '.DS_Store' \
	"${PLUGIN_DIR}/" "${STAGE}/${PLUGIN_SLUG}/"

rm -f "${ARCHIVE}"

(
	cd "${STAGE}"
	zip -rq "${ARCHIVE}" "${PLUGIN_SLUG}"
)

rm -rf "${STAGE}"

echo "Created ${ARCHIVE}"

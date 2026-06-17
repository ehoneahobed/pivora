#!/usr/bin/env bash
#
# Creates a distributable theme zip (pivora/pivora.zip with pivora/ root folder).
#
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
DIST="${ROOT}/dist"
THEME_SLUG="pivora"
STAGE="${DIST}/.stage-${THEME_SLUG}"
ARCHIVE="${DIST}/${THEME_SLUG}.zip"

mkdir -p "${DIST}"
rm -rf "${STAGE}"
mkdir -p "${STAGE}/${THEME_SLUG}"

rsync -a --delete \
	--exclude '.git' \
	--exclude '.github' \
	--exclude '.npm-cache' \
	--exclude '.wp-env*' \
	--exclude 'node_modules' \
	--exclude 'vendor' \
	--exclude 'dist' \
	--exclude 'plugins' \
	--exclude 'docs' \
	--exclude 'scripts' \
	--exclude 'build' \
	--exclude 'composer.json' \
	--exclude 'composer.lock' \
	--exclude 'package.json' \
	--exclude 'package-lock.json' \
	--exclude 'phpcs.xml.dist' \
	--exclude 'webpack.config.js' \
	--exclude 'IMPLEMENTATION_PLAN.md' \
	--exclude '.DS_Store' \
	"${ROOT}/" "${STAGE}/${THEME_SLUG}/"

rm -f "${ARCHIVE}"

(
	cd "${STAGE}"
	zip -rq "${ARCHIVE}" "${THEME_SLUG}"
)

rm -rf "${STAGE}"

echo "Created ${ARCHIVE}"

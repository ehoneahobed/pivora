#!/usr/bin/env bash
#
# Runs WordPress Theme Check against the packaged Pivora theme zip via wp-env.
#
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "${ROOT}"

if ! command -v npx >/dev/null 2>&1; then
	echo "npx is required." >&2
	exit 1
fi

THEME_SLUG="${1:-pivora}"
CHECK_SLUG="${THEME_SLUG}-release"
ZIP_PATH="/var/www/html/wp-content/themes/pivora/dist/${THEME_SLUG}.zip"

echo "Building production theme zip..."
npm run package:theme >/dev/null

echo "Ensuring wp-env is running..."
npx wp-env start --auto-port >/dev/null 2>&1 || npx wp-env start --auto-port

echo "Installing Theme Check plugin..."
npx wp-env run cli wp plugin install theme-check --activate --force 2>/dev/null || true

echo "Staging packaged theme for Theme Check..."
npx wp-env run cli bash -lc "
set -euo pipefail
rm -rf /tmp/pivora-theme-check
mkdir -p /tmp/pivora-theme-check
unzip -q '${ZIP_PATH}' -d /tmp/pivora-theme-check
rm -rf '/var/www/html/wp-content/themes/${CHECK_SLUG}'
cp -R '/tmp/pivora-theme-check/${THEME_SLUG}' '/var/www/html/wp-content/themes/${CHECK_SLUG}'
"

echo "Running Theme Check on ${CHECK_SLUG}..."
npx wp-env run cli wp eval-file "/var/www/html/wp-content/themes/pivora/scripts/run-theme-check.php" "${CHECK_SLUG}"

echo "Theme Check finished."

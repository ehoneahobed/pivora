#!/usr/bin/env bash
# Reset customized block templates and template parts to the theme files.
set -euo pipefail

wp eval '
$deleted = pivora_reset_template_customizations();
echo "Reset templates: " . implode( ", ", $deleted["templates"] ) . PHP_EOL;
echo "Reset template parts: " . implode( ", ", $deleted["parts"] ) . PHP_EOL;
if ( empty( $deleted["templates"] ) && empty( $deleted["parts"] ) ) {
	echo "No customized templates were found." . PHP_EOL;
}
'

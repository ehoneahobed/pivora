#!/usr/bin/env bash
#
# Reports gzipped theme CSS/JS sizes against IMPLEMENTATION_PLAN performance budgets.
#
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
CSS_BUDGET_KB=50
JS_BUDGET_KB=10

css_total=0
js_total=0

echo "Pivora asset budget report"
echo "=========================="

while IFS= read -r -d '' file; do
	size_kb=$(gzip -c "${file}" | wc -c | tr -d ' ')
	size_kb=$(( (size_kb + 512) / 1024 ))
	css_total=$(( css_total + size_kb ))
	printf "  CSS  %3s KB  %s\n" "${size_kb}" "${file#${ROOT}/}"
done < <(find "${ROOT}/assets/css" -name '*.css' -type f -print0)

if [[ -f "${ROOT}/assets/js/navigation.js" ]]; then
	while IFS= read -r -d '' file; do
		size_kb=$(gzip -c "${file}" | wc -c | tr -d ' ')
		size_kb=$(( (size_kb + 512) / 1024 ))
		js_total=$(( js_total + size_kb ))
		printf "  JS   %3s KB  %s\n" "${size_kb}" "${file#${ROOT}/}"
	done < <(find "${ROOT}/assets/js" -name '*.js' -type f ! -name 'editor-*' -print0)
else
	echo "  JS     0 KB  (no frontend theme JS — within budget)"
fi

echo ""
printf "Theme CSS total (gzipped): %s KB (budget: <%s KB)\n" "${css_total}" "${CSS_BUDGET_KB}"
printf "Theme JS total (gzipped):  %s KB (budget: <%s KB)\n" "${js_total}" "${JS_BUDGET_KB}"

if (( css_total > CSS_BUDGET_KB )); then
	echo "CSS budget exceeded." >&2
	exit 1
fi

if (( js_total > JS_BUDGET_KB )); then
	echo "JS budget exceeded." >&2
	exit 1
fi

echo "Asset budgets OK."

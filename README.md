# Twisted-Roots---Banner

Marketing / ops notes and WordPress hotfix packages for [trcannabis.ca](https://trcannabis.ca/).

## Active hotfix: mobile Pre-Roll freeze

See [`wordpress-fixes/README.md`](wordpress-fixes/README.md) and the installable plugin in [`wordpress-fixes/tr-jquery-dollar-fix/`](wordpress-fixes/tr-jquery-dollar-fix/).

**Cause:** broken inline script `$ = $ || jQuery` (`jquery-core-js-after`) throws `ReferenceError: $ is not defined` under WordPress jQuery noConflict.

**Partial live mitigation already applied:** Breeze **JavaScript minify disabled** (keep it off until the plugin/theme fix is live).

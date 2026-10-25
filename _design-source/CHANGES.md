# Premium UI update — what changed

NEW      assets/css/premium.css      the whole new design layer (loads last, overrides old look)
EDITED   includes/head.php           Inter font, loads premium.css, all FX permanently off, body gets `ux page-<name>` classes
EDITED   assets/js/app.js            animated web canvas, custom cursor ring and card tilt are OFF
                                     (re-enable: window.SRT_VISUALS = true / window.SRT_TILT = true)
EDITED   assets/js/consent.js        cookie emoji -> icon
EDITED   dashboard.php               new grid layout (hero + stats, leaderboard, announcement, quick access)
EDITED   login.php                   split-screen brand panel on desktop, clean "Sign in" form
EDITED   profile.php / feedback.php  two-column wrappers on desktop
EDITED   store.php                   balance shows "NRP 75" after load (was just "75")
EDITED   includes/nav.php            local logo instead of external image
All app.js / consent.js ?v= strings bumped to 20261025-1 so browsers fetch the new files.

Backend / Firebase / API / element IDs: untouched.
Old CSS files are untouched. To tweak colours edit the tokens at the top of premium.css.
_design-source/ is only for reference; you can delete it before uploading.

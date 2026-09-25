<?php

require_once __DIR__ . '/include/twig.php';

render_page('a_propos', normalize_lang($lang ?? 'fr'));

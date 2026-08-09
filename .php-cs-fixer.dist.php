<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

/**
 * PHP-CS-Fixer is here for ONE rule: native functions, classes and constants are imported in
 * the file header, never referenced through a leading back-slash at the call site. It is the
 * only tool in the tool-chain that can apply that rewrite itself - PHPCS reports style, PHPStan
 * reports types, neither rewrites imports.
 *
 * The rule set is deliberately minimal. Code STYLE is PHPCS's job (phpcs.xml.dist), so nothing
 * here may reformat, re-indent or re-order anything else - the two tools would fight over it.
 *
 * `make cs-fixer` reports, `make cs-fixer-fix` applies. Committed as .dist so a developer can
 * drop a local .php-cs-fixer.php override next to it without committing it.
 */

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(false)
    ->setRules([
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
    ])
    ->setFinder($finder);

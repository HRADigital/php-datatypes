<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Fiscal;

/**
 * Kind of taxpayer a Portuguese NIF identifies, as set by its leading digits
 * (DL 14/2013, art. 4.º).
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
enum NifType: string
{
    case NATURAL_PERSON = 'natural_person';
    case LEGAL_PERSON = 'legal_person';
}

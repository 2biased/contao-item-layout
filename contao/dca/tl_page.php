<?php

declare(strict_types=1);

/*
 * This file is part of Contao Item Layout Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/*
 * Palettes
 */
PaletteManipulator::create()
    ->addField(['itemLayout', 'subpageItemLayout'], 'subpageLayout', PaletteManipulator::POSITION_AFTER)
    ->applyToSubpalette('includeLayout', 'tl_page')
;

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['itemLayout'] =
[
    'search' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_layout.name',
    'eval' => ['chosen' => true, 'tl_class' => 'w50', 'includeBlankOption' => true, 'blankOptionLabel' => &$GLOBALS['TL_LANG']['tl_page']['layout_inherit']],
    'sql' => 'int(10) unsigned NOT NULL default 0',
    'relation' => ['type' => 'hasOne', 'load' => 'lazy'],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['subpageItemLayout'] =
[
    'search' => true,
    'inputType' => 'select',
    'foreignKey' => 'tl_layout.name',
    'eval' => ['chosen' => true, 'tl_class' => 'w50', 'includeBlankOption' => true, 'blankOptionLabel' => &$GLOBALS['TL_LANG']['tl_page']['item_layout_inherit']],
    'sql' => 'int(10) unsigned NOT NULL default 0',
    'relation' => ['type' => 'hasOne', 'load' => 'lazy'],
];

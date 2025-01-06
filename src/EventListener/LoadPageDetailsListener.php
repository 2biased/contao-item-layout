<?php

declare(strict_types=1);

/*
 * This file is part of Contao Item Layout Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoItemLayoutBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageModel;

#[AsHook('loadPageDetails')]
class LoadPageDetailsListener
{
    public function __invoke(array $parentModels, PageModel $page): void
    {
        if (!$page->includeLayout) {
            foreach ($parentModels as $parent) {
                if ($parent->includeLayout) {
                    $page->itemLayout = $parent->subpageItemLayout ?: $parent->itemLayout;
                    break;
                }
            }
        }
    }
}

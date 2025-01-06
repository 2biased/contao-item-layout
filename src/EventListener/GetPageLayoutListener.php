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
use Contao\CoreBundle\Exception\NoLayoutSpecifiedException;
use Contao\LayoutModel;
use Contao\PageModel;
use Contao\PageRegular;
use Contao\System;

#[AsHook('getPageLayout')]
class GetPageLayoutListener
{
    public function __invoke(PageModel &$page, LayoutModel &$layout, PageRegular $pageRegular): void
    {
        if (!$page->itemLayout) {
            return;
        }

        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request->attributes->has('auto_item')) {
            $layout = LayoutModel::findById($page->itemLayout);

            if (null === $layout) {
                System::getContainer()->get('monolog.logger.contao.error')->error('Could not find layout ID "'.$page->itemlayout.'"');

                throw new NoLayoutSpecifiedException('No layout specified');
            }
            $page->hasJQuery = $layout->addJQuery;
            $page->hasMooTools = $layout->addMooTools;
        }
    }
}

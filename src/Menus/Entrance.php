<?php

namespace Godbout\Alfred\Ploi\Menus;

use Godbout\Alfred\Workflow\Item;
use Godbout\Alfred\Workflow\Menus\BaseMenu;
use Godbout\Alfred\Workflow\ScriptFilter;

class Entrance extends BaseMenu
{
    public static function scriptFilter()
    {
        ScriptFilter::add(
            self::refreshOPcache()
        );

        if (self::userInput()) {
            ScriptFilter::filterItems(self::userInput());
        }

        ScriptFilter::sortItems();
    }

    private static function refreshOPcache()
    {
        return Item::create()
            ->uid('refresh_OPcache')
            ->title('refresh OPcache')
            ->arg('do')
            ->variable('action', 'refreshOPcache');
    }
}

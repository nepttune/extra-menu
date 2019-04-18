<?php

/**
 * This file is part of Nepttune (https://www.peldax.com)
 *
 * Copyright (c) 2018 Václav Pelíšek (info@peldax.com)
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <https://www.peldax.com>.
 */

declare(strict_types = 1);

namespace Nepttune\Component;

final class ConfigMenu extends \Nette\Application\UI\Control
{
    /** @var array */
    protected $menu;

    /** @var \Nepttune\Model\Authorizator */
    protected $authorizator;

    public function __construct(array $menu, \Nette\DI\Container $container)
    {
        parent::__construct();
        
        $this->menu = $menu;
        $this->authorizator = $container->getService('authorizator');
    }

    protected function beforeRender() : void
    {
        $this->template->menu = $this->menu;
    }
    
    public function render() : void
    {
        $this->beforeRender();
        $this->template->setFile(__DIR__ . '/ConfigMenu.latte');
        $this->template->render();
    }

    public function hasAccess(string $resource) : bool
    {
        return $this->authorizator->isAllowed($resource);
    }
}

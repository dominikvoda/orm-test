<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Components;

/**
 * Description of MenuControl
 *
 * @author wassy
 */
class NavigationControl extends \Nette\Application\UI\Control {
    
    public function getMenuItems(){
        $array['Homepage:'] = array('name' => 'Přehled', 'icon' => 'fa-fw');
        $array['Project:'] = array('name' => 'Projekty', 'icon' => 'fa-fw');
        $array['Users:'] = array('name' => 'Uživatelé', 'icon' => 'fa-fw');
        $array['Tasks:'] = array('name' => 'Úkoly', 'icon' => 'fa-fw');
        return $array;
    }

    public function render() {
        $template = $this->template;
        $template->setFile(__DIR__ . '/templates/navigationControl.latte');
        $template->menuItems = $this->getMenuItems();
        $template->render();
    }

}

<?php

class MenuRender
{

    private $menuItem;
    private $userClass;
    private $controller;
    
    public function __construct(MenuItem $menuItem, myUser $userClass, sfActions $controller)
    {
        $this->menuItem = $menuItem;
        $this->userClass = $userClass;
        $this->controller = $controller;
    }
    
    /* AVA: Determina si un ítem está autorizado para un usuario */
    protected function CheckAuthorization(MenuItem $menuItem)
    {
        $menuGroup = $menuItem->getGroup();    
        
        if($menuGroup == '*' || $this->userClass->hasGroup($menuGroup) || $this->userClass->isSuperAdmin())
            {
                $menuPermission = $menuItem->getPermission();
                
                if($menuPermission == '*' || $this->userClass->hasPermission($menuPermission) || $this->userClass->isSuperAdmin())
                {
                    return true;
                }
                
            }
    
        return false;
    }
    
    protected function GetVisiblePaths()
    {
        $visiblePaths = array();

        if ($this->CheckAuthorization($this->menuItem) !== true)
        {
            throw new Exception('Access denied for menu item', 0x1001);
        }
        
        $childs = $this->menuItem->getChilds();
        
        foreach($childs as $child)
        {
            if ($this->CheckAuthorization($child) === true)
            {
                $visiblePaths[] = $child;
            }
            
        }
        
        return $visiblePaths;
    }
    
    /* AVA: @TODO Eliminar */
    public function RenderDev()
    {
        $items = $this->GetVisiblePaths();
        
        $output = '<table class="auto_menu">';
        foreach($items as $item)
        {
            $route = $this->controller->generateUrl('menu_backend', array('id' => $item->getId()));
            $output .= '<tr>';
            $output .= '<td> <a href="' . $route . '"> ' . $item->getText() . '</a></td>';
            $output .= '</tr>';
        }
        $output .= '</table>';
       
        return $output;
    }
    
   public function GetItemsByCredentials()
   {
       return $this->GetVisiblePaths();
   }    
}

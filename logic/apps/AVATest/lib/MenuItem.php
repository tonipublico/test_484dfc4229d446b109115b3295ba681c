<?php

class MenuItem /*implements IMenuItem*/{

    private $id         = null;
    private $childs     = array();
    private $order      = 0;
    private $text       = 'Empty';
    private $group      = null;
    private $permission = null;
    private $parent     = null;
    private $menuIndex  = null;
    
    public function __construct(array $parms = array())
    {
        if(isset($parms['Id']))
        {
            $this->id = $parms['Id'];
        
            if($this->parent === null)
            {
                $this->menuIndex[$parms['Id']] = $this;
            }
        }
        
        

        if(isset($parms['Order']))
        {
            $this->order = $parms['Order'];
        }

        if(isset($parms['Text']))
        {
            $this->text = $parms['Text'];
        }
        
        if(isset($parms['Group']))
        {
            $this->group = $parms['Group'];
        }
        
        if(isset($parms['Permission']))
        {
            $this->permission = $parms['Permission'];
        }        
        
    }
    
    public function AddChild(MenuItem $menuItem)
    {
        $menuItem->SetParent($this);
        $this->IndexRegister($menuItem);
        
        $this->childs[] = $menuItem;
        
        return $this;
    }
    
    private function IndexRegister(MenuItem $newChild)
    {
        if($this->parent !== null)
        {
            $this->parent->IndexRegister($newChild);
        }
        else // AVA: Es raiz
        {
            $this->menuIndex[$newChild->GetId() . ''] = $newChild; // AVA: Forzar string para evitar posible overflow de integer
        }
    }
    
    public function GetChilds()
    {
        return $this->childs;
    }
    
    public function GetId()
    {
        return $this->id;
    }

    public function GetText()
    {
        return $this->text;
    }

    public function GetOrder()
    {
        return $this->order;
    }

    public function GetGroup()
    {
        return $this->group;
    }
    
    public function GetPermission()
    {
        return $this->permission;
    }
    
    protected function SetParent($parent)
    {
        $this->parent = $parent;
    }
    
    public function GetParent()
    {
        return $this->parent;
    }
    
    public function GetItemById($id)
    {
        $retItem = null;
        
        if ($this->menuIndex !== null && isset($this->menuIndex[$id]))
        {
            $retItem = $this->menuIndex[$id];
        }
        
        return $retItem;
    }
}
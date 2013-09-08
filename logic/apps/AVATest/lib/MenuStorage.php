<?php

class MenuStorage{

    static public function GetBackend()
    {
        $mainMenu = new MenuItem(array(
            'Id'        => '',
            'Group'     => '*',
            'Permission'=> '*'
                ));


        $contabilidad = new MenuItem(array(
            'Id'        => '0CON',
            'Order'     => 1000,
            'Text'      => 'Contabilidad',
            'Group'     => 'Contabilidad',
            'Permission'=> '*'
        ));

        $produccion   = new MenuItem(array(
            'Id'        => '0PRO',
            'Order'     => 2000,
            'Text'      => 'Producción',
            'Group'     => 'Produccion',
            'Permission'=> '*'
        ));

        $comercial    = new MenuItem(array(
            'Id'        => '0COM',
            'Order'     => 3000,
            'Text'      => 'Comercial',
            'Group'     => 'Comercial',
            'Permission'=> '*'
        ));

        $callcenter   = new MenuItem(array(
            'Id'        => '0CAL',
            'Order'     => 4000,
            'Text'      => 'Callcenter',
            'Group'     => 'Callcenter',
            'Permission'=> '*'
        ));

        $comun        = new MenuItem(array(
            'Id'        => '0COMUN',
            'Order'     => 4000,
            'Text'      => 'Común',
            'Group'     => '*',
            'Permission'=> '*'
        ));


        $mainMenu   ->AddChild($contabilidad)
                    ->AddChild($produccion)
                    ->AddChild($comercial)
                    ->AddChild($callcenter)
                    ->AddChild($comun);

        $mainMenuChilds = $mainMenu->GetChilds();

        foreach( $mainMenuChilds as $menuItem)
        {
            $opcion1 = new MenuItem(array(
                'Id'      => $menuItem->getId() . '-1OPC1',
                'Order'     => 1000,
                'Text'      => 'Opcion 1',
                'Group'     => $menuItem->getGroup(),
                'Permission'=> 'impares'
                ));

            $opcion2 = new MenuItem(array(
                'Id'        => $menuItem->getId() . '-1OPC2',
                'Order'     => 2000,
                'Text'      => 'Opcion 2',
                'Group'     => $menuItem->getGroup(),
                'Permission'=> 'pares'
                ));

            $opcion3 = new MenuItem(array(
                'Id'        => $menuItem->getId() . '-1OPC3',
                'Order'     => 3000,
                'Text'      => 'Opcion 3',
                'Group'     => $menuItem->getGroup(),
                'Permission'=> 'impares'
                ));            

            $opcion4 = new MenuItem(array(
                'Id'        => $menuItem->getId() . '-1OPC4',
                'Order'     => 4000,
                'Text'      => 'Opcion 4',
                'Group'     => $menuItem->getGroup(),
                'Permission'=> 'pares'
                ));            

            $menuItem   ->AddChild($opcion1)
                        ->AddChild($opcion2)
                        ->AddChild($opcion3)
                        ->AddChild($opcion4);
        }


        /* AVA: Adición de submenu a la opción 4 de común */
        $parentMenu = $mainMenu->GetItemById('0COMUN-1OPC4');

        $opcionTest = new MenuItem(array(
                'Id'        => $parentMenu->getId() . '-2OPC1',
                'Order'     => 1000,
                'Text'      => 'Opcion 1',
                'Group'     => '*',
                'Permission'=> 'impares'
            ));

        $parentMenu->AddChild($opcionTest);
        /* ----- */
        
        return $mainMenu;
    }
}
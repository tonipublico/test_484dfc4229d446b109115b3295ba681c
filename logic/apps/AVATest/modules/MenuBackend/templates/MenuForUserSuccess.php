<h1>Opciones disponibles</h1>

<?php $menuItem = $viewParms['parentMenuItem']; ?>

<?php if ($menuItem->GetParent() != null): ?>
    <div class="control_menu_parent">
        <?php 
            if($menuItem->GetParent()->GetParent() === null)
            {
                $route = url_for('menu_backend_root');
            }
            else
            {
                $route = url_for('menu_backend', array('id' => $menuItem->GetParent()->getId())); 
            }
        ?>

        Volver a <a href="<?php echo $route ?>"> <?php echo $menuItem->getText() ?></a>
    </div>
<?php endif; ?>
<hr/>
<table class="control_menu">
    <?php $menuItems = $viewParms['menuItems']; foreach($menuItems as $menuItem): ?>
        <tr>
            <td>
                <?php $route = url_for('menu_backend', array('id' => $menuItem->getId()));?>
                <a href="<?php echo $route ?>"> <?php echo $menuItem->getText() ?></a>
             </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php

/**
 * MenuBackend actions.
 *
 * @package    AVATest
 * @subpackage MenuBackend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class MenuBackendActions extends sfActions
{
 /**
  * AVA: Determina si un página debe ser cargada desde caché o ser renderizada.
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
        $cacheDir = sfConfig::get('sf_cache_dir');
        $cacheTTL = sfConfig::get('app_menu_backend_ttl');
        
        $routeId = $request->getParameter('id','');
        $currentUser = $this->getUser();
        
        
        /* AVA: Cache */
        $generatedViewsCache = $cacheDir . DIRECTORY_SEPARATOR . 'generated' . DIRECTORY_SEPARATOR;
        
        $authorizationState = join(',', $currentUser->getGroupNames()) . ',' . join(',', $currentUser->getPermissionNames()); // AVA: @TODO Inseguro, utilizar identidades con prefijo de tipo.
        
        $viewKey = 
                /* $currentUser->getGuardUser()->getId(). */ //AVA: Con los mismos permisos, recuperar desde caché.
                /*'-'. */
                $routeId.
                '-'.
                md5($authorizationState).
                '.html'
                ;

        
        /* AVA: @TODO Cachear por entorno */
        $cache = new sfFileCache(array('cache_dir' => $generatedViewsCache));
        
        $cachedView = $cache->get($viewKey, null);
        
        
        
        if ($cachedView !== null)
        {
            return $this->renderText($cachedView);
        }
        else
        {
            $renderedView = $this->getController()->getPresentationFor(
                    'MenuBackend', 
                    'MenuForUser'
                    );
            
            $cache->set($viewKey, $renderedView, $cacheTTL);
            
            return $this->renderText($renderedView);
        }
        /* ---- */
  }
  
  /* AVA: Renderiza el menú */
  public function executeMenuForUser(sfWebRequest $request)
  {
        $routeId = $request->getParameter('id','');
        
        $mainMenu = MenuStorage::GetBackend();
        
        $currentMenuItem = $mainMenu->GetItemById($routeId);
        if($currentMenuItem === null)
        {
            throw new Exception('Menu item does not exist', 0x1002);
        }
        
        $menuRender = new MenuRender(
                $currentMenuItem,
                $this->getUser(), 
                $this);

        $this->viewParms = array(
            'menuItems' => $menuRender->GetItemsByCredentials(),
            'parentMenuItem' => $currentMenuItem
            );
  
  }
}

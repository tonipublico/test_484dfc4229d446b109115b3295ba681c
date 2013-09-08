<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
        <meta charset='utf-8'/>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
      <div class="header">
        <div class="control_home">
            <a href="<?php echo url_for('homepage') ?>">Home</a>
        </div>
        <?php if (sfConfig::get('sf_environment') === 'dev'): ?>
          <p>Groups : <?php echo join(',', $sf_user->getGroupNames()); ?></p>
          <p>Permissions : <?php echo join(',', $sf_user->getPermissionNames()); ?></p>
        <?php endif; ?>
          
        <?php if ($sf_user->isAuthenticated()): ?>
            <div class="control_logout"> 
                <a href="<?php echo url_for('sf_guard_signout') ?>">Logout</a>
            </div>
        <?php endif; ?>
      </div>
      <hr/>
      <div class="content">
        <?php echo $sf_content ?>
      </div>
      <hr/>
      <div class="footer">
          <p>AVA 2013</p>
      </div>
  </body>
</html>

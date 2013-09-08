<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Profile filter form base class.
 *
 * @package    AVATest
 * @subpackage filter
 * @author     Your name here
 */
class BaseProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'test1' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'test1' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'test1' => 'Text',
    );
  }
}

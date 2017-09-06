<?php

namespace Drupal\user_phone_verification\Custom\Util;


use Drupal\Core\Session\SessionManager;
use Drupal\user\PrivateTempStoreFactory;

class SMSCodeValidator {

  const STORE_KEY = 'user_phone_verification_sms_code';

  /**
   * @var \Drupal\user\PrivateTempStore
   */
  protected $temp_store;
  protected $session_manager;

  public function __construct(PrivateTempStoreFactory $temp_store_factory, SessionManager $session_manager) {
    $this->temp_store = $temp_store_factory->get('user_phone_verification');
    $this->session_manager = $session_manager;
  }

  public function clear() {
    $this->temp_store->delete(static::STORE_KEY);
  }

  public function setGeneratedCode($sms_code) {
    // Session will be destoryed if contain no data after request. So set a
    // value in session here.
    $_SESSION['session_started'] = TRUE;
    $this->temp_store->set(static::STORE_KEY, $sms_code);
  }

  public function getGeneratedCode() {
    return $this->temp_store->get(static::STORE_KEY);
  }

  public function validate($sms_code) {
    return $sms_code == $this->getGeneratedCode();
  }
}
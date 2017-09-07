<?php

namespace Drupal\user_phone_verification\Access;


use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;

class UserPhoneVerificationAccessCheck implements AccessInterface {

  /**
   * Checks access.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account) {
    if (!$account->isAnonymous()) {
      $account_id = $account->id();
      /**
       * @var \Drupal\user_phone_verification\Entity\UserPhoneVerification $account_phone_verification
       */
      list($account_phone_verification, ) = array_values(\Drupal::entityTypeManager()
        ->getStorage('user_phone_verification')
        ->loadByProperties(['user' => $account_id])) + [null];
      if (!isset($account_phone_verification) || !$account_phone_verification->get('is_verified')) {
        drupal_set_message("Your phone is not verified.", "warning");
      }

    }
    return AccessResult::allowed();
  }

}
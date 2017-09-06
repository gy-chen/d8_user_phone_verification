<?php

namespace Drupal\user_phone_verification\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Class UserPhoneVerification
 *
 * @package Drupal\user_phone_verification\Entity
 *
 * @ContentEntityType(
 *   id = "user_phone_verification",
 *   label = @Translation("User Phone Verification"),
 *   base_table = "user_phone_verification",
 *   entity_keys = {
 *    "id" = "id",
 *    "uuid" = "uuid",
 *    "bundle" = "user"
 *   },
 *   bundle_entity_type = "user"
 * )
 */
class UserPhoneVerification extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['is_verified'] = BaseFieldDefinition::create('boolean')
      ->setlabel(t('Is verified'))
      ->setReadOnly(TRUE)
      ->setDefaultValue(FALSE);
    return $fields + parent::baseFieldDefinitions($entity_type);
  }

}
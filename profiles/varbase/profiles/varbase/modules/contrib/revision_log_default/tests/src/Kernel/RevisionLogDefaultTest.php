<?php

namespace Drupal\Tests\revision_log_default\Kernel;

use Drupal\KernelTests\Core\Entity\EntityKernelTestBase;
use Drupal\language\Entity\ConfigurableLanguage;
use Drupal\node\Entity\Node;
use Drupal\node\Entity\NodeType;

/**
 * Tests the revision_log_default module.
 *
 * @group revision_log_default
 */
class RevisionLogDefaultTest extends EntityKernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'node',
    'language',
    'revision_log_default',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installConfig(['node']);
    $this->installSchema('node', 'node_access');

    $type = NodeType::create([
      'type' => 'page',
      'name' => 'page',
    ]);
    $type->save();
    node_add_body_field($type);

    ConfigurableLanguage::createFromLangcode('fr')->save();
  }

  /**
   * Tests that revision log defaults are set correctly.
   */
  public function testRevisionLogDefault() {
    $this->createUser();

    // Test that a default revision log is set for creating new nodes.
    $node = Node::create([
      'type' => 'page',
      'title' => $this->randomMachineName(),
    ]);
    $node->save();
    $this->assertEquals($node->revision_log->getString(), 'Created new page');

    // Test that a default revision log is set when a new language is created.
    $french = $node->addTranslation('fr');
    $french->revision_log = '';
    $french->title = $this->randomMachineName();
    $french->save();
    $this->assertEquals($french->revision_log->getString(), 'Created French translation');

    // Test that updating fields sets a sane default revision log.
    $node->title = $this->randomMachineName();
    $node->revision_log = '';
    $node->save();
    $this->assertEquals($node->revision_log->getString(), 'Updated the Title field');
    $node->title = $this->randomMachineName();
    $node->body = $this->randomMachineName();
    $node->revision_log = '';
    $node->save();
    $this->assertEquals($node->revision_log->getString(), 'Updated the Title and Body fields');
  }

}

<?php

namespace Drupal\Tests\outside_in\FunctionalJavascript;

/**
 * Testing opening and saving block forms in the off-canvas tray.
 *
 * @group outside_in
 */
class OutsideInBlockFormTest extends OutsideInJavascriptTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['block', 'system', 'breakpoint', 'toolbar', 'contextual', 'outside_in'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    // @todo Ensure that this test class works against bartik and stark:
    //   https://www.drupal.org/node/2784881.
    $this->enableTheme('bartik');
    $user = $this->createUser([
      'administer blocks',
      'access contextual links',
      'access toolbar',
    ]);
    $this->drupalLogin($user);

    $this->placeBlock('system_powered_by_block', ['id' => 'powered']);
    $this->placeBlock('system_branding_block', ['id' => 'branding']);
  }

  /**
   * Tests updating the "Powered by Drupal" block in the Off-Canvas tray.
   */
  public function testPoweredByBlock() {

    $page = $this->getSession()->getPage();
    $web_assert = $this->assertSession();

    $this->drupalGet('user');
    $this->enableEditingMode();

    // Open "Powered by Drupal" block form by clicking div.
    $page->find('css', '#block-powered')->click();
    $this->waitForOffCanvasToOpen();
    $this->assertOffCanvasBlockFormIsValid();

    // Fill out form, save the form.
    $new_label = 'Can you imagine anyone showing the label on this block?';
    $page->fillField('settings[label]', $new_label);
    $page->checkField('settings[label_display]');

    // @todo Uncomment the following lines after GastonJS problem solved.
    // https://www.drupal.org/node/2789381
    // $this->getTray()->pressButton('Save block');
    // Make sure the changes are present.
    // $web_assert->pageTextContains($new_label);
  }

  /**
   * Tests updating the System Branding block in the Off-Canvas tray.
   *
   * Also tests updating the site name.
   */
  public function testBrandingBlock() {
    $web_assert = $this->assertSession();
    $this->drupalGet('user');
    $page = $this->getSession()->getPage();
    $this->enableEditingMode();

    // Open branding block form by clicking div.
    $page->find('css', '#block-branding')->click();
    $this->waitForOffCanvasToOpen();
    $this->assertOffCanvasBlockFormIsValid();

    // Fill out form, save the form.
    $new_site_name = 'The site that will live a very short life.';
    $page->fillField('settings[site_information][site_name]', $new_site_name);

    // @todo Uncomment the following lines after GastonJS problem solved.
    // https://www.drupal.org/node/2789381
    // $this->getTray()->pressButton('Save block');
    // Make sure the changes are present.
    //$web_assert->pageTextContains($new_site_name);
  }

  /**
   * Enables Editing mode by pressing "Edit" button in the toolbar.
   */
  protected function enableEditingMode() {
    $this->waitForElement('div[data-contextual-id="block:block=powered:langcode=en|outside_in::langcode=en"] .contextual-links a');

    $this->waitForElement('#toolbar-bar', 3000);

    $edit_button = $this->getSession()->getPage()->find('css', '#toolbar-bar div.contextual-toolbar-tab button');

    $edit_button->press();
  }

  /**
   * Asserts that Off-Canvas block form is valid.
   */
  protected function assertOffCanvasBlockFormIsValid() {
    $web_assert = $this->assertSession();
    // Check that common block form elements exist.
    $web_assert->elementExists('css', 'input[data-drupal-selector="edit-settings-label"]');
    $web_assert->elementExists('css', 'input[data-drupal-selector="edit-settings-label-display"]');
    // Check that advanced block form elements do not exist.
    $web_assert->elementNotExists('css', 'input[data-drupal-selector="edit-visibility-request-path-pages"]');
    $web_assert->elementNotExists('css', 'select[data-drupal-selector="edit-region"]');
  }

}

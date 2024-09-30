<?php
namespace Grav\Theme;

use Grav\Common\Theme;

class Arcana extends Theme
{
	/**
	 * @return array
	 *
	 */
	public static function getSubscribedEvents(): array {
		return [
			'onTwigLoader' => ['registerFormTemplateAlias', 10],
		];
	}

	public function registerFormTemplateAlias() {
		if($this->grav['config']->get('plugins.form.enabled')) {
			$form_plugin_path = $this->grav['locator']->findResource('plugins://form');
			$form_path = $form_plugin_path . DIRECTORY_SEPARATOR . 'templates';
			$this->grav['twig']->addPath($form_path, 'formplugin');
		}
	}
}

<?php
/**
 * ipedia module definition class
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 7 February 2019, 19:53 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia;

use Yii;

class Module extends \app\components\Module
{
	public $layout = 'main';

	/**
	 * {@inheritdoc}
	 */
	public $controllerNamespace = 'ommu\ipedia\controllers';

	/**
	 * {@inheritdoc}
	 */
	public function init()
	{
        parent::init();
	}
}

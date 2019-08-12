<?php
/**
 * IpediaMajorGroup
 *
 * This is the ActiveQuery class for [[\ommu\ipedia\models\IpediaMajorGroup]].
 * @see \ommu\ipedia\models\IpediaMajorGroup
 * 
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 24 June 2019, 23:26 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\query;

class IpediaMajorGroup extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaMajorGroup[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaMajorGroup|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}

<?php
/**
 * IpediaMajorGroupItem
 *
 * This is the ActiveQuery class for [[\ommu\ipedia\models\IpediaMajorGroupItem]].
 * @see \ommu\ipedia\models\IpediaMajorGroupItem
 * 
 * @author Putra Sudaryanto <putra@sudaryanto.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.co)
 * @created date 25 June 2019, 00:19 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\query;

class IpediaMajorGroupItem extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaMajorGroupItem[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaMajorGroupItem|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}

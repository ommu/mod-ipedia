<?php
/**
 * IpediaCompanies
 *
 * This is the ActiveQuery class for [[\ommu\ipedia\models\IpediaCompanies]].
 * @see \ommu\ipedia\models\IpediaCompanies
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 7 February 2019, 19:54 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\query;

class IpediaCompanies extends \yii\db\ActiveQuery
{
	/*
	public function active()
	{
		return $this->andWhere('[[status]]=1');
	}
	*/

	/**
	 * {@inheritdoc}
	 */
	public function published()
	{
		return $this->andWhere(['t.publish' => 1]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function unpublish()
	{
		return $this->andWhere(['t.publish' => 0]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleted()
	{
		return $this->andWhere(['t.publish' => 2]);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaCompanies[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaCompanies|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}

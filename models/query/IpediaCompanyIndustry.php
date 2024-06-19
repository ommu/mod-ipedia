<?php
/**
 * IpediaCompanyIndustry
 *
 * This is the ActiveQuery class for [[\ommu\ipedia\models\IpediaCompanyIndustry]].
 * @see \ommu\ipedia\models\IpediaCompanyIndustry
 * 
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2019 OMMU (www.ommu.id)
 * @created date 12 February 2019, 11:34 WIB
 * @link https://github.com/ommu/mod-ipedia
 *
 */

namespace ommu\ipedia\models\query;

class IpediaCompanyIndustry extends \yii\db\ActiveQuery
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
	 * @return \ommu\ipedia\models\IpediaCompanyIndustry[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \ommu\ipedia\models\IpediaCompanyIndustry|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}

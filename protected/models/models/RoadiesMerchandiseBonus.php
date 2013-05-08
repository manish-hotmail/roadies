<?php

/**
 * This is the model class for table "roadies_merchandise_bonus".
 *
 * The followings are the available columns in table 'roadies_merchandise_bonus':
 * @property integer $id
 * @property integer $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $count
 * @property string $purchase_date
 * @property integer $trans_type
 * @property string $create_time
 */
class RoadiesMerchandiseBonus extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RoadiesMerchandiseBonus the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'roadies_merchandise_bonus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, first_name, trans_type, create_time', 'required'),
			array('order_id, count, trans_type', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email', 'length', 'max'=>100),
			array('purchase_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, first_name, last_name, email, count, purchase_date, trans_type, create_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'count' => 'Count',
			'purchase_date' => 'Purchase Date',
			'trans_type' => 'Trans Type',
			'create_time' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('purchase_date',$this->purchase_date,true);
		$criteria->compare('trans_type',$this->trans_type);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
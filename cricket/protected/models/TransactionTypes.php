<?php

/**
 * This is the model class for table "transaction_types".
 *
 * The followings are the available columns in table 'transaction_types':
 * @property string $id
 * @property string $transaction_description
 * @property string $bet_based
 * @property string $transaction_nature
 * @property integer $bonus_money
 * @property string $create_time
 * @property string $update_time
 */
class TransactionTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransactionTypes the static model class
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
		return 'transaction_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction_description, bet_based, transaction_nature, create_time, update_time', 'required'),
			array('bonus_money', 'numerical', 'integerOnly'=>true),
			array('transaction_description', 'length', 'max'=>5000),
			array('bet_based', 'length', 'max'=>3),
			array('transaction_nature', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction_description, bet_based, transaction_nature, bonus_money, create_time, update_time', 'safe', 'on'=>'search'),
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
			'transaction_description' => 'Transaction Description',
			'bet_based' => 'Bet Based',
			'transaction_nature' => 'Transaction Nature',
			'bonus_money' => 'Bonus Money',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('transaction_description',$this->transaction_description,true);
		$criteria->compare('bet_based',$this->bet_based,true);
		$criteria->compare('transaction_nature',$this->transaction_nature,true);
		$criteria->compare('bonus_money',$this->bonus_money);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
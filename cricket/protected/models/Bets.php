<?php

/**
 * This is the model class for table "bets".
 *
 * The followings are the available columns in table 'bets':
 * @property string $id
 * @property integer $user_id
 * @property integer $option_id
 * @property string $question_id
 * @property string $event_id
 * @property integer $bet_amount
 * @property string $create_time
 */
class Bets extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bets the static model class
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
		return 'bets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, option_id, question_id, event_id, bet_amount, create_time', 'required'),
			array('user_id, option_id, bet_amount', 'numerical', 'integerOnly'=>true),
			array('question_id, event_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, option_id, question_id, event_id, bet_amount, create_time', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'option_id' => 'Option',
			'question_id' => 'Question',
			'event_id' => 'Event',
			'bet_amount' => 'Bet Amount',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('event_id',$this->event_id,true);
		$criteria->compare('bet_amount',$this->bet_amount);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
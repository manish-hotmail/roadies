<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property string $id
 * @property string $title
 * @property string $status
 * @property integer $total_pot
 * @property integer $total_bets
 * @property string $pot_distributed
 * @property integer $maximum_bid_amount
 * @property string $start_time
 * @property string $end_time
 * @property integer $event_id
 * @property string $correct_option
 */
class Questions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questions the static model class
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
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, start_time, end_time, event_id', 'required'),
			array('total_pot, total_bets, maximum_bid_amount, event_id', 'numerical', 'integerOnly'=>true),
			array('title, correct_option', 'length', 'max'=>200),
			array('status', 'length', 'max'=>8),
			array('pot_distributed', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status, total_pot, total_bets, pot_distributed, maximum_bid_amount, start_time, end_time, event_id, correct_option', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'status' => 'Status',
			'total_pot' => 'Total Pot',
			'total_bets' => 'Total Bets',
			'pot_distributed' => 'Pot Distributed',
			'maximum_bid_amount' => 'Maximum Bid Amount',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'event_id' => 'Event',
			'correct_option' => 'Correct Option',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('total_pot',$this->total_pot);
		$criteria->compare('total_bets',$this->total_bets);
		$criteria->compare('pot_distributed',$this->pot_distributed,true);
		$criteria->compare('maximum_bid_amount',$this->maximum_bid_amount);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('correct_option',$this->correct_option,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
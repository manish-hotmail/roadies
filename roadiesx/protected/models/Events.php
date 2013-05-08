<?php

/**
 * This is the model class for table "events".
 *
 * The followings are the available columns in table 'events':
 * @property string $id
 * @property string $event_type
 * @property string $title
 * @property string $description
 * @property string $status
 * @property integer $total_pot
 * @property integer $total_bets
 * @property string $start_time
 * @property string $end_time
 * @property string $share_image
 * @property string $share_text
 */
class Events extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Events the static model class
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
		return 'events';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_type, title, description, start_time, end_time, share_image, share_text', 'required'),
			array('total_pot, total_bets', 'numerical', 'integerOnly'=>true),
			array('event_type, status', 'length', 'max'=>8),
			array('title, share_text', 'length', 'max'=>500),
			array('description', 'length', 'max'=>2000),
			array('share_image', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_type, title, description, status, total_pot, total_bets, start_time, end_time, share_image, share_text', 'safe', 'on'=>'search'),
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
			'event_type' => 'Event Type',
			'title' => 'Title',
			'description' => 'Description',
			'status' => 'Status',
			'total_pot' => 'Total Pot',
			'total_bets' => 'Total Bets',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'share_image' => 'Share Image',
			'share_text' => 'Share Text',
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
		$criteria->compare('event_type',$this->event_type,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('total_pot',$this->total_pot);
		$criteria->compare('total_bets',$this->total_bets);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);
		$criteria->compare('share_image',$this->share_image,true);
		$criteria->compare('share_text',$this->share_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
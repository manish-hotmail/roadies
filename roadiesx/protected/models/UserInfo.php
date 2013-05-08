<?php

/**
 * This is the model class for table "user_info".
 *
 * The followings are the available columns in table 'user_info':
 * @property string $id
 * @property string $uid
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $gender
 * @property string $location
 * @property string $email
 * @property string $username
 * @property integer $total_credits
 * @property integer $total_debits
 * @property integer $closing_balance
 * @property string $create_time
 * @property string $last_visit
 * @property string $invite_money_status
 * @property string $airtel_advantage_bonus
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
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
		return 'user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, first_name, last_name, username, create_time, last_visit', 'required'),
			array('total_credits, total_debits, closing_balance', 'numerical', 'integerOnly'=>true),
			array('uid, first_name, middle_name, last_name, location', 'length', 'max'=>100),
			array('gender', 'length', 'max'=>1),
			array('email', 'length', 'max'=>300),
			array('username', 'length', 'max'=>200),
			array('invite_money_status', 'length', 'max'=>16),
			array('airtel_advantage_bonus', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, first_name, middle_name, last_name, gender, location, email, username, total_credits, total_debits, closing_balance, create_time, last_visit, invite_money_status, airtel_advantage_bonus', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'location' => 'Location',
			'email' => 'Email',
			'username' => 'Username',
			'total_credits' => 'Total Credits',
			'total_debits' => 'Total Debits',
			'closing_balance' => 'Closing Balance',
			'create_time' => 'Create Time',
			'last_visit' => 'Last Visit',
			'invite_money_status' => 'Invite Money Status',
			'airtel_advantage_bonus' => 'Airtel Advantage Bonus',
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
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('total_credits',$this->total_credits);
		$criteria->compare('total_debits',$this->total_debits);
		$criteria->compare('closing_balance',$this->closing_balance);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('last_visit',$this->last_visit,true);
		$criteria->compare('invite_money_status',$this->invite_money_status,true);
		$criteria->compare('airtel_advantage_bonus',$this->airtel_advantage_bonus,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
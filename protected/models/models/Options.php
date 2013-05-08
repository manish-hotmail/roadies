<?php

/**
 * This is the model class for table "options".
 *
 * The followings are the available columns in table 'options':
 * @property string $id
 * @property string $option_text
 * @property integer $question_id
 * @property integer $total_pot
 * @property integer $total_bets
 * @property double $odd
 */
class Options extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Options the static model class
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
		return 'options';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_text, question_id', 'required'),
			array('question_id, total_pot, total_bets', 'numerical', 'integerOnly'=>true),
			array('odd', 'numerical'),
			array('option_text', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, option_text, question_id, total_pot, total_bets, odd', 'safe', 'on'=>'search'),
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
			'option_text' => 'Option Text',
			'question_id' => 'Question',
			'total_pot' => 'Total Pot',
			'total_bets' => 'Total Bets',
			'odd' => 'Odd',
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
		$criteria->compare('option_text',$this->option_text,true);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('total_pot',$this->total_pot);
		$criteria->compare('total_bets',$this->total_bets);
		$criteria->compare('odd',$this->odd);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
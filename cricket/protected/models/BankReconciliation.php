<?php

/**
 * This is the model class for table "bank_reconciliation".
 *
 * The followings are the available columns in table 'bank_reconciliation':
 * @property integer $id
 * @property string $transaction
 * @property integer $transaction_type
 * @property integer $end_user_id
 * @property integer $trans_amount
 * @property string $trans_create_time
 * @property integer $bank_balance
 * @property string $recon_status
 * @property string $create_time
 */
class BankReconciliation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BankReconciliation the static model class
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
		return 'bank_reconciliation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('transaction, transaction_type, end_user_id, trans_amount, trans_create_time, bank_balance, create_time', 'required'),
			array('transaction_type, end_user_id, trans_amount, bank_balance', 'numerical', 'integerOnly'=>true),
			array('transaction', 'length', 'max'=>6),
			array('recon_status', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, transaction, transaction_type, end_user_id, trans_amount, trans_create_time, bank_balance, recon_status, create_time', 'safe', 'on'=>'search'),
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
			'transaction' => 'Transaction',
			'transaction_type' => 'Transaction Type',
			'end_user_id' => 'End User',
			'trans_amount' => 'Trans Amount',
			'trans_create_time' => 'Trans Create Time',
			'bank_balance' => 'Bank Balance',
			'recon_status' => 'Recon Status',
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
		$criteria->compare('transaction',$this->transaction,true);
		$criteria->compare('transaction_type',$this->transaction_type);
		$criteria->compare('end_user_id',$this->end_user_id);
		$criteria->compare('trans_amount',$this->trans_amount);
		$criteria->compare('trans_create_time',$this->trans_create_time,true);
		$criteria->compare('bank_balance',$this->bank_balance);
		$criteria->compare('recon_status',$this->recon_status,true);
		$criteria->compare('create_time',$this->create_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
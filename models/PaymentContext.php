<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_context".
 *
 * @property integer $id
 * @property string $payment_method
 * @property integer $user_id
 * @property double $amount
 * @property string $Payment_date
 * @property string $payment_status
 * @property string $gateway_responce
 *
 * @property User $user
 * @property PaymentDetail[] $paymentDetails
 * @property UserPayment[] $userPayments
 */
class PaymentContext extends \yii\db\ActiveRecord
{
    public $total=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_context';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_method'], 'string'],
            [['amount'], 'required'],
            [['user_id', 'payment_status'], 'integer'],
            [['amount'], 'number'],
            array('amount', 'compare','operator'=>'>','compareValue'=>0),
            [['Payment_date'], 'safe'],
            [['gateway_responce'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_method' => 'Payment Method',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'Payment_date' => 'Payment Date',
            'payment_status' => 'Payment Status',
            'gateway_responce' => 'Gateway Responce',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentDetails()
    {
        return $this->hasMany(PaymentDetail::className(), ['payment_context_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPayments()
    {
        return $this->hasMany(UserPayment::className(), ['payment_context_id' => 'id']);
    }
    
    
    
    
    
    public function addfund($data,$id,$method,$reason,&$last_id){
            $this->payment_method=$method;
            $this->user_id = $id;
            $this->payment_status = "0";
            $this->amount=$this->amount;
            if($this->save()){
                $last_id=$this->id;
                 $this->addpaydetail($this->id,$reason,$this->amount,$id);
                 
                 return $this->amount ;
            }
            
          
        
    }
   public function addpaydetail($id,$reason,$amount,$uid){
       $paydetail = new PaymentDetail();
       $paydetail->payment_context_id=$id;
       $paydetail->payment_reason=$reason;
       $paydetail->item_id="0";
       $paydetail->amount=$amount;
        if($paydetail->save()){
            $id_s=Yii::$app->user->id;
            if($id_s!= 1){
                 return $id;
            }
            else{
            $this->adduserdetails($amount,$uid);
            }
            
        }
       
       
    }
    
   public function adduserdetails($amount,$uid){
         $prfole = UserProfile::findOne(['user_id'=>$uid]);  
         $prfole->amount += $amount;
         $prfole->save();
       
    }
    public function adduserdetect($amount,$uid){
         $prfole = UserProfile::findOne(['user_id'=>$uid]);  
         $prfole->amount -= $amount;
         $prfole->save();
       
    }
    
    public function getTotals($ids)
        {
            return 1;
        }
}

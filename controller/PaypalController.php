<?php  
namespace app\controllers;

use Yii;
use app\models\PaymentContext;
use app\models\PaymentContextsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\paypal_class;

class PaypalController extends Controller {

 

    public $enableCsrfValidation = false;
    public function actionIndex($id) { 
        
    	$ctx_id =Yii::$app->getRequest()->getQueryParam('id'); 
    	$ctx = PaymentContext::findOne($ctx_id);
         return $this->render('index', [
                'ctx' => $ctx,
            ]); 
		
    }


    public function actionIin() {
    	
     $p = new paypal_class;  
        if ($p->validate_ipn()) { 
            $post_string = "";
            foreach ($_POST as $field => $value) {
                $post_string .= $field . '=' . urlencode(stripslashes($value)) . '&';
            }
           
           $ctxid =  $_POST['custom'];
          

            $ctx = PaymentContext::findOne($ctxid);
            $uid=$ctx->user_id;
            $amount=$ctx->amount;
            $ctx->payment_status = 1;
            $ctx->gateway_responce = $_POST['txn_id'];  
            if($ctx->save()){
                $ctx->adduserdetails($amount,$uid);
               
            Yii::$app->getSession()->setFlash('success', "You have successfully add ". $amount ." USD  amount in fund");
               return $this->redirect(['/addfund/add-funds']);
            }else{
                 
               //print_r($ctx->getErrors()); 
            }
           
			 
        } else {
           $this->redirect(Yii::app()->createUrl('/payment/paypal/cancel'));
           
        }
        exit;
    }

    public function actionSuccess($id='') {
      
	     
     $p = new paypal_class;  
    }

    public function actionCancel() {
      echo "cancel"; die;
        $url = Yii::app()->createUrl('/subscribe');
			  $this->redirect($url);
    }
    public function actionIpn($id='') {
      print_r($_POST); die;
        
    }

}

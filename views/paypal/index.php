<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\components\paypal_class;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $signUpFormModel app\models\ContactForm */



?>
<div class="row">
<div class="registration-form clearfix">
   <div class="view_detail">
    <h1><span>Please Don't refresh page</span></h1>
    </div>
 <?php

       define('EMAIL_ADD', 'santosh.mohan@dotsquares.com'); // For system notification.
       define('PAYPAL_EMAIL_ADD','sujendra.kumar@dotsquares.com');

      $p = new paypal_class(); 				 // initiate an instance of the class.
      $p -> admin_mail = EMAIL_ADD; 
      $p -> paypal_mail = PAYPAL_EMAIL_ADD;  // If set, class will verfy the receiver.
      
          $this_script = 'http://'.$_SERVER['HTTP_HOST'];
       
      
                $p->add_field('business', PAYPAL_EMAIL_ADD); //don't need add this item. if your set the $p -> paypal_mail.
                $p->add_field('item_name','Add funds');
                $p->add_field('quantity', 1);
                $p->add_field('amount', $ctx->amount);
                $p->add_field('return', 'http://ds08.projectstatus.co.uk/hunterinvestor/web/paypal/iin');
                $p->add_field('cancel_return', 'http://ds08.projectstatus.co.uk/hunterinvestor/web/paypal/cancel');
                $p->add_field('notify_url', 'http://ds08.projectstatus.co.uk/hunterinvestor/web/paypal/ipn');
               //  $p->add_field('cmd', "_cart");
                $p->add_field('cmd', '_xclick');
               // $p->add_field('currency_code', 'GBP');
                $p->add_field('custom', $ctx->id);
                $p->add_field('rm', '2');	// Return method = POST

                $p->submit_paypal_post(); // submit the fields to paypal
         //  $p->dump_fields(); 
                ?>
       </div>
       </div> 
 


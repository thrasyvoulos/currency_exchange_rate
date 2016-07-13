<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Dropdown;
use yii\helpers\Url;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\CurrencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="currency-dashboard">
 <?php $this->title='Dashboard' ?>
    <?php $form = ActiveForm::begin([
       // 'type' => ActiveForm::TYPE_HORIZONTAL
        //'action' => ['index'],
       // 'method' => 'get',
    ]); ?>
    <div style="display: inline-block;">
    <?php
        $data=ArrayHelper::map(\app\models\Currency::find()->orderBy(['abbreviation' => SORT_ASC])->all(), 'currencyid', 'abbreviation');
    echo $form->field($model, 'currencyid')->dropDownList([
            'items' => $data,
        
            ]);
    ?>
           <?php
        //$data2=ArrayHelper::map(\app\models\Currency::find()->orderBy(['abbreviation' => SORT_ASC])->all(), 'currencyid2', 'abbreviation');
 echo $form->field($model, 'currencyid2')->dropDownList([
            'items' => $data,
            
            ]);
   
    
    ?>

  
</div>
     <div style="display: inline-block;">
   <?php echo $form->field($model, 'currency1')->textInput(); ?>
<?php echo $form->field($model, 'currency2')->textInput(); ?>

     </div>

    <?php ActiveForm::end(); ?>

</div>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  
</head>
<script>
    var currency1='';
    var currency2='';
    var currencyval1='';
    var currencyval2='';
$( document ).ready(function() {
    currency1= $('#currency-currencyid option:selected').text();
    currency2= $('#currency-currencyid2 option:selected').text();
    currencyval2= document.getElementById('currency-currency2').value;
    currencyval1=document.getElementById('currency-currency1').value;
    
});
$('#currency-currencyid').on('change', function() {
   currency1= $('#currency-currencyid option:selected').text();
   
   $.ajax({
            type: "POST",
            url: '<?php echo Yii::$app->urlManager->createUrl('currency/ajaxconverter'); ?>',
            data: {
                currencyfrom : currency1,
                   currencyto: currency2,
                   value:currencyval1 
                },
            success: function(data) {
              document.getElementById('currency-currency2').value =data;
              currencyval2=data;
            }
        });
   
}); 
$('#currency-currencyid2').on('change', function() {
     currency2= $('#currency-currencyid2 option:selected').text();

    $.ajax({
            type: "POST",
            url: '<?php echo Yii::$app->urlManager->createUrl('currency/ajaxconverter'); ?>',
            data: {
                currencyfrom : currency1,
                   currencyto: currency2,
                   value:currencyval1
                },
            success: function(data) {
              document.getElementById('currency-currency2').value =data;
              currencyval2=data;
            }
        });
   
});    
$('#currency-currency1').on('input', function() {
    
    if(isNaN(this.value)){
        this.value=1;
    }
    var num=this.value*currencyval2;
    document.getElementById('currency-currency2').value =num;
    currency1= $('#currency-currencyid option:selected').text();
 
   
}); 
$('#currency-currency2').on('input', function() {
    if(isNaN(this.value)){
        this.value=1;
    }
 $.ajax({
            type: "POST",
            url: '<?php echo Yii::$app->urlManager->createUrl('currency/ajaxconverter'); ?>',
            data: {
                currencyfrom : currency2,
                currencyto: currency1,
                value:this.value 
                },
            success: function(data) {
              document.getElementById('currency-currency1').value =data;
              currencyval1=data;
            }
        });
   
}); 
</script>  
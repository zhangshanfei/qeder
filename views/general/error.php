<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<style>
@media only screen and (min-width: 1550px) and (max-width: 1921px) {
	 .usercenter{min-height: 722px;}
}
@media only screen and (min-width: 1200px) and (max-width: 1450px) {
	 .usercenter{min-height: 500px;}
}
@media only screen and (min-width: 1200px) and (max-width: 1439px) {
	 .usercenter{min-height: 300px;}
}

</style>
<div class="usercenter">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>


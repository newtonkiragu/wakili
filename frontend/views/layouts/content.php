<?php

use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
?>

<div class="content-wrapper">
    <section class="content">
    <div class="container-fluid">
        <div class="content-header">
            <?php if (isset($this->blocks['content-header'])) { ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php } else { ?>
                <h1>
                    <?php
//                if(Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index'){
//                    $welcomeName = \yii\helpers\Inflector::camel2words(Yii::$app->user->identity->user_name);
//                     //echo \yii\helpers\Html::encode('Welcome '.$welcomeName);
//                }else
                    if ($this->title !== null) {
                        // echo \yii\helpers\Html::encode($this->title);
                    } else {
                        echo \yii\helpers\Inflector::camel2words(
                                \yii\helpers\Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    }
                    ?>
                </h1>
            <?php } ?>

            <?=
            Breadcrumbs::widget(
                    [
                        
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['style' => 'left:0;margin-top: 5px;position: relative;top:0;float:none;background:#d2d6de;padding-left:10px', 'class' => 'breadcrumb float-sm-right']
                    ]
            )
            ?>
        </div>

        <div class="content">
            <?= $content ?>
        </div>
    </div>
    </section>
</div>
<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?> <a href="https://mutindamike.com"><?= Yii::$app->name; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
    </div>
</footer>




<?php 
use app\models\TblCust;
/* @var $this \yii\web\View */
/* @var $content string */

if (!Yii::$app->user->isGuest) {
  $staffno = Yii::$app->user->identity->username;
  
  $recordone = TblCust::findOne(['Staffno' => $staffno]);
  $userfullnames =  strtoupper($recordone->cust_F_Name) . '  ' . strtoupper($recordone->cust_L_Name);
}else{
    $userfullnames = "";
    $role = "MEMBER";
}



?>

<aside class="main-sidebar">

    <section class="sidebar">

         <!-- Sidebar user panel -->
        <div class="user-panel">
            
        </div>

   

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                 
                    ['label' => 'Dashboard',  'visible' => !Yii::$app->user->isGuest,'icon' => 'dashboard', 'url' => ['/']],
                    [
                        'label' => 'Profile',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'My Profile', 'url' => ['/user/settings/account'],],
                           
                            ['label' => 'ADMINS Only',  'url' => ['/user/admin/index'],'visible' => \Yii::$app->user->can('administrator')],

                        ],
                    ],


                    [
                        'label' => 'Tasks',
                        'visible' => \Yii::$app->user->can('administrator'),
                        'icon' => ' fa-calendar-plus-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Tasks','icon'=>' fa-calendar-check-o', 'url' => ['/tbl-event']],
                            ['label' => 'Tasks report', 'icon'=>' fa-calendar-times-o','url' => ['/tbl-event/report']],
                        ],
                    ],
                    [
                        'label' => 'Clients',
                        'visible' => \Yii::$app->user->can('administrator'),
                        'icon' => 'users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Add Client', 'icon' => 'user-plus', 'url' => ['/clients/create'],],
                            ['label' => 'Manage Clients', 'icon' => 'user', 'url' => ['/clients/index'],],


                        ],
                    ],

                    [
                        'label' => 'Payments',
                        'visible' => \Yii::$app->user->can('administrator'),
                        'icon' => 'money',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Add Payment','icon'=>'plus-circle','url' => ['/payments/create']],
                            ['label' => 'Manage Payments', 'icon'=>'bars','url' => ['/payments/index']],
                        ],
                    ],
                    [
                        'label' => 'Expenses',
                        'visible' => \Yii::$app->user->can('administrator'),
                        'icon' => 'money',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Manage Expenses', 'icon'=>'bars', 'url' => ['/expenses']],
                        ],
                    ],
                    [
                        'label' => 'Cases',
                        'visible' => \Yii::$app->user->can('administrator'),
                        'icon' => 'briefcase',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Manage Cases',  'icon'=>'bars','url' => ['/new-case']],
                        ],
                    ],

                   ['label' => 'Login', 'url' => ['auth/login'], 'visible' => Yii::$app->user->isGuest],
                   
               

                [
                    'label' => 'Staff',
                    'visible' => \Yii::$app->user->can('administrator'),
                    'icon' => 'users',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Add New Staff', 'icon' => 'user-plus', 'url' => ['/tbl-cust/create'],],
                        ['label' => 'View All Staff', 'icon' => 'user', 'url' => ['/tbl-cust/index'],],

                    ],
                ],
            
              
                ['label' => 'Add Service',  'icon' => ' fa-cart-plus','url' => ['/products'], 'visible' => \Yii::$app->user->can('administrator'),], 
//                [
//                    'label' => 'Reports',
//                    'icon' => ' fa-bar-chart-o',
//                    'url' => '#',
//                    'items' => [
//
////                        ['label' => 'Add Asset Class', 'url' => ['/tbl-class/index']],
////                        ['label' => 'Add Asset Item', 'url' => ['/tbl-assets/index']],
////                        ['label' => 'Depreciation for Assets', 'url' => ['/tbl-depreciation/index']],
//                    ],
//                ],
                     ['label' => 'Documents ',  'icon' => 'file-word-o','url' => ['/document'], 'visible' => \Yii::$app->user->can('administrator'),], 
                     ['label' => 'Invoices ',  'icon' => ' fa-file-text-o','url' => ['/invoice'], 'visible' => \Yii::$app->user->can('administrator'),], 
                     ['label' => 'Access control ',  'icon' => ' fa-lock','url' => ['/auth-assignment/index'], 'visible' => \Yii::$app->user->can('administrator'),], 
                     ['label' => 'Emails ',  'icon' => 'envelope','url' => ['/emails/create'], 'visible' => \Yii::$app->user->can('administrator'),], 
//                     ['label' => 'Sales Pipeline ',  'icon' => 'fa-cart-plus','url' => ['/pipeline']], 
                     ['label' => 'SMS ',  'icon' => 'mobile-phone fa-2x','url' => ['/sms/smspool'], 'visible' => \Yii::$app->user->can('administrator'),], 
            
            ],
        ]
        ) ?>

    </section>

</aside>

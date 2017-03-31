<?php
$modules = [
    // ใส่ module หลักระบบ
    'gridview' => ['class' => 'kartik\grid\Module'],
    'downloadAction' => 'gridview/export/download',
    'i18n' => []
];

//อ่าน module สร้างใหม่ใน module_plus.php
$module_plus = require(__DIR__ . "/module_plus.php");
$modules_all = array_merge($modules, $module_plus);

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => $modules_all
];


<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">AAA</span><span class="logo-lg"><img src="../../assets/images/logo3.png"  alt="User Image" height="50" width="50" />' . 'rippleA'. '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">ระบบการแจ้งเตือน</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i>ทดสอบระบบ
                                    </a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                
                <!-- User Account: style can be found in dropdown.less -->
                <?php
                    $command = Yii::$app->db->createCommand("SELECT hospname FROM aaa_setting WHERE  type_s ='hospital' ");
                                    $hospname = $command->queryScalar();
                ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        
                        <span class="hidden-xs"><?=$hospname?></span>
                    </a>
                    
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                
            </ul>
        </div>
    </nav>
</header>

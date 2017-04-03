<?php
    use yii\helpers\Url;
    use yii\bootstrap\Html;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../assets/images/moph.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <p>Guest</p>
                    <a href="#"><i class="fa fa-circle text-red"></i> Offline</a>
                <?php } else { ?>
                    <p><?= Yii::$app->user->identity->tname ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                <?php } ?>


            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>


            <li>
                <a href="<?= Url::to('index.php?r=site') ?>">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fire text-primary"></i> <span>ศูนย์จัดเก็บรายได้</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=chk/importhis') ?>"><i class="fa fa-circle-o lg-gauge"></i><span class="pull-right-container">
                            </span>นำเข้าข้อมูล HIS</a></li>
                    <li><a href="<?= Url::to('index.php?r=report') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                            </span>ตรวจสอบข้อมูล</a></li>
                </ul>
            </li>
            
            <li>
                <a href="<?= Url::to('index.php?r=food') ?>">
                    <i class="fa fa-apple text-primary"></i> <span>ระบบแผนการจัดซื้อ</span>

                </a>
            </li>
            <li>
                <a href="http://122.154.235.70/rq_supplies" target="_blank">
                    <i class="fa fa-cart-arrow-down text-primary"></i> <span>ระบบการจัดซื้อ(ลูกหนี้)</span>

                </a>
            </li><li>
                <a href="http://122.154.235.70/swsalary1" target="_blank">
                    <i class="fa fa-money text-primary"></i> <span>ระบบคลังพัสดุ</span>

                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-area-chart text-primary"></i> <span>ระบบงานบุคลากร</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=report') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                
                            </span>รายงานใหม่</a></li>
                    <li><a href="http://192.168.1.13/datasrisangworn" target="_blank"><i class="fa fa-circle-o"></i>รายงานเก่า</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money text-aqua"></i> <span>ระบบการเงิน</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=eh') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                <small class="label pull-right bg-orange">14</small>
                            </span>เอ๊ะ!!!</a></li>
                            <li><a href="<?= Url::to('index.php?r=eh') ?>"><i class="fa fa-circle-o"></i>ระบบบัญชี</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-heartbeat"></i> <span>ระบบบัญชี</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('index.php?r=thaicvrisk/thaidetail') ?>"><i class="fa fa-circle-o"></i><span class="pull-right-container">
                                
                            </span>ผู้ป่วยที่มารับบริการทั่วไป</a></li>
                            <li><a href="<?= Url::to('index.php?r=thaicvrisk/clinic') ?>"><i class="fa fa-circle-o"></i>ผู้ป่วยที่ลงทะเบียน</a></li>

                </ul>
            </li>
            

            <li class="header">จัดการระบบ</li>
            <li><a href="<?= Url::to('/swdata/backend/web') ?>" target="_blank"><i class="fa fa-circle-o text-aqua" ></i> <span>ผู้ดูแลระบบ</span></a></li>

            <?php
            $cid = '';
            if (Yii::$app->user->isGuest) {
                ?>
                <li><a href="<?= Url::to('index.php?r=site/login') ?>"><i class="fa fa-circle-o text-green"></i> <span>เข้าสูระบบ</span></a></li>
            <?php } else { ?>
                <li>
                    <?php
                    echo Html::a('<i class="fa fa-circle-o text-red"></i>ออกจากระบบ', ['/site/logout'], [
                        'data' => [
                            'icon' => 'fa fa-circle-o text-red',
                            'method' => 'post',
                        ],
                            ]
                    );
                    ?>


                </li>
            <?php } ?>

        </ul>

    </section>

</aside>

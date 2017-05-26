<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php echo $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $title ?></title>
<?php  echo $this->Html->meta('icon') ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<?php 
		echo $this->Html->css(HTTP_ROOT.'css/front/common.css');
		echo $this->Html->css(HTTP_ROOT.'css/front/style.css');
		echo $this->Html->css(HTTP_ROOT.'css/front/dev.css');
	?>	
	<!--Core CSS-->
	
	<!--Core CSS End-->
    <!--Core js-->
	
    <!--Core js End-->
	<?php  echo $this->fetch('meta') ?>
    <?php  echo $this->fetch('css') ?>
    <?php  echo $this->fetch('script') ?>
    
</head>

<body id="top">
<?php echo $this->Html->script('common/common.js');?>
<?php echo $this->Html->script('front/app.js');?>
	<?php echo $this->element('frnt/header'); ?>
		<?php echo $this->Flash->render() ?>
		<?php echo $this->fetch('content') ?>
	<?php echo $this->element('frnt/footer'); ?>
    
</body>
</html>

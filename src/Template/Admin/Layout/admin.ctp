<?php
    $description = 'RiskDept: a risk management plateform';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
         <?= $title ?> :    
        <?= $description ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
    </header>
        <?= $this->Flash->render() ?>

        <?= $this->fetch('content') ?>
    
    <footer>
    </footer>
</body>
</html>

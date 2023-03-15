<?php
?>
<!-- in /templates/Users/login.php -->
<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your email and password') ?></legend>
        <div class="mb-3">

            <?= $this->Form->control( "email",['required' => true,'id'=>"exampleInputEmail1",'class'=>"form-control","aria-describedby"=>"emailHelp"]) ?>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <?= $this->Form->control('password', ['required' => true,'type'=>"password", 'class'=>"form-control", 'id'=>"exampleInputPassword1"]) ?>

        </div>



    </fieldset>


    <?= $this->Form->submit(__('Login'),[ "class"=>"btn btn-primary bg-dark"]); ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link("Add User", ['action' => 'add']) ?>
</div>

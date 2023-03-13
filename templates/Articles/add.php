<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Articles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="articles form content">
            <?= $this->Form->create($article) ?>
            <fieldset>
                <legend><?= __('Add Article') ?></legend>
                <?php
                    echo $this->Form->control('title');
                    echo $this->Form->control('body');
                    echo $this->Form->control('category_id',[
                    'options'=>[1=>"Category One",2=> "Category Two"]]);
                ?>
            </fieldset>
            <?= $this->Form->create($bridge) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('role_id',[
                    'multiple' => true,
                    'options'=>[2=>"Admin",1=> "Author"]]

                    );
                    ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

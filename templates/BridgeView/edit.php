<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BridgeView $bridgeView
 * @var string[]|\Cake\Collection\CollectionInterface $articles
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $bridgeView->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $bridgeView->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Bridge View'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bridgeView form content">
            <?= $this->Form->create($bridgeView) ?>
            <fieldset>
                <legend><?= __('Edit Bridge View') ?></legend>
                <?php
                    echo $this->Form->control('article_id', ['options' => $articles, 'empty' => true]);
                    echo $this->Form->control('role_id', ['options' => $roles, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

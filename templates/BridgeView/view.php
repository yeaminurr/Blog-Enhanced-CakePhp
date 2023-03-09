<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BridgeView $bridgeView
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Bridge View'), ['action' => 'edit', $bridgeView->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Bridge View'), ['action' => 'delete', $bridgeView->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bridgeView->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Bridge View'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Bridge View'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="bridgeView view content">
            <h3><?= h($bridgeView->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Article') ?></th>
                    <td><?= $bridgeView->has('article') ? $this->Html->link($bridgeView->article->title, ['controller' => 'Articles', 'action' => 'view', $bridgeView->article->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $bridgeView->has('role') ? $this->Html->link($bridgeView->role->name, ['controller' => 'Roles', 'action' => 'view', $bridgeView->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($bridgeView->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

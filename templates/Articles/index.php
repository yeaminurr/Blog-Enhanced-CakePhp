<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Article> $articles
 */
?>






<div class="articles index content">


<!--    --><?php //= $this->Html->link("Logout", ['action' => 'logout'], ['class' => 'button float-right']) ?>

    <h3><?= __('Articles') ?></h3>
    <div class="table-responsive">
<<<<<<< Updated upstream
        <table class="table table-light table-striped">
=======
        <?= $this->Form->control('Search',["class"=>'search',"id"=>"search",'onkeyup'=>'filterFunction()']) ?>

        <table>
>>>>>>> Stashed changes
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Creator') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $this->Number->format($article->id) ?></td>
                    <td><?= h($article->title) ?></td>
                    <td><?= h($article->Category) ?></td>
                    <td><?= h($article->Creator) ?></td>
                    <td><?= h($article->created) ?></td>
                    <td><?= h($article->modified) ?></td>

                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
</div>
<<<<<<< Updated upstream
=======
    <p><?php echo $this->request->getRequestTarget() ; ?></p>
    <script>
        function filterFunction(){
            var input = $("#search").val();
            //console.log(input)

            $.ajax({
                type: "GET",
                url:'<?php echo $this->Url->build(array('controller' => 'Articles','action' => 'ajaxfunc'))?>',
                data:{
                    search: input.toString()}
            }).done(function (data) {
                console.log(JSON.parse(data)[0]["id"])





            })
        }

    </script>
</div>
>>>>>>> Stashed changes


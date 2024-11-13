<h1>Notes</h1>

<div class="search-form">
    <form method="get" action="<?= $this->Url->build(['action' => 'index']); ?>">
        <input type="text" name="search" value="<?= h($search); ?>" placeholder="Search by title" />
        <button type="submit">Search</button>
        <a href="<?= $this->Url->build(['action' => 'index']); ?>">Reset</a>
    </form>
</div>

<?php if (!empty($notes)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>
                <!-- Sort by Title -->
                <a href="<?= $this->Url->build(['?' => ['sort' => 'title', 'direction' => $sort === 'title' &&      $direction === 'asc' ? 'desc' : 'asc']]); ?>">
                    Title <?= $sort === 'title' ? ($direction === 'asc' ? '↑' : '↓') : ''; ?>
                </a>
                </th>
                <th>Description</th>
                <th>
                <!-- Sort by Created At -->
                <a href="<?= $this->Url->build(['?' => ['sort' => 'created_at', 'direction' => $sort === 'created_at' && $direction === 'asc' ? 'desc' : 'asc']]); ?>">
                    Created At <?= $sort === 'created_at' ? ($direction === 'asc' ? '↑' : '↓') : ''; ?>
                </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?= h($note->id) ?></td>
                    <td><?= h($note->title) ?></td>
                    <td><?= h($note->description) ?></td>
                    <td><?= h($note->created_at->format('Y-m-d H:i')) ?></td>
                    <td>
                        <?= $this->Html->link('View', ['action' => 'view', $note->id]) ?>
                        <?= $this->Html->link('Edit', ['action' => 'edit', $note->id]) ?>
                        <?= $this->Form->postLink('Delete', ['action' => 'delete', $note->id], ['confirm' => 'Are you sure?']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No notes found.</p>
<?php endif; ?>

<!-- Pagination Controls -->
<div class="pagination">
    <?= $this->Paginator->prev('« Previous'); ?>
    <?= $this->Paginator->numbers(); ?>
    <?= $this->Paginator->next('Next »'); ?>
    <p>Page <?= $this->Paginator->counter('{{page}} of {{pages}}'); ?></p>
</div>

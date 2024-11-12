<h1>Notes</h1>

<?php if (!empty($notes)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
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

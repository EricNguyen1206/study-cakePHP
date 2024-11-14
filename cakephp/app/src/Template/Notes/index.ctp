<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Notes</h1>
    <?= $this->Html->link('Add Note', ['action' => 'add'], ['class' => 'bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-sm']) ?>
</div>

<!-- Search and Sort Section -->
<form method="get" class="mb-6 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <!-- Search Input -->
        <input
            type="text"
            name="search"
            value="<?= $this->request->getQuery('search') ?>"
            placeholder="Search by title..."
            class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-300" />

        <!-- Sort Dropdown -->
        <select name="sort" class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <option value="">Sort by</option>
            <option value="title" <?= $this->request->getQuery('sort') === 'title' ? 'selected' : '' ?>>Title</option>
            <option value="created_at" <?= $this->request->getQuery('sort') === 'created_at' ? 'selected' : '' ?>>Created At</option>
        </select>

        <!-- Submit Button -->
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg shadow-sm">Apply</button>

    </div>
    <div class="pagination">
        <?= $this->Paginator->prev('« Previous'); ?>
        <?= $this->Paginator->numbers(); ?>
        <?= $this->Paginator->next('Next »'); ?>
        <p>Page <?= $this->Paginator->counter('{{page}} of {{pages}}'); ?></p>
    </div>
</form>

<!-- Notes List -->
<?php if (!empty($notes)): ?>
    <div class="grid grid-cols-1 gap-4 overflow-hidden">
        <?php foreach ($notes as $note): ?>
            <div id="note-<?= $note->id ?>" class="bg-white shadow rounded-lg p-4 flex flex-col justify-between h-full">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700"><?= h($note->title) ?></h2>
                    <div class="description w-full">
                        <span class="block short-description w-full overflow-hidden whitespace-nowrap" style="text-overflow: ellipsis !important;">
                            <?= h($note->description) ?>
                        </span>
                        <span class="full-description" style="display: none;">
                            <?= nl2br(h($note->description)); ?>
                        </span>
                        <!-- Toggle Description Button -->
                        <?php if (strlen($note->description) > 100) : ?>
                            <button class="bg-transparent text-blue-500 hover:text-blue-800 hover:shadow-sm" onclick="toggleDescription('note-<?= $note->id ?>')">Load more</button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span class="text-sm text-gray-500">Created: <?= $note->created_at->format('Y-m-d H:i') ?></span>
                    <div class="space-x-4">
                        <?= $this->Html->link('Edit', ['action' => 'edit', $note->id], ['class' => 'text-indigo-500 hover:underline']) ?>
                        <?= $this->Html->link('Delete', ['action' => 'delete', $note->id], ['class' => 'text-red-500 hover:underline', 'confirm' => 'Are you sure?']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-gray-500">No notes found.</p>
<?php endif; ?>

<!-- JavaScript for Toggle Description -->
<script>
    function toggleDescription(id) {
        // Get the closest parent div that contains the description
        const descriptionDiv = document.querySelector(`#${id} .description`);
        const shortDesc = descriptionDiv.querySelector('.short-description');
        const fullDesc = descriptionDiv.querySelector('.full-description');
        const button = descriptionDiv.querySelector('button');
        console.log('shortDesc', shortDesc)
        if (fullDesc.style.display === 'none') {
            fullDesc.style.display = 'inline';
            shortDesc.style.display = 'none';
            button.textContent = '[<<]';
        } else {
            fullDesc.style.display = 'none';
            shortDesc.style.display = 'block';
            button.textContent = 'Load more';
        }
    }
</script>
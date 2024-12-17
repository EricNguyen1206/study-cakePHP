<!-- src/Template/Projects/view.ctp -->
<div class="container mx-auto px-4 py-6">
  <!-- Project Title và Description -->
  <div class="flex justify-between items-center mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800"><?= h($project->title) ?></h1>
      <p class="text-gray-600"><?= h($project->description) ?></p>
    </div>
    <!-- Button Add Note (Show if user is manager) -->
    <?php if ($isManager): ?>

      <a href="<?= $this->Url->build('/projects/add/' . $project->id) ?>"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add Note
      </a>
    <?php endif; ?>
  </div>


  <!-- List Notes -->
  <div>
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Notes</h2>
    <?php if (!empty($notes)): ?>
      <ul class="space-y-4">
        <?php foreach ($notes as $note): ?>
          <li id="note-<?= $note->id ?>" class="bg-white shadow rounded-lg p-4 flex justify-between gap-4 h-full">
            <div class="mb-4 w-[150px] h-[100px]">
              <?php if (!empty($note->image)): ?>
                <img src="<?= h($note->image) ?>" width="150" height="100" alt="<?= h($note->title) ?>" class="rounded-md">
              <?php else: ?>
                <img src="https://via.placeholder.com/600/92c952" width="150" height="100" alt="Default Image" class="rounded-md">
              <?php endif; ?>
            </div>
            <div class="flex-1">
              <h3 class="text-xl font-semibold text-gray-700"><?= h($note->title) ?></h3>
              <div class="description w-full">
                <span class="block short-description w-full overflow-hidden whitespace-nowrap" style="text-overflow: ellipsis !important;">
                  <?= h($note->description) ?>
                </span>
                <span class="full-description" style="display: none;">
                  <?= nl2br(h($note->description)); ?>
                </span>
                <!-- Toggle Description Button -->
                <?php if (strlen($note->description) > 100) : ?>
                  <button class="bg-transparent text-blue-500 px-1 rounded-md hover:text-blue-800 hover:shadow-md" onclick="toggleDescription('note-<?= $note->id ?>')">Load more</button>
                <?php endif; ?>
              </div>
              <span class="text-sm text-gray-500">Created: <?= $note->created_at->format('Y-m-d H:i') ?></span>
            </div>
            <div class="flex items-center mt-4 space-x-4">
              <?= $this->Html->link('Edit', ['action' => 'edit', $note->id], ['class' => 'bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded-lg']) ?>
              <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $note->id],
                [
                  'confirm' => 'Are you sure you want to delete this note?',
                  'class' => 'bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg'
                ]
              ) ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-500">No notes available for this project.</p>
    <?php endif; ?>
  </div>
</div>
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
      <div class="flex items-center gap-2">
        <a href="<?= $this->Url->build('/projects/add-note/' . $project->id) ?>"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
          Add Note
        </a>
        <!-- Add User Button -->
        <div class="mt-4">
          <button onclick="document.getElementById('add-user-form').classList.toggle('hidden')"
            class="bg-green-500 text-white px-4 py-2 rounded">
            Add User
          </button>

          <!-- Add User Form (Dropdown) -->
          <div id="add-user-form" class="hidden mt-4">
            <?= $this->Form->create(null, [
              'url' => ['action' => 'addUser', $project->id],
              'class' => 'space-y-4'
            ]) ?>

            <!-- Dropdown List for Users -->
            <div>
              <?= $this->Form->control('user_id', [
                'label' => 'Select Developer',
                'options' => collection($developers)->combine('id', 'username')->toArray(),
                'empty' => 'Choose a user',
                'class' => 'form-select block w-full mt-1'
              ]) ?>
            </div>

            <!-- Submit Button -->
            <?= $this->Form->button('Add User', ['class' => 'bg-blue-500 text-white px-4 py-2 rounded']) ?>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>


  <!-- List Notes -->
  <div>
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Notes</h2>
    <?php if (!empty($notes)): ?>
      <ul class="space-y-4">
        <?php foreach ($notes as $note): ?>
          <li id="note-<?= $note->id ?>" class="bg-white shadow rounded-lg p-4 flex justify-between gap-4 h-full">
            <div class="w-[150px] h-[100px]">
              <?php if (!empty($note->image)): ?>
                <img src="<?= h($note->image) ?>" width="150" style="height: 100px !important; object-fit: cover;" alt="<?= h($note->title) ?>" class="rounded-md">
              <?php else: ?>
                <img src="https://via.placeholder.com/600/92c952" width="150" style="height: 100px !important; object-fit: cover;" alt="Default Image" class="rounded-md">
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
            <?php if ($isManager): ?>
              <div class="flex items-center mt-4 space-x-4">
                <?= $this->Html->link('Edit', ['action' => 'editNote', $note->id], ['class' => 'bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded-lg']) ?>
                <?= $this->Form->postLink(
                  'Delete',
                  ['action' => 'delete', 'controller' => 'Notes', 'id' => $note->id],
                  [
                    'confirm' => 'Are you sure you want to delete this note?',
                    'class' => 'bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg'
                  ]
                ) ?>
              </div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-500">No notes available for this project.</p>
    <?php endif; ?>
  </div>
</div>
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
        </div>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($isManager): ?>
    <button id="toggle-users-in-project" class="btn btn-primary">Show Users in Project</button>
    <button id="toggle-users-not-in-project" class="btn btn-secondary">Add Users</button>
  <?php endif; ?>

  <!-- Section: Users in Project -->
  <div id="users-in-project" class="hidden">
    <h3>Users in Project</h3>
    <?php foreach ($usersInProject as $user): ?>
      <div class="chip">
        <?= h($user->username) ?>
        <?= $this->Form->postLink('x', [
          'controller' => 'ProjectUsers',
          'action' => 'deleteUser',
          $project->id,
          $user->id
        ], [
          'confirm' => 'Are you sure you want to remove this user?'
        ]) ?>
      </div>
    <?php endforeach; ?>
    <button id="close-users-in-project" class="btn btn-light">Close</button>
  </div>

  <!-- Section: Add Users to Project -->
  <div id="users-not-in-project" class="hidden">
    <h3>Add Users</h3>
    <?= $this->Form->create(null, ['url' => ['controller' => 'ProjectUsers', 'action' => 'addUsers', $project->id]]) ?>
    <?php foreach ($usersNotInProject as $user): ?>
      <div>
        <?= $this->Form->checkbox("users[]", ['value' => $user->id]) ?>
        <?= h($user->username) ?>
      </div>
    <?php endforeach; ?>
    <?= $this->Form->button('Save', ['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <button id="close-users-not-in-project" class="btn btn-light">Close</button>
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

<script>
  // Toggle sections
  document.getElementById('toggle-users-in-project').addEventListener('click', function() {
    document.getElementById('users-in-project').classList.toggle('hidden');
    document.getElementById('users-not-in-project').classList.add('hidden');
  });

  document.getElementById('toggle-users-not-in-project').addEventListener('click', function() {
    document.getElementById('users-not-in-project').classList.toggle('hidden');
    document.getElementById('users-in-project').classList.add('hidden');
  });

  document.getElementById('close-users-in-project').addEventListener('click', function() {
    document.getElementById('users-in-project').classList.add('hidden');
  });

  document.getElementById('close-users-not-in-project').addEventListener('click', function() {
    document.getElementById('users-not-in-project').classList.add('hidden');
  });
</script>
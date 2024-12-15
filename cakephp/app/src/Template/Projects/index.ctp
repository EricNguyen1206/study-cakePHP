<?php

/**
 * @var \App\View\AppView $this
 * @var array $projects
 * @var array $user
 */
?>

<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Your Projects</h1>

  <?php if ($user['role'] === 'manager'): ?>
    <!-- Form để thêm dự án mới -->
    <div class="mb-8 bg-gray-100 p-4 rounded-lg shadow-md">
      <h2 class="text-lg font-semibold mb-4">Add a New Project</h2>
      <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'class' => 'space-y-4']) ?>
      <div>
        <?= $this->Form->control('title', [
          'label' => 'Project Title',
          'class' => 'w-full px-4 py-2 border rounded-lg focus:outline-none',
          'required' => true
        ]) ?>
      </div>
      <div>
        <?= $this->Form->control('description', [
          'label' => 'Description',
          'type' => 'textarea',
          'class' => 'w-full px-4 py-2 border rounded-lg focus:outline-none',
        ]) ?>
      </div>
      <div>
        <?= $this->Form->button(__('Add Project'), [
          'class' => 'px-6 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600'
        ]) ?>
      </div>
      <?= $this->Form->end() ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($projects)): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($projects as $project): ?>
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-2"><?= h($project->title) ?></h2>
          <p class="text-gray-700 mb-4"><?= h($project->description) ?></p>
          <p class="text-sm text-gray-500 mb-2">
            Created at: <?= h($project->created_at) ?>
          </p>
          <div class="flex justify-end">
            <a href="<?= $this->Url->build(['action' => 'view', $project->id]) ?>"
              class="text-blue-500 hover:underline">View Project</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-gray-600">No projects available.</p>
  <?php endif; ?>
</div>
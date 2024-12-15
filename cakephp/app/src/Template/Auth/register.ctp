<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
</head>

<body class="flex justify-center items-center h-screen bg-gray-100">
  <div class="w-full mx-auto max-w-md bg-white rounded-lg shadow-md p-6">
    <h2 class="text-center text-2xl font-bold mb-6">Register</h2>
    <?= $this->Form->create() ?>
    <div class="mb-4">
      <?= $this->Form->control('username', [
        'label' => 'Username',
        'class' => 'block w-full px-3 py-2 border rounded-md'
      ]) ?>
    </div>
    <div class="mb-4">
      <?= $this->Form->control('email', [
        'label' => 'Email',
        'type' => 'email',
        'class' => 'block w-full px-3 py-2 border rounded-md'
      ]) ?>
    </div>
    <div class="mb-4">
      <?= $this->Form->control('password', [
        'label' => 'Password',
        'type' => 'password',
        'class' => 'block w-full px-3 py-2 border rounded-md'
      ]) ?>
    </div>
    <div class="mb-4">
      <?= $this->Form->control('role', [
        'label' => 'Role',
        'type' => 'radio',
        'options' => [
          'manager' => 'Project Manager',
          'developer' => 'Developer'
        ],
        'default' => 'developer',
        'class' => 'inline-block mx-2 my-1'
      ]) ?>
    </div>
    <button type="submit" class="w-full bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
      Register
    </button>
    <?= $this->Form->end() ?>
    <p class="mt-4 text-center">
      Already have an account? <a href="/auth/login" class="text-blue-500">Login</a>
    </p>
  </div>
</body>

</html>
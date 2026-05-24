<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

// Log in the user if the credentials are correct
$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if (! $form->validate($email, $password)) {
    return view('session/create.view.php', [
        'errors' => $form->errors()
    ]);
}

// $errors = [];
// if (! Validator::email($email)) {
//     $errors['email'] = 'A valid email address is required.';
// }

// if (! Validator::string($password)) {
//     $errors['password'] = 'A valid password is required.';
// }

// if (! empty($errors)) {
//     return view('session/create.view.php', [
//         'errors' => $errors
//     ]);
// }

// match the credentials
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email
            ]);

        header('location: /');
        exit();
    }
}

return view('session/create.view.php', [
    'errors' => [
        'email' => 'No user found with that email address and password.'
    ]
]);

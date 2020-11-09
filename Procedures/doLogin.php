<?php

require_once __DIR__ .'/../inc/bootstrap.php';

$user = findUserByUsername(request()->get('username'));

if(empty($user))
{
    $session->getFlashBag()->add('error', 'Username was not found');
    redirect('/login.php');
}

if(!password_verify(request()->get('password'), $user['password']))
{
    $session->getFlashBag()->add('error', 'Invalid Password');
    redirect('/login.php');
}

$session->set('auth_logged_in', true);
$session->set('auth_user_id', (int) $user['id']);

$session->getFlashBag()->add('success', 'Successfully Logged In');
redirect('/');


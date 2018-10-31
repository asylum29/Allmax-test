<?php

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('setadmin {userid}', function ($userid) {
    $user = \App\User::find($userid);
    if ($user) {
        $user->is_admin = 1;
        $user->save();
        $this->comment("User with id {$userid} change to admin role");
    } else {
        $this->comment('User not found');
    }
});

Artisan::command('unsetadmin {userid}', function ($userid) {
    $user = \App\User::find($userid);
    if ($user) {
        $user->is_admin = 0;
        $user->save();
        $this->comment("User with id {$userid} change to user role");
    } else {
        $this->comment('User not found');
    }
});

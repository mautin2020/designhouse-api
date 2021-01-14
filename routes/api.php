<?php

// Public routes
Route::get('me', 'App\Http\Controllers\User\MeController@getMe');

// Get designs 
Route::get('designs', 'App\Http\Controllers\Designs\DesignController@index');
Route::get('designs/{id}', 'App\Http\Controllers\Designs\DesignController@findDesign');

// Get users
Route::get('users', 'App\Http\Controllers\User\Usercontroller@index');

Route::get('teams/slug/{slug}', 'App\Http\Controllers\Teams\TeamsController@findBySlug');

// Search Designs
Route::get('search/designs', 'App\Http\Controllers\Designs\DesignController@search');
Route::get('search/designers', 'App\Http\Controllers\User\UserController@search');

// Route group for authenticated users only
Route::group(['middleware' => ['auth:api']], function(){
    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout');
    Route::put('settings/profile', 'App\Http\Controllers\User\SettingsController@updateProfile');
    Route::put('settings/password', 'App\Http\Controllers\User\SettingsController@updatePassword');
        

    // Upload Designs
    Route::post('designs', 'App\Http\Controllers\Designs\UploadController@upload');
    Route::put('designs/{id}', 'App\Http\Controllers\Designs\DesignController@update');
    Route::delete('designs/{id}', 'App\Http\Controllers\Designs\DesignController@destroy');

    // Likes and Unlikes
    Route::post('designs/{id}/like', 'App\Http\Controllers\Designs\DesignController@like');
    Route::post('designs/{id}/liked', 'App\Http\Controllers\Designs\DesignController@checkIfUserHasLiked');

    // comments 
    Route::post('designs/{id}/comments', 'App\Http\Controllers\Designs\CommentController@store');
    Route::put('comments/{id}', 'App\Http\Controllers\Designs\CommentController@update');
    Route::delete('comments/{id}', 'App\Http\Controllers\Designs\CommentController@destroy');

    // Teams
    Route::post('teams', 'App\Http\Controllers\Teams\TeamsController@store');
    Route::get('teams/{id}', 'App\Http\Controllers\Teams\TeamsController@findById');
    Route::get('teams', 'App\Http\Controllers\Teams\TeamsController@index');
    Route::get('users/teams', 'App\Http\Controllers\Teams\TeamsController@fetchUserTeams');
    Route::put('teams/{id}', 'App\Http\Controllers\Teams\TeamsController@update');
    Route::delete('teams/{id}', 'App\Http\Controllers\Teams\TeamsController@destroy');
    Route::delete('teams/{team_id}/users/{user_id}', 'App\Http\Controllers\Teams\TeamsController@removeFromTeam');

    // Invitations
    Route::post('invitations/{teamId}', 'App\Http\Controllers\Teams\InvitationsController@invite');
    Route::post('invitations/{id}/resend', 'App\Http\Controllers\Teams\InvitationsController@resend');
    Route::post('invitations/{id}/respond', 'App\Http\Controllers\Teams\InvitationsController@respond');
    Route::delete('invitations/{id}', 'App\Http\Controllers\Teams\InvitationsController@destroy');

    // Chats
    Route::post('chats', 'App\Http\Controllers\Chats\ChatController@sendMessage');
    Route::get('chats', 'App\Http\Controllers\Chats\ChatController@getUserChats');
    Route::get('chats/{id}/messages', 'App\Http\Controllers\Chats\ChatController@getChatMessages');
    Route::put('chats/{id}/markAsRead', 'App\Http\Controllers\Chats\ChatController@markAsRead');
    Route::delete('messages/{id}', 'App\Http\Controllers\Chats\ChatController@destroyMessage');

});

// Routes for guest only
Route::group(['middleware' => ['guest:api']], function(){
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');
    Route::post('verification/verify/{user}', 'App\Http\Controllers\Auth\verificationController@verify')->name('verification.verify');
    Route::post('verification/resend', 'App\Http\Controllers\Auth\verificationController@resend');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
    Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');
   
});
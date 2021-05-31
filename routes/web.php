<?php

Route::redirect('/', '/login');

// Horarios
Route::resource('schedule' , 'ScheduleController');

Route::get('/home', function () {
    $user = Auth::user();
    $roles = $user->roles()->get();
    foreach ($roles as $role) {
        //Jugador
        if ($role->pivot->role_id == 4)
        {
            if (session('status')) {
                return redirect()->route('player.home')->with('status', session('status'));
            }

            return redirect()->route('player.home');
        }
    }
        if (session('status')) {
            return redirect()->route('admin.home')->with('status', session('status'));
        }

        return redirect()->route('admin.home');
});

Auth::routes();
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');

Route::get('sharedplayer/{player}', 'ShareController@getPlayer')->name('sharedplayer');

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'adminroute']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::resource('questions', 'QuestionsController');
    
    // Clubs
    Route::delete('clubs/destroy', 'ClubsController@massDestroy')->name('clubs.massDestroy');
    Route::post('clubs/parse-csv-import', 'ClubsController@parseCsvImport')->name('clubs.parseCsvImport');
    Route::post('clubs/process-csv-import', 'ClubsController@processCsvImport')->name('clubs.processCsvImport');
    Route::resource('clubs', 'ClubsController');

    // Tournaments
    Route::delete('tournaments/destroy', 'TournamentsController@massDestroy')->name('tournaments.massDestroy');
    Route::post('tournaments/parse-csv-import', 'TournamentsController@parseCsvImport')->name('tournaments.parseCsvImport');
    Route::post('tournaments/process-csv-import', 'TournamentsController@processCsvImport')->name('tournaments.processCsvImport');
    Route::resource('tournaments', 'TournamentsController');

    // Players
    Route::delete('players/destroy', 'PlayersController@massDestroy')->name('players.massDestroy');
    Route::post('players/parse-csv-import', 'PlayersController@parseCsvImport')->name('players.parseCsvImport');
    Route::post('players/process-csv-import', 'PlayersController@processCsvImport')->name('players.processCsvImport');
    Route::resource('players', 'PlayersController');

    // Scores
    Route::delete('scores/destroy', 'ScoresController@massDestroy')->name('scores.massDestroy');
    Route::post('scores/parse-csv-import', 'ScoresController@parseCsvImport')->name('scores.parseCsvImport');
    Route::post('scores/process-csv-import', 'ScoresController@processCsvImport')->name('scores.processCsvImport');
    Route::resource('scores', 'ScoresController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

   
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::group(['prefix' => 'player', 'as' => 'player.', 'namespace' => 'Player', 'middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('linkplayer/{id}', 'HomeController@getLinkPlayer')->name('linkplayer');
    Route::get('firstquestionary', 'HomeController@getFirstQuestionary')->name('firstquestionary');
    Route::post('firstquestionary', 'HomeController@postFirstQuestionary')->name('savefirstquestionary');
    Route::post('saveuserlocation', 'HomeController@postSaveUserLocation')->name('saveuserlocation');

    Route::get('player/{id}', 'PlayersController@getPlayer')->name('player');
    Route::get('myplayer', 'PlayersController@getMyPlayer')->name('myplayer');
    Route::post('myprofile', 'PlayersController@postMyProfile')->name('savemyprofile');

    Route::get('playerinfo/{player}', 'PlayersController@getPlayerinfo')->name('playerinfo');
    
    Route::get('searchplayers', 'HomeController@getSearchPlayers')->name('getsearchplayers');
    Route::post('searchplayers', 'HomeController@postSearchPlayers')->name('searchplayers');
    Route::post('search', 'HomeController@search')->name('search');

    // Clubs
    Route::delete('clubs/destroy', 'ClubsController@massDestroy')->name('clubs.massDestroy');
    Route::resource('clubs', 'ClubsController');

    // Tournaments
    Route::delete('tournaments/destroy', 'TournamentsController@massDestroy')->name('tournaments.massDestroy');
    Route::resource('tournaments', 'TournamentsController');

    // Players
    Route::delete('players/destroy', 'PlayersController@massDestroy')->name('players.massDestroy');
    Route::resource('players', 'PlayersController');

    // Scores
    Route::delete('scores/destroy', 'ScoresController@massDestroy')->name('scores.massDestroy');
    Route::get('scores/verify/{score}', 'ScoresController@getVerifyScore')->name('scores.verify');
    Route::get('scores/confirmunverify/{score}', 'ScoresController@getConfirmUnverifyScore')->name('scores.confirmunverify');
    Route::get('scores/confirmverify/{score}', 'ScoresController@getConfirmVerifyScore')->name('scores.confirmverify');
    Route::resource('scores', 'ScoresController');

    //Messenger
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');

    Route::get('messenger/conversation/{player}', 'MessengerController@getConversation')->name('messenger.conversation');
});

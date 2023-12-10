<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AccueilController@index')->name('index');
Route::get('/a-propos', 'AccueilController@about')->name('about');
Route::get('/contact', 'AccueilController@contact')->name('contact');
Route::get('/condition', 'AccueilController@condition')->name('condition.index');

Route::group(['prefix' => 'api'], function (){

    //authentification
    Route::post('login', 'ApiController@login');
    //obtenir les cookies
    Route::get('{user_phone}/cookies', 'ApiController@getCookies');
    //convertir string en json
    Route::post('stringToJson', 'ApiController@getStringToJson');
    Route::post('jsonToString', 'ApiController@getJsonToString');
    //gestion des communes
    Route::group(['prefix'=>'communes'], function()
    {
        Route::get('/', 'ApiController@getAllCommunes');
        Route::post('/create', 'ApiController@addCommune');
        Route::get('{id}/show', 'ApiController@showCommune');
        Route::post('{id}/update', 'ApiController@updateCommune');
        Route::get('{id}/delete', 'ApiController@deleteCommune');
    });
    //les type d'abonnement
    Route::group(['prefix'=>'type-abonnement'], function()
    {
        Route::get('/', 'TypeAbonnementController@getAllTypeAbonnements');
        Route::get('{id}/show', 'TypeAbonnementController@showTypeAbonnement');
        Route::post('{id}/update', 'TypeAbonnementController@updateTypeAbonnement');
        Route::get('{id}/delete', 'TypeAbonnementController@deleteTypeAbonnement');
    });

    //gestion des inscriptions users
    Route::group(['prefix'=>'users'], function()
    {
        Route::get('/', 'InscriptionController@getAllUsers');
        Route::post('/create', 'InscriptionController@addUser');
        Route::post('/createFromMobile', 'InscriptionController@addUserFromMobileApp');
        Route::get('{id}/show', 'InscriptionController@showUser');
        Route::post('/update', 'InscriptionController@updateUserProfil');
        Route::get('{id}/delete', 'InscriptionController@deleteUser');
    });

    //gestion du profil de lutisateur
/*    Route::group(['prefix'=>'profil'], function()
    {
        Route::get('{id}/show', 'ApiController@showUserProfil');
        Route::post('{id}/update', 'ApiController@updateUserProfil');

    });*/

    //gestion des maisons
    Route::group(['prefix'=>'places'], function()
    {
        Route::get('/', 'ApiController@getAllPlaces');
        Route::post('/searchplace', 'ApiController@searchPlace');
        Route::post('/searchbureau', 'ApiController@searchBureau');
        Route::post('/create', 'ApiController@addPlace');
        Route::get('{id}/show', 'ApiController@showPlace');
        Route::post('{id}/update', 'ApiController@updatePlace');
        Route::get('{id}/delete', 'ApiController@deletePlace');
    });

    //gestion des abonnements
    Route::group(['prefix'=>'abonnements'], function()
    {
        Route::get('/', 'AbonnementController@getAllAbonnements');
        //Route::post('/{cpm_trans_id}/buy_abonement', 'ApiController@buyAbonement');
        Route::post('/buy_abonement', 'AbonnementController@buyAbonement');
        Route::get('{id}/show-abonnement', 'AbonnementController@showAbonnement');
        //Route::post('{id}/update', 'ApiController@updateAbonnement');
    });

    //gestion des transactions
    Route::group(['prefix'=>'transactions'], function()
    {
        Route::get('/', 'TransactionController@getAllTransactions');
        Route::get('{id}/show-transaction', 'TransactionController@showTransaction');
        //pour checker le number transaction envoyé
        Route::get('{type}/getnumber', 'TransactionController@getTransactionNumber');
        //pour verifier le statut de la transaction
        Route::get('{cpm_trans_id}/{amount}/checkStatut', 'TransactionController@checkStatutTransactions');


    });

    //gestion des ebanking profil
    Route::group(['prefix'=>'ebanking-profil'], function()
    {
        Route::get('/', 'EbankingController@getAllEbankingProfils');
        Route::post('/create', 'EbankingController@addEbankingProfil');
        Route::get('{id}/show', 'EbankingController@showEbankingProfil');
        Route::post('{id}/update', 'EbankingController@updateEbankingProfil');
    });

    //gestion des programme tv
    Route::group(['prefix'=>'programme-tv'], function()
    {
        Route::get('/', 'ProgrammeTvController@getAllProgrammeTvs');
        Route::post('/create', 'ProgrammeTvController@addProgrammeTv');
        Route::get('{id}/show', 'ProgrammeTvController@showProgrammeTv');
        Route::post('{id}/update', 'ProgrammeTvController@updateProgrammeTv');
        Route::get('{id}/delete', 'ProgrammeTvController@deleteProgrammeTv');
    });

    //gestion des images
    Route::group(['prefix'=>'images'], function()
    {
        Route::get('/', 'ApiController@getAllImages');
        Route::post('/create', 'ApiController@addImage');
        Route::get('{id}/show', 'ApiController@showImage');
        Route::post('{id}/update', 'ApiController@updateImage');
        Route::get('{id}/delete', 'ApiController@deleteImage');
    });

    //gestion des notifications
    Route::group(['prefix'=>'notification'], function()
    {
        Route::get('/', 'ApiController@getAllNotifications');
        Route::post('/', 'ApiController@submitNotification');
        Route::post('{id_transaction}', 'ApiController@updateNotification');

    });

    //gestion des passtype
    Route::group(['prefix'=>'pass-type'], function()
    {
        Route::get('/', 'PassTypeController@getAllPassTypes');
        Route::post('/create', 'PassTypeController@addPassType');
        Route::get('{id}/show', 'PassTypeController@showPassType');

    });

    //gestion des pass visite
    Route::group(['prefix'=>'pass-visite'], function()
    {
        Route::get('/', 'PassVisiteController@getAllPassVisites');
        Route::post('/buy_pass_visite', 'ApiController@buyPassVisite');
        Route::post('/verif', 'PassVisiteController@verifPassVisite');
        Route::post('/one_visite', 'PassVisiteController@passM');
    });

    Route::group(['prefix'=>'pass-tv'], function()
    {
        Route::get('/', 'PassTvController@getAllPassTvs');
        //Route::post('/{cpm_trans_id}/buy_pass_tv', 'ApiController@buyPassTv');
        Route::post('/buy_pass_tv', 'PassTvController@buyPassTv');
        Route::post('/{code}/verif', 'PassTvController@verifPassTv');

    });

    //GESTION DES DATAS DE CINETPAY
    Route::post('notify', 'ApiController@notifyPaiement');

});

//gestion des inscriptions
Route::group(['prefix'=>'inscriptions'], function()
{
    //GESTION DU FRONT END
    Route::get('/create', 'InscriptionController@create')->name('inscription.create');
    Route::post('/create', 'InscriptionController@store')->name('inscription.store');
    Route::get('{id}/show-info', 'InscriptionController@showInfo')->name('inscription.show-info');
    Route::get('{id}/edit', 'InscriptionController@edit')->name('inscription.edit');
    Route::post('{id}/update', 'InscriptionController@update')->name('inscription.update');
    //END GESTION DU FRONT END
    Route::get('/', 'InscriptionController@index')->name('inscription.index');
    Route::get('{id}/show', 'InscriptionController@show')->name('inscription.show');
    Route::get('{id}/validate', 'InscriptionController@validateInscription')->name('inscription.validate');
    Route::get('{id}/validate_with_abonnement', 'InscriptionController@validateInscriptionWithAbonnemnt')->name('inscription.validate_with_abonnement');
    Route::get('{id}/delete', 'InscriptionController@delete')->name('inscription.delete');
});
Route::group(['prefix'=>'connexion'], function()
{
    //GESTION DU FRONT END
    Route::get('/', 'InscriptionController@login')->name('login.index');
    Route::post('/', 'InscriptionController@connexion')->name('connexion.index');
});
Route::group(['prefix'=>'profil'], function()
{
    //GESTION DU FRONT END
    Route::get('/', 'InscriptionController@indexProfil')->name('profil.index');
    Route::get('/{id}/edit', 'InscriptionController@editProfil')->name('profil.edit');
    Route::get('/{id}/show', 'InscriptionController@showProfil')->name('profil.show');
    Route::post('/{id}/update', 'InscriptionController@updateProfil')->name('profil.update');
});
//catalogue
Route::group(['prefix'=>'catalogue'], function()
{
    //GESTION DU FRONT END
    Route::get('/', 'MaisonController@indexCatalogue')->name('catalogue.index');
    Route::get('/create', 'MaisonController@createCatalogue')->name('catalogue.create');
    Route::post('/create', 'MaisonController@storeCatalogue')->name('catalogue.store');
    Route::get('/{id}/edit', 'MaisonController@editCatalogue')->name('catalogue.edit');
    Route::get('/{ref}/edit_statut', 'MaisonController@editStatutCatalogue')->name('catalogue.edit_statut');
    Route::get('/{ref}/show', 'MaisonController@showCatalogue')->name('catalogue.show');
    Route::post('/{id}/update', 'MaisonController@updateCatalogue')->name('catalogue.update');
});
//gestion des maisons
Route::group(['prefix'=>'maisons'], function()
{
    //GESTION DU FRONT
    Route::get('/choix', 'MaisonController@choix')->name('maison.choix');
    Route::get('/recherche-logement', 'MaisonController@showFormLogement')->name('maison.show_form_logement');
    Route::post('/recherche-logement', 'MaisonController@searchLogement')->name('maison.search.logement');
    Route::get('/recherche-bureau', 'MaisonController@showFormBureau')->name('maison.show_form_bureau');
    Route::post('/recherche-bureau', 'MaisonController@rechercheBureau')->name('maison.search.bureau');
    Route::get('/{ref}/show-logement', 'MaisonController@consulterLogement')->name('maison.show.logement');
    Route::get('/{ref}/show-bureau', 'MaisonController@consulterBureau')->name('maison.show.bureau');
    //BACKEND
    Route::get('/', 'MaisonController@index')->name('maison.index');
    Route::get('{id}/show', 'MaisonController@show')->name('maison.show');
    Route::get('{id}/validate', 'MaisonController@validateMaison')->name('maison.validate');
    Route::get('{id}/makeOcccupe', 'MaisonController@makeOcccupe')->name('maison.occupe');
    Route::get('{id}/delete', 'MaisonController@delete')->name('maison.delete');
});
//gestion des abonnements
Route::group(['prefix'=>'abonnements'], function()
{
    //gestion du front
    Route::get('/demarcheur', 'AbonnementController@showFormAbonnement')->name('abonnement.show_form');
    Route::get('{id}/souscrire', 'AbonnementController@showSuscribeForm')->name('abonnement.show_suscribe_form');
    Route::get('{id}/list', 'AbonnementController@listAbonnementDemarcheur')->name('abonnement.list');

    //gestion du back
    Route::get('/', 'AbonnementController@index')->name('abonnement.index');
    Route::get('{id}/show', 'AbonnementController@show')->name('abonnement.show');
    Route::post('/free_abonement', 'AbonnementController@freeAbonement');

});
//gestion des programmes tv
Route::group(['prefix'=>'programmes_tv'], function()
{
    //FRONT
    Route::get('/', 'ProgrammeTvController@index')->name('tv.index');
    Route::get('{id}/list', 'ProgrammeTvController@listProgramme')->name('programmes_tv.listbycategorie');
    //      END
    Route::get('/list', 'ProgrammeTvController@list')->name('programmes_tv.index');
    Route::get('/lien_pub', 'ProgrammeTvController@lienPub')->name('programmes_tv.lien');
    Route::get('/create', 'ProgrammeTvController@create')->name('programmes_tv.create');
    Route::post('/create', 'ProgrammeTvController@store')->name('programmes_tv.store');
    Route::get('{id}/show', 'ProgrammeTvController@show')->name('programmes_tv.show');
    Route::get('{id}/edit', 'ProgrammeTvController@edit')->name('programmes_tv.edit');
    Route::post('{id}/update', 'ProgrammeTvController@update')->name('programmes_tv.update');
    Route::get('{id}/delete', 'ProgrammeTvController@delete')->name('programmes_tv.delete');
});

Route::group(['prefix'=>'categorie_programme_tv'], function()
{
    Route::get('/list', 'CategorieProgrammeTvController@list')->name('categorie_programme_tv.list');
    Route::get('/create', 'CategorieProgrammeTvController@create')->name('categorie_programme_tv.create');
    Route::post('/create', 'CategorieProgrammeTvController@store')->name('categorie_programme_tv.store');
    Route::get('{id}/show', 'CategorieProgrammeTvController@show')->name('categorie_programme_tv.show');
    Route::get('{id}/edit', 'CategorieProgrammeTvController@edit')->name('categorie_programme_tv.edit');
    Route::post('{id}/update', 'CategorieProgrammeTvController@update')->name('categorie_programme_tv.update');
    Route::get('{id}/delete', 'CategorieProgrammeTvController@delete')->name('categorie_programme_tv.delete');
});
//gestion des pass visite
Route::group(['prefix'=>'pass_visite'], function()
{
    //FRONT
    Route::get('/', 'PassVisiteController@indexPass')->name('passvisite.index');
    Route::get('/notify', 'PassVisiteController@notifyPassVisite')->name('passvisite.notify');
    Route::get('/check', 'PassVisiteController@checkPassVisite')->name('passvisite.check');
    Route::get('{id}/buy', 'PassVisiteController@showBuyForm')->name('passvisite.showbuy');
    Route::get('/callback/', 'PassVisiteController@callBackPassViste')->name('passvisite.buy');
    //Route::get('/callback/{request}', 'PassVisiteController@callBackPassViste')->name('passvisite.buy');

    //END
    Route::get('/list', 'PassVisiteController@index')->name('pass_visite.index');
//    Route::get('/create', 'PassVisiteController@create')->name('pass_visite.create');
//    Route::post('/create', 'PassVisiteController@store')->name('pass_visite.store');
    Route::get('{id}/show', 'PassVisiteController@show')->name('pass_visite.show');
   /* Route::get('{id}/edit', 'PassVisiteController@edit')->name('pass_visite.edit');
    Route::post('{id}/update', 'PassVisiteController@update')->name('pass_visite.update');
    Route::get('{id}/delete', 'PassVisiteController@delete')->name('pass_visite.delete');*/
    Route::post('/prolonge_pass_visite', 'PassVisiteController@prolongePassVisite');
    Route::post('/get_pass_visite', 'PassVisiteController@getPassVisitePlaces');

});
//gestion des pass tv
Route::group(['prefix'=>'pass_tv'], function()
{
    Route::get('/', 'PassTvController@index')->name('pass_tv.index');
    Route::get('/create', 'PassTvController@create')->name('pass_tv.create');
    Route::post('/create', 'PassTvController@store')->name('pass_tv.store');
    Route::get('{id}/show', 'PassTvController@show')->name('pass_tv.show');
    Route::get('{id}/edit', 'PassTvController@edit')->name('pass_tv.edit');
    Route::post('{id}/update', 'PassTvController@update')->name('pass_tv.update');
    Route::get('{id}/delete', 'PassTvController@delete')->name('pass_tv.delete');
});
//gestion des transactions
Route::group(['prefix'=>'transactions'], function()
{
    Route::get('/', 'TransactionController@index')->name('transactions.index');
    Route::get('{id}/show', 'TransactionController@show')->name('transactions.show');
    });

//gestion des type d'abonnement
Route::group(['prefix'=>'type_abonnement'], function()
{
    Route::get('/', 'TypeAbonnementController@index')->name('type_abonnement.index');
    Route::get('/create', 'TypeAbonnementController@create')->name('type_abonnement.create');
    Route::post('/create', 'TypeAbonnementController@store')->name('type_abonnement.store');
    Route::get('{id}/show', 'TypeAbonnementController@show')->name('type_abonnement.show');
    Route::get('{id}/edit', 'TypeAbonnementController@edit')->name('type_abonnement.edit');
    Route::post('{id}/update', 'TypeAbonnementController@update')->name('type_abonnement.update');
    Route::get('{id}/delete', 'TypeAbonnementController@delete')->name('type_abonnement.delete');
});
//gestion des type de pass
Route::group(['prefix'=>'type_pass'], function()
{
    Route::get('/', 'PassTypeController@index')->name('type_pass.index');
    Route::get('/create', 'PassTypeController@create')->name('type_pass.create');
    Route::post('/create', 'PassTypeController@store')->name('type_pass.store');
    Route::get('{id}/show', 'PassTypeController@show')->name('type_pass.show');
    Route::get('{id}/edit', 'PassTypeController@edit')->name('type_pass.edit');
    Route::post('{id}/update', 'PassTypeController@update')->name('type_pass.update');
    Route::get('{id}/delete', 'PassTypeController@delete')->name('type_pass.delete');
});
//tela finance frontend
Route::group(['prefix'=>'finance'], function()
{
    Route::get('/', 'EbankingController@index')->name('ebanking.index');

});


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

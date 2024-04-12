<?php

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Http\Request;
use Facade\FlareClient\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\AttendeeController;
use App\Http\Controllers\API\FeedBackController;
use App\Http\Controllers\API\MappingModuleController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ResourceCotroller;
use App\Http\Controllers\API\SponsorController;


//Test
Route::get('/test', [AuthController::class, 'test']);

//Auth - Login
Route::post('login', [AuthController::class, 'login'])->name('login');

//Auth - Register
Route::post('/register', [AuthController::class, 'register']);

//Auth - Forget password 
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

//Auth - Reset password
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');

//Job-Title
Route::get('/job-titles', [AuthController::class, 'jobTitle']);

//Companies
Route::get('/companies', [AuthController::class, 'companies']);

//Industries
Route::get('/industries', [AuthController::class, 'industries']);

//Keyword Mapping -- Country
Route::post('/country', [AuthController::class, 'country']);

//Keyword Mapping -- Skills
Route::post('/skills', [AuthController::class, 'skills']);

//Keyword Mapping -- State
Route::post('/state', [AuthController::class, 'state']);

//Keyword Mapping -- City
Route::post('/city', [AuthController::class, 'city']);

//Keyword Mapping - Industry
Route::post('/industry', [AuthController::class, 'industry']);

//Keyword Mapping - Company
Route::post('/company', [AuthController::class, 'company']);

//Keyword Mapping - Job-Title
Route::post('/job_title', [AuthController::class, 'job_title']);

//Sponsorship Packages
Route::get('/sponsorships', [AuthController::class, 'sponsorshipPackages']);

//Send Attendee List Pdf file to Sponsors
Route::post('/send_attendee_list_by_email', [SponsorController::class, 'sendAttendeeListByEmail']);

//It will be implemented once mobile app is ready
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

//UUID Resource
Route::get('/resource', [ResourceCotroller::class, 'index']);

Route::post('/resource', [ResourceCotroller::class, 'store']);

Route::get('/resource/{id}', [ResourceCotroller::class, 'show']);

//All Events - Mobile App 
Route::get('/all_events', [EventController::class, 'all_events']);

//Recommended Events - Mobile App
Route::get('/recommended_events', [EventController::class, 'recommended_events']);

//Event Invitation List for Attendee  - Mobile App
Route::post('/event_invitation_list', [EventController::class, 'event_invitation_list']);

//Accept Event Invitaion By Attendee  - Mobile App
Route::post('/accept_event_invitation', [EventController::class, 'accept_event_invitation']);

//Request for Event Invitaion  - Mobile App
Route::post('/request_event_invitation', [EventController::class, 'request_event_invitation']);

//Check Authentication
Route::post('/checkingAuthenticated', [AuthController::class, 'checkingAuthenticated']);

//Get user details
Route::post('/profile', [UserController::class, 'profile']);

//Logout
Route::post('/logout', [AuthController::class, 'logout']);

//Update Profile
Route::post('/updateprofile', [UserController::class, 'updateprofile']);

//Change Password
Route::post('/changepassword', [UserController::class, 'changePassword']);

//Protecting Routes
// Route::middleware('auth:sanctum')->group(function () {
// });

//Subscribe
Route::post('/subscribe', [AuthController::class, 'subscribe']);

//Unsubscribe
Route::post('/unsubscribe', [AuthController::class, 'unsubscribe']);

//Contact Us
Route::post('/contact-us', [AuthController::class, 'contact_us']);

//Website setting
Route::put('/website-settings/{key}', [AuthController::class, 'website_settings']);

//Show Website setting
Route::get('/show-website-settings/{key}', [AuthController::class, 'show_website_settings']);

//All Website setting
Route::get('/all-website-settings', [AuthController::class, 'all_website_settings']);

/**
 *  Mapping Module
 *  Unassigned Data 
 *  */
// Unassigned Data for Industry, Company, Job-Title, Country , State and City
Route::post('/unassignedData', [MappingModuleController::class, 'unassignedData']);

/**
 *  Mapping Module
 *  Assigned Data 
 **/
Route::post('/assignedCitiesData',[MappingModuleController::class, 'assignedCitiesData']);
Route::post('/assignedStatesData',[MappingModuleController::class, 'assignedStatesData']);
Route::post('/assignedCountriesData',[MappingModuleController::class, 'assignedCountriesData']);
Route::post('/assignedIndustriesData',[MappingModuleController::class, 'assignedIndustriesData']);
Route::post('/assignedCompaniesData',[MappingModuleController::class, 'assignedCompaniesData']);
Route::post('/assignedJobTitlesData',[MappingModuleController::class, 'assignedJobTitlesData']);
Route::post('/addSelectedIndustriesData',[MappingModuleController::class, 'addSelectedIndustriesData']);


Route::post('/removeSelectedIndustriesData',[MappingModuleController::class, 'removeSelectedIndustriesData']);
Route::post('/removeSelectedJobTitlesData',[MappingModuleController::class, 'removeSelectedJobTitlesData']);
Route::post('/removeSelectedCompaniesData',[MappingModuleController::class, 'removeSelectedCompaniesData']);


/**
 *  For App
 **/
 Route::get('/get-industries', [AuthController::class, 'get_industries']);
 Route::get('/get-job-titles', [AuthController::class, 'get_job_titles']);
 Route::get('/get-companies', [AuthController::class, 'get_companies']);
 Route::post('/others-unasssigned-data', [AuthController::class, 'others_unasssigned_data']);
 Route::post('/city-wise-event', [AuthController::class, 'city_wise_event']);

 
 /**
  *  Mapping Module - Industries CRUD 
  **/
 Route::get('/industries', [MappingModuleController::class, 'industries']);
 Route::get('/show-industries/{id}', [MappingModuleController::class, 'show_industries']);
 Route::post('/save-industries', [MappingModuleController::class, 'save_industries']);
 Route::put('/update-industries/{id}', [MappingModuleController::class, 'update_industries']);
 Route::delete('/destroy-industries/{id}', [MappingModuleController::class, 'destroy_industries']);

 /**
 *  Mapping Module - Companies CRUD 
 **/
Route::get('/companies', [MappingModuleController::class, 'companies']);
Route::get('/show-companies/{id}', [MappingModuleController::class, 'show_companies']);
Route::post('/save-companies', [MappingModuleController::class, 'save_companies']);
Route::put('/update-companies/{id}', [MappingModuleController::class, 'update_companies']);
Route::delete('/destroy-companies/{id}', [MappingModuleController::class, 'destroy_companies']);


 /**
 *  Mapping Module - Job-Titles CRUD 
 **/
Route::get('/jobtitles', [MappingModuleController::class, 'jobtitles']);
Route::get('/show-jobtitles/{id}', [MappingModuleController::class, 'show_jobtitles']);
Route::post('/save-jobtitles', [MappingModuleController::class, 'save_jobtitles']);
Route::put('/update-jobtitles/{id}', [MappingModuleController::class, 'update_jobtitles']);
Route::delete('/destroy-jobtitles/{id}', [MappingModuleController::class, 'destroy_jobtitles']);

/**
 *  Mapping Module - City CRUD 
 **/
Route::get('/cities', [MappingModuleController::class, 'cities']);
Route::get('/show-cities/{id}', [MappingModuleController::class, 'show_cities']);
Route::post('/save-cities', [MappingModuleController::class, 'save_cities']);
Route::put('/update-cities/{id}', [MappingModuleController::class, 'update_cities']);
Route::delete('/destroy-cities/{id}', [MappingModuleController::class, 'destroy_cities']);

/**
 *  Mapping Module - State CRUD 
 **/
Route::get('/states', [MappingModuleController::class, 'states']);
Route::get('/show-states/{id}', [MappingModuleController::class, 'show_states']);
Route::post('/save-states', [MappingModuleController::class, 'save_states']);
Route::put('/update-states/{id}', [MappingModuleController::class, 'update_states']);
Route::delete('/destroy-states/{id}', [MappingModuleController::class, 'destroy_states']);

/**
 *  Mapping Module - Country CRUD 
 **/
Route::get('/countries', [MappingModuleController::class, 'countries']);
Route::get('/show-countries/{id}', [MappingModuleController::class, 'show_countries']);
Route::post('/save-countries', [MappingModuleController::class, 'save_countries']);
Route::put('/update-countries/{id}', [MappingModuleController::class, 'update_countries']);
Route::delete('/destroy-countries/{id}', [MappingModuleController::class, 'destroy_countries']);

Route::get('/count-mapping-data', [MappingModuleController::class, 'countMappingData']);









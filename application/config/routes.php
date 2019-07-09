<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$api = 'api/';

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
// $route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
// $route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8

/* Authentication */
$route[$api .'auth/verify'] = "AuthController/index_get";
$route[$api .'auth/login'] = "AuthController/index_post";
$route[$api .'auth/register'] = "AuthController/index_post";

/* Users */
$route[$api .'users'] = 'UserController/index_get';
$route[$api .'users'] = 'UserController/index_post';
$route[$api .'users'] = 'UserController/index_put';
$route[$api .'users'] = 'UserController/index_delete';

/* Contact */
$route[$api .'contacts'] = 'ContactController/index_get';
$route[$api .'contacts'] = 'ContactController/index_post';
$route[$api .'contacts'] = 'ContactController/index_put';
$route[$api .'contacts'] = 'ContactController/index_delete';

/* Education */
$route[$api .'educations'] = 'EducationController/index_get';
$route[$api .'educations'] = 'EducationController/index_post';
$route[$api .'educations'] = 'EducationController/index_put';
$route[$api .'educations'] = 'EducationController/index_delete';

/* Level */
$route[$api .'levels'] = 'LevelController/index_get';
$route[$api .'levels'] = 'LevelController/index_post';
$route[$api .'levels'] = 'LevelController/index_put';
$route[$api .'levels'] = 'LevelController/index_delete';

/* Religion */
$route[$api .'religions'] = 'ReligionController/index_get';
$route[$api .'religions'] = 'ReligionController/index_post';
$route[$api .'religions'] = 'ReligionController/index_put';
$route[$api .'religions'] = 'ReligionController/index_delete';

/* Profiles */
$route[$api .'profiles'] = 'ProfileController/index_get';
$route[$api .'profiles'] = 'ProfileController/index_post';
$route[$api .'profiles'] = 'ProfileController/index_put';
$route[$api .'profiles'] = 'ProfileController/index_delete';

/* Social Media */
$route[$api .'social-medias'] = 'SocialMediaController/index_get';
$route[$api .'social-medias'] = 'SocialMediaController/index_post';
$route[$api .'social-medias'] = 'SocialMediaController/index_put';
$route[$api .'social-medias'] = 'SocialMediaController/index_delete';

/* Vacancies */
$route[$api .'jobs'] = 'VacancyController/index_get';
$route[$api .'jobs'] = 'VacancyController/index_post';
$route[$api .'jobs'] = 'VacancyController/index_put';
$route[$api .'jobs'] = 'VacancyController/index_delete';

/* Companies */
$route[$api .'companies'] = 'CompanyController/index_get';
$route[$api .'companies'] = 'CompanyController/index_post';
$route[$api .'companies'] = 'CompanyController/index_put';
$route[$api .'companies'] = 'CompanyController/index_delete';

/* Users Achievements */
$route[$api .'users/achievements'] = 'UserAchievementController/index_get';
$route[$api .'users/achievements'] = 'UserAchievementController/index_post';
$route[$api .'users/achievements'] = 'UserAchievementController/index_put';
$route[$api .'users/achievements'] = 'UserAchievementController/index_delete';

/* Users Documents */
$route[$api .'users/documents'] = 'UserDocumentController/index_get';
$route[$api .'users/documents'] = 'UserDocumentController/index_post';
$route[$api .'users/documents'] = 'UserDocumentController/index_put';
$route[$api .'users/documents'] = 'UserDocumentController/index_delete';

/* Users Jobs */
$route[$api .'users/jobs'] = 'UserJobController/index_get';
$route[$api .'users/jobs'] = 'UserJobController/index_post';
$route[$api .'users/jobs'] = 'UserJobController/index_put';
$route[$api .'users/jobs'] = 'UserJobController/index_delete';

/* Users Languanges */
$route[$api .'users/languanges'] = 'UserLanguangeController/index_get';
$route[$api .'users/languanges'] = 'UserLanguangeController/index_post';
$route[$api .'users/languanges'] = 'UserLanguangeController/index_put';
$route[$api .'users/languanges'] = 'UserLanguangeController/index_delete';

/* Users Organitations */
$route[$api .'users/organizations'] = 'UserOrganitationController/index_get';
$route[$api .'users/organizations'] = 'UserOrganitationController/index_post';
$route[$api .'users/organizations'] = 'UserOrganitationController/index_put';
$route[$api .'users/organizations'] = 'UserOrganitationController/index_delete';

/* Users Projects */
$route[$api .'users/projects'] = 'UserProjectController/index_get';
$route[$api .'users/projects'] = 'UserProjectController/index_post';
$route[$api .'users/projects'] = 'UserProjectController/index_put';
$route[$api .'users/projects'] = 'UserProjectController/index_delete';

/* Users Skills */
$route[$api .'users/skills'] = 'UserSkillController/index_get';
$route[$api .'users/skills'] = 'UserSkillController/index_post';
$route[$api .'users/skills'] = 'UserSkillController/index_put';
$route[$api .'users/skills'] = 'UserSkillController/index_delete';

/* Users Social Media */
$route[$api .'users/social-medias'] = 'UserSocialMediaController/index_get';
$route[$api .'users/social-medias'] = 'UserSocialMediaController/index_post';
$route[$api .'users/social-medias'] = 'UserSocialMediaController/index_put';
$route[$api .'users/social-medias'] = 'UserSocialMediaController/index_delete';

/* Users Vacancies */
$route[$api .'users/vacancies'] = 'UserVacanciesController/index_get';
$route[$api .'users/vacancies'] = 'UserVacanciesController/index_post';
$route[$api .'users/vacancies'] = 'UserVacanciesController/index_put';
$route[$api .'users/vacancies'] = 'UserVacanciesController/index_delete';

/* Users Volunteers */
$route[$api .'users/volunteers'] = 'UserVolunteerController/index_get';
$route[$api .'users/volunteers'] = 'UserVolunteerController/index_post';
$route[$api .'users/volunteers'] = 'UserVolunteerController/index_put';
$route[$api .'users/volunteers'] = 'UserVolunteerController/index_delete';
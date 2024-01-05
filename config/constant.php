<?php
//

define('ADMIN_NAME', 'admin');
define('ADMIN_NAMESPACE_PREFIX', 'Admin');

define('USER_NAMESPACE_PREFIX', 'User');
define('USER_NAMED_ROUTE_PREFIX', 'u:');

define('API_NAMESPACE_PREFIX', 'Api');

//define('INSTALLER_NAME','installer');
//define('INSTALLER_NAMESPACE_PREFIX','Installer');

define('API_DEBUG', false);

// Project Level [
define('CLICK_KEYS', ['expense', 'income', 'bank', 'goal', 'budget', 'reports', 'water-remainder', 'sleep-remainder', 'medicine-reminder', 'heart-rate-monitor', 'task-manager', 'habit-manager', 'step-counter', 'calorie-and-distance']);
// ] Project Level

define('ACTION_LIST', [
    [
        'title' => '',

        'collapsed' => [
            /*[
                'label' => 'Pages',
                'icon' => 'fad fa-browser',
                'activeRoute' => '[]',
                'item' => [
                    [
                        'label' => 'Config',
                        'routeName' => 'page.details',
                        'activeRoute' => 'page-details/config',
                        'params' => 'config',
                    ],



                ],
            ],*/
            ['label' => 'Users', 'icon' => 'fad fa-user', 'routeName' => 'users', 'activeRoute' => 'users', 'params' => null],
            ['label' => 'Paid Features', 'icon' => 'fad fa-tools', 'routeName' => 'paid.features', 'activeRoute' => 'paid-features', 'params' => null],
            ['label' => 'Notifications', 'icon' => 'fad fa-bell', 'routeName' => 'notifications', 'activeRoute' => 'notifications', 'params' => null],
            ['label' => 'Advertisement', 'icon' => 'fad fa-newspaper', 'routeName' => 'advertisements', 'activeRoute' => 'advertisements', 'params' => null],
            ['label' => 'Plan', 'icon' => 'fad fa-newspaper', 'routeName' => 'plans', 'activeRoute' => 'plans', 'params' => null],

            ['label' => 'Expense', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/expense', 'params' => 'expense'],
            ['label' => 'Income', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/income', 'params' => 'income'],
            ['label' => 'Bank', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/bank', 'params' => 'bank'],
            ['label' => 'Goal', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/goal', 'params' => 'goal'],
            ['label' => 'Budget', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/budget', 'params' => 'budget'],
            ['label' => 'Reports', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/reports', 'params' => 'reports'],
            ['label' => 'Water Remainder', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/water-remainder', 'params' => 'water-remainder'],
            ['label' => 'Sleep Remainder', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/sleep-remainder', 'params' => 'sleep-remainder'],
            ['label' => 'Medicine Reminder', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/medicine-reminder', 'params' => 'medicine-reminder'],
            ['label' => 'Heart Rate Monitor', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/heart-rate-monitor', 'params' => 'heart-rate-monitor'],
            ['label' => 'Task Manager', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/task-manager', 'params' => 'task-manager'],
            ['label' => 'Habit Manager', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/habit-manager', 'params' => 'habit-manager'],
            ['label' => 'Step Counter', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/step-counter', 'params' => 'step-counter'],
            ['label' => 'Calorie And Distance', 'icon' => 'fad fa-circle', 'routeName' => 'clicks', 'activeRoute' => 'clicks/calorie-and-distance', 'params' => 'calorie-and-distance'],


        ],
    ],


]);


<?php
$collection = new \Forum\Libs\Routing\RouteCollection();
$collection->add('categoryList', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . '',
    [
        'file' => DIR_CONTROLLER . 'CategoryController.php',
        'class' => 'CategoryController',
        'method' => 'getCategoryList'
    ]
));

$collection->add('topicList', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'forum/<category>',
    [
        'file' => DIR_CONTROLLER . 'CategoryController.php',
        'class' => 'CategoryController',
        'method' => 'getTopicList'
    ], 
    [
        'category' => "\w+",
    ],
    [
        'page' => 1
    ]
));

$collection->add('addTopic', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'forum/<category>/submit',
    [
        'file' => DIR_CONTROLLER . 'TopicController.php',
        'class' => 'TopicController',
        'method' => 'addTopic'
    ],
    [
        'category' => "\w+",
    ]
));

$collection->add('addPost', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'forum/<category>/<topic>/addPost',
    [
        'file' => DIR_CONTROLLER . 'PostController.php',
        'class' => 'PostController',
        'method' => 'add'
    ],
    [
        'category' => "\w+",
        'topic' => '\w+'
    ]
));

$collection->add('deletePost', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'delete/post/<id>',
    [
        'file' => DIR_CONTROLLER . 'PostController.php',
        'class' => 'PostController',
        'method' => 'delete'
    ],
    [
        'id' => "\d+"
    ]
));

$collection->add('deleteTopic', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'delete/topic/<id>',
    [
        'file' => DIR_CONTROLLER . 'TopicController.php',
        'class' => 'TopicController',
        'method' => 'delete'
    ],
    [
        'id' => "\d+"
    ]
));

$collection->add('topic', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'forum/<category>/<topic>',
    [
        'file' => DIR_CONTROLLER . 'TopicController.php',
        'class' => 'TopicController',
        'method' => 'getTopic'
    ],
    [
        'category' => "\w+",
        'topic' => '\w+'
    ],
    [
        'page' => 1
    ]
));

$collection->add('login', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'login',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'login'
    ]
));

$collection->add('logout', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'logout',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'logout'
    ]
));

$collection->add('register', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'signUp',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'add'
    ]
));

$collection->add('userInfo', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'user/<name>',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'getUserInfo'
    ],
    [
        'name' => "\w+"
    ]
));

$collection->add('userDashboard', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'user',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'userDashboard'
    ]
));

$collection->add('changePassword', new \Forum\Libs\Routing\Route(
    HTTP_SERVER . 'settings/password',
    [
        'file' => DIR_CONTROLLER . 'UserController.php',
        'class' => 'UserController',
        'method' => 'changePassword'
    ]
));

// uruchomienie Routingu
$router = new \Forum\Libs\Routing\Router('http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"], $collection);
<?php
use myfrm\Validator;


global $db;


$fillable = ['title', 'content', 'excerpt'];

$data = load($fillable);



//validation
$validator = new Validator();
// $validation = $validator->validate(['title' => 'explicabo Rdfkfl fl',
//  'excerpt' => 'Expl',
//  'content' => 'explicabo Rdfkfl fl',
//     'email' => 'sadadas@email.com',
//     'password' =>'123',
//     'repassword' =>'123'
//     ],[
//     'title' => [
//         'required' => true,
//         'min' => 5,
//         'max' => 190
//     ],
//     'excerpt' => [
//         'required' => true,
//         'min' => 10,
//         'max' => 190
//     ],
//     'content' => [
//         'required' => true,
//         'min' => 10,
//         'max' => 190
//     ],
//     'email' => [
//         'email' => true,

//     ],'password' => [
//         'required' => true,
//         'min' => 6,

//     ],'repassword' => [
//         'match' => 'password',
//     ],
    
// ]);

// print_arr($validation->getErrors());
// die;


$validation = $validator->validate($data,[
    'title' => [
        'required' => true,
        'min' => 5,
        'max' => 190
    ],
    'excerpt' => [
        'required' => true,
        'min' => 10,
        'max' => 190
    ],
    'content' => [
        'required' => true,
        'min' => 10,
        'max' => 190
    ],
    'email' => [
        'email' => true,

    ],'password' => [
        'required' => true,
        'min' => 6,

    ],'repassword' => [
        'match' => 'password',
    ],
    
]);
if(!$validation->hasErrors()){
    if ($db->query("INSERT INTO posts (title, content, excerpt) VALUES (:title, :content, :excerpt)", $data)) {
       $_SESSION['success'] = 'OK';
    } else {
        $_SESSION['error'] = 'DB Error';
    }
    redirect('/');
}  else {
    require VIEWS . '/posts/create.tpl.php';
}


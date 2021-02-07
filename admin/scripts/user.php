<?php

function createUser($user_data)
{
    ## 1. Run the proper SQL query to insert user
    $pdo = Database::getInstance()->getConnection();

    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email)';
    $create_user_query .= ' VALUES(:fname, :username, :password, :email)';
    
    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$user_data['fname'],
            ':username'=>$user_data['username'],
            ':password'=>$user_data['password'],
            ':email'=>$user_data['email'],
        )
    );

    ## 2. Redirect to index.php if create user successfully (*maybe with some message???),
    # otherwise, showing the error message

    if ($create_user_result) {
        redirect_to('index.php');
    } else {
        return 'The user did not go through!!';
    }
}

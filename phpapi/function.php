<?php

function getPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM `Posts`"); 

    $postsList = [];
    
    while ($post = mysqli_fetch_assoc($posts)) {
        $postsList[] = $post; 
    }
    
    echo json_encode($postsList);
}

function getPost ($connect, $id){
    $post = mysqli_query($connect, "SELECT * FROM `Posts` WHERE `id` = '$id'");
    
    if(mysqli_num_rows($post) < 1){
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Post not found"
        ];
        echo json_encode($res);
    }else{
    $post = mysqli_fetch_assoc($post);
    echo json_encode($post);
    }
}

function addPost($connect, $data){

    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "INSERT INTO `Posts`(`id`, `title`, `body`) VALUES ('[value-1]','$title','$body')");


    http_response_code(201);

    $res = [
        "status" => true,
        "post_id" => mysqli_insert_id($connect)
    ];

    

    echo json_encode($res);
}

function updatePost ($connect, $id, $data) {
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "UPDATE `Posts` SET `title` = '$title', `body` = '$body' WHERE `Posts`.`id` = '$id'");
    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "Post is updated"
    ];
    echo json_encode($res);
}

function deletePost ($connect , $id) {
    mysqli_query($connect , "DELETE FROM `Posts` WHERE `Posts`.`id` = '$id'");

    http_response_code(200);
    $res = [
        "status" => true,
        "message" => "Post is deleted"
    ];
    echo json_encode($res);
}

<?php 


global $db;
$title = 'My Blog :: About';

$post = '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus laborum nihil quia, totam repellat magnam est deserunt fugit voluptatem sequi, ut consequatur in voluptates aut, ipsam aperiam esse aspernatur consequuntur?</p>
<p>Rerum distinctio id odit praesentium sapiente voluptatibus harum fuga, corrupti aspernatur amet commodi nobis similique unde labore magni numquam consequuntur quam! Corrupti veniam velit delectus? Quas, animi! Laborum, cum sapiente.</p>
<p>Velit assumenda sequi quod mollitia quis dignissimos vel praesentium optio totam dolorum? Incidunt deleniti mollitia expedita debitis eligendi nam quod laboriosam architecto odio vero amet placeat aspernatur, ad tempore libero?</p>';

$recent_posts= $db->query("SELECT * FROM posts ORDER BY id DESC LIMIT 4")->findAll();
require_once VIEWS .'/about.tpl.php';
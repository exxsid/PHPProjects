<?php

require 'vendor\autoload.php';
putenv('FIRESTORE_EMULATOR_HOST=localhost:8059');

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    "projectId" => "infoman2-g2-2bd13"
]);

$postCollectionRef = $db->collection("posts");


$data = [
    [
        "title" => "The Benefits of Mindfulness Meditation",
        "body" => "Mindfulness meditation has become increasingly popular in recent years as a way to reduce stress, improve focus, and cultivate a greater sense of well-being. In this post, we'll explore the benefits of mindfulness meditation and how it can help you improve your mental and emotional health.",
        "reaction" => 12,
        "comment" => 10,
    ],
    [
        "title" => "The Top 10 Must-Visit Destinations for Solo Travelers",
        "body" => "Traveling alone can be an incredibly rewarding experience, but it can also be intimidating to plan a solo trip. In this post, we'll explore the top 10 must-visit destinations for solo travelers, including budget-friendly options, adventurous destinations, and places that are easy to navigate on your own.",
        "reaction" => 3,
        "comment" => 10,
    ],
    [
        "title" => "How to Start a Successful Side Hustle",
        "body" => "If you're looking to earn some extra income or start a business on the side, a side hustle could be the perfect solution. In this post, we'll explore how to start a successful side hustle, including identifying your skills and passions, finding a profitable niche, and marketing your services.",
        "reaction" => 5,
        "comment" => 2,
    ],
    [
        "title" => "The Top 5 Habits of Highly Productive People",
        "body" => "Productivity is the key to success in any field, and highly productive people often share certain habits that help them stay focused and motivated. In this post, we'll explore the top 5 habits of highly productive people, including setting priorities, staying organized, and taking breaks to recharge.",
        "reaction" => 5,
        "comment" => 2,
    ],
];
foreach ($data as $d) {
    $postCollectionRef->add($d);
}

<?php
$config["view"] = [	
	"defaultTemplateLocation" => __DIR__ . '/project/templates',
];
$config["model"] = [
	"dataConnection" => "mysql:host=localhost;dbname=test;username=root;",
    "namespace" => "project\\model",
    "entities" => [
        "physicAutoCompleted" => [
            "repositoryName" => "table",
            "autoComplete" => true,
        ],
        "physic" => [
            "repositoryName" => "table",
            "autoComplete" => false,
        ],
        "generated" => [
            "repositoryName" => "table",
            "autoComplete" => true,
        ],
    ],
];
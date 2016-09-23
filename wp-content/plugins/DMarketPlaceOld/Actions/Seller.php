<?php

//use DMarketPlace\Framework\Repository\SellerRepository;
//use DMarketPlace\Framework\Controller\SellerController;


global $app;

// Register Repo
$app['seller.repository'] = function() { 
    return new SellerRepository();
};

// Register SellerController as repo
$app['seller.controller'] = function($app){
    return new SellerController($app['seller.repository']);
};


// actions
$app->post('*', "seller.controller:createAction");
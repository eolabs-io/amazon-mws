<?php

/*
 * You can place your custom package configuration in here.
 */
return [
	'constants' => [
		'amazon' => [
            'application' => 'LaravelAmazonMWS',
            'appversion' => '2.0',
            'version' => [
                'feeds' => '2009-01-01',
                'inbound' => '2010-10-01',
                'inventory' => '2010-10-01',
                'orders' => '2013-09-01',
                'outbound' => '2010-10-01',
                'products' => '2011-10-01',
                'reports' => '2009-01-01',
                'sellers' => '2011-07-01',
                'finance' => '2015-05-01',
            ],
        ], 
		'throttle' => [
            'limit' => [
                'finance' => 30,
                'order' => 6,
                'orderList' => 6,
                'item' => 30,
                'status' => 2,
                'sellers' => 15,
                'inventory' => 30,
                'product' => 20,
                'reportRequest' => 15,
                'reportRequestList' => 10,
                'reportToken' => 30,
                'reportList' => 10,
                'report' => 15,
                'reportSchedule' => 10,
                'feedSubmit' => 15,
                'feedList' => 10,
                'feedResult' => 15,
            ],
            'time' => [
                'finance' => 2,
                'order' => 60,
                'orderList' => 60,
                'item' => 2,
                'status' => 300,
                'sellers' => 60,
                'inventory' => 2,
                'productList' => 5,
                'productMatch' => 1,
                'productId' => 4,
                'productPrice' => 2,
                'reportRequest' => 60,
                'reportRequestList' => 45,
                'reportToken' => 2,
                'reportList' => 60,
                'report' => 60,
                'reportSchedule' => 45,
                'feedSubmit' => 120,
                'feedList' => 45,
                'feedResult' => 60,
            ]
		]
	]
];
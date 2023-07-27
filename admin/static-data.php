<?php 

$users = [
    [
        'user_id' => 0,
        'username' => 'admin',
        'first_name' => 'admin',
        'last_name' => 'admin',
        'mobile' => '',
        'email' => 'admin@montego.com',
        'password' => 'admingantenk',
        'role' => 'admin'
    ],
    [
        'user_id' => 1,
        'username' => 'raihanajah',
        'first_name' => 'Raihan',
        'last_name' => 'Najah',
        'mobile' => '082100000000',
        'email' => 'rnajahazmy@gmail.com',
        'password' => 'ehanajah',
        'role' => 'user'
    ],
    [
        'user_id' => 2,
        'username' => 'abelpep',
        'first_name' => 'Abel',
        'last_name' => 'Pepper',
        'mobile' => '082200000000',
        'email' => 'abelpeppar@linuxmail.org',
        'password' => 'kyuubi',
        'role' => 'user'
    ],
    [
        'user_id' => 3,
        'username' => 'valerietang',
        'first_name' => 'Valerie',
        'last_name' => 'Tang',
        'mobile' => '082300000000',
        'email' => 'rie2aizawa@gmail.com',
        'password' => 'rie2chan',
        'role' => 'user'
    ]
];

$addresses = [
    [
        'address_id' => 0,
        'user_id' => 1,
        'city' => 'Kutai Timur',
        'province' => 'Kalimantan Timur',
        'zip' => '75611',
        'address' => 'Jl.Graha Expo Bukit Pelangi'
    ],
    [
        'address_id' => 2,
        'user_id' => 2,
        'city' => 'City 1',
        'province' => 'Province 1',
        'zip' => '11111',
        'address' => 'Address 1'
    ],
    [
        'address_id' => 3,
        'user_id' => 3,
        'city' => 'City 2',
        'province' => 'Province 2',
        'zip' => '22222',
        'address' => 'Address 2'
    ]
];


$products = [
    [
        'product_id' => 0,
        'category_id' => 0,
        'product_title' => 'Kaos Jelek',
        'product_desc' => 'Kaos yang beneran jelek, mending gak usah dibeli soalnya jelek.',
        'product_price' => 99999999
    ],
    [
        'product_id' => 1,
        'category_id' => 1,
        'product_title' => 'Kolor Jelek',
        'product_desc' => 'Kolor yang beneran jelek, mending gak usah dibeli soalnya jelek.',
        'product_price' => 99999999
    ]
];

$product_stocks = [
    [
        'product_id' => 0,
        'product_size' => 's',
        'product_stock' => '999'
    ],
    [
        'product_id' => 0,
        'product_size' => 'm',
        'product_stock' => '999'
    ],
    [
        'product_id' => 0,
        'product_size' => 'l',
        'product_stock' => '999'
    ],
    [
        'product_id' => 1,
        'product_size' => 's',
        'product_stock' => '999'
    ],
    [
        'product_id' => 1,
        'product_size' => 'm',
        'product_stock' => '999'
    ],
    [
        'product_id' => 1,
        'product_size' => 'l',
        'product_stock' => '999'
    ]
];

$categories = [
    [
        'category_id' => 0,
        'category_name' => 'Baju'
    ],
    [
        'category_id' => 1,
        'category_name' => 'Celana'
    ],
    [
        'category_id' => 2,
        'category_name' => 'Outer'
    ]
];

// $reviews = [
//     [
//         'review_id' => 0,
//         'user_id' => 1,
//         'product_id' => 0,
//         'rating' => 5,
//         'comment' => 'Sesuai deskripsi, barangya jelek. Mending gak usah beli, nyesel saya.'
//     ],
//     [
//         'review_id' => 1,
//         'user_id' => 2,
//         'product_id' => 1,
//         'rating' => 5,
//         'comment' => 'Wah, barangnya jelek sekali.'
//     ]
// ];

$orders = [
    [
        'order_id' => 0,
        'user_id' => 1,
        'address_id' => 0,
        'total_amount' => 299999997,
        'order_date' => '17-08-1945',
        'order_status' => 'accepted',
        'payment_status' => 'paid'
    ],
    [
        'order_id' => 1,
        'user_id' => 2,
        'address_id' => 2,
        'total_amount' => 99999999,
        'order_date' => '17-08-1945',
        'order_status' => 'waiting for acc',
        'payment_status' => 'paid'
    ],
    [
        'order_id' => 2,
        'user_id' => 2,
        'address_id' => 2,
        'total_amount' => 99999999,
        'order_date' => '17-08-1945',
        'order_status' => 'declined',
        'payment_status' => 'waiting_for_payment'
    ]
];

$order_items = [
    [
        'orer_item_id' => 0,
        'order_id' => 0,
        'user_id' =>1,
        'product_id' => 0,
        'quantity' => 2,
        'price' => 99999999
    ],
    [
        'orer_item_id' => 1,
        'order_id' => 0,
        'user_id' =>1,
        'product_id' => 1,
        'quantity' => 1,
        'price' => 99999999
    ],
    [
        'orer_item_id' => 2,
        'order_id' => 1,
        'user_id' =>2,
        'product_id' => 1,
        'quantity' => 1,
        'price' => 99999999
    ],
    [
        'orer_item_id' => 3,
        'order_id' => 2,
        'user_id' =>2,
        'product_id' => 1,
        'quantity' => 1,
        'price' => 99999999
    ]
];

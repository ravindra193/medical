<?php

$config = [
    'adminLogin' => [
        [
            'field' => 'loginUsername',
            'label' => 'Admin ID',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'loginPassword',
            'label' => 'Password',
            'rules' => 'required|trim'
        ]
    ],
    'userLogin' => [
        [
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|trim'
        ]
    ],
    'adduser' => [
        [
            'field' => 'firstname',
            'label' => 'first name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'lastname',
            'label' => 'last name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'username',
            'label' => 'username',
            'rules' => 'required|trim|is_unique[user_detail.username]',
            'errors'=> [
                'is_unique' => 'This username already Used',
            ]
        ],
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email|is_unique[user_detail.email]',
            'errors'=> [
                'is_unique' => 'This email already registered',
            ]
        ],
        [
            'field' => 'mobileno',
            'label' => 'mobile',
            'rules' => 'trim|required|is_unique[user_detail.mobile_no]|min_length[9]|max_length[10]',
            'errors'=> [
                'is_unique' => 'This mobile already Used',
            ]
        ],
        [
            'field' => 'address',
            'label' => 'address',
            'rules' => 'trim|required'
        ],
    ],
    'addsupplier' => [
        [
            'field' => 'firstname',
            'label' => 'first name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'lastname',
            'label' => 'last name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'company_name',
            'label' => 'company name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'trading_name',
            'label' => 'trading name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'vat_no',
            'label' => 'vat no',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'com_reg_no',
            'label' => 'company registration number',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email|is_unique[tbl_supplier.email]',
            'errors'=> [
                'is_unique' => 'This Email already registered',
            ]
        ],
        [
            'field' => 'mobileno',
            'label' => 'mobile',
            'rules' => 'trim|required|is_unique[tbl_supplier.mobile_no]|min_length[9]|max_length[10]',
            'errors'=> [
                'is_unique' => 'This mobile already Used',
            ]
        ],
        [
            'field' => 'telephone_number',
            'label' => 'telephone number',
            'rules' => 'required|trim'
        ],
         [
            'field' => 'wda_reg_number',
            'label' => 'WDA registration number',
            'rules' => 'required|trim'
        ],
         [
            'field' => 'authorization_date',
            'label' => 'authorization date',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'sort_code',
            'label' => 'sort code',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'account_number',
            'label' => 'account number',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bank_name',
            'label' => 'bank name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bank_branch',
            'label' => 'bank branch',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'trade_references_1',
            'label' => 'trade references 1',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'invoice_address',
            'label' => 'invoice address',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'delivery_address',
            'label' => 'delivery address',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'gphc_number',
            'label' => 'GPHC number',
            'rules' => 'required|trim',
        ],
    ],
     'addsupplierbankdetail' => [
         [
            'field' => 'supplier_id',
            'label' => 'Select a supplier',
            'rules' => 'required|trim|greater_than[0]',
            'errors'=> [
                'greater_than' => 'Please select supplier name',
            ]
        ],
        [
            'field' => 'sort_code',
            'label' => 'sort code',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'account_number',
            'label' => 'account number',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bank_name',
            'label' => 'bank name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bank_branch',
            'label' => 'bank branch',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'trade_references_1',
            'label' => 'trade references 1',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'invoice_address',
            'label' => 'invoice address',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'delivery_address',
            'label' => 'delivery address',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'gphc_number',
            'label' => 'GPHC number',
            'rules' => 'required|trim',
        ],
    ],
    'addinventory' => [
        [
            'field' => 'product_category',
            'label' => 'Select product category',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'product_name',
            'label' => 'product name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'pack_size',
            'label' => 'pack size',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'price',
            'label' => 'price',
            'rules' => 'trim|required',
        ],
        [
            'field' => 'supplier_id',
            'label' => 'Select a supplier',
            'rules' => 'required|trim|greater_than[0]',
            'errors'=> [
                'greater_than' => 'Please select supplier',
            ]
        ],
        [
            'field' => 'product_category',
            'label' => 'Select a category',
            'rules' => 'required|trim|greater_than[0]',
            'errors'=> [
                'greater_than' => 'Please select category',
            ]
        ],
        [
            'field' => 'storage',
            'label' => 'Select a storage',
            'rules' => 'required|trim|greater_than[0]',
            'errors'=> [
                'greater_than' => 'Please select storage',
            ]
        ],
    ],
    'makebill' => [
        [
            'field' => 'customer_name',
            'label' => 'customer name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'customer_mobile',
            'label' => 'customer mobile',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'product_number',
            'label' => 'product name',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'required|trim',
        ],
    ],
    'verificationform' => [
        [
            'field' => 'code',
            'label' => 'Code',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'product_number',
            'label' => 'Select a product name',
            'rules' => 'required|trim|greater_than[0]',
            'errors'=> [
                'greater_than' => 'Please select product number',
            ]
        ],
    ],
    'userprofile' => [
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'mobile_no',
            'label' => 'Mobile No',
            'rules' => 'required|trim|min_length[9]|max_length[10]'
        ]
    ],
     'updateuser' => [
        [
            'field' => 'firstname',
            'label' => 'First Name',
            'rules' => 'required|trim',
        ],
        [
            'field' => 'lastname',
            'label' => 'Last Name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|is_unique[user_detail.email]',
            'errors'=> [
                'is_unique' => 'This Email already registered',
            ]
        ],
        [
            'field' => 'mobileno',
            'label' => 'Mobile',
            'rules' => 'trim|required|is_unique[user_detail.mobile_no]|min_length[9]|max_length[10]',
            'errors'=> [
                'is_unique' => 'This mobile already Used',
            ]
        ],
        [
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'trim|required'
        ],
    ],
    'verificationform' => [
        [
            'field' => 'code',
            'label' => 'Code',
            'rules' => 'trim|required'
        ]
    ],
    'userprofile' => [
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'mobile_no',
            'label' => 'Mobile No',
            'rules' => 'required|trim|min_length[9]|max_length[10]'
        ]
    ],
    'sellerbankdetail' => [
        [
            'field' => 'bankname',
            'label' => 'Bank Name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'account_no',
            'label' => 'Account No',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'branch_name',
            'label' => 'Branch Name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'selling_request_id',
            'label' => 'Seller Request Id',
            'rules' => 'required|trim',
            'errors'=> [
                'is_unique' => 'Seller Request Id is Not axist',
            ]
        ]
    ],
    'resetPass' => [
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'conpass',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[password]'
        ]
    ],
    'resetadminpass' => [
        [
            'field' => 'oldpassword',
            'label' => 'Old Password',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ],
        [
            'field' => 'conpass',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[password]'
        ]
    ],
    'updateProfile' => [
        [
            'field' => 'username',
            'label' => 'User Name',
            'rules' => 'required|trim|is_unique[tbl_users.username]'
        ]
    ],
    'PostBtcDetails' => [
        [
            'field' => 'btcAddress',
            'label' => 'Bitcoin Address',
            'rules' => 'required|trim'
        ]
    ],
    'PostBankDetails' => [
        [
            'field' => 'bankName',
            'label' => 'Bank Name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bankAccount',
            'label' => 'Account No.',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'bankBranch',
            'label' => 'Branch Name',
            'rules' => 'required|trim'
        ]
    ],
    'PostSellAds' => [
        [
            'field' => 'no_coins',
            'label' => 'Number of Coins',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'btcprice',
            'label' => 'BTC Price',
            'rules' => 'required|trim'
        ],
    ],
    'PostBuyAds' => [
        [
            'field' => 'no_coins',
            'label' => 'Number of Coins',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'btcprice',
            'label' => 'BTC Price',
            'rules' => 'required|trim'
        ],
    ],
    'paymentdetail' => [
        [
            'field' => 'yourbankname',
            'label' => 'Bank Name',
            'rules' => 'required|trim'
        ],
        [
            'field' => 'tnumber',
            'label' => 'Transaction Number',
            'rules' => 'required|trim'
        ],
    ],
    'trasfer' => [
        [
            'field' => 'nocoin',
            'label' => 'Trasfer Coins',
            'rules' => 'required|trim'
        ]
    ],
    'resetemail' => [
        [
            'field' => 'email',
            'label' => 'Email Address',
            'rules' => 'required|trim'
        ]
    ]
];

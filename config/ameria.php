<?php

return [
    'client_id' => '6fe2d874-9f08-47e3-949a-8d8abe7bb530',
    'username' => '3d19541048',
    'password' => 'lazY2k',

    'soap_url_1' => 'https://testpayments.ameriabank.am/webservice/PaymentService.svc?wsdl',
    'soap_url_2' => 'https://testpayments.ameriabank.am/webservice/PaymentService.svc?wsdl',
    'form_url' => 'https://testpayments.ameriabank.am/forms/frm_paymentstype.aspx',
    'check_url' => 'https://testpayments.ameriabank.am/forms/frm_checkprint.aspx',

    'soap_options' => [
        'soap_version' => SOAP_1_1,
        'exceptions' => true,
        'trace' => 1,
        'wdsl_local_copy' => true
    ]
];
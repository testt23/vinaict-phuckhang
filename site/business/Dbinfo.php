<?php

class DbInfo {

    
    function __construct() {
        
    }
    
    
    /*COUNT*/
    
    public $_count                                  = 'is_count';
    public $_max                                    = 'is_max';
    
    /*LIST TABLE'S NAME*/
    
    public $_table_product                          = 'product';
    public $_table_product_category                 = 'product_category';
    public $_table_image                            = 'image';
    public $_table_image_group                      = 'image_group';
    public $_table_web_page                         = 'web_page';
    public $_table_customer                         = 'customer';
    public $_table_session                          = 'session';
    public $_table_article                          = 'article';
    public $_table_article_category                 = 'article_category';
    public $_table_currency                         = 'currency';
    public $_table_group                            = 'group';
    public $_table_image_size                       = 'image_size';
    public $_table_language                         = 'language';
    public $_table_menu                             = 'menu';
    public $_table_param_group                      = 'param_group';
    public $_table_param_group_parameter            = 'param_group_parameter';
    public $_table_param_parameter                  = 'parameter';
    public $_table_param_permission                 = 'permission';
    public $_table_user                             = 'user';
    public $_table_user_group                       = 'user_group';
    public $_table_purchase_order_status            = 'purchase_order_status';
    public $_table_purchase_order                   = 'purchase_order';
    public $_table_purchase_order_detail            = 'purchase_order_detail';
    
    /*PRODUCT*/
    
    public $_product_as_id                          = 'product_id';
    public $_product_as_code                        = 'product_code';
    public $_product_as_name                        = 'product_name';
    public $_product_as_short_description           = 'product_short_description';
    public $_product_as_description                 = 'product_description';
    public $_product_as_price                       = 'product_price';
    public $_product_as_currency                    = 'product_currency';
    public $_product_as_link                        = 'product_link';
    public $_product_as_id_def_image                = 'product_id_def_image';
    public $_product_as_is_disabled                 = 'product_is_disabled';
    public $_product_as_id_prod_category            = 'product_id_prod_category';
    public $_product_as_is_deleted                  = 'product_is_deleted';
    public $_product_as_keywords                    = 'product_keywords';
    public $_product_as_is_featured                 = 'product_is_featured';
    public $_product_as_id_prod_image               = 'product_id_prod_image';
    public $_product_as_id_primary_prod_category    = 'product_id_primary_prod_category';
    
    public $_product_id                             = 'product.id';
    public $_product_code                           = 'product.code';
    public $_product_name                           = 'product.name';
    public $_product_short_description              = 'product.short_description';
    public $_product_description                    = 'product.description';
    public $_product_price                          = 'product.price';
    public $_product_currency                       = 'product.currency';
    public $_product_link                           = 'product.link';
    public $_product_id_def_image                   = 'product.id_def_image';
    public $_product_is_disabled                    = 'product.is_disabled';
    public $_product_id_prod_category               = 'product.id_prod_category';
    public $_product_is_deleted                     = 'product.is_deleted';
    public $_product_keywords                       = 'product.keywords';
    public $_product_is_featured                    = 'product.is_featured';
    public $_product_id_prod_image                  = 'product.id_prod_image';
    public $_product_id_primary_prod_category       = 'product.id_primary_prod_category';
    
    /*PRODUCT CATEGORY*/
    
    public $_product_category_id                    = 'product_category.id';
    public $_product_category_code                  = 'product_category.code';
    public $_product_category_name                  = 'product_category.name';
    public $_product_category_is_deleted            = 'product_category.is_deleted';
    public $_product_category_id_parent             = 'product_category.id_parent';
    public $_product_category_description           = 'product_category.description';
    public $_product_category_keywords              = 'product_category.keywords';
    public $_product_category_id_image              = 'product_category.id_image';
    public $_product_category_link                  = 'product_category.link';
    
    public $_product_category_as_id                 = 'product_category_id';
    public $_product_category_as_code               = 'product_category_code';
    public $_product_category_as_as_name            = 'product_category_name';
    public $_product_category_as_is_deleted         = 'product_category_is_deleted';
    public $_product_category_as_id_parent          = 'product_category_id_parent';
    public $_product_category_as_as_description     = 'product_category_description';
    public $_product_category_as_keywords           = 'product_category_keywords';
    public $_product_category_as_id_image           = 'product_category_id_image';
    public $_product_category_as_link               = 'product_category_link';
    
    /*IMAGE*/
    public $_image_as_id                            = 'image_id';
    public $_image_as_code                          = 'image_code';
    public $_image_as_name                          = 'image_name';
    public $_image_as_description                   = 'image_description';
    public $_image_as_id_image_group                = 'image_id_image_group';
    public $_image_as_file                          = 'image_file';
    public $_image_as_creation_date_timestamp       = 'image_creation_date_timestamp';
    
    public $_image_id                               = 'image.id';
    public $_image_code                             = 'image.code';
    public $_image_name                             = 'image.name';
    public $_image_description                      = 'image.description';
    public $_image_id_image_group                   = 'image.id_image_group';
    public $_image_file                             = 'image.file';
    public $_image_creation_date_timestamp          = 'image.creation_date_timestamp';
    
    
    /*IMAGE GROUP*/
    
    public $_image_group_as_id                      = 'image_group_id';
    public $_image_group_as_code                    = 'image_group_code';
    public $_image_group_as_name                    = 'image_group_name';
    public $_image_group_as_id_image_size           = 'image_group_id_image_size';
    
    public $_image_group_id                         = 'image_group.id';
    public $_image_group_code                       = 'image_group.code';
    public $_image_group_name                       = 'image_group.name';
    public $_image_group_id_image_size              = 'image_group.id_image_size';
    
    /*PAGE*/
    
    public $_web_page_id                            = 'web_page.id';
    public $_web_page_title                         = 'web_page.title';
    public $_web_page_content                       = 'web_page.content';
    public $_web_page_link                          = 'web_page.link';
    public $_web_page_keywords                      = 'web_page.keywords';
    public $_web_page_is_disabled                   = 'web_page.is_disabled';
    public $_web_page_id_parent                     = 'web_page.id_parent';
    
    public $_web_page_as_id                         = 'web_page_id';
    public $_web_page_as_title                      = 'web_page_title';
    public $_web_page_as_content                    = 'web_page_content';
    public $_web_page_as_link                       = 'web_page_link';
    public $_web_page_as_keywords                   = 'web_page_keywords';
    public $_web_page_as_is_disabled                = 'web_page_is_disabled';
    public $_web_page_as_id_parent                  = 'web_page_id_parent';
    
    
    /*CUSTOMER*/
    
    public $_customer_id                            = 'customer.id';
    public $_customer_email                         = 'customer.email';
    public $_customer_firstname                     = 'customer.firstname';
    public $_customer_lastname                      = 'customer.lastname';
    public $_customer_company                       = 'customer.company';
    public $_customer_gender                        = 'customer.gender';
    public $_customer_birthday                      = 'customer.birthday';
    public $_customer_billing_address               = 'customer.billing_address';
    public $_customer_shipping_address              = 'customer.shipping_address';
    public $_customer_contact_address               = 'customer.contact_address';
    public $_customer_home_phone                    = 'customer.home_phone';
    public $_customer_work_phone                    = 'customer.work_phone';
    public $_customer_mobile_phone                  = 'customer.mobile_phone';
    public $_customer_website                       = 'customer.website';
    public $_customer_yahoo                         = 'customer.yahoo';   
    public $_customer_skype                         = 'customer.skype';
    public $_customer_is_deleted                    = 'customer.is_deleted';
    public $_customer_id_user                       = 'customer.id_user';
    public $_customer_is_business                   = 'customer.is_business';
    public $_customer_tax_code                      = 'customer.tax_code';
    public $_customer_fax                           = 'customer.fax';
    public $_customer_career                        = 'customer.career';
    public $_customer_contact_person                = 'customer.contact_person';
    public $_customer_position                      = 'customer.position';
    
    public $_customer_as_id                         = 'customer_id';
    public $_customer_as_email                      = 'customer_email';
    public $_customer_as_firstname                  = 'customer_firstname';
    public $_customer_as_lastname                   = 'customer_lastname';
    public $_customer_as_company                    = 'customer_company';
    public $_customer_as_gender                     = 'customer_gender';
    public $_customer_as_birthday                   = 'customer_birthday';
    public $_customer_as_billing_address            = 'customer_billing_address';
    public $_customer_as_shipping_address           = 'customer_shipping_address';
    public $_customer_as_contact_address            = 'customer_contact_address';
    public $_customer_as_home_phone                 = 'customer_home_phone';
    public $_customer_as_work_phone                 = 'customer_work_phone';
    public $_customer_as_mobile_phone               = 'customer_mobile_phone';
    public $_customer_as_website                    = 'customer_website';
    public $_customer_as_yahoo                      = 'customer_yahoo';   
    public $_customer_as_skype                      = 'customer_skype';
    public $_customer_as_is_deleted                 = 'customer_is_deleted';
    public $_customer_as_id_user                    = 'customer_id_user';
    public $_customer_as_is_business                = 'customer_is_business';
    public $_customer_as_tax_code                   = 'customer_tax_code';
    public $_customer_as_fax                        = 'customer_fax';
    public $_customer_as_career                     = 'customer_career';
    public $_customer_as_contact_person             = 'customer_contact_person';
    public $_customer_as_position                   = 'customer_position';
    
    
    /*SESSION*/
    
    public $_session_id                             = 'session.session_id';
    public $_session_ip_address                     = 'session.ip_address';
    public $_session_user_agent                     = 'session.user_agent';
    public $_session_last_activity                  = 'session.last_activity'; 
    public $_session_user_data                      = 'session.user_data';
    
    public $_session_as_id                          = 'session_session_id';
    public $_session_as_ip_address                  = 'session_ip_address';
    public $_session_as_user_agent                  = 'session_user_agent';
    public $_session_as_last_activity               = 'session_last_activity'; 
    public $_session_as_user_data                   = 'session_user_data';
    
    
    /*USER*/
    
    public $_user_id                                = 'user.id';
    public $_user_email                             = 'user.email';
    public $_user_pass                              = 'user.pass';
    public $_user_date_last_login                   = 'user.date_last_login';
    public $_user_last_name                         = 'user.last_name';
    public $_user_first_name                        = 'user.first_name';
    public $_user_disabled                          = 'user.disabled';
    public $_user_login_attempts                    = 'user.login_attempts';
    public $_user_deactived                         = 'user.deactived';
    public $_user_is_controller                     = 'user.is_controller';
    public $_user_home_phone                        = 'user.home_phone';
    public $_user_work_phone                        = 'user.work_phone';
    public $_user_mobile_phone                      = 'user.mobile_phone';
    public $_user_address                           = 'user.address';
    public $_user_name                              = 'user.name';
    public $_user_is_business                       = 'user.is_business';
    
    public $_user_as_id                             = 'user_id';
    public $_user_as_email                          = 'user_email';
    public $_user_as_pass                           = 'user_pass';
    public $_user_as_date_last_login                = 'user_date_last_login';
    public $_user_as_last_name                      = 'user_last_name';
    public $_user_as_first_name                     = 'user_first_name';
    public $_user_as_disabled                       = 'user_disabled';
    public $_user_as_login_attempts                 = 'user_login_attempts';
    public $_user_as_deactived                      = 'user_deactived';
    public $_user_as_is_controller                  = 'user_is_controller';
    public $_user_as_home_phone                     = 'user_home_phone';
    public $_user_as_work_phone                     = 'user_work_phone';
    public $_user_as_mobile_phone                   = 'user_mobile_phone';
    public $_user_as_address                        = 'user_address';
    public $_user_as_name                           = 'user_name';
    public $_user_as_is_business                    = 'user_is_business';
    
    
    /*USER GROUP*/
    
    public $_user_group_id_user                     = 'user_group.id_user';
    public $_user_group_id_group                    = 'user_group.id_group';
    
    public $_user_group_as_id_user                  = 'user_group_id_user';
    public $_user_group_as_id_group                 = 'user_group_id_group';
    
    /* PERMISSION*/
    
    public $_permission_id                          = 'permission.id';
    public $_permission_uri                         = 'permission.uri';
    public $_permission_id_user                     = 'permission.id_user';
    public $_permission_id_group                    = 'permission.id_group';
    public $_permission_value                       = 'permission.value';
    
    public $_permission_as_id                       = 'permission_id';
    public $_permission_as_uri                      = 'permission_uri';
    public $_permission_as_id_user                  = 'permission_id_user';
    public $_permission_as_id_group                 = 'permission_id_group';
    public $_permission_as_value                    = 'permission_value';
    
    
    /*PARAMETER*/
    
    public $_parameter_id                           = 'parameter.id';
    public $_parameter_name                         = 'parameter.name';
    public $_parameter_code                         = 'parameter.code';
    public $_parameter_value                        = 'parameter.value';
    public $_parameter_category                     = 'parameter.category';
    public $_parameter_status                       = 'parameter.status';
    public $_parameter_creation_date                = 'parameter.creation_date';
    public $_parameter_modification_date            = 'parameter.modification_date';
    public $_parameter_id_user_created              = 'parameter.id_user_created';
    public $_parameter_id_user_modified             = 'parameter.id_user_modified';
    public $_parameter_disabled                     = 'parameter.disabled';
    
    
    public $_parameter_as_id                        = 'parameter_id';
    public $_parameter_as_name                      = 'parameter_name';
    public $_parameter_as_code                      = 'parameter_code';
    public $_parameter_as_value                     = 'parameter_value';
    public $_parameter_as_category                  = 'parameter_category';
    public $_parameter_as_status                    = 'parameter_status';
    public $_parameter_as_creation_date             = 'parameter_creation_date';
    public $_parameter_as_modification_date         = 'parameter_modification_date';
    public $_parameter_as_id_user_created           = 'parameter_id_user_created';
    public $_parameter_as_id_user_modified          = 'parameter_id_user_modified';
    public $_parameter_as_disabled                  = 'parameter_disabled';
    
    
    /*PARAM GROUP*/
    
    public $_param_group_id                         = 'param_group.id';
    public $_param_group_code                       = 'param_group.code';
    public $_param_group_name                       = 'param_group.name';
    public $_param_group_disabled                   = 'param_group.disabled';
    public $_param_group_createion_date             = 'param_group.creation_date';
    public $_param_group_id_user_created            = 'param_group.id_user_created';
    public $_param_group_modification_date          = 'param_group.modification_date';
    public $_param_group_id_user_modified           = 'param_group.id_user_modified';
    
    /*PARAM GROUP PARAMETER*/
    
    public $_param_group_parameter_id_parameter     = 'param_group_parameter.id_parameter';
    public $_param_group_parameter_id_param_group   = 'param_group_parameter.id_param_group';
    
    public $_param_group_parameter_as_id_parameter  = 'param_group_parameter_id_parameter';
    public $_param_group_parameter_as_id_param_group = 'param_group_parameter_id_param_group';
    
    /*MENU*/
    
    public $_menu_id                                = 'menu.id';
    public $_menu_name                              = 'menu.name';
    public $_menu_position                          = 'menu.position';
    public $_menu_link                              = 'menu.link';
    public $_menu_section                           = 'menu.section';
    public $_menu_parent                            = 'menu.id_parent';
    public $_menu_disabled                          = 'menu.disabled';
    public $_menu_type                              = 'menu.type';
    
    public $_menu_as_id                             = 'menu_id';
    public $_menu_as_name                           = 'menu_name';
    public $_menu_as_position                       = 'menu_position';
    public $_menu_as_link                           = 'menu_link';
    public $_menu_as_section                        = 'menu_section';
    public $_menu_as_parent                         = 'menu_id_parent';
    public $_menu_as_disabled                       = 'menu_disabled';
    public $_menu_as_type                           = 'menu_type';
    
    
    /*LANGUAGE*/
    
    public $_language_id                            = 'language.id';
    public $_language_code                          = 'language.code';
    public $_language_name                          = 'language.name';
    public $_language_is_disabled                   = 'language.is_disabled';
    public $_language_is_deleted                    = 'language.is_deleted';
    
    public $_language_as_id                         = 'language_id';
    public $_language_as_code                       = 'language_code';
    public $_language_as_name                       = 'language_name';
    public $_language_as_is_disabled                = 'language_is_disabled';
    public $_language_as_is_deleted                 = 'language_is_deleted';
    
    
    /*IMAGE SIZE*/
    
    public $_image_size_id                          = 'image_size.id';
    public $_image_size_code                        = 'image_size.code';
    public $_image_size_name                        = 'image_size.name';
    public $_image_size_value                       = 'image_size.value';
    
    public $_image_size_as_id                       = 'image_size_id';
    public $_image_size_as_code                     = 'image_size_code';
    public $_image_size_as_name                     = 'image_size_name';
    public $_image_size_as_value                    = 'image_size_value';
    
    /*GROUP*/
    
    public $_group_id                               = 'group.id';
    public $_group_code                             = 'group.code';
    public $_group_name                             = 'group.name';
    public $_group_disabled                         = 'group.disabled';
    
    public $_group_as_id                            = 'group_id';
    public $_group_as_code                          = 'group_code';
    public $_group_as_name                          = 'group_name';
    public $_group_as_disabled                      = 'group_disabled';
    
    /*CURRENCY*/
    
    public $_currency_id                            = 'currency.id';
    public $_currency_code                          = 'currency.code';
    public $_currency_name                          = 'currency.name';
    public $_currency_size                          = 'currency.size';
    public $_currency_rate                          = 'currency.rate';
    public $_currency_is_default                    = 'currency.is_default';
    public $_currency_is_deleted                    = 'currency.is_deleted';
    
    public $_currency_as_id                         = 'currency_id';
    public $_currency_as_code                       = 'currency_code';
    public $_currency_as_name                       = 'currency_name';
    public $_currency_as_size                       = 'currency_size';
    public $_currency_as_rate                       = 'currency_rate';
    public $_currency_as_is_default                 = 'currency_is_default';
    public $_currency_as_is_deleted                 = 'currency_is_deleted';
    
    
    /*ARTICLE CATEGORY*/
    
    public $_article_category_id                    = 'article_category.id';
    public $_article_category_name                  = 'article_category.name';
    public $_article_category_is_deleted            = 'article_category.is_deleted';
    public $_article_category_id_parent             = 'article_category.id_parent';
    public $_article_category_description           = 'article_category.description';
    public $_article_category_keywords              = 'article_category.keywords';
    public $_article_category_link                  = 'article_category.link';
    
    public $_article_category_as_id                 = 'article_category_id';
    public $_article_category_as_name               = 'article_category_name';
    public $_article_category_as_is_deleted         = 'article_category_is_deleted';
    public $_article_category_as_id_parent          = 'article_category_id_parent';
    public $_article_category_as_description        = 'article_category_description';
    public $_article_category_as_keywords           = 'article_category_keywords';
    public $_article_category_as_link               = 'article_category_link';
    
    /*ARTICLE*/
    
    public $_article_id                             = 'article.id';
    public $_article_title                          = 'article.title';
    public $_article_content                        = 'article.content';
    public $_article_link                           = 'article.link';
    public $_article_keywords                       = 'article.keywords';
    public $_article_is_disabled                    = 'article.is_disabled';
    public $_article_id_article_category            = 'article.id_article_category';
    public $_article_id_image                       = 'article.id_image';
    public $_article_is_deleted                     = 'article.is_deleted';
    
    public $_article_as_id                          = 'article_id';
    public $_article_as_title                       = 'article_title';
    public $_article_as_content                     = 'article_content';
    public $_article_as_link                        = 'article_link';
    public $_article_as_keywords                    = 'article_keywords';
    public $_article_as_is_disabled                 = 'article_is_disabled';
    public $_article_as_id_article_category         = 'article_id_article_category';
    public $_article_as_id_image                    = 'article_id_image';
    public $_article_as_is_deleted                  = 'article_is_deleted';
    
    // PURCHASE ORDER 
    public $_purchase_order_id                      = 'purchase_order.id';
    public $_purchase_order_code                    = 'purchase_order.code';
    public $_purchase_order_is_customer             = 'purchase_order.is_customer';
    public $_purchase_order_order_date              = 'purchase_order.order_date';
    public $_purchase_order_amount                  = 'purchase_order.amount';
    public $_purchase_order_is_deleted              = 'purchase_order.is_deleted';
    public $_purchase_order_status                  = 'purchase_order.status';
    public $_purchase_order_description             = 'purchase_order.description';
    public $_purchase_order_shipping_address        = 'purchase_order.shipping_address';
    public $_purchase_order_billing_address         = 'purchase_order.billing_address';
    public $_purchase_order_shipping_date           = 'purchase_order.shipping_date';
    public $_purchase_order_payment_date            = 'purchase_order.payment_date';
    public $_purchase_order_creation_date           = 'purchase_order.creation_date';
    public $_purchase_order_modification_date       = 'purchase_order.modification_date';
    
    public $_purchase_order_as_id                   = 'purchase_order_id';
    public $_purchase_order_as_code                 = 'purchase_order_code';
    public $_purchase_order_as_is_customer          = 'purchase_order_is_customer';
    public $_purchase_order_as_order_date           = 'purchase_order_order_date';
    public $_purchase_order_as_amount               = 'purchase_order_amount';
    public $_purchase_order_as_is_deleted           = 'purchase_order_is_deleted';
    public $_purchase_order_as_status               = 'purchase_order_status';
    public $_purchase_order_as_description          = 'purchase_order_description';
    public $_purchase_order_as_shipping_address     = 'purchase_order_shipping_address';
    public $_purchase_order_as_billing_address      = 'purchase_order_billing_address';
    public $_purchase_order_as_shipping_date        = 'purchase_order_shipping_date';
    public $_purchase_order_as_payment_date         = 'purchase_order_payment_date';
    public $_purchase_order_as_creation_date        = 'purchase_order_creation_date';
    public $_purchase_order_as_modification_date    = 'purchase_order_modification_date';
    
    // PURCHASE ORDER DETAILS
    
    public $_purchase_order_detail_id               = 'purchase_order_detail.id';
    public $_purchase_order_detail_id_purchase_order = 'purchase_order_detail.id_purchase_order';
    public $_purchase_order_detail_id_product       = 'purchase_order_detail.id_product';
    public $_purchase_order_detail_code_product     = 'purchase_order_detail.code_product';
    public $_purchase_order_detail_name_product     = 'purchase_order_detail.name_product';
    public $_purchase_order_detail_price_product    = 'purchase_order_detail.price_product';
    public $_purchase_order_detail_currency_product = 'purchase_order_detail.currency_product';
    public $_purchase_order_detail_description_product    = 'purchase_order_detail.description_product';
    public $_purchase_order_detail_image_product    = 'purchase_order_detail.image_product';
    public $_purchase_order_detail_number           = 'purchase_order_detail.number';
    public $_purchase_order_detail_is_deleted       = 'purchase_order_detail.is_deleted';
    public $_purchase_order_detail_link_product     = 'purchase_order_detail.link_product';
    
    public $_purchase_order_detail_as_id               = 'purchase_order_detail_id';
    public $_purchase_order_detail_as_id_purchase_order = 'purchase_order_detail_id_purchase_order';
    public $_purchase_order_detail_as_id_product       = 'purchase_order_detail_id_product';
    public $_purchase_order_detail_as_code_product     = 'purchase_order_detail_code_product';
    public $_purchase_order_detail_as_name_product     = 'purchase_order_detail_name_product';
    public $_purchase_order_detail_as_price_product    = 'purchase_order_detail_price_product';
    public $_purchase_order_detail_as_currency_product = 'purchase_order_detail_currency_product';
    public $_purchase_order_detail_as_description_product    = 'purchase_order_detail_description_product';
    public $_purchase_order_detail_as_image_product    = 'purchase_order_detail_image_product';
    public $_purchase_order_detail_as_number           = 'purchase_order_detail_number';
    public $_purchase_order_detail_as_is_deleted       = 'purchase_order_detail_is_deleted';
    public $_purchase_order_detail_as_link_product     = 'purchase_order_detail_link_product';
    
    
    // PURCHASE ORDER status
    
    public $_purchase_order_status_id     = 'purchase_order_status.id';
    public $_purchase_order_status_name     = 'purchase_order_status.name';
    
    public $_purchase_order_status_as_id     = 'purchase_order_status_id';
    public $_purchase_order_status_as_name     = 'purchase_order_status_name';
    
}

?>
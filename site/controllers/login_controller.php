<?php

class Login_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Your own construction code here
    }

    function index() {
        $this->load->view('login');
    }

    function load_form() {


        // data user
        // initial page
        $page = ($this->input->get(Variable::getPaginationQueryString())) ? $this->input->get(Variable::getPaginationQueryString()) : 1;
        if ($page * 1 == 0) {
            $page = 1;
        }
        $total_record = Customer::countAll();
        $limit = Variable::getLimitRecordPerPage();
        $total_page = ceil($total_record / $limit);
        if ($total_page <= 0) {
            $total_page = 1;
        }

        if ($total_page < $page) {
            $page = $total_page;
        }
        $start = ($page - 1) * $limit;
        // call paging class to get string pagation
        $Paging = new Paging();
        $string_paging = $Paging->paging_html(base_url('login/load_form'), $total_page, $page, 7);

        $customer = Customer::selectAll(array('start' => $start, 'limit' => $limit));
        
        // link api
        $this->load->library('google_api/Lightopenid');
        $this->load->library('facebook_api/facebook');
        $this->lightopenid->returnUrl = base_url('login/google_login');
        $data['url_login_tweet'] = base_url('login/tweet_login');
        $data['url_login_google'] = $this->lightopenid->authUrl();
        
        $this->load->library('yahoo_api/Lightopenid_ya');
        $this->lightopenid_ya->returnUrl = base_url('login/yahoo_login');
        
        $data['url_login_yahoo'] = $this->lightopenid_ya->authUrl();
        $data['url_login_facebook'] = $this->facebook->getLoginUrl( array('scope' => 'email,read_stream', 'redirect_uri'=> base_url('login/facebook_login')));
        $data['customer'] = $customer;
        $data['paging'] = $string_paging;
        $this->load->view('login_popup', $data);
    }

    // TWEET LOGIN ACCESS

    function tweet_login() {

        $this->load->library('tweet_api/tweet');
        $this->tweet->enable_debug(false);
        $this->tweet->set_callback(site_url('login/tweet_login'));
        if (!$this->tweet->logged_in()) {
            
            $this->tweet->login();
        } else {
            $user = $this->tweet->call('get', 'account/verify_credentials');
            $filter = array();
            $filter['firstname'] = '';
            $filter['lastname'] = '';
            $filter['email'] = '';
            $filter['gender'] = 'F';
            $filter['birthday'] = '';
            $filter['mobile'] = '';
            $filter['image'] = '';
            $filter['username'] = '';
            $filter['link_profile'] = '';
            $filter['type_connect'] = '1';

            if (isset($user->profile_image_url))
                $filter['image'] = $user->profile_image_url;

            if (isset($user->name))
                $filter['firstname'] = $user->name;

            if (isset($user->profile_image_url))
                $filter['image'] = $user->profile_image_url;
            else
                $filter['image'] = base_url('images/no-picture.jpg');


            if (isset($user->screen_name))
                $filter['username'] = $user->screen_name;

            $filter['link_profile'] = 'https://twitter.com/' . $filter['username'];


            $customer = Customer::findByUsername($filter['username']);
            if ($customer->countRows() > 0)
                Customer::updateCustomerExist($customer, $filter);
            else
                Customer::insertCustomer($filter);

            $array = array();
            $array['username'] = $filter['username'];
            $array['email'] = $filter['email'];
            $array['link_profile'] = $filter['link_profile'];
            $array['image'] = $filter['image'];
            $array['type'] = $filter['type_connect'];
            $this->session->set_userdata('logined', $array);
        }
        $this->exit_login();
    }

    //GOOGLE ACCESS
    function google_login() {
        $this->load->library('google_api/Lightopenid');
        if ($this->lightopenid->mode) {
            if ($this->lightopenid->mode != 'cancel' && $this->lightopenid->validate()) {
                $data = $this->lightopenid->getAttributes();
                $filter = array();
                $filter['firstname'] = '';
                $filter['lastname'] = '';
                $filter['email'] = '';
                $filter['gender'] = 'F';
                $filter['birthday'] = '';
                $filter['mobile'] = '';
                $filter['username'] = '';
                $filter['link_profile'] = '';
                $filter['image'] = base_url('images/no-picture.jpg');
                $filter['type_connect'] = '3';
                if (array_key_exists("namePerson/first", $data))
                    $filter['firstname'] = $data['namePerson/first'];

                if (array_key_exists("namePerson/last", $data))
                    $filter['lastname'] = $data['namePerson/last'];

                if (array_key_exists("contact/email", $data))
                    $filter['email'] = $data['contact/email'];

                
                $customer = Customer::findByEmail($filter['email']);            
                if ($customer->countRows() > 0){
                    $customer->fetchFirst();
                    $customer->updateCustomerExist($customer->id, $filter);
                }
                else
                    Customer::insertCustomer($filter);

                $array = array();
                $array['username'] = $filter['username'] = '';
                $array['email'] = $filter['email'];
                $array['link_profile'] = $filter['link_profile'];
                $array['image'] = $filter['image'];
                $array['type'] = $filter['type_connect'];
                $this->session->set_userdata('logined', $array);
            }
        }
        $this->exit_login();
    }

    function logout() {
        $data = $this->session->userdata('logined');
        $this->session->unset_userdata('logined');
        switch ($data['type']){
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4:
                break;
        }
        redirect(base_url());
        // tweet 1, yahoo 2, google 3, facebook 4
        
    }

    //YAHOO ACCESS

     function yahoo_login() {
        $this->load->library('yahoo_api/Lightopenid');
        if ($this->lightopenid->mode) {
            if ($this->lightopenid->mode != 'cancel' && $this->lightopenid->validate()) {
                $data = $this->lightopenid->getAttributes();
                $filter = array();
                $filter['firstname'] = '';
                $filter['lastname'] = '';
                $filter['email'] = '';
                $filter['gender'] = 'F';
                $filter['birthday'] = '';
                $filter['mobile'] = '';
                $filter['username'] = '';
                $filter['link_profile'] = '';
                $filter['image'] = base_url('images/no-picture.jpg');
                $filter['type_connect'] = '2';
                if (array_key_exists("namePerson/first", $data))
                    $filter['firstname'] = $data['namePerson/first'];

                if (array_key_exists("namePerson/last", $data))
                    $filter['lastname'] = $data['namePerson/last'];

                if (array_key_exists("contact/email", $data))
                    $filter['email'] = $data['contact/email'];

                $filter['image'] = 'http://img.msg.yahoo.com/avatar.php?yids='. str_replace(array('@yahoo.com', '@yahoo.com.vn'), array('',''), $filter['email']);
                
                
                $customer = Customer::findByEmail($filter['email']);            
                if ($customer->countRows() > 0){
                    $customer->fetchFirst();
                    $customer->updateCustomerExist($customer->id, $filter);
                }
                else
                    Customer::insertCustomer($filter);
                
                $array = array();
                $array['username'] = $filter['username'] = '';
                $array['email'] = $filter['email'];
                $array['link_profile'] = $filter['link_profile'];
                $array['image'] = $filter['image'];
                $array['type'] = $filter['type_connect'];
                $this->session->set_userdata('logined', $array);
            }
        }
        /*
        if (array_key_exists("login", $_GET)) {
            $session = YahooSession::requireSession();
            if (is_object($session)) {
                $user = $session->getSessionedUser();
                
                $profile = $user->getProfile();
                
                $filter = array();
                $filter['firstname'] = '';
                $filter['lastname'] = '';
                $filter['email'] = '';
                $filter['gender'] = '';
                $filter['birthday'] = '';
                $filter['mobile'] = '';
                $filter['image'] = '';
                $filter['username'] = '';
                $filter['link_profile'] = '';
                $filter['type_connect'] = '2';
                if (isset($profile->givenName))
                    $filter['firstname'] = $profile->givenName;

                if (isset($profile->familyName))
                    $filter['lastname'] = $profile->familyName;

                if (isset($profile->profileUrl))
                    $filter['link_profile'] = $profile->profileUrl;

                if (isset($profile->emails[0]->handle))
                    $filter['email'] = $profile->emails[0]->handle;
                    $filter['username'] = $filter['email'];

                if (isset($profile->birthYear) && isset($profile->birthYear))
                    $filter['birthday'] = $profile->birthdate . '/' . $profile->birthYear;

                if (isset($profile->gender)) {
                    if ($profile->gender == 'M')
                        $filter['gender'] = 'M';
                    else
                        $filter['gender'] = 'F';
                }

                if (isset($profile->image->imageUrl))
                    $filter['image'] = $profile->image->imageUrl;
                else
                    $filter['image'] = base_url('images/no-picture.jpg');


                $customer = Customer::findByEmail($filter['email']);
                if ($customer->countRows() > 0)
                    Customer::updateCustomerExist($customer, $filter);
                else
                    Customer::insertCustomer($filter);

                $array = array();
                $array['username'] = $filter['username'] = '';
                $array['email'] = $filter['email'];
                $array['type'] = $filter['type_connect'];
                $array['link_profile'] = $filter['link_profile'];
                $array['image'] = $filter['image'];
                $this->session->set_userdata('logined', $array);
            }
        }*/
        $this->exit_login();
    }
    // FACEBOOK ACCESS

    function facebook_login() {
        $this->load->library('facebook_api/facebook');
        
        $user = $this->facebook->getUser();
        
        $user_profile = array();
        
        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me');
            } catch (FacebookApiException $e) {
                
            }
        }

        if (count($user_profile) > 0) {
            $filter = array();
            $filter['firstname'] = '';
            $filter['lastname'] = '';
            $filter['email'] = '';
            $filter['gender'] = 'F';
            $filter['birthday'] = '';
            $filter['mobile'] = '';
            $filter['image'] = '';
            $filter['username'] = '';
            $filter['link_profile'] = '';
            $filter['type_connect'] = '4';

            if (array_key_exists('link', $user_profile))
                $filter['link_profile'] = $user_profile['link'];

            if (array_key_exists('first_name', $user_profile))
                $filter['firstname'] = $user_profile['first_name'];

            if (array_key_exists('email', $user_profile))
                $filter['email'] = $user_profile['email'];

            if (array_key_exists('last_name', $user_profile))
                $filter['lastname'] = $user_profile['last_name'];

            if (array_key_exists('username', $user_profile)) {
                $filter['username'] = $user_profile['username'];
                $filter['image'] = 'https://graph.facebook.com/' . $filter['username'] . '/picture';
            }else
                $filter['image'] = base_url('images/no-picture.jpg');

            if (array_key_exists('gender', $user_profile)) {
                if ($user_profile['gender'] == 'female')
                    $filter['gender'] = 'F';
                else
                    $filter['gender'] = 'M';
            }
            
            $customer = Customer::findByEmail($filter['email']);            
            if ($customer->countRows() > 0){
                $customer->fetchFirst();
                $customer->updateCustomerExist($customer->id, $filter);
            }
                
            else
                Customer::insertCustomer($filter);

            
            $array = array();
            $array['username'] = $filter['username'] = '';
            $array['email'] = $filter['email'];
            $array['link_profile'] = $filter['link_profile'];
            $array['image'] = $filter['image'];
            $array['type'] = $filter['type_connect'];
            $this->session->set_userdata('logined', $array);
            
        }
        $this->exit_login();
    }

    function exit_login() {
        echo '<script language="javascript">';
        echo 'opener.location.reload(true);';
        echo 'self.close();';
        echo '</script>';
    }

}


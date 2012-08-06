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

        $this->load->library('google_api/Lightopenid');
        $this->lightopenid->returnUrl = base_url('login/google_login');
        $data['url_login_tweet'] = base_url('login/tweet_login');
        $data['url_login_yahoo'] = base_url('login/yahoo_login?login');
        $data['url_login_google'] = $this->lightopenid->authUrl();
        $data['url_login_facebook'] = base_url('login/facebook_login');
        $this->load->view('login_popup', $data);
    }

    // TWEET LOGIN ACCESS


    function tweet_login() {

        $this->load->library('tweet_api/tweet');
        $this->tweet->enable_debug(false);
        if (!$this->tweet->logged_in()) {
            // callback url
            $this->tweet->set_callback(site_url('login/tweet_login'));
            // Send the user off for login!
            $this->tweet->login();
        } else {
            $user = $this->tweet->call('get', 'account/verify_credentials');
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

            if (isset($user->profile_image_url))
                $filter['image'] = $user->profile_image_url;

            if (isset($user->name))
                $filter['firstname'] = $user->name;

            if (isset($user->profile_image_url))
                $filter['image'] = $user->profile_image_url;


            if (isset($user->screen_name))
                $filter['username'] = $user->screen_name;
                $filter['email'] = $user->screen_name . 'twetter.com';
                $filter['link_profile'] = 'https://twitter.com/' . $filter['username'];
             
                echo '<pre>';
                print_r($user);
                echo '</pre>';

//            $customer = new Customer();
//            
//            $customer = $customer->_insert($filter);
        }
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
                $filter['gender'] = '';
                $filter['birthday'] = '';
                $filter['mobile'] = '';
                $filter['image'] = '';
                $filter['username'] = '';
                $filter['link_profile'] = '';

                if (array_key_exists("namePerson/first", $data))
                    $filter['firstname'] = $data['namePerson/first'];

                if (array_key_exists("namePerson/last", $data))
                    $filter['lastname'] = $data['namePerson/last'];

                if (array_key_exists("contact/email", $data))
                    $filter['email'] = $data['contact/email'];

                echo '<pre>';
                print_r($filter);
                echo '</pre>';
            }
        }
    }

    //YAHOO ACCESS

    function yahoo_login() {
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
                        $filter['gender'] = 1;
                    else
                        $filter['gender'] = 0;
                }

                if (isset($profile->image->imageUrl))
                    $filter['image'] = $profile->image->imageUrl;

                echo '<pre>';
                var_dump($filter);
                echo '</pre>';
            }
        }
    }

    function yahoo_logout() {
        if (array_key_exists("logout", $_GET))
            YahooSession::clearSession();
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
                //error_log($e);
                $user = null;
            }
        } else {
            header('Location: ' . $this->facebook->getLoginUrl(array('scope' => 'email,read_stream')));
            //$logoutUrl = $this->facebook->getLogoutUrl();
        }

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
        }



        if (array_key_exists('gender', $user_profile)) {
            if ($user_profile['gender'] == 'female')
                $filter['gender'] = 1;
            else
                $filter['gender'] = 0;
        }
        echo '<pre>';
        var_dump($filter);
        echo '</pre>';
    }

}


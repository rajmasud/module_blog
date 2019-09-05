<?php

namespace Modules\Blog\Tests\Feature;

/*
* https://mattstauffer.com/blog/better-integration-testing-in-laravel-5.1-powerful-integration-tests-in-a-few-lines/
*
**/

//-----  MODELS  -----

use Tests\TestCase;

class HomePageTest extends TestCase {
    public function test_home_page_says_wowee() {
        $this->visit('/')
            ->see('Wowee');
    }

    public function test_forwarder_forwards_the_page() {
        $this->visit('/forwarder')
            ->seePageIs('forwarded-to');
    }

    public function test_cta_link_functions() {
        $this->visit('/sales-page')
            ->click('Try it now!')
            ->see('Sign up for trial')
            ->onPage('trial-signup');
    }

    public function test_it_can_subscribe_to_newsletter() {
        $this->visit('/newsletter')
            ->type('me@me.com', '#newsletter-email')
            ->press('Sign Up')
            ->see('Thanks for signing up!')
            ->onPage('newsletter/thanks');
    }

    public function test_signups_can_complete() {
        $this->visit('/signup')
            ->type('Matt Stauffer', 'name')
            ->check('overTwentyOne')
            ->select('Florida', 'state')
            ->attach('../uploads/test.jpg', 'profilePicture')
            ->press('Sign Up')
            ->seePageIs('/signup/thanks');
    }

    public function test_login_form() {
        $this->visit('/login')
            ->submitForm('Log In', ['email' => 'me@me.com', 'password' => 'secret'])
            ->see('Welcome!')
            ->onPage('dashboard');
    }

    public function test_saves_newsletter_signups() {
        $this->visit('/newsletter-signup')
            ->type('me@me.com')
            ->press('Sign up')
            ->seeInDatabase('signups', ['email' => 'me@me.com']);
    }
}//end class

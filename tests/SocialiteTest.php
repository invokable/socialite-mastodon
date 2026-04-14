<?php

namespace Tests;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;
use Revolution\Socialite\Mastodon\MastodonProvider;

class SocialiteTest extends TestCase
{
    public function test_instance()
    {
        $provider = Socialite::driver('mastodon');

        $this->assertInstanceOf(MastodonProvider::class, $provider);
    }

    public function test_redirect()
    {
        Socialite::fake('mastodon');

        $response = Socialite::driver('mastodon')->redirect();

        $this->assertTrue($response->isRedirect());
    }

    public function test_user()
    {
        Socialite::fake('mastodon', (new User)->map([
            'id' => 'id',
            'nickname' => 'username',
        ]));

        $user = Socialite::driver('mastodon')->user();

        $this->assertSame('id', $user->getId());
        $this->assertSame('username', $user->getNickname());
    }
}

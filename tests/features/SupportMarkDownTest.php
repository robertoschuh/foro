<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupportMarkDownTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function test_the_post_content_support_markdown()
    {
        $importantText = 'Texto muy importante';

        $post = $this->createPost([
           'content' => "La primera parte del texto. **$importantText**. La ultima parte del texto",
        ]);

        $this->visit($post->url)
            ->seeInElement('strong', $importantText);
    }

    function test_xss_attack(){

        $xssAttack = "<script>alert('Malicious JS!')</script>";

        $post = $this->createPost([
           'content' => "$xssAttack. Texto normal",
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)   // For the whole html DOM.
            ->seeText($xssAttack);  // ->seeText ->dontSeeText // for content/text.
    }

    function test_xss_attack_with_html(){

        $xssAttack = "<img src='img.jpg'";

        $post = $this->createPost([
            'content' => "$xssAttack. Texto normal",
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack) // ->seeText ->dontSeeText // for content
            ->seeText('Texto normal');
    }
}

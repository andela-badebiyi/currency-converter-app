<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class landingPageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/')
                    ->assertSee('Currency Converter')
                    ->assertSee('Base Currency')
                    ->assertSee('Target Currency')
                    ->assertSee('No Conversion has been made yet')
                    ->press('.btn')
                    ->waitForText('Results')
                    ->assertSee('Show rate history')
                    ->assertSee('Show other currencies');
        });
    }
}

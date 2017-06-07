<?php

namespace Tests\Unit;
use \Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \Fixer;

class FixerHelperTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public $testData1, $testData2, $testData3;
    public function setUp()
    {
        parent::setUp();
        $this->testData1 = '{"base":"EUR","date":"2017-06-07","rates":{"AUD":1.4845,"BGN":1.9558,"BRL":3.6694,"CAD":1.5085,"CHF":1.0843,"CNY":7.6253,"CZK":26.316,"DKK":7.4387,"GBP":0.86908,"HKD":8.7422,"HRK":7.4058,"HUF":308.66,"IDR":14920.0,"ILS":3.9772,"INR":72.178,"JPY":122.78,"KRW":1261.4,"MXN":20.439,"MYR":4.779,"NOK":9.5023,"NZD":1.5599,"PHP":55.573,"PLN":4.1913,"RON":4.5703,"RUB":63.515,"SEK":9.7953,"SGD":1.5499,"THB":38.166,"TRY":3.9747,"USD":1.1217,"ZAR":14.431}}';

        $this->testData2 = '{"base":"EUR","date":"2017-06-07","rates":{"GBP":0.86908}}';

        $this->testData3 = '{"base":"USD","date":"2017-06-07","rates":{"AUD":1.3234,"BGN":1.7436,"BRL":3.2713,"CAD":1.3448,"CHF":0.96666,"CNY":6.798,"CZK":23.461,"DKK":6.6316,"GBP":0.77479,"HKD":7.7937,"HRK":6.6023,"HUF":275.17,"IDR":13301.0,"ILS":3.5457,"INR":64.347,"JPY":109.46,"KRW":1124.5,"MXN":18.221,"MYR":4.2605,"NOK":8.4713,"NZD":1.3907,"PHP":49.544,"PLN":3.7366,"RON":4.0744,"RUB":56.624,"SEK":8.7325,"SGD":1.3817,"THB":34.025,"TRY":3.5435,"ZAR":12.865,"EUR":0.8915}}';
    }
    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetAllCurrencies()
    {

        $responseMockery = Mockery::mock('response');
        $responseMockery->shouldReceive('getBody')
        ->andReturn($this->testData1);

        $guzzleClient = Mockery::mock('client');
        $guzzleClient->shouldReceive('get')
        ->andReturn($responseMockery);

        $expectedJsonResult = json_decode($this->testData1, true);

        $expectedResult = array_keys($expectedJsonResult['rates']);
        $expectedResult[] = $expectedJsonResult['base'];

        $this->assertTrue(Fixer::getAllCurrencies($guzzleClient) === $expectedResult);
    }

    public function testGetRateByCurrency()
    {
        $responseMockery = Mockery::mock('response');
        $responseMockery->shouldReceive('getBody')
        ->andReturn($this->testData2);

        $guzzleClient = Mockery::mock('client');
        $guzzleClient->shouldReceive('get')
        ->andReturn($responseMockery);

        $this->assertTrue(Fixer::getRateByCurrency($guzzleClient, 'EUR', 'GBP') === 0.86908);
    }

    public function testGetAllRates()
    {
        $responseMockery = Mockery::mock('response');
        $responseMockery->shouldReceive('getBody')
        ->andReturn($this->testData3);

        $guzzleClient = Mockery::mock('client');
        $guzzleClient->shouldReceive('get')
        ->andReturn($responseMockery);

        $expectedResult = json_decode($this->testData3, true)['rates'];
        $this->assertTrue(Fixer::getAllRates($guzzleClient, 'USD') ===  $expectedResult);
    }
}

<?php


namespace stonkeep\ModelFields\Tests;

use Illuminate\Database\Capsule\Manager as DB;



class initialTest extends TestCase
{

    /** @test */
    public function test_trait()
    {
        //Get User fields
        $fields = User::fields();
        //Assert
        $this->assertSame($fields,
            [
                //don'tshow id
                0 => "email",
                //don't show password
                1 => "field1",
                //don't show field2
                2 => "field3",
                //don't show dates
            ]
        );
    }

}

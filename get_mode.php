<?php
require( 'connectdb.php' );
require( 'mode.php' );
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' )
{
    if($mode == "day")
    {
        echo '<button Type="submit" id="day_end">Stop '.$mode.' mode</button>';
    }
    elseif($mode=="subject")
    {
        echo '<button Type="submit" id="subject_end">Stop '.$mode.' mode</button>';
    }
    elseif($mode=="intern")
    {
        echo '<button Type="submit" id="intern_end">Stop '.$mode.' mode</button>';
    }
}
?>
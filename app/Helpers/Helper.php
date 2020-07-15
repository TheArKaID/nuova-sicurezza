<?php
    namespace App\Helpers;

    class Helper
    {
        function isMobile()
        {
            $agent = new \Jenssegers\Agent\Agent;
            if($agent->isMobile() || $agent->isTablet() || $agent->isPhone())
                return true;
            return false;
        }
    }
?>

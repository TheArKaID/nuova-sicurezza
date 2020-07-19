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

        function idTahunAktif()
        {
            $ta = \App\Pengaturan::first();
            return $ta->idtahunaktif;
        }

        function tahunAktif()
        {
            $ta = \App\Pengaturan::first();
            $tahun = \App\Tahun::find($ta)->first();
            return $tahun->tahunajaran;
        }
    }
?>

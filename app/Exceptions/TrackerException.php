<?php

namespace App\Exceptions;

use Throwable;

class TrackerException extends \Exception
{
    protected const ERROR_MSG = [
        // Error message of base Tracker system
        100 => 'Ta sledilnik trenutno ni odprt.',

        // Error message about Requests ( Part.1 HTTP Method and Route )
        110 => 'Neveljavna vrsta zahteve: zahtevo stranke (:method) ni bil HTTP GET.',
        111 => 'Neveljavna vrsta dejanja `:action`.',

        // Error message about User Agent ( Bittorrent Client )
        120 => 'Neveljaven uporabniški agent!',
        121 => 'Brskalnik, pajek ali goljuf ni dovoljen.',
        122 => 'Nenormalen dostop blokiran!',
        123 => 'Uporabniški agent tega odjemalca je predolg!',
        124 => ':pattern Napaka REGEX za :start, prosim sysop, da to popravi.',
        125 => 'Vaša stranka je prestara. prosimo, da ga posodobite pozneje :start .',
        126 => 'Stranka :ua ni sprejemljivo! Preverite naš seznam dovoljenih.',
        127 => 'Stranka :ua prepovedano zaradi: :comment .',
        128 => 'Stranka :ua ni sprejemljivo! Preverite naš črni seznam.',
        129 => 'Neveljavna Zahteva!',

        // Error message about Requests ( Part.2 request params )
        130 => 'ključ: :attribute manjka!',
        131 => 'Neveljavno :attribute ! :reason',  // Normal Invalid, Use below instead.
        132 => 'Neveljavno :attribute ! dolžina :attribute mora biti :rule',
        133 => 'Neveljavno :attribute ! :attribute ni :rule dolgih bajtov',
        134 => 'Neveljavno :attribute ! :attribute Biti mora število, večje ali enako 0',
        135 => 'Nezakonito pristanišče :port . Vrata naj bodo med 6881-64999',
        136 => 'Nepodprta vrsta dogodka :event .',
        137 => 'Nedovoljena vrata 0 pod vrsto dogodka :event .',
        138 => 'Dosegli ste mejo stopnje. Lahko samo seed/leech samo en torrent od upto :limit lokacijah.',

        // Error message about User Account
        140 => 'Geslo ne obstaja! Prosimo, ponovno prenesite .torrent',
        141 => 'Vaš račun ni omogočen! ( Trenutno `:status` )',
        142 => 'Vaše pravice za prenos so onemogočene! (Preberi pravila)',

        // Error message about Torrent
        150 => 'Torrent ni registriran v tem sledilniku.',
        151 => 'Nimate dovoljenja za dostop do :status torrent.',
        152 => 'Torrent je objavljen kot popoln, vendar ni bilo mogoče najti nobenega zapisa.',

        // Error message about Download Session
        160 => 'Ne morete semenovati istega torrenta iz več kot :count lokacijah.',
        161 => 'Isti torrent že prenašate. Lahko le pijavke iz :count lokacijo naenkrat!',
        162 => 'Obstaja minimalno zaklepanje objav :min sekunde, počakajte.',
        163 => 'Vaše razmerje je prenizko! Počakati moraš :sec sekunde za začetek.',
        164 => 'Vaša omejitev mesta je dosežena! Največ lahko prenesete :max torrentov hkrati',

        // Error message from Anti-Cheater System
        170 => "Verjamemo, da poskušate goljufati. In vaš račun je onemogočen.",

        // Test Message
        998 => 'Napaka notranjega strežnika :msg',
        999 => ':test',
    ];

    /**
     * TrackerException constructor.
     */
    public function __construct(int $code = 999, array $replace = null, Throwable $throwable = null)
    {
        $message = self::ERROR_MSG[$code];
        if ($replace) {
            foreach ($replace as $key => $value) {
                $message = \str_replace($key, $value, $message);
            }
        }

        parent::__construct($message, $code, $throwable);
    }
}

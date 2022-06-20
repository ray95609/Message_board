<?php

namespace App\Http\Controllers;

class barberController extends \Illuminate\Routing\Controller
{


    public function index(){



        return view('Barber.index');

    }

    public function reserve(){



        return route('barber.index');
    }


    public function history(){






        return view('Barber.history');
    }

    public function backend(){





        return view('Barber.backend');


    }

    public function schedule(){





        return view('Barber.schedule');

    }

    public function reserveList(){






        return view('Barber.reserveList');
    }


    public function reserveDetail(){






        return view('Barber.reserveDetail');
    }

    public function reserveUpdate(){





        return route('barber.reserveList');
    }


}

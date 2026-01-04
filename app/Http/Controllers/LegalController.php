<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Política de Privacidad
     */
    public function privacy()
    {
        return view('legal.privacy');
    }

    /**
     * Aviso Legal
     */
    public function notice()
    {
        return view('legal.notice');
    }

    /**
     * Política de Cookies
     */
    public function cookies()
    {
        return view('legal.cookies');
    }

    /**
     * Metodología
     */
    public function methodology()
    {
        return view('legal.methodology');
    }

    /**
     * Sobre Nosotros
     */
    public function about()
    {
        return view('legal.about');
    }

    /**
     * FAQs
     */
    public function faq()
    {
        return view('legal.faq');
    }
}

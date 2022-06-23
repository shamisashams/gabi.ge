<?php

namespace App\Http\Controllers;


use App\Mail\ContactEmail;
use App\Models\Language;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(string $lang, Request $request)
    {
        if ($request->method() == 'POST') {
            $request->validate([
                'first_name' => 'required|string|max:55',
                'last_name' => 'required|string|max:55',
                'email' => 'required|email',
                'phone' => 'required|max:55',
                'message' => 'required|max:1024'
            ]);


            $data = [
                'first_name' => $request->full_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message
            ];

            $mailTo = Setting::where(['key' => 'contact_email'])->first();

            if ($mailTo != null) {
                if (count($mailTo->availableLanguage) > 0) {
                    Mail::to($mailTo->availableLanguage[0]->value)->send(new ContactEmail($data));
                }
            }

        }


        $page = Page::where(['status' => true, 'type' => 'contact-us'])->with('availableLanguage')->first();
        if (!$page) {
            return abort('404');
        }
        return view('pages.contact-us.index', [
            'page' => $page
        ]);
    }


    public function subscribe(Request $request,Subscriber $subscriber){
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        $subscriber->create(['email'=>$request->post('email')]);
    }

}

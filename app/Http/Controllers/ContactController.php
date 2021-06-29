<?php

namespace App\Http\Controllers;


use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index(Request $request)
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

        $page = Page::join('page_languages', 'page_languages.page_id', '=', 'pages.id')
            ->where(['status' => true, 'page_languages.slug' => 'contact-us'])->first();
        if (!$page) {
            return abort('404');
        }
        return view('pages.contact-us.index',[
            'page'=>$page
        ]);
    }

}

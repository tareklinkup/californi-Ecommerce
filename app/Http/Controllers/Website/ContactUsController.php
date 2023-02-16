<?php

namespace App\Http\Controllers\Website;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{
    public function index() {
        return view('pages.contact_us');
    }

    public function sendMessage(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'message' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $adminEmail = 'admin@fk.com';

        $settings = Settings::first();

        $subject = $settings->shop_name . ' - Contact';

        try {
            Mail::raw($message, function($m) use ($name, $email, $message, $adminEmail) {
                $m->from($email, $name);
                $m->to($adminEmail)->subject($subject);
            });
            Session::flash('success', 'Message send successfully');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->route('contact.us');
    }

    // Message 18-2-2021 (author:azhar)
    public function getMessage()
    {
        return view('pages.message');
    }

    public function messageStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->save();
        if($message){
            return redirect()->back()->with('success', 'Thanks for Message Us! We will reply soon.');
        }
        return redirect()->back()->withInput();
    }
}

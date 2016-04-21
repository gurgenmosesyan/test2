<?php

namespace App\Http\Controllers;

use App\Models\Product\ProductMl;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Mail;

class ApiController extends Controller
{
    public function products(Request $request)
    {
        $categoryId = $request->input('category_id');
        $products = ProductMl::current()->where('category_id', $categoryId)->get();
        return $this->api('OK', $products);
    }

    public function contact(ContactRequest $request)
    {
        $data = $request->all();
        Mail::send('emails.default', ['data' => $data], function($message) use($data) {
            $message->from($data['email']);
            $message->to(trans('www.contact.admin_email'), trans('www.contact.admin_name'));
            $message->subject($data['subject']);
        });
        return $this->api('OK');
    }
}
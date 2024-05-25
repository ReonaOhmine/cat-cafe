<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactReqest;
use App\Mail\ContactAdminMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //

    public function index()
    {
        return view('contact.index');
    }


    public function sendMail(ContactReqest $request)
    {
        $validated = $request->validated();

        // これ以降の行は入力エラーがなかった場合のみ実行されます
        // 登録処理(実際はメール送信などを行う)
        // Log::debug($validated['name'] . 'さんよりお問い合わせがありました');
        Mail::to('r.ohmine@freddy.co.jp')->send(new ContactAdminMail($validated));

        // ここで POST リクエストを使用して complete メソッドにリダイレクトする
        return redirect()->route('contact.complete')->with('status', 'お問い合わせが完了しました');
    }


    public function complete()
    {
        return view('contact.complete');
    }

}


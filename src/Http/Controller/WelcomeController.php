<?php

namespace RazeSoldier\Seat3VWelcome\Http\Controller;

use Illuminate\Http\Request;
use Seat\Services\Settings\Profile;
use Seat\Web\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function showMainPage()
    {
        $email = auth()->user()->group()->getResults()->getEmailAttribute();
        if ($email === null) {
            $qq = null;
        } else {
            preg_match('/(?<QQ>[a-zA-Z0-9]*)@qq\.com/', $email, $matches);
            if (count($matches) > 0) {
                $qq = $matches['QQ'];
            } else {
                $qq = null;
            }
        }
        return view('welcome::main', [
            'qq' => $qq,
        ]);
    }

    public function bindQQ(Request $request)
    {
        if ($request->qq === null) {
            abort(404);
        }
        Profile::set('email_address', "{$request->qq}@qq.com");
        if ($request->isAjax !== '1') {
            return back()->withInput();
        }
    }
}

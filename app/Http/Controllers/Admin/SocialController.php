<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::first();
        if ($socials && $socials->social_info) {
            $countClient = count(json_decode($socials->social_info));
        } else {
            $countClient = 0;
        }
        return view('core-ui.pages.social.index',
            ['socials' => $socials, 'countClient' => $countClient]
        );
    }

    public function update(Request $request)
    {

        try {
            DB::beginTransaction();

            $social = Social::first();
            $icon = $request->icon;
            $url = $request->url;

            $social_info = [];
            for ($key = 0; $key < count($icon); $key++) {
                if ($icon[$key] || $url[$key]) {
                    array_push($social_info, ['icon' => $icon[$key], 'url' => $url[$key]]);
                }
            }
            $data = [
                'title_en' => $request->title_en,
                'title_vi' => $request->title_vi,
                'social_info' => json_encode($social_info)
            ];
            if ($social) {
                $social->update($data);
            } else {
                Social::create($data);
            }

            DB::commit();
            Session::flash('success', 'Update successfully');
            return redirect()->route('social.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Update failed!');
            return response()
                ->json([
                    'code' => 500,
                    'message' => $exception->getMessage()
                ]);
        }
    }
}

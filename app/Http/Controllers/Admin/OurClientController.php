<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurClient\OurClientPostRequest;
use App\Models\OurClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class OurClientController extends Controller
{
    public function index()
    {
        $ourClients = OurClient::first();
        if ($ourClients && $ourClients->client_info) {
            $countClient = count(json_decode($ourClients->client_info));
        } else {
            $countClient = 0;
        }
        return view('core-ui.pages.ourClient.index',
            ['ourClients' => $ourClients, 'countClient' => $countClient]
        );
    }

    public function update(Request $request)
    {

        try {
            DB::beginTransaction();

            $ourClient = OurClient::first();
            $logo = $request->logo;
            $url = $request->url;

            $client_info = [];
            for ($key = 0; $key < count($logo); $key++) {
                if ($logo[$key] || $url[$key]) {
                    array_push($client_info, ['logo' => $logo[$key], 'url' => $url[$key]]);
                }
            }

            $data = [
                'short_title_en' => $request->short_title_en,
                'short_title_vi' => $request->short_title_vi,
                'title_en' => $request->title_en,
                'title_vi' => $request->title_vi,
                'client_info' => json_encode($client_info)
            ];
            if ($ourClient) {
                $ourClient->update($data);
            } else {
                OurClient::create($data);
            }

            DB::commit();
            Session::flash('success', 'Update successfully');
            return redirect()->route('ourClient.index');
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

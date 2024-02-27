<?php

namespace App\Http\Controllers\DpfpApi;

date_default_timezone_set("America/Bogota");

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DpfpModels\TempFingerprint;
use Illuminate\Support\Facades\Config;

class SseController extends Controller {

    //Stream para java
    public function stream($token_pc) {
        return response()->stream(function () use ($token_pc) {
                    $response = array("token_pc" => $token_pc, "option" => null);
                    while (true) {
                        $rows = TempFingerprint::where("token_pc", $token_pc)->whereNotNull("option")->first();
                        if (!empty($rows)) {
                            $response["token_pc"] = $token_pc;
                            $response["updated_at"] = strtotime($rows->updated_at);
                            $response["option"] = $rows->option;
                        } else {
                            $response = array("token_pc" => $token_pc, "option" => null);
                        }
                        echo json_encode($response) . PHP_EOL;
                        ob_flush();
                        flush();
                        sleep(1);
                    }
                }, 200, ['Access-Control-Allow-Origin' => '*', 'Content-Type' => 'text/event-stream', 'Cache-Control' => 'no-cache']
        );
    }

    //Stream para javascript
    public function streamjs($token_pc) {
        return response()->stream(function () use ($token_pc) {
                    $response = array();
//                    $response["user_id_number"] = null;
                    $response["person_id"] = null;
                    $response["name"] = null;
                    $response["image"] = null;
                    $response["updated_at"] = null;
                    $response["text"] = null;
                    $response["token_pc"] = $token_pc;
                    $rows = TempFingerprint::where("token_pc", $token_pc)->where("option", "=", "read")->first();
                    if (!empty($rows)) {
                        $response["token_pc"] = $token_pc;
                        $response["updated_at"] = strtotime($rows->updated_at);
                        $response["option"] = $rows->option;
                        $response["person_id"] = $rows->person_id;
                        $response["name"] = $rows->name;
                        $response["image"] = $rows->image;
                        $response["text"] = $rows->text;
                        if (!empty($response["image"])) {
                            TempFingerprint::where("token_pc", $token_pc)->update(["image" => null]);
                        }
                    }
                    echo 'data: ' . json_encode($response) . "\n\n";
                    flush();
                }, 200, ['Access-Control-Allow-Origin' => '*', 'Content-Type' => 'text/event-stream', 'Cache-Control' => 'no-cache']
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $result = TempFingerprint::where("token_pc", $request->token_pc)
                ->update(["option" => "close", "image" => null]);
        $arrayResponse = array("code" => $result, "message" => "Ok");
        return $arrayResponse;
    }

}

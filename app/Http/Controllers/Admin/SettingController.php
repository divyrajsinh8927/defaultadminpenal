<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Slim;
use App\Http\Resources\SlimStatus;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;

class SettingController extends Controller
{
    public function index()
    {
        return view('Admin.setting');
    }

    public function set_theme(Request $request)
    {
        Setting::where('setting_name', '=', 'theme')->update([
            'setting_value' => $request->theme,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Theme Updated.']);
    }
    public function set_app_name(Request $request)
    {
        Setting::where('setting_name', '=', 'app_name')->update([
            'setting_value' => $request->app_name,
            'updated_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Theme Updated.']);
    }

    public function set_app_logo()
    {
        try {
            $images = Slim::getImages();
        }
        catch (Exception $e) {

            // Possible solutions
            // ----------
            // Make sure you're running PHP version 5.6 or higher

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'Unknown'
            ));

            return;
        }

        // No image found under the supplied input name
        if ($images === false) {

            // Possible solutions
            // ----------
            // Make sure the name of the file input is "slim[]" or you have passed your custom
            // name to the getImages method above like this -> Slim::getImages("myFieldName")

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'No data posted'
            ));

            return;
        }

        // Should always be one image (when posting async), so we'll use the first on in the array (if available)
        $image = array_shift($images);

        // Something was posted but no images were found
        if (!isset($image)) {

            // Possible solutions
            // ----------
            // Make sure you're running PHP version 5.6 or higher

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'No images found'
            ));

            return;
        }

        // If image found but no output or input data present
        if (!isset($image['output']['data']) && !isset($image['input']['data'])) {

            // Possible solutions
            // ----------
            // If you've set the data-post attribute make sure it contains the "output" value -> data-post="actions,output"
            // If you want to use the input data and have set the data-post attribute to include "input", replace the 'output' String above with 'input'
            // The submitted files are checked to see if they are images, if determined they are not images the values are null

            Slim::outputJSON(array(
                'status' => SlimStatus::FAILURE,
                'message' => 'No image data'
            ));

            return;
        }



        // if we've received output data save as file
        if (isset($image['output']['data'])) {

            // get the name of the file
            $name = $image['output']['name'];

            // get the crop data for the output image
            $data = $image['output']['data'];

            // If you want to store the file in another directory pass the directory name as the third parameter.
            $output = Slim::saveFile($data, $name, 'app_icon/');

            // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
            // $output = Slim::saveFile($data, $name, 'tmp/', false);

            // Default call for saving the output data
            // $output = Slim::saveFile($data, $name);
        }

        // if we've received input data (do the same as above but for input data)
        if (isset($image['input']['data'])) {

            // get the name of the file
            $name = $image['input']['name'];

            // get the crop data for the output image
            $data = $image['input']['data'];

            // If you want to store the file in another directory pass the directory name as the third parameter.
            $input = Slim::saveFile($data, $name, 'app_icon/');

            // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
            // $input = Slim::saveFile($data, $name, 'tmp/', false);

            // Default call for saving the input data
            // $input = Slim::saveFile($data, $name);

        }



        //
        // Build response to client
        //
        $response = array(
            'status' => SlimStatus::SUCCESS
        );

        if (isset($output) && isset($input)) {

            $response['output'] = array(
                'file' => $output['name'],
                'path' => $output['path']
            );

            $response['input'] = array(
                'file' => $input['name'],
                'path' => $input['path']
            );

        }
        else {
            $response['file'] = isset($output) ? $output['name'] : $input['name'];
            $response['path'] = isset($output) ? $output['path'] : $input['path'];
        }

        // Return results as JSON String

        Setting::where('setting_name', '=', 'app_logo')->update([
            'setting_value' => $response['file'],
            'updated_at' => Carbon::now()
        ]);
        $settings = Setting::get()->toArray();
        FacadesSession::put('app_icon',$settings[2]['setting_value']);

        Slim::outputJSON($response);
        // return redirect()->back()->with(['profile_message_type' => 'success'])->with(['profile_message_data' => 'Profile Image Uploaded']);

    }
}

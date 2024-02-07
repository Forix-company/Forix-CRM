<?php

namespace Modules\Base\Http\Controllers;

use Modules\Base\Http\Requests\StoreSettings_AuthsRequest;
use Modules\Base\Jobs\ProcessInventory;
use Modules\Base\Mail\TwoFactorUsers;
use Modules\Base\Entities\settings_auths;
use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Routing\Controller;
class HerramientasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function login()
    {
        $settings_auth = settings_auths::all();
        return view('base::Dashboard.Configuracion.login.index', compact('settings_auth'));
    }

    public function settings_auth(StoreSettings_AuthsRequest $request, $id)
    {
        if ($request->estado == 1) {

            User::query()->update(['login_2fa_statu' => $request->estado, 'token_login' => null]);

            $settings = settings_auths::where('id', $request->estado);
            $settings->update(['status' => 1, 'add_auth' => 0]);

            $settings = settings_auths::where('id', '!=', $request->estado);
            $settings->update(['status' => 0, 'add_auth' => 0]);

            return redirect()->back()->with('success', 'Se actualizo los datos exitosamente !');
        } else {
            $User = User::all();
            foreach ($User as $value) {

                $google2fa = new Google2FA();
                $SecretKey = (new Google2FA)->generateSecretKey(32);

                User::query()->update(['login_2fa_statu' => $request->estado, 'token_login' => $SecretKey]);

                $settings = settings_auths::where('id', $request->estado);
                $settings->update(['status' => 1, 'add_auth' => $request->estado]);

                $settings = settings_auths::where('id', '!=', $request->estado);
                $settings->update(['status' => 0, 'add_auth' => 0]);

                $data =  QrCode::size(200)->generate($google2fa->getQRCodeUrl($value->NombreCompleto, $value->email, $SecretKey));

                Mail::to($value->email)->send(new TwoFactorUsers($data));
            }

            return redirect()->back()->with('success', 'Se actualizo los datos exitosamente !');
        }
    }
}

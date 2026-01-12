<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);




        /* Fortify::authenticateUsing(function (Request $request) {

            $user = \App\Models\User::where('email', $request->email)->first();

            if (! $user) {
                return null;
            }

            if (! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return null;
            }

            $company = $user->employee->company ?? null;

            if ($company && (int) $company->restringido === 1) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => 'El acceso ha sido restringido para esta empresa. Comuníquese con el administrador.',
                ]);
            }

            return $user;
        }); */



        Fortify::authenticateUsing(function (Request $request) {

            $user = \App\Models\User::where('email', $request->email)->first();

            if (! $user) {
                return null;
            }

            // 🔐 Validar password
            if (! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                return null;
            }

            // 🟢 EXCEPCIÓN: acceso permitido siempre para este correo
            if ($user->email === 'michael@ticomperu.com') {
                return $user;
            }

            // 🚫 Validar empresa restringida
            $company = $user->employee->company ?? null;

            if ($company && (int) $company->restringido === 1) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => 'El acceso ha sido restringido para esta empresa. Comuníquese con el administrador.',
                ]);
            }

            return $user;
        });









        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
